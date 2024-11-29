<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Rewards_model');
    }
	
	
	
	public function index() {
		redirect(base_url('rewards/managereward'));
	}
	
	
    public function managereward()
    {
        $data['menu_page'] = 'Masters';
        $data['info_data'] = $this->db->order_by('rewards_id','DESC')->get('rewards')->result();
		my_load_view($this->setting->theme, 'Backend/reward/list_reward', $data);
    }
    
    public function managesrewards($id = null)
    {
       $data['menu_page'] = 'Masters';
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('reward_name', my_caption('reward_name'), 'trim|required|max_length[500]');
         $this->form_validation->set_rules('Description', 'Description', 'trim|required');
       	 $this->form_validation->set_rules('reward_point', my_caption('reward_point'), 'trim|required|numeric');
       	 $this->form_validation->set_rules('reward_day', my_caption('reward_day'), 'trim|required|numeric|max_length[3]');
       	 
       	 
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
		   $res = $this->Rewards_model->save_reward($id);
		   if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('rewards/managereward'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
        
        $data['info_data'] = $this->db->where('rewards_id',$id)->get('rewards')->row();
		my_load_view($this->setting->theme, 'Backend/reward/manage_reward', $data);
    }
	
	public function deletereward() {
		$this->db->delete('rewards', array('rewards_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('rewards/managereward') . '"}';
	}
	
	public function removeimage()
	{
	    $get_data = $this->db->where(array('rewards_id'=>my_uri_segment(3)))->get('rewards')->row();
	    unlink($get_data->reward_thumbnil);
	    
	    $get_data = $this->db->where(array('rewards_id'=>my_uri_segment(3)))->set('reward_thumbnil','')->update('rewards');
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('rewards/managesrewards/'.my_uri_segment(3)) . '"}';
	}
	
	
	
	public function file_check($str){
        $allowed_mime_type_arr = array('gif','jpg','jpeg','pjpeg','png','x-png');
        $mime = pathinfo($_FILES['infopic']['name'], PATHINFO_EXTENSION);     
        if(isset($_FILES['infopic']['name']) && $_FILES['infopic']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
	
	
}
?>