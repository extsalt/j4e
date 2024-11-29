<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro_screen extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Global_model');
    }
	
	
	
	public function index() {
		redirect(base_url('intro_screen/manages'));
	}
	
	
    public function manages()
    {
        $data['title1'] = 'Intro Screen';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('screen_id','desc')->get('intro_screen')->result();
		my_load_view($this->setting->theme, 'Backend/master/intro_screen_list', $data);
    }
    
    
	
	public function managesintroscreen($id = null)
    {
        $data['title1'] = 'Intro Screen';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('intro_screen');
       
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
       
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('screen_title', 'Screen Title', 'trim|required|max_length[500]');
       	 
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
		   $res = $this->Global_model->save_intro_screen($id);
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('intro_screen/manages'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('screen_id',$id)->get('intro_screen')->row();
		my_load_view($this->setting->theme, 'Backend/master/intro_screen_manages', $data);
    }
	
	public function removeimage()
	{
	    $get_data = $this->db->where(array('screen_id'=>my_uri_segment(3)))->get('intro_screen')->row();
	    unlink($get_data->screen_image);
	    
	    $get_data = $this->db->where(array('screen_id'=>my_uri_segment(3)))->set('screen_image','')->update('intro_screen');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('intro_screen/managesintroscreen/'.my_uri_segment(3)) . '"}';
	}
	
	
	
	
//	public function updatestatus()
//    {
//        $this->db->set("status",my_uri_segment(4));
//        $this->db->where("functional_area_id",my_uri_segment(3));
//        $this->db->update('tbl_functional_area');
//		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('functionalarea') . '"}';
//    }
	
	

	
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
    
	public function deleteintro_screen()
	{
	    
        $this->db->delete('intro_screen', array('screen_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('intro_screen') . '"}';
	}
	
	
}
?>