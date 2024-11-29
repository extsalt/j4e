<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct() {
		parent::__construct();
		$this->load->model('admin/Homemodel');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}


	public function check_login()
	{
	  $email = $this->input->post('username');
	  $password =$this->input->post('password');
	  $result = $this->Homemodel->check_login($email,$password);
	
		
		if($result == 1)
		{
		    if ($this->input->post("check_remember") == '1')
            {
                
                $this->input->set_cookie('uemail', $email, 86500); /* Create cookie for store emailid */
                $this->input->set_cookie('upassword', $password, 86500); /* Create cookie for password */
            }
            else
            {
                delete_cookie('uemail'); /* Delete email cookie */
                delete_cookie('upassword'); /* Delete password cookie */
			}
			
			
			$messge = array('message' => 'Successfully','message_title' => 'Login','message_type' => 'success');
            //$this->session->set_flashdata('item', $messge);
            //echo '<script>alert("Login Successfully")</script>';
           	redirect(base_url('main_slider'));
		}
		else{
			$messge = array('message' => 'Email or Password wrong','message_title' => 'Please Try Again','message_type' => 'error');
			//$this->session->set_flashdata('item', $messge);
			//echo '<script>alert("Email or Password wrong")</script>';
			redirect(base_url('admin'));
			
		}
	}

	
	public function dashboard()
	{

	  $data['menu_name'] = 'dashboard';
	  $data['submenu_name'] = 'dashboard';
	  $data['page_name'] = "Dashboard"; 
	  $data['page_Title'] = "Dashboard"; 
	  $data['page_Subtitle'] = "Dashboard"; 
	  $data['page_type'] = "Dashboard";
	  $data['pageview'] = $this->load->view('admin/dashboard' , $data , true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function main_slider()
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'main_slider';
	  $data['page_name'] = "Main Slider"; 
	  $data['page_Title'] = "Main Slider"; 
	  $data['page_Subtitle'] = "Main Slider"; 
	  $data['page_type'] = "Main Slider";
	  $data['homedata'] = $this->db->order_by('seq_no')->get_where('slider', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/homepage/list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function achivements_list()
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'achivements';
	  $data['page_name'] = "Achivements"; 
	  $data['page_Title'] = "Achivements"; 
	  $data['page_Subtitle'] = "Achivements"; 
	  $data['page_type'] = "Achivements";
	  $data['homedata'] = $this->db->order_by('seq_no')->get_where('achievements', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/homepage/achivements_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function clients_list()
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'clients';
	  $data['page_name'] = "Clients Listing"; 
	  $data['page_Title'] = "Clients Listing"; 
	  $data['page_Subtitle'] = "Clients Listing"; 
	  $data['page_type'] = "Clients Listing";
	  $data['homedata'] = $this->db->order_by('seq_no')->get_where('clients', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/homepage/clients_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function thoughts_list()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'thoughts';
	  $data['page_name'] = "Thoughts"; 
	  $data['page_Title'] = "Thoughts"; 
	  $data['page_Subtitle'] = "Thoughts"; 
	  $data['page_type'] = "Thoughts";
	  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('about_thoughts', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/about_thoughts' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function highlights_list()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'highlights';
	  $data['page_name'] = "Highlights"; 
	  $data['page_Title'] = "Highlights"; 
	  $data['page_Subtitle'] = "Highlights"; 
	  $data['page_type'] = "Highlights";
	  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('highlights', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/highlights_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function history_list()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'history';
	  $data['page_name'] = "History"; 
	  $data['page_Title'] = "History"; 
	  $data['page_Subtitle'] = "History"; 
	  $data['page_type'] = "History";
	  $data['aboutdata'] = $this->db->get_where('history', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/history_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function our_team_list()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'our_team';
	  $data['page_name'] = "Our Team"; 
	  $data['page_Title'] = "Our Team"; 
	  $data['page_Subtitle'] = "Our Team"; 
	  $data['page_type'] = "Our Team";
	  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('our_team', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/ourteam_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function services_list()
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_list';
	  $data['page_name'] = "Services"; 
	  $data['page_Title'] = "Services"; 
	  $data['page_Subtitle'] = "Services"; 
	  $data['page_type'] = "Services";
	  $data['servicedata'] = $this->db->order_by('seq_no')->get_where('services', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/services/services_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function service_benefits()
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_benefits';
	  $data['page_name'] = "Services Benefits"; 
	  $data['page_Title'] = "Services Benefits"; 
	  $data['page_Subtitle'] = "Services Benefits"; 
	  $data['page_type'] = "Services Benefits";
	  $data['servicedata'] = $this->db->order_by('seq_no')->get_where('service_benefits', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/services/service_benefits' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function contact_us()
	{
 	  $data['menu_name'] = 'contact';
	  $data['submenu_name'] = 'contact';
	  $data['page_name'] = "Contact"; 
	  $data['page_Title'] = "Contact"; 
	  $data['page_Subtitle'] = "Contact"; 
	  $data['page_type'] = "Contact";
	  //$data['servicedata'] = $this->db->order_by('seq_no')->get_where('service_benefits', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/contact_us' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_service()
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_list';
	  $data['page_name'] = "Add Service"; 
	  $data['page_Title'] = "Add Service"; 
	  $data['page_Subtitle'] = "Add Service"; 
	  $data['page_type'] = "Add Service";
	 // $data['servicedata'] = $this->db->order_by('seq_no')->get_where('service_benefits', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/services/add_service' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_service($id)
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_list';
	  $data['page_name'] = "Edit Service"; 
	  $data['page_Title'] = "Edit Service"; 
	  $data['page_Subtitle'] = "Edit Service"; 
	  $data['page_type'] = "Edit Service";
	  $data['settingdata'] = $this->db->get_where('services', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/services/edit_service' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_service($id)
	{
	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_list';
	  $data['page_name'] = "Delete Service"; 
	  $data['page_Title'] = "Delete Service"; 
	  $data['page_Subtitle'] = "Delete Service"; 
	  $data['page_type'] = "Delete Service";
	  $data['settingdata'] = $this->db->get_where('services', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/services/delete_service' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_service_benefit()
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_benefits';
	  $data['page_name'] = "Add Service Benefit"; 
	  $data['page_Title'] = "Add Service Benefit"; 
	  $data['page_Subtitle'] = "Add Service Benefit"; 
	  $data['page_type'] = "Add Service Benefit";
	 // $data['servicedata'] = $this->db->order_by('seq_no')->get_where('service_benefits', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/services/add_service_benefit' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_service_benefit($id)
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_benefits';
	  $data['page_name'] = "Edit Service Benefit"; 
	  $data['page_Title'] = "Edit Service Benefit"; 
	  $data['page_Subtitle'] = "Edit Service Benefit"; 
	  $data['page_type'] = "Edit Service Benefit";
	  $data['settingdata'] = $this->db->get_where('service_benefits', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/services/edit_service_benefit' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_service_benefit($id)
	{
 	  $data['menu_name'] = 'services';
	  $data['submenu_name'] = 'services_benefits';
	  $data['page_name'] = "Delete Service Benefit"; 
	  $data['page_Title'] = "Delete Service Benefit"; 
	  $data['page_Subtitle'] = "Delete Service Benefit"; 
	  $data['page_type'] = "Delete Service Benefit";
	  $data['settingdata'] = $this->db->get_where('service_benefits', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/services/delete_service_benefit' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function testimonials()
	{
 	  $data['menu_name'] = 'testimonials';
	  $data['submenu_name'] = 'testimonials';
	  $data['page_name'] = "Testimonials"; 
	  $data['page_Title'] = "Testimonials"; 
	  $data['page_Subtitle'] = "Testimonials"; 
	  $data['page_type'] = "Testimonials";
	  $data['testidata'] = $this->db->order_by('seq_no')->get_where('testimonials', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/testinomial/list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_testimonial($id)
	{
 	  $data['menu_name'] = 'testimonials';
	  $data['submenu_name'] = 'testimonials';
	  $data['page_name'] = "Edit Testimonial"; 
	  $data['page_Title'] = "Edit Testimonial"; 
	  $data['page_Subtitle'] = "Edit Testimonial"; 
	  $data['page_type'] = "Edit Testimonial";
	  $data['row'] = $this->db->get_where('testimonials', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/testinomial/edit_testimonial' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_testimonial($id)
	{
 	  $data['menu_name'] = 'testimonials';
	  $data['submenu_name'] = 'testimonials';
	  $data['page_name'] = "Delete Testimonial"; 
	  $data['page_Title'] = "Delete Testimonial"; 
	  $data['page_Subtitle'] = "Delete Testimonial"; 
	  $data['page_type'] = "Delete Testimonial";
	  $data['row'] = $this->db->get_where('testimonials', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/testinomial/delete_testimonial' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function events_list()
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'event';
	  $data['page_name'] = "Events"; 
	  $data['page_Title'] = "Events"; 
	  $data['page_Subtitle'] = "Events"; 
	  $data['page_type'] = "Events";
	  $data['eventdata'] = $this->db->get_where('events', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/event/eventlist' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_event($id)
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'event';
	  $data['page_name'] = "Edit Event"; 
	  $data['page_Title'] = "Edit Event"; 
	  $data['page_Subtitle'] = "Edit Event"; 
	  $data['page_type'] = "Edit Event";
	  $data['row'] = $this->db->get_where('events', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/event/edit_event' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_event($id)
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'event';
	  $data['page_name'] = "Delete Event"; 
	  $data['page_Title'] = "Delete Event"; 
	  $data['page_Subtitle'] = "Delete Event"; 
	  $data['page_type'] = "Delete Event";
	  $data['row'] = $this->db->get_where('events', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/event/delete_event' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_event()
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'event';
	  $data['page_name'] = "Add Event"; 
	  $data['page_Title'] = "Add Event"; 
	  $data['page_Subtitle'] = "Add Event"; 
	  $data['page_type'] = "Add Event";
	 // $data['eventdata'] = $this->db->get_where('events', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/event/add_event' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function images_list()
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'image_gallery';
	  $data['page_name'] = "Image Gallery"; 
	  $data['page_Title'] = "Image Gallery"; 
	  $data['page_Subtitle'] = "Image Gallery"; 
	  $data['page_type'] = "Image Gallery";
	  $data['eventdata'] = $this->db->get_where('image_gallery', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/event/imageslist' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_image($id)
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'image_gallery';
	  $data['page_name'] = "Edit Image"; 
	  $data['page_Title'] = "Edit Image"; 
	  $data['page_Subtitle'] = "Edit Image"; 
	  $data['page_type'] = "Edit Image";
	  $data['row'] = $this->db->get_where('image_gallery', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/event/edit_image' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_image($id)
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'image_gallery';
	  $data['page_name'] = "Delete Image"; 
	  $data['page_Title'] = "Delete Image"; 
	  $data['page_Subtitle'] = "Delete Image"; 
	  $data['page_type'] = "Delete Image";
	  $data['row'] = $this->db->get_where('image_gallery', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/event/delete_image' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function videos_list()
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'video_gallery';
	  $data['page_name'] = "Video Gallery"; 
	  $data['page_Title'] = "Video Gallery"; 
	  $data['page_Subtitle'] = "Video Gallery"; 
	  $data['page_type'] = "Video Gallery";
	  $data['eventdata'] = $this->db->get_where('video_gallery', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/event/videoslist' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_video($id)
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'video_gallery';
	  $data['page_name'] = "Edit Video"; 
	  $data['page_Title'] = "Edit Video"; 
	  $data['page_Subtitle'] = "Edit Video"; 
	  $data['page_type'] = "Edit Video";
	  $data['row'] = $this->db->get_where('video_gallery', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/event/edit_video' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_video($id)
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'video_gallery';
	  $data['page_name'] = "Delete Video"; 
	  $data['page_Title'] = "Delete Video"; 
	  $data['page_Subtitle'] = "Delete Video"; 
	  $data['page_type'] = "Delete Video";
	  $data['row'] = $this->db->get_where('video_gallery', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/event/delete_video' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function product_type()
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'product_type';
	  $data['page_name'] = "Product Type"; 
	  $data['page_Title'] = "Product Type"; 
	  $data['page_Subtitle'] = "Product Type"; 
	  $data['page_type'] = "Product Type";
	  $data['settingdata'] = $this->db->order_by('seq_no')->get_where('product_type', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/setting/product_type' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_product_type()
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'product_type';
	  $data['page_name'] = "Add Product Type"; 
	  $data['page_Title'] = "Add Product Type"; 
	  $data['page_Subtitle'] = "Add Product Type"; 
	  $data['page_type'] = "Add Product Type";
	  //$data['settingdata'] = $this->db->order_by('seq_no')->get_where('product_type', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/setting/add_product_type' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_product_type($id)
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'product_type';
	  $data['page_name'] = "Edit Product Type"; 
	  $data['page_Title'] = "Edit Product Type"; 
	  $data['page_Subtitle'] = "Edit Product Type"; 
	  $data['page_type'] = "Edit Product Type";
	  $data['row'] = $this->db->get_where('product_type', array('id'=>$id))->row_array();
	  //$data['settingdata'] = $this->db->order_by('seq_no')->get_where('product_type', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/setting/edit_type' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function settings_list()
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'settings_list';
	  $data['page_name'] = "Settings"; 
	  $data['page_Title'] = "Settings"; 
	  $data['page_Subtitle'] = "Settings"; 
	  $data['page_type'] = "Settings";
	  $data['settingdata'] = $this->db->get_where('settings', array('id'=>'1'))->result();
	  $data['pageview'] = $this->load->view('admin/setting/settings_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function users_list()
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'users_list';
	  $data['page_name'] = "Users"; 
	  $data['page_Title'] = "Users"; 
	  $data['page_Subtitle'] = "Users"; 
	  $data['page_type'] = "Users";
	  $data['settingdata'] = $this->db->get_where('login', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/setting/users_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function category_list($id)
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'category_list';
	  $data['page_name'] = "Category List"; 
	  $data['page_Title'] = "Category List"; 
	  $data['page_Subtitle'] = "Category List"; 
	  $data['page_type'] = "Category List";
	  $data['id'] = $id;
	  $data['settingdata'] = $this->db->get_where('category', array('delete_status'=>'0' , 'type'=>$id))->result();
	  $data['pageview'] = $this->load->view('admin/setting/category_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function products_list($id)
	{
 	  $data['menu_name'] = 'products';
	  $data['submenu_name'] = 'products_list';
	  $data['page_name'] = "Products List"; 
	  $data['page_Title'] = "Products List"; 
	  $data['page_Subtitle'] = "Products List"; 
	  $data['page_type'] = "Products List";
	  $data['id'] = $id;
	  $data['settingdata'] = $this->db->get_where('category', array('delete_status'=>'0' , 'type'=>$id))->result();
	  $data['pageview'] = $this->load->view('admin/setting/products_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_category($id)
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'category_list';
	  $data['page_name'] = "Add Category"; 
	  $data['page_Title'] = "Add Category"; 
	  $data['page_Subtitle'] = "Add Category"; 
	  $data['page_type'] = "Add Category";
	  $data['id'] = $id;
	  //$data['settingdata'] = $this->db->get_where('category', array('delete_status'=>'0' , 'type'=>$id))->result();
	  $data['pageview'] = $this->load->view('admin/setting/add_category' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_products($id)
	{
 	  $data['menu_name'] = 'products';
	  $data['submenu_name'] = 'products_list';
	  $data['page_name'] = "Add Products"; 
	  $data['page_Title'] = "Add Products"; 
	  $data['page_Subtitle'] = "Add Products"; 
	  $data['page_type'] = "Add Products";
	  $data['id'] = $id;
	  //$data['settingdata'] = $this->db->get_where('category', array('delete_status'=>'0' , 'type'=>$id))->result();
	  $data['pageview'] = $this->load->view('admin/setting/add_products' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_products($id)
	{
 	  $data['menu_name'] = 'products';
	  $data['submenu_name'] = 'products_list';
	  $data['page_name'] = "Edit Products"; 
	  $data['page_Title'] = "Edit Products"; 
	  $data['page_Subtitle'] = "Edit Products"; 
	  $data['page_type'] = "Edit Products";
	  //$data['id'] = $id;
	  $data['row'] = $this->db->get_where('category', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/edit_products' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_products($id)
	{
	  $data['menu_name'] = 'products';
	  $data['submenu_name'] = 'products_list';
	  $data['page_name'] = "Delete Products"; 
	  $data['page_Title'] = "Delete Products"; 
	  $data['page_Subtitle'] = "Delete Products"; 
	  $data['page_type'] = "Delete Products";
	  //$data['id'] = $id;
	  $data['row'] = $this->db->get_where('category', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/delete_products' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_category($id)
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'category_list';
	  $data['page_name'] = "Edit Category"; 
	  $data['page_Title'] = "Edit Category"; 
	  $data['page_Subtitle'] = "Edit Category"; 
	  $data['page_type'] = "Edit Category";
	  //$data['id'] = $id;
	  $data['row'] = $this->db->get_where('category', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/edit_category' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_category($id)
	{
	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'category_list';
	  $data['page_name'] = "Delete Category"; 
	  $data['page_Title'] = "Delete Category"; 
	  $data['page_Subtitle'] = "Delete Category"; 
	  $data['page_type'] = "Delete Category";
	  //$data['id'] = $id;
	  $data['row'] = $this->db->get_where('category', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/delete_category' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function subcategory_list($id)
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'subcategory_list';
	  $data['page_name'] = "Sub Category List"; 
	  $data['page_Title'] = "Sub Category List"; 
	  $data['page_Subtitle'] = "Sub Category List"; 
	  $data['page_type'] = "Sub Category List";
	  $data['id'] = $id;
	  $data['settingdata'] = $this->db->get_where('subcategory', array('delete_status'=>'0' , 'category'=>$id))->result();
	  $data['pageview'] = $this->load->view('admin/setting/sub_category_list' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_sub_category($id)
	{
	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'subcategory_list';
	  $data['page_name'] = "Add Sub Category List"; 
	  $data['page_Title'] = "Add Sub Category List"; 
	  $data['page_Subtitle'] = "Add Sub Category List"; 
	  $data['page_type'] = "Add Sub Category List";
	  $data['id'] = $id;
	 // $data['settingdata'] = $this->db->get_where('subcategory', array('delete_status'=>'0' , 'category'=>$id))->result();
	  $data['pageview'] = $this->load->view('admin/setting/add_sub_category' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_sub_category($id)
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'subcategory_list';
	  $data['page_name'] = "Edit Sub Category"; 
	  $data['page_Title'] = "Edit Sub Category"; 
	  $data['page_Subtitle'] = "Edit Sub Category"; 
	  $data['page_type'] = "Edit Sub Category";
	  //$data['id'] = $id;
	  $data['row'] = $this->db->get_where('subcategory', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/edit_subcategory' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_sub_category($id)
	{
	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'subcategory_list';
	  $data['page_name'] = "Delete Sub Category"; 
	  $data['page_Title'] = "Delete Sub Category"; 
	  $data['page_Subtitle'] = "Delete Sub Category"; 
	  $data['page_type'] = "Delete Sub Category";
	  //$data['id'] = $id;
	  $data['row'] = $this->db->get_where('subcategory', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/delete_subcategory' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}


	public function add_slide()
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'main_slider';
	  $data['page_name'] = "Main Slider"; 
	  $data['page_Title'] = "Main Slider"; 
	  $data['page_Subtitle'] = "Main Slider"; 
	  $data['page_type'] = "Main Slider";
	//  $data['settingdata'] = $this->db->get_where('login', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/homepage/add_slide' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_slide($id)
	{
	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'main_slider';
	  $data['page_name'] = "Main Slider"; 
	  $data['page_Title'] = "Main Slider"; 
	  $data['page_Subtitle'] = "Main Slider"; 
	  $data['page_type'] = "Main Slider";
	  $data['settingdata'] = $this->db->get_where('slider', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/homepage/manages' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_slide($id)
	{
	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'main_slider';
	  $data['page_name'] = "Main Slider"; 
	  $data['page_Title'] = "Main Slider"; 
	  $data['page_Subtitle'] = "Main Slider"; 
	  $data['page_type'] = "Main Slider";
	  $data['settingdata'] = $this->db->get_where('slider', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/homepage/delete_slide' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_achievement()
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'achivements';
	  $data['page_name'] = "Achivements"; 
	  $data['page_Title'] = "Achivements"; 
	  $data['page_Subtitle'] = "Achivements"; 
	  $data['page_type'] = "Achivements";
	//  $data['settingdata'] = $this->db->get_where('login', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/homepage/add_achievement' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_achivement($id)
	{
	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'achivements';
	  $data['page_name'] = "Achivements"; 
	  $data['page_Title'] = "Achivements"; 
	  $data['page_Subtitle'] = "Achivements"; 
	  $data['page_type'] = "Achivements";
	  $data['settingdata'] = $this->db->get_where('achievements', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/homepage/edit_achivement' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_achivement($id)
	{
	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'achivements';
	  $data['page_name'] = "Achivements"; 
	  $data['page_Title'] = "Achivements"; 
	  $data['page_Subtitle'] = "Achivements"; 
	  $data['page_type'] = "Achivements";
	  $data['settingdata'] = $this->db->get_where('achievements', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/homepage/delete_achivement' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}


	public function add_client()
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'clients';
	  $data['page_name'] = "Clients"; 
	  $data['page_Title'] = "Clients"; 
	  $data['page_Subtitle'] = "Clients"; 
	  $data['page_type'] = "Clients";
	//  $data['settingdata'] = $this->db->get_where('login', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/homepage/add_client' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_client($id)
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'clients';
	  $data['page_name'] = "Clients"; 
	  $data['page_Title'] = "Clients"; 
	  $data['page_Subtitle'] = "Clients"; 
	  $data['page_type'] = "Clients";
	  $data['settingdata'] = $this->db->get_where('clients', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/homepage/edit_client' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_client($id)
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'clients';
	  $data['page_name'] = "Clients"; 
	  $data['page_Title'] = "Clients"; 
	  $data['page_Subtitle'] = "Clients"; 
	  $data['page_type'] = "Clients";
	  $data['settingdata'] = $this->db->get_where('clients', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/homepage/delete_client' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_thought()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'thoughts';
	  $data['page_name'] = "Add Thought"; 
	  $data['page_Title'] = "Add Thought"; 
	  $data['page_Subtitle'] = "Add Thought"; 
	  $data['page_type'] = "Add Thought";
	//  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('about_thoughts', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/add_thought' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_thought($id)
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'thoughts';
	  $data['page_name'] = "Edit Thought"; 
	  $data['page_Title'] = "Edit Thought"; 
	  $data['page_Subtitle'] = "Edit Thought"; 
	  $data['page_type'] = "Edit Thought";
	  $data['settingdata'] = $this->db->get_where('about_thoughts', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/edit_thought' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_thought($id)
	{
	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'thoughts';
	  $data['page_name'] = "Delete Thought"; 
	  $data['page_Title'] = "Delete Thought"; 
	  $data['page_Subtitle'] = "Delete Thought"; 
	  $data['page_type'] = "Delete Thought";
	  $data['settingdata'] = $this->db->get_where('about_thoughts', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/delete_thought' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_member()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'our_team';
	  $data['page_name'] = "Add Member"; 
	  $data['page_Title'] = "Add Member"; 
	  $data['page_Subtitle'] = "Add Member"; 
	  $data['page_type'] = "Add Member";
	//  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('about_thoughts', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/add_member' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_member($id)
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'our_team';
	  $data['page_name'] = "Edit Member"; 
	  $data['page_Title'] = "Edit Member"; 
	  $data['page_Subtitle'] = "Edit Member"; 
	  $data['page_type'] = "Edit Member";
	  $data['settingdata'] = $this->db->get_where('our_team', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/edit_team' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_member($id)
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'our_team';
	  $data['page_name'] = "Delete Member"; 
	  $data['page_Title'] = "Delete Member"; 
	  $data['page_Subtitle'] = "Delete Member"; 
	  $data['page_type'] = "Delete Member";
	  $data['settingdata'] = $this->db->get_where('our_team', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/delete_team' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function overview()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'overview';
	  $data['page_name'] = "Overview"; 
	  $data['page_Title'] = "Overview"; 
	  $data['page_Subtitle'] = "Overview"; 
	  $data['page_type'] = "Overview";
	//  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('about_thoughts', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/overview' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_highlight()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'highlights';
	  $data['page_name'] = "Add Highlight"; 
	  $data['page_Title'] = "Add Highlight"; 
	  $data['page_Subtitle'] = "Add Highlight"; 
	  $data['page_type'] = "Add Highlight";
	//  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('about_thoughts', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/add_highlight' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_highlight($id)
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'highlights';
	  $data['page_name'] = "Edit Highlight"; 
	  $data['page_Title'] = "Edit Highlight"; 
	  $data['page_Subtitle'] = "Edit Highlight"; 
	  $data['page_type'] = "Edit Highlight";
	  $data['settingdata'] = $this->db->get_where('highlights', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/edit_highlight' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_highlight($id)
	{
	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'highlights';
	  $data['page_name'] = "Delete Highlight"; 
	  $data['page_Title'] = "Delete Highlight"; 
	  $data['page_Subtitle'] = "Delete Highlight"; 
	  $data['page_type'] = "Delete Highlight";
	  $data['settingdata'] = $this->db->get_where('highlights', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/delete_highlight' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_type($id)
	{
	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'product_type';
	  $data['page_name'] = "Delete Product Type"; 
	  $data['page_Title'] = "Delete Product Type"; 
	  $data['page_Subtitle'] = "Delete Product Type";
	  $data['page_type'] = "Delete Product Type";
	  $data['row'] = $this->db->get_where('product_type', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/delete_type' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_history()
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'history';
	  $data['page_name'] = "Add History"; 
	  $data['page_Title'] = "Add History"; 
	  $data['page_Subtitle'] = "Add History"; 
	  $data['page_type'] = "Add History";
	//  $data['aboutdata'] = $this->db->order_by('seq_no')->get_where('about_thoughts', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/aboutus/add_history' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_history($id)
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'history';
	  $data['page_name'] = "Edit History"; 
	  $data['page_Title'] = "Edit History"; 
	  $data['page_Subtitle'] = "Edit History"; 
	  $data['page_type'] = "Edit History";
	  $data['settingdata'] = $this->db->get_where('history', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/edit_history' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function delete_history($id)
	{
 	  $data['menu_name'] = 'about_us';
	  $data['submenu_name'] = 'history';
	  $data['page_name'] = "Delete History"; 
	  $data['page_Title'] = "Delete History"; 
	  $data['page_Subtitle'] = "Delete History"; 
	  $data['page_type'] = "Delete History";
	  $data['settingdata'] = $this->db->get_where('history', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/aboutus/delete_history' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_testimonials()
	{
 	  $data['menu_name'] = 'testimonials';
	  $data['submenu_name'] = 'testimonials';
	  $data['page_name'] = "Testimonials"; 
	  $data['page_Title'] = "Testimonials"; 
	  $data['page_Subtitle'] = "Testimonials"; 
	  $data['page_type'] = "Testimonials";
	 // $data['testidata'] = $this->db->order_by('seq_no')->get_where('testimonials', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/testinomial/add_testimonial' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_images()
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'image_gallery';
	  $data['page_name'] = "Add Image"; 
	  $data['page_Title'] = "Add Image"; 
	  $data['page_Subtitle'] = "Add Image"; 
	  $data['page_type'] = "Add Image";
	 // $data['eventdata'] = $this->db->get_where('image_gallery', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/event/add_image' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_videos()
	{
 	  $data['menu_name'] = 'events';
	  $data['submenu_name'] = 'video_gallery';
	  $data['page_name'] = "Add Video"; 
	  $data['page_Title'] = "Add Video"; 
	  $data['page_Subtitle'] = "Add Video"; 
	  $data['page_type'] = "Add Video";
	 // $data['eventdata'] = $this->db->get_where('image_gallery', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/event/add_video' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function add_user()
	{
 	  $data['menu_name'] = 'settings';
	  $data['submenu_name'] = 'users_list';
	  $data['page_name'] = "Add User"; 
	  $data['page_Title'] = "Add User"; 
	  $data['page_Subtitle'] = "Add User"; 
	  $data['page_type'] = "Add User";
	 // $data['settingdata'] = $this->db->get_where('login', array('delete_status'=>'0'))->result();
	  $data['pageview'] = $this->load->view('admin/setting/add_user' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function edit_user($id)
	{
 	  $data['menu_name'] = 'home_page';
	  $data['submenu_name'] = 'clients';
	  $data['page_name'] = "Edit User"; 
	  $data['page_Title'] = "Edit User"; 
	  $data['page_Subtitle'] = "Edit User"; 
	  $data['page_type'] = "Edit User";
	  $data['row'] = $this->db->get_where('login', array('id'=>$id))->row_array();
	  $data['pageview'] = $this->load->view('admin/setting/edit_profile' , $data, true);  
	  $this->load->view('admin/mainpages' , $data);
	}

	public function logout()
	{
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'username' && $key != 'id' && $key != 'is_user_login') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
    redirect(base_url('admin'));
	}
	
	public function add_slide_fn()
	{
		
        $seq_arr = $this->Homemodel->get_seq('slider')->row_array();
        $seq = $seq_arr['seq_no'] + 1;
        $uploaddir = "";
        if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image' ][ 'size' ];
	$uploaded_type = mime_content_type($_FILES[ 'image' ][ 'tmp_name' ]);
	$uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
		getimagesize( $uploaded_tmp ) ) {
         $uploaddir = 'uploads/slider/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir);
        
                }
                else{
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                    redirect(base_url('main_slider'));
                }
        }
//           $uploaddir = "";
//   		 if($_FILES['image']['name'] != "")
//   			{
//  			  $uploaddir = 'uploads/slider/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//    		  $file_upload = $_FILES['image']['tmp_name'];
//    		  $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//                 echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_slider.php');</script>";
//                 }else{
//                  move_uploaded_file($file_upload, $uploaddir);
//             }
//        }
          $uploaddir1 = "";
          if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image1' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image1' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'mp4' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'video/mp4' ) ) {
         $uploaddir1 = 'uploads/slider/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir1);
        
                }
                else{
                    echo "<script>alert('Sorry, only MP4 files are allowed');</script>";
                    redirect(base_url('main_slider'));
                }
        }
//          if($_FILES['image1']['name'] != "")
//           {
//           $uploaddir1 = 'uploads/slider/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//           $file_upload = $_FILES['image1']['tmp_name'];
//           $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//               if($imageFileType != "mp4") {
////                echo "<script>alert('Sorry, only mp4 files are allowed');window.location.assign('manage_slider.php');</script>";
//                   redirect(base_url('main_slider'));
//            }else{
//               move_uploaded_file($file_upload, $uploaddir);
//            }
//         }


        $data['effect'] = $this->input->post('effect');
        $data['caption'] = $this->input->post('caption');
        $data['subcaption'] = $this->input->post('subcap');
        $data['image'] = $uploaddir;
        $data['video'] = $uploaddir1;
        $data['seq_no'] = $seq;

        $succ = $this->Homemodel->add_data('slider' , $data);

        if($succ!=null)
        {
        	redirect(base_url('main_slider'));
        	//echo 'OK';
        }
        else
        {
        	//echo 'NOT OK';
        }
  
	}

	public function edit_slider_fn($id)
	{
			$uploaddir1 = $this->input->post('ofile1');
                        if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image1' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image1' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
		getimagesize( $uploaded_tmp ) ) {
         $uploaddir1 = 'uploads/slider/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir1);
        
                }
                else{
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                    redirect(base_url('main_slider'));
                }
        }
//		    if($_FILES['image1']['name'] != "")
//		   {
//		    $uploaddir1 = 'uploads/slider/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//		    $file_upload = $_FILES['image1']['tmp_name'];
//		    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//		    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//		        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_slider.php');</script>";
//		}else{
//		    move_uploaded_file($file_upload, $uploaddir1);
//		}
//		    }

		    $uploaddir2 = $this->input->post('ofile2');
                    if( isset($_FILES['image2']) && $_FILES['image2']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image2' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image2' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image2' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image2' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'mp4' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'video/mp4' ) ) {
         $uploaddir2 = 'uploads/slider/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image2']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir2);
        
                }
                else{
                    echo "<script>alert('Sorry, only MP4 files are allowed');</script>";
                    redirect(base_url('main_slider'));
                }
        }
//		    if($_FILES['image2']['name'] != "")
//		   {
//		    $uploaddir2 = 'uploads/slider/'.preg_replace('/\s+/', '', basename($_FILES['image2']['name']));
//		    $file_upload = $_FILES['image2']['tmp_name'];
//		    $imageFileType = strtolower(pathinfo($uploaddir2,PATHINFO_EXTENSION));
//		    if($imageFileType != "mp4") {
////		        echo "<script>alert('Sorry, only mp4 files are allowed');window.location.assign('manage_slider.php');</script>";
//                        redirect(base_url('main_slider'));
//		}else{
//		    move_uploaded_file($file_upload, $uploaddir2);
//		}
//		    }

		$data['effect'] = $this->input->post('effect');
        $data['caption'] = $this->input->post('caption');
        $data['subcaption'] = $this->input->post('subcap');
        $data['image'] = $uploaddir1;
        $data['video'] = $uploaddir2;

         $succ = $this->Homemodel->update_data('slider' , $data , $id);

        if($succ!=null)
        {
        	redirect(base_url('main_slider'));
        	//echo 'OK';
        }
        else
        {
        	//echo 'NOT OK';
        }


	}

	public function delete_slider_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('slider' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('main_slider'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_product_fn($id)
	{
		$seq_arr = $this->Homemodel->get_seq_category('category' , $this->input->post('type'))->row_array();
        $seq = $seq_arr['seq_no'] + 1;

        $data['name'] = $this->input->post('name');
        $data['type'] = $this->input->post('type');
        $data['seq_no'] = $seq;

         $succ = $this->Homemodel->add_data('category' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('product-type/'.$id));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_category_fn($id)
	{
		$seq_arr = $this->Homemodel->get_seq_category('category' , $this->input->post('type'))->row_array();
        $seq = $seq_arr['seq_no'] + 1;

        $data['name'] = $this->input->post('name');
        $data['type'] = $this->input->post('type');
        $data['seq_no'] = $seq;

         $succ = $this->Homemodel->add_data('category' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('category-type/'.$id));
        	
        					}
       						 else
        						{	
        	
        					}
	}



	public function edit_category_fn($id)
	{
			 $data['name'] = $this->input->post('name');
        	 $data['type'] = $this->input->post('type');
        	 $data['status'] = $this->input->post('status');

        	  $succ = $this->Homemodel->update_data('category' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('category-type/'.$this->input->post('type')));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_category_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

		$result=$this->db->get_where('category', array('id'=>$id))->row()->type;
		
        $succ = $this->Homemodel->update_data('category' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('category-type/'.$result));
        	
        					}
       						 else
        						{	
        	
        					}

	}

	public function add_subcategory_fn($id)
	{
		$name = explode("-",$this->input->post('name'));
		$seq_arr = $this->Homemodel->get_seq_subcategory('subcategory' , $name[0])->row_array();
        $seq = $seq_arr['seq_no'] + 1;

        $data['category'] = $name[0];
        $data['name'] = $this->input->post('title');
        $data['seq_no'] = $seq;

         $succ = $this->Homemodel->add_data('subcategory' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('sub-category-type/'.$id));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function edit_subcategory_fn($id)
	{
			 $data['name'] = $this->input->post('title');
        	 $data['category'] = $this->input->post('name');
        	 $data['status'] = $this->input->post('status');

        	  $succ = $this->Homemodel->update_data('subcategory' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('sub-category-type/'.$this->input->post('name')));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_subcategory_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

		$result=$this->db->get_where('subcategory', array('id'=>$id))->row()->category;
		
        $succ = $this->Homemodel->update_data('subcategory' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('sub-category-type/'.$result));
        	
        					}
       						 else
        						{	
        	
        					}

	}




	public function add_achievement_fn()
	{
			 $seq_arr = $this->Homemodel->get_seq('achievements')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;
                 
                 $uploaddir = "";
        if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
		getimagesize( $uploaded_tmp ) ) {
         $uploaddir = 'uploads/achievements/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir);
        
                }
                else{
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                    redirect(base_url('achivements'));
                }
        }
//        	   $uploaddir = "";
//    				if($_FILES['image']['name'] != "")
//   						{
//    					$uploaddir = 'uploads/achievements/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//   						 $file_upload = $_FILES['image']['tmp_name'];
//   						 $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//    						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//        						echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_achievements.php');</script>";
//							}else{
//    						move_uploaded_file($file_upload, $uploaddir);
//							}
//    					}

    					 $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['image'] = $uploaddir;
    					 $data['seq_no'] = $seq;

    					 $succ = $this->Homemodel->add_data('achievements' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('achivements'));
        	
        					}
       						 else
        						{	
        	
        					}
   
	}

	public function edit_achivement_fn($id)
	{
					$uploaddir1 = $this->input->post('ofile1');
                                        if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image1' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image1' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
		getimagesize( $uploaded_tmp ) ) {
         $uploaddir1 = 'uploads/achievements/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir1);
        
                }
                else{
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                    redirect(base_url('achivements'));
                }
        }
//				    if($_FILES['image1']['name'] != "")
//				   {
//				    $uploaddir1 = 'uploads/achievements/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//				    $file_upload = $_FILES['image1']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//				        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_achievements.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir1);
//				}
//				    }

				         $data['title'] = $this->input->post('caption');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['image'] = $uploaddir1;

    					  $succ = $this->Homemodel->update_data('achievements' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('achivements'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_achivement_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('achievements' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('achivements'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_clients_fn()
	{
			 $seq_arr = $this->Homemodel->get_seq('clients')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;

                 $uploaddir = "";
        if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
		getimagesize( $uploaded_tmp ) ) {
         $uploaddir = 'uploads/clients/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir);
        
                }
                else{
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                    redirect(base_url('clients'));
                }
        }
//				    $uploaddir = "";
//    				if($_FILES['image']['name'] != "")
//   					{
//    					$uploaddir = 'uploads/clients/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//    					$file_upload = $_FILES['image']['tmp_name'];
//    					$imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//    						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//        							echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_clients.php');</script>";
//					}else{
//    						move_uploaded_file($file_upload, $uploaddir);
//						}
//    				}

    				     $data['title'] = $this->input->post('title');
    					 $data['image'] = $uploaddir;
    					 $data['seq_no'] = $seq;

    					  $succ = $this->Homemodel->add_data('clients' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('clients'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function edit_client_fn($id)
	{
				$uploaddir1 = $this->input->post('ofile1');
                                if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
            $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
	$uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
	$uploaded_size = $_FILES[ 'image1' ][ 'size' ];
	$uploaded_type = $_FILES[ 'image1' ][ 'type' ];
	$uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
        if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
		( $uploaded_size < 5000000 ) &&
		( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
		getimagesize( $uploaded_tmp ) ) {
         $uploaddir1 = 'uploads/clients/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
         move_uploaded_file($uploaded_tmp, $uploaddir1);
        
                }
                else{
                    echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                    redirect(base_url('clients'));
                }
        }
//			    if($_FILES['image1']['name'] != "")
//			   {
//			    $uploaddir1 = 'uploads/clients/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//			    $file_upload = $_FILES['image1']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_clients.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir1);
//			}
//			    }

			     		$data['title'] = $this->input->post('caption');
    					$data['image'] = $uploaddir1;

    					 $succ = $this->Homemodel->update_data('clients' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('clients'));
        	
        					}
       						 else
        						{	
        	
        					}
	}


	public function delete_client_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('clients' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('clients'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_type_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('product_type' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('product-type'));
        	
        					}
       						 else
        						{	
        	
        					}
	}



	public function edit_overview()
	{
					 $uploaddir = "";
//			    if($_FILES['image']['name'] != "")
//			    {
//			    $uploaddir = 'uploads/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//			    $file_upload = $_FILES['image']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_overview.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir);
//			}
//			    }
                            if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }             
			    else
			    {
			       $uploaddir = $this->input->post('oimg');
			    }
                            if( isset($_FILES['hmimg1']) && $_FILES['hmimg1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'hmimg1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'hmimg1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'hmimg1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'hmimg1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' || strtolower( $uploaded_ext ) == 'svg' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' || $uploaded_type == 'image/svg+xml') &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir3 = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['hmimg1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir3);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG, PNG & SVG files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }    

//							     if($_FILES['hmimg1']['name'] != "")
//				    {
//				    $uploaddir3 = 'uploads/'.preg_replace('/\s+/', '',basename($_FILES['hmimg1']['name']));
//				    $file_upload = $_FILES['hmimg1']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir3,PATHINFO_EXTENSION));
//				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//				        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_overview.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir3);
//				}
//				    }
				    else
				    {
				       $uploaddir3 = $this->input->post('ohmimg1');
				    }
                                    

//								     if($_FILES['hmimg2']['name'] != "")
//				    {
//				    $uploaddir6 = 'uploads/'.preg_replace('/\s+/', '',basename($_FILES['hmimg2']['name']));
//				    $file_upload = $_FILES['hmimg2']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir6,PATHINFO_EXTENSION));
//				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//				        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_overview.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir6);
//				}
//				    }
                                    if( isset($_FILES['hmimg2']) && $_FILES['hmimg2']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'hmimg2' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'hmimg2' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'hmimg2' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'hmimg2' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' || strtolower( $uploaded_ext ) == 'svg' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' || $uploaded_type == 'image/svg+xml') &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir6 = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['hmimg2']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir6);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG, PNG & SVG files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }    
				    else
				    {
				       $uploaddir6 = $this->input->post('ohmimg2');
				    }

//									     if($_FILES['hmimg3']['name'] != "")
//					    {
//					    $uploaddir7 = 'uploads/'.preg_replace('/\s+/', '',basename($_FILES['hmimg3']['name']));
//					    $file_upload = $_FILES['hmimg3']['tmp_name'];
//					    $imageFileType = strtolower(pathinfo($uploaddir7,PATHINFO_EXTENSION));
//					    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//					        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_overview.php');</script>";
//					}else{
//					    move_uploaded_file($file_upload, $uploaddir7);
//					}
//					    }
                                    if( isset($_FILES['hmimg3']) && $_FILES['hmimg3']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'hmimg3' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'hmimg3' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'hmimg3' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'hmimg3' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' || strtolower( $uploaded_ext ) == 'svg' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' || $uploaded_type == 'image/svg+xml') &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir7 = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['hmimg3']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir7);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG, PNG & SVG files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }    
					    else
					    {
					       $uploaddir7 = $this->input->post('ohmimg3');
					    }

					    $data['overview_title']=$this->input->post('otitle');

					    $data['overview']=$this->input->post('overview');

					    $data['thought_cover']=$uploaddir;

					    $data['story_title']=$this->input->post('stitle');

					    $data['story_about_us']=$this->input->post('story');

					    $data['key1']=$this->input->post('btext1');

					    $data['icon1']=$uploaddir3;

					    $data['key2']=$this->input->post('btext2');

					    $data['icon2']= $uploaddir6;

					    $data['key3']=$this->input->post('btext3');

					    $data['icon3']= $uploaddir7;

					     $succ = $this->Homemodel->update_data('about_details' , $data , '1');
    						 if($succ!=null)
        					{
        						redirect(base_url('dashboard'));
        	
        					}
       						 else
        						{	
        	
        					}

	}



	public function add_thought_fn()
	{
		     $seq_arr = $this->Homemodel->get_seq('about_thoughts')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;

        	     $uploaddir1 = "";
//    			 if($_FILES['image1']['name'] != "")
//   					{
//    					$uploaddir1 = 'uploads/thoughts/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//    					$file_upload = $_FILES['image1']['tmp_name'];
//    					$imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//    						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//        						echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_thoughts.php');</script>";
//								}else{
//    								move_uploaded_file($file_upload, $uploaddir1);
//									}
//    					}
                     if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir1 = 'uploads/thoughts/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('about-thoughts'));
                                    }
                            }   

    					 $data['title'] = $this->input->post('title');
    					 $data['author'] = $this->input->post('author');
    					 $data['author_designation'] = $this->input->post('designation');
    					 $data['author_image'] = $uploaddir1;
    					 $data['seq_no'] = $seq;

    					 $succ = $this->Homemodel->add_data('about_thoughts' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('about-thoughts'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function edit_thought_fn($id)
	{
//						 $uploaddir = $this->input->post('ofile');
				    
				    $uploaddir1 = $this->input->post('ofile1');
//				    if($_FILES['image1']['name'] != "")
//				   {
//				    $uploaddir1 = 'uploads/thoughts/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//				    $file_upload = $_FILES['image1']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//				        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_thoughts.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir1);
//				}
//				    }
                                    if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir1 = 'uploads/thoughts/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('about-thoughts'));
                                    }
                            } 

				    	 $data['title'] = $this->input->post('title');
    					 $data['author'] = $this->input->post('author');
    					 $data['author_designation'] = $this->input->post('designation');
    					 $data['author_image'] = $uploaddir1;

    					 $succ = $this->Homemodel->update_data('about_thoughts' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('about-thoughts'));
        	
        					}
       						 else
        						{	
        	
        					}

	}

	public function delete_thought_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('about_thoughts' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('about-thoughts'));
        	
        					}
       						 else
        						{	
        	
        					}
	}


	
	public function add_highlight_fn()
	{
		     $seq_arr = $this->Homemodel->get_seq('highlights')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;

        	 $uploaddir = "";
//             if($_FILES['image']['name'] != "")
//            {
//             $uploaddir = 'uploads/highlights/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//             $file_upload = $_FILES['image']['tmp_name'];
//             $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//             if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//             echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_highlights.php');</script>";
//            }else{
//                move_uploaded_file($file_upload, $uploaddir);
//              }
//             }
                 if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/highlights/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('highlights'));
                                    }
                            }   

                         $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['image'] = $uploaddir;
    					 $data['seq_no'] = $seq;

    					 $succ = $this->Homemodel->add_data('highlights' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('highlights'));
        	
        					}
       						 else
        						{	
        	
        					}

	}

	public function edit_highlight_fn($id)
	{
									 $uploaddir1 = $this->input->post('ofile1');
//						    if($_FILES['image1']['name'] != "")
//						   {
//						    $uploaddir1 = 'uploads/highlights/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//						    $file_upload = $_FILES['image1']['tmp_name'];
//						    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//						    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//						        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_highlights.php');</script>";
//						}else{
//						    move_uploaded_file($file_upload, $uploaddir1);
//						}
//						    }
                                       if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir1 = 'uploads/highlights/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('highlights'));
                                    }
                            }                                     
						 $data['title'] = $this->input->post('caption');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['image'] = $uploaddir1;

    					  $succ = $this->Homemodel->update_data('highlights' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('highlights'));
        	
        					}
       						 else
        						{	
        	
        					}

	}

	public function delete_highlight_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('highlights' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('highlights'));
        	
        					}
       						 else
        						{	
        	
        					}
	}


	public function add_history_fn()
	{
		      $uploaddir = "";
//    			if($_FILES['image']['name'] != "")
//   					{
//    				$uploaddir = 'uploads/history/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//    				$file_upload = $_FILES['image']['tmp_name'];
//    				$imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//    					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//        					echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_history.php');</script>";
//						}else{
//    						move_uploaded_file($file_upload, $uploaddir);
//						}
//    				}
                      if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/history/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('history'));
                                    }
                            }   

    					 $data['year'] = $this->input->post('year');
    				     $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['image'] = $uploaddir;
    					 
    					 $succ = $this->Homemodel->add_data('history' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('history'));
        	
        					}
       						 else
        						{	
        	
        					}


	}

	public function edit_history_fn($id)
	{
									 $uploaddir1 = $_POST['ofile1'];
//					    if($_FILES['image1']['name'] != "")
//					   {
//					    $uploaddir1 = 'uploads/history/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//					    $file_upload = $_FILES['image1']['tmp_name'];
//					    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//					    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//					        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_history.php');</script>";
//					}else{
//					    move_uploaded_file($file_upload, $uploaddir1);
//					}
//					    }
                                          if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir1 = 'uploads/history/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('history'));
                                    }
                            }                                  

					     $data['year'] = $this->input->post('year');
    				     $data['title'] = $this->input->post('caption');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['image'] = $uploaddir1;

    					 $succ = $this->Homemodel->update_data('history' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('history'));
        	
        					}
       						 else
        						{	
        	
        					}


	}

	public function delete_history_fn($id)
	{

		$data['delete_status'] = '1';
		//$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('history' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('history'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_member_fn()
	{

			 $seq_arr = $this->Homemodel->get_seq('our_team')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;

//        	 if($_FILES['image']['name'] != "")
//   				{
//    			$uploaddir = 'uploads/team/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//    			$file_upload = $_FILES['image']['tmp_name'];
//    			$imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//    				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//        				echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_team.php');</script>";
//						}else{
//    							move_uploaded_file($file_upload, $uploaddir);
//							 }
//   				 }
                 $uploaddir = "";
                 if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/team/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('our-team'));
                                    }
                            }   

   				 		 $data['name'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('description');
    					 $data['designation'] = $this->input->post('designation');
    					 $data['fb_link'] = $this->input->post('fb');
    					 $data['tw_link'] = $this->input->post('tw');
    					 $data['seq_no'] = $seq;
    					 $data['image'] = $uploaddir;
    					 
    					 $succ = $this->Homemodel->add_data('our_team' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('our-team'));
        	
        					}
       						 else
        						{	
        	
        					}

	}

	public function edit_member_fn($id)
	{
						 $uploaddir = $this->input->post('ofile');
//			    if($_FILES['image']['name'] != "")
//			   {
//			    $uploaddir = 'uploads/team/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//			    $file_upload = $_FILES['image']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_team.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir);
//			}
//			    }
                                                 if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/team/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('our-team'));
                                    }
                            }   

			             $data['name'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('description');
    					 $data['designation'] = $this->input->post('designation');
    					 $data['fb_link'] = $this->input->post('fb');
    					 $data['tw_link'] = $this->input->post('tw');
    					 $data['image'] = $uploaddir;

    					  $succ = $this->Homemodel->update_data('our_team' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('our-team'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_member_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('our_team' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('our-team'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_service_fn()
	{

		     $seq_arr = $this->Homemodel->get_seq('services')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;

		 		$uploaddir = "";
                                if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/services/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('services'));
                                    }
                            }   
//    			if($_FILES['image']['name'] != "")
//   					{
//    					$uploaddir = 'uploads/services/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//    					$file_upload = $_FILES['image']['tmp_name'];
//    					$imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//    						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//       								 echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_services.php');</script>";
//							}else{
//    								move_uploaded_file($file_upload, $uploaddir);
//									}
//    				}
    					$uploaddir1 = "";
                                        if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'mp4')&&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'video/mp4')) {
                             $uploaddir = 'uploads/services/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only MP4 files are allowed');</script>";
                                        redirect(base_url('services'));
                                    }
                            }  
//    					if($_FILES['image1']['name'] != "")
//   							{
//    						$uploaddir1 = 'uploads/services/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//    						$file_upload = $_FILES['image1']['tmp_name'];
//    						$imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//    							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//        							echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_services.php');</script>";
//								}else{
//   										 move_uploaded_file($file_upload, $uploaddir1);
//										}
//    						}

    					 $data['title'] = $this->input->post('caption');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['short_description'] = $this->input->post('short');
    					 $data['seq_no'] = $seq;
    					 $data['image'] = $uploaddir;
    					 $data['brochure'] = $uploaddir1;

    					 $succ = $this->Homemodel->add_data('services' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('services'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function edit_service_fn($id)
	{
						$uploaddir1 = $this->input->post('ofile1');
                                                if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) ) {
                             $uploaddir1 = 'uploads/services/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('services'));
                                    }
                            }   
//			    if($_FILES['image1']['name'] != "")
//			   {
//			    $uploaddir1 = 'uploads/services/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//			    $file_upload = $_FILES['image1']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_services.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir1);
//			}
//			    }

						    $uploaddir2 = $this->input->post('ofile2');
                                                    if( isset($_FILES['image2']) && $_FILES['image2']['error'] != UPLOAD_ERR_NO_FILE ) {
                                $uploaded_name = $_FILES[ 'image2' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image2' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image2' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image2' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'mp4')&&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'video/mp4') &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir2 = 'uploads/services/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image2']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir2);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only MP4 files are allowed');</script>";
                                        redirect(base_url('services'));
                                    }
                            }  
//			    if($_FILES['image2']['name'] != "")
//			   {
//			    $uploaddir2 = 'uploads/services/'.preg_replace('/\s+/', '', basename($_FILES['image2']['name']));
//			    $file_upload = $_FILES['image2']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir2,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_services.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir2);
//			}
//			    }

			             $data['title'] = $this->input->post('caption');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['short_description'] = $this->input->post('short');
    					 $data['image'] = $uploaddir1;
    					 $data['brochure'] = $uploaddir2;

    					 	 $succ = $this->Homemodel->update_data('services' , $data , $id);
    						 
    						 if($succ!=null)
        					{
        						redirect(base_url('services'));
        	
        					}
       						 else
        						{	
        	
        					}

	}

	public function delete_service_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('services' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('services'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_service_benefit_fn()
	{
			 			$seq_arr = $this->Homemodel->get_seq_benefit('service_benefits',$this->input->post('name'))->row_array();
        	 			$seq = $seq_arr['seq_no'] + 1;

        	             $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['service'] = $this->input->post('name');
    					 $data['seq_no'] = $seq;

    					  $succ = $this->Homemodel->add_data('service_benefits' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('services-benefits'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function edit_service_benefit_fn($id)
	{
					     $data['title'] = $this->input->post('caption');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['service'] = $this->input->post('name');

    					  $succ = $this->Homemodel->update_data('service_benefits' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('services-benefits'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_benefit_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('service_benefits' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('services-benefits'));
        	
        					}
       						 else
        						{	
        	
        					}
	}
        
        public function add_testimonial_fn($id)
	{
                            $uploaddir = "";
                            if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/testimonials/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('testimonials'));
                                    }
                            }   
//			    if($_FILES['image']['name'] != "")
//			   {
//			    $uploaddir = 'uploads/testimonials/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//			    $file_upload = $_FILES['image']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_testimonials.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir);
//			}
//			    }

			             $data['name'] = $this->input->post('title');
    					 $data['location'] = $this->input->post('location');
    					 $data['company_name'] = $this->input->post('cname');
    					 $data['designation'] = $this->input->post('designation');
    					 $data['comment'] = $this->input->post('description');
    					 $data['image'] = $uploaddir;

    					  $succ = $this->Homemodel->add_data('testimonials' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('testimonials'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function edit_testimonial_fn($id)
	{
                            $uploaddir = $this->input->post('ofile');
                            if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/testimonials/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('testimonials'));
                                    }
                            }   
//			    if($_FILES['image']['name'] != "")
//			   {
//			    $uploaddir = 'uploads/testimonials/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//			    $file_upload = $_FILES['image']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_testimonials.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir);
//			}
//			    }

			             $data['name'] = $this->input->post('title');
    					 $data['location'] = $this->input->post('location');
    					 $data['company_name'] = $this->input->post('cname');
    					 $data['designation'] = $this->input->post('designation');
    					 $data['comment'] = $this->input->post('description');
    					 $data['image'] = $uploaddir;

    					  $succ = $this->Homemodel->update_data('testimonials' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('testimonials'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function delete_testimonials_fn($id)
	{

		$data['delete_status'] = '1';
		$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('testimonials' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('testimonials'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_event_fn()
	{
						$uploaddir = "";
                                                if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/events/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('events'));
                                    }
                            }   
//				    if($_FILES['image']['name'] != "")
//				   {
//				    $uploaddir = 'uploads/events/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//				    $file_upload = $_FILES['image']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//				        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_event.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir);
//				}
//				    }

				         $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['date'] = $this->input->post('dt');
    					 $data['location'] = $this->input->post('location');
    					 $data['fb_link'] = $this->input->post('fb');
    					 $data['tw_link'] = $this->input->post('tw');
    					 $data['image'] = $uploaddir;

    					  $succ = $this->Homemodel->add_data('events' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('events'));
        	
        					}
       						 else
        						{	
        	
        						}
	}

	public function edit_event_fn($id)
	{
								$uploaddir1 = $this->input->post('ofile1');
                                        if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir1 = 'uploads/events/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('events'));
                                    }
                            }   
//			    if($_FILES['image1']['name'] != "")
//			   {
//			    $uploaddir1 = 'uploads/events/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//			    $file_upload = $_FILES['image1']['tmp_name'];
//			    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//			    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//			        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_event.php');</script>";
//			}else{
//			    move_uploaded_file($file_upload, $uploaddir1);
//			}
//			    }

			             $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('subcap');
    					 $data['date'] = $this->input->post('dt');
    					 $data['location'] = $this->input->post('location');
    					 $data['fb_link'] = $this->input->post('fb');
    					 $data['tw_link'] = $this->input->post('tw');
    					 $data['image'] = $uploaddir1;

    					 $succ = $this->Homemodel->update_data('events' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('events'));
        	
        					}
       						 else
        						{	
        	
        						}
	}

	public function delete_events_fn($id)
	{

		$data['delete_status'] = '1';
		//$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('events' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('events'));
        	
        					}
       						 else
        						{	
        	
        					}
	}


	public function add_image_fn()
	{
							 $uploaddir = "";
                                                         if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/events/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('image-gallery'));
                                    }
                            }   
//					    if($_FILES['image']['name'] != "")
//					    {
//					    $uploaddir = 'uploads/events/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//					    $file_upload = $_FILES['image']['tmp_name'];
//					    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//					    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//					        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_igallery.php');</script>";
//					}else{
//					    move_uploaded_file($file_upload, $uploaddir);
//					}
//					    }

					     $name = explode("-", $this->input->post('name'));
					     $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['image'] = $uploaddir;
    					 $data['album_id'] = $name[0];

    					 $succ = $this->Homemodel->add_data('image_gallery' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('image-gallery'));
        	
        					}
       						 else
        						{	
        	
        						}
    					 

	}

	public function edit_image_fn($id)
	{
									$uploaddir = $this->input->post('ofile');
                                                                        if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/events/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('image-gallery'));
                                    }
                            }   
//					    if($_FILES['image']['name'] != "")
//					    {
//					    $uploaddir = 'uploads/events/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//					    $file_upload = $_FILES['image']['tmp_name'];
//					    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//					    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//					        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_igallery.php');</script>";
//					}else{
//					    move_uploaded_file($file_upload, $uploaddir);
//					}
//					    }

					     $name = explode("-", $this->input->post('name'));
					     $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['image'] = $uploaddir;
    					 $data['album_id'] = $name[0];

    					  $succ = $this->Homemodel->update_data('image_gallery' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('image-gallery'));
        	
        					}
       						 else
        						{	
        	
        						}


	}

	public function delete_image_fn($id)
	{

		$data['delete_status'] = '1';
		//$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('image_gallery' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('image-gallery'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function add_video_fn()
	{
				         $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['album_id'] = $this->input->post('name');
    					 $data['video'] = $this->input->post('id');

    					 $succ = $this->Homemodel->add_data('video_gallery' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('video-gallery'));
        	
        					}
       						 else
        						{	
        	
        						}

	}

	public function edit_video_fn($id)
	{
					     $data['title'] = $this->input->post('title');
    					 $data['description'] = $this->input->post('desc');
    					 $data['album_id'] = $this->input->post('name');
    					 $data['video'] = $this->input->post('id');

    					 $succ = $this->Homemodel->update_data('video_gallery' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('video-gallery'));
        	
        					}
       						 else
        						{	
        	
        						}
	}

	public function delete_video_fn($id)
	{

		$data['delete_status'] = '1';
		//$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('video_gallery' , $data , $id);
    						 if($succ!=null)
        					{
        						redirect(base_url('video-gallery'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	public function contact_us_fn()
	{
						$uploaddir1 = "";
                                                if( isset($_FILES['image1']) && $_FILES['image1']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image1' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image1' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image1' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image1' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir1 = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir1);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }   
//				    if($_FILES['image1']['name'] != "")
//				    {
//				    $uploaddir1 = 'uploads/'.preg_replace('/\s+/', '', basename($_FILES['image1']['name']));
//				    $file_upload = $_FILES['image1']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir1,PATHINFO_EXTENSION));
//				    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//				        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_contact.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir1);
//				}
//				    }
				    else
				    {
				       $uploaddir1 = $this->input->post('oimg1');
				    }

								     $uploaddir2 = "";
                                                                     if( isset($_FILES['image2']) && $_FILES['image2']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image2' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image2' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image2' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image2' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'pdf' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'application/pdf' ) ) {
                             $uploaddir2 = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image2']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir2);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only PDF files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }   
//				    if($_FILES['image2']['name'] != "")
//				    {
//				    $uploaddir2 = 'uploads/'.preg_replace('/\s+/', '', basename($_FILES['image2']['name']));
//				    $file_upload = $_FILES['image2']['tmp_name'];
//				    $imageFileType = strtolower(pathinfo($uploaddir2,PATHINFO_EXTENSION));
//				    if($imageFileType != "pdf" ) {
//				        echo "<script>alert('Sorry, only PDF files are allowed');window.location.assign('manage_contact.php');</script>";
//				}else{
//				    move_uploaded_file($file_upload, $uploaddir2);
//				}
//				    }
				    else
				    {
				       $uploaddir2 = $this->input->post('oimg2');
				    }

										     $uploaddir3 = "";
                                                                                     if( isset($_FILES['image3']) && $_FILES['image3']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image3' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image3' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image3' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image3' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'pdf' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'application/pdf' ) ) {
                             $uploaddir3 = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image3']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir3);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only PDF files are allowed');</script>";
                                        redirect(base_url('dashboard'));
                                    }
                            }   
//						    if($_FILES['image3']['name'] != "")
//						    {
//						    $uploaddir3 = 'uploads/'.preg_replace('/\s+/', '', basename($_FILES['image3']['name']));
//						    $file_upload = $_FILES['image3']['tmp_name'];
//						    $imageFileType = strtolower(pathinfo($uploaddir3,PATHINFO_EXTENSION));
//						    if($imageFileType != "pdf") {
//						        echo "<script>alert('Sorry, only PDF files are allowed');window.location.assign('manage_contact.php');</script>";
//						}else{
//						    move_uploaded_file($file_upload, $uploaddir3);
//						}
//						    }
						    else
						    {
						       $uploaddir3 = $this->input->post('oimg3');
						    }

						 $data['address'] = $this->input->post('address');
    					 $data['telephone'] = $this->input->post('tel');
    					 $data['service_phone'] = $this->input->post('stel');
    					 $data['enquiry_phone'] = $this->input->post('etel');
    					 $data['email'] = $this->input->post('email');
    					 $data['service_email'] = $this->input->post('semail');
    					 $data['map_link'] = $this->input->post('map');
    					 $data['office_hrs'] = $this->input->post('hrs');
    					 $data['logo'] = $uploaddir1;
    					 $data['fb_link'] = $this->input->post('fb');
    					 $data['in_link'] = $this->input->post('ld');
    					 $data['company_profile'] = $uploaddir2;
    					 $data['company_brochure'] = $uploaddir3;
    					 $data['terms'] = $this->input->post('terms');
    					 $data['privacy'] = $this->input->post('privacy');

    					 $succ = $this->Homemodel->update_data('contact_details' , $data , '1');
    						 if($succ!=null)
        					{
        						redirect(base_url('dashboard'));
        	
        					}
       						 else
        						{	
        	
        						}
	}

	public function edit_settings()
	{
		 $data['main_slider'] = $this->input->post('slider');
		 $data['our_values'] = $this->input->post('value');
		 $data['story'] = $this->input->post('story');
		 $data['market_sector'] = $this->input->post('sector');
		 $data['achievements'] = $this->input->post('achievement');
		 $data['testimonials'] = $this->input->post('testimonial');
		 $data['client'] = $this->input->post('client');
		 $data['overview'] = $this->input->post('overview');
		 $data['story_aboutus'] = $this->input->post('story_about');
		 $data['history'] = $this->input->post('history');
		 $data['our_team'] = $this->input->post('team');

		  $succ = $this->Homemodel->update_data('settings' , $data , '1');
    						 if($succ!=null)
        					{
        						redirect(base_url('dashboard'));
        	
        					}
       						 else
        						{	
        	
        						}
	}

	public function add_product_type_fn()
	{
		     $seq_arr = $this->Homemodel->get_seq('product_type')->row_array();
        	 $seq = $seq_arr['seq_no'] + 1;

		        	  $uploaddir = "";
                                   if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('product-type'));
                                    }
                            }   
//		    if($_FILES['image']['name'] != "")
//		    {
//		    $uploaddir = 'uploads/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//		    $file_upload = $_FILES['image']['tmp_name'];
//		    move_uploaded_file($file_upload, $uploaddir);
//		    }

		    $data['name'] = $this->input->post('name');
		    $data['description'] = $this->input->post('desc');
		    $data['image'] = $uploaddir;
		    $data['highlight'] = $this->input->post('highlight');

		    $succ = $this->Homemodel->add_data('product_type' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('product-type'));
        	
        					}
       						 else
        						{	
        	
        						}

	}

	public function edit_type_fn($id)
	{

			$uploaddir = $this->input->post('ofile');
                        if( isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE ) {
                            $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                            $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
                            $uploaded_size = $_FILES[ 'image' ][ 'size' ];
                            $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                            $uploaded_tmp  = $_FILES[ 'image' ][ 'tmp_name' ];
                            if( ( strtolower( $uploaded_ext ) == 'jpg' || strtolower( $uploaded_ext ) == 'jpeg' || strtolower( $uploaded_ext ) == 'png' ) &&
                                    ( $uploaded_size < 5000000 ) &&
                                    ( $uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' ) &&
                                    getimagesize( $uploaded_tmp ) ) {
                             $uploaddir = 'uploads/' .date('YmdHis').preg_replace('/\s+/', '', basename($_FILES['image']['name']));
                             move_uploaded_file($uploaded_tmp, $uploaddir);

                                    }
                                    else{
                                        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');</script>";
                                        redirect(base_url('product-type'));
                                    }
                            }   
//		    if($_FILES['image']['name'] != "")
//		    {
//		    $uploaddir = 'uploads/events/'.preg_replace('/\s+/', '', basename($_FILES['image']['name']));
//		    $file_upload = $_FILES['image']['tmp_name'];
//		    $imageFileType = strtolower(pathinfo($uploaddir,PATHINFO_EXTENSION));
//		    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
//		        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed');window.location.assign('manage_type.php');</script>";
//		}else{
//		    move_uploaded_file($file_upload, $uploaddir);
//		}
//		    }

		    	$data['name'] = $this->input->post('name');
		    	$data['description'] = $this->input->post('desc');
		    	$data['image'] = $uploaddir;//$this->input->post('image');
		    	$data['highlight'] = $this->input->post('highlight');
		    	$data['status'] = $this->input->post('status');

		    	$succ = $this->Homemodel->update_data('product_type' , $data , '1');
    						 if($succ!=null)
        					{
        						redirect(base_url('product-type'));
        	
        					}
       						 else
        						{	
        	
        						}

	}

	public function add_user_fn()
	{
		$username = $this->input->post('username');

		$result = $this->Homemodel->check_user('login',$username);

		if($result == 1)
		{
			echo '<script>alert("Username already exists!")</script>';
		}
		else
		{
						 $data['username'] = $this->input->post('username');
    					 $data['name'] = $this->input->post('name');
    					 $data['email'] = $this->input->post('email');
    					 $data['phone'] = $this->input->post('phone');

    					 if($this->input->post('password') == $this->input->post('cpassword'))
    					 {
    					 	$data['password'] = $this->input->post('password');

    					 		$succ = $this->Homemodel->add_data('login' , $data);
    						 if($succ!=null)
        					{
        						redirect(base_url('users'));
        	
        					}
       						 else
        						{	
        	
        						}

    					 }
    					 else
    					 {
    					 	echo '<script>alert("Please enter Password and Confirm Password same!")</script>';
    					 }

		}


	}

	public function edit_user_fn($id)
	{

		    	$data['username'] = $this->input->post('username');
		    	$data['name'] = $this->input->post('name');
		    	$data['email'] = $this->input->post('email');
		    	$data['phone'] = $this->input->post('phone');

		    	if($this->input->post('password') == $this->input->post('cpassword'))
		    	{
		    		$data['password'] = $this->input->post('password');
		    	}
		    	
		    	$succ = $this->Homemodel->update_data('login' , $data , '1');
    						 if($succ!=null)
        					{
        						redirect(base_url('dashboard'));
        	
        					}
       						 else
        						{	
        	
        						}

	}

	public function delete_user_fn($id)
	{

		$data['delete_status'] = '1';
		//$data['seq_no'] = '0';

        $succ = $this->Homemodel->update_data('login' , $data , $id);
    						 if($succ!=null)
        					{
        						 
        						redirect(base_url('logout'));
        	
        					}
       						 else
        						{	
        	
        					}
	}

	

}
