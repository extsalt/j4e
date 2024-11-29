<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functionalarea extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Global_model');
    }
	
	
	
	public function index() {
		redirect(base_url('functionalarea/manages'));
	}
	
	
    public function manages()
    {
        $data['title1'] = 'Functional Area';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
       
        $data['menu_page'] = 'Masters';                    
        $data['info_data'] = $this->db->order_by('functional_area_id','desc')->get('tbl_functional_area')->result();
		my_load_view($this->setting->theme, 'Backend/master/functional_area_list', $data);
    }
    
    
	
	public function managesarea($id = null)
    {
        $data['title1'] = 'Functional Area';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('functionalarea');
       
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
        
         $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[500]');
       	 
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
		   $res = $this->Global_model->save_functional_area($id);
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('functionalarea/manages'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('functional_area_id',$id)->get('tbl_functional_area')->row();
		my_load_view($this->setting->theme, 'Backend/master/functional_area_manages', $data);
    }
	
	public function removeimage()
	{
	    $get_data = $this->db->where(array('functional_area_id'=>my_uri_segment(3)))->get('tbl_functional_area')->row();
	    unlink($get_data->functional_area_thumbnil);
	    
	    $get_data = $this->db->where(array('functional_area_id'=>my_uri_segment(3)))->set('functional_area_thumbnil','')->update('tbl_functional_area');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('functionalarea/managesarea/'.my_uri_segment(3)) . '"}';
	}
	
	
	
	
	public function updatestatus()
    {
        $this->db->set("status",my_uri_segment(4));
        $this->db->where("functional_area_id",my_uri_segment(3));
        $this->db->update('tbl_functional_area');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('functionalarea') . '"}';
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
	
	
	
}
?>