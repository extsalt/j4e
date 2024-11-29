<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(1800);

class Cronjob extends CI_Controller {
	
    public function __construct() {
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
    }
	
	
	
	public function index() {

	}
	
	
	
	public function daily() {
		//execute only on the first day of the month
		if(date('j') == '1' || date('j') == '01') {
			//reset the purchased item's usage
			$query_purchased = $this->db->where('auto_renew', 1)->get('payment_purchased');
			if ($query_purchased->num_rows()) {
				$rs_purchased = $query_purchased->result();
				foreach ($rs_purchased as $purchased) {
					$query_item = $this->db->where('ids', $purchased->item_ids)->get('payment_item', 1);
					if ($query_item->num_rows()) {
						$rs_item = $query_item->row();
						$update_data = array(
						  'stuff' => $rs_item->stuff_setting,
						  'used_up' => 0
						);
						$this->db->where('ids', $purchased->ids)->update('payment_purchased', $update_data);
					}
				}
			}
		}
		
		//handle statistics
		$old_signup_last_six_days_array = json_decode($this->db->where('type', 'signup_last_six_days')->get('statistics', 1)->row()->value, TRUE);
		$today = my_server_time();
		$yeaterday = date('Y-m-d', strtotime('-1 day', strtotime($today)));
		for ($i = -6; $i <= -2; $i++) {
			$previous_date = date('Y-m-d', strtotime($i . ' day', strtotime($today)));
			if (isset($old_signup_last_six_days_array[$previous_date])) {
				$new_signup_last_six_days_array[$previous_date] = $old_signup_last_six_days_array[$previous_date];
			}
			else {
				$cnt = $this->db->where('created_time>=', $previous_date)->where('created_time<', date('Y-m-d', strtotime('+1 day', strtotime($previous_date))))->count_all_results('user');
				$new_signup_last_six_days_array[$previous_date] = $cnt;
			}
		}
		$cnt_yeaterday = $this->db->where('created_time>=', $yeaterday)->where('created_time<', my_server_time($this->config->item('time_reference'), 'Y-m-d'))->count_all_results('user');
		$new_signup_last_six_days_array[$yeaterday] = $cnt_yeaterday;
		$this->db->update('statistics', array('value'=>json_encode($new_signup_last_six_days_array)));
		
		//handle subscription of manual adding
		$query_subscription = $this->db->where('end_time<', my_server_time('UTC', 'Y-m-d'))->where('payment_gateway=', 'manual')->where('status', 'active')->get('payment_subscription');
		if ($query_subscription->num_rows()) {
			$rs_subscription = $query_subscription->result();
			foreach ($rs_subscription as $row) {
				$rs_subscription_item = $this->db->where('ids', $row->item_ids)->get('payment_item', 1)->row();
				$res = my_user_reload($row->user_ids, 'Cut', $rs_subscription_item->item_currency, $rs_subscription_item->item_price);
				$res_array = json_decode($res, 1);
				if ($res_array['result']) {
					$end_date = date('Y-m-d H:i:s', strtotime($rs_subscription_item->recurring_interval_count . ' ' . $rs_subscription_item->recurring_interval, strtotime($row->end_time)));
					$this->db->where('ids', $row->ids)->update('payment_subscription', array('end_time'=>$end_date, 'updated_time'=>my_server_time()));
				}
			}
		}
		
		//handle free subscription, subscribe automatically
		$query_subscription = $this->db->where('end_time<', my_server_time('UTC', 'Y-m-d'))->where('gateway_identifier=', '')->where('status', 'active')->where('auto_renew', 1)->get('payment_subscription');  //gateway_identifier=='' means free
		if ($query_subscription->num_rows()) {
			$rs_subscription = $query_subscription->result();
			foreach ($rs_subscription as $row) {
				$rs_subscription_item = $this->db->where('ids', $row->item_ids)->get('payment_item', 1)->row();
				$end_date = date('Y-m-d H:i:s', strtotime($rs_subscription_item->recurring_interval_count . ' ' . $rs_subscription_item->recurring_interval, strtotime($row->end_time)));
				$update_array = array(
				  'end_time' => $end_date,
				  'updated_time' => my_server_time(),
				  'stuff' => $rs_subscription_item->stuff_setting,
				  'used_up' => 0
				);
				$this->db->where('ids', $row->ids)->update('payment_subscription', $update_array);
			}
		}
		
		//handle subscription that is going to expired
		$this->db->where('end_time<', my_server_time('UTC', 'Y-m-d'))->group_start()->where('status', 'active')->or_where('status', 'pending_cancellation')->group_end()->update('payment_subscription', array('status'=>'expired', 'updated_time'=>my_server_time()));

		//handle ticket
		$ticket_setting_array = json_decode(my_global_setting('ticket_setting'), 1);
		$close_rule = intval($ticket_setting_array['close_rule']);
		if ($close_rule > 0) {  //need to close ticket automatically
			$this->db->where('main_status', 1)->where('updated_time<', date('Y-m-d H:i:s', strtotime('-' . 1440 * $close_rule . ' minutes', now($this->config->item('time_reference')))))->update('ticket', array('main_status'=>'0', 'read_status'=>'1'));
		}
		
		//handle expired uploaded file
		$query = $this->db->where('temporary_ids!=', '')->where('created_time<', date('Y-m-d H:i:s', strtotime('-1440 minutes', now($this->config->item('time_reference')))))->get('file_manager');
		if ($query->num_rows()) {
			$rs = $query->result();
			foreach ($rs as $row) {
				$file_path = $this->config->item('my_upload_directory') . 'temporary/' . $row->ids . '.' . $row->file_ext;
				try {unlink($file_path);} catch(\Exception $e) {}
				$this->db->where('id', $row->id)->delete('file_manager');
			}
		}
		
		echo 'success';
	}
	
	
	
	public function quarterly() {
		$query = $this->db->where('online', 1)->where('online_time<', date('Y-m-d H:i:s', strtotime('-15 minutes', now($this->config->item('time_reference')))))->get('user');
		if ($query->num_rows()) {
			$rs = $query->result();
			foreach ($rs as $row) {
				$this->db->where('id', $row->id)->update('user', array('online'=>0));
			}
		}
		echo 'success';
	}
	
	
	public function process_subscription() {
            $user_info = $this->db->where(array('membership_type !='=>0,'membership_type !='=>3,'user_delete'=>1,'packages_id !='=>0))->get('user')->result();
            if(!empty($user_info))
            {
                foreach($user_info as $val)
                {
                    $td = date('Y-m-d');
                    $ed = date('Y-m-d',$val->packages_endDate);
                    if($td > $ed)
                    {
                        if($val->membership_type == '2')
                        {
                            $rs_email = $this->db->where('purpose', 'subscription')->get('email_template')->row(); 
                            $user_info = $this->db->where('id',$val->id)->get('user')->row();
                            $web_setting = $this->db->get('website_settings')->row();
                            $setting = my_global_setting('all_fields');
                            $data['setting'] = $setting;
                            $data['web_setting'] = $web_setting;
                            $data['template'] = $rs_email;
                            $data['user'] = $user_info;
                            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/subscribe', $data,true);
                //            echo $body;
                            $email = array(
                                          'email_to' => $user_info->email_address,
                                          'email_subject' => $rs_email->subject,
                                          'email_body' => $body
                                    );
                                $res = my_send_email($email);
                //                print_r($res);
                        }
                        $package_purchase_info = $this->db->where(array('user_id'=>$val->id,'plan_status'=>'Upcoming'))->get('user_package_purchase')->row();
                        if(!empty($package_purchase_info))
                        {
                            $cp_info = $this->db->get_where('packages',array('pack_id'=>$val->packages_id))->row_array();    
                            $get_packages = $this->db->get_where('packages',array('pack_id'=>$package_purchase_info->plan_id))->row_array();    
                            $duration = $get_packages['pack_duration'];
                            $todaydate = strtotime($td);
                            $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
                            $membership=array(
	                    "packages_id"=>$get_packages['pack_id'],
	                    "packages_startDate"=> $todaydate,
	                    "packages_endDate"=> strtotime($eddate),
	                     "membership_type"=>$get_packages['pack_type']
	                    );
                            $this->db->where(array('id'=>$val->id));
                            $res=$this->db->update('user',$membership);
                            if($res==TRUE){
                                if($get_packages['seq_no'] < $cp_info['seq_no'])
                                {
                                    $act_package = $this->db->get_where('user_package_purchase',array('user_id'=>$val->id,'plan_status'=>'Active'))->row();
                                    $q = $this->db->where(array('pur_id'=>$act_package->pur_id))->set('plan_status','Expired')->update('user_package_purchase');
                                    $q1 = $this->db->where(array('pur_id'=>$package_purchase_info->pur_id))->set(array('plan_status'=>'Active'))->update('user_package_purchase');
//                                    $q1 = $this->db->where(array('user_id'=>$val->id,'plan_status'=>'Upcoming'))->set('plan_status','Inactive')->update('user_package_purchase');
//                                    $pur_array = array(
//                                    'user_id'=>$val->id,
//                                    'plan_id'=>$np,
//            	                'plan_startdate'=>$td,
//            	                'plan_enddate'=>$eddate,
//                                    'plan_status'=>'Active'
//                                    );
//                                    $this->db->insert('user_package_purchase',$pur_array);
//                                    $ppid = $this->db->insert_id(); 
                                    $user_package = $this->db->get_where('user_package_features',array('user_id'=>$val->id,'package_purchase_id'=>$act_package->pur_id))->result();
                                    if(!empty($user_package))
                                    {
                                        foreach($user_package as $val1)
                                        {
                                            $type = "";
                                            if(empty($val1->type_id))
                                            {
                                                $type = $val1->type_id;
                                            }
                                            else
                                            {
                                                $str = explode(',', $val1->type_id);
                                                $pf_info = $this->db->where(array('package_id'=>$get_packages['pack_id'],'feature_id'=>$val1->feature_id))->get('package_features')->row();
                                                if($pf_info->count_allowed >= count($str))
                                                {
                                                    $type = $val1->type_id;
                                                }
                                                else
                                                {
                                                    for($i=0;$i<$pf_info->count_allowed;$i++)
                                                    {
                                                        if($i==0)
                                                        {
                                                            $type = $type.$str[$i];
                                                        }
                                                        else
                                                        {
                                                            $type = $type.','.$str[$i];
                                                        }
                                                    }
                                                }
                                            }
                                            $pur_array1 = array(
                                        'package_purchase_id'=>$package_purchase_info->pur_id,
                                        'package_id'=>$package_purchase_info->plan_id,
                                        'feature_id'=>$val1->feature_id,
                                        'user_id'=>$package_purchase_info->user_id,
                                        'used_count'=>$val1->used_count,
                                        'type_id'=>  $type      
                                        );
                                        $this->db->insert('user_package_features',$pur_array1);
                                        }
                                    }
                                }
                                else
                                {
                                $act_package = $this->db->get_where('user_package_purchase',array('user_id'=>$val->id,'plan_status'=>'Active'))->row();
                                $q = $this->db->where(array('pur_id'=>$act_package->pur_id))->set('plan_status','Expired')->update('user_package_purchase');
                                $q1 = $this->db->where(array('pur_id'=>$package_purchase_info->pur_id))->set(array('plan_status'=>'Active','plan_startdate'=>$td,'plan_enddate'=>$eddate))->update('user_package_purchase');
                                $user_package = $this->db->get_where('user_package_features',array('user_id'=>$val->id,'package_purchase_id'=>$act_package->pur_id))->result();
                                if(!empty($user_package))
                                {
                                    foreach($user_package as $val1)
                                    {
                                        $pur_array1 = array(
                                    'package_purchase_id'=>$package_purchase_info->pur_id,
                                    'package_id'=>$package_purchase_info->plan_id,
                                    'feature_id'=>$val1->feature_id,
                                    'user_id'=>$val->id,
                                    'used_count'=>$val1->used_count,
                                    'type_id'=>  $val1->type_id      
                                    );
                                    $this->db->insert('user_package_features',$pur_array1);
                                    }
                                }
                            }
                            }
                        }
                        else
                        {
                            $get_packages = $this->db->get_where('packages',array('pack_type'=>1))->row_array();    
                            $duration = $get_packages['pack_duration'];
                            $todaydate = strtotime($td);
                            $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
                            $membership=array(
	                    "packages_id"=>$get_packages['pack_id'],
	                    "packages_startDate"=> $todaydate,
	                    "packages_endDate"=> strtotime($eddate),
	                     "membership_type"=>$get_packages['pack_type']
	                    );
                            $this->db->where(array('id'=>$val->id));
                            $res=$this->db->update('user',$membership);
                            if($res==TRUE){
                                $act_package = $this->db->get_where('user_package_purchase',array('user_id'=>$val->id,'plan_status'=>'Active'))->row();
                                $q = $this->db->where(array('pur_id'=>$act_package->pur_id))->set('plan_status','Expired')->update('user_package_purchase');
//                                $q1 = $this->db->where(array('pur_id'=>$package_purchase_info->pur_id))->set('plan_status','Active')->update('user_package_purchase');
                                $pur_array = array(
                                    'user_id'=>$val->id,
                                    'plan_id'=>1,
            	                'plan_startdate'=>$td,
            	                'plan_enddate'=>$eddate,
                                    'plan_status'=>'Active'
                                    );
                                    $this->db->insert('user_package_purchase',$pur_array);
                                    $ppid = $this->db->insert_id(); 
                                $user_package = $this->db->get_where('user_package_features',array('user_id'=>$val->id,'package_purchase_id'=>$act_package->pur_id))->result();
                                if(!empty($user_package))
                                {
                                    foreach($user_package as $val1)
                                    {
                                        $type = "";
                                        if(empty($val1->type_id))
                                        {
                                            $type = $val1->type_id;
                                        }
                                        else
                                        {
                                            $str = explode(',', $val1->type_id);
                                            $pf_info = $this->db->where(array('package_id'=>1,'feature_id'=>$val1->feature_id))->get('package_features')->row();
                                            if($pf_info->count_allowed > count($str))
                                            {
                                                $type = $val1->type_id;
                                            }
                                            else
                                            {
                                                for($i=0;$i<$pf_info->count_allowed;$i++)
                                                {
                                                    if($i==0)
                                                    {
                                                        $type = $type.$str[$i];
                                                    }
                                                    else
                                                    {
                                                        $type = $type.','.$str[$i];
                                                    }
                                                }
                                            }
                                        }
                                        $pur_array1 = array(
                                    'package_purchase_id'=>$$ppid,
                                    'package_id'=>1,
                                    'feature_id'=>$val1->feature_id,
                                    'user_id'=>$val->id,
                                    'used_count'=>$val1->used_count,
                                    'type_id'=>  $type      
                                    );
                                    $this->db->insert('user_package_features',$pur_array1);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        public function event_reminder()
        {
            $dt = date('Y-m-d');
            $event_info = $this->db->where(array('event_date >='=>$dt,'event_status'=>'1'))->get('events')->result();
            if(!empty($event_info))
            {
                foreach($event_info as $val)
                {
                    $ed = date('Y-m-d',strtotime($val->event_date.'-5 days'));
                    if($dt >= $ed)
                    {
                        $rs_email = $this->db->where('purpose', 'reminder')->get('email_template')->row(); 
                        $event_info = $this->db->where('event_id',$val->event_id)->get('events')->row();
                        $web_setting = $this->db->get('website_settings')->row();
                        $setting = my_global_setting('all_fields');
                        $data['setting'] = $setting;
                        $data['web_setting'] = $web_setting;
                        $data['template'] = $rs_email;
                        $data['event'] = $event_info;
                        $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/event_reminder', $data,true);
//                        echo $body;
                        $user_info = $this->db->where_in('membership_type',array('1','2'))->where('user_delete','1')->get('user')->result();
                        if(!empty($user_info))
                        {
                            foreach($user_info as $val1)
                            {
                                    $email = array(
                                              'email_to' => $val1->email_address,
                                              'email_subject' => $rs_email->subject,
                                              'email_body' => $body
                                        );
                                    $res = my_send_email($email);
                            }
                        }
            //                print_r($res);
                    }
                }
            }
        }

        public function buddy_meet_reminder()
        {
            $dt = date('Y-m-d');
            $meet_info = $this->db->where(array('buddy_meet_date >='=>$dt))->get('buddy_meet')->result();
            if(!empty($meet_info))
            {
                foreach($meet_info as $val)
                {
                    $ed = date('Y-m-d',strtotime($val->buddy_meet_date.'-5 days'));
                    if($dt >= $ed)
                    {
                        $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
                        $buddy_meet_info = $this->db->where('buddy_meet_id',$val->buddy_meet_id)->get('buddy_meet')->row();
                        $web_setting = $this->db->get('website_settings')->row();
                        $setting = my_global_setting('all_fields');
                        $data['setting'] = $setting;
                        $data['web_setting'] = $web_setting;
                        $data['template'] = $rs_email;
                        $data['buddy_meet'] = $buddy_meet_info;
                        $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/buddy_meet_reminder', $data,true);
//                        echo $body;
                        $user_info = $this->db->where('id',$val->buddy_meet_touserid)->get('buddy_meet')->row();
                        $user_info1 = $this->db->where('id',$val->buddy_meet_withuserid)->get('buddy_meet')->row();
                        $email = array(
            			  'email_to' => $user_info->email_address,
            			  'email_subject' => $rs_email->subject,
            			  'email_body' => $body
            		    );
            		$res = my_send_email($email);
                        $email1 = array(
            			  'email_to' => $user_info1->email_address,
            			  'email_subject' => $rs_email->subject,
            			  'email_body' => $body
            		    );
            		$res1 = my_send_email($email1);
            //                print_r($res);
                    }
                }
            }
        }
        
        public function subscription_reminder()
        {
            $dt = date('Y-m-d');
            $user_info = $this->db->where_in('membership_type',array('1','2'))->where('user_delete','1')->get('user')->result();
            if(!empty($user_info))
            {
                foreach($user_info as $val)
                {
                    $dt1 = date('Y-m-d',$val->packages_endDate);
                    $ed = date('Y-m-d',strtotime($dt1.'-5 days'));
//                    echo $ed;die;
                    if($dt >= $ed)
                    {
                        $rs_email = $this->db->where('purpose', 'reminder')->get('email_template')->row(); 
                        $user_info = $this->db->where('id',$val->id)->get('user')->row();
                        $web_setting = $this->db->get('website_settings')->row();
                        $setting = my_global_setting('all_fields');
                        $data['setting'] = $setting;
                        $data['web_setting'] = $web_setting;
                        $data['template'] = $rs_email;
                        $data['user'] = $user_info;
                        $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/reminder', $data, true);
//                        echo $body;die;
                        $email = array(
            			  'email_to' => $user_info->email_address,
            			  'email_subject' => $rs_email->subject,
            			  'email_body' => $body
            		    );
            		$res = my_send_email($email);
            //                print_r($res);
                    }
                }
            }
        }
    }
?>