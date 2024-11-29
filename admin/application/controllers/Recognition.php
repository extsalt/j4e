<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recognition extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Global_model');
    }
	
	
	
	public function index() {
		redirect(base_url('recognition/managerecognition'));
	}
	
	
    public function managerecognition()
    {
        $data['title1'] = 'Recognition';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        
        $data['checkper'] = checkpermissions('4');       
        if($data['checkper']['view_per'] == '2')
        {
           redirect(base_url('dashboard'));
           exit();
        }
        
        
        $data['menu_page'] = 'Recognition';
                            $this->db->select("recognition.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name");
                            $this->db->join('user','recognition.recognition_userid = user.id','LEFT');
        $data['recog_data'] = $this->db->order_by('recognition_id','DESC')->get('recognition')->result();
		my_load_view($this->setting->theme, 'Backend/recognition/recognition_list', $data);
    }
    
    
    public function updatestatus()
    {
        $this->db->set("recognition_status",my_uri_segment(4));
        $this->db->where("recognition_id",my_uri_segment(3));
        $this->db->update('recognition');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('recognition') . '"}';
    }
    
    
    
    public function managesrecognition($id = null)
    {

       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('recognition_userid', "User", 'trim|required|max_length[50]');
       	 $this->form_validation->set_rules('recognition_title', "Title", 'trim|required');
       	 $this->form_validation->set_rules('recognition_description', "Description", 'trim|required');
         if(!empty($_FILES['infopic']['name']))
       	     {
       	        $this->form_validation->set_rules('infopic', '', 'callback_file_check');  
       	     }
//       	 $this->form_validation->set_rules('pack_price', my_caption('pack_price'), 'trim|required|numeric|max_length[6]');
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   //  $data = $this->input->post();
    	// print_r($data);
    	// die();
		    $res = $this->Global_model->save_recognition($id);
		      // print_r($res);
    	// die();
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('recognition/managerecognition'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        $data['user_data'] = $this->db->where('membership_type','2')->get('user')->result();
        $data['info_data'] = $this->db->where('recognition_id',$id)->get('recognition')->row();
		my_load_view($this->setting->theme, 'Backend/recognition/recognition_manages', $data);
    }
	public function file_check($str){
        $allowed_mime_type_arr = array('gif','jpg','jpeg','pjpeg','png','x-png');
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
                $this->form_validation->set_message('file_check', 'Please select only jpeg/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
    public function removeimage()
	{
	    $get_data = $this->db->where(array('recognition_id'=>my_uri_segment(3)))->get('recognition')->row();
	    unlink($get_data->recognition_image);
	    
	    $get_data = $this->db->where(array('recognition_id'=>my_uri_segment(3)))->set('recognition_image','')->update('recognition');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('recognition/managesrecognition/'.my_uri_segment(3)) . '"}';
	}
	public function deletepackage() {
		$this->db->delete('packages', array('ids'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('packages/managepackage') . '"}';
	}
	
	
	
	public function managefeature()
    {
        $data['fet_data'] = $this->db->order_by('feature_order','asc')->get('features')->result();
		my_load_view($this->setting->theme, 'Backend/packages/list_feature', $data);
    }

    public function reorderfeature()
    {
    	$data = $this->input->post('page_id_array');
    	// print_r($data);
    	// die();
    	 for($count = 0;  $count < count($data); $count++)
		  {
		  	$res = $this->Package_model->update_package($count+1,$data[$count]);
		  	// echo $data[$count];
		   // $abc[] = $count;
		  	// echo $data['count'];
		   // echo $count;
		   // echo $count+1;
		  }
		  // print_r($count);
    // }
		// my_load_view($this->setting->theme, 'Backend/packages/list_feature', $data);
    }
	
	public function managesfeature($id = null)
    {
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('fet_name', my_caption('fet_name'), 'trim|required|max_length[50]');
       	
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->Package_model->save_feature($id);  
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('packages/managefeature'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
      
        $data['fet_info'] = $this->db->where('ids',$id)->get('features')->row();
		my_load_view($this->setting->theme, 'Backend/packages/manage_feature', $data);
    }
    
    public function deletefeature() {
		$this->db->delete('features', array('ids'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('packages/managefeature') . '"}';
	}
	
}
?>