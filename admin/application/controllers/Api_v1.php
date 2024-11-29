<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once FCPATH . 'vendor/autoload.php';
use chriskacerguis\RestServer\RestController;

class Api_v1 extends RestController {
	
	public $json_array = [];
	public $throttle_switch = TRUE;
	public $setting;
	
    public function __construct() {
		parent::__construct();
		
		date_default_timezone_set($this->config->item('time_reference'));
		
		$this->load->model('user_model');
		$this->db->query('SET SESSION sql_mode = ""');
		// check if system is under maintenance
		$this->setting = my_global_setting('all_fields');
		if ($this->setting->maintenance_mode) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $this->setting->maintenance_message
			);
			$this->response($resp_array, 200);
		}

		// check if api function is enabled
		if (!$this->setting->api_enabled) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => 'API is disabled.'
			);
			$this->response($resp_array, 200);
		}
		//$this->json_array=$this->input->raw_input_stream;
		//$this->json_array=parse_str($_SERVER['QUERY_STRING'], $_GET); 
		// check if json posted by client is a real json string
		/*$raw_data = html_purify($this->input->raw_input_stream);
		if (!empty($raw_data)) {
			$this->json_array = json_decode($raw_data, TRUE);
			if (json_last_error() != JSON_ERROR_NONE) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => 'Invalid Json Data'
				);
				$this->response($resp_array, 200);
			}
		}*/
    }
	
	
	
	public function status_get() {  //This method is no auth
		$resp_array = array('status' => TRUE, 'message' => 'The system is running');
		$this->response($resp_array, 200);
	}
	public function app_get_payment_details_get()
	{
	    $obj = array('razorpay_key'=>$this->setting->razorpay_key,'razorpay_secret'=>$this->setting->razorpay_secret);
	        $resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Record Found',
    					  'data' =>$obj);
    					  $this->response($resp_array, 200);
    					  
	}
        public function app_check_version_maintenance_get()
	{
	    $info = $this->db->get('setting')->row();
	    if(!empty($info))
	    {
	        $obj = array('maintenance_mode'=>$info->maintenance_mode,'app_version'=>$info->app_version,'app_version_title'=>$info->app_version_title);
	        $resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Record Found',
    					  'data' =>	$obj
    					);
	    }
	    else
	    {
	        $resp_array = array(
    					  'status' => FALSE,
    					  'msg'=>'No Record Found'
    					);
	    }
	    $this->response($resp_array, 200);
	}
        public function app_check_referral_code_post()
	{
	    $info = $this->db->where('phone',$_POST['referral_code'])->get('user')->row();
	    if(!empty($info))
	    {
	        $obj = array('userid'=>$info->id);
	        $resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Valid User',
    					  'data' =>	$obj
    					);
	    }
	    else
	    {
	        $resp_array = array(
    					  'status' => FALSE,
    					  'msg'=>'Invalid User',
                                          'data'=>array()
    					);
	    }
	    $this->response($resp_array, 200);
	}
        public function app_get_home_details_post()
	{
	    $userid = my_post('userid');
            $check_in_usertble=$this->db->query("select * from user where id='".$userid."'")->row();
            $obj = array();
            $permissions = array();
            if(!empty($check_in_usertble->packages_id))
            {
                $pf_info = $this->db->where('package_id',$check_in_usertble->packages_id)->get('package_features')->result();
                if(!empty($pf_info))
                {
                    foreach($pf_info as $val)
                    {
                        $fet_info = $this->db->where('fet_id',$val->feature_id)->get('features')->row();
                        array_push($permissions,array('feature_id'=>$val->feature_id,'feature_name'=>$fet_info->fet_name,'is_allowed'=>$val->is_allowed));
                    }
                }
            }
            $post = 0;
            $requirement = 0;
            $buddy_meet = 0;
            $referral = 0;
            
            $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>1))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>1,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $post = 1;
                   }
                }                                   
            }
            
            $pf_info1 = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>2))->get('package_features')->row();
            $package_info1 = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption1 = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>2,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info1->count_allowed > 0)
            {                                   
                if(!empty($user_consumption1))
                {
                   if($user_consumption1->used_count == $pf_info1->count_allowed)
                   {
                       $requirement = 1;
                   }
                }                                   
            }
            
            $pf_info2 = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>3))->get('package_features')->row();
            $package_info2 = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption2 = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>3,'package_purchase_id'=>$package_info2->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info2->count_allowed > 0)
            {                                   
                if(!empty($user_consumption2))
                {
                   if($user_consumption2->used_count == $pf_info2->count_allowed)
                   {
                       $buddy_meet = 1;
                   }
                }                                   
            }
            
            $pf_info3 = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>11))->get('package_features')->row();
            $package_info3 = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption3 = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>11,'package_purchase_id'=>$package_info3->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info3->count_allowed > 0)
            {                                   
                if(!empty($user_consumption3))
                {
                   if($user_consumption3->used_count == $pf_info3->count_allowed)
                   {
                       $referral = 1;
                   }
                }                                   
            }
            
	    $obj['permissions'] = $permissions;
	    $obj['is_post_exhausted'] = $post;
            $obj['is_requirement_exhausted'] = $requirement;
            $obj['is_buddy_meet_exhausted'] = $buddy_meet;
            $obj['is_referral_exhausted'] = $referral;
            $obj['view_permission_msg'] = "You don't have permission to View. Upgrade your Membership to View";
            $obj['create_permission_msg'] = "You don't have permission to Create. Upgrade your Membership to Create";
            $obj['view_exhausted_msg'] = "You have exhausted your Membership limit. Upgrade your Membership to View more";
            $obj['create_exhausted_msg'] = "You have exhausted your Membership limit. Upgrade your Membership to Create more";
            $resp_array = array(
    					  'status' => TRUE,
    					  'error'=>'Record Found',
    					  'data' =>	$obj
    					);
	    
	    $this->response($resp_array, 200);
	}
        public function app_get_terms_conditions_get()
	{
	    $info = $this->db->where('infpg_id',7)->get('infopages')->row();
            if(!empty($info))
            {
            $resp_array = array(
    					  'status' => TRUE,
    					  'error'=>'Record Found',
    					  'data' =>	$info->infpg_desc_eng
    					);
            }
            else
            {
                $resp_array = array(
    					  'status' => FALSE,
    					  'error'=>'Record Not Found',
    					  'data' =>	''
    					);
            }
	    $this->response($resp_array, 200);
	}
        public function app_get_privacy_policy_get()
	{
	    $info = $this->db->where('infpg_id',6)->get('infopages')->row();
            if(!empty($info))
            {
            $resp_array = array(
    					  'status' => TRUE,
    					  'error'=>'Record Found',
    					  'data' =>	$info->infpg_desc_eng
    					);
            }
            else
            {
                $resp_array = array(
    					  'status' => FALSE,
    					  'error'=>'Record Not Found',
    					  'data' =>	''
    					);
            }
	    $this->response($resp_array, 200);
	}
        public function app_get_intro_screen_get()
	{
	    $info = $this->db->get('intro_screen')->result_array();
            $info1 = array();
	    if(!empty($info))
	    {
	        for($i=0;$i<count($info);$i++)
	        {
	            $info1[$i]['screen_id'] = $info[$i]['screen_id'];
	            $info1[$i]['screen_title'] = $info[$i]['screen_title'];
	            $info1[$i]['screen_desc'] = $info[$i]['screen_desc'];
	            $info1[$i]['screen_image'] = base_url($info[$i]['screen_image']);
	        }
	    }
            if(!empty($info1))
            {
            $resp_array = array(
    					  'status' => TRUE,
    					  'error'=>'Record Found',
    					  'data' =>	$info1
    					);
            }
            else
            {
                $resp_array = array(
    					  'status' => FALSE,
    					  'error'=>'Record Not Found',
    					  'data' =>	array()
    					);
            }
	    $this->response($resp_array, 200);
	}
	public function app_get_groups_post()
	{
	    $userid = my_post('userid');
	    $info = $this->db->where('userid',$userid)->get('users_group')->result();
	    if(!empty($info))
	    {
	        $obj = array();
	        foreach($info as $val)
	        {
	            $ginfo = $this->db->where('group_id',$val->groupid)->get('groups')->row();
	            array_push($obj,array('group_uid'=>$ginfo->firebase_uid));
	        }
	        $resp_array = array(
    					  'status' => TRUE,
    					  'error'=>'Record Found',
    					  'data' =>	$obj
    					);
	    }
	    else
	    {
	        $resp_array = array(
				  'status' => FALSE,
				  'error' => "No Record"
				);
	    }
	    $this->response($resp_array, 200);
	}
	
	public function app_get_group_participants_post()
	{
	    $uid = my_post('group_uid');
	    $loginuserid = my_post('user_id');
	    $keyword = my_post('keyword');
	    $info = $this->db->where('firebase_uid',$uid)->get('groups')->result();
	    if(!empty($info))
	    {
	        $obj = array();
	        $user = array();
	        foreach($info as $val)
	        {
	            $ginfo = $this->db->where('groupid',$val->group_id)->get('users_group')->result();
	            if(!empty($ginfo))
	            {
	                foreach($ginfo as $val1)
	                {
	                    array_push($user,$val1->userid);
	                }
	                if(empty($keyword))
	                {
	                    $get_userdata = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,membership_type,id")->where_in('id',$user)->get('user')->result();
	                }
	                else
	                {
	                    $get_userdata = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,membership_type,id")->where_in('id',$user)->like('first_name',$keyword,both)->or_like('middle_name',$keyword,both)->or_like('last_name',$keyword,both)->get('user')->result();
	                }
	                if(!empty($get_userdata))
	                {
	                foreach($get_userdata as $val2)
	                {
	                    $uinfo = $this->db->where('id',$val2->id)->get('user')->row();
	                    if($val2->membership_type == 1)
	                    {
	                        $mname = "Guest";
	                    }
	                    else if($val2->membership_type == 2)
	                    {
	                        $mname = "Paid";
	                    }
	                    else
	                    {
	                        $mname = "";
	                    }
	                    
	                    
	                    $check_connection = $this->user_model->get_check_connection($val2->id,$loginuserid);
	                    
    	                array_push($obj,array('userid'=>$val2->id,'username'=>$val2->full_name,'photo'=>base_url('upload/avatar/'.$uinfo->avatar),'phone'=>$uinfo->phone,'chatid'=>$uinfo->firebase_uid,'designation'=>$uinfo->designation,'company_name'=>$uinfo->company,'email'=>$uinfo->email_address,'membership_type'=>$uinfo->membership_type,'membership_name'=>$mname,'check_connection'=>$check_connection));
    	                $resp_array = array(
        					  'status' => TRUE,
        					  'error'=>'Record Found',
        					  'data' =>	$obj
        					);
	                }
	                }
	                else
	            {
	                 $resp_array = array(
				  'status' => FALSE,
				  'error' => "No User Found"
				);
	            }
	            }
	            else
	            {
	                 $resp_array = array(
				  'status' => FALSE,
				  'error' => "No User Found"
				);
	            }
	        }
	        
	    }
	    else
	    {
	        $resp_array = array(
				  'status' => FALSE,
				  'error' => "No Group Found"
				);
	    }
	    $this->response($resp_array, 200);
	}
	public function signin_post() {  //This method is no auth
	        
	        $this->json_array=$_POST;
		if (isset($this->json_array['username']) && isset($this->json_array['password'])) {
		    $throttle_check = my_throttle_check($this->json_array['username']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
				$rs = $this->user_model->signin_query_user($this->json_array['username'], $this->json_array['password']);
				if ($rs != FALSE) {
					$this->user_model->sigin_success_log($rs, 'api');
					$resp_array = array('status' => TRUE);
					$resp_array += $this->user_model->user_fileds_builder($rs);
				}
				else {
					my_throttle_log($this->json_array['username']);
					$resp_array = array(
					  'status' => FALSE,
					  'error' => my_caption('api_sigin_invalid_credential')
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $this->json_array()
			);
		}
		$this->response($resp_array, 200);
	}
	
	public function app_check_validity_post(){
	    
	    $this->json_array=$_POST;
		$throttle_check = my_throttle_check($this->json_array['mobile']);
		if (!$this->setting->signup_enabled) {  //signup disabledapp_user_view_profile_contact
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('signup_register_disabled')
			);
		}
		else if (!$throttle_check['result'] && $this->throttle_switch) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $throttle_check['message']
			);
		}
		elseif (isset($this->json_array['mobile'])) {
			$validate_res = my_validate_data($this->json_array['mobile'], 'Mobile No', 'trim|required|min_length[10]');  //validate emailAddress
			
			if ($validate_res['status']) {
				my_throttle_log('');
				// $res = $this->user_model->save_user_mobile($this->setting, 'api', $this->json_array['mobile']);
    			
    			   
				
    				$checkdata = $this->db->select('*')->where('phone',$this->json_array['mobile'])->get('user')->row();
    				if(empty($checkdata)){
    				$resp_array = array(
        					  'status' => FALSE,
        					  'message'=> array(
                    		    'otp'=>'0',
                    		    'login_type'=>'',
                    		    'message'=>'User not found',
                    		    'result'=>FALSE,
                    		    'mobile'=>'',
                    		    'userid'=>'',
                    		    'membership_type'=>0
                    		  )	
        					  
        					);
    				}else{
    				if($checkdata->user_delete == '1')
    				{
    				    $package_info1 = $this->db->where(array('user_id'=>$checkdata->id))->get('user_package_purchase')->result();
	        
            	        $package_info = $this->db->where(array('user_id'=>$checkdata->id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            	        $dt = date('Y-m-d');
            	        if((!empty($package_info1)) && (empty($package_info) || (!empty($package_info) && $dt>$package_info->plan_enddate)))
            	        {
        					$message = array(
                    		    'otp'=>'0',
                    		    'login_type'=>'',
                    		    'message'=>'Plan Expired',
                    		    'result'=>FALSE,
                    		    'mobile'=>'',
                    		    'userid'=>'',
                    		    'membership_type'=>0
                    		  )	;  
        					$resp_array = array(
        					  'status' => FALSE,
        					  'message'=>$message,
        					  
        					);
        				}
        				else {
        				    $message = array(
                    		    'userid'=>$checkdata->id,
        		    'mobile'=>$this->json_array['mobile'],
        		    'otp'=>'',
        		    'login_type'=>'normal',
        		    'result'=>'TRUE',
        		    //'user_data'=>$res[0],
        		    'message'=>'Login Successful',
        		    'membership_type'=>0
                    		  )	;  
        					$resp_array = array(
        					  'status' => TRUE,
        					  'message'=>$message,
        					  
        					);
        				}
    				}
    				else
    				{
    				    
    				    $message = array(
        		    'otp'=>'0',
        		    'login_type'=>'',
        		    'message'=>'Deactive Account',
        		    'result'=>FALSE,
        		    'mobile'=>'',
        		    'userid'=>'',
        		    'membership_type'=>0
        		  )	;  
    				    
    				    $resp_array = array(
        					  'status' => FALSE,
        					  'message'=>$message,
        					  
        					);
    				}
    				}
    			
    			/*
    				if ($res['result']==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  //'type'=>$res['type'],
    					  'message' => $res['message']
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => TRUE,
    					  //'type'=>'New User',
    					  'message' => $res['message']
    					);
    				}*/
			}
			else {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $validate_res['message']
				);
			}
		}
		else {  //parameter incomplete
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	public function mobile_signin_post(){
	    
	    $this->json_array=$_POST;
		$throttle_check = my_throttle_check($this->json_array['mobile']);
		if (!$this->setting->signup_enabled) {  //signup disabledapp_user_view_profile_contact
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('signup_register_disabled')
			);
		}
		else if (!$throttle_check['result'] && $this->throttle_switch) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $throttle_check['message']
			);
		}
		elseif (isset($this->json_array['mobile'])) {
			$validate_res = my_validate_data($this->json_array['mobile'], 'Mobile No', 'trim|required|min_length[10]');  //validate emailAddress
			
			if ($validate_res['status']) {
				my_throttle_log('');
				$res = $this->user_model->save_user_mobile($this->setting, 'api', $this->json_array['mobile']);
    			
    			   
				
    				$checkdata = $this->db->select('user_delete')->where('phone',$this->json_array['mobile'])->get('user')->row();
    				if(empty($checkdata)){
    				$resp_array = array(
        					  'status' => TRUE,
        					  'message'=>$res['message'],
        					  
        					);
    				}else{
    				if($checkdata->user_delete == '1')
    				{
        				if ($res['result']==TRUE) {
        					
        					$resp_array = array(
        					  'status' => TRUE,
        					  'message'=>$res['message'],
        					  
        					);
        				}
        				else {
        					$resp_array = array(
        					  'status' => TRUE,
        					  'message'=>$res['message'],
        					  
        					);
        				}
    				}
    				else
    				{
    				    
    				    $message = array(
        		    'otp'=>'0',
        		    'login_type'=>'',
        		    'message'=>'Deactive Account',
        		    'result'=>FALSE,
        		    'mobile'=>'',
        		    'userid'=>'',
        		    'membership_type'=>0
        		  )	;  
    				    
    				    $resp_array = array(
        					  'status' => FALSE,
        					  'message'=>$message,
        					  
        					);
    				}
    				}
    			
    			/*
    				if ($res['result']==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  //'type'=>$res['type'],
    					  'message' => $res['message']
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => TRUE,
    					  //'type'=>'New User',
    					  'message' => $res['message']
    					);
    				}*/
			}
			else {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $validate_res['message']
				);
			}
		}
		else {  //parameter incomplete
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	public function mobile_signin_post_old(){
	    
	    $this->json_array=$_POST;
		$throttle_check = my_throttle_check($this->json_array['mobile']);
		if (!$this->setting->signup_enabled) {  //signup disabledapp_user_view_profile_contact
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('signup_register_disabled')
			);
		}
		else if (!$throttle_check['result'] && $this->throttle_switch) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $throttle_check['message']
			);
		}
		elseif (isset($this->json_array['mobile'])) {
			$validate_res = my_validate_data($this->json_array['mobile'], 'Mobile No', 'trim|required|min_length[10]');  //validate emailAddress
			
			if ($validate_res['status']) {
				my_throttle_log('');
				$res = $this->user_model->save_user_mobile($this->setting, 'api', $this->json_array['mobile']);
				if ($res['result']==TRUE) {
					$resp_array = array(
					  'status' => TRUE,
					  //'type'=>$res['type'],
					  'message' => $res['message']
					);
				}
				else {
					$resp_array = array(
					  'status' => TRUE,
					  //'type'=>'New User',
					  'message' => $res['message']
					);
				}
			}
			else {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $validate_res['message']
				);
			}
		}
		else {  //parameter incomplete
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	public function signup_post() {  //This method is no auth
	    $this->json_array=$_POST;
		$throttle_check = my_throttle_check($this->json_array['emailAddress']);
		if (!$this->setting->signup_enabled) {  //signup disabled
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('signup_register_disabled')
			);
		}
		else if (!$throttle_check['result'] && $this->throttle_switch) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $throttle_check['message']
			);
		}
		elseif (isset($this->json_array['emailAddress']) && isset($this->json_array['firstName']) && isset($this->json_array['lastName']) && isset($this->json_array['password'])) {
			$validate_res = my_validate_data($this->json_array['emailAddress'], 'emailAddress', 'trim|required|valid_email|max_length[50]');  //validate emailAddress
			if ($validate_res['status']) {
				$this->json_array['emailAddress'] = $validate_res['data'];
				if (my_duplicated_check('user', array('email_address'=>$this->json_array['emailAddress']))) {
					$validate_res['status'] = TRUE;
				}
				else {
					$validate_res['status'] = FALSE;
					$validate_res['message'] = my_caption('signup_email_taken');
				}
			}
			if ($validate_res['status']) {
				$validate_res = my_validate_data($this->json_array['firstName'], 'firstName', 'trim|required|max_length[50]');
			}
			if ($validate_res['status']) {
				$this->json_array['firstName'] = $validate_res['data'];
				$validate_res = my_validate_data($this->json_array['lastName'], 'lastName', 'trim|required|max_length[50]');
			}
			if ($validate_res['status']) {
				$this->json_array['lastName'] = $validate_res['data'];
				if (!empty($this->json_array['password'])) {
					switch ($this->setting->psr) {
						case 'medium' :
						  $min_length = 8;
						  break;
						case 'strong' :
						  $min_length = 12;
						  break;
						default :
						  $min_length = 6;
					}
					$condition = 'trim|required|min_length[' . $min_length . ']|max_length[20]|password_strength[' . $this->setting->psr . ']';
				}
				else {
					$condition = 'trim|required';
				}
				$validate_res = my_validate_data($this->json_array['password'], 'password', $condition);
			}
			if ($validate_res['status']) {
				$this->json_array['password'] = $validate_res['data'];
				my_throttle_log('');
				$res = $this->user_model->save_user($this->setting, 'api', $this->json_array);
				if ($res['result']) {
					$resp_array = array(
					  'status' => TRUE,
					  'message' => $res['message']
					);
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'error' => $res['message']
					);
				}
			}
			else {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $validate_res['message']
				);
			}
		}
		else {  //parameter incomplete
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	}
	
	
	
	public function forgot_post() {
	   $this->json_array=$_POST;
		$throttle_check = my_throttle_check($this->json_array['emailAddress']);
		if (!$this->setting->forget_enabled) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('forget_forget_disabled')
			);
		}
		elseif (!$throttle_check['result'] && $this->throttle_switch) {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => $throttle_check['message']
			);
		}
		else if (isset($this->json_array['emailAddress'])) {
			my_throttle_log($this->json_array['emailAddress']);
			$validate_res = my_validate_data($this->json_array['emailAddress'], 'emailAddress', 'trim|required|valid_email');  //validate emailAddress
			if ($validate_res['status']) {
				$res = $this->user_model->forget_password($this->json_array['emailAddress']);
				if ($res['result']) {
					$resp_array = array(
					  'status' => TRUE,
					  'message' => $res['message']
					);
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'error' => $res['message']
					);
			    }
			}
			else {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $validate_res['message']
				);
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	}
	
	
	public function app_delete_account_post(){
	    
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    if (isset($this->json_array['userid']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=> $obj
				);
			}
			else {
				$rs = $this->user_model->app_delete_account($this->json_array['userid']);
				if ($rs != FALSE) {
					
				    
				    $resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Account Deactive Successfully',
					  'data'=> $obj
					);
				    
				}
				else {
				
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'Something Wrong',
					  'data'=> $obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter'),
					  'data'=> $obj
			);
		}
		$this->response($resp_array, 200);
	}
	
	
	/*
	*   APP USER LOGIN
	*   REQUEST PARAMETER :- (login_type,mobile,social_id,social_type,device_id,device_type,registration_type)
	*   METHOD:- POST
	*/
	/*
	public function app_user_login_post(){
	    
	        $obj = array();
	    
	        
	        $this->json_array=$_POST;
	         
	       if ( isset($this->json_array['mobile'])) {            // isset($this->json_array['login_type']) &&
		    $throttle_check = my_throttle_check($this->json_array['mobile']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				
				$resp_array = array(
				  'status' => FALSE,
				  'msg'=> $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
				$rs = $this->user_model->get_app_user_login($this->json_array['mobile']);
			//	$request_arr=array('social_id'=>$this->json_array['social_id'],'social_type'=>$this->json_array['social_type'],'device_id'=>$this->json_array['device_id'],'registration_type'=>$this->json_array['registration_type']);
				if ($rs != FALSE) {
					$this->user_model->sigin_success_log($rs, 'api');
					$resp_array = array('status' => TRUE);
					$resp_array += $this->user_model->get_app_user_login_fileds_builder($rs);
				}
				else {
					my_throttle_log($this->json_array['mobile']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_user_login_invalid'),
					  'data' => $obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg'=> my_caption('api_incomplete_parameter'),
			  'data' => $obj
			 
			);
		}
		$this->response($resp_array, 200);
	    
	}
	*/
	
	public function app_user_login_post(){
	    
	    $obj = array();
	    
	    $this->json_array=$_POST;
		$throttle_check = my_throttle_check($this->json_array['mobile']);
		if (!$this->setting->signup_enabled) {  //signup disabledapp_user_view_profile_contact
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('signup_register_disabled'),
			  'data'=>$obj
			);
		}
		else if (!$throttle_check['result'] && $this->throttle_switch) {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => $throttle_check['message'],
			  'data'=>$obj
			);
		}
		elseif (isset($this->json_array['mobile'])) {
			$validate_res = my_validate_data($this->json_array['mobile'], 'Mobile No', 'trim|required|min_length[10]');  //validate emailAddress
			
			if ($validate_res['status']) {
				my_throttle_log('');
				$res = $this->user_model->save_user_mobile($this->setting, 'api', $this->json_array['mobile']);
				
				$checkdata = $this->db->select('user_delete')->where('id',$res['message']['userid'])->get('user')->row();
				if($checkdata->user_delete == '1')
				{
    				if ($res['result']==TRUE) {
    					
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>my_caption('api_data_found'),
    					  'data' => $res['message']
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'New User',
    					  'data' => $res['message']
    					);
    				}
				}
				else
				{
				    $resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Deactive Account',
    					  'data' => $obj
    					);
				}
			}
			else {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => 'Something Wrong',
				  'data' => $validate_res['message']
				);
			}
		}
		else {  //parameter incomplete
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' => $obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
		/*
	*   APP USER SEND OTP
	*   REQUEST PARAMETER :- (userid,mobile)
	*   METHOD:- POST
	*/
	
	public function send_otp_post(){
	    
	    $this->json_array=$_POST;
	    
	    
	    
	    if (isset($this->json_array['userid']) && isset($this->json_array['mobile'])) {
		    $throttle_check = my_throttle_check($this->json_array['mobile']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
				$rs = $this->user_model->get_app_user_exist($this->json_array['mobile'],$this->json_array['userid']);
				if ($rs != FALSE) {
					$otp=$this->user_model->update_otp($this->json_array['mobile'],$this->json_array['userid']);
					$resp_array = array('status' => TRUE);
					$resp_array += $this->user_model->get_app_send_otp_fileds_builder($rs,$otp);
				}
				else {
					my_throttle_log($this->json_array['mobile']);
					$resp_array = array(
					  'status' => FALSE,
					  'error' => my_caption('api_user_send_otp_invalid')
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	
	

	
    /*
	*   APP USER VERIFY OTP
	*   REQUEST PARAMETER :- (otp,userid)
	*   METHOD:- POST
	*/
	
	public function app_user_verify_otp_post(){
	    
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    if (isset($this->json_array['otp']) && isset($this->json_array['userid']) && isset($this->json_array['mobile']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=> $obj
				);
			}
			else {
				$rs = $this->user_model->get_app_user_verify_otp($this->json_array['otp'],$this->json_array['userid'],$this->json_array['mobile'],$this->json_array['device_type'],$this->json_array['device_token'],$this->setting,$this->json_array['otp_receive_dt']);
				if ($rs['status'] != FALSE) {
					//$this->user_model->sigin_success_log($rs, 'api');
					//$resp_array = array('status' => TRUE);
					//$resp_array += array('userdata' => $rs['userdata']);
					//$resp_array += array('message'=>my_caption('api_otp_verified_successfull'));
				
				    array_push($obj,array("userdata"=>$rs['userdata']));
				    $resp_array = array(
					  'status' => TRUE,
					  'msg' => my_caption('api_otp_verified_successfull'),
					  'data'=> $obj
					);
				    
				}
				else {
					my_throttle_log($this->json_array['mobile']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_verify_otp'),
					  'data'=> $obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	}
	
	/*
	*   APP USER ACCOUNT DETAILS
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	
	public function app_user_account_details_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
                            $useriddd=$this->db->query("select * from user where id='".$this->json_array['from_userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0 && $this->json_array['from_userid'] != $this->json_array['userid'])
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['from_userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['from_userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['from_userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 9;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                        $str = explode(',',$user_consumption->type_id);
                                       if(!in_array($this->json_array['userid'], $str) && $user_consumption->used_count == $pf_info->count_allowed && $this->json_array['from_userid'] != $this->json_array['userid'])
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{
				$rs = $this->user_model->get_app_user_account_details($this->json_array['userid'],$this->json_array['from_userid']);
				if ($rs != FALSE) {
					//$this->user_model->sigin_success_log($rs, 'api');
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_user_account_details_fileds_builder($rs);
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
				      'data'=>$this->user_model->get_app_user_account_details_fileds_builder($rs)
					);
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Record Found',
				      'data'=>$obj
					);
				}
            }}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	/*
	*   APP GET ALL PLAN DETAILS
	*   REQUEST PARAMETER :- 
	*   METHOD:- GET
	*/
	
	public function app_get_employee_data_get(){
	    
	    $obj = array();
	    
	         $getemployee = $this->db->get('employee')->result();
			
			 foreach($getemployee as $valemployee)
			 {
			     $data_array[] = array('id'=>$valemployee->id,'title'=>$valemployee->title);
			 }
			
				if ($getemployee) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $data_array
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
	
	
	
	public function app_get_all_plan_get(){
	    
	    $obj = array();
	    
	         $rs = $this->user_model->get_all_plan_details();
				if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $this->user_model->get_app_get_all_plan_details_fileds_builder($rs),
					  'cover_image'=>!empty($this->setting->membership_image)?base_url($this->setting->membership_image):""
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
	
	
	public function app_get_membership_plan_get(){
	    
	    $obj = array();
	    
	         $rs = $this->user_model->get_membership_plan_details();
				if ($rs != FALSE) {
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $this->user_model->get_app_get_membership_plan_details_fileds_builder($rs)
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
	
	/*
	*   APP GET APP USER MEMBERSHIP DETAILS
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	
	
	
	
	
	
	public function app_user_membership_details_post(){
	    
	    $obj = array();
	    
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj,
				);
			}
			else {
				$rs = $this->user_model->get_app_user_membership_details($this->json_array['userid']);
				if ($rs != FALSE) {
					//$this->user_model->sigin_success_log($rs, 'api');
					//$resp_array = array('status' => TRUE);
				//	$resp_array += $this->user_model->get_app_user_membership_details_fileds_builder($rs);
				
				$resp_array_data = $this->user_model->get_app_user_membership_details_fileds_builder($rs,$this->json_array['userid']);
				$resp_array = array(
				  'status' => TRUE,
				  'msg' => 'Record Found',
				  'data' => $resp_array_data,
				);
				
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg'=> 'Something Wrong',
					  'data' => $rs,
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' => $obj,
			);
		}
		$this->response($resp_array, 200);
	    
	    
	}
	
	/*
	*   APP GET APP USER EDIT PROFILE
	*   REQUEST PARAMETER :- (userid,company_name,company_address,countryid,stateid,cityid,pin_code,about_company,business_entity,business_type,
	*   working_from,no_of_employees,turn_over,target_audiance,membership_title,company_profile,company_ppt,vcard_front,vcard_back,company_facebook,
	*   company_linkedin,company_instagram,company_twitter,company_youtube,company_skype)
	*   METHOD:- POST
	*/
	
	   
	
	
	
	public function app_user_edit_profile_post(){
	    
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['company_profile'], 'Company Profile URL', 'trim|prep_url');
			   if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_ppt'], 'Company PPT URL', 'trim|prep_url');
			  
			    }
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['vcard_front'], 'Vcard Front URL', 'trim|prep_url');
			  
			    }
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['vcard_back'], 'Vcard Back URL', 'trim|prep_url');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_facebook'], 'Company Facebook URL', 'trim|prep_url');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_linkedin'], 'Company Linkedin URL', 'trim|prep_url');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_instagram'], 'Company Instragram URL', 'trim|prep_url');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_twitter'], 'Company Twitter URL', 'trim|prep_url');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_youtube'], 'Company Youtube URL', 'trim|prep_url');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['company_skype'], 'Company Skype URL', 'trim|prep_url');
			  
			    }
			    
			    
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->update_user_profile($this->json_array);
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'message' => "Profile update successfully"
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'error' => "Profile not updated"
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'error' => $validate_res['message']
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	}
	
	/*
	*   APP GET APP VIEW PROFILE
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	
	public function app_user_view_profile_post(){
	    
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
				$rs = $this->user_model->get_app_user_view_profile($this->json_array['userid']);
				if ($rs != FALSE) {
					$resp_array = array('status' => TRUE);
					$resp_array += $this->user_model->get_app_user_view_profile_fileds_builder($rs);
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'error' => $rs
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	   
	}
	
	/*
	*   APP GET APP SUBSCRIBER
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	
	public function app_get_subscribe_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
				$rs = $this->user_model->get_app_get_subscribe($this->json_array['userid']);
				if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_subscribe_fileds_builder($rs);
					$resp_array = array(
				  'status' => TRUE,
				  'msg' => 'Record Found',
				  'data' => $this->user_model->get_app_get_subscribe_fileds_builder($rs)
				);
					
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'error' => $rs
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	/*
	*   APP GET APP CURRENT MEMBERSHIP
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	
	public function app_get_current_membership_post(){
	    $obj = array();
	    
	     $this->json_array=$_POST;
    	    if (isset($this->json_array['userid'])) {
    		    $throttle_check = my_throttle_check($this->json_array['userid']);
    			if (!$throttle_check['result'] && $this->throttle_switch) {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $throttle_check['message'],
    				  'data' => $obj
    				);
    			}
    			else {
    				$rs = $this->user_model->get_app_get_subscribe($this->json_array['userid']);
    				if ($rs != FALSE) {
    					//$resp_array = array('status' => TRUE);
    					//$resp_array += $this->user_model->get_app_get_subscribe_fileds_builder($rs);
    					
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => 'Record Found',
    				      'data' => $this->user_model->get_app_user_membership_details_fileds_builder($rs,$this->json_array['userid'])
    					);
    					
    				}
    				else {
    					my_throttle_log($this->json_array['userid']);
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => 'Something Wrong',
    				      'data' => $rs
    					);
    				}
    			}
    		}
    		else {
    			$resp_array = array(
    			  'status' => FALSE,
    			  'msg' => my_caption('api_incomplete_parameter'),
    			  'data' => $obj
    			);
    		}
		$this->response($resp_array, 200);
	    
	}
	
	/*
	*   APP GET APP CURRENT MEMBERSHIP
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	
	public function app_get_renew_membership_post(){           // type  1 for upgrade and 2 for renew
	    $obj = array();
	    $this->json_array=$_POST;
    	    if (isset($this->json_array['userid']) &&  isset($this->json_array['startdate']) && isset($this->json_array['membership_id']) && isset($this->json_array['transactionid']) && isset($this->json_array['transationamount']) && isset($this->json_array['transationdatetime']) && isset($this->json_array['transationpaymenttype'])){ 
    		    $throttle_check = my_throttle_check($this->json_array['userid']);
    			if (!$throttle_check['result'] && $this->throttle_switch) {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $throttle_check['message'],
    				  'data' => $obj
    				);
    			}
    			else {
    				$rs = $this->user_model->get_app_get_renew_membership_update($this->json_array);
    				if ($rs==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Membership Renew successfully",
    					  'data' => $obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Membership not Renew",
    					  'data' => $obj
    					);
    				}
    			}
    		}
    		else {
    			$resp_array = array(
    			  'status' => FALSE,
    			  'msg' => my_caption('api_incomplete_parameter'),
    			  'data' => $obj
    			);
    		}
		$this->response($resp_array, 200);
	}
	
	
	
	public function app_get_upgrade_membership_post(){           // type  1 for upgrade and 2 for renew
	    $obj = array();
	    $this->json_array=$_POST;
    	    if (isset($this->json_array['userid']) && isset($this->json_array['membership_id']) && isset($this->json_array['transactionid']) && isset($this->json_array['transationamount']) && isset($this->json_array['transationdatetime']) && isset($this->json_array['transationpaymenttype'])){ 
    		    $throttle_check = my_throttle_check($this->json_array['userid']);
    			if (!$throttle_check['result'] && $this->throttle_switch) {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $throttle_check['message'],
    				  'data' => $obj
    				);
    			}
    			else {
    				$rs = $this->user_model->get_app_get_upgrade_membership_update($this->json_array);
    				if ($rs==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Membership upgraded successfully",
    					  'data' => $obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Membership not upgraded",
    					  'data' => $obj
    					);
    				}
    			}
    		}
    		else {
    			$resp_array = array(
    			  'status' => FALSE,
    			  'msg' => my_caption('api_incomplete_parameter'),
    			  'data' => $obj
    			);
    		}
		$this->response($resp_array, 200);
	}
	
	/*
	*   APP GET APP USER BASIC INFO
	*   REQUEST PARAMETER :- (userid)
	*   METHOD:- POST
	*/
	public function app_user_basicinfo_view_post(){
	     $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
				$rs = $this->user_model->get_app_user_basicinfo_view($this->json_array['userid']);
				if ($rs != FALSE) {
					$resp_array = array('status' => TRUE);
					$resp_array += $this->user_model->get_app_user_basicinfo_view_fileds_builder($rs);
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'error' => $rs
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	/*
	*   APP GET APP USER EDIT PROFILE PICTURE
	*   REQUEST PARAMETER :- (userid,profile_pic)
	*   METHOD:- POST
	*/
	
	public function app_user_edit_profile_pic_post(){
	    //$this->load->library('session');
	    
	    $this->json_array=$_POST;
	    
    	    if (isset($this->json_array['userid']) && isset($_FILES) ){
    		    $throttle_check = my_throttle_check($this->json_array['userid']);
    			if (!$throttle_check['result'] && $this->throttle_switch) {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'error' => $throttle_check['message']
    				);
    			}
    			else {
    			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->result();
            		$this->session->set_userdata('api_user_ids', $useriddd[0]->ids);		
    			      if ($_FILES['profile_pic']['name'] != '') {
            				$validate_res=my_validate_data('profile_pic', 'Upload File', 'callback_avatar_upload');
            				//GET USER ID
            				$avatar_file = $useriddd[0]->ids.'.'.pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
            				
            		}
            		
            		
            		$config = array();
                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'avatar/' ;
                        $config['allowed_types'] = '*'; //'gif|jpg|png';
                        $config['encrypt_name']  = TRUE;
                        $config['file_name'] = $avatar_file;
                        //$config['max_size'] = 100;
                        //$config['max_width'] = 1024;
                        //$config['max_height'] = 768;
                        $this->load->library('upload',$config);
                        if ( ! $this->upload->do_upload('profile_pic')) {
                            $error = array('error' => $this->upload->display_errors());
                            
                            $upload=array('status'=>FALSE);
                        } else {
                            //Action, after file successfully uploaded
                            $upload_data = $this->upload->data();
                            $filename=$upload_data['file_name'];
                            $upload=array('status'=>TRUE);
                        }
            		
            		
            		if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
            		    
            		     
            		    
            		    
        				my_throttle_log('');
        				$res = $this->user_model->update_user_edit_profile_pic($this->json_array,$filename);
        				if ($res==TRUE) {
        				    
        				      //firebase insertion
			    $user_info = $this->db->where('id',$this->json_array['userid'])->get('user')->row();
//			    if(!empty($user_info->firebase_uid))
//			    {
//				    $this->load->library('firebase');
//                    $factory = $this->firebase->init();
//                    $db = $factory->getDatabase();
//                    $auth = $factory->getAuth();
//                    if(empty($user_info->avatar))
//        {
//        $avatar = 'https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_user_img.png?alt=media&token=d65a3232-b36d-4386-8814-c23986808d83';
//        $avatar1 = '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\n';
//        }else{
//        $avatar = base_url('upload/avatar/'.$user_info->avatar);
//        $avatar1 = base64_encode(file_get_contents($avatar));
//        }
//                    //$dname = $user_info->first_name." ".$user_info->last_name;
//                    $fdata = [
//                        //'name' => $dname,
//                        'photo' => $avatar,
//                        'thumbImg' => $avatar1
//                    ];
//                    $ref = "users/".$user_info->firebase_uid."/";
//                    $properties = [
//                    //'displayName' => $dname,
//                    'photoUrl' => $avatar
//                    ];
//                
//                $updatedUser = $auth->updateUser($user_info->firebase_uid, $properties);
//                        $postdata = $db->getReference($ref)->update($fdata);
//			    }
        				    
        				    
        				    
        					$resp_array = array(
        					  'status' => TRUE,
        					  'profile_pic'=>base_url().$this->config->item('my_upload_directory') . 'avatar/'.$filename ,
        					  'message' => "Profile picture update successfully",
        					  
        					);
        				}
        				else {
        					$resp_array = array(
        					  'status' => FALSE,
        					  'error' => "Profile picture not updated1"
        					);
        				}
        			}else if($validate_res['status']==TRUE && $upload['status'] == FALSE){
        			    
        			    $resp_array = array(
        					  'status' => FALSE,
        					  'error' => "Profile picture not updated"
        					);
        			    
        			}
        			else {
        				$resp_array = array(
        				  'status' => FALSE,
        				  'error' => $validate_res['message']
        				);
        			}
    			}
    		}
    		else {
    			$resp_array = array(
    			  'status' => FALSE,
    			  'error' => my_caption('api_incomplete_parameter')
    			);
    		}
		$this->response($resp_array, 200);
	}
	
	public function avatar_upload() {
		$this->load->library('m_upload');
		$this->m_upload->set_upload_path('/' . '/' . $this->config->item('my_upload_directory') . 'avatar/');
		$this->m_upload->set_allowed_types('png|gif|jpg|jpeg|pdf');
		$this->m_upload->set_file_name($_SESSION['api_user_ids']);
		//$this->my_upload->set_remove_file();
		$res = $this->m_upload->upload_done();
		if ($res['status']) {
		    $this->session->unset_userdata('api_user_ids');
		    $resss=array("status"=>TRUE,"message"=>"upload");
			return $resss;
		}
		else {
			//$this->form_validation->set_message('avatar_upload', $res['error']);
			$this->session->unset_userdata('api_user_ids');
			 $resss=array("status"=>FALSE,"message"=>"not upload");
		
			return $resss;
		}
	}
	
	
	/*
	*   APP GET APP USER EDIT BASIC INFO PART 1
	*   REQUEST PARAMETER :- (userid,fname,lname,dob,blood_group,designation)
	*   METHOD:- POST
	*/
	
	public function app_user_edit_basicinfo_part1_post(){
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && isset($this->json_array['fname']) && isset($this->json_array['lname']) && isset($this->json_array['gender']) && isset($this->json_array['dob']) && isset($this->json_array['blood_group']) && isset($this->json_array['designation']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			   if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['fname'], 'First Name', 'trim|required|max_length[50]');
			  
			    }
			   if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['lname'], 'Last Name', 'trim|required|max_length[50]');
			  
			    }
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['gender'], 'Gender', 'trim|required');
			  
			    }
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['dob'], 'Date of Birth', 'trim|required');
			  
			    }
			    
			    if ($validate_res['status']) {
			    	$validate_res = my_validate_data($this->json_array['blood_group'], 'Blood Group', 'trim|required');
			  
			    }
			    
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->update_user_profile_basic_part1($this->json_array);
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'message' => "Profile update successfully"
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'error' => "Profile not updated"
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'error' => $validate_res['message']
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
	/*
	*   APP GET APP USER EDIT BASIC INFO PART 2
	*   REQUEST PARAMETER :- (userid,email,mobile,address,countryid,stateid,cityid,pin_code,wmobile,landline)
	*   METHOD:- POST
	*/
	
	
	public function app_user_edit_basicinfo_part2_post(){
	    
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->update_user_profile_basic_part2($this->json_array);
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'message' => "Profile update successfully"
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'error' => "Profile not updated"
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'error' => $validate_res['message']
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	    
	}
	
        public function app_user_delete_company_profile_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {		
    				
    				$res = $this->db->where('id',$this->json_array['userid'])->set('company_profile','')->update('user');
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Company Profile delete successfully",
    					  'data'=>$obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Company Profile not deleted",
    					  'data'=>$obj
    					);
    				}
    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    					  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	}
        
        public function app_user_delete_company_ppt_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {		
    				
    				$res = $this->db->where('id',$this->json_array['userid'])->set('company_ppt','')->update('user');
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Company ppt delete successfully",
    					  'data'=>$obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Company ppt not deleted",
    					  'data'=>$obj
    					);
    				}
    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    					  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	}
        
        public function app_user_delete_vcard_front_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {		
    				
    				$res = $this->db->where('id',$this->json_array['userid'])->set('vcard_front','')->update('user');
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Delete successfully",
    					  'data'=>$obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Not deleted",
    					  'data'=>$obj
    					);
    				}
    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    					  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	}
        
        public function app_user_delete_vcard_back_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {		
    				
    				$res = $this->db->where('id',$this->json_array['userid'])->set('vcard_back','')->update('user');
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Delete successfully",
    					  'data'=>$obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Not deleted",
    					  'data'=>$obj
    					);
    				}
    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    					  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	}
        
	public function app_user_edit_profile_about_post(){
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				
//    				if ($_FILES['pdf_file']['name'] != '')
//            	    {
//                    	$validate_res=my_validate_data('pdf_file', 'Upload File', 'callback_avatar_upload');
//                    	$avatar_file = $user['userid'].'.'.pathinfo($_FILES['pdf_file']['name'], PATHINFO_EXTENSION);
//                    }
//			        
//			         $config = array();
//                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
//                        $config['allowed_types'] = '*'; //'gif|jpg|png';
//                        $config['encrypt_name']  = TRUE;
//                        $config['file_name'] = $avatar_file;
//                        //$config['max_size'] = 100;
//                        //$config['max_width'] = 1024;
//                        //$config['max_height'] = 768;
//                        $this->load->library('upload',$config);
//                        if ( ! $this->upload->do_upload('rerquirement_thumbnail')) {
//                            $error = array('error' => $this->upload->display_errors());
//                            
//                            $upload=array('status'=>FALSE);
//                        } else {
//                            //Action, after file successfully uploaded
//                            $upload_data = $this->upload->data();
//                            $filename=$upload_data['file_name'];
//                            $upload=array('status'=>TRUE);
//                        }
    				
    				$res = $this->user_model->update_app_user_edit_profile_about($this->json_array);
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Profile About update successfully",
    					  'data'=>$obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Profile about not updated",
    					  'data'=>$obj
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $validate_res['message'],
    					  'data'=>$obj
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    					  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	}
	
	public function app_user_edit_profile_contact_post(){
	    
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->update_app_user_edit_profile_contact($this->json_array);
    				if ($res==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'message' => "Profile Contact update successfully"
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'error' => "Profile contact not updated"
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'error' => $validate_res['message']
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
	}
	
	
    public function app_user_view_profile_contact_post(){
         $obj = array();
         $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
				$rs = $this->user_model->get_app_user_view_profile_contact($this->json_array['userid']);
				if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_user_view_profile_contact_fileds_builder($rs);
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
				      'data'=>$this->user_model->get_app_user_view_profile_contact_fileds_builder($rs)
					);
					
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Record Found',
				      'data'=>$obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				      'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }	
    
    public function app_user_view_profile_about_post(){
         $obj = array();
         $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
				$rs = $this->user_model->get_app_user_view_profile($this->json_array['userid']);  //print_r($rs);exit();
				if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_user_view_profile_about_fileds_builder($rs);
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
				      'data'=>$this->user_model->get_app_user_view_profile_about_fileds_builder($rs)
					  
					);
					
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Record Found',
				      'data'=>$rs
					  
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$rs
			);
		}
		$this->response($resp_array, 200);
    }
    
    public function social_login_post(){
        
        $obj = array();
        $this->json_array=$_POST;
		
		if (isset($this->json_array['socialid']) && isset($this->json_array['social_type']) && isset($this->json_array['device_type']) && isset($this->json_array['device_token'])) {    // isset($this->json_array['email']) &&
		    $throttle_check = my_throttle_check($this->json_array['email']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    //check email exist or not
			    
			    if($this->json_array['email'] != '')
			    {
			        $checkemails = $this->user_model->check_email_exist($this->json_array['email']);
			        
			        if($checkemails['status']==TRUE)
			        {
			            $type=$this->json_array['social_type'];
    			        $this->user_model->sigin_success_log($rs, "$type");
    					//$resp_array = array('status' => TRUE);
    					//$resp_array += array('user_id'=>$rsss['user_id']);
    			        	
    			        	$device_data = array('device_type' => $this->json_array['device_type'],'device_token' => $this->json_array['device_token']);
    			        	
    			        	$this->db->where('id',$checkemails['user_id']);
    			        	$this->db->update('user',$device_data);
    			        	//echo $this->db->last_query();
    			        	
    			        	
    			        	$check_in_usertble=$this->db->query("select * from user where id='".$checkemails['user_id']."'")->row();
    	       	            $get_role_type = $this->db->select('name')->where('ids',$check_in_usertble->role_ids)->get('role')->row();
        	                $get_area_name = $this->db->select('functional_area')->where('functional_area_id',$check_in_usertble->business_category)->get('tbl_functional_area')->row();
        	                $get_turn_over= $this->db->select('turn_over_value')->where('turn_over_id',$check_in_usertble->turn_over)->get('turn_over')->row();
            	               
            	               
            	               $data_user = array(
            	                    "id"=> $check_in_usertble->id,
                                    "ids"=> $check_in_usertble->ids,
                                    "username"=> $check_in_usertble->username,
                                    "api_key"=> $check_in_usertble->api_key,
                                    "email_address"=> $check_in_usertble->email_address,
                                    "signup_source"=> $check_in_usertble->signup_source,
                                    "signup_socialid"=> $check_in_usertble->signup_socialid,
                                    "prefix"=> $check_in_usertble->prefix,
                                    "first_name"=> $check_in_usertble->first_name,
                                    "middle_name"=> $check_in_usertble->middle_name,
                                    "last_name"=> $check_in_usertble->last_name,
                                    "gender"=> $check_in_usertble->gender,
                                    "dob"=> $check_in_usertble->dob,
                                    "blood_group"=> $check_in_usertble->blood_group,
                                    "designation"=> $check_in_usertble->designation,
                                    "wmobile"=> $check_in_usertble->wmobile,
                                    "landline"=> $check_in_usertble->landline,
                                    "company"=> $check_in_usertble->company,
                                    "total_experience"=> $check_in_usertble->total_experience,
                                    "company_address"=> $check_in_usertble->company_address,
                                    "company_contact"=> $check_in_usertble->company_contact,
                                    "about_company"=> $check_in_usertble->about_company,
                                    "business_entity"=> $check_in_usertble->business_entity,
                                    "business_category_id"=> $check_in_usertble->business_category,
                                    "business_category_name"=> $get_area_name->functional_area,              
                                    "business_experties"=> $check_in_usertble->business_experties,
                                    "business_type"=> $check_in_usertble->business_type,
                                    "working_from"=> $check_in_usertble->working_from,
                                    "no_of_employees"=> $check_in_usertble->no_of_employees,
                                    "turn_over"=> $check_in_usertble->turn_over,
                                    "turn_over_value"=> $get_turn_over->turn_over_value,
                                    "target_audiance"=> $check_in_usertble->target_audiance,
                                    "company_profile"=> $check_in_usertble->company_profile,
                                    "company_ppt"=> $check_in_usertble->company_ppt,
                                    "vcard_front"=> $check_in_usertble->vcard_front,
                                    "vcard_back"=> $check_in_usertble->vcard_back,
                                    "company_google"=> $check_in_usertble->company_google,
                                    "company_facebook"=> $check_in_usertble->company_facebook,
                                    "company_linkedin"=> $check_in_usertble->company_linkedin,
                                    "company_instagram"=> $check_in_usertble->company_instagram,
                                    "company_twitter"=> $check_in_usertble->company_twitter,
                                    "company_youtube"=> $check_in_usertble->company_youtube,
                                    "company_skype" => $check_in_usertble->company_skype,
                                    "avatar"=> $check_in_usertble->avatar,
                                    "timezone"=> $check_in_usertble->timezone,
                                    "date_format"=> $check_in_usertble->date_format,
                                    "time_format"=> $check_in_usertble->time_format,
                                    "language"=> $check_in_usertble->language,
                                    "currency"=> $check_in_usertble->currency,
                                    "country"=> $check_in_usertble->country,
                                    "address_line_1"=> $check_in_usertble->address_line_1,
                                    "address_line_2"=> $check_in_usertble->address_line_2,
                                    "city"=> $check_in_usertble->city,
                                    "state"=> $check_in_usertble->state,
                                    "zip_code"=> $check_in_usertble->zip_code,
                                    "role_ids"=> $check_in_usertble->role_ids,
                                    "role_types"=> $get_role_type->name,
                                    "status"=> $check_in_usertble->status,
                                    "created_time"=> $check_in_usertble->created_time,
                                    "update_time"=> $check_in_usertble->update_time,
                                    "login_success_detail"=> $check_in_usertble->login_success_detail,
                                    "company_number"=> $check_in_usertble->company_number,
                                    "tax_number"=> $check_in_usertble->tax_number,
                                    "otp"=> $check_in_usertble->otp,
                                    "packages_id"=> $check_in_usertble->packages_id,
                                    "packages_startDate"=> $check_in_usertble->packages_startDate,
                                    "packages_endDate"=> $check_in_usertble->packages_endDate,
                                    "website"=> $check_in_usertble->website,
                                    "referral_code"=> $check_in_usertble->referral_code,
                                    "login_type"=> $check_in_usertble->login_type,
                                    "membership_type"=> $check_in_usertble->membership_type,
                                    "device_type"=> $check_in_usertble->device_type,
                                    "device_token"=> $check_in_usertble->device_token,
                                    "notification_count" => $this->user_model->app_get_notification_count($check_in_usertble->id)
        	                );
    			        	
    			        	array_push($obj,array("userdata"=>$data_user));
    			        	$resp_array = array(
        					  'status' => TRUE,
        					  'msg'=>'Login Successfully',
        					  'data' =>	$obj
        					);
    			        }
			        
			        else
    			    {
    			        
    			        //sign up
    			        $type=$this->json_array['social_type'];
    			        $res = $this->user_model->save_social_user_info($this->setting, "$type", $this->json_array);
        				if ($res['result']==TRUE) {
        					
        					
        					$check_in_usertble=$this->db->query("select * from user where id='".$res['lastuserid']."'")->row();
    	       	            //$messagg=array("status"=>TRUE,"userdata"=>$check_in_usertble);
    			        	
    			        	$device_data = array('device_type' => $this->json_array['device_type'],'device_token' => $this->json_array['device_token']);
    			        	
    			        	$this->db->where('id',$res['lastuserid']);
    			        	$this->db->update('user',$device_data);
    			        //	echo $this->db->last_query();
    			        	
    			        	
    			        	$get_role_type = $this->db->select('name')->where('ids',$check_in_usertble->role_ids)->get('role')->row();
        	                $get_area_name = $this->db->select('functional_area')->where('functional_area_id',$check_in_usertble->business_category)->get('tbl_functional_area')->row();
        	                $get_turn_over= $this->db->select('turn_over_value')->where('turn_over_id',$check_in_usertble->turn_over)->get('turn_over')->row();
            	               
            	               
            	               $data_user = array(
            	                    "id"=> $check_in_usertble->id,
                                    "ids"=> $check_in_usertble->ids,
                                    "username"=> $check_in_usertble->username,
                                    "api_key"=> $check_in_usertble->api_key,
                                    "email_address"=> $check_in_usertble->email_address,
                                    "signup_source"=> $check_in_usertble->signup_source,
                                    "signup_socialid"=> $check_in_usertble->signup_socialid,
                                    "prefix"=> $check_in_usertble->prefix,
                                    "first_name"=> $check_in_usertble->first_name,
                                    "middle_name"=> $check_in_usertble->middle_name,
                                    "last_name"=> $check_in_usertble->last_name,
                                    "gender"=> $check_in_usertble->gender,
                                    "dob"=> $check_in_usertble->dob,
                                    "blood_group"=> $check_in_usertble->blood_group,
                                    "designation"=> $check_in_usertble->designation,
                                    "wmobile"=> $check_in_usertble->wmobile,
                                    "landline"=> $check_in_usertble->landline,
                                    "company"=> $check_in_usertble->company,
                                    "total_experience"=> $check_in_usertble->total_experience,
                                    "company_address"=> $check_in_usertble->company_address,
                                    "company_contact"=> $check_in_usertble->company_contact,
                                    "about_company"=> $check_in_usertble->about_company,
                                    "business_entity"=> $check_in_usertble->business_entity,
                                    "business_category_id"=> $check_in_usertble->business_category,
                                    "business_category_name"=> $get_area_name->functional_area,              
                                    "business_experties"=> $check_in_usertble->business_experties,
                                    "business_type"=> $check_in_usertble->business_type,
                                    "working_from"=> $check_in_usertble->working_from,
                                    "no_of_employees"=> $check_in_usertble->no_of_employees,
                                    "turn_over"=> $check_in_usertble->turn_over,
                                    "turn_over_value"=> $get_turn_over->turn_over_value,
                                    "target_audiance"=> $check_in_usertble->target_audiance,
                                    "company_profile"=> $check_in_usertble->company_profile,
                                    "company_ppt"=> $check_in_usertble->company_ppt,
                                    "vcard_front"=> $check_in_usertble->vcard_front,
                                    "vcard_back"=> $check_in_usertble->vcard_back,
                                    "company_google"=> $check_in_usertble->company_google,
                                    "company_facebook"=> $check_in_usertble->company_facebook,
                                    "company_linkedin"=> $check_in_usertble->company_linkedin,
                                    "company_instagram"=> $check_in_usertble->company_instagram,
                                    "company_twitter"=> $check_in_usertble->company_twitter,
                                    "company_youtube"=> $check_in_usertble->company_youtube,
                                    "company_skype" => $check_in_usertble->company_skype,
                                    "avatar"=> $check_in_usertble->avatar,
                                    "timezone"=> $check_in_usertble->timezone,
                                    "date_format"=> $check_in_usertble->date_format,
                                    "time_format"=> $check_in_usertble->time_format,
                                    "language"=> $check_in_usertble->language,
                                    "currency"=> $check_in_usertble->currency,
                                    "country"=> $check_in_usertble->country,
                                    "address_line_1"=> $check_in_usertble->address_line_1,
                                    "address_line_2"=> $check_in_usertble->address_line_2,
                                    "city"=> $check_in_usertble->city,
                                    "state"=> $check_in_usertble->state,
                                    "zip_code"=> $check_in_usertble->zip_code,
                                    "role_ids"=> $check_in_usertble->role_ids,
                                    "role_types"=> $get_role_type->name,
                                    "status"=> $check_in_usertble->status,
                                    "created_time"=> $check_in_usertble->created_time,
                                    "update_time"=> $check_in_usertble->update_time,
                                    "login_success_detail"=> $check_in_usertble->login_success_detail,
                                    "company_number"=> $check_in_usertble->company_number,
                                    "tax_number"=> $check_in_usertble->tax_number,
                                    "otp"=> $check_in_usertble->otp,
                                    "packages_id"=> $check_in_usertble->packages_id,
                                    "packages_startDate"=> $check_in_usertble->packages_startDate,
                                    "packages_endDate"=> $check_in_usertble->packages_endDate,
                                    "website"=> $check_in_usertble->website,
                                    "referral_code"=> $check_in_usertble->referral_code,
                                    "login_type"=> $check_in_usertble->login_type,
                                    "membership_type"=> $check_in_usertble->membership_type,
                                    "device_type"=> $check_in_usertble->device_type,
                                    "device_token"=> $check_in_usertble->device_token,
                                    "notification_count" => $this->user_model->app_get_notification_count($check_in_usertble->id)
        	                );
    			        	
    			        	array_push($obj,array("userdata"=>$data_user));
    			        	$resp_array = array(
        					  'status' => TRUE,
        					  'msg'=>'Register Successfully',
        					  'data' =>	$obj
        					);
        					
        				
        				//	$resp_array += array('user_id'=>$res['user_id']);
        				}
        				else {
        					$resp_array = array(
        					  'status' => FALSE,
        					  'msg'=>'Something Wrong',
        					  'data' =>	$obj
        					);
        				}
    			        
    			        
    			    }
			        
			        
			    }
			    else
			    {
			    
			    
			    
			    
			    
			    $rsss = $this->user_model->check_socialid_exist($this->json_array['socialid']);
			    if($rsss['status']==TRUE){
			        
			        $type=$this->json_array['social_type'];
			        $this->user_model->sigin_success_log($rs, "$type");
					//$resp_array = array('status' => TRUE);
					//$resp_array += array('user_id'=>$rsss['user_id']);
			        	
			        	$check_in_usertble=$this->db->query("select * from user where id='".$rsss['user_id']."'")->row();
	       	            //$messagg=array("status"=>TRUE,"userdata"=>$check_in_usertble);
			        	
			        	array_push($obj,array("userdata"=>$check_in_usertble));
			        	$resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Login Successfully',
    					  'data' =>	$obj
    					);
			        
			    }
			    else
			    {
			        
			        //sign up
			        $type=$this->json_array['social_type'];
			        $res = $this->user_model->save_social_user_info($this->setting, "$type", $this->json_array);
    				if ($res['result']==TRUE) {
    					
    					
    					$check_in_usertble=$this->db->query("select * from user where id='".$res['lastuserid']."'")->row();
	       	            //$messagg=array("status"=>TRUE,"userdata"=>$check_in_usertble);
			        	
			        	array_push($obj,array("userdata"=>$check_in_usertble));
			        	$resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Register Successfully',
    					  'data' =>	$obj
    					);
    					
    				
    				//	$resp_array += array('user_id'=>$res['user_id']);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg'=>'Something Wrong',
    					  'data' =>	$obj
    					);
    				}
			        
			        
			    }
			    
			    }
				
			}
		}
		else {
			$resp_array = array(
			  'status' => TRUE,
    		  'msg'=> my_caption('api_incomplete_parameter'),
    		  'data' =>	$this->json_array()
			  
			  
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function connection_request_sent_post(){
        $obj = array();
        
          $this->json_array=$_POST;
		if (isset($this->json_array['userid']) && isset($this->json_array['receiverid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>6))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>6,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 6;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{    
			    $rschk=$this->user_model->check_connection_sent_or_not($this->json_array['userid'], $this->json_array['receiverid']);
			    if($rschk==FALSE){
			        
			        //sent connection
			        $sent_ml=$this->user_model->sent_connection_rest($this->json_array['userid'], $this->json_array['receiverid']);
			        if($sent_ml==TRUE){
			            
			            $resp_array = array(
    					  'status' => TRUE,
    					  'msg' => my_caption('connection_sent_first'),
    					  'data' => $this->json_array,
    					 
    					);
			            
			        }else{
			            
			            $resp_array = array(
    					  'status' => FALSE,
    					  'msg' => my_caption('connection_not_sent'),
    					  'data' => $this->json_array,
    					  
    					);
			        }
			        
			    }else{
			        
			        $resp_array = array(
					  'status' => TRUE,
					  'msg' => my_caption('connection_sent'),
					  'data' => $this->json_array,
					  
					);
			        
			        
			    }
			    
                }}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj()
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
     public function app_user_add_membership_details_post(){  
	    $this->json_array=$_POST;
	    $obj = array();
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
    			  'data' =>$obj
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->update_app_user_add_membership_details($this->json_array);
    				if ($res==TRUE) {
    					
    					$user_info = $this->db->where('id',$this->json_array['userid'])->get('user')->row();
//				   if(!empty($user_info)){
//				    //firebase insertion
//				    $this->load->library('firebase');
//        $factory = $this->firebase->init();
//        $db = $factory->getDatabase();
//        $auth = $factory->getAuth();
//        
//        if(empty($user_info->avatar))
//        {
//        $avatar = 'https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_user_img.png?alt=media&token=d65a3232-b36d-4386-8814-c23986808d83';
//        $avatar1 = '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\n';
//        }else{
//        $avatar = base_url('upload/avatar/'.$user_info->avatar);
//        $avatar1 = base64_encode(file_get_contents($avatar));
//        }
//        //$email1 = 'radhesh.applex360@gmail.com';
//        $mobile1 = '+91'.$user_info->phone;
//        $pass = 'Applex@2021';
//        $dname = $user_info->first_name;
//        if(!empty($user_info->middle_name))
//        {
//        $dname .= " ".$user_info->middle_name;
//        }
//        $dname .= " ".$user_info->last_name;
//        
//        $fdata = [
//            'name' => $dname,
//            'phone' => $mobile1,
//          'photo' => $avatar,
//          'status' => 'Hey I am using J4E App',
//          'thumbImg' => $avatar1,
//          'designation' => $user_info->designation,
//          'email' => $user_info->email_address,
//          'company_name' => $user_info->company,
//          'company_address' => $user_info->company_address,
//          'ver' => '1.0'
//          
//        ];
//        // print_r($fdata);die;
//        $ref = "users/";
//       try{
//            $postdata = $db->getReference($ref)->push($fdata);
//            if($postdata)
//            {
//            $postKey = $postdata->getKey();
//            $userProperties = [
//                'uid' => $postKey,
//            'phoneNumber' => $mobile1,
//            'password' => $pass,
//            'displayName' => $dname,
//            'photoUrl' => $avatar,
//            'disabled' => false,
//        ];
//
//        $user = $auth->createUser($userProperties);
//       }else{
//           throw new Exception("Firebase Quota Exceeded");
//       }
//				    
//       }catch(Exception $e) {
//           $resp_array = array(
//    				  'status' => FALSE,
//    				  'msg' => $e->getMessage(),
//    				  'data' =>$obj
//    				);
//  //echo 'Message: ' .$e->getMessage();
//}
//				   }
    					
    					
    					
    					$res = $this->db->where('id',$user_info->id)->update('user',array('firebase_uid'=>$postKey));
    					if($res){
    					$check_in_usertble=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
	       	            
			        	array_push($obj,array("userdata"=>$check_in_usertble));
			        	$resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Membership details update successfully',
    					  'data' =>	$obj
    					);
    					}
    					
    					
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Membership details update successfully",
    					  'data' =>$obj
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $validate_res['message'],
    				  'data' =>$obj
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
        
    }
    
    
    
    public function app_user_edit_membership_details_post(){
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			   $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			    if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->update_app_user_edit_membership_details($this->json_array);
    				if ($res==TRUE) {
    				    
    				    //firebase insertion
			    $user_info = $this->db->where('id',$this->json_array['userid'])->get('user')->row();
//			    if(!empty($user_info->firebase_uid))
//			    {
//				    $this->load->library('firebase');
//                    $factory = $this->firebase->init();
//                    $db = $factory->getDatabase();
//                    $auth = $factory->getAuth();
//                    if(empty($user_info->avatar))
//        {
//        $avatar = 'https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_user_img.png?alt=media&token=d65a3232-b36d-4386-8814-c23986808d83';
//        $avatar1 = 'iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAAXNSR0IArs4c6QAAAARzQklUCAgI\nCHwIZIgAABC+SURBVHic7V1tjFxXeX7ec++d773r/Zrdnc2CnZBgYxKnRSkpLaGJWjW0EIEKSFUF\n+dNUJZEaIvqBWloZJKQU0bSlEnFoyo8ItcIqQaK0ShUaKhK1anGaEAxxs4FNM8Y7O/Z6Z2d3587c\nmXue/pg54/F4v3fmznWSR1rZc++Zc868z/l8z3POEUQcJK1isThOMmtZ1pjW+gjJwwAyAMa01geV\nUsdaYU+LyE8AXACwRnIOwGkRuVCpVM4fOnTogogEA/w520IGnYFukLQWFhauUUrdCOAXSB5TSmVI\nOq33LgAXAETEBpAynwGsAVgnWW+9XwWw0vpeo/X+BRF5Rmv9/enp6Z9GjaBIELK0tOQ2Go2DJG8F\n8EskjwE4KCJJACB5WT5FdpZtkpd9FhHzwCP5ioic1lp/x7Ks/7Rte35sbKy87x+zTwyMkPn5+UQy\nmTxG8iMAPiwis11B2tbsAyHAlb99AcDJRqPxtZmZmf8RkdqOEukxQiekWCxmtNbvI3k3gDcppUZJ\nDgNIdgUNm5AqgDKAJQB5EXnMtu1/CrvWhEbI3Nyc67ruHVrrewDcKCKTJGM7NW5YIAkRqQO4ICIv\naK0fjcfjT46Ojq6EkX7frUHSKhQKt4nIAwDeCWCi9VyAnZf2sGBqVUdtWiL5rG3bD54+ffqZ22+/\nvdHP9PtqjbNnzx6zbfshEbmB5IiIxElawNVDiIgEWmtfRFYAnFFKfTKbzT7Xr/T7Yo18Pp90HOd3\nAHwEwI1o9g9WGGn3EOz6rAF4AH4kIl8LguBELper9DrRnhvl7Nmz19i2/QUAtwOYEBForU1NiDoJ\nm4GtvsV8KInId7XW9+dyuf/rZUI9NVCxWHy31vqLAN4OQIkISKpepjFoiIhuNWsKwGkAn5iamvq3\nXsXfE2ORVAsLC/dprT9P8i2tfkJw9daIrSAiIiRB8hDJPy8UCvefPHmyu0neW+T7jWB+fj6RTqcf\n0Fp/FMAsmj6m1xPWARRIPjY1NfWgiPj7iWxfhLQ67z8DcB+aPqWelJKrEBpAheTDJI/vp7PfMyFL\nS0uu7/t/C+AuEYnvN76rHGZEViP5ZLVa/dihQ4dKe4loTwbM5/NJy7L+Til1B8nJdmQRm1OEhU4X\njYgsAXhaa/1be6kpu+7U5+bm4o7j/ImIfLCTjDfQBMkxAB+wLOv4qVOnnN1+f1eEHD9+XA0NDf0+\ngN/raKYgIq/b2gFc+ftbI7CPz87O3r/bYf+urLiwsHC3iPwRgBsAqKi6PwaFrqYrAPASgIempqYe\n3WkcO2avUCjcKCK/i+bQ1mqm+fquGd0w9mjZxELTVvcVi8WbdxzHTgLl8/lRx3GeIHlERF5v84x9\ngaSnlHpRa33n9PT0+e3Cb1tDWp34FwD8DIB0LzL5OkOC5E0i8pDRBWwFe7sArut+iOT7AFhKqStW\n4cJCq6NEvV6H7/uo1WpoNBqo1+uo1ZqrrbFY7Io/27YHOuhQSkFrbYnInYuLix8F8JWtwm+Zy3w+\nP+M4zkkAPw8028ju5dQwEAQB6vU6KpUKarUafN+H7/ttQur1OgDAcZz2nyEkHo8jmUzCcRxYVviO\nhKbbq73G8lyj0fjAzMxMfrPwW9UQcRznITTXMwS4co06DGitUa1WUS6XsbS0BN/3N81HJzlAs3TG\nYjGMjY3BdV0kk8nQa0pnASb5VsuyHib5/q71/TY27UOKxeLNIvIuAKlBNVMAUK1WUSqVcP78+S3J\n2Ahaa/i+j6WlJayurl5GVtho5TtB8l0LCws/u1m4DQkpFArpIAg+TXLELLmGDZLQWmN1dRUrKyuo\n1+t7qqFaa9RqNZTLZayurvYhpzsHSUtE0pZl/XE+n+9W2QDYhBCS7wHwbgAJYDATP5LwfR/r6+uo\nVqv7jsvzPKyvryMIgoE0vR0DC5vkbZZlvXejcFcQUiwWMwDuBTAxqNoBNDvycrmMWq3WEwPW63V4\nnodarQatdQ9yuGcoAONKqXvn5ubcjV5ehiAI3gvgpjBythVIolqtIgh6J70NgqBdSyKAI67r3tX9\n8DJCSDoicreIDNylbtr+XhNSqVQGWkPMfArARBAEvz03NxfvfH8ZIefOnbuF5LUkY2FmciOYPqSX\nxjMkD7jJAtAs/EqpWdd1LxtxXUaIUuoeANkuJ9lAQBKNRiMSxuslumw7rLX+WOf7NiGtzvzXESGR\nQq9HQ2ZeMsh5VSdIZkTkrqWlpXbn3iYkCIIjIjLRufD0WoPWGvV6PTK1rmXrXKPROGqetQlRSt0+\nkFyFjKiQ0QmSbdsrADh37lxKa33L4LIUDkQEjuNEcVHt1kKhkAZahIjIQQBvG2CGQoFSKpKEkLxB\nRK4DLhFyE4CDg8zURlCqt7JgEWmvj0QBHXOSN2mt3wG0CCH5i2aDZVSglEIymYRtb7uGtqs44/F4\nz4neL0QkAeA2AFAtr+NbEDHVoVIKqVSqp4RYloVkMhk5QkiKUuq6fD6fVKlUahxA2lSfqIzRLctC\nJpOB4+xaa7YhTIeeTqcHsnK4HUgmU6nUuKrVapOtDfiRglIKmUwGsVisJ22+ZVmIx+NIpVKRJASA\n7XnemFJKzUTBd7URlFIYGhpCJrN/50Emk8Hw8HAPctU/OI4zrkher5SKnLzH+HvS6TQymcye+xIR\nQSKRQCaTQTIZqXFLNzIk36YAXKu1TkfBobgREokEhoaGMDQ0tOs5hBE5HDhwoN38RQldNs+QPKwQ\nIWfiZkilUsjlcrtu/x3Hgeu6mJiYQCqV6mMOe4aMDeDNUZuDdMOU9OnpaayurqJcLqNSqWy4eCUi\nsCwLqVQKruvCdd1ITQY3A0kbwLAN4Bo0t6NFFp39iWVZsG0biUQC9XodjUYDQRBARKCUgm3bbXFc\nKpWKer/RhogkSM7IwsJCNYoudzMf6pwfkYRSqj2xq9VqqFar8H2/Pc8wZBgZkdkj391HRrHGkKxF\nbv7RiU7trtHyZjIZuK4LEWlrdzukmm2y6vU61tbWUKlU2tLSeDweSddJJ2wA8yQPtvwpA4OpAdVq\nFdVqta3hNU2SWc71PA+VSgWJRALxeLzdP5jvG+np+vo6PM+D7/uwLKvd1JkmLR6PIxaLDUReusnv\nr4jISzaAcyKSRUsUNwiYmmCEcUYc5/tXbvn2fR+e57X7BzMUNgtPjUYDlUoFlUoFjcbGB/ckk0kk\nEgkkk0kEQdCuaYOcwYtIheRZG8BPW/740UFlxvM8XLx4EcvLy9vKfsyWhJWVFays7O0IK8/z4Hke\nSqUSbNvG2NgYRkZGBj00bgBYttE8GHIgCIIAy8vLKJfLAxGwGWWLKQiGlAHWlDUbwCsi4oWdstnv\nsby8vGXz0m+QRK1Ww8rKCrTWUEohkUiEQkrXJtF1knPKtu0fkgxVFm4671KphLW1tYGR0Qnf97G8\nvIy1tbUN+64QsGpZ1g+U7/vnRKQe5nqIUaObUhkVaK1RKpXgeaE3GACAer1+QSmllnHl6Wl9Ree8\nImoww+697kfZK0gG8Xi8qEgWAXhhensNIVFZnexEo9Foz4H6jU6bK6W8YrF4QeVyuQrJM31PvQO+\n7w90e9l2MKSEWWC01j8+evSob1Qnz6B5wGMoMDPwqMJMUsMCyarW+mngki7reQDzYWWg0WhEmhCt\nNRqNRpg15FWSp4BLuqxXAPxvWKlHfZuB8RKHiJdt234ZaBHSOmjru2HmIMowNSQsiMjTU1NT60CH\n+l1Enup3wsZVEcXRVSe01qHu1tVaf9v8v02I7/tzaF7ZsL89yFuA5MC2Je8Gxo0fQjo+gIJS6kXz\nrE3I7OysR/If0byyoa+IwvrDdggpj+skHzfNFXDlLtyTJC/2K/VOOWciMdD1sC1hFI4hkLKitf77\nzgeXERIEwbNoLlj1ZdZmlliHhobgui7i8Xjkaks8Hm/nr895a4jIYi6X+17nw8sImZ2d9bTWj5K8\n0M+cpFIpHDhwAAcOHIjMGrfZqjA8PIyRkRGk0+l+E3KR5Inuk7CvsEQsFvsWyRf6mROlFNLpNLLZ\nLEZHRyPRfMViMYyOjiKbzSKTyYRRSH4Ui8Ue7354RaoTExOrSqlHSC4B6MsSXqeGamRkBOPj4xge\nHh5I8yUiGB4ebhcOx3GglOqno1W3+ukvb3S/1YYyIMdxnqrVaqdIvltE+rbQbFbnzP8ty2p7Wvvt\nfOyUBrmui0wmg3g8FHlaICLP12q1JzZ6uWkRWFxc/GWSjwGYRI+utdgKxl1RLpdRKpXaa+xa657N\nW0zNtCwL6XQarutieHgYlmX1rYnqPstXRMoAfnNycvJfNwq/qVAum83+e6FQeElEhhCCINtocs1R\nfObQMc/zUK1W9+3K6JSYuq6LRCLRlv6E2FSuaa1PnzlzZtMLYLbMyblz594hIg8DuAUIb0JnZvS1\nWq19jqLRbhlPcacwzsyqjczUtP+WZbU1V+bPyE3DFGB3KCuf11rfk8vlTm0WdkspaS6Xe3ZhYeHr\naG4KHelpLreA2b5sNukYw5vjYc3yqiHDyIdM02NIMcY3J5IOas7TSneF5De3IgPYwbm9lUrlRDqd\nvg3Ar/Uof7uGKe3JZPKqUbNvgO9Vq9W/3C7QjopMsVi8Xmv9OIBDeON0693CI/kKyd/I5XIvbhd4\nR0OLbDY7R/JTAM6geefSG9gZ1kn+RET+cCdkALsYzk5PT/8zyW8CKKB55xKjtK89Cuiyh0bTVl+f\nmpr61k7j2NXgu1qtfl5EHkeIgoirFSSrJL8xNTX1ud18b1eEHDp0qCoinyX5FQADuW88yugcxYnI\nVy3L+ky383DbOPaScKFQSJM8KSLvBDC2lzhewygB+O9SqfShw4cP71ozveeBealUGvE876siMrDh\ncBRB8juVSuWD11133Z42r+xrpkQyUSgUPisi97Z2kUbyEJEQoElWReTRer3+qdnZ2T33sfvyqIlI\n9eLFi58m+Rmt9RwGuPlngFgHMC8in1taWvqD/ZAB9MCLe/ToUf+RRx75CxH5EoCXSXokKSKUTe7I\neC2gNbz1WiLDL544ceLBo0eP7lt/2lPnTqFQuBXAwwDebpovidqieY/QIuQ0yftyuVzPRIY9N9bi\n4uIkyYdI/mrnRlIZ0HVJvYB0XFuEps1WADyllLo3m80WeppWLyMzOHXqlJPL5T6slHoAwBEACREx\nOuK+pt1DELg0tyCpAayR/DGAv56amvqHfqhz+mqUQqGQJfklAHeISBpN77JJ86ogpPVvICJrQRD8\ni2VZn5ycnFzsV6KhGKVQKNxI8jiA93Q0Y1cFISSXReQ/lFJ/ms1mn+93oqEZhWTs/PnzdwRB8AkR\nuUlExrmDixYHhAaauqkfiMhfra6uPnn99deH4ioKvZTm8/mkbdvvB3CviMwCGG7dEtAt+egcMvcq\nn5vG2RI+rwNYUUq9GgTBlwF8Yy93ou8HA2s25ubm4kNDQ78C4OMAbgaQ6woSKiEAFrXWz4vI36yt\nrX07rBrRjUi04ysrK6P1ev3mer1+p4gcJvnWVu0xksaeEkKyBuBVAC8DOKOUeiIIgudyuVxfJbQ7\nQSQIMSAp5XJ5ZH19/Vql1E0Afk5EjpBM4dL6fwaXZEk2mqRlWt+viEgFzT4AaDZBq613gVLK7Dj+\nL63197XW8zMzMxej5FGIFCEbgaQ1Pz8/7jhOVkTGLcs6AuAwgIyIjAF4M4BjrbCn0dy8egFNv9pL\nAH4oIhc8zzt/8ODB89K8eD6y+H+/s4GpXkX1yQAAAABJRU5ErkJggg==\n';
//        }else{
//        $avatar = base_url('upload/avatar/'.$user_info->avatar);
//        $avatar1 = base64_encode(file_get_contents($avatar));
//        }
//                    $dname = $user_info->first_name;
//                    if(!empty($user_info->middle_name))
//                    {
//                    $dname .= " ".$user_info->middle_name;
//                    }
//                    $dname .= " ".$user_info->last_name;
//                    $fdata = [
//                        'name' => $dname,
//                        'photo' => $avatar,
//                        'thumbImg' => $avatar1,
//                        'designation' => $user_info->designation,
//                          'email' => $user_info->email_address,
//                          'company_name' => $user_info->company,
//                          'company_address' => $user_info->company_address
//                    ];
//                    $ref = "users/".$user_info->firebase_uid."/";
//                    $properties = [
//                    'displayName' => $dname,
//                    'photoUrl' => $avatar
//                    ];
//                
//                $updatedUser = $auth->updateUser($user_info->firebase_uid, $properties);
//                        $postdata = $db->getReference($ref)->update($fdata);
//			    }
    				    
    				    
    					$resp_array = array(
    					  'status' => TRUE,
    					  'message' => "Membership details update successfully",
    					  'user_data' =>$this->json_array
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'error' => "Membership details update successfully"
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'error' => $validate_res['message']
    				);
    			}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
        
    }
    
    
    
    public function connection_request_accept_post(){
        $obj = array();
        $this->json_array=$_POST;
		if (isset($this->json_array['receiverid']) && isset($this->json_array['senderid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    $rschk=$this->user_model->check_already_accept_or_not($this->json_array['receiverid'], $this->json_array['senderid']);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
        			  'status' => FALSE,
        			  'msg' => 'Sender and Receiver are invalid.Please send a connection request',
				      'data'=>$obj
        			);
			       
			    }else{
			       
			       if($rschk[0]->status==1){
			           $this->json_array['status']=1;
			           $resp_array = array(
    					  'status' => FALSE,
    					  'msg' => 'You both are already friends',
    					  'data' => $this->json_array,
    					);
			           
			       }else{
			           
			           //eccept connection request
			           
			           $accepttt=$this->user_model->accept_connection_request($this->json_array['receiverid'], $this->json_array['senderid']);
			           
			           if($accepttt==TRUE){
			               $this->json_array['status']=1;
			               $resp_array = array(
        					  'status' => TRUE,
        					  'msg' => 'Congratulation! You have succesfully accept connection request',
        					  'data' => $this->json_array,
        					);
			               
			           }else{
			               $this->json_array['status']=0;
			               $resp_array = array(
        					  'status' => TRUE,
        					  'msg' => 'Some technical error occurred. Please try after some time',
        					  'data' => $this->json_array,
        					);
			               
			           }
			           
			        
			           
			       } 
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' => $obj,
			);
		}
		$this->response($resp_array, 200);   
    }
    public function connection_request_decline_post(){
        $obj = array();
          $this->json_array=$_POST;
		if (isset($this->json_array['receiverid']) && isset($this->json_array['senderid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    $rschk=$this->user_model->check_already_accept_or_not($this->json_array['receiverid'], $this->json_array['senderid']);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
        			  'status' => FALSE,
        			  'msg' => 'Sender and Receiver are invalid.Please send a connection request',
        			  'data'=>$obj
        			);
			       
			    }else{
			       
			       
			           //eccept connection request
			           
			           $accepttt=$this->user_model->delete_connection_request($this->json_array['receiverid'], $this->json_array['senderid']);
			           
			           if($accepttt==TRUE){
			               $resp_array = array(
        					  'status' => TRUE,
        					  'msg' => 'Congratulation! You have succesfully decline connection request',
        					  'data'=>$obj
        					);
			               
			           }else{
			               $this->json_array['status']=0;
			               $resp_array = array(
        					  'status' => TRUE,
        					  'msg' => 'Some technical error occurred. Please try after some time',
        					  'data' => $this->json_array,
        					);
			               
			           }
			           
			        
			      
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function connection_request_sent_list_post(){
        $obj = array();
          $this->json_array=$_POST;
		if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    $rschk=$this->user_model->check_connect_sent_or_not($this->json_array['userid']);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
        			  'status' => FALSE,
        			  'msg' => 'No Connection request sent',
        			  'data'=>$obj
        			);
			       
			    }else{
			      //listing connection request 
			      //$list_send=$this->user_model->get_list_of_connection_sent($this->json_array['userid']);
			        $resp_array = array(
        			  'status' => FALSE,
        			  'msg' => 'List of connection sent are as follows',
        			  'data'=>$rschk,
        			);
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200); 
        
    }
    public function connection_request_receive_list_post(){
          $obj = array();
          $this->json_array=$_POST;
		if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    $rschk=$this->user_model->check_connect_receive_or_not($this->json_array['userid']);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
        			  'status' => FALSE,
        			  'msg' => 'No Connection request receive',
				      'data'=>$obj
        			);
			       
			    }else{
			      //listing connection request 
			      //$list_send=$this->user_model->get_list_of_connection_sent($this->json_array['userid']);
			        $resp_array = array(
        			  'status' => FALSE,
        			  'msg' => 'List of connection receive are as follows',
				      'data'=>$rschk
        			);
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200); 
        
    }
    
    
    /*
    *  APP GET ALL MEMBERS
    *
    */
    
    public function app_get_all_members_post(){
        
          $obj = array();
          $this->json_array=$_POST;
	      if (isset($this->json_array['userid']))
	      {
          
            $rs = $this->user_model->get_app_get_all_members($this->json_array['userid']);
				if ($rs != FALSE) {
				   // array_push($obj,array("userdata"=>$rs));
                                    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
					$resp_array = array(
					    'status' => TRUE,
					    'msg'=> 'Data Found',
					    'data'=>$rs,
                                            'count_available'=>$flag);
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Record Found',
					  'data'=> $obj
					);
				}
	      }		
		  else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}			
			$this->response($resp_array, 200);
        
    }
    
    
    /*
    *
    *
    */
    public function app_get_my_buddies_post(){
        $obj = array();
        $this->json_array=$_POST;
		if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    
			    $rschk=$this->user_model->get_buddies_list($this->json_array['userid']);   //echo json_decode($rschk);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
					  'status' => TRUE,
					  'msg' => 'No buddies found',
				      'data'=>$obj
					);
			        
			    }else{
			        
			        //get all buddies
			        $buddieslist=$this->user_model->get_all_buddy_list($this->json_array);
			        if($buddieslist==FALSE){
			            
			             $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'No buddies found',
				          'data'=>$obj
    					);
			        }else{
			            $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			            $resp_array = array(
					      'status' => TRUE,
    					  'msg' =>my_caption('api_data_found'), 
				          'data'=>$buddieslist,
                                        'count_available'=>$flag
    					);
			            
			        }
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'), 
				          'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
        
    }
    
    
    public function app_get_my_buddies_with_membership_type_post(){
        $obj = array();
        $this->json_array=$_POST;
		if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    
			    $rschk=$this->user_model->get_buddies_list_with_membership_type($this->json_array);   //echo json_decode($rschk);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
					  'status' => TRUE,
					  'msg' => 'No buddies found',
				      'data'=>$obj
					);
			        
			    }else{
			        
			        //get all buddies
			        $buddieslist=$this->user_model->get_buddies_list_with_membership_type($this->json_array);
			        if($buddieslist==FALSE){
			            
			             $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'No buddies found',
				          'data'=>$obj
    					);
			        }else{
			            
			            $resp_array = array(
					      'status' => TRUE,
    					  'msg' =>my_caption('api_data_found'), 
				          'data'=>$buddieslist
    					);
			            
			        }
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'), 
				          'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
        
    }
    
    /*
    *
    *
    */
    
    public function app_connection_request_sent_list_post(){
        $obj = array();
            
          $this->json_array=$_POST;
		if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    
			    $rschk=$this->user_model->get_conection_list($this->json_array['userid']);  
			    if($rschk==FALSE){
			        
			        $resp_array = array(
					  'status' => TRUE,
					  'msg' => 'No connection request found',
					  'data'=>$obj
					);
			        
			    }else{
			        
			        //get all buddies
			        $connection_sent_req=$this->user_model->get_all_connection_list_sent($this->json_array['userid']);   
			        if($connection_sent_req ==FALSE){
			            
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => 'No connection request found',
    					   'data'=>$obj
    					);
			        }else{
			            $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			            $resp_array = array(
					       'status' => TRUE,
					       'msg' => my_caption('api_data_found'),
    					   'data' => $connection_sent_req,
                                        'count_available'=>$flag
    					);
			            
			        }
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' => $connection_sent_req
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    /*
    *
    *
    */
    
    public function app_connection_request_received_list_post(){
        $obj = array();
        
          $this->json_array=$_POST;
		if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    //first chech already sent or not
			    
			    $rschk=$this->user_model->get_conection_list_receive_req($this->json_array['userid']);
			    if($rschk==FALSE){
			        
			        $resp_array = array(
					  'status' => TRUE,
					  'msg' => 'No connection receive request  found',
				      'data'=>$obj
					);
			        
			    }else{
			        
			        //get all buddies
			        $connection_sent_req=$this->user_model->get_all_connection_list_receive($this->json_array['userid']);
			        if($connection_sent_req==FALSE){
			            
			             $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'No connection receive request  found',
				          'data'=>$obj
    					);
			        }else{
			            $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			            $resp_array = array(
					      'status' => TRUE,
					      'msg' => my_caption('api_data_found'),
    					  'data' => $connection_sent_req,
                                            'count_available'=>$flag
    					);
			            
			        }
			        
			        
			    }
			    
		
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_create_requirement_post(){
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['requirement_title']) && !empty($this->json_array['requirement_title']) &&
	    isset($this->json_array['requirement_description']) && !empty($this->json_array['requirement_description']) && 
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_requirement_title($this->json_array['userid'],$this->json_array['requirement_title']);
			    if($check_req_title==FALSE){
			        
			        
			        //first save thumbnil
			        
			         $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>2))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>2,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 2;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{ 
                                    $filename = "";
			        if ($_FILES['rerquirement_thumbnail']['name'] != '') {
            				$validate_res=my_validate_data('rerquirement_thumbnail', 'Upload File', 'callback_avatar_upload');
            				//GET USER ID
            				$avatar_file = $useriddd->ids.'.'.pathinfo($_FILES['rerquirement_thumbnail']['name'], PATHINFO_EXTENSION);
            				
            		}
			        
			         $config = array();
                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
                        $config['allowed_types'] = '*'; //'gif|jpg|png';
                        $config['encrypt_name']  = TRUE;
                        $config['file_name'] = $avatar_file;
                        //$config['max_size'] = 100;
                        //$config['max_width'] = 1024;
                        //$config['max_height'] = 768;
                        $this->load->library('upload',$config);
                        if ( ! $this->upload->do_upload('rerquirement_thumbnail')) {
                            $error = array('error' => $this->upload->display_errors());
                            
                            $upload=array('status'=>FALSE);
                        } else {
                            //Action, after file successfully uploaded
                            $upload_data = $this->upload->data();
                            $filename=$upload_data['file_name'];
                            $upload=array('status'=>TRUE);
                        }
                        
                        
                        
//                  	if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
                  	    
                  	     //insert requirement 
			            $insert_reqq=$this->user_model->save_req_deetails($this->json_array,$filename);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'message' => 'Some technical error occurred! Please try after some time '
        					   
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'message' => 'Requirement Created Successfully',
        					   'user_data' =>$insert_reqq
        					);
			            }
                  	    
//                  	}else{
//                  	    
//                  	    $resp_array = array(
//					       'status' => FALSE,
//    					  'message' => 'Some error occurred when uploading your thumbnil'
//    					);
//                  	    
//                  	}
                                }  
                            } 
			       
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'message' => 'Requirement Title already taken',
    					  'user_data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_my_requirements_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_requirement_title($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Requirements Created Till Now',
				  'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }    
    
    
    public function app_get_pending_requirements_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_pending_requirement($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Pending Requirements Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    public function app_get_complete_requirements_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_complete_requirement($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Complete Requirements Till Now',
				          'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    public function app_get_my_leads_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_requirement_title_byuser($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Requirements Created Till Now',
				          'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    } 
    
    public function app_get_pending_leads_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_requirement_pending_byuser($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Pending Requirements Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
                                $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>10))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title,
                                          'count_available'=>$flag
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_complete_leads_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_requirement_complete_byuser($this->json_array['userid']);   //print_r($check_req_title);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Pending Requirements Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
                                $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>10))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title,
                                          'count_available'=>$flag
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    public function app_get_all_leads_post(){
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_requirement_title_except_user_itself($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'No leads found till now '
    					);
                  
			        
			        
			    }else{
			        
			        //get user 
			        $get_all_leads=$this->user_model->get_all_leads($this->json_array['userid']);
			        
			        if($get_all_leads==FALSE){
			            
			            $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'No leads found '
    					);
			            
			        }else{
                                    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>10))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			            $resp_array = array(
					       'status' => TRUE,
    					  'message' => 'Following are the list of leads',
    					  'user_data'=>$get_all_leads,
                                          'count_available'=>$flag      
    					);
			            
			        }
			        
			         
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_requirement_details_post(){
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['requirement_id']) && !empty($this->json_array['requirement_id']) ) {
		    $throttle_check = my_throttle_check($this->json_array['requirement_id']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
                            $req_info = $this->db->query("select * from requirements where id='".$this->json_array['requirement_id']."' ")->row();
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>10))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0 && $this->json_array['userid'] != $req_info->user_id)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 10;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                        $str = explode(',',$user_consumption->type_id);
                                       if(!in_array($this->json_array['requirement_id'], $str) && $user_consumption->used_count == $pf_info->count_allowed && $this->json_array['userid'] != $req_info->user_id)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{
			    //check requirement title exist or not
			    $check_requirement_exist=$this->user_model->get_all_requirement_details($this->json_array['requirement_id'],$this->json_array['userid']);
			    if($check_requirement_exist==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'No requirements details found '
    					);
                  
			        
			        
			    }else{
			        
			         $resp_array = array(
					       'status' => TRUE,
    					  'message' => 'Following are the requirement details',
    					  'recomdation_list'=> $check_requirement_exist
    					);
			        
			    }
			    
            }} 
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
        
    }
    
    /*
    *
    *
    */
    public function app_recommend_myself_post(){
        $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['recommendation_note']) && !empty($this->json_array['recommendation_note']) && isset($this->json_array['requirement_id']) && !empty($this->json_array['requirement_id']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>7))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>7,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 7;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{    
			    //check recommendation_note  exist or not
			    $check_req_title=$this->user_model->get_all_recomendation_check($this->json_array['userid'],$this->json_array['userid'],$this->json_array['recommendation_note'],$this->json_array['requirement_id']);
			    if($check_req_title==FALSE){
                  	   
                  
			        //insert 
			        $insert_recomendation=$this->user_model->insert_recomanadte($this->json_array['userid'],$this->json_array['userid'],$this->json_array['recommendation_note'],$this->json_array['requirement_id'],$this->json_array['created_date'],$this->json_array['created_time']);
			        if($insert_recomendation==FALSE){
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => 'Some technical issue occurred',
				            'data'=>$obj
    					  
    					);
			            
			        }else{
			             $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Recomendation Note created successfully',
    					  'data'=>$insert_recomendation
    					);
			            
			        }
			        
			        
			    }else{
			        
			        
			        
			         $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Recomendation Note already created',
    					  'data'=>$check_req_title
    					);
			        
			    }
			    
            }}   
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_recommend_buddies_post(){
        $obj = $new_created = $alreadyexist = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['userids']) && !empty($this->json_array['userids']) && isset($this->json_array['recommendation_note']) && !empty($this->json_array['recommendation_note']) && isset($this->json_array['requirement_id']) && !empty($this->json_array['requirement_id'])  ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
                            $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>7))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>7,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 7;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{    
			    $useriddd=$this->json_array['userids'];
			    $explodrec=explode(",",$useriddd);
			    
			    $success=0;
			    $totalusss=count($explodrec);
			    $userrrrddff=array();
			    $allcrt=array();
			    $error_msg=array();
			    $already_created=array();
			    
			    foreach($explodrec as $rid)
			    {
			        
			    
			    //check recommendation_note  exist or not
			    $check_req_title=$this->user_model->get_all_recomendation_check($rid,$this->json_array['userid'],$this->json_array['recommendation_note'],$this->json_array['requirement_id']);
			    if($check_req_title==FALSE){
                  	   
                  
			        //insert 
			        $insert_recomendation=$this->user_model->insert_recomanadte($rid,$this->json_array['userid'],$this->json_array['recommendation_note'],$this->json_array['requirement_id'],$this->json_array['creatdate'],$this->json_array['creattime']);
			        if($insert_recomendation==FALSE){
			             
			             $err=array(
			                    "user_id"=>$rid,
			                    "msg"=>"some technical error occurred"
			                 );
			                array_push($error_msg,$err);
			            
			        }else{
			            $success++;
			            
			            $newcreatedarray = array('id'=>$rid,'name'=>$this->user_model->getusernames($rid));       
			          array_push($new_created,$newcreatedarray);
			            
			            //array_push($userrrrddff,$insert_recomendation);
			            
			           
			        }
			        
			        
			    }else{
			        
			        
			        /*$crttt=array(
			                  "user_id"=>$rid,
			                   "msg"=>"Recomendation Note already created",
			                   "recom_data"=>$check_req_title
			                 );*/
			                 
			          $alreadyexistarray = array('id'=>$rid,'name'=>$this->user_model->getusernames($rid));      
			          array_push($alreadyexist,$alreadyexistarray);
			        
			         
			        
			    }
			    
			    
			    }
			    
			    array_push($obj,array("AlreadyExist"=>$alreadyexist,"Created"=>$new_created));
			        
			  
			  //if(intval($success) == intval($totalusss)){
			  if(!empty($obj))   
			  {
			      $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Recommendation Submitted Successfully',
    					  'data'=>$obj
    				);
			  }else{
			      
			      $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'Something Wrong',
    					  'data'=>$obj
    				);
			      
			  }
            }}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
    }
    
    public function app_get_recommendation_list_post(){
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['requirement_id']) && !empty($this->json_array['requirement_id']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_recomended_exist=$this->user_model->get_all_recomendate_ee($this->json_array['userid'],$this->json_array['requirement_id']);
			   // $check_recomended_exist=$this->user_model->get_all_recomendate_ee_old($this->json_array['userid'],$this->json_array['requirement_id']);
			    if($check_recomended_exist==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'No recomendation found '
    					);
                  
			        
			        
			    }else{
			        $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			         $resp_array = array(
					       'status' => TRUE,
    					  'message' => 'Following are the recomendation list details',
    					  'recomdation_list'=> $check_recomended_exist,
                                     'count_available'=>$flag
    					);
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
	



    public function app_get_recommendation_list_post_old(){
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['requirement_id']) && !empty($this->json_array['requirement_id']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_recomended_exist=$this->user_model->get_all_recomendate_ee($this->json_array['userid'],$this->json_array['requirement_id']);
			    if($check_recomended_exist==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'No recomendation found '
    					);
                  
			        
			        
			    }else{
			        
			         $resp_array = array(
					       'status' => TRUE,
    					  'message' => 'Following are the recomendation list details',
    					  'recomdation_list'=> $check_recomended_exist
    					);
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    public function user_ratings_reviews_post(){
        $obj = array();
        $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['reviewed_by']) && !empty($this->json_array['reviewed_by']) && isset($this->json_array['ratings']) && !empty($this->json_array['ratings'])) {    // && isset($this->json_array['review_note']) && !empty($this->json_array['review_note'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
			    
			    //check user id or reviewd id exist or not
			    
			    $checkuserexist=$this->user_model->get_user_exist_or_not($this->json_array['userid'],$this->json_array['reviewed_by']);
			    
			    if($checkuserexist['status']==FALSE){
			        
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => $checkuserexist['message'],
				           'data' => $obj
    					);
			        
			    }else{
			        
			        
			        if(intval($this->json_array['ratings'])>5){
			            
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "Please Enter Value Between 1 To 5",
				           'data' => $obj
    					);
			            
			        }else{
			        
			        
			        
			        //check already entered
			        $ratings_review_exist=$this->user_model->check_review_ratings_ex($this->json_array['userid'],$this->json_array['reviewed_by']);
			        if($ratings_review_exist['status']==FALSE){
			            $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>8))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>8,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 8;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{     
			            //insert usert ratings
			            $user_rating_rev=$this->user_model->insert_ratings_review($this->json_array);
			            if(isset($user_rating_rev) && !empty($user_rating_rev)){
			                //get return of result
			                $get_userratings=$this->user_model->get_user_ratings_data($user_rating_rev);
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
				               'data' => $get_userratings
        					   
        					);
			                
			            }else{
    			             $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Something Went Wrong',
				               'data' => $obj
        					);
			                
			            }
                                }}
			        }else{
			            //update user ratings
			            
			            $user_rating_rev=$this->user_model->update_ratings_review($this->json_array,$ratings_review_exist['id']);
			            if($user_rating_rev['status']==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some problem occurred on user ratings and review updatings',
				               'data' => $obj
        					);
			                
			            }else{
			                
			               $resp_array = array(
    					       'status' => TRUE,
        					  'msg' => 'Rating Updated Successfully',
				              'data' => $user_rating_rev['message']
        					  
        					); 
			                
			            }
			            
			            
			        }
			        
			    } 
			        
			    }
			    
			   
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				               'data' => $obj
			);
		}
		$this->response($resp_array, 200);
      
        
    }
    public function get_user_rating_review_post(){
        $obj = array();
        
        $totalreviewcount = 0;
        
        $this->json_array=$_POST;
        
        if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' =>$obj
				);
			}
			else {
			    
			    //check user id or reviewd id exist or not
			    
			    $checkuserexist=$this->user_model->check_user_ratings_exist_or_not($this->json_array['userid']);
			    
			    if($checkuserexist['status']==FALSE){
			        
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "No Ratings and reviews found for this user",
				           'data' =>$obj
    					);
			        
			    }else{
			        
			        //get user ratings and reviews 
			        $ratingsss=$checkuserexist['message'];
			        $usss=0;
			        $review_note=array();
			        $ratingg=0;
			        $one_star = $two_star = $three_star = $four_star = $five_star = 0;
			        $one_star_user = $two_star_user = $three_star_user = $four_star_user = $five_star_user = 0;
			        foreach($ratingsss as $rattt){
			            
			            if($rattt->reviewed_by != '')
			            {
			            
			            $ratingg= $ratingg+ floatval($rattt->ratings);
			            
			            //$userdata = $this->db->query("select user. from ratings_reviews where user_id='".$rattt->reviewed_by."'")->row();
			            $userdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar from user where `id`=$rattt->reviewed_by AND membership_type !='0'")->row();
        
        
                        $total_no_of_count = count($ratingsss);
        
                        if($rattt->ratings == '1' || $rattt->ratings == '1.5')
                        {
                            $one_star += '1'; 
                        }
                        else if($rattt->ratings == '2' || $rattt->ratings == '2.5')
                        {
                            $two_star += '1';
                        }
                        else if($rattt->ratings == '3' || $rattt->ratings == '3.5')
                        {
                            $three_star += '1';
                        }
                        else if($rattt->ratings == '4' || $rattt->ratings == '4.5')
                        {
                            $four_star += '1';
                        }
                        else if($rattt->ratings == '5')
                        {
                            $five_star += '1';
                        }
                           
                           $profileimg = base_url().'upload/avatar/'.$userdata->avatar;
			            
			            if($rattt->review_note != '')
			            {
			               $totalreviewcount += '1';
			               $review_note[]=array("reviewed_by_id"=>$rattt->reviewed_by,"reviewed_by"=>$userdata->full_name,"review_rate"=>$rattt->ratings,"review_note"=>$rattt->review_note,"profile_img"=>$profileimg,"review_date"=>$rattt->review_date,"review_time"=>$rattt->review_time);
			            }
			            
			            $usss++;
			            }
			        }
			        $review_star[]=array("one_star"=>$one_star,"two_star"=>$two_star,"three_star"=>$three_star,"four_star"=>$four_star,"five_star"=>$five_star,"total_rate_review"=>$total_no_of_count,);
			        
			        $average_ratings=floatval($ratingg)/floatval($usss);
			        
			        $avegare_rat=number_format((float)$average_ratings, 1, '.', '');
			        $recommendation = 0;
                                $userid = $this->json_array['userid'];
                    $check_in_usertble = $this->db->where('id',$userid)->get('user')->row();
                    $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>8))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>8,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $recommendation = 1;
                   }
                }                                   
            }
			        array_push($obj,array("review_star"=>$review_star,"average_ratings"=>$avegare_rat,"total_review_count"=>$totalreviewcount,"all_reviews"=>$review_note,"is_review_exhausted"=>$recommendation));
			        
			        /*$resp_array = array(
					       'status' => TRUE,
    					   'average_ratings' => $avegare_rat,
    					   'all_reviews'=>$review_note
    					);*/
                                $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			        $resp_array = array(
					       'status' => TRUE,
    					   'msg' => "Record Found",
				           'data' =>$obj,
                                           'count_available'=>$flag
    					);
			        
			         
			        
			    }
			    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				           'data' =>$obj
			);
		}
		$this->response($resp_array, 200);
      
        
        
    }
    
    public function user_gallery_add_post(){
        
        $obj = array();
         $this->json_array=$_POST;
        
        if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['gallerytype']) && !empty($this->json_array['gallerytype']) &&  isset($_FILES) && !empty($_FILES) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check user id exist or not
			    
			    $checkuserexist=$this->user_model->check_user_exist_or_not($this->json_array['userid']);
			    
			    if($checkuserexist['status']==FALSE){
			        
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "Invalid User id",
    					   'data'=> $obj
    					);
			        
			    }else{
			     $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>5))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>5,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 5;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{    
			        //add gallery 
			        /*if (!empty($_FILES['images']['name']))
			        {  
			            $resp_array=array();
			            $filll=array();
			            $path2=$this->config->item('my_upload_directory') . 'gallery/profile' ;
			            $config['upload_path'] = $path2;
                            $path=$config['upload_path'];
                            $config['allowed_types'] = '*'; //'gif|jpg|jpeg|png';
                            $config['max_size'] = '2048';
                            //$config['max_width'] = '1920';
                            //$config['max_height'] = '1280';
                            $this->load->library('upload', $config);
                            $fileid=1;
                            foreach ($_FILES as $images => $fileObject)  //fieldname is the form field name
                            {
                                if (!empty($fileObject['name']))
                                {
                                    $this->upload->initialize($config);
                                    if (!$this->upload->do_upload($images))
                                    {
                                        $errors = $this->upload->display_errors();
                                        //flashMsg($errors);
                                        $filll1 = array(
                					       'status' => FALSE,
                    					   'message' =>strip_tags($errors).' You can Upload maximum 2mb filesize' //"Gallery images not uploaded"
                    					);
                    					$filll[]=$filll1;
                                    }
                                    else
                                    {
                                        
                                        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                                        $file_name = $upload_data['file_name'];
                                        
                                        //insert gallery Images
                                        $imagesupload=$this->user_model->upload_gallery_images($this->json_array['userid'],$this->json_array['gallerytype'],$file_name);
                                        
                                         // Code After Files Upload Success GOES HERE
                                         $filll1= array(
                					       'status' => TRUE,
                    					   'message' => "Gallery images updated successfully"
                    					);
                    					$filll[]=$filll1;
                                    }
                                }
                            }
                            
                          $resp_array = array(
					       'status' => TRUE,
    					   'message' => $filll
    					);  
                        
                   }*/  //echo count(array_filter($_FILES['images']['name']));
                    if(!empty($_FILES['images']['name']) && count(array_filter($_FILES['images']['name'])) > 0)
			        { 
                        $filesCount = count($_FILES['images']['name']); 
                        for($i = 0; $i < $filesCount; $i++)
                        {
                            $_FILES['file']['name']     = $_FILES['images']['name'][$i]; 
                            $_FILES['file']['type']     = $_FILES['images']['type'][$i]; 
                            $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i]; 
                            $_FILES['file']['error']     = $_FILES['images']['error'][$i]; 
                            $_FILES['file']['size']     = $_FILES['images']['size'][$i]; 
                     
                            $path2=$this->config->item('my_upload_directory') . 'gallery/profile' ;
        			        $config['upload_path'] = $path2;
                            $config['allowed_types'] = '*'; 
                            //$config['max_size']    = '100'; 
                            //$config['max_width'] = '1024'; 
                            //$config['max_height'] = '768'; 
                     
                            $this->load->library('upload', $config); 
                            $this->upload->initialize($config); 
                     
                            if($this->upload->do_upload('file')){ 
                                        // Uploaded file data
                                        
                                        $fileData = $this->upload->data(); 
                                        $uploadData[$i]['file_name'] = $fileData['file_name'];   //echo $fileData['file_name'];
                                        $imagesupload=$this->user_model->upload_gallery_images($this->json_array['userid'],$this->json_array['gallerytype'],$uploadData[$i]['file_name']);
                                        
                                    }
                                    
                            $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => "Gallery images Uploaded Successfully",
        					   'data' => $obj
        					);        
                        } 
			        }
                   else{
                       
                        $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "Gallery images are required",
    					   'data' => $obj
    					);
                       
                   }  
			        
                        }}       
			        
			    }
			    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
      
        
     
        
        
    }
    
    public function user_gallery_delete_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['imageid']) && !empty($this->json_array['imageid'])) { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $insert_reqq=$this->user_model->delete_image_gallery($this->json_array['imageid'],$this->json_array['userid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Gallery Image Deleted Successfully',
        					   'data' =>$obj
        					);
			            }
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        					   'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    public function view_user_gallery_post(){
        
        $obj = array();
         $this->json_array=$_POST;
        
        if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check user id exist or not
			    
			    $checkuserexist=$this->user_model->check_user_exist_or_not($this->json_array['userid']);
			    
			    if($checkuserexist['status']==FALSE){
			        
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "Invalid User id",
				            'data'=>$obj
    					);
			        
			    }else{
			        
			        //get user profile gallery  
			        $gallerttype=1;
			       $viewgallery=$this->user_model->get_user_profile_gallery($this->json_array['userid'],$gallerttype);
			       if($viewgallery['status']==FALSE){
			           
			            $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "No Gallery Images Found",
				            'data'=>$obj
    					);
			           
			       }else{
			           
			           $gallery=$this->user_model->view_profile_gallery_field_builder($viewgallery['data'],$this->json_array['userid']);
			           
			           $resp_array = array(
					       'status' => TRUE,
    					   'msg' => 'Record Found',
				            'data'=>$gallery
    					);
			           
			       }
			         
			        
			    }
			    
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
      
        
     
        
    }
   
    
    private function gallery_upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return $this->upload->display_errors();
            }
        }

        return $images;
    }
    
    
    /*
	*   APP GET ALL FUNCTIONAL AREA DETAILS
	*   REQUEST PARAMETER :- 
	*   METHOD:- GET     tbl_functional_area
	*/
	
	public function app_get_functional_area_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	         //$rs = $this->user_model->get_all_functional_area();   
	         if(empty($this->json_array['keyword']))
	         {
	            $rs = $this->db->where('status','1')->get('tbl_functional_area')->result();
	         }
	         else
	         {
	             $rs = $this->db->where('status','1')->like('functional_area',$this->json_array['keyword'],'both')->get('tbl_functional_area')->result();
	         }
	    if(isset($rs) && !empty($rs)){
			//	if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
				  //$data_result = $this->user_model->get_all_functional_area_fileds_builder($rs);  print_r($data_result);exit();
					
					//print_r($rs);exit();
					
					foreach($rs as $val)
					{
					    $data_array[] = array(
                	        'area_id'=>$val->functional_area_id,
                		    'area'=>$val->functional_area,
                		    
                		    );
					}
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $data_array
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
    
    
     /*
	*   APP GET ALL FUNCTIONAL AREA DETAILS
	*   REQUEST PARAMETER :- 
	*   METHOD:- GET     tbl_functional_area
	*/
	
	public function app_get_lead_status_get(){
	    $obj = array();
	           
	         $rs = $this->db->where(array('req_status_id !='=> '1'))->where(array('req_status_id !='=> '8'))->where(array('req_status_id !='=> '16'))->get('requirements_status')->result();
	         
	         
	         
	    if(isset($rs) && !empty($rs)){
		
					
					foreach($rs as $val)
					{
					    if($val->req_status_category == '1')
					    {
					       $cat_name = 'Pending'; 
					    }
					    elseif($val->req_status_category == '2')
					    {
					       $cat_name = 'Inprogress'; 
					    }
					    else
					    {
					       $cat_name = 'Closed'; 
					    }
					    
					    
					   
					   if($val->req_status_category == '1')
					   {
					     $pending[] = array(
                	        'req_status_id'=>$val->req_status_id,
                		    'req_status_name'=>$val->req_status_title,
                		    'req_status_description'=>$val->req_status_description,
                		    'req_status_category_id'=>$val->req_status_category,
                		    'req_status_category_name'=>$cat_name,
                		    );  
					   }
					   elseif($val->req_status_category == '2')
					   {
					       $inprogress[] = array(
                	        'req_status_id'=>$val->req_status_id,
                		    'req_status_name'=>$val->req_status_title,
                		    'req_status_description'=>$val->req_status_description,
                		    'req_status_category_id'=>$val->req_status_category,
                		    'req_status_category_name'=>$cat_name,
                		    );
					   }
					   elseif($val->req_status_category == '3')
					   {
					       $closed[] = array(
                	        'req_status_id'=>$val->req_status_id,
                		    'req_status_name'=>$val->req_status_title,
                		    'req_status_description'=>$val->req_status_description,
                		    'req_status_category_id'=>$val->req_status_category,
                		    'req_status_category_name'=>$cat_name,
                		    );
					   }
					   
					   
					   
					    
					}
					
					array_push($obj,array("PendingData"=>$pending,"InprogressData"=>$inprogress,"ClosedData"=>$closed));
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $obj
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
    
    
    public function app_user_check_lead_post(){
        $obj = array();  
        
         $this->json_array=$_POST;
        
        if (!empty($this->json_array['userid'])&& !empty($this->json_array['requirementid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {    
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check user id exist or not
			    
			    $checkuserexist=$this->user_model->check_user_exist_or_not_recomendation($this->json_array['userid'],$this->json_array['requirementid']);
			    
			    $status = $checkuserexist['status'];
			    $avl=   $checkuserexist['data'];     
			             
			 array_push($obj,array("Available"=>$avl));            
			             
			             
			             $resp_array = array(
					       'status' => TRUE,
    					   'msg' => "Check User Exist or not in Recomendation",
    					   'data'=>$obj
    					);
			        
			    
    					
    			
			}
		}
		else {  
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    		  'data' =>$obj
			);
		}
		$this->response($resp_array, 200);
      
        
     
        
        
    }
    
    
    public function app_user_add_lead_status_post(){
        $obj = array();  
        
         $this->json_array=$_POST;
        
        if (!empty($this->json_array['userid']) && !empty($this->json_array['statusid']) && !empty($this->json_array['requirementsid']) && !empty($this->json_array['creatdate'])  && !empty($this->json_array['creattime'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {    
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check user id exist or not
			    
			    $checkuserexist=$this->user_model->check_user_exist_or_not($this->json_array['userid']);
			    
			    if($checkuserexist['status']==FALSE){
			        
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "Invalid User id",
    					   'data'=>$obj
    					);
			        
			    }else{
			        
			        $validate_res = my_validate_data($this->json_array['userid'], 'User id', 'trim|required');
			        $validate_res = my_validate_data($this->json_array['addedby'], 'User id', 'trim|required');
			        $validate_res = my_validate_data($this->json_array['statusid'], 'Status id', 'trim|required');
			        $validate_res = my_validate_data($this->json_array['requirementsid'], 'Requirement id', 'trim|required');
			        
			        if ($validate_res['status']) {
    				my_throttle_log('');
    				$res = $this->user_model->app_user_add_lead_status($this->json_array);
    				if ($res==TRUE) {
    					
    					
			        	$resp_array = array(
    					  'status' => TRUE,
    					  'msg'=>'Lead Status Updated Successfully',
    					  'data' =>	$obj
    					);
    					
    					
    					
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Something Wrong",
    					  'data' =>$obj
    					);
    				}
    			}
    			else {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $validate_res['message'],
    				  'data' =>$obj
    				);
    			}
			        
			        
			        
			    }
			    
			}
		}
		else {  
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    				  'data' =>$obj
			);
		}
		$this->response($resp_array, 200);
      
        
     
        
        
    }
    
    
    public function app_get_user_lead_status_post(){ 
	    $obj = $obj1 = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && isset($this->json_array['requirementsid']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
				$rs = $this->user_model->get_app_get_lead_status($this->json_array['userid'],$this->json_array['requirementsid']);
				if ($rs != FALSE) {
				
				   $get_check = $this->db->get_where('requirements',array("id"=>$this->json_array['requirementsid']))->row();
				
				   if($get_check->status == '1')
				   {
				      $data_ans = "No";
				   }
				   else
				   {
				       $data_ans = "Yes";
				   }
				
					$data_array = $this->user_model->get_app_get_lead_status_fileds_builder($rs,$this->json_array['userid']);
					//array_push($obj1,array("RequirementComplete"=>$data_ans,"RequirementStatus"=>$data_array));
					
					$resp_array = array(
    				  'status' => TRUE,
    				  'msg' => 'Record Found',
    				  'data' => $data_array
    				);
					
				}
				else {
				    
				    //$data_array = array();
					//array_push($obj1,array("RequirementComplete"=>'No',"RequirementStatus"=>$data_array));
				    
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg'=>'Something Wrong',
					  'data' => $obj1
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
					  'data' => $obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
    
    
    public function app_get_user_notification_post(){ 
	    $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
				$rs = $this->user_model->get_app_notification($this->json_array['userid']);  
				if ($rs != FALSE) {
				
					$resp_array = array(
				  'status' => TRUE,
				  'msg' => 'Record Found',
				  'data' => $this->user_model->get_app_notification_fileds_builder($rs)
				);
					
				}
				else {
					my_throttle_log($this->json_array['userid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg'=>'No Record Found',
					  'data' => $obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
					  'data' => $obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
    
    
    
    public function app_get_post_category_get(){
	    $obj = array();
	            
	         $rs = $this->db->get('postcategory')->result();
	    if(isset($rs) && !empty($rs)){
			foreach($rs as $val)
			{
			    $data_array[] = array(
        	        'cat_id'=>$val->cat_id,
        		    'cat_name'=>$val->cat_name,
        		    'cat_icon'=>base_url().'upload/post/postcategory/PostIcons/'.$val->cat_icon,
        	    );
			}
					
					
				$resp_array = array(
				  'status' => TRUE,
				  'msg' => 'Record Found',
				  'data' => $data_array
				);
				
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_invalid_get_all_plan'),
			  'data' => $obj
			);
		}
				
		$this->response($resp_array, 200);
	    
	}
    
    
    
    public function app_create_posts_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['catid']) && !empty($this->json_array['catid']) &&
	    isset($this->json_array['post_description']) && !empty($this->json_array['post_description']) &&  
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { // isset($_FILES) && !empty($_FILES) &&  //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>1))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
				  'data'=>$obj
				);
                            }
                            else{
                                $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>1,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 1;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
				  'data'=>$obj
				);
                                }
                                else{
			    if ($_FILES['post_thumbnail']['name'] != '') {
            				$validate_res=my_validate_data('post_thumbnail', 'Upload File', 'callback_avatar_upload');
            				//GET USER ID
            				$avatar_file = $useriddd->ids.'.'.pathinfo($_FILES['post_thumbnail']['name'], PATHINFO_EXTENSION);
            		
            	     	$config = array();
                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'post/' ;
                        $config['allowed_types'] = '*'; //'gif|jpg|png';
                        $config['encrypt_name']  = TRUE;
                        $config['file_name'] = $avatar_file;
                        //$config['max_size'] = 100;
                        //$config['max_width'] = 1024;
                        //$config['max_height'] = 768;
                        $this->load->library('upload',$config);
                        if ( ! $this->upload->do_upload('post_thumbnail')) {
                            $error = array('error' => $this->upload->display_errors());
                            
                            $upload=array('status'=>FALSE);
                        } else {
                            //Action, after file successfully uploaded
                            $upload_data = $this->upload->data();
                            $filename=$upload_data['file_name'];
                            $upload=array('status'=>TRUE);
                        }
            		
            				
            		}
			    else
			    {
			      $filename = '';  
			    }
			            
                        
                        
                        
                  	//if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
                  	    
                  	     //insert requirement 
			            $insert_reqq=$this->user_model->save_post_deetails($this->json_array,$filename);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Created Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	/*}
                  	else{
                  	    
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'Some error occurred when uploading your thumbnil',
        				  'data'=>$obj
    					);
                  	    
                  	}*/
			        
			        
			       
			        
			        
			    
			    
			    
                                }
			}
                        }
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_update_posts_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['catid']) && !empty($this->json_array['catid']) &&
	    isset($this->json_array['post_description']) && !empty($this->json_array['post_description']) ) { // isset($_FILES) && !empty($_FILES) &&  //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
                             $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();   
			    if ($_FILES['post_thumbnail']['name'] != '') {
            				$validate_res=my_validate_data('post_thumbnail', 'Upload File', 'callback_avatar_upload');
            				//GET USER ID
            				$avatar_file = $useriddd->ids.'.'.pathinfo($_FILES['post_thumbnail']['name'], PATHINFO_EXTENSION);
            		
            	     	$config = array();
                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'post/' ;
                        $config['allowed_types'] = '*'; //'gif|jpg|png';
                        $config['encrypt_name']  = TRUE;
                        $config['file_name'] = $avatar_file;
                        //$config['max_size'] = 100;
                        //$config['max_width'] = 1024;
                        //$config['max_height'] = 768;
                        $this->load->library('upload',$config);
                        if ( ! $this->upload->do_upload('post_thumbnail')) {
                            $error = array('error' => $this->upload->display_errors());
                            
                            $upload=array('status'=>FALSE);
                        } else {
                            //Action, after file successfully uploaded
                            $upload_data = $this->upload->data();
                            $filename=$upload_data['file_name'];
                            $upload=array('status'=>TRUE);
                        }
            		
            				
            		}
			    else
			    {
			      $filename = '';  
			    }
			            
                        
                        
                        
                  	//if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
                  	    
                  	     //insert requirement 
			            $insert_reqq=$this->user_model->update_post_deetails($this->json_array,$filename);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Updated Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	/*}
                  	else{
                  	    
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'Some error occurred when uploading your thumbnil',
        				  'data'=>$obj
    					);
                  	    
                  	}*/
			        
			        
			       
			        
			        
			    
			    
			    
                                
			
                        }
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    public function app_get_like_unlike_posts_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['postid']) && !empty($this->json_array['postid'])) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=> $obj
				);
			}
			else {
			    
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->result();
			        
			    
                  $checkdata = $this->db->where(array('post_like_dislike_userid'=>$this->json_array['userid'],'post_like_dislike_postid'=>$this->json_array['postid']))->get('post_like_dislike')->row();      
                  if($checkdata)
                  {
                      $this->db->where(array('post_like_dislike_userid'=>$this->json_array['userid'],'post_like_dislike_postid'=>$this->json_array['postid']))->delete('post_like_dislike'); 
                      
                      $totaldata = $this->db->where(array('post_like_dislike_postid'=>$this->json_array['postid']))->get('post_like_dislike')->num_rows(); 
                      array_push($obj,array("LikeGiven"=>'No',"TotalLike"=>$totaldata));
                      $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Dislike',
        					   'data'=>$obj
        					);
			                
                  }
                  else
                  {
                      $post_array = array('post_like_dislike_userid'=>$this->json_array['userid'],'post_like_dislike_postid'=>$this->json_array['postid']);
                      $this->db->insert('post_like_dislike',$post_array);
                      
                       $totaldata = $this->db->where(array('post_like_dislike_postid'=>$this->json_array['postid']))->get('post_like_dislike')->num_rows(); 
                       array_push($obj,array("LikeGiven"=>'Yes',"TotalLike"=>$totaldata));
                      
                      $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Like',
        					   'data'=>$obj
        					);
                  }
                  
                  
                  
                  	    
                  	}
                  	
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_user_check_like_status_post(){
        $obj = array();  
        
         $this->json_array=$_POST;
        
        if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['postid']) && !empty($this->json_array['postid'])) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=> $obj
				);
			}
			else {
			    
			    //check user id exist or not
			    $totaldata = $this->db->where(array('post_like_dislike_postid'=>$this->json_array['postid']))->get('post_like_dislike')->num_rows();      
			    $checkdata = $this->db->where(array('post_like_dislike_userid'=>$this->json_array['userid'],'post_like_dislike_postid'=>$this->json_array['postid']))->get('post_like_dislike')->row();      
                if($checkdata)
			    {
			        array_push($obj,array("LikeGiven"=>'Yes',"TotalLike"=>$totaldata));            
			             
			             
			             $resp_array = array(
					       'status' => TRUE,
    					   'msg' => "Like Given",
    					   'data'=>$obj
    					);
			    }
			    else
			    {
			        array_push($obj,array("LikeGiven"=>'No',"TotalLike"=>$totaldata));            
			             
			             
			             $resp_array = array(
					       'status' => TRUE,
    					   'msg' => "Like not Given",
    					   'data'=>$obj
    					);
			    }
			   
			}
		}
		else {  
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
    		  'data' =>$obj
			);
		}
		$this->response($resp_array, 200);
      
        
     
        
        
    }
    
    public function app_get_my_posts_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->get_all_posts_detail($this->json_array['userid'],'2');    // 2 for show login users
			    if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
					$result = $this->user_model->get_app_get_all_post_details_fileds_builder($rs,$this->json_array['userid']);
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $result 
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No post available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_all_posts_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->get_all_posts_detail($this->json_array['userid'],'1');    // 2 for show login users
			    if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
					$result = $this->user_model->get_app_get_all_post_details_fileds_builder($rs,$this->json_array['userid']);
					$useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $result,
                                            'count_available'=>$flag
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No post available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_edit_posts_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['post_id']) && !empty($this->json_array['post_id'])) {
		    $throttle_check = my_throttle_check($this->json_array['post_id']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
//			    $rs=$this->user_model->get_all_posts_detail($this->json_array['userid'],'1');    // 2 for show login users
//			    if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
					$result = $this->user_model->app_edit_posts($this->json_array['post_id']);
                                        if ($result != FALSE) {
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $result
					);
                                        }
					
//				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No post available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_create_posts_comment_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['postid']) && !empty($this->json_array['postid']) &&
	    isset($this->json_array['message']) && !empty($this->json_array['message'])  && 
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $insert_reqq=$this->user_model->save_post_comments($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Commented Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_all_posts_comment_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['postid']) && !empty($this->json_array['postid'])) {
		    $throttle_check = my_throttle_check($this->json_array['postid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->get_all_posts_comment_detail($this->json_array['postid']);    // 2 for show login users
			    if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);   
					//print_r($rs);
					
					$result = $this->user_model->get_app_get_all_post_comment_details_fileds_builder($rs);
					
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $result 
					);
					
					
				}
				else {
				    
				    array_push($obj,array("Count"=>0,"CommentData"=>$obj));
				    
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No post comment available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    public function app_delete_posts_comment_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['commentid']) && !empty($this->json_array['commentid'])) { 
		    $throttle_check = my_throttle_check($this->json_array['commentid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $insert_reqq=$this->user_model->delete_post_comments($this->json_array['commentid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Comment Deleted Successfully',
        					   'data' =>$obj
        					);
			            }
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        					   'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    public function app_delete_post_image_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['post_id']) && !empty($this->json_array['post_id'])) {
		    $throttle_check = my_throttle_check($this->json_array['post_id']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
//			    $rs=$this->user_model->get_all_posts_detail($this->json_array['userid'],'1');    // 2 for show login users
//			    if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
					$result = $this->user_model->app_delete_post_image($this->json_array['post_id']);
                                        if ($result != FALSE) {
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Deleted',
					  'data' => $result
					);
                                        }
					
//				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No post available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_delete_posts_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['postid']) && !empty($this->json_array['postid'])) { 
		    $throttle_check = my_throttle_check($this->json_array['postid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $insert_reqq=$this->user_model->delete_posts_details($this->json_array['postid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Post Deleted Successfully',
        					   'data' =>$obj
        					);
			            }
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        					   'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_offline_business_transaction_id_get(){
	    $obj = array();
	         
	    $currentTime = date( 'd-m-Y h:i:s A', time () );
        $date_string = strtotime($currentTime);
	    if(isset($date_string) && !empty($date_string)){
		
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $date_string
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => "invalid Code",
					  'data' => 0
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
    
    public function app_create_offline_business_transaction_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['type']) && !empty($this->json_array['type']) &&
	    isset($this->json_array['businesswith']) && !empty($this->json_array['businesswith'])  && 
	    isset($this->json_array['title']) && !empty($this->json_array['title']) && isset($this->json_array['amount']) && !empty($this->json_array['amount']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $insert_reqq=$this->user_model->save_offline_business_transaction($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Business Transaction Added Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_all_business_transaction_post(){
        $obj = $obj1 = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->get_offline_business_transaction($this->json_array['userid']);    // 2 for show login users
			    $transa_total_data = $this->user_model->get_all_transaction_details_fileds_builder($this->json_array['userid']); 
			    if ($rs != FALSE) {
					
					$transa_total_data = $this->user_model->get_all_transaction_details_fileds_builder($this->json_array['userid']);      //$this->user_model->get_transaction_details_fileds_builder($this->json_array['userid']);
					//$received_data = $this->user_model->get_transaction_details_by_received_fileds_builder($this->json_array['userid']);
					//$given_data = $this->user_model->get_transaction_details_by_given_fileds_builder($this->json_array['userid']);
					
					$trans_info_data = $this->user_model->get_transaction_details_by_all_fileds_builder($this->json_array);
					
					//array_push($obj,array("TransactionData"=>$transa_total_data,"ReceivedData"=>$received_data,"GivenData"=>$given_data));
					
                   /* if(empty($trans_info_data))
					{
					    echo "hi";
					}*/
					
					array_push($obj,array("TransactionData"=>$transa_total_data,"TransactionInfo"=>$trans_info_data));
					$useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $obj,
                                            'count_available'=>$flag
					);
					
					
				}
				else {
				    array_push($obj,array("TransactionData"=>$transa_total_data,"TransactionInfo"=>$obj1));
				    
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'No Transaction available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    /*public function app_get_offline_business_transaction_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->get_offline_business_transaction($this->json_array['userid']);    // 2 for show login users
			    if ($rs != FALSE) {
					
					$transa_data = $this->user_model->get_transaction_details_fileds_builder($this->json_array['userid']);
					$received_data = $this->user_model->get_transaction_details_by_received_fileds_builder($this->json_array['userid']);
					$given_data = $this->user_model->get_transaction_details_by_given_fileds_builder($this->json_array['userid']);
					
					
					
					array_push($obj,array("TransactionData"=>$transa_data,"ReceivedData"=>$received_data,"GivenData"=>$given_data));
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $obj 
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Transaction available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }*/
    
    
    public function app_confirm_business_transaction_post(){
	    
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['id']) && !empty($this->json_array['id']) ) { //&& isset($this->json_array['transuniqueid']) && !empty($this->json_array['transuniqueid'])
		    $throttle_check = my_throttle_check($this->json_array['id']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
				$rs = $this->user_model->get_app_confirm_business_transaction($this->json_array['id']); //,$this->json_array['transuniqueid']
				if ($rs != FALSE) {
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Transaction Confirm Successfully',
				      'data'=>$obj
					);
					
					
				}
				else {
					my_throttle_log($this->json_array['transid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'Some technical error occurred! Please try after some time',
				      'data'=>$obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
    
    
    
    public function app_update_business_transaction_status_post(){
	    
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['transid']) && !empty($this->json_array['transid']) ) { //&& isset($this->json_array['transuniqueid']) && !empty($this->json_array['transuniqueid'])
		    $throttle_check = my_throttle_check($this->json_array['transid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
				$rs = $this->user_model->get_app_update_business_transaction($this->json_array['transid']); //,$this->json_array['transuniqueid']
				if ($rs != FALSE) {
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Transaction Status Updated Successfully',
				      'data'=>$obj
					);
					
					
				}
				else {
					my_throttle_log($this->json_array['transid']);
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'Some technical error occurred! Please try after some time',
				      'data'=>$obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
    
    
     public function app_get_all_business_transaction_detail_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['transaction_id']) && !empty($this->json_array['transaction_id'])) {
		    $throttle_check = my_throttle_check($this->json_array['transaction_id']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->get_offline_business_transaction_detail($this->json_array['transaction_id']);    
			    if ($rs != FALSE) {
					
					$transa_data = $this->user_model->get_offline_business_transaction_detail_fileds_builder($rs,$this->json_array['userid']);
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $transa_data 
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Transaction available right now',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    
    
    
    public function app_upgrade_offline_business_transaction_status_post(){
	    $obj = array();
	    $this->json_array=$_POST;
    	    if (isset($this->json_array['transid']) && isset($this->json_array['transid']) && isset($this->json_array['transaction_no']) && isset($this->json_array['transaction_no'])){ 
    		    $throttle_check = my_throttle_check($this->json_array['transid']);
    			if (!$throttle_check['result'] && $this->throttle_switch) {
    				$resp_array = array(
    				  'status' => FALSE,
    				  'msg' => $throttle_check['message'],
    				  'data' => $obj
    				);
    			}
    			else {
    				$rs = $this->user_model->get_app_get_offline_business_transaction_status($this->json_array);
    				if ($rs==TRUE) {
    					$resp_array = array(
    					  'status' => TRUE,
    					  'msg' => "Membership upgraded successfully",
    					  'data' => $obj
    					);
    				}
    				else {
    					$resp_array = array(
    					  'status' => FALSE,
    					  'msg' => "Membership not upgraded",
    					  'data' => $obj
    					);
    				}
    			}
    		}
    		else {
    			$resp_array = array(
    			  'status' => FALSE,
    			  'msg' => my_caption('api_incomplete_parameter'),
    			  'data' => $obj
    			);
    		}
		$this->response($resp_array, 200);
	}
    
    
    public function app_get_checkdays_get()
    {
        $days = "09 Aug 2021";
        
        echo date('D', strtotime($days));
    }
    
    
    
    public function app_get_turnover_get(){
	    $obj = array();
	           
	         $rs = $this->db->get('turn_over')->result();
	    if(isset($rs) && !empty($rs)){
		
					
					foreach($rs as $val)
					{
					    
					   
					     $dataresult[] = array(
                	        'turn_over_id'=>$val->turn_over_id,
                		    'turn_over_value'=>$val->turn_over_value,
                		    
                		    );  
					  
					   
					    
					}
					
				//	array_push($obj,array("PendingData"=>$dataresult));
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $dataresult
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'Invalid Data',
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
    
    public function getactivesubscription()
    {
         $todate = date('Y-m-d');
                                  $this->db->where('sub_startdate <=',$todate);
                                  $this->db->where('sub_enddate >=',$todate);
           $datafetch = $this->db->get('tbl_subscription')->result_array();
           $obj = array();
           $obj1= array();
           foreach($datafetch as $val_data)
           {
               $userid =  $val_data['sub_userid'];
               $type =  $val_data['sub_itemtype'];  
               $ids =  $val_data['sub_itemid'];         
               array_push($obj,array("UserId"=>"$userid","Type"=>"$type","ItemId"=>"$ids"));
           }
            array_push($obj1,array("UserId"=>$obj));
            echo json_encode(array("success"=>"1","message" => "Record Found.","data" => $obj1) );
        


    }

     function checkcodefcm_get()
     {
        
        
        
        $notifyid = '85';
     
        //$this->user_model->checkcodefcm_post($notifyid); exit();
     
     
        $notifydata = $this->db->get_where('notification',array('id'=>$notifyid))->row();       
        
        $by_user =$notifydata->by_user_ids;
        $from_user =$notifydata->to_user_ids;
        $sellerdata = $this->db->get_where('user',array('id'=>$by_user))->row(); 
        
        $visitorid = $from_user;
        $notifydate = $notifydata->created_time;
        $notifytime = $notifydata->created_time;
        $title = $notifydata->subject;
        $msg = $notifydata->body;  
        $username = $from_user;  

        $visitordata = $this->db->get_where('user',array('id'=>$visitorid))->row();  
        $visitorname = $visitordata->first_name;
        $visitorprofile = base_url().'upload/avatar/'.$visitordata->avatar;
       
       
        $request_for = $notifydata->request_for;    
	    $req_id = $notifydata->request_id;     
	    
	       
	    if($request_for == 'Connection')
	    {
	       $buddydata = $this->db->get_where('connection',array('id'=>$req_id))->row();
	       $userids = $buddydata->request_from;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	    
	    elseif($request_for == 'Followup')
	    {
	       $buddydata = $this->db->get_where('followup',array('followup_id'=>$req_id))->row();
	       $userids = $buddydata->followup_touserid;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	    
	    
	    elseif($request_for == 'Event')
	    {
	       $eventids = $val->request_id;
	       
	       //$eventdata = $this->db->select("CONCAT('".base_url()."upload/events/', event_thumbnil)  as event_pic")->where('event_id',$eventids)->get('events')->row();
	       
	       $eventdata = $this->db->select('event_thumbnil')->get_where('events',array('event_id'=>$eventids))->row();
	       
	       if($eventdata->event_thumbnil == '')
	       {
	           $getimages = base_url().'upload/j4e.png';
	       }
	       else
	       {
	           $getimages = base_url().'upload/events/'.$eventdata->event_thumbnil; 
	       }
	       
	       
	    }
	    elseif($request_for == 'Business Transaction')
	    {
	       
	       $getimages = base_url().'upload/j4e.png';
	       
	    }
	   
	      
	      if($getimages == '')
	      {
	          $getthumbnil = base_url().'upload/j4e.png';
	      }
	      else
	      {
	          $getthumbnil = $getimages;
	      }
	   
	   
	   
	   
       
        $curl = curl_init();
        $tockentake = $sellerdata->device_token;
       
       
     curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "to": "'.$tockentake.'",
                "notification": {
                    "title": "'.$title.'",
                    "message": "'.$msg.'",
                    "image": "'.$getthumbnil.'",
                    "sound": "audio.mp3"
                },
                "data": {
                    
                    "from_user_id": "'.$visitorid.'",
                    "body": "'.$title.'",
                    "Msg": "'.$msg.'",
                    "Date": "'.$notifydate.'",
                    "Time": "'.$notifytime.'",
                    "for": "'.$request_for.'",
		            "id": "'.$req_id.'",
		            "thumbnil": "'.$getthumbnil.'"
		    
                }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: key=AAAAuc1Wnwo:APA91bFnP03hGfE3EwNQYSIg8SHZRNYgEEpb7fD8tbr0jARxkCqTsOhI2f9YiuE9UmbOZBpvvWBfAz0-kw2Cen8WayxcF69EMX1FGhhXKfqJNTeb1SfW78ph8bnTfSdYknU2sgYrP7P0',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
   }
   
   
   
   public function app_get_event_category_get(){
	    $obj = array();
	         //$rs = $this->user_model->get_all_functional_area();   
	         $rs = $this->db->get('event_category')->result();
	    if(isset($rs) && !empty($rs)){
			//	if ($rs != FALSE) {
					//$resp_array = array('status' => TRUE);
					//$resp_array += $this->user_model->get_app_get_all_plan_details_fileds_builder($rs);
					
				  //$data_result = $this->user_model->get_all_functional_area_fileds_builder($rs);  print_r($data_result);exit();
					
					//print_r($rs);exit();
					
					foreach($rs as $val)
					{
					    $data_array[] = array(
                	        'event_cat_id'=>$val->event_cat_id,
                		    'event_cat_name'=>$val->event_cat_name,
                		    
                		    );
					}
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $data_array
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
   
   public function app_create_event_post(){
	    
	    $obj = array();   
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['event_title']) && !empty($this->json_array['event_title']) &&
	    isset($this->json_array['venue']) && !empty($this->json_array['venue']) && isset($this->json_array['entry_fees']) && !empty($this->json_array['entry_fees']) &&
	    isset($this->json_array['event_description']) && !empty($this->json_array['event_description']) && isset($_FILES) && !empty($_FILES) && isset($this->json_array['max_ticket']) && !empty($this->json_array['max_ticket']) &&
	    isset($this->json_array['start_datetime']) && !empty($this->json_array['start_datetime']) && isset($this->json_array['end_datetime']) && !empty($this->json_array['end_datetime']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' =>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_event_title($this->json_array['userid'],$this->json_array['event_title']);
			    if($check_req_title==FALSE){
			        
			        
			        //first save thumbnil
			        
			         $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->result();
			        
			        if ($_FILES['event_thumbnail']['name'] != '') {
            				$validate_res=my_validate_data('event_thumbnail', 'Upload File', 'callback_avatar_upload');
            				//GET USER ID
            				$avatar_file = $useriddd[0]->ids.'.'.pathinfo($_FILES['event_thumbnail']['name'], PATHINFO_EXTENSION);
            				
            		}
			        
			            $config = array();
                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'events/' ;
                        $config['allowed_types'] = '*'; //'gif|jpg|png';
                        $config['encrypt_name']  = TRUE;
                        $config['file_name'] = $avatar_file;
                        //$config['max_size'] = 100;
                        //$config['max_width'] = 1024;
                        //$config['max_height'] = 768;
                        $this->load->library('upload',$config);
                        if ( ! $this->upload->do_upload('event_thumbnail')) {
                            $error = array('error' => $this->upload->display_errors());
                            
                            $upload=array('status'=>FALSE);
                        } else {
                            //Action, after file successfully uploaded
                            $upload_data = $this->upload->data();
                            $filename=$upload_data['file_name'];
                            $upload=array('status'=>TRUE);
                        }
                        
                        
                        
                  	if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
                  	    
                  	     //insert requirement 
			            $insert_reqq=$this->user_model->save_event_details($this->json_array,$filename);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data' =>$obj
        					);
			                
			            }else{
			                  if(!empty($_FILES['images']['name']) && count(array_filter($_FILES['images']['name'])) > 0)
			                    { 
                                    $filesCount = count($_FILES['images']['name']); 
                                    for($i = 0; $i < $filesCount; $i++)
                                    {// echo $i;
                                        $_FILES['file']['name']     = $_FILES['images']['name'][$i]; 
                                        $_FILES['file']['type']     = $_FILES['images']['type'][$i]; 
                                        $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i]; 
                                        $_FILES['file']['error']     = $_FILES['images']['error'][$i]; 
                                        $_FILES['file']['size']     = $_FILES['images']['size'][$i]; 
                     
                                        $path2=$this->config->item('my_upload_directory') . 'events/event_details/' ;
        			                    $config['upload_path'] = $path2;
                                        
                                        $config['allowed_types'] = '*'; 
                                        //$config['max_size']    = '100'; 
                                        //$config['max_width'] = '1024'; 
                                        //$config['max_height'] = '768'; 
                     
                                        $this->load->library('upload', $config); 
                                        $this->upload->initialize($config); 
                     
                    
                                    if($this->upload->do_upload('file')){ 
                                        // Uploaded file data
                                        $eventid = $insert_reqq[0]->event_id; 
                                        $fileData = $this->upload->data(); 
                                        $uploadData[$i]['file_name'] = $fileData['file_name'];   //echo $fileData['file_name'];
                                        $imagesupload=$this->user_model->upload_event_images($this->json_array['userid'],$eventid,$uploadData[$i]['file_name']);
                                    }else{  
                                        $errorUploadType .= $_FILES['file']['name'].' | ';  
                                    } 
                                } 
			                    }
			                 
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Event Created Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}else{
                  	    
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'Some error occurred when uploading your thumbnil',
				          'data' =>$obj
    					);
                  	    
                  	}
			        
			        
			       
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Event Title already taken',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' =>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
   public function app_update_event_post(){
	    
	    $obj = array();   
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['event_id']) && !empty($this->json_array['event_id']) && isset($this->json_array['event_title']) && !empty($this->json_array['event_title']) &&
	    isset($this->json_array['venue']) && !empty($this->json_array['venue']) && isset($this->json_array['entry_fees']) && !empty($this->json_array['entry_fees']) &&
	    isset($this->json_array['event_description']) && !empty($this->json_array['event_description']) && isset($this->json_array['max_ticket']) && !empty($this->json_array['max_ticket']) &&
	    isset($this->json_array['start_datetime']) && !empty($this->json_array['start_datetime']) && isset($this->json_array['end_datetime']) && !empty($this->json_array['end_datetime']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' =>$obj
				);
			}
				else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->update_event_details($this->json_array);
			    if($check_req_title==FALSE){
			        
			      $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
				               'data'=>$obj
        					   
        					);
			                
			    }
			    else
			    {
			        $resp_array = array(
    				   'status' => TRUE,
        			   'msg' => 'Event Updated Successfully',
        			   'data' =>$obj
        			);
			    }
                  	    
                  	
			        
			        
			       
			        
			        
			    }
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' =>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }    
    
   
   public function app_confirm_event_status_post(){
	    
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) ) { 
		    $throttle_check = my_throttle_check($this->json_array['id']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
				$rs = $this->user_model->app_confirm_event_status_post($this->json_array['eventid']); //,$this->json_array['transuniqueid']
				if ($rs != FALSE) {
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Event Publish Successfully',
				      'data'=>$obj
					);
					
					
				}
				else {
					
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'Some technical error occurred! Please try after some time',
				      'data'=>$obj
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
	    
	}
   
   private function set_upload_options()
{   
    //upload an image options
    $config = array();
    $path2=$this->config->item('my_upload_directory') . 'events/event_details/' ;
    $config['upload_path'] = $path2;
    
    $config['allowed_types'] = '*';
   // $config['max_size']      = '0';
   // $config['overwrite']     = FALSE;

    return $config;
}
   public function app_delete_event_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['eventid']) && !empty($this->json_array['eventid'])) { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $insert_reqq=$this->user_model->delete_event_detail($this->json_array['eventid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Event Deleted Successfully',
        					   'data' =>$obj
        					);
			            }
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	 'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_get_event_list_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if($this->json_array['type'] == '')
	    {
	        $type = '1';
	    }
	    
	    
	    else
	    {
	         $type = $this->json_array['type'] ;
	    }
	    
	    $useridss = $this->json_array['userid'] ;
	    
	    
	    //if (isset($this->json_array['type']) && !empty($this->json_array['type'])) {
		 if (isset($type) && !empty($type)) {
		    $throttle_check = my_throttle_check($type);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $get_data = $this->user_model->get_my_pending_all_past_event($type,$useridss);
			    if($get_data==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Events Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'List of events',
    					  'data'=>$get_data
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_get_event_detail_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) && isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['eventid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    $event_info = $this->db->where('event_id',$this->json_array['eventid'])->get('events')->row();
                            $user_info = $this->db->where('id',$this->json_array['userid'])->get('user')->row();
                            $flag = 1;
//                            if(!empty($event_info->event_permission))
//                            {
//                                $str = explode(',',$event_info->event_permission);
//                                if(!in_array($user_info->packages_id,$str))
//                                {
//                                    $flag = 0;
//                                }
//                            }
                            if(!empty($event_info->event_permission))
                            {
                                $str = explode(',',$event_info->event_permission);
                                if(!in_array($user_info->packages_id,$str))
                                {
                                    $flag = 0;
                                }
                            }
                            if($flag == 0)
                            {
                                $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'No Permission',
			              'data'=>$obj
    					);
                            }
                            else
                            {
			    //check requirement title exist or not
			    $get_data = $this->user_model->get_event_details($this->json_array['eventid'],$this->json_array['userid']);
			    if($get_data==FALSE){
                  	    $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'No Events Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         
			         
			         
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Event Detail',
    					  'data'=>$get_data
    					);
			  
			        
			    }
			    
                            }
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_event_detail_for_boking_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['eventid']) && !empty($this->json_array['eventid']))
	    {
		    $throttle_check = my_throttle_check($this->json_array['eventid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $get_data = $this->user_model->get_event_details_for_booking($this->json_array['eventid']);
			    if($get_data==FALSE){
                  	    $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'No Events Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         
			         
			         
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'event Detail',
    					  'data'=>$get_data
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_user_book_event_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) &&
	    isset($this->json_array['username']) && !empty($this->json_array['username'])  && isset($this->json_array['useremail']) && !empty($this->json_array['useremail']) 
	    && isset($this->json_array['userphno']) && !empty($this->json_array['userphno']) && isset($this->json_array['amount']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) 
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_check_bookdetail($this->json_array['userid'],$this->json_array['eventid']);
			    if($check_req_title==FALSE){
			        
			        
			        $get_event = $this->db->select('event_ticketqty')->where('event_id',$this->json_array['eventid'])->get('events')->row();
			        $bookdata = $this->db->select('booking_id')->where(array('booking_eventid'=>$this->json_array['eventid'],'bookin_status'=>'2'))->get('event_booking')->num_rows();
			        
			        if($bookdata < ($get_event->event_ticketqty + '1'))
                    {
                        $insert_reqq= $this->user_model->save_booking_deetails($this->json_array);
                        
                        if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
				               'data'=>$obj
        					   
        					);
			                
			            }
			            else
			            {
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Booking Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                        
                    }   
                    else
                    {
                       $resp_array = array(
    					  'status' => FALSE,
        				   'msg' => 'Booking Full',
        				   'data' => $obj   
        					); 
                    }
                        
                }
			    else
			    {
			         $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'Once You Booked this event',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_event_participation_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) &&
	    isset($this->json_array['type']) && !empty($this->json_array['type']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) 
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_check_participation_status($this->json_array['userid'],$this->json_array['eventid'],$this->json_array['type']);
			    if($check_req_title==FALSE){
			        
			        
			        $insert_participate= $this->user_model->save_participation_status_deetails($this->json_array);
                        
                        if($insert_participate==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
				               'data'=>$obj
        					   
        					);
			                
			            }
			            else
			            {
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'You are participated successfully',
        					   'data' =>$insert_participate
        					);
			            }
                        
                     
                }
			    else
			    {
			         $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'You are already participated for this event',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj()
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
    public function app_check_event_invite_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    if (isset($this->json_array['invite_mobilenumber']) && isset($this->json_array['event_id'])) 
	    { 
		    $throttle_check = my_throttle_check($this->json_array['invite_mobilenumber']);
			
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_check_invite_count($this->json_array['invite_mobilenumber'],$this->json_array['event_id']);
			    if($check_req_title==FALSE){
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Record Not Found',
				               'data'=>$obj
        					   
        					);
			                
			            
                     
                }
			    else
			    {
			         $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Record Found',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj()
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_event_invite_byuser_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    if (isset($this->json_array['touserid']) && !empty($this->json_array['touserid']) && isset($this->json_array['byuserid']) && !empty($this->json_array['byuserid']) &&
	       isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) 
	    { 
		    $throttle_check = my_throttle_check($this->json_array['touserid']);
			
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_check_invite_byuser($this->json_array['touserid'],$this->json_array['byuserid'],$this->json_array['eventid']);
			    if($check_req_title==FALSE){
			        
			        
			        $insert_participate= $this->user_model->save_event_invite_deetails($this->json_array);
                        
                        if($insert_participate==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
				               'data'=>$obj
        					   
        					);
			                
			            }
			            else
			            {
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Invite Successfully',
        					   'data' =>$insert_participate
        					);
			            }
                        
                     
                }
			    else
			    {
			         $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Invitation Already Send for this event',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj()
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_event_attedance_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) && isset($this->json_array['status']) && !empty($this->json_array['status'])) 
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			
			else {
			    
			    
			    $check_req_title=$this->user_model->update_event_attending_status($this->json_array['userid'],$this->json_array['eventid'],$this->json_array['status']);
			    if($check_req_title==FALSE){
			        
			        
			        
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
				               'data'=>$obj
        					   
        					);
			                
			            
                     
                }
			    else
			    {
			         $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Attedance Status Updated Successfully',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj()
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_add_event_ratings_reviews_post(){
        $obj = array();
        $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) && isset($this->json_array['ratings']) && !empty($this->json_array['ratings'])) {    // && isset($this->json_array['review_note']) && !empty($this->json_array['review_note'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
			    
			    //check user id or reviewd id exist or not
			    
			    $checkuserexist=$this->user_model->get_user_exist_or_not_for_event($this->json_array['userid'],$this->json_array['eventid']);
			    
			    if($checkuserexist['status']==FALSE){
			        
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => $checkuserexist['message'],
				           'data' => $obj
    					);
			        
			    }else{
			        
			        
			        if(intval($this->json_array['ratings'])>5){
			            
			             $resp_array = array(
					       'status' => FALSE,
    					   'msg' => "Please Enter Value Between 1 To 5",
				           'data' => $obj
    					);
			            
			        }else{
			        
			        
			        
			        //check already entered
			        $ratings_review_exist=$this->user_model->check_review_ratings_event($this->json_array['userid'],$this->json_array['eventid']);
			        if($ratings_review_exist['status']==FALSE){
			            
			            //insert usert ratings
			            $user_rating_rev=$this->user_model->insert_event_ratings_review($this->json_array);
			            if(isset($user_rating_rev) && !empty($user_rating_rev)){
			                //get return of result
			                $get_userratings=$this->user_model->get_user_ratings_data($user_rating_rev);
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Review Added Sucessfully',
				               'data' => $get_userratings
        					   
        					);
			                
			            }else{
    			             $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Something Went Wrong',
				               'data' => $obj
        					);
			                
			            }
			            
			        }else{
			            //update user ratings
			            
			            $user_rating_rev=$this->user_model->update_ratings_review($this->json_array,$ratings_review_exist['id']);
			            if($user_rating_rev['status']==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some problem occurred on user ratings and review updatings',
				               'data' => $obj
        					);
			                
			            }else{
			                
			               $resp_array = array(
    					       'status' => TRUE,
        					  'msg' => 'Rating Updated Successfully',
				              'data' => $user_rating_rev['message']
        					  
        					); 
			                
			            }
			            
			            
			        }
			        
			    } 
			        
			    }
			    
			   
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				               'data' => $obj
			);
		}
		$this->response($resp_array, 200);
      
        
    }
   
   public function app_get_list_recommendations_to_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_list_recommendations_to($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Requirements Created Till Now',
				          'data'=>$obj
    					);
                  
			        
			        
			    }else{
                                $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title,
                                          'count_available'=>$flag
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    } 
   
   public function app_get_list_recommendations_by_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_list_recommendations_by($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Requirements Created Till Now',
				          'data'=>$obj
    					);
                  
			        
			        
			    }else{
                                $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Following are the list of requirements',
    					  'data'=>$check_req_title,
                                          'count_available'=>$flag
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    } 
   
   public function app_create_buddy_meet_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['buddiesid']) && !empty($this->json_array['buddiesid']) &&
	    isset($this->json_array['description']) && !empty($this->json_array['description']) &&  isset($this->json_array['location']) && !empty($this->json_array['location']) &&
	    isset($this->json_array['date']) && !empty($this->json_array['date']) && isset($this->json_array['time']) && !empty($this->json_array['time']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) )
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			     $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>3))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>3,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 3;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{ 
			      $insert_reqq=$this->user_model->save_buddy_meet($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Buddy Meet Created Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                        }
            }
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
   public function app_buddy_meet_list_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->app_get_buddy_meet_list($this->json_array['userid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
                                        $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq,
                                                   'count_available'=>$flag
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }    
    
   
   public function app_create_recognition_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['title']) && !empty($this->json_array['title']) &&
	    isset($this->json_array['description']) && !empty($this->json_array['description']) && isset($_FILES) && !empty($_FILES) && 
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->result();
			        
			    if ($_FILES['recognition_thumbnail']['name'] != '') {
            				$validate_res=my_validate_data('recognition_thumbnail', 'Upload File', 'callback_avatar_upload');
            				//GET USER ID
            				$avatar_file = $useriddd[0]->ids.'.'.pathinfo($_FILES['recognition_thumbnail']['name'], PATHINFO_EXTENSION);
            				
            		}
			        
			         $config = array();
                        $config['upload_path'] = $this->config->item('my_upload_directory') . 'recognition/' ;
                        $config['allowed_types'] = '*'; //'gif|jpg|png';
                        $config['encrypt_name']  = TRUE;
                        $config['file_name'] = $avatar_file;
                        //$config['max_size'] = 100;
                        //$config['max_width'] = 1024;
                        //$config['max_height'] = 768;
                        $this->load->library('upload',$config);
                        if ( ! $this->upload->do_upload('recognition_thumbnail')) {
                            $error = array('error' => $this->upload->display_errors());
                            
                            $upload=array('status'=>FALSE);
                        } else {
                            //Action, after file successfully uploaded
                            $upload_data = $this->upload->data();
                            $filename=$upload_data['file_name'];
                            $upload=array('status'=>TRUE);
                        }
                        
                        
                        
                  	if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
                  	    
                  	     //insert requirement 
			            $insert_reqq=$this->user_model->save_recognition_deetails($this->json_array,$filename);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Recognition Created Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	else{
                  	    
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'message' => 'Some error occurred when uploading your thumbnil',
        				  'data'=>$obj
    					);
                  	    
                  	}
		    }
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
  
   public function app_get_recognition_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['type']) && !empty($this->json_array['type'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_recognition($this->json_array['userid'],$this->json_array['type']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Recognition Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'List of Recognition',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    } 
    
    public function app_get_award_recognition_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $my_award_recognition = $this->user_model->get_my_award__recognition($this->json_array['userid']);
			    if($my_award_recognition==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Award Recognition Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'List of Award Recognition',
    					  'data'=>$my_award_recognition
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    } 
    
   public function app_event_register_list_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['eventid']) && !empty($this->json_array['eventid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['eventid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->get_all_event_register_list($this->json_array['eventid'],$this->json_array['userid'],$this->json_array['keyword']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
   public function app_event_attending_status_list_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['eventid']) && !empty($this->json_array['eventid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['eventid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->get_all_event_attending_status_list($this->json_array['eventid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }    
   
   public function app_get_total_employee_get(){
	    $obj = array();
	         
	                   //$this->db->select_max('no_of_employees AS totalemployee');
                       $this->db->select('no_of_employees AS totalemployee');
                       $this->db->order_by('no_of_employees', 'DESC');
                       $this->db->limit(1);
             $rs = $this->db->get('user')->row(); //echo $this->db->last_query();
	    if(isset($rs) && !empty($rs)){
		
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $rs->totalemployee
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => 0
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
   
   public function app_get_fallowup_lead_data_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['type']) && !empty($this->json_array['type']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->get_fallowup_lead_requirement_data($this->json_array['userid'],$this->json_array['type'],$this->json_array['keyword']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Record not Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }   
    
   public function app_get_fallowup_lead_userdata_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['requirementid']) && !empty($this->json_array['requirementid']) && isset($this->json_array['type']) && !empty($this->json_array['type']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['requirementid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->get_fallowup_lead_requirement_user_data($this->json_array['requirementid'],$this->json_array['type']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Record not Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }   
   
   public function app_create_fallowup_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['byuserid']) && !empty($this->json_array['byuserid']) && isset($this->json_array['type']) && !empty($this->json_array['type']) &&
	    isset($this->json_array['requirementid']) && !empty($this->json_array['requirementid']) &&  isset($this->json_array['touserid']) && !empty($this->json_array['touserid']) &&
	    isset($this->json_array['description']) && !empty($this->json_array['description']) && isset($this->json_array['date']) && !empty($this->json_array['date']) && isset($this->json_array['time']) && !empty($this->json_array['time']) &&
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) )
	    { 
		    $throttle_check = my_throttle_check($this->json_array['byuserid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    $useriddd=$this->db->query("select * from user where id='".$this->json_array['byuserid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>4))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
//				  'data'=>$obj
				);
                            }
                            else
                            {
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['byuserid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['byuserid'],'package_id'=>$useriddd->packages_id,'feature_id'=>4,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['byuserid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 4;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
//				  'data'=>$obj
				);
                                }
                                else{ 
			      $insert_reqq=$this->user_model->save_follow_up($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'FollowUp Created Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
            }}
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
   public function app_get_fallowup_list_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->app_get_fallowup_list($this->json_array['userid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
                                        $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq,
                                                   'count_available'=>$flag
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_get_address_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['keyword']) && !empty($this->json_array['keyword'])) {
		    $throttle_check = my_throttle_check($this->json_array['keyword']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    $sql = '';
			    //check requirement title exist or not
			    if($this->json_array['keyword'] != '')
        	    {
        	        $keyword = $this->json_array['keyword'];
        	        $sql.=" ( (address.address_name LIKE '%$keyword%'))";
        	    }
			    
			    
			    $query = $this->db->query("select address_name from address where $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
                foreach($query as $valaddr)
                {
                    $data_array[] = array($valaddr->address_name);
                }
        
			    if(empty($query)){
                  	    $resp_array = array(
					      'status' => FALSE,
    					  'msg' => 'No Record',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         
			         
			         
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Record Found',
    					  'data'=>$data_array
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_create_guest_invite_event_post(){
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    //isset($this->json_array['companyname']) && !empty($this->json_array['companyname']) && isset($this->json_array['designation']) && !empty($this->json_array['designation'])&&
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['eventid']) && !empty($this->json_array['eventid']) &&
	    isset($this->json_array['guestname']) && !empty($this->json_array['guestname'])  && 
	    isset($this->json_array['mobilenumber']) && !empty($this->json_array['mobilenumber']) && isset($this->json_array['emailid']) && !empty($this->json_array['emailid']) &&
	    
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time'])) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			   $check_invite_user = $this->user_model->check_guest_event_invite($this->json_array['mobilenumber'],$this->json_array['eventid']);
			   
			    if($check_invite_user['status']==FALSE){
                  	    $insert_reqq=$this->user_model->save_guest_event_invite($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Some technical error occurred! Please try after some time ',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Guest Invited Successfully',
        					   'data' =>$insert_reqq
        					);
			            }
                  
			        
			        
			    }
			    else
			    {
			        $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Already Invited Send for this Event',
        					   'data' =>$obj
        					);
			         
			    }
			   
			   
			   
			   
			   
			   
                  	    
                  	
                  	
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
   public function app_get_guest_invite_event_list_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			     
			     
			     
			      $insert_reqq=$this->user_model->app_get_guest_invite_event_list($this->json_array['userid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_get_guest_invite_event_detail_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['invite_id']) && !empty($this->json_array['invite_id']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			     
			     
			     
			      $insert_reqq=$this->user_model->app_get_guest_invite_event_detail($this->json_array['userid'],$this->json_array['invite_id']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_do_guest_invite_payment_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['invite_id']) && !empty($this->json_array['invite_id']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			     
			     
			     
			      $insert_reqq=$this->user_model->app_do_guest_invite_payment($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Something Wrong',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Payment Done',
        					   'data' =>$obj
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   public function app_get_my_report_card_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->app_get_my_report_card($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Recognition Till Now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			        
			        
			        $obj = $reward_obj = array();
	                $userid =$this->json_array['userid'];
            	    $total_reward= $this->db->select('sum(point) as total_point')->where(array('userid'=>$userid))->get('reward_user_point')->row();   
            	    
            	    $get_reward_list = $this->db->select('id,activity')->get('reward_point')->result();
            	    
            	    foreach($get_reward_list as $val_reward)
            	    {
            	        $total_reward_point = $this->db->select('sum(point) as total_point')->where(array('userid'=>$userid,'rewardid'=>$val_reward->id))->get('reward_user_point')->row();  
            	        
            	        if(is_null($total_reward_point->total_point)){$total_reward_points = "0";} else {$total_reward_points = $total_reward_point->total_point;}
            	        
            	        $RewardActivity[] = array(
            	            'RewardTitle'=>$val_reward->activity,
            	            'RewardPoint'=>$total_reward_points,
            	            'RewardDetail' =>$this->user_model->app_get_reward_detail_by_reward_id($val_reward->id,$userid)
            	            );
            	        
            	        
            	        //array_push($reward_obj,array($RewardActivity));
            	    }
	    
	    
	    if(empty($total_reward)){$total_reward = 0;}
	    
	    
	    
	    array_push($obj,array("TotalReward"=>$total_reward,"RewardDetail"=>$RewardActivity));
	    
			        
			        
			        
			        
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'List of Reward',
    					  'data'=>$obj
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    } 
   
   
    public function app_get_notification_count_post(){
	    
	    $obj = array();
	    
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj,
				);
			}
			else {
				$rs = $this->user_model->app_get_notification_count($this->json_array['userid']);
				if ($rs != FALSE) {
					//$this->user_model->sigin_success_log($rs, 'api');
					//$resp_array = array('status' => TRUE);
				//	$resp_array += $this->user_model->get_app_user_membership_details_fileds_builder($rs);
				
				
				$resp_array = array(
				  'status' => TRUE,
				  'msg' => 'Record Found',
				  'data' => $rs,
				);
				
				}
				else {
					
					$resp_array = array(
					  'status' => FALSE,
					  'msg'=> 'Something Wrong',
					  'data' => $obj,
					);
				}
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data' => $obj,
			);
		}
		$this->response($resp_array, 200);
	    
	    
	}
   
   
   public function app_get_my_diary_post(){
	    $this->json_array=$_POST;
	    $obj = $event_obj = $connection_obj = $requirement_obj = $lead_obj = $buddies_obj = $post_obj = $contribution_obj = $j4emeet_obj = $responsibilities_obj = array();
	    $bns_trans_obj = $testnml_obj = $myaward_obj = $myrecogn_obj = $memrbprofit_obj = $recommendedto_obj = $recommendedby_obj = $referralgiven_obj = $referralreceived_obj = $myreport_obj = $guestinvt_obj = array();
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else
			{
			  $user_ids = $this->json_array['userid']; 
			  
			  $count_my_buddies = $this->db->select('id')->where(array('user_id'=>$user_ids))->get('buddies')->num_rows();
			  $count_my_post = $this->db->select('post_id')->where(array('post_userid'=>$user_ids))->get('postdetail')->num_rows();
			  $count_receiveddata = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_touser',$user_ids)->get('business_transaction')->row();   //->where('bns_trans_status','2')
	          $count_givenddata = $this->db->select('sum(bns_trans_amount) as givenamount')->where('bns_trans_byuser',$user_ids)->get('business_transaction')->row();   //->where('bns_trans_status','2')
			  
			  
			  //$receiveddata = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_touser',$userid)->where('bns_trans_status','2')->get('business_transaction')->row();
	          //$givenddata = $this->db->select('sum(bns_trans_amount) as givenamount')->where('bns_trans_byuser',$userid)->where('bns_trans_status','2')->get('business_transaction')->row();
			  
			  //$my_close_requirement = $this->db->select('id')->where(array('user_id'=>$user_ids,'status'=>'2'))->get('requirements')->num_rows();
			  //$my_open_requirement = $this->db->select('id')->where(array('user_id'=>$user_ids,'status'=>'1'))->get('requirements')->num_rows();
			  //$my_close_requirement = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid = '3' AND ( req_user_status_userid='".$user_ids."' OR req_user_status_addedby ='".$user_ids."') group by req_user_status_reqid")->num_rows();
	    
	          $get_myclose_requirement = $this->user_model->get_all_complete_requirement($user_ids);
	            
	            if(empty($get_myclose_requirement)){  $my_close_requirement='0';}
	            else { $my_close_requirement = count($get_myclose_requirement);}
	    
	    
	         // $my_open_requirement = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$user_ids."' OR req_user_status_addedby ='".$user_ids."') group by req_user_status_reqid")->num_rows();
	    
	            $get_myopen_requirement = $this->user_model->get_all_pending_requirement($user_ids);
	            
	            if(empty($get_myopen_requirement)){  $my_open_requirements='0';}
	            else { $my_open_requirements = count($get_myopen_requirement);}
    
	            
	            //if(count($get_myopen_requirement) != '0') { $my_open_requirement = count($get_myopen_requirement);} else { $my_open_requirement='0'; }
	    
	    
	    
	     
			                  $this->db->select('requirements.id,recomendation.id');
			                  $this->db->join('requirements','requirements.id = recomendation.requirement_id','INNER');
			  $my_total_lead = $this->db->where(array("recomendation.userid"=>$user_ids))->get('recomendation')->num_rows();
			  
			  /*
			                  $this->db->select('requirements.id,recomendation.id');
			                  $this->db->join('requirements','requirements.id = recomendation.requirement_id','INNER');
			  $my_open_lead = $this->db->where(array("recomendation.userid"=>$user_ids,"requirements.status"=>"1"))->get('recomendation')->num_rows();
			  */
			  $pending_all_leads = $this->user_model->get_all_leads($user_ids);
			  if(empty($pending_all_leads)){  $pending_all_leadss='0';}
	          else { $pending_all_leadss = count($pending_all_leads);}
			  
			  $my_open_leads = $this->user_model->get_requirement_pending_byuser($user_ids);
			  //if(count($my_open_leads) != '0') { $my_open_lead = count($my_open_leads);} else { $my_open_lead='0'; }
			  
			  if(empty($my_open_leads)){  $my_open_lead='0';}
	          else { $my_open_lead = count($my_open_leads);}
			  
			  
			  $my_close_leads = $this->user_model->get_requirement_complete_byuser($user_ids);
			  //if(count($my_close_leads) != '0') { $my_close_lead = count($my_close_leads);} else { $my_close_lead='0'; }
			  
			  if(empty($my_close_leads)){  $my_close_lead='0';}
	          else { $my_close_lead = count($my_close_leads);}
			  
			                  
			  
			  $get_connection_sent_request=$this->db->query("select * from connection where request_to='".$user_ids."'")->num_rows();
			  $get_connection_receive_request=$this->db->query("select * from connection where request_from='".$user_ids."'")->num_rows();
			  
			  $get_rewardpoint= $this->db->select('sum(point) as totalpoint')->where('userid',$user_ids)->get('reward_user_point')->row();
			  $get_guest_invite = $this->db->query("select * from event_invite where event_invite_type='2' AND event_invite_byuserid='".$user_ids."'")->num_rows();
			  $get_recognition = $this->db->query("select * from recognition where recognition_userid='".$user_ids."'")->num_rows();
			  
			  
			  $get_event_interested = $this->db->query("select * from event_attending_status where attend_userid='".$user_ids."' AND attend_type='1'")->num_rows();
			  //$get_event_attending = $this->db->query("select * from event_attending_status where attend_userid='".$user_ids."' AND attend_type='2'")->num_rows();
			  $get_event_attending = $this->db->query("select * from event_booking where booking_userid='".$user_ids."' ")->num_rows();
			  
			  $get_buddy_meet = $this->db->query("select * from buddy_meet where  buddy_meet_touserid='".$user_ids."' OR buddy_meet_withuserid='".$user_ids."' ")->num_rows();
			  $get_fallow_up = $this->db->query("select * from followup where  followup_byuserid='".$user_ids."' OR followup_touserid='".$user_ids."' ")->num_rows();
			  
			  
			  $get_award = $this->db->get_where('user_reward',array("reward_userdid"=>$user_ids))->num_rows();
			  
			  
			  $get_recommendations_bypeople = $this->db->query("select userid FROM recomendation where userid='".$user_ids."' GROUP BY recomend_by")->num_rows();
			  $get_recommendations_bytime = $this->db->query("select id FROM recomendation where userid='".$user_ids."' ")->num_rows();
			  
			  $get_recommendations_topeople = $this->db->query("select recomend_by FROM recomendation where recomend_by='".$user_ids."' GROUP BY userid")->num_rows();
			  $get_recommendations_totime = $this->db->query("select id FROM recomendation where recomend_by='".$user_ids."' ")->num_rows();
                          
                          $get_pending_referral_received = $this->db->query("select * from requirements where status='1' AND is_referral='1' AND referral_for='".$user_ids."'")->result();
			  $get_pending_referral_given = $this->db->query("select * from requirements where status='1' AND is_referral='1' AND user_id='".$user_ids."'")->result();
			  
			  $get_complete_referral_received = $this->db->query("select * from requirements where status='2' AND is_referral='1' AND referral_for='".$user_ids."'")->result();
			  $get_complete_referral_given = $this->db->query("select * from requirements where status='2' AND is_referral='1' AND user_id='".$user_ids."'")->result();
			  
			  
			  $total_present_meet = 0;
			  $total_absent_meet = 0;
			  
			  $geteventbookdata = $this->db->query("select bookin_attedance,booking_eventid FROM event_booking where booking_userid='".$user_ids."' AND bookin_attedance !='3' ")->result();
			  foreach($geteventbookdata as $valbook)
			  {
			      $eventid = $valbook->booking_eventid; //echo $eventid;
			      $get_eventdata = $this->db->select('event_cat_id')->get_where('events',array('event_id'=>$eventid))->row(); 
                  $get_eventdatas = $this->db->select('event_j4e_meet')->get_where('event_category',array('event_cat_id'=>$get_eventdata->event_cat_id))->row();
                  
                  
                  if($get_eventdatas->event_j4e_meet == '1')
                  {
                      if($valbook->bookin_attedance == '1')
                      {
                          $total_present_meet += 1;
                      }
                      elseif($valbook->bookin_attedance == '2')
                      {
                          $total_absent_meet += 1;
                      }
                      
                  }
                  
			  }
			  
			  
			  
			  
			  if(empty($count_my_buddies)){$count_my_buddies = 0;}
			  if(empty($count_my_post)){$count_my_post = 0;}
			  if(empty($my_open_lead)){$my_open_lead = 0;}
			  if(empty($my_total_lead)){$my_total_lead = 0;}
			  if(empty($my_close_lead)){$my_close_lead = 0;}
			  if(empty($get_guest_invite)){$get_guest_invite = 0;}
			  if(empty($get_recognition)){$get_recognition = 0;}
			  if(empty($get_event_interested)){$get_event_interested = 0;}
			  if(empty($get_event_attending)){$get_event_attending = 0;}
			  if(empty($get_connection_sent_request)){$get_connection_sent_request = 0;}
			  if(empty($get_connection_receive_request)){$get_connection_receive_request = 0;}
			  if(empty($get_buddy_meet)){$get_buddy_meet = 0;}
			  if(empty($get_fallow_up)){$get_fallow_up = 0;}
			  
			  
			  $receiveduserreview = $this->db->query("select * from ratings_reviews where  review_note !='' AND  status = '1' AND `user_id`=$user_ids")->num_rows();
	          $sendeventreview = $this->db->query("select * from event_ratings_reviews where  review_note !='' AND status = '1' AND  `user_id`=$user_ids")->num_rows();
	          $senduserreview = $this->db->query("select * from ratings_reviews where  review_note !='' AND status = '1' AND  `reviewed_by`=$user_ids")->num_rows();
			  
			  $receivetestinomials =  $sendeventreview + $receiveduserreview;
			  if($receivetestinomials == '0')
			  {
			      $receivetestinomial = 0;
			  }
			  else
			  {
			      $receivetestinomial = $receivetestinomials;
			  }
			  
			  $sendtestinomials =   $senduserreview;
			  if($sendtestinomials == '0')
			  {
			      $sendtestinomial = 0;
			  }
			  else
			  {
			      $sendtestinomial = $sendtestinomials;
			  }
			  
			  
			  if(empty($count_receiveddata->receveamount)){$bus_trans_receive = '0';}else {$bus_trans_receive = $count_receiveddata->receveamount;}
			  if(empty($count_givenddata->givenamount)){$bus_trans_given = '0';}else {$bus_trans_given = $count_givenddata->givenamount;}
			  
			  if(empty($get_rewardpoint->totalpoint)){$total_point = '0';}else {$total_point = $get_rewardpoint->totalpoint;}
			  
			 //sprintf("%02d", $get_fallow_up)
			  
			  array_push($event_obj,array("InterestedEvent"=>sprintf("%02d", $get_event_interested),"AttendedEvent"=>sprintf("%02d", $get_event_attending)));
			  array_push($connection_obj,array("SentConnection"=>sprintf("%02d", $get_connection_sent_request),"ReceiveConnection"=>sprintf("%02d", $get_connection_receive_request)));
			  array_push($requirement_obj,array("Saved"=>sprintf("%02d", $my_close_requirement),"Open"=>sprintf("%02d", $my_open_requirements)));
			  array_push($lead_obj,array("Open"=>sprintf("%02d", $my_open_lead),"Closed"=>sprintf("%02d", $my_close_lead)));
			  array_push($buddies_obj,array("Total"=>sprintf("%02d", $count_my_buddies)));
			  array_push($post_obj,array("Total"=>sprintf("%02d", $count_my_post)));
			  array_push($contribution_obj,array("Conversions"=>00,"Revenue"=>00));
			  array_push($j4emeet_obj,array("Present"=>sprintf("%02d", $total_present_meet),"Absent"=>sprintf("%02d", $total_absent_meet)));
			  array_push($bns_trans_obj,array("Received"=>sprintf("%02d", $bus_trans_receive),"Given"=>sprintf("%02d", $bus_trans_given)));
			  array_push($testnml_obj,array("Received"=>sprintf("%02d", $receivetestinomial),"Given"=>sprintf("%02d", $sendtestinomial)));
			  array_push($myaward_obj,array("Total"=>sprintf("%02d", $get_award)));
			  array_push($myrecogn_obj,array("Total"=>sprintf("%02d", $get_recognition)));
			  array_push($memrbprofit_obj,array("Received"=>sprintf("%02d", $bus_trans_receive),"Saving"=>00));
			  array_push($recommendedto_obj,array("Peoples"=>sprintf("%02d", $get_recommendations_topeople),"Times"=>sprintf("%02d", $get_recommendations_totime)));
			  array_push($recommendedby_obj,array("Peoples"=>sprintf("%02d", $get_recommendations_bypeople),"Times"=>sprintf("%02d", $get_recommendations_bytime)));
                          array_push($referralgiven_obj,array("Pending"=>sprintf("%02d", count($get_pending_referral_given)),"Complete"=>sprintf("%02d", count($get_complete_referral_given))));
			  array_push($referralreceived_obj,array("Pending"=>sprintf("%02d", count($get_pending_referral_received)),"Complete"=>sprintf("%02d", count($get_complete_referral_received))));
			  array_push($myreport_obj,array("Total"=>sprintf("%02d", $total_point)));
			  array_push($guestinvt_obj,array("Total"=>sprintf("%02d", $get_guest_invite)));
			  array_push($responsibilities_obj,array("Leads"=>sprintf("%02d", $my_open_lead),"BuddyMeet"=>sprintf("%02d", $get_buddy_meet),"FollowUP"=>sprintf("%02d", $get_fallow_up)));
			  
			  $notification_count = $this->user_model->app_get_notification_count($this->json_array['userid']);
			  
			  
			  array_push($obj,array("Event"=>$event_obj,"Connection"=>$connection_obj,"Requirement"=>$requirement_obj,"Lead"=>$lead_obj,"Buddies"=>$buddies_obj
			  ,"Post"=>$post_obj,"Contribution"=>$contribution_obj,"J4EMeets"=>$j4emeet_obj,"BusinessTransaction"=>$bns_trans_obj,"Testinomial"=>$testnml_obj,
			  "Award"=>$myaward_obj,"Recognitions"=>$myrecogn_obj,"MembershipBenefits"=>$memrbprofit_obj,"RecommendedTo"=>$recommendedto_obj,"RecommendedBy"=>$recommendedby_obj,"ReferralGiven"=>$referralgiven_obj,"ReferralReceived"=>$referralreceived_obj,
			  "ReportCard"=>$myreport_obj, "GuestInvited"=>$guestinvt_obj,"PendingResponsibilities"=>$responsibilities_obj,"notification_count"=>$notification_count));
			    
			    $resp_array = array(
    			   'status' => TRUE,
        		   'msg' => 'Record Detail',
        		   'data' =>$obj
        		);
			            
                  	
			}
	    }
		else
		{
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_check_connection_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['viewbyuserid']) && !empty($this->json_array['viewbyuserid'])) {
		    $throttle_check = my_throttle_check($this->json_array['keyword']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    
			    $insert_data = $this->user_model->check_connection_sent_or_not($this->json_array['userid'],$this->json_array['viewbyuserid']);
			    //echo $this->db->last_query();
			    if($insert_data==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Any Request',
        					   'data'=>$insert_data
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Request Available',
        					   'data' =>$insert_data
        					);
			            }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   public function app_get_aboutus_get(){
	    $obj = array();
	          
	         $rs = $this->db->get('aboutus')->row();
	        if(isset($rs) && !empty($rs)){
			
					    $data_array[] = array(
                	        'vision'=>$rs->vision,
                		    'mission'=>$rs->mission,
                		    'aboutus'=>$rs->details,
                		    'achievement'=>$rs->achievement,
                		    'contactnumber'=>$rs->phonenumber,
                		    'whatsappnumber'=>$rs->whatsappnumber,
                		    'email'=>$rs->email,
                		    'website'=>$rs->website,
                		    'address'=>$rs->address,
                		    'longitude'=>$rs->longitude,
                		    'latitude'=>$rs->latitude,
                		    );
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $data_array
					);
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => my_caption('api_invalid_get_all_plan'),
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
    
    public function app_get_testimonial_post(){
        $obj = array();
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) ) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_testinomial=$this->user_model->app_get_testimonials($this->json_array['userid']);
			    if($check_testinomial==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					   'msg' => 'No Record Found',
    					   'data'=>$obj
    					);
                  
			        
			        
			    }else{
			        $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			         $resp_array = array(
					      'status' => TRUE,
    					  'msg' => 'Record Found',
    					  'data'=> $check_testinomial,
                                          'count_available'=>$flag
    					);
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
        
    }
   
   
   public function app_get_batches_data_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			      'data'=>$obj
				);
			}
			else {
			    
			    $insert_data = $this->user_model->app_get_batches_detail($this->json_array['userid']);
			    //echo $this->db->last_query();
			    if($insert_data==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Recoed Found',
        					   'data'=>$obj
        					);
			                
			            }else{
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Recoed Found',
        					   'data' =>$insert_data
        					);
			            }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   
   
   public function app_get_toprank_list_post()
   {
	    $this->json_array=$_POST;
	    $obj = array();
	    
	    
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']))
	    { 
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			      $insert_reqq=$this->user_model->app_get_toprank_list($this->json_array['userid']);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'No Record Found',
        					   'data'=>$obj
        					);
			                
			            }else{
                                        $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>9))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            
			       $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Record Found',
        					   'data' =>$insert_reqq,
                                                   'count_available'=>$flag
        					);
			            }
                  	    
                  	}
                  	
			}
		
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
    public function app_add_j4e_ratings_reviews_post(){
        $obj = array();
        $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['ratings']) && !empty($this->json_array['ratings'])) {    // && isset($this->json_array['review_note']) && !empty($this->json_array['review_note'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data' => $obj
				);
			}
			else {
			    
			    //check user id or reviewd id exist or not
			    
			    $ratings_review_exist=$this->user_model->check_review_ratings_j4e($this->json_array['userid']);
			    if($ratings_review_exist['status']==FALSE)
			    {
			        
			            //insert usert ratings
			            $user_rating_rev=$this->user_model->insert_j4e_ratings_review($this->json_array);
			            if(isset($user_rating_rev) && !empty($user_rating_rev)){
			                //get return of result
			                $get_userratings=$this->user_model->get_j4e_ratings_data($user_rating_rev);
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'msg' => 'Review Added Sucessfully',
				               'data' => $get_userratings
        					   
        					);
			                
			            }else{
    			             $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Something Went Wrong',
				               'data' => $obj
        					);
			                
			            }
                            
			    }
			    else
			    {
			      $get_userratings=$this->user_model->get_j4e_ratings_data($ratings_review_exist['id']);
			                 $resp_array = array(
    					       'status' => FALSE,
        					   'msg' => 'Review Once Added',
				               'data' => $get_userratings
        					   
        					);  
			    }
			        
			    } 
			        
			    
			    
			   
				
			
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				               'data' => $obj
			);
		}
		$this->response($resp_array, 200);
      
        
    }
   
   
   public function app_get_search_data_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['keyword']) && !empty($this->json_array['keyword']) && isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['keyword']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $rs=$this->user_model->app_get_search_data($this->json_array['keyword'],$this->json_array['userid']);    
			    if ($rs != FALSE) {
					
					
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $rs 
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Record Found',
					  'data' => $obj
					);
				}
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
        	  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
   
   
   
     public function send_event_invitation_get()
     {
            
            $get_event = $this->db->get_where('events',array("event_id"=>'4'))->row();
            
            $event = array(
            	'id' => $get_event->event_id,
            	'title' => $get_event->event_title,
                'address' => $get_event->event_address,
            	'description' => $get_event->event_description,
            	'datestart' => $get_event->event_startdate,
            	'dateend' => $get_event->event_date,
            	'address' => $get_event->event_address
            );

            $ical = 'BEGIN:VCALENDAR
            VERSION:2.0
            PRODID:-//hacksw/handcal//NONSGML v1.0//EN
            CALSCALE:GREGORIAN
            BEGIN:VEVENT
            DTEND:' . $get_event->event_date . '
            UID:' . md5($event['title']) . '
            DTSTAMP:' . time() . '
            LOCATION:' . addslashes($event['address']) . '
            DESCRIPTION:' . addslashes($event['description']) . '
            URL;VALUE=URI:http://mohawkaustin.com/events/' . $event['id'] . '
            SUMMARY:' . addslashes($event['title']) . '
            DTSTART:' . $get_event->event_date . '
            END:VEVENT
            END:VCALENDAR';
            
            //set correct content-type-header
            if($event['id']){
            	header('Content-type: text/calendar; charset=utf-8');
            	header('Content-Disposition: attachment; filename=mohawk-event.ics');
            	echo $ical;
            } else {
            	// If $id isn't set, then kick the user back to home. Do not pass go, and do not collect $200.
            //	header('Location: /');
            }
            
            
            $icals = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "@yourhost.test
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z
DTSTART:19970714T170000Z
DTEND:19970715T035959Z
SUMMARY:Bastille Day Party
END:VEVENT
END:VCALENDAR";

//set correct content-type-header
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename=calendar.ics');
echo $icals;
            
            
            /*
            
              $vcal = "BEGIN:VCALENDAR";
              $vcal .= "VERSION:2.0";
              $vcal .= "PRODID:-//CompanyName//ProductName//EN";
              $vcal .= "METHOD:REQUEST";
              $vcal .= "BEGIN:VEVENT";
              $vcal .= "ATTENDEE;CN=\"Attendee1Name\";ROLE=REQ-PARTICIPANT;RSVP=FALSE:MAILTO:Att1Mail@mail.com";
              $vcal .= "ATTENDEE;CN=\"Attendee2Name\";ROLE=REQ-PARTICIPANT;RSVP=FALSE:MAILTO:Att2Mail@mail.com";
              $vcal .= "UID:".date('Ymd').'T'.date('His')."-".rand()."-example.com.my";
              $vcal .= "DTSTAMP:".date('Ymd').'T'.date('His');
              $vcal .= "DTSTART:09/06/2011";
              $vcal .= "DTEND:10/06/2011"; 
              $vcal .= "LOCATION:Meeting room 2";
              $vcal .= "SUMMARY:hahaha....meeting";
              $vcal .= "BEGIN:VALARM";
              $vcal .= "TRIGGER:-PT15M";
              $vcal .= "ACTION:DISPLAY";
              $vcal .= "DESCRIPTION:Reminder";
              $vcal .= "END:VALARM";
              $vcal .= "END:VEVENT";
              $vcal .= "END:VCALENDAR";
            */
          
         $this->load->library('email');
         $fromName="TestName";
         $to='jatindangar1995@gmail.com';
         $subject='Test Mail Subject';
         $message='Test Content';
         $from ="noreplyj4e@applex360.co.in";
         $this->email->from($from, $fromName);
         $this->email->to($to);

         $this->email->subject($subject);
         $this->email->message($message);
         
         $this->email->set_header('Content-type', 'text/calendar');
         $this->email->attach($icals);
         
         
         if($this->email->send())
         {
            echo "Mail Sent Successfully".$to;
         }
         else
         {
            echo "Failed to send email";
            show_error($this->email->print_debugger());             
         }
     }
   
   
     public function oldsend_event_invitation_get()
     {
          $event = $this->db->get_where('events',array('event_id'=>'4'))->row();
          
          $this->load->library('email');
          /*if (empty($event->end_dt))
          {
            $event->end_dt = clone $event->event_date;
            //$event->end_dt->modify('+30 minutes');
          }*/
              $location        = 'Pune';
              $organizer       = 'Applex Group';
              $organizer_email = "noreplyj4e@applex360.co.in";
              $cr              = "\n";

  /** @var DateTimeZone $tz */
          $tz      = $event->event_date;
          $dt      = new \DateTime (NULL, new DateTimeZone('UTC'));
          $subject = html_entity_decode('Demo Event', ENT_QUOTES, 'UTF-8');
          $headers = 'From: ' . 'Applex' . ' <' . 'noreplyj4e@applex360.co.in' . '>' . $cr;
          $headers .= "MIME-Version: 1.0{$cr}";
          $headers .= "Content-Type: text/calendar; method=REQUEST;{$cr}";
          $headers .= '        charset="UTF-8"' . $cr;
          $headers .= 'Content-Transfer-Encoding: 7bit' . $cr;

  $message    = 'BEGIN:VCALENDAR' . $cr;
  $message    .= 'PRODID:-//i3SoftWebsite//cal_events/NONSGML v1.0//EN' . $cr;
  $message    .= 'VERSION:2.0' . $cr;
  $message    .= 'CALSCALE:GREGORIAN' . $cr;
  $message    .= 'METHOD:REQUEST' . $cr;
  $message    .= 'BEGIN:VEVENT' . $cr;
  $message    .= 'UID:' . md5(uniqid(mt_rand(), TRUE)) . '@' . 'applex360.co.in' . $cr;
  $message    .= 'CREATED:' . $dt->format("Ymd\THis") . 'Z' . $cr;
  $message    .= 'DTSTAMP:' . gmdate('Ymd') . 'T' . gmdate('His') . 'Z' . $cr;
  $message    .= 'DTSTART;TZID=' . 'Event' . ':' . $event->event_date . $cr;
  $message    .= 'DTEND;TZID=' . 'Event' . ':' . $event->event_date . $cr;
  $message    .= "SUMMARY:{$subject}{$cr}";
  $message    .= "ORGANIZER;CN={$organizer}:mailto:{$organizer_email}{$cr}";
  $message    .= "LOCATION:{$location}{$cr}";
  $message    .= "SEQUENCE:0{$cr}";
  $message    .= 'DESCRIPTION:' . html_entity_decode('event desc', ENT_QUOTES, 'UTF-8') . $cr;
  $recipients =  'jatindangar1995@gmail.com';  //;[$event->email_to];
  
  $recipient['name'] = 'Jatin';
  $recipient['email'] = 'jatindangar1995@gmail.com';
  
  $message      .= 'ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN=' . $recipient['name'] . ';X-NUM-GUESTS=0:MAILTO:' . $recipient['email'] . $cr;
      //$recipients[] = $recipient['email'];
  
  
  $message .= 'END:VEVENT' . $cr;
  $message .= 'END:VCALENDAR' . $cr;
  // @codeCoverageIgnoreStart
  $email_status = ENVIRONMENT === 'production'
    ? (int)mail($event->email_to, $subject, $message, $headers)
    : 0;
  // @codeCoverageIgnoreEnd
  $email                 = new stdClass();
 // $email->ema_created_dt = $dt->format(DATETIME_MYSQL);
  $email->ema_from       = $organizer_email;
  $email->ema_to         = $recipient['email'];
  $email->ema_subject    = $subject;
  $email->ema_body       = $message;
  $email->ema_status     = $email_status;
  $email->ema_body       = substr($headers . $message, 0, 1431655760); // trim this to longtext.
  $this->add($email);
}
   
    public function app_create_referral_post(){
	    $this->json_array=$_POST;
	    	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['referral_for']) && !empty($this->json_array['referral_for']) && isset($this->json_array['requirement_title']) && !empty($this->json_array['requirement_title']) &&
	    isset($this->json_array['requirement_description']) && !empty($this->json_array['requirement_description']) && 
	    isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) {
	   // if (isset($this->json_array['userid']) && !empty($this->json_array['userid']) && isset($this->json_array['requirement_title']) && !empty($this->json_array['requirement_title']) &&
	   // isset($this->json_array['requirement_description']) && !empty($this->json_array['requirement_description']) && isset($_FILES) && !empty($_FILES) && 
	   // isset($this->json_array['created_date']) && !empty($this->json_array['created_date']) && isset($this->json_array['created_time']) && !empty($this->json_array['created_time']) ) { //&& isset($this->json_array['address']) && !empty($this->json_array['address'])
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'error' => $throttle_check['message']
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_referral_title($this->json_array['userid'],$this->json_array['requirement_title']);
			    if($check_req_title==FALSE){
			        
			        
			        //first save thumbnil
			        
			     //    $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->result();
			        
			     //   if ($_FILES['rerquirement_thumbnail']['name'] != '') {
        //     				$validate_res=my_validate_data('rerquirement_thumbnail', 'Upload File', 'callback_avatar_upload');
        //     				//GET USER ID
        //     				$avatar_file = $useriddd[0]->ids.'.'.pathinfo($_FILES['rerquirement_thumbnail']['name'], PATHINFO_EXTENSION);
            				
        //     		}
			        
			         //$config = array();
            //             $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
            //             $config['allowed_types'] = '*'; //'gif|jpg|png';
            //             $config['encrypt_name']  = TRUE;
            //             $config['file_name'] = $avatar_file;
            //             //$config['max_size'] = 100;
            //             //$config['max_width'] = 1024;
            //             //$config['max_height'] = 768;
            //             $this->load->library('upload',$config);
            //             if ( ! $this->upload->do_upload('rerquirement_thumbnail')) {
            //                 $error = array('error' => $this->upload->display_errors());
                            
            //                 $upload=array('status'=>FALSE);
            //             } else {
            //                 //Action, after file successfully uploaded
            //                 $upload_data = $this->upload->data();
            //                 $filename=$upload_data['file_name'];
            //                 $upload=array('status'=>TRUE);
            //             }
                        
                        
                        
                //   	if ($validate_res['status']==TRUE && $upload['status'] == TRUE) {
                  	    
                  	     //insert requirement 
			         //   $insert_reqq=$this->user_model->save_referal_deetails($this->json_array,$filename);
			        $useriddd=$this->db->query("select * from user where id='".$this->json_array['userid']."'")->row();
			        
                            $pf_info = $this->db->where(array('package_id'=>$useriddd->packages_id,'feature_id'=>11))->get('package_features')->row();
//                            echo $this->db->last_query();die;
                            if($pf_info->is_allowed == 0)
                            {
                                $resp_array = array(
				  'status' => FALSE,
				  'msg' => "No Permission",
				  'data'=>$obj
				);
                            }
                            else{
                                $flag = 1;
                                $package_info = $this->db->where(array('user_id'=>$this->json_array['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$this->json_array['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>11,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                if(empty($user_consumption))
                                {                                 
                                    $data['user_id'] = $this->json_array['userid'];
                                    $data['package_id'] = $useriddd->packages_id;
                                    $data['package_purchase_id'] = $package_info->pur_id;
                                    $data['feature_id'] = 11;
                                    $data['used_count'] = 0;
                                    $q = $this->db->insert('user_package_features',$data);
                                }
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $flag = 0;
                                       }
                                    }                                   
                                }
                                if($flag == 0)
                                {
                                    $resp_array = array(
				  'status' => FALSE,
				  'msg' => "Quota Exhausted",
				  'data'=>$obj
				);
                                }
                                else{    
                                $insert_reqq=$this->user_model->save_referal_deetails($this->json_array);
			            if($insert_reqq==FALSE){
			                
			                $resp_array = array(
    					       'status' => FALSE,
        					   'message' => 'Some technical error occurred! Please try after some time '
        					   
        					);
			                
			            }else{
                                        $msg = "Referral Created Successfully";
                                        
			                 $resp_array = array(
    					       'status' => TRUE,
        					   'message' => $msg,
        					   'user_data' =>$insert_reqq
        					);
			            }
                            }
                            }
        //           	}else{
                  	    
        //           	    $resp_array = array(
					   //    'status' => FALSE,
    				// 	  'message' => 'Some error occurred when uploading your thumbnil'
    				// 	);
                  	    
        //           	}
			        
			        
			       
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'message' => 'Referral Title already taken',
    					  'user_data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'error' => my_caption('api_incomplete_parameter')
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_my_referral_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_referral_title($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Referral Created Till now',
				  'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Follow are the list of Referral',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
				  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }    
    
    
    public function app_get_pending_referral_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_pending_referral($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Pending Referral Till now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Follow are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_pending_referral_received_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
			  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_pending_referral_received($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Pending Referral Till now',
			              'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Follow are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_complete_referral_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_complete_referral($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Complete Referral Till now',
				          'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Follow are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_complete_referral_received_post(){
        $obj = array();
        
	    $this->json_array=$_POST;
	    if (isset($this->json_array['userid']) && !empty($this->json_array['userid'])) {
		    $throttle_check = my_throttle_check($this->json_array['userid']);
			if (!$throttle_check['result'] && $this->throttle_switch) {
				$resp_array = array(
				  'status' => FALSE,
				  'msg' => $throttle_check['message'],
				  'data'=>$obj
				);
			}
			else {
			    
			    //check requirement title exist or not
			    $check_req_title=$this->user_model->get_all_complete_referral_received($this->json_array['userid']);
			    if($check_req_title==FALSE){
                  	    $resp_array = array(
					       'status' => FALSE,
    					  'msg' => 'No Complete Referral Till now',
				          'data'=>$obj
    					);
                  
			        
			        
			    }else{
			         $resp_array = array(
					       'status' => TRUE,
    					  'msg' => 'Follow are the list of requirements',
    					  'data'=>$check_req_title
    					);
			  
			        
			    }
			    
			    
				
			}
		}
		else {
			$resp_array = array(
			  'status' => FALSE,
			  'msg' => my_caption('api_incomplete_parameter'),
			  'data'=>$obj
			);
		}
		$this->response($resp_array, 200);
        
    }
    
    public function app_get_referral_status_get(){
	    
	    $obj = array();
	    
	         $rs = $this->user_model->app_get_referral_status();
				if ($rs != FALSE) {
					
					$resp_array = array(
					  'status' => TRUE,
					  'msg' => 'Record Found',
					  'data' => $rs
					);
					
					
				}
				else {
					$resp_array = array(
					  'status' => FALSE,
					  'msg' => 'No Screen',
					  'data' => $obj
					);
				}
				
					
			$this->response($resp_array, 200);
	    
	}
   
}


    




?>






