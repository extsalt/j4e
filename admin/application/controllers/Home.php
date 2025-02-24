<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		$this->setting = my_global_setting('all_fields');
		$this->setting->front_setting_array = json_decode($this->setting->front_setting, TRUE);
	    ($this->router->default_controller == 'home') ? $this->home_url = '' : $this->home_url = 'home/';
    }
	
	
	
	public function index() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		my_load_view($this->setting->theme, 'Front/index', $data);
	}	
	
	
	
	public function pricing() {
		my_check_maintenance();
		$data['front_setting_array'] = json_decode($this->setting->front_setting, TRUE);
		$payment_setting_array = json_decode($this->setting->payment_setting, 1);
		$data['payment_gateway_stripe_one_time'] = $payment_setting_array['stripe_one_time_enabled'];
		$data['payment_gateway_stripe_recurring'] = $payment_setting_array['stripe_recurring_enabled'];
		$data['payment_gateway_paypal_one_time'] = $payment_setting_array['paypal_one_time_enabled'];
		$data['payment_gateway_paypal_recurring'] = $payment_setting_array['paypal_recurring_enabled'];
		(!empty($payment_setting_array['tax_rate'])) ? $data['payment_tax_rate'] = $payment_setting_array['tax_rate'] : $data['payment_tax_rate'] = 0;
		if (!empty($_SESSION['access_code'])) {
			$query = $this->db->where('enabled', 1)->where('access_code', $_SESSION['access_code'])->order_by('id', 'desc')->get('payment_item');
		}
		else {
			$query = $this->db->where('enabled', 1)->where('access_code', '')->order_by('id', 'desc')->get('payment_item');
		}
		if ($query->num_rows()) {
			$data['rs'] = $query->result();
		}
		else {
			$data['rs'] = [];
		}
		my_load_view($this->setting->theme, 'Front/pricing', $data);
	}
	
	
	
	public function faq() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		$query_catalog = $this->db->where('type', 'support_faq')->get('catalog');
		if ($query_catalog->num_rows()) {
			$data['rs_catalog'] = $query_catalog->result();
			$query_faq = $this->db->where('enabled', 1)->get('faq');
			if ($query_faq->num_rows()) {
				$data['rs_faq'] = $query_faq->result();
			}
			else {
				$data['rs_faq'] = NULL;
			}
		}
		else {
			$data['rs_catalog'] = NULL;
		}
		my_load_view($this->setting->theme, 'Front/faq', $data);
	}
	
	
	
	public function documentation() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		$data['documentation_catalog'] = $this->get_catalog('support_documentation');
		my_load_view($this->setting->theme, 'Front/documentation', $data);
	}
	
	
	
	public function documentation_list() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		$data['documentation_catalog'] = $this->get_catalog('support_documentation');
		(my_uri_segment(1) == 'home') ? $ids = my_uri_segment(3) : $ids = my_uri_segment(2);
		$query_catalog = $this->db->where('type', 'support_documentation')->where('ids', $ids)->get('catalog', 1);
		if ($query_catalog->num_rows()) {
			$rs_catalog = $query_catalog->row();
			$query_documentation_list = $this->db->where('catalog', $rs_catalog->name)->where('enabled', 1)->order_by('id', 'desc')->get('documentation');
			if ($query_documentation_list->num_rows()) {
				$data['documentation_list'] = $query_documentation_list->result();
				$data['documentation_catalog_current'] = $rs_catalog->name;
			}
			else {
				$data['documentation_list'] = array();
				$data['documentation_catalog_current'] = $rs_catalog->name;
			}
		}
		else {
			$data['documentation_list'] = array();
			$data['documentation_catalog_current'] = '';
		}
		my_load_view($this->setting->theme, 'Front/documentation_list', $data);
	}
	
	
	
	public function documentation_view() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		$data['documentation_catalog'] = $this->get_catalog('support_documentation');
		(my_uri_segment(1) == 'home') ? $slug = my_uri_segment(3) : $slug = my_uri_segment(2);
		$query = $this->db->where('slug', $slug)->get('documentation', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			$data['documentation_view'] = $rs;
			$data['html_keyword'] = $rs->keyword;
			$data['html_title'] = $rs->subject . ' - ' . $this->setting->front_setting_array['html_title'];
			my_load_view($this->setting->theme, 'Front/documentation_view', $data);
		}
		else {
			my_load_view($this->setting->theme, 'Front/documentation_view', $data);
		}
	}
	
	
	
	public function about() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		my_load_view($this->setting->theme, 'Front/about', $data);
	}



	public function contact() {
		my_check_maintenance();
		$data['front_setting_array'] = $this->setting->front_setting_array;
		my_load_view($this->setting->theme, 'Front/contact', $data);
	}
	
	
	public function contact_action() {
		my_check_maintenance();
		my_check_demo_mode();  //check if it's in demo mode
		$data['front_setting_array'] = $this->setting->front_setting_array;
		$this->form_validation->set_rules('contact_name', my_caption('front_contact_form_name'), 'trim|required|max_length[50]');
		$this->form_validation->set_rules('contact_catalog', my_caption('front_contact_form_catalog'), 'trim|required|max_length[50]');
		$this->form_validation->set_rules('contact_email', my_caption('front_contact_form_email'), 'trim|required|valid_email|max_length[255]');
		$this->form_validation->set_rules('contact_phone', my_caption('front_contact_form_phone'), 'trim|max_length[50]');
		$this->form_validation->set_rules('contact_message', my_caption('front_contact_form_message'), 'trim|required');
		if ($this->setting->recaptcha_enabled) {$this->form_validation->set_rules('g-recaptcha-response', 'Google Recaptcha', 'callback_google_recaptcha');}
		if ($this->form_validation->run() == FALSE) {
			my_load_view($this->setting->theme, 'Front/contact', $data);
		}
		else {
			$insert_data = array(
			  'ids' => my_random(),
			  'name' => my_post('contact_name'),
			  'email_address' => my_post('contact_email'),
			  'phone' => my_post('contact_phone'),
			  'catalog' => my_post('contact_catalog'),
			  'message' => my_post('contact_message'),
			  'ip_address' => $this->input->ip_address(),
			  'created_time' => my_server_time(),
			  'read_status' => 0
			);
			$this->db->insert('contact_form', $insert_data);
			$this->session->set_flashdata('flash_success', my_caption('front_contact_form_success'));
			redirect(base_url('home/contact'));
		}
	}
	
	
	
	public function subscriber_action() {
		my_check_maintenance();
		if ($this->config->item('my_demo_mode')) {
			$this->session->set_flashdata('flash_danger', my_caption('global_in_demo_mode'));
		}
		else {
			$this->form_validation->set_rules('email_address', my_caption('global_email_address'), 'trim|required|valid_email|max_length[255]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('flash_warning', my_caption('front_subscribe_invalid_address'));
			}
			else {
				$query = $this->db->where('email_address', my_post('email_address'))->get('subscriber', 1);
				if (!$query->num_rows()) {
					$insert_array = array(
					  'ids' => my_random(),
					  'email_address' => my_post('email_address'),
					  'from_ip' => $this->input->ip_address(),
					  'created_time' => my_server_time()
					);
					$this->db->insert('subscriber', $insert_array);
				}
				$this->session->set_flashdata('flash_success', my_caption('front_subscribe_success'));
			}
		}
		redirect(base_url('home/contact'));
	}



	public function maintenance() {
		$data['front_setting_array'] = $this->setting->front_setting_array;
		my_load_view($this->setting->theme, 'Front/maintenance', $data);
	}
	
	

	public function google_recaptcha($recaptchaResponse) {
		$recaptcha_array = json_decode(my_global_setting('all_fields')->recaptcha_detail, TRUE);
        $url="https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_array['secret_key']."&response=".$recaptchaResponse."&remoteip=".my_remote_info('ip');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $status = json_decode($output, TRUE);
        if ($status['success']) {
			return TRUE;
		}else{
			$this->form_validation->set_message('google_recaptcha', my_caption('auth_google_recaptcha_error'));
			return FALSE;
		}
	}
	
	
	protected function get_catalog($catalog_type) {
		$query = $this->db->where('type', $catalog_type)->order_by('id', 'asc')->get('catalog');
		if ($query->num_rows()) {
			return $query->result();
		}
		else {
			return array();
		}
	}
	
	
}
?>