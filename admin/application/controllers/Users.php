<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Rewards_model');
		$this->load->model('global_model');
    }
	
	
	
	public function index() {
		redirect(base_url('users/managebusinesstransaction'));
	}
	public function managespackage($id) {
//		(!my_check_permission('Global Settings')) ? die(my_caption('global_not_enough_permission')) : null; //check permission
	$data['user_id'] = $id;	
            my_load_view($this->setting->theme, 'Admin/manage_package', $data);
	}
	public function managesdetail($userid)
	{
	    redirect(base_url('users/managesaboutus/'.$userid));
	    
	    
	    
	    $data['title1'] = 'User';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('admin/list_users');
        
        $data['title2'] = 'Detail';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
	    
	    $data['menu_page'] = 'J4E Members'; 
	      
	    $data['userids'] = $userid;                     
	    $data['info_data'] = $this->db->where('id',$userid)->get('user')->row();   
		my_load_view($this->setting->theme, 'Backend/users/user_detail', $data);
	}
	
	public function managesaboutus($userid)
	{
	    $data['title1'] = 'User';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('admin/list_users');
        
        $data['title2'] = 'Contactus Detail';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
	    
	    $data['menu_page'] = 'J4E Members'; 
	      
	    $data['userids'] = $userid;          
	          
	                         $this->db->join('turn_over','turn_over.turn_over_id = user.turn_over','left');
	                         $this->db->join('employee','employee.id = user.no_of_employees','left');
	    $data['info_data'] = $this->db->where('user.id',$userid)->get('user')->row();   
		my_load_view($this->setting->theme, 'Backend/users/user_about_detail', $data);
	}
	
	
	public function managescontactus($userid)
	{
	    $data['title1'] = 'User';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('admin/list_users');
        
        $data['title2'] = 'Aboutus Detail';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = '';
	    
	    $data['menu_page'] = 'J4E Members'; 
	      
	    $data['userids'] = $userid;          
	          
	                         $this->db->join('tbl_functional_area','tbl_functional_area.functional_area_id = user.business_category','left');
	    $data['info_data'] = $this->db->where('id',$userid)->get('user')->row();   
		my_load_view($this->setting->theme, 'Backend/users/user_contact_detail', $data);
	}
	
	
	public function managesratereview($userid)
	{
	    $data['title1'] = 'User Rate & Review';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'J4E Members'; 
	      
	    $data['userids'] = $userid;                     
	    
	    $total_no_of_count = 0;
	    $review_note=array();
		$ratingg=0;
		$one_star = $two_star = $three_star = $four_star = $five_star = 0;
		$one_star_user = $two_star_user = $three_star_user = $four_star_user = $five_star_user = 0;
		
		$ratingsss=$this->db->query("select * from ratings_reviews where status = '1' AND user_id='".$userid."' ORDER BY `id` DESC")->result();
		foreach($ratingsss as $rattt)
		{
			            
		  if($rattt->reviewed_by != '')
		  {
		     $ratingg= $ratingg+ floatval($rattt->ratings);
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
		
		$data['one_star'] = $one_star;
		$data['two_star'] = $two_star;
		$data['three_star'] = $three_star;
		$data['four_star'] = $four_star;
		$data['five_star'] = $five_star;
		$data['total_rate_review'] = $total_no_of_count;
		
		$data['average_ratings'] = floatval($ratingg)/floatval($usss);   //print_r($data['average_ratings']);exit();
			        
		$data['avegare_rat'] = number_format((float)$data['average_ratings'], 1, '.', '');
		
		$data['review_note'] = $review_note;	        
			     //   array_push($obj,array("review_star"=>$review_star,"average_ratings"=>$avegare_rat,"total_review_count"=>$totalreviewcount,"all_reviews"=>$review_note));
	    
	    
	    
	    
	    
	    $data['info_data'] = $this->db->where('status','1')->where('user_id',$userid)->order_by('review_date','DESC')->get('ratings_reviews')->result();   
		my_load_view($this->setting->theme, 'Backend/users/user_ratereview', $data);
	}
	
	
	public function managesgallery($userid)
	{
	    $data['title1'] = 'User Gallery';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'J4E Members'; 
	      
	    $data['userids'] = $userid;                     
	    $data['info_data'] = $this->db->where('gallery_type','1')->where('user_id',$userid)->where('status','1')->get('gallery')->result();   
		my_load_view($this->setting->theme, 'Backend/users/user_gallery', $data);
	}
	
	public function deletegallery()
	{
	    $this->db->set('status','2');
	    $this->db->where('id',my_uri_segment(3));
	    $this->db->update('gallery');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('users/managesgallery/'.my_uri_segment(4)) . '"}';
	}
	
	
	public function managebusinesstransaction()
	{
	    $data['title1'] = 'Business Transaction';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'J4E Members'; 
	                         $this->db->select('*,requirements.title as req_title');
	                         $this->db->join('requirements','requirements.id = business_transaction.bns_trans_reqid','INNER');
	    $data['info_data'] = $this->db->order_by('bns_trans_id','DESC')->get('business_transaction')->result();
		my_load_view($this->setting->theme, 'Backend/users/business_transaction_list', $data);
	}
	
	public function manageofflinelead()
	{
	    $data['title1'] = 'Offline Lead';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'J4E Members';                      
	    $data['info_data'] = $this->db->order_by('lead_id','DESC')->get('offline_lead')->result();
		my_load_view($this->setting->theme, 'Backend/users/offlinelead_list', $data);
	}
	
	
	
	public function getusername($userid)
	{
	    
	    $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        echo $getdata->full_name;
	}
	
	public function managerewardpoint()
	{
	    $data['title1'] = 'Reward Point';
	    
	    $data['menu_page'] = 'J4E Members'; 
	                         $this->db->select('id,first_name,middle_name,last_name');
	    $data['info_data'] = $this->db->order_by('id','DESC')->where(array("membership_type !="=>"0"))->get('user')->result();
		my_load_view($this->setting->theme, 'Backend/users/reward_list', $data);
	}
	
	public function assignreward()
	{
	    $data['title1'] = 'Rewards List';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    
	    $data['menu_page'] = 'J4E Members'; 
	                         $this->db->join('rewards','rewards.rewards_id = user_reward.reward_rewardsid','INNER');
	    $data['info_data'] = $this->db->order_by('reward_id','DESC')->get('user_reward')->result();
	    my_load_view($this->setting->theme, 'Backend/users/assignreward_list', $data);
	}
	
	public function manageassignreward()
	{
	    $data['menu_page'] = 'J4E Members'; 
	    $data['user_data'] = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user  where `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F' AND membership_type !='0' AND membership_type !='3' order by full_name ASC")->result();  //AND 
        
        $data['title1'] = 'Assign Rewards to User';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        
        /*
        $query = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user  where `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F' AND membership_type !='0'")->result();  //AND 
        
        foreach($query as $val_user)
        {
           $user_data[] = array(
               'id'=>$val_user->id,
               'full_name'=>$val_user->full_name,
               
               ); 
        }
        
        array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $user_data), SORT_DESC, $user_data);
        
        $data['user_data'] = $user_data;
        */
        
        
        $data['reward_data'] = $this->db->get('rewards')->result();
	    
	    
	    if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('start_date', my_caption('start_date'), 'trim|required|max_length[50]');
       	 /*$this->form_validation->set_rules('pack_desc', my_caption('pack_desc'), 'trim|required');
       	 $this->form_validation->set_rules('pack_duration', my_caption('pack_duration'), 'trim|required');
       	 $this->form_validation->set_rules('pack_price', my_caption('pack_price'), 'trim|required|numeric|max_length[6]');*/
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   
		    $res = $this->Rewards_model->save_assignreward($id);
		      
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('users/assignreward'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
	    
	    
	    
	    
	    my_load_view($this->setting->theme, 'Backend/users/assignreward_manage', $data);
	}
	
	public function getuserreward($userid)
	{
	    $getdata = $this->db->query("select sum(point)as total from reward_user_point where `userid`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata->total))
        {
          echo 0;  
        }
        else
        {
           echo $getdata->total; 
        }
        
        
	}
	
	
	public function notification()
    {
        $data['menu_page'] = 'J4E Members';                     
        $data['info_data'] = $this->db->order_by('id','desc')->get('notification')->result();
		my_load_view($this->setting->theme, 'Backend/users/notification', $data);
    }
	
	
	public function notifications($id = null)
    {
       $data['menu_page'] = 'J4E Event'; 
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('title', 'Title', 'trim|required');
       	 $this->form_validation->set_rules('dec_eng', 'Description', 'trim|required');
       	 
         
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->global_model->save_notification($id);
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('users/notification'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
	    } 
    
    
          
         
		 //$data['info_data'] = $this->db->order_by('booking_id','DESC')->where('booking_eventid',$eventid)->get('event_booking')->result();
		 my_load_view($this->setting->theme, 'Backend/users/manage_notification', $data);      
        
    }
	
	
	public function ratereview()
    {
        $data['title1'] = 'Rate & Review';
        $data['menu_page'] = 'J4E Members'; 
                            $this->db->select("ratings_reviews.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name");
                            $this->db->join('user','ratings_reviews.user_id = user.id','INNER');
        $data['info_data'] = $this->db->order_by('id','desc')->get('ratings_reviews')->result();
		my_load_view($this->setting->theme, 'Backend/users/review', $data);
    }
    
    public function updatestatus()
    {
        $this->db->set("status",my_uri_segment(4));
        $this->db->where("id",my_uri_segment(3));
        $this->db->update('ratings_reviews');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('users/ratereview') . '"}';
    }
    
	
	
	
}
?>