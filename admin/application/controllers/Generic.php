<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
        date_default_timezone_set($this->config->item('time_reference'));
		$this->setting = my_global_setting('all_fields');		
	}
	
	
	
	// This is used for switch language, selected language is saved in cookie, the cookie name is "site_lang".
	// It'll redirect back to current url after choosed.
	public function switchLang($language = "") {
		my_set_language_cookie($language);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	
	public function sign_out() {
		$this->load->model('user_model');
		(get_cookie('remember_signin', TRUE) != '') ? $this->user_model->remove_cookie('remember_signin', get_cookie('remember_signin', TRUE)) : null;
		$this->db->where('ids', $_SESSION['user_ids'])->update('user', array('online'=>0));
		$this->session->sess_destroy();
		redirect(base_url());
	}	
	
	
	
	public function terms_conditions() {
		$setting = my_global_setting('all_fields');
		$data['setting'] = $setting;
		my_load_view($setting->theme, 'Auth/terms_conditions', $data);
	}
	
	
	
	public function online() {
		$this->db->where('ids', my_uri_segment(3))->update('user', array('online'=>1, 'online_time'=>my_server_time()));
		echo '0';
	}

	public function send_mail($id)
        {
            $rs_email = $this->db->where('purpose', 'subscription')->get('email_template')->row(); 
            $user_info = $this->db->where('id',$id)->get('user')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['user'] = $user_info;
            $body = my_load_view($setting->theme, 'Mail/subscribe', $data);
//            echo $body;
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail1($id)
        {
            $rs_email = $this->db->where('purpose', 'welcome')->get('email_template')->row(); 
            $user_info = $this->db->where('id',$id)->get('user')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['user'] = $user_info;
            $body = my_load_view($setting->theme, 'Mail/welcome', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail2($id)
        {
            $rs_email = $this->db->where('purpose', 'business_transaction')->get('email_template')->row(); 
            $transaction_info = $this->db->where('bns_trans_id',$id)->get('business_transaction')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['transaction'] = $transaction_info;
            $body = my_load_view($setting->theme, 'Mail/business_transaction', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail3($id)
        {
            $rs_email = $this->db->where('purpose', 'requirement')->get('email_template')->row(); 
            $requirement_info = $this->db->where('id',$id)->get('requirements')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement'] = $requirement_info;
            $body = my_load_view($setting->theme, 'Mail/requirement', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail4($id)
        {
            $rs_email = $this->db->where('purpose', 'requirement_status_update')->get('email_template')->row(); 
            $requirement_status_info = $this->db->where('req_user_status_id',$id)->get('requirements_user_status')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement_status'] = $requirement_status_info;
            $body = my_load_view($setting->theme, 'Mail/requirement_status_update', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail5($id)
        {
            $rs_email = $this->db->where('purpose', 'recommendation')->get('email_template')->row(); 
            $recommendation_info = $this->db->where('id',$id)->get('recomendation')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['recommendation'] = $recommendation_info;
            $body = my_load_view($setting->theme, 'Mail/recommendation', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail6($id)
        {
            $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
            $event_info = $this->db->where('event_id',$id)->get('events')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['event'] = $event_info;
            $body = my_load_view($setting->theme, 'Mail/event_invitation', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail7($id)
        {
            $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
            $buddy_meet_info = $this->db->where('buddy_meet_id',$id)->get('buddy_meet')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['buddy_meet'] = $buddy_meet_info;
            $body = my_load_view($setting->theme, 'Mail/buddy_meet_invitation', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail8($id)
        {
            $rs_email = $this->db->where('purpose', 'reminder')->get('email_template')->row(); 
            $event_info = $this->db->where('event_id',$id)->get('events')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['event'] = $event_info;
            $body = my_load_view($setting->theme, 'Mail/event_reminder', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail9($id)
        {
            $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
            $buddy_meet_info = $this->db->where('buddy_meet_id',$id)->get('buddy_meet')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['buddy_meet'] = $buddy_meet_info;
            $body = my_load_view($setting->theme, 'Mail/buddy_meet_reminder', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail10($id)
        {
            $rs_email = $this->db->where('purpose', 'reminder')->get('email_template')->row(); 
            $user_info = $this->db->where('id',$id)->get('user')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['user'] = $user_info;
            $body = my_load_view($setting->theme, 'Mail/reminder', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail11($id)
        {
            $rs_email = $this->db->where('purpose', 'recognition')->get('email_template')->row(); 
            $recognition_info = $this->db->where('recognition_id',$id)->get('recognition')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['recognition'] = $recognition_info;
            $body = my_load_view($setting->theme, 'Mail/recognition', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
        
        public function send_mail12($id)
        {
            $rs_email = $this->db->where('purpose', 'referral')->get('email_template')->row(); 
            $requirement_info = $this->db->where('id',$id)->get('requirements')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement'] = $requirement_info;
            $body = my_load_view($setting->theme, 'Mail/referral', $data);
            echo $body;
//            $email = array(
//			  'email_to' => $user_info->email_address,
//			  'email_subject' => $rs_email->subject,
//			  'email_body' => $body
//		    );
//		$res = my_send_email($email);
//                print_r($res);
        }
	
}