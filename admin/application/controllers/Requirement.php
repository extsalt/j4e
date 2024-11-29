<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirement extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('requirement/managerequirement'));
	}
	
	
    public function managerequirement()
    {
        $data['checkper'] = checkpermissions('2');       
        if($data['checkper']['view_per'] == '2')
        {
           redirect(base_url('dashboard'));
           exit();
        }
        
        $data['title1'] = 'Requirement';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        
        
        $data['menu_page'] = 'Leads / Requirement';
        
                            $this->db->select("requirements.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name, tbl_functional_area.functional_area");
                            $this->db->join('tbl_functional_area','requirements.functional_area_id = tbl_functional_area.functional_area_id','LEFT');
                            $this->db->join('user','requirements.user_id = user.id','LEFT');
        $data['req_data'] = $this->db->where('is_referral','0')->order_by('id','DESC')->get('requirements')->result();
		my_load_view($this->setting->theme, 'Backend/requirement/requirement_list', $data);
    }
    
    
    public function updatestatus()
    {
        $this->db->set("requirements_status",my_uri_segment(4));
        $this->db->where("id",my_uri_segment(3));
        $this->db->update('requirements');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('requirement') . '"}';
    }
	
}
?>