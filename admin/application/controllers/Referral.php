<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('Referral/managereferral'));
	}
	
	
    public function managereferral()
    {
        $data['checkper'] = checkpermissions('2');       
        if($data['checkper']['view_per'] == '2')
        {
           redirect(base_url('dashboard'));
           exit();
        }
        
        $data['title1'] = 'Referral';
        $data['titlelinkstatus1'] = 'active';
        $data['titlelink1'] = '';
        
        
        
        $data['menu_page'] = 'Business Transaction';
//        if(!empty($_SESSION['chapter_id']))
//        {
//            $data['user_detail'] = $this->db->select("id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('membership_type','2')->where('chapterid',$_SESSION['chapter_id'])->order_by('full_name','ASC')->get('user')->result_array();
//        }
//        else{
            $data['user_detail'] = $this->db->select("id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('membership_type','2')->order_by('full_name','ASC')->get('user')->result_array();
//        }
        $data['functional_detail'] = $this->db->query("SELECT * from tbl_functional_area")->result_array();
        
        
        
                            $this->db->select("requirements.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name, tbl_functional_area.functional_area");
                            $this->db->join('tbl_functional_area','requirements.functional_area_id = tbl_functional_area.functional_area_id','LEFT');
                            $this->db->join('user','requirements.user_id = user.id','LEFT');
        $data['req_data'] = $this->db->order_by('id','DESC')->where('is_referral','1')->get('requirements')->result();
		my_load_view($this->setting->theme, 'Backend/requirement/referral_list', $data);
    }
    
    
    public function updatestatus()
    {
        $this->db->set("requirements_status",my_uri_segment(4));
        $this->db->where("id",my_uri_segment(3));
        $this->db->update('requirements');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . $_SERVER['HTTP_REFERER'] . '"}';
    }
	
}
?>