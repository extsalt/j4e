<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Followup extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('followup/manages'));
	}
	
	
	public function manages()
	{
	     $data['title1'] = 'Follow Up';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'Follow Up'; 
	                         $this->db->select('*,requirements.title as req_title');
	                         $this->db->join('requirements','requirements.id = followup.followup_requirementid','INNER');
	    $data['info_data'] = $this->db->order_by('followup_id','DESC')->get('followup')->result();
		my_load_view($this->setting->theme, 'Backend/followup/followup_list', $data);
	}
	
	public function getusername($userid)
	{
	    $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        echo $getdata->full_name;
	}
	
	
}
?>