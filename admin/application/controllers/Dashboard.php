<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		
    }
	
	
	
	public function index() {  
            $this->db->query('SET SESSION sql_mode = ""');
		$data['menu_page'] = 'Dashboard'; 
		$rs = $this->db->order_by('id', 'desc')->get('user', 8)->result();
		$data['rs_user'] = $rs;
// 		print_r($this->session->userdata());die;
		$data += $this->dashboard_statistics();
		my_load_view($this->setting->theme, 'dashboard', $data);
		
	}
	
	
	
	public function search_action() {
		redirect(base_url('admin/list_user/search' . '/' . my_post('keyword')));
	}
	
	
	
	protected function dashboard_statistics() {
            if($_POST)
           {
               $sd = date('Y-m-d',strtotime($this->input->post('start_date')));
                $ed = date('Y-m-d',strtotime($this->input->post('end_date')));
                $statistics['user_count'] = $this->db->where_in('membership_type',array('1','2'))->where('date(created_time) >=',$sd)->where('date(created_time) <=',$ed)->get('user')->num_rows();
		$statistics['event_count'] = $this->db->where('date(event_creatat) >=',$sd)->where('date(event_creatat) <=',$ed)->count_all_results('events');
		$statistics['post_count'] = $this->db->where('date(post_creatat) >=',$sd)->where('date(post_creatat) <=',$ed)->count_all_results('postdetail');
		$statistics['lead_count'] = $this->db->where('is_referral',0)->where('date(doe) >=',$sd)->where('date(doe) <=',$ed)->count_all_results('requirements');
		$statistics['recognition_count'] = $this->db->where('date(recognition_creatat) >=',$sd)->where('date(recognition_creatat) <=',$ed)->count_all_results('recognition');
		$statistics['groups_count'] = $this->db->count_all_results('groups');
                $statistics['referral_count'] = $this->db->where('is_referral',1)->where('date(doe) >=',$sd)->where('date(doe) <=',$ed)->count_all_results('requirements');
                $statistics['business_transaction_count'] = $this->db->where('date(bns_trans_creatat) >=',$sd)->where('date(bns_trans_creatat) <=',$ed)->count_all_results('business_transaction');
                $statistics['review_count'] = $this->db->where('date(doe) >=',$sd)->where('date(doe) <=',$ed)->count_all_results('ratings_reviews');
                $statistics['buddy_meet_count'] = $this->db->where('date(buddy_meet_creatat) >=',$sd)->where('date(buddy_meet_creatat) <=',$ed)->count_all_results('buddy_meet');
            }
           else{
		$statistics['user_count'] = $this->db->where_in('membership_type',array('1','2'))->get('user')->num_rows();
		$statistics['event_count'] = $this->db->count_all_results('events');
		$statistics['post_count'] = $this->db->count_all_results('postdetail');
		$statistics['lead_count'] = $this->db->where('is_referral',0)->count_all_results('requirements');
		$statistics['recognition_count'] = $this->db->count_all_results('recognition');
		$statistics['groups_count'] = $this->db->count_all_results('groups');
                $statistics['referral_count'] = $this->db->where('is_referral',1)->count_all_results('requirements');
                $statistics['business_transaction_count'] = $this->db->count_all_results('business_transaction');
                $statistics['review_count'] = $this->db->count_all_results('ratings_reviews');
                $statistics['buddy_meet_count'] = $this->db->count_all_results('buddy_meet');
           }
		
		
		
		$getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where  membership_type !='0' $sql")->result_array();  
        
        foreach($getdata as $query)
        {
           if($_POST)
           {
               $sd = date('Y-m-d',strtotime($this->input->post('start_date')));
                $ed = date('Y-m-d',strtotime($this->input->post('end_date')));
               $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query['id'])->where('date(creatat) >=',$sd)->where('date(creatat) <=',$ed)->get('reward_user_point')->row();
           }
           else{
            $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query['id'])->get('reward_user_point')->row();
           }
            if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
        
             if($toal_points != "0"){
             $data_array[] = array(
                "id"=> $query->id,
                "full_name"=> $query['full_name'],
                "total_point"=>$toal_points
                );
             }
        }
	    
	    
	    if(isset($data_array) && !empty($data_array)){
	              array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $data_array), SORT_DESC, $data_array);
	    }   
	
	    /*foreach($data_array as $key=>$val_data)
	    {
	        if($key < '11')
	        {
	            $data_arrays[] = array(
                "id"=> $val_data->id,
                "full_name"=> $val_data['full_name'],
                "total_point"=>$val_data['toal_points']
                );
             
	        }
	    }*/
	
		$statistics['top_rank'] = $data_array;
		
	
		
		   $month_res = $this->db->select('COUNT(id) AS total_sale,DATE_FORMAT(doe,"%b") AS month_name ')
                
                ->group_by('year(CURDATE()),MONTH(doe)')
                ->order_by('year(CURDATE()),MONTH(doe)')
                ->get('`recomendation`')->result_array();

            //echo $this->db->last_query();


            $month_wise_sales['total_sale'] = array_map('intval', array_column($month_res, 'total_sale'));
            $month_wise_sales['month_name'] = array_column($month_res, 'month_name');

            //$statistics['month_wise_lead'] = $month_wise_sales;
		
		    $statistics['month_wise_lead_total_sale'] = $month_wise_sales['total_sale'];
		    $statistics['month_wise_lead_month_name'] = $month_wise_sales['month_name'];
		
		
		
		    $d = strtotime("today");
            $start_week = strtotime("last sunday midnight", $d);
            $end_week = strtotime("next saturday", $d);
            $start = date("Y-m-d", $start_week);
            $end = date("Y-m-d", $end_week);
            $week_res = $this->db->select("DATE_FORMAT(doe, '%d-%b') as date, COUNT(id) as total_sale")
                ->where("date(doe) >='$start' and date(doe) <= '$end' ")
                ->group_by('day(doe)')->get('`recomendation`')->result_array();
            // print_r($this->db->last_query());

            //select DATE_FORMAT(bns_trans_creatat, '%d-%b') as date,SUM(final_total) as total_sale FROM `orders` WHERE date(bns_trans_creatat) >= '2021-04-11' and date(bns_trans_creatat) <= '2021-04-17' GROUP BY day(bns_trans_creatat)

            $week_wise_sales['total_sale'] = array_map('intval', array_column($week_res, 'total_sale'));
            $week_wise_sales['week'] = array_column($week_res, 'date');

            $statistics['week_wise_lead_total_sale'] = $week_wise_sales['total_sale'];
		    $statistics['week_wise_lead_month_name'] = $week_wise_sales['week'];
		
		
		    $day_res = $this->db->select("DAY(doe) as date, COUNT(id) as total_sale")
                ->where('doe >= DATE_SUB(CURDATE(), INTERVAL 29 DAY)')
                ->group_by('day(doe)')->get('`recomendation`')->result_array();
            $day_wise_sales['total_sale'] = array_map('intval', array_column($day_res, 'total_sale'));
            $day_wise_sales['day'] = array_column($day_res, 'date');

            $statistics['day_wise_lead_total_sale'] = $day_wise_sales['total_sale'];
		    $statistics['day_wise_lead_month_name'] = $day_wise_sales['day'];
		    
		    
		    
//		    print_r($statistics['day_wise_lead_month_name']);die;
		    
		    
		    
		    $month_res = $this->db->select('SUM(bns_trans_amount) AS total_sale,DATE_FORMAT(bns_trans_creatat,"%b") AS month_name ')
                
                ->group_by('year(CURDATE()),MONTH(bns_trans_creatat)')
                ->order_by('year(CURDATE()),MONTH(bns_trans_creatat)')
                ->get('`business_transaction`')->result_array();

            //echo $this->db->last_query();


            $month_wise_trans['total_sale'] = array_map('intval', array_column($month_res, 'total_sale'));
            $month_wise_trans['month_name'] = array_column($month_res, 'month_name');

            //$statistics['month_wise_lead'] = $month_wise_sales;
		
		    $statistics['month_wise_total_business_transaction'] = $month_wise_trans['total_sale'];
		    $statistics['month_wise_business_transaction'] = $month_wise_trans['month_name'];
		    
		    
		    
		    $d = strtotime("today");
            $start_week = strtotime("last sunday midnight", $d);
            $end_week = strtotime("next saturday", $d);
            $start = date("Y-m-d", $start_week);
            $end = date("Y-m-d", $end_week);
            $week_res = $this->db->select("DATE_FORMAT(bns_trans_creatat, '%d-%b') as date, SUM(bns_trans_amount) as total_sale")
                ->where("date(bns_trans_creatat) >='$start' and date(bns_trans_creatat) <= '$end' ")
                ->group_by('day(bns_trans_creatat)')->get('`business_transaction`')->result_array();
            // print_r($this->db->last_query());

            //select DATE_FORMAT(bns_trans_creatat, '%d-%b') as date,SUM(final_total) as total_sale FROM `orders` WHERE date(bns_trans_creatat) >= '2021-04-11' and date(bns_trans_creatat) <= '2021-04-17' GROUP BY day(bns_trans_creatat)

            $week_wise_sales['total_sale'] = array_map('intval', array_column($week_res, 'total_sale'));
            $week_wise_sales['week'] = array_column($week_res, 'date');

            $statistics['week_wise_total_business_transaction'] = $week_wise_sales['total_sale'];
		    $statistics['week_wise_day_business_transaction'] = $week_wise_sales['week'];
		    
		    
		    $day_res_trans = $this->db->select("DAY(bns_trans_creatat) as date, SUM(bns_trans_amount) as total_sale")
                ->where('bns_trans_creatat >= DATE_SUB(CURDATE(), INTERVAL 29 DAY)')
                ->group_by('day(bns_trans_creatat)')->get('`business_transaction`')->result_array();
            $day_wise_trans['total_sale'] = array_map('intval', array_column($day_res_trans, 'total_sale'));
            $day_wise_trans['day'] = array_column($day_res_trans, 'date');
		    
		    $statistics['day_wise_total_business_transaction'] = $day_wise_trans['total_sale'];
		    $statistics['day_wise_day_business_transaction'] = $day_wise_trans['day'];
		    
		    //print_r($statistics['day_wise_total_business_transaction']);
		
		
		if($_POST)
           {
               $sd = date('Y-m-d',strtotime($this->input->post('start_date')));
                $ed = date('Y-m-d',strtotime($this->input->post('end_date')));
                $statistics['offline_count'] = $this->db->query('SELECT sum(bns_trans_amount) as total_offline FROM business_transaction where bns_trans_mode="Offline" AND bns_trans_date >= "'.$sd.'" AND bns_trans_date <= "'.$ed.'"')->row();
        $statistics['online_count'] = $this->db->query('SELECT sum(bns_trans_amount) as total_online FROM business_transaction where bns_trans_mode="Online" AND bns_trans_date >= "'.$sd.'" AND bns_trans_date <= "'.$ed.'"')->row();
           }
           else
           {
		$statistics['offline_count'] = $this->db->query('SELECT sum(bns_trans_amount) as total_offline FROM business_transaction where bns_trans_mode="Offline" ')->row();
        $statistics['online_count'] = $this->db->query('SELECT sum(bns_trans_amount) as total_online FROM business_transaction where bns_trans_mode="Online" ')->row();
           }
        //echo $statistics['offline_count']->total_offline;exit();
		
		$statistics['users_amount'] = $this->db->count_all_results('user');
		$statistics['user_pending_amount'] = $this->db->where('status', 0)->count_all_results('user');
		$statistics['user_today_amount'] = $this->db->where('created_time>=', my_conversion_from_local_to_server_time(date('Y-m-d'), $this->user_timezone, 'Y-m-d H:i:s'))->count_all_results('user');
		$statistics['user_online_amount'] = $this->db->where('online', 1)->count_all_results('user');
		
		$rs = $this->db->where('type', 'signup_last_six_days')->get('statistics', 1)->row();
		$signup_last_six_days  = json_decode($rs->value, TRUE);
		$signup_last_six_days_date = '';
		$signup_last_six_days_amount = '';
		foreach ($signup_last_six_days as $date=>$amount) {
			$signup_last_six_days_date .= my_conversion_from_server_to_local_time($date, $this->user_timezone, $this->user_date_format) . ',';
			$signup_last_six_days_amount .= $amount . ',';
		}
		$signup_last_six_days_date .= 'Today';
		$signup_last_six_days_amount .= $statistics['user_today_amount'];
		$statistics['signup_last_six_days_date'] = $signup_last_six_days_date;
		$statistics['signup_last_six_days_amount'] = $signup_last_six_days_amount;
		
		return $statistics;
	}
	
  
    public function fetch_sales()
    {
        
            $sales[] = array();

            $month_res = $this->db->select('SUM(bns_trans_amount) AS total_sale,DATE_FORMAT(bns_trans_creatat,"%b") AS month_name ')
                ->where('bns_trans_mode','Offline')
                ->group_by('year(CURDATE()),MONTH(bns_trans_creatat)')
                ->order_by('year(CURDATE()),MONTH(bns_trans_creatat)')
                ->get('`business_transaction`')->result_array();

            //echo $this->db->last_query();


            $month_wise_sales['total_sale'] = array_map('intval', array_column($month_res, 'total_sale'));
            $month_wise_sales['month_name'] = array_column($month_res, 'month_name');

            $sales[0] = $month_wise_sales;
            $d = strtotime("today");
            $start_week = strtotime("last sunday midnight", $d);
            $end_week = strtotime("next saturday", $d);
            $start = date("Y-m-d", $start_week);
            $end = date("Y-m-d", $end_week);
            $week_res = $this->db->select("DATE_FORMAT(bns_trans_creatat, '%d-%b') as date, SUM(bns_trans_amount) as total_sale")
                ->where("date(bns_trans_creatat) >='$start' and date(bns_trans_creatat) <= '$end' ")
                ->group_by('day(bns_trans_creatat)')->get('`business_transaction`')->result_array();
            // print_r($this->db->last_query());

            //select DATE_FORMAT(bns_trans_creatat, '%d-%b') as date,SUM(final_total) as total_sale FROM `orders` WHERE date(bns_trans_creatat) >= '2021-04-11' and date(bns_trans_creatat) <= '2021-04-17' GROUP BY day(bns_trans_creatat)

            $week_wise_sales['total_sale'] = array_map('intval', array_column($week_res, 'total_sale'));
            $week_wise_sales['week'] = array_column($week_res, 'date');

            $sales[1] = $week_wise_sales;

            // $day_res = $this->db->select("DAY(bns_trans_creatat) as date, SUM(final_total) as total_sale")
            //     ->where('bns_trans_creatat >= DATE_SUB(CURDATE(), INTERVAL 31 DAY) AND bns_trans_creatat < DATE_SUB(CURDATE(), INTERVAL 1 DAY)')
            //     ->group_by('day(bns_trans_creatat)')->get('`orders`')->result_array();
            $day_res = $this->db->select("DAY(bns_trans_creatat) as date, SUM(bns_trans_amount) as total_sale")
                ->where('bns_trans_creatat >= DATE_SUB(CURDATE(), INTERVAL 29 DAY)')
                ->group_by('day(bns_trans_creatat)')->get('`business_transaction`')->result_array();
            $day_wise_sales['total_sale'] = array_map('intval', array_column($day_res, 'total_sale'));
            $day_wise_sales['day'] = array_column($day_res, 'date');

            $sales[2] = $day_wise_sales;
            print_r(json_encode($sales));
        
    }

    public function fetch_subscription($date=null,$date1=null)
    {
        if(!empty($date)&&!empty($date1))
        {
            $sd = date('Y-m-d',strtotime($date));
            $ed = date('Y-m-d',strtotime($date1));
            $get_pack_data = $this->db->get('packages')->result_array();
            $html = array();
            foreach($get_pack_data as $val_pack)
            {
                 $eventcatid = $val_pack['pack_id']; 
                 $event_data = $this->db->where('packages_id',$eventcatid)->where('date(created_time) >=',$sd)->where('date(created_time) <=',$ed)->get('user')->num_rows();
                 array_push($html, array($val_pack['pack_name'],$event_data));
            }
            echo json_encode($html);
        }
        else
        {
            $get_pack_data = $this->db->get('packages')->result_array();
            $html = array();
            foreach($get_pack_data as $val_pack)
            {
                 $eventcatid = $val_pack['pack_id']; 
                 $event_data = $this->db->where('packages_id',$eventcatid)->get('user')->num_rows();
                 array_push($html, array($val_pack['pack_name'],$event_data));
            }
            echo json_encode($html);
        }
    }
    
    public function fetch_business_transaction($date=null,$date1=null)
    {
        if(!empty($date)&&!empty($date1))
        {
            $sd = date('Y-m-d',strtotime($date));
            $ed = date('Y-m-d',strtotime($date1));
            $offline = 0;
            $online = 0;
            $offline_count = $this->db->query('SELECT sum(bns_trans_amount) as total_offline FROM business_transaction where bns_trans_mode="Offline" AND bns_trans_date >= "'.$sd.'" AND bns_trans_date <= "'.$ed.'"')->row();
//            echo $this->db->last_query();die;
            $online_count = $this->db->query('SELECT sum(bns_trans_amount) as total_online FROM business_transaction where bns_trans_mode="Online" AND bns_trans_date >= "'.$sd.'" AND bns_trans_date <= "'.$ed.'"')->row();
            $offline = $offline + $offline_count->total_offline;
            $online = $online + $online_count->total_online;
            echo $offline."#".$online;
        }
        else
        {
            $offline = 0;
            $online = 0;
            $offline_count = $this->db->query('SELECT sum(bns_trans_amount) as total_offline FROM business_transaction where bns_trans_mode="Offline" ')->row();
            $online_count = $this->db->query('SELECT sum(bns_trans_amount) as total_online FROM business_transaction where bns_trans_mode="Online" ')->row();
            $offline = $offline + $offline_count->total_offline;
            $online = $online + $online_count->total_online;
            echo $offline."#".$online;
        }
    }
    
    public function fetch_business_transaction1($str)
    {
        if($str == "all")
        {
            
        }
        else
        {
            
        }
    }
     
    public function fetch_event_attendance($date=null,$date1=null)
    {
        if(!empty($date)&&!empty($date1))
        {
            $sd = date('Y-m-d',strtotime($date));
            $ed = date('Y-m-d',strtotime($date1));
            $get_pack_data = $this->db->get('packages')->result_array();
            $html = array();
            foreach($get_pack_data as $val_event)
            {
                 $eventcatid = $val_event['pack_id']; 
                 $user_data = $this->db->where('packages_id',$eventcatid)->get('user')->result();
                 $users = array();
                 if(!empty($user_data))
                 {
                     foreach($user_data as $val)
                     {
                         array_push($users, $val->id);
                     }
                 }
                 if(!empty($users))
                 {
                     $this->db->where_in('booking_userid',$users);
                 }
                 $event_data = $this->db->where('bookin_attedance','1')->where('date(booking_creatat) >=',$sd)->where('date(booking_creatat) <=',$ed)->get('event_booking')->num_rows();

                 array_push($html, array($val_event['pack_name'],$event_data));
             }
            echo json_encode($html);
        }
        else
        {
            $get_pack_data = $this->db->get('packages')->result_array();
            $html = array();
            foreach($get_pack_data as $val_event)
            {
                 $eventcatid = $val_event['pack_id']; 
                 $user_data = $this->db->where('packages_id',$eventcatid)->get('user')->result();
                 $users = array();
                 if(!empty($user_data))
                 {
                     foreach($user_data as $val)
                     {
                         array_push($users, $val->id);
                     }
                 }
                 if(!empty($users))
                 {
                     $this->db->where_in('booking_userid',$users);
                 }
                 $event_data = $this->db->where('bookin_attedance','1')->get('event_booking')->num_rows();

                 array_push($html, array($val_event['pack_name'],$event_data));
             }
            echo json_encode($html);
        }
    }
    
    public function fetch_user_point($date=null,$date1=null)
    {
        if(!empty($date)&&!empty($date1))
        {
            $sd = date('Y-m-d',strtotime($date));
            $ed = date('Y-m-d',strtotime($date1));
            $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where  membership_type !='0' $sql")->result_array();  
        
            foreach($getdata as $query)
            {

                $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query['id'])->where('date(creatat) >=',$sd)->where('date(creatat) <=',$ed)->get('reward_user_point')->row();
                if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}

//                 if($toal_points != "0"){
                 $data_array[] = array(
                    "id"=> $query->id,
                    "full_name"=> $query['full_name'],
                    "total_point"=>$toal_points
                    );
//                 }
            }
	    
	    
	    if(isset($data_array) && !empty($data_array)){
	              array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $data_array), SORT_DESC, $data_array);
	    }
            echo json_encode($data_array);
        }
        else
        {
            $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where  membership_type !='0' $sql")->result_array();  
        
            foreach($getdata as $query)
            {

                $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query['id'])->get('reward_user_point')->row();
                if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}

                 if($toal_points != "0"){
                 $data_array[] = array(
                    "id"=> $query->id,
                    "full_name"=> $query['full_name'],
                    "total_point"=>$toal_points
                    );
                 }
            }
	    
	    
	    if(isset($data_array) && !empty($data_array)){
	              array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $data_array), SORT_DESC, $data_array);
	    }   
            echo json_encode($data_array);
        }
    }

}
?>