<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('user_model'); 
		$this->load->model('global_model');
		
    }
	
	
	
	public function index() {
		redirect(base_url('events/manageevent'));
	}
	
	
    public function manageevent()
    {
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        $data['checkper'] = checkpermissions('5');       
        if($data['checkper']['view_per'] == '2')
        {
           redirect(base_url('dashboard'));
           exit();
        }
        
        $data['menu_page'] = 'J4E Event';
                            $this->db->select("events.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,event_category.event_cat_name");
                            $this->db->join('user','events.event_userid = user.id','LEFT');
                            $this->db->join('event_category','events.event_cat_id = event_category.event_cat_id','LEFT');
        $data['event_data'] = $this->db->order_by('event_id','DESC')->get('events')->result();
		my_load_view($this->setting->theme, 'Backend/event/event_list', $data);
    }
    
    
    public function managesevent($id = null)
    {
       $data['menu_page'] = 'J4E Event'; 
       
       $data['title1'] = 'Event';
       $data['titlelinkstatus1'] = '';
       $data['titlelink1'] = base_url('events/manageevent');
       
       if($id == null)
       {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = ''; 
       }
       else
       {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = ''; 
       }
       
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       { 
        //   echo $this->setting->imgfilesizeerrormsg;
        
         $this->form_validation->set_rules('event_title', 'Title', 'trim|required');
       	 $this->form_validation->set_rules('event_cat_id', 'Category', 'required|callback_check_category_id');
       	 $this->form_validation->set_rules('dec_eng', 'Description', 'trim|required');
       	 $this->form_validation->set_rules('evt_address', 'Address', 'trim|required');
       	 $this->form_validation->set_rules('event_start_date', 'Start Date', 'trim|required');
       	 $this->form_validation->set_rules('event_start_time', 'Start Time', 'trim|required');
       	 $this->form_validation->set_rules('event_end_date', 'End Date', 'trim|required');
       	 $this->form_validation->set_rules('event_end_time', 'End Time', 'trim|required');
       	 
       	 $this->form_validation->set_rules('evt_fee','Member Fees','trim|required');
       	 $this->form_validation->set_rules('evt_guest_fee','Guest Fees','trim|required');
       	 $this->form_validation->set_rules('evt_qty','Qty','trim|required');
       	 
       	 
       	 if($id == null)
       	 {
       	    $this->form_validation->set_rules('infopic', '', 'callback_file_check'); 
       	 }
       	 else
       	 {
       	     if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
       	 }
       	 
         
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->global_model->save_event($id);
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('events'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
	    } 
    
    
         $data['cat_data'] = $this->db->get('event_category')->result_array();  
         $data['evt_info'] = $this->db->where('event_id',$id)->get('events')->row();
         $data['img_info'] = $this->db->where('event_gallery_eventid',$id)->get('event_gallery')->result();
		 //$data['info_data'] = $this->db->order_by('booking_id','DESC')->where('booking_eventid',$eventid)->get('event_booking')->result();
		 my_load_view($this->setting->theme, 'Backend/event/event_manages', $data);      
        
    }
    
   public function file_check($str){
        $allowed_mime_type_arr = array('gif','jpg','jpeg','pjpeg','png','x-png','svg');
        $mime = pathinfo($_FILES['infopic']['name'], PATHINFO_EXTENSION);     
        if(isset($_FILES['infopic']['name']) && $_FILES['infopic']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                $flssize = $_FILES['infopic']['size'];
                // if($flssize > $this->setting->imgfilesize)
                // {
                //   $this->form_validation->set_message('file_check', $this->setting->imgfilesizeerrormsg);
                //   return false;  
                // }
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpeg/jpg/png/svg file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    
    
    function check_category_id($abcd)
    {
        // 'none' is the first option that is default "-------Choose City-------"
        if($abcd=="0"){
        $this->form_validation->set_message('check_category_id', 'Please Select This Field.');
        return false;
        } else{
        // User picked something.
        return true;
        }
    }
    
    
    public function managesbooking($eventid)
    {
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managesevent');
       
        $data['title2'] = 'Booking Details';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = ''; 
       
        
        
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        
                            //$this->db->select("event_booking.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name");
                           // $this->db->join('user','event_booking.booking_userid = user.id','LEFT');
                            
        $data['info_data'] = $this->db->order_by('booking_id','DESC')->where('booking_eventid',$eventid)->get('event_booking')->result();
		my_load_view($this->setting->theme, 'Backend/event/event_bookingdetail', $data);
    }
    
    public function managesattedance($eventid)
    {
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        
                            $this->db->select("event_booking.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name");
                            $this->db->join('user','event_booking.booking_userid = user.id','LEFT');
                            
        $data['info_data'] = $this->db->order_by('booking_id','DESC')->where('booking_eventid',$eventid)->get('event_booking')->result();
		my_load_view($this->setting->theme, 'Backend/event/event_attedance', $data);
    }
    
    public function managesattadance($eventid)
    {
        
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        
                                 //$this->db->select('event_j4e_meet');
                                 //$this->db->join('event_category','event_category.event_cat_id = events.event_id','INNER');
          /*      $get_eventdata = $this->db->select('event_cat_id')->get_where('events',array('event_id'=>$eventid))->row(); 
                $catid = $get_eventdata->event_cat_id;
                $get_eventdatas = $this->db->select('event_j4e_meet')->get_where('event_category',array('event_cat_id'=>$get_eventdata->event_cat_id))->row(); 
        echo $get_eventdatas->event_j4e_meet;
        exit();
        */
        
        $bookingdta = $this->db->order_by('booking_id','DESC')->where('booking_eventid',$eventid)->get('event_booking')->result();
        
        foreach($bookingdta as $val_data)
        {
            $bookingid = $this->input->post('booking_id'.$val_data->booking_id);
            $userid = $this->input->post('user_id'.$val_data->booking_id);
            $status = $this->input->post('booking_status'.$val_data->booking_id);
            
            if($status == '')
            {
                $status = '2';
            }
            
                     $this->db->where(array("booking_id"=>$bookingid,"booking_eventid"=>$eventid,"booking_userid"=>$userid));
                     $this->db->set("bookin_attedance",$status);
            $query = $this->db->update('event_booking');
            
            
            
            if($query && $status == '1')
            {
                    $currentdate = date('d M Y'); 
    		        $currenttime =  date('g:i A'); 
    		        
    		        $get_users_data = $this->db->where(array('id'=>$userid))->get('user')->row();  //echo $this->db->last_query();
    		        $getusername = $this->user_model->getusernames($get_users_data->id);
//    		        $this->user_model->add_reward_point('AttendedtheMeet',$userid,$currentdate,$currenttime,$getusername);  
                    
                
                
                    $get_eventdata = $this->db->select('event_cat_id')->get_where('events',array('event_id'=>$eventid))->row(); 
                    $get_eventdatas = $this->db->select('event_j4e_meet')->get_where('event_category',array('event_cat_id'=>$get_eventdata->event_cat_id))->row(); 
        
                    if($get_eventdatas->event_j4e_meet == '1')
                    {
                      $get_users_data = $this->db->where(array('id'=>$userid))->get('user')->row();  //echo $this->db->last_query();
    		        $getusername = $this->user_model->getusernames($get_users_data->id);
    		        $this->user_model->add_reward_point('TotalNumberofMeetsAttended',$userid,$currentdate,$currenttime,$getusername);    
                    }
                
                
            }
            
            
            
        }
        
        redirect(base_url('events/managesattedance/'.$eventid));
        //echo $data['event_ids'];
        
    
    }
    
    public function managesdetail($eventid)
    {
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managesevent');
       
        $data['title2'] = 'Details';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = ''; 
       
       
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        
                            $this->db->select("events.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,event_category.event_cat_name");
                            $this->db->join('user','events.event_userid = user.id','LEFT');
                            $this->db->join('event_category','events.event_cat_id = event_category.event_cat_id','LEFT');
        $data['event_data'] = $this->db->order_by('event_id','DESC')->where('event_id',$eventid)->get('events')->row();
		my_load_view($this->setting->theme, 'Backend/event/event_detail', $data);
    }
    
    public function managesratereview($eventid)
    {
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managesevent');
       
        $data['title2'] = 'Rate & Review';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = ''; 
        
        $data['event_ids'] = $eventid;
        $data['menu_page'] = 'J4E Event';
                            
        $data['info_data'] = $this->db->order_by('id','DESC')->where('event_id',$eventid)->get('event_ratings_reviews')->result();
		my_load_view($this->setting->theme, 'Backend/event/event_rate_review', $data);
    }
    
    public function deleteeventreview()
	{
	    
        $this->db->delete('event_ratings_reviews', array('id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('events/managesratereview/'.my_uri_segment(4)) . '"}';
	}
    
    
    
    
    
    public function managesinvite($eventid,$type)
    {
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        $data['event_types'] = $type;
        
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managesevent');
       
        
        
        
        if($type == '1')
        {
            $data['title2'] = 'Event Invited (Internal User)';
            $data['titlelinkstatus2'] = 'active';
            $data['titlelink2'] = ''; 
            
            $this->db->select("event_invite_byuserid,CONCAT_WS(' ',first_name,middle_name,last_name) as username, phone as mobileno, email_address as emails, designation as designations, company as cmpname,event_invite_creatdate,event_invite_creattime"); 
            $this->db->join('user','event_invite.event_invite_touserid = user.id','INNER');
            
        }
        else
        {
            $data['title2'] = 'Event Invited (External User)';
            $data['titlelinkstatus2'] = 'active';
            $data['titlelink2'] = ''; 
          $this->db->select('event_invite_byuserid,event_invite_guestname as username, event_invite_mobileno as mobileno, event_invite_email as emails, event_invite_designation as designations, event_invite_companyname as cmpname,event_invite_creatdate,event_invite_creattime'); 
        }
        
        $data['info_data'] = $this->db->order_by('event_invite_id','DESC')->where(array('event_invite_eventid'=>$eventid,'event_invite_type'=>$type))->get('event_invite')->result();
        my_load_view($this->setting->theme, 'Backend/event/event_invite', $data);
    }
    
    
    public function managesattendingstatus($eventid,$type)
    {
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managesevent');
        
        if($type == '1')
        {
            $data['title2'] = 'Interested ';
            $data['titlelinkstatus2'] = 'active';
            $data['titlelink2'] = '';    // event_invite_byuserid
            
            $this->db->select("attend_id,attend_userid,CONCAT_WS(' ',first_name,middle_name,last_name) as username, phone as mobileno, email_address as emails, designation as designations, company as cmpname,attend_creatdate,attend_creattime"); 
            //$this->db->join('event_attending_status','event_attending_status.attend_userid = user.id','left');
            $this->db->join('user','event_attending_status.attend_userid= user.id','left');
            
            
        }
        elseif($type == '2')
        {
            $data['title2'] = 'Attending ';
            $data['titlelinkstatus2'] = 'active';
            $data['titlelink2'] = '';   // event_invite_byuserid
            
            $this->db->select("attend_id,attend_userid,CONCAT_WS(' ',first_name,middle_name,last_name) as username, phone as mobileno, email_address as emails, designation as designations, company as cmpname,attend_creatdate,attend_creattime"); 
            //$this->db->join('event_attending_status','event_attending_status.attend_userid = user.id','left');
            $this->db->join('user','event_attending_status.attend_userid= user.id','left');
        }
        else
        {
            $data['title2'] = 'Maybe';  // event_invite_byuserid
            $data['titlelinkstatus2'] = 'active';
            $data['titlelink2'] = ''; 
          //$this->db->select('attend_id,attend_userid,event_invite_guestname as username, event_invite_mobileno as mobileno, event_invite_email as emails, event_invite_designation as designations, event_invite_companyname as cmpname,attend_creatdate,attend_creattime'); 
        $this->db->select("attend_id,attend_userid,CONCAT_WS(' ',first_name,middle_name,last_name) as username, phone as mobileno, email_address as emails, designation as designations, company as cmpname,attend_creatdate,attend_creattime"); 
            //$this->db->join('event_attending_status','event_attending_status.attend_userid = user.id','left');
            $this->db->join('user','event_attending_status.attend_userid= user.id','left');
            
        }
        
        
        
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        $data['event_types'] = $type;
        
                             //$this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as username, phone as mobileno, email_address as emails, designation as designations, company as cmpname,attend_creattime,attend_creatdate"); 
                             //$this->db->join('user','event_attending_status.attend_userid = user.id','INNER');
        $data['info_data'] = $this->db->order_by('attend_id','DESC')->where(array('attend_eventid'=>$eventid,'attend_type'=>$type))->get('event_attending_status')->result();
        
        //echo $this->db->last_query();
        
        my_load_view($this->setting->theme, 'Backend/event/event_attending_status', $data);
    }
    
    public function manageinvitestatus($eventid)
    {
        $data['menu_page'] = 'J4E Event';
        $data['event_ids'] = $eventid;
        $data['event_types'] = $type;
        
        $data['title1'] = 'Event';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managesevent');
       
        
        
        
        $data['title2'] = 'Guest Invite Pending Approval ';
        $data['titlelinkstatus2'] = 'active';
        $data['titlelink2'] = ''; 
        $this->db->select('event_invite_id,event_invite_byuserid,event_invite_guestname as username, event_invite_mobileno as mobileno, event_invite_email as emails, event_invite_designation as designations, event_invite_companyname as cmpname,event_invite_creatdate,event_invite_creattime'); 
        
        
        
        $data['info_data'] = $this->db->order_by('event_invite_id','DESC')->where(array('event_invite_eventid'=>$eventid,'event_invite_type'=>'2','verification_need'=>'1', 'approval_status'=>'2'))->get('event_invite')->result();
        my_load_view($this->setting->theme, 'Backend/event/event_invite_status', $data);
    }
    
    
    public function updateinvitestatus($invite_id,$eventids)
    {
                 $this->db->where('event_invite_id',$invite_id);
                 $this->db->where('event_invite_eventid',$eventids);
                 $this->db->where('status','3');
                 $this->db->set('approval_status','1');
        $query = $this->db->update('event_invite');
        
        if($query)
        {
          $eventdata = $this->db->where(array('event_invite_id'=>$invite_id,'event_invite_eventid'=>$eventids))->get('event_invite')->row_array();
          
          if($eventdata['payment_by'] == '2')  // GUEST USER
          {
               $rs_email = $this->db->where('purpose', 'invite_email')->get('email_template', 1)->row();   
	           
	           $getevent = $this->db->where('event_id',$eventdata['eventid'])->get('events')->row();
	           
	           $eventschedules = $getevent->event_startdate.' to '.$getevent->event_enddate;
	           
	           
	           $body = str_replace('{{username}}', $eventdata['guestname'], str_replace('{{eventtitle}}',$getevent->event_title , str_replace('{{eventaddress}}',$getevent->event_address , str_replace('{{eventschedule}}',$eventschedules , $rs_email->body))));
		
	
        		$email = array(
        			  'email_to' => $eventdata['emailid'],
        			  'email_subject' => $rs_email->subject,
        			  'email_body' => $body
        		    );
        		$res = my_send_email($email);
          }
          else  // Invite user
          {
              
              $notification = array(
	            'ids'=>my_random(),
	            'by_user_ids'=>$eventdata['event_invite_byuserid'],
	            'to_user_ids'=>$_SESSION['user_id'],
	            'subject'=>'Invite Approval Request Accepted',
	            'body'=>'New Connection Request',
	            'request_for'=>"InviteApproval",
    	        'request_id'=>$invite_id,
	            'is_read' => '0',
	            
	            );
	            //print_r($notification);
	            
	        $this->user_model->add_notification($notification);
              //echo $this->db->last_query();
              //exit();
          }
        }
        
        redirect(base_url('events/manageinvitestatus/'.$eventids));
    }
    
    
    public function getusername($userid)
	{
	    
	    $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        echo $getdata->full_name;
	}
    
    
    public function geteventapproval($eventid)
	{
	    $getdata = $this->db->query("select count(event_invite_id) as totalbooking from event_invite where `event_invite_type`='2' AND `event_invite_eventid`=$eventid AND `verification_need`='1' AND `approval_status`='2'")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totalbooking; 
        }
        
	}
    
    public function geteventtotalbook($eventid)
	{
	    $getdata = $this->db->query("select count(booking_id) as totalbooking from event_booking where `booking_eventid`=$eventid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totalbooking; 
        }
        
	}
	
	public function geteventtotalcomment($eventid)
	{
	    $getdata = $this->db->query("select count(id) as totalcomment from event_ratings_reviews where `event_id`=$eventid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totalcomment; 
        }
        
	}
    
    
    
    public function geteventtotalinvite($eventid,$type)
	{
	    $getdata = $this->db->query("select count(event_invite_id) as totalinvite from event_invite where `event_invite_type`=$type AND `event_invite_eventid`=$eventid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totalinvite; 
        }
        
	}
	
	public function geteventtotalattend($eventid,$type)
	{
	    $getdata = $this->db->query("select count(attend_id) as totalattend from event_attending_status where `attend_type`=$type AND `attend_eventid`=$eventid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        if(empty($getdata))
        {
            echo 0;
        }
        else
        {
           echo $getdata->totalattend; 
        }
        
	}
	
	
	
	public function managecategory()
	{
	    $data['title1'] = 'Event Category';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
       
	    
	    
	    $data['menu_page'] = 'Masters';
	    $data['info_data'] = $this->db->order_by('event_cat_id','asc')->get('event_category')->result();
		my_load_view($this->setting->theme, 'Backend/event/event_category_list', $data);
	}
	
	public function managescategory($id = null)
	{
        $data['title1'] = 'Event Category';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('events/managecategory');
        
        if($id == null)
        {
          $data['title2'] = 'Add';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = '';  
        }
        else
        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = ''; 
        }
        
       
       
       /*
       $data['checkper'] = $this->Global_model->checkpermission('41',$_SESSION['user_ids']);   //print_r($data['checkper']);exit();
       if($data['checkper']['create_per'] == '2' && $data['checkper']['edit_per'] == '2')
       {
          redirect(base_url('dashboard'));
          exit();
       }
       */
       
      $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('event_title', 'Category Name', 'trim|required');
       	 
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Global_model->save_eventcategory($id);
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('events/managecategory'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        
        $data['info_data'] = $this->db->where('event_cat_id',$id)->get('event_category')->row();
		my_load_view($this->setting->theme, 'Backend/event/event_category_manage', $data);
    }
	
	 public function deletecategory()
    {
        
        $this->db->where("event_cat_id",my_uri_segment(3));
        $this->db->delete('event_category');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('events/managecategory') . '"}';
    }
	
		 public function updatepublishstatus()
    {
        $this->db->set("event_publish_status",my_uri_segment(4));
        $this->db->where("event_id",my_uri_segment(3));
        $this->db->update('events');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('events/manageevent') . '"}';
    }
	
	
	 public function updatestatus()
    {
        $this->db->set("event_status",my_uri_segment(4));
        $this->db->where("event_id",my_uri_segment(3));
        $this->db->update('events');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('events/manageevent') . '"}';
    }
    
    
     public function updatecommentstatus()
    {
        $this->db->set("status",my_uri_segment(4));
        $this->db->where("id",my_uri_segment(3));
        $this->db->update('event_ratings_reviews');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('events/managesratereview/'.my_uri_segment(5)) . '"}';
    }
	
	
	public function removesingleeventimage($eventids)
	{
	    
        $this->db->set("event_thumbnil",'');
        $this->db->where("event_id",my_uri_segment(3));
        $this->db->update('events');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('events/managesevent/'.my_uri_segment(3)) . '"}';
	}
	
	public function removeeventimage($img_id,$eventids)
	{
	    
        $this->db->delete('event_gallery', array('event_gallery_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('events/managesevent/'.my_uri_segment(4)) . '"}';
	}
	
	
}
?>