<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buddymeet extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('buddymeet/manages'));
	}
	
	
	public function manages()
	{
	    $data['title1'] = 'Buddy Meet';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
	    
	    $data['menu_page'] = 'Buddy Meet';  
	    $data['info_data'] = $this->db->order_by('buddy_meet_id','DESC')->get('buddy_meet')->result();
		my_load_view($this->setting->theme, 'Backend/buddymeet/buddymeet_list', $data);
	}
	
	public function getusername($userid)
	{
	    $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name from user where `id`=$userid ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        echo $getdata->full_name;
	}
	
	
}
?>