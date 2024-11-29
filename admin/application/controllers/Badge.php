<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Badge extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		
    }
	
	
	
	public function index() {
		redirect(base_url('Badge/manage'));
	}
	
	
	public function manage()
	{
	   $data['menu_page'] = 'Badge List'; 
	   $data['title1'] = 'Badge';
       $data['titlelinkstatus1'] = 'active';
       $data['titlelink1'] = ''; 
	    
	    $data['info_data'] = $this->db->order_by('badge_id','DESC')->get('badge')->result();
		my_load_view($this->setting->theme, 'Backend/batches/batches_list', $data);
	}
	
	
	public function manages($id = null)
    {  //echo $id;exit();
       $data['menu_page'] = 'Badge';   
        
       $data['menu_page'] = 'Badge List'; 
	   $data['title1'] = 'Badge';
       $data['titlelinkstatus1'] = '';
       $data['titlelink1'] = base_url('badge/manage');    
       
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
        
         $this->form_validation->set_rules('title', 'Badge Title', 'trim|required');
       	 $this->form_validation->set_rules('allow_user', 'No of User(s) Allowed', 'trim|required');
       	 
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
		    
		    $res = $this->Global_model->save_badge($id);
			if ($res['result']) {
			    
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('Badge/manage')); 
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        
        $data['info_data'] = $this->db->where(array('badge_id'=>$id))->get('badge')->row();    // print_r($data['info_data']);
		my_load_view($this->setting->theme, 'Backend/batches/manage_batches', $data);
    }
	
    public function file_check($str){
        $allowed_mime_type_arr = array('gif','jpg','jpeg','pjpeg','png','x-png','svg');
        $mime = pathinfo($_FILES['infopic']['name'], PATHINFO_EXTENSION);     
        if(isset($_FILES['infopic']['name']) && $_FILES['infopic']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                $flssize = $_FILES['infopic']['size'];
                if($flssize > $this->setting->imgfilesize)
                {
                  $this->form_validation->set_message('file_check', $this->setting->imgfilesizeerrormsg);
                  return false;  
                }
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
    
    public function deletebadge()
    {
        $get_data = $this->db->where(array('badge_id'=>my_uri_segment(3)))->get('badge')->row();
	    unlink($get_data->badge_image);
        
        
        $this->db->delete('badge', array('badge_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('Badge/manage') . '"}';
    }
	
	public function removeimage()
	{
	    $get_data = $this->db->where(array('badge_id'=>my_uri_segment(3)))->get('badge')->row();
	    unlink($get_data->badge_image);
	    
	    $get_data = $this->db->where(array('badge_id'=>my_uri_segment(3)))->set('badge_image','')->update('badge');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('badge/manages/'.my_uri_segment(3)) . '"}';
	}
	
	
	public function manageassign()
	{
	   $data['title1'] = 'Badge Assign';
       $data['titlelinkstatus1'] = 'active';
       $data['titlelink1'] = ''; 
	   
	   
	   $data['menu_page'] = 'Badge';
	                        $this->db->join('badge','badge.badge_id = badge_assign.assign_badgeid','INNER');
	   $data['info_data'] = $this->db->order_by('assign_id','DESC')->get('badge_assign')->result();
		my_load_view($this->setting->theme, 'Backend/batches/batches_assign_list', $data); 
	}
	
	public function managesassign($id = null)
    {  
       
	   $data['title1'] = 'Badge';
       $data['titlelinkstatus1'] = '';
       $data['titlelink1'] = base_url('badge/manageassign');    
       
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
        
        
        $data['menu_page'] = 'Badge';  
        
        $user_id = my_post('user_id');
        $badge_id = my_post('badge_id');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST') 
        {
		    $res = $this->db->where('assign_userid',$user_id)->get('badge_assign')->num_rows();
			
			if($res == '0')
			{
			    $count_badge = $this->db->select('badge_allow_member')->where('badge_id',$badge_id)->get('badge')->row();
			    
			    
			    
			    if($count_badge->badge_allow_member  > $res)                 
			    {
			        $data_array = array(
			        'assign_badgeid'=>$badge_id,
			        'assign_userid'=>$user_id,
			        );  
    			    $this->db->insert('badge_assign',$data_array);    //print_r($data_array); echo $this->db->last_query();exit();    
    			    $res['message'] = 'User Successfully Assign for Badge';
    				$this->session->set_flashdata('flash_success', $res['message']);
    				redirect(base_url('Badge/manageassign')); 
    				exit();
			    }
			    else
    			{
    			    $res['message'] = 'User Already Assign for Badge';
    				$this->session->set_flashdata('flash_danger', $res['message']);
    			}
			    
			    
			    
			}
			else
			{
			    $res['message'] = 'User Already Assign for Badge';
				$this->session->set_flashdata('flash_danger', $res['message']);
			}
			
			
			
        } 
		   
       
      
        $data['user_data'] = $this->db->select("id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,designation,company,avatar")->where(array('membership_type'=>'2','user_delete'=>'1'))->order_by('full_name','ASC')->get('user')->result_array();
        $data['badge_data'] = $this->db->select('badge_id,badge_title')->where('badge_default','2')->get('badge')->result_array();    
		my_load_view($this->setting->theme, 'Backend/batches/manage_assign_batches', $data);
    }
	
	
	public function getusername($userid)
	{
	    
	    
	    
	    $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        echo $getdata->full_name;
	}
	
	 public function deletebadgeassign()
    {
        
        
        
        $this->db->delete('badge_assign', array('assign_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('Badge/manageassign') . '"}';
    }
	
	
	
	
	
}
?>