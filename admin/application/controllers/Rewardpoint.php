<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewardpoint extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		$this->load->model('Package_model');
    }
	
	
	
	public function index() {
		redirect(base_url('rewardpoint/manages'));
	}
	
	
    public function manages()
    {
        $data['title1'] = 'Reward Point';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        $data['menu_page'] = 'J4E Members';                     
        $data['info_data'] = $this->db->order_by('id','asc')->get('reward_point')->result();
		my_load_view($this->setting->theme, 'Backend/master/rewardpoint_list', $data);
    }
    
   public function managesrewardpoint($id = null)
    {
        $data['title1'] = 'Reward Point';
        $data['titlelinkstatus1'] = '';
        $data['titlelink1'] = base_url('rewardpoint/manages');
       
//        if($id == null)
//        {
//          $data['title2'] = 'Add';
//          $data['titlelinkstatus2'] = 'active';
//          $data['titlelink2'] = '';  
//        }
//        else
//        {
          $data['title2'] = 'Edit';
          $data['titlelinkstatus2'] = 'active';
          $data['titlelink2'] = ''; 
//        }
       
       $data['menu_page'] = 'Reward Point';  
       if ($this->input->server('REQUEST_METHOD') === 'POST') 
       {
        
         $this->form_validation->set_rules('activity', "Activty", 'trim|required');
       	 $this->form_validation->set_rules('description', "Description", 'trim|required');
       	 $this->form_validation->set_rules('point', "Point", 'trim|required');
//       	 $this->form_validation->set_rules('pack_price', my_caption('pack_price'), 'trim|required|numeric|max_length[6]');
       	 
       	 if ($this->form_validation->run() == TRUE)
	     {
		   //  $data = $this->input->post();
//    	 print_r($data);
//    	 die();
		    $res = $this->Package_model->save_rewardpoint($id);
//		       print_r($res);
//    	 die();
			if ($res['result']) {
				$this->session->set_flashdata('flash_success', $res['message']);
				redirect(base_url('rewardpoint/manages'));
				exit();
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
				
			}
		 }
		   
       } 
//        $data['fet_info'] = $this->db->get('features')->result();
        $data['pack_info'] = $this->db->where('id',$id)->get('reward_point')->row();
		my_load_view($this->setting->theme, 'Backend/master/rewardpoint_manages', $data);
    }
	
}
?>