<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_review extends MY_Controller {
	
    public function __construct() {
		parent::__construct();
		$this->load->helper('file');
		//$this->load->model('Requirement_model');
    }
	
	
	
	public function index() {
		redirect(base_url('rating_review/manages'));
	}
	
	
    public function manages()
    {
        $data['menu_page'] = 'J4E Rating & Review';
                            $this->db->select("j4e_ratings_reviews.*,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name");
                            $this->db->join('user','j4e_ratings_reviews.userid = user.id','INNER');
        $data['info_data'] = $this->db->order_by('id','desc')->get('j4e_ratings_reviews')->result();
		my_load_view($this->setting->theme, 'Backend/pages/j4erate_review', $data);
    }
    
    public function updatestatus()
    {
        $this->db->set("status",my_uri_segment(4));
        $this->db->where("id",my_uri_segment(3));
        $this->db->update('j4e_ratings_reviews');
		echo '{"result":true, "title":"Status Updated", "text":"You request has been completed", "redirect":"' . base_url('rating_review') . '"}';
    }
    
	
}
?>