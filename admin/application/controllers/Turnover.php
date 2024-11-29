<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turnover extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('global_model');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('turnover/manages'));
	}
	
	
    public function manages()
    {
        $data['title1'] = 'Turn Over';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        
        $data['menu_page'] = 'Masters';                   
        $data['info_data'] = $this->db->order_by('turn_over_id','desc')->get('turn_over')->result();
		my_load_view($this->setting->theme, 'Backend/master/turnover_list', $data);
    }
    
    public function manage($id = null)
    {
       $data['menu_page'] = 'Turn Over'; 
       
       $data['title1'] = 'Turn Over';
       $data['titlelinkstatus1'] = '';
       $data['titlelink1'] = base_url('turnover/manages');
       
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
        
         $this->form_validation->set_rules('event_title', 'Title', 'trim|required');
       	 
       	 
       	
       	 if ($this->form_validation->run() == TRUE)
	     {
		    
		    $res = $this->global_model->save_turn_over($id);
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('turnover/manages'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
	    } 
    
    
          
         $data['turnover_info'] = $this->db->where('turn_over_id',$id)->get('turn_over')->row();
		  my_load_view($this->setting->theme, 'Backend/master/turnover_manages', $data);      
        
    }
	public function deleteturnover()
	{
	    
        $this->db->delete('turn_over', array('turn_over_id'=>my_uri_segment(3)));
		echo '{"result":true, "title":"Deleted", "text":"You request has been completed", "redirect":"' . base_url('turnover') . '"}';
	}
}
?>