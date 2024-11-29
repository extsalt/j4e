<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
	}
	
	public function getfirebaseid($userid)
	{
	    $getdata = $this->db->select('firebase_uid')->get_where('user',array('id'=>$userid))->row();
	    return $getdata->firebase_uid;
	}
	
	
	// This function is for signup at front end, adduser at backend.
	// And send verification email if necessary, then save data in the user table
	public function save_user($global_setting, $source = 'web', $form_data = []) {
		$pre_check = FALSE;
		$required_verification_email = TRUE;
		$email_verified = 0;
		$user_status = 0;
		$user_ids = my_random();
		if ($source == 'web') {
			$form_data['emailAddress'] = my_post('email_address');
			$form_data['password'] = my_post('password');
			$form_data['firstName'] = my_post('first_name');
			$form_data['lastName'] = my_post('last_name');
		}
		if (!empty($_SESSION['oauth_signup_ids'])) {  //sign up from oauth, retrive oauth identifier
		  $rs_oauth = $this->db->where('ids', $_SESSION['oauth_signup_ids'])->get('oauth_connector', 1)->row();
		  ($rs_oauth->provider == 'Google') ? $oauth_google_identifier = $rs_oauth->identifier : $oauth_google_identifier = '';
		  ($rs_oauth->provider == 'Facebook') ? $oauth_facebook_identifier = $rs_oauth->identifier : $oauth_facebook_identifier = '';
		  ($rs_oauth->provider == 'Twitter') ? $oauth_twitter_identifier = $rs_oauth->identifier : $oauth_twitter_identifier = '';
		  $signup_source = $rs_oauth->provider;
		  if ($form_data['emailAddress'] == $rs_oauth->email_address) {
			  $required_verification_email = FALSE;
			  $email_verified = 1;
			  $user_status = 1;
			  $pre_check = TRUE;
		  }
		}
		else {
			$signup_source = $source;
			$oauth_google_identifier = '';
			$oauth_facebook_identifier = '';
			$oauth_twitter_identifier = '';
		}
		(!empty($_SESSION['is_admin'])) ? $is_admin = $_SESSION['is_admin'] : $is_admin = 0;
		if ($global_setting->email_verification_required && !$is_admin && empty($_SESSION['invite_id'])) {  //need to send verification email
			if ($pre_check != TRUE) {  //need to send email to verify the email address
				$rs_email = $this->db->where('purpose', 'signup_activation')->get('email_template', 1)->row();
				$verification_token = my_random();
				$url = base_url() . 'auth/activate_account/' . $verification_token;
				$body = str_replace('{{first_name}}', $form_data['firstName'], str_replace('{{last_name}}', $form_data['lastName'] ,str_replace('{{verification_url}}', $url, $rs_email->body)));
				$email = array(
				  'email_to' => $form_data['emailAddress'],
				  'email_subject' => $rs_email->subject,
				  'email_body' => $body
				);
				$res = my_send_email($email);
				if ($res['result']) {
					$insert_data = array(
					  'type' => 'signup_activation',
					  'email' => $form_data['emailAddress'],
					  'token' => $verification_token,
					  'reference' => $user_ids,
					  'created_time' => my_server_time(),
					  'done' => 0
					);
					$this->db->insert('token', $insert_data);
					$pre_check = TRUE;
				}
				else {
					$message = my_caption('signup_fail') . ' ' . $res['message'];
					return array('result'=>FALSE, 'message'=>$message);
				}
			}
		}
		else {  //no need to send verification email, possible reason: system setting/administrator creates user/user signs up through invitation email
		    $required_verification_email = FALSE;
			$email_verified = 1;
			$user_status = 1;
			$pre_check = TRUE;
			if (!empty($_SESSION['invite_id'])) { $signup_source = 'invitation'; }
		}
		if ($pre_check) {  //save the user
		  $language = get_cookie('site_lang', TRUE);
		  (!$language) ? $language = $this->config->item('language') : null;
		  (!is_null(get_cookie('src_from', TRUE))) ? $referral_array['src_from'] = get_cookie('src_from', TRUE) : $referral_array['src_from'] = '';
		  (!is_null(get_cookie('referral_code', TRUE))) ? $referral_array['referral_code'] = get_cookie('referral_code', TRUE) : $referral_array['referral_code'] = '';
		  $user_array = array(
		    'ids' => $user_ids,
		    'username' => '',
		    'password' => my_hash_password($form_data['password']),
			'api_key' => my_random(),
			'balance' => '{"usd":0}',
		    'email_address' => $form_data['emailAddress'],
		    'email_verified' => $email_verified,
			'email_address_pending' => '',
			'oauth_google_identifier' => $oauth_google_identifier,
			'oauth_facebook_identifier' => $oauth_facebook_identifier,
			'oauth_twitter_identifier' => $oauth_twitter_identifier,
			'signup_source' => $signup_source,
		    'first_name' => $form_data['firstName'],
		    'last_name' => $form_data['lastName'],
			'company' => '',
		    'avatar' => 'default.jpg',
		    'timezone' => $this->config->item('time_reference'),
			'date_format' => 'Y-m-d',
			'time_format' => 'H:i:s',
			'language' => ucfirst($language),
			'country' => '',
			'currency' => 'USD',
			'address_line_1' => '',
			'address_line_2' => '',
			'city' => '',
			'state' => '',
			'zip_code' => '',
		    'role_ids' => $global_setting->default_role,
		    'status' => $user_status,
		    'created_time' => my_server_time(),
		    'update_time' => my_server_time(),
		    'login_success_detail' => '',
			'online' => 0,
			'online_time' => '',
			'new_notification' => 0,
			'referral' => json_encode($referral_array),
			'affiliate_enabled' => 0,
			'affiliate_code' => '',
			'affiliate_earning' => '{}',
			'affiliate_setting' => '',
                      'membership_type'=>'0'
		  );
		  $this->db->insert('user', $user_array);
		  
		  
		  
		  
		  if ($global_setting->email_verification_required && !$is_admin && empty($_SESSION['invite_id'])) {  //user signup, need to send verification email
			  ($required_verification_email) ? $message = my_caption('signup_success_with_verification') : $message = my_caption('signup_success_without_verification');
		  }
		  else {
			  if (!empty($_SESSION['invite_id'])) {  //user sign up through invitation email
			      $this->db->where('id', $_SESSION['invite_id'])->update('token', array('done'=>1));
				  unset($_SESSION['invite_id']);
				  unset($_SESSION['invite_email']);
				  $message = my_caption('signup_activate_success');
			  }
			  elseif (!$is_admin) {  //user signup, but according to system setting no need to send verification email
				  $message = my_caption('signup_success_without_verification');
			  }
			  else { //admin creates user
				  if (my_post('send_notification')) {  //need to send notification email
					  $rs_email = $this->db->where('purpose', 'notify_email')->get('email_template', 1)->row();
					  $body = str_replace('{{first_name}}', $form_data['firstName'], str_replace('{{last_name}}', $form_data['lastName'] ,str_replace('{{base_url}}', $this->config->item('base_url'), $rs_email->body)));
					  $body = str_replace('{{password}}', $form_data['password'], str_replace('{{email_address}}', $form_data['emailAddress'], $body));
					  $email = array(
					    'email_to' => $form_data['emailAddress'],
						'email_subject' => $rs_email->subject,
						'email_body' => $body
					  );
					  $res = my_send_email($email);
					  if ($res['result']) {
						  $message = my_caption('user_create_success_with_email');
					  }
					  else {
						  $message = my_caption('user_create_success_with_email_but_sent_fail');
					  }
				  }
				  else {  //no need to send notification email
					  $message = my_caption('user_create_success_without_email');
				  }
			  }
		  }
		  if (!empty($_SESSION['oauth_signup_ids'])) { unset($_SESSION['oauth_signup_ids']); }
		  if (!empty($_SESSION['invite_id'])) { unset($_SESSION['invite_id']); }
		  if ($this->setting->two_factor_authentication != 'disabled') { $this->save_cookie('remember_2FA_' . $user_ids, $user_ids);}
		  if ($this->setting->default_package != '0') {
			  $query_item = $this->db->where('ids', $this->setting->default_package)->get('payment_item', 1);
			  if ($query_item->num_rows()) {
				  $this->save_free_package($user_ids, $query_item->row());
			  }
		  }
		  // *** log started
		  $log_detail = my_ua() + array('email_address' => $form_data['emailAddress'], 'user_status' => $user_status);
		  my_log($user_ids, 'Information', 'signup-success', json_encode($log_detail));
		  // *** log ended
		  set_cookie(array('name'=>'referral_code', 'value'=>'', 'domain'=>$_SERVER['HTTP_HOST'], 'expire'=>365*86400));
		  return array('result'=>TRUE, 'message'=>$message);
		}
	}
	
	
		public function save_users($global_setting, $source = 'web', $form_data = []) {   //print_r($form_data);exit();
		$pre_check = FALSE; 
		$required_verification_email = TRUE;
		$email_verified = 0;
		$user_status = 0;
		$user_ids = my_random();
		if ($source == 'web') {
			$form_data['emailAddress'] = my_post('email_address');
			$form_data['password'] = my_post('password');
			$form_data['firstName'] = my_post('first_name');
			$form_data['lastName'] = my_post('last_name');
			//$form_data['role_ids'] = ;
		}
		if (!empty($_SESSION['oauth_signup_ids'])) {  //sign up from oauth, retrive oauth identifier
		  $rs_oauth = $this->db->where('ids', $_SESSION['oauth_signup_ids'])->get('oauth_connector', 1)->row();
		  ($rs_oauth->provider == 'Google') ? $oauth_google_identifier = $rs_oauth->identifier : $oauth_google_identifier = '';
		  ($rs_oauth->provider == 'Facebook') ? $oauth_facebook_identifier = $rs_oauth->identifier : $oauth_facebook_identifier = '';
		  ($rs_oauth->provider == 'Twitter') ? $oauth_twitter_identifier = $rs_oauth->identifier : $oauth_twitter_identifier = '';
		  $signup_source = $rs_oauth->provider;
		  if ($form_data['emailAddress'] == $rs_oauth->email_address) {
			  $required_verification_email = FALSE;
			  $email_verified = 1;
			  $user_status = 1;
			  $pre_check = TRUE;
		  }
		}
		else {
			$signup_source = $source;
			$oauth_google_identifier = '';
			$oauth_facebook_identifier = '';
			$oauth_twitter_identifier = '';
		}
		(!empty($_SESSION['is_admin'])) ? $is_admin = $_SESSION['is_admin'] : $is_admin = 0;
		if ($global_setting->email_verification_required && !$is_admin && empty($_SESSION['invite_id'])) {  //need to send verification email
			if ($pre_check != TRUE) {  //need to send email to verify the email address
				$rs_email = $this->db->where('purpose', 'signup_activation')->get('email_template', 1)->row();
				$verification_token = my_random();
				$url = base_url() . 'auth/activate_account/' . $verification_token;
				$body = str_replace('{{first_name}}', $form_data['firstName'], str_replace('{{last_name}}', $form_data['lastName'] ,str_replace('{{verification_url}}', $url, $rs_email->body)));
				$email = array(
				  'email_to' => $form_data['emailAddress'],
				  'email_subject' => $rs_email->subject,
				  'email_body' => $body
				);
				$res = my_send_email($email);
				if ($res['result']) {
					$insert_data = array(
					  'type' => 'signup_activation',
					  'email' => $form_data['emailAddress'],
					  'token' => $verification_token,
					  'reference' => $user_ids,
					  'created_time' => my_server_time(),
					  'done' => 0
					);
					$this->db->insert('token', $insert_data);
					$pre_check = TRUE;
				}
				else {
					$message = my_caption('signup_fail') . ' ' . $res['message'];
					return array('result'=>FALSE, 'message'=>$message);
				}
			}
		}
		else {  //no need to send verification email, possible reason: system setting/administrator creates user/user signs up through invitation email
		    $required_verification_email = FALSE;
			$email_verified = 1;
			$user_status = 1;
			$pre_check = TRUE;
			if (!empty($_SESSION['invite_id'])) { $signup_source = 'invitation'; }
		}
		if ($pre_check) {  //save the user
		  $language = get_cookie('site_lang', TRUE);
		  (!$language) ? $language = $this->config->item('language') : null;
		  (!is_null(get_cookie('src_from', TRUE))) ? $referral_array['src_from'] = get_cookie('src_from', TRUE) : $referral_array['src_from'] = '';
		  (!is_null(get_cookie('referral_code', TRUE))) ? $referral_array['referral_code'] = get_cookie('referral_code', TRUE) : $referral_array['referral_code'] = '';
		  $user_array = array(
		    'ids' => $user_ids,
		    'username' => '',
		    'password' => my_hash_password($form_data['password']),
			'api_key' => my_random(),
			'balance' => '{"usd":0}',
		    'email_address' => $form_data['emailAddress'],
		    'email_verified' => $email_verified,
			'email_address_pending' => '',
			'phone' => my_post('ph_no'),
			'oauth_google_identifier' => $oauth_google_identifier,
			'oauth_facebook_identifier' => $oauth_facebook_identifier,
			'oauth_twitter_identifier' => $oauth_twitter_identifier,
			'signup_source' => $signup_source,
		    'first_name' => $form_data['firstName'],
		    'last_name' => $form_data['lastName'],
			'company' => '',
		    'avatar' => 'default.jpg',
		    'timezone' => $this->config->item('time_reference'),
			'date_format' => 'Y-m-d',
			'time_format' => 'H:i:s',
			'language' => ucfirst($language),
			'country' => 'IN',
			'currency' => 'USD',
			'address_line_1' => '',
			'address_line_2' => '',
			'city' => '',
			'state' => '',
			'zip_code' => '',
		    'role_ids' => my_post('rol_for'),
		    'status' => $user_status,
		    'created_time' => my_server_time(),
		    'update_time' => my_server_time(),
		    'login_success_detail' => '',
			'online' => 0,
			'online_time' => '',
			'new_notification' => 0,
			'referral' => json_encode($referral_array),
			'affiliate_enabled' => 0,
			'affiliate_code' => '',
                      'membership_type'=>'0',
			'affiliate_earning' => '{}',
			'affiliate_setting' => ''
		  );  //print_r($user_array);
		  $this->db->insert('user', $user_array);  //echo $this->db->last_query();exit();
		  if ($global_setting->email_verification_required && !$is_admin && empty($_SESSION['invite_id'])) {  //user signup, need to send verification email
			  ($required_verification_email) ? $message = my_caption('signup_success_with_verification') : $message = my_caption('signup_success_without_verification');
		  }
		  else {
			  if (!empty($_SESSION['invite_id'])) {  //user sign up through invitation email
			      $this->db->where('id', $_SESSION['invite_id'])->update('token', array('done'=>1));
				  unset($_SESSION['invite_id']);
				  unset($_SESSION['invite_email']);
				  $message = my_caption('signup_activate_success');
			  }
			  elseif (!$is_admin) {  //user signup, but according to system setting no need to send verification email
				  $message = my_caption('signup_success_without_verification');
			  }
			  else { //admin creates user
				  if (my_post('send_notification')) {  //need to send notification email
					  $rs_email = $this->db->where('purpose', 'notify_email')->get('email_template', 1)->row();
					  $body = str_replace('{{first_name}}', $form_data['firstName'], str_replace('{{last_name}}', $form_data['lastName'] ,str_replace('{{base_url}}', $this->config->item('base_url'), $rs_email->body)));
					  $body = str_replace('{{password}}', $form_data['password'], str_replace('{{email_address}}', $form_data['emailAddress'], $body));
					  $email = array(
					    'email_to' => $form_data['emailAddress'],
						'email_subject' => $rs_email->subject,
						'email_body' => $body
					  );
					  $res = my_send_email($email);
					  if ($res['result']) {
						  $message = my_caption('user_create_success_with_email');
					  }
					  else {
						  $message = my_caption('user_create_success_with_email_but_sent_fail');
					  }
				  }
				  else {  //no need to send notification email
					  $message = my_caption('user_create_success_without_email');
				  }
			  }
		  }
		  if (!empty($_SESSION['oauth_signup_ids'])) { unset($_SESSION['oauth_signup_ids']); }
		  if (!empty($_SESSION['invite_id'])) { unset($_SESSION['invite_id']); }
		  if ($this->setting->two_factor_authentication != 'disabled') { $this->save_cookie('remember_2FA_' . $user_ids, $user_ids);}
		  if ($this->setting->default_package != '0') {
			  $query_item = $this->db->where('ids', $this->setting->default_package)->get('payment_item', 1);
			  if ($query_item->num_rows()) {
				  $this->save_free_package($user_ids, $query_item->row());
			  }
		  }
		  // *** log started
		  $log_detail = my_ua() + array('email_address' => $form_data['emailAddress'], 'user_status' => $user_status);
		  my_log($user_ids, 'Information', 'signup-success', json_encode($log_detail));
		  // *** log ended
		  set_cookie(array('name'=>'referral_code', 'value'=>'', 'domain'=>$_SERVER['HTTP_HOST'], 'expire'=>365*86400));
		  return array('result'=>TRUE, 'message'=>$message);
		}
	}
	
	
	public function get_check_invite_count($mobile_number,$eventid)
	{
	    $query = $this->db->where('event_invite_mobileno',$mobile_number)->get('event_invite')->num_rows();
	    
	    $qrr=$this->db->query("select * from event_invite where event_invite_type='2' AND event_invite_mobileno='".$mobile_number."' AND event_invite_eventid='".$eventid."'")->result();
	    if(isset($qrr) && !empty($qrr))
	    {
	        
	         $once_register = "Yes";
	         
	    }else{
	        
	         $once_register = "No";
	        
	        
	    }
	    
	    
	    $get_no_of_fee_invite = $this->setting->no_of_free_invite;
	    $inviteverification = $this->setting->invite_approval;    // 1 for yes
	    
	    if($inviteverification == '1'){$verification = 'Yes';} else{$verification = 'No';}
	    
	    if($query < $get_no_of_fee_invite)
	    {
	        return array('verification_need'=>'No','Free_allowed'=>'Yes','registered'=>$once_register);
	    }
	    else
	    {
	        return array('verification_need'=>$verification,'Free_allowed'=>'No','registered'=>$once_register);
	    }
	    
	    
	    
	    
	}
	
	
	//This function is used for checking user's credential when signin
	public function signin_check() {
		if (!empty($_SESSION['two_factor_authentication'])) {
			$rs = $_SESSION['two_factor_authentication'];
			unset($_SESSION['two_factor_authentication']);
		}
		else {
			$rs = $this->signin_query_user(my_post('username'), my_post('password'));
		}
		if ($rs) { // auth pass
			if ($rs->status == 0 && $this->setting->signin_before_verified == 0) { //pending and not allowed to signin before activated
				return array('result'=>FALSE, 'message'=>my_caption('signin_account_pending'));
			}
			elseif ($rs->status == 2) { //deactivated
				return array('result'=>FALSE, 'message'=>my_caption('signin_account_deactivated'));
			}	
			else {   //signin allowed
				if (my_post('choose_action') == 'signin' && !empty($_SESSION['oauth_ids'])) {  //bind the account to social media profile at sign in page if user choose to do so
					$rs_oauth = $this->db->where('ids', $_SESSION['oauth_ids'])->get('oauth_connector', 1)->row();
					$update_array = array('oauth_' . $rs_oauth->provider . '_identifier'=>$rs_oauth->identifier);
					$this->db->where('id', $rs->id)->update('user', $update_array);
				}
				if (!empty($_SESSION['oauth_ids'])) { unset($_SESSION['oauth_ids']); }
				// cookie
				(my_post('remember')) ? $this->save_cookie('remember_signin', $rs->ids) : $this->remove_cookie('remember_signin', get_cookie('remember_signin', TRUE));
				//session and log
				return $this->sigin_success_log($rs, 'web');
			}		
		}
		else {
			// *** log started
			$log_detail = my_ua() + array('username' => my_post('username'));
			my_log('', 'Warning', 'signin-failed', json_encode($log_detail));
			// *** log ended
			my_throttle_log(my_post('username'));
			return array('result'=>FALSE, 'message'=>my_caption('signin_credential_error'));
		}
	}
	
	
	
	public function signin_query_user($username, $password) {
		$this->db->where('username', $username)->or_where('email_address', $username);
		$query = $this->db->get('user', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			if (password_verify($password, $rs->password)) {
				return $rs;
			}
			else {
				return FALSE;
			}
		}
		else {
			return FALSE;
		}
	}
	
	
	
	public function sigin_success_log($rs, $interface) {
		$rs_role = $this->db->where('ids', $rs->role_ids)->get('role', 1)->row();
		if ($rs_role->name == 'Super_Admin') {
		//	my_clic();
			$is_admin = 1;
		}
		else {
			$is_admin = 0;
		}
		
		if ($interface != 'api') { //if sign in from browser, handle session & cookie
			// set session
			$session_array = array(
			  'user_ids' => $rs->ids,
			  'user_id' => $rs->id,
			  'is_admin' => $is_admin,
			  'company_id'=> $rs->company,
			  'full_name' => $rs->first_name . ' ' . $rs->last_name,
                          'chapter_id' => $rs->chapterid
			);
			if (!empty($_SESSION['impersonate'])) { unset($_SESSION['impersonate']); }
			($interface == 'impersonate') ? $session_array['impersonate'] = $_SESSION['user_ids'] : null;
			$this->session->set_userdata($session_array);
		    
			// read language setting from user profile and set language of interface
			$language_cookie = array(
			  'name' => 'site_lang',
			  'value' => strtolower($rs->language),
			  'domain' => $_SERVER['HTTP_HOST'],
			  'expire' => 365*86400
			);
			set_cookie($language_cookie);
		}
		
		// update user
		$login_detail = array(
		  'time' => my_server_time() . ' ' . $this->config->item('time_reference'),
		  'interface' => $interface,
		  'ip_address' => $this->input->ip_address(),
		  'user_agent' => $this->agent->browser() . ' ' . $this->agent->version()
		);
		$update_array = array(
		  'login_success_detail' => json_encode($login_detail),
		  'online' => 1,
		  'online_time' => my_server_time()
		);
		$this->db->where('ids', $rs->ids)->update('user', $update_array);
		
		// ***log started
		my_log($rs->ids, 'Information', 'signin-success', json_encode(my_ua()));
		// *** log ended
		
		return array('result'=>TRUE, 'message'=>'');
	}
	
	
	
	// This function is used for check and send reset password link
	public function forget_password($email_address = '') {
		($email_address == '') ? $email_address = my_post('email_address') : null;
		$query = $this->db->where('email_address', $email_address)->get('user', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			if ($rs->status == 1) {
				$rs_email = $this->db->where('purpose', 'reset_password')->get('email_template', 1)->row();
				$verification_token = my_random();
				$url = base_url() . 'auth/reset_password/' . $verification_token;
				$body = str_replace('{{first_name}}', $rs->first_name, str_replace('{{last_name}}', $rs->last_name ,str_replace('{{verification_url}}', $url, $rs_email->body)));
				$email = array(
				  'email_to' => $email_address,
				  'email_subject' => $rs_email->subject,
				  'email_body' => $body
				);
				$res = my_send_email($email);
				if ($res['result']) {
					$insert_data = array(
					  'type' => 'reset_password',
				      'email' => $email_address,
				      'token' => $verification_token,
				      'reference' => $rs->ids,
				      'created_time' => my_server_time(),
				      'done' => 0
				    );
				    $this->db->insert('token', $insert_data);
					return array('result'=>TRUE, 'message'=>my_caption('forget_reset_email_sent'));
				}
				else {
					return array('result'=>FALSE, 'message'=>$res['message']);
				}
			}
			else {
				return array('result'=>FALSE, 'message'=>my_caption('forget_user_disabled'));
			}
		}
		else {
			return array('result'=>FALSE, 'message'=>my_caption('forget_email_address_not_exist'));
		}	
	}
	
	
	
	public function update_profile($ids, $avatar_file, $update_from = 'form', $form_data = []) {
		//if update request is from form, need to build the $form_data, if it's from api, $form_data can be used directly
		if ($update_from == 'form') {
			$form_data = array(
			  'username' => my_post('username'),
			  'emailAddress' => my_post('email_address'),
			  'phone' => my_post('phone'),
			  'firstName' => my_post('first_name'),
			  'lastName' => my_post('last_name'),
			  'company' => my_post('company'),
			  'company_number' => substr(my_post('company_number'), 0, 50),
			  'tax_number' => substr(my_post('tax_number'), 0 ,50),
			  'timezone' => my_post('timezone'),
			  'dateFormat' => my_post('date_format'),
			  'timeFormat' => my_post('time_format'),
			  'language' => my_post('language'),
			  'currency' => my_post('currency'),
			  'country' => my_post('country'),
			  'addressLine1' => my_post('address_line_1'),
			  'addressLine2' => my_post('address_line_2'),
			  'city' => my_post('city'),
			  'state' => my_post('state'),
			  'zipCode' => my_post('zip_code')
			);
		}
		$query = $this->db->where('ids', $ids)->get('user', 1);
		$global_setting = my_global_setting('all_fields');
		$pending_email_address = '';
		$update_array = [];
		if ($query->num_rows()) {
			$rs = $query->row();
			$pre_check = FALSE;
			(isset($_SESSION['is_admin'])) ? $is_admin = $_SESSION['is_admin'] : $is_admin = FALSE;
			if ($is_admin && my_uri_segment(3) != '') {  //if admin modifies user's email address, no need to verify the new email address
				$update_array = array(
				  'email_address' => $form_data['emailAddress'],
				  'email_verified' => 1
				);
				$pre_check = TRUE;
			}
			elseif ($rs->email_address != $form_data['emailAddress']) {  // user modifies his email address
				if ($global_setting->email_verification_required) {
					$pending_email_address = $form_data['emailAddress'];
					$rs_email = $this->db->where('purpose', 'change_email')->get('email_template', 1)->row();
					$verification_token = my_random();
					$url = base_url() . 'auth/change_email/' . $verification_token;
					$body = str_replace('{{first_name}}', $form_data['firstName'], str_replace('{{last_name}}', $form_data['lastName'] ,str_replace('{{verification_url}}', $url, $rs_email->body)));
					$email = array(
					  'email_to' => $pending_email_address,
					  'email_subject' => $rs_email->subject,
					  'email_body' => $body
				    );
					$res = my_send_email($email);
					if ($res['result']) {
						$insert_data = array(
						  'type' => 'change_email',
						  'email' => $pending_email_address,
						  'token' => $verification_token,
						  'reference' => $rs->ids,
						  'created_time' => my_server_time(),
						  'done' => 0
						);
						$this->db->insert('token', $insert_data);
						$pre_check = TRUE;
					}
					else {
						$message = my_caption('mp_fail') . ' ' . $res['message'];
						return array('result'=>FALSE, 'message'=>$res['message']);
					}
				}
				else {  //no need to verify the email duo to the system setting
					$update_array = array(
					  'email_address' => $form_data['emailAddress'],
					  'email_verified' => 1
					);
					$pre_check = TRUE;
				}
			}
			else {  //email not changed, no need to send confirmation email
				$pre_check = TRUE;
			}
			if ($pre_check) {
				$update_array += array(
				  'email_address_pending' => $pending_email_address,
				  'phone' => $form_data['phone'],
				  'username' => $form_data['username'],
				  'first_name' => $form_data['firstName'],
				  'last_name' => $form_data['lastName'],
				  'company' => $form_data['company'],
				  'company_number' => $form_data['company_number'],
				  'tax_number' => $form_data['tax_number'],
				  'date_format' => $form_data['dateFormat'],
				  'time_format' => $form_data['timeFormat'],
				  'timezone' => $form_data['timezone'],
				  'language' => $form_data['language'],
				  'country' => $form_data['country'],
				  'currency' => $form_data['currency'],
				  'address_line_1' => $form_data['addressLine1'],
				  'address_line_2' => $form_data['addressLine2'],
				  'city' => $form_data['city'],
				  'state' => $form_data['state'],
				  'zip_code' => $form_data['zipCode'],
				  'update_time' => my_server_time()
				);
				($avatar_file != '') ? $update_array['avatar'] = $avatar_file : null;
				//set current language if update is from form
				if ($update_from == 'form' && my_uri_segment(3) == '') {
					$language_cookie = array(
					  'name' => 'site_lang',
					  'value' => strtolower($form_data['language']),
					  'domain' => $_SERVER['HTTP_HOST'],
					  'expire' => 365*86400
					);
					set_cookie($language_cookie);
					$_SESSION['full_name'] = $form_data['firstName'] . ' ' . $form_data['lastName'];
				}

				// ***log started
				($global_setting->debug_level == 1) ? $debug_detail = json_encode($update_array) : $debug_detail = '';
				my_log($ids, 'Information', 'update-user-profile', json_encode(my_ua()), $debug_detail);
				// *** log ended
				
				$this->db->where('ids', $ids)->update('user', $update_array);  // update tbl
				if ($pending_email_address != '') {
					return array('result'=>TRUE, 'message'=>my_caption('mp_update_success_with_email'));
				}
				else {
					return array('result'=>TRUE, 'message'=>my_caption('mp_update_success_without_email'));
				}
			}
		}
		else {
			return array('result'=>FALSE, 'message'=>my_caption('mp_no_such_user'));
		}
	}
	
	
	
	public function payment_log($payment_gateway, $gateway_identifier, $rs_item, $amount, $tax) {
		$coupon_code = my_uri_segment(5);
		$coupon_discount = 0;
		$query = $this->db->where('user_ids', $_SESSION['user_ids'])->where('item_ids', $rs_item->ids)->where('coupon', $coupon_code)->where('gateway', $payment_gateway)->where('redirect_status!=', 'success')->where('callback_status!=', 'success')->get('payment_log', 1);
		if ($query->num_rows()) {  //update the exist one
			$update_array = array(
			  'gateway_identifier' => $gateway_identifier,
			  'redirect_status' => 'pending',
			  'created_time'=>my_server_time()
			);
			$this->db->where('id', $query->row()->id)->update('payment_log', $update_array);
		}
		else {  //create an new one
		    if (my_coupon_module() && $coupon_code != '') {
				$coupon_result_array = my_coupon_check($rs_item->ids, $coupon_code);
				($coupon_result_array['result']) ? $coupon_discount = $coupon_result_array['discount'] : $coupon_code = '';
			}
			$insert_data = array(
			  'ids' => my_random(),
			  'user_ids' => $_SESSION['user_ids'],
			  'type' => $rs_item->type,
			  'gateway' => $payment_gateway,
			  'currency' => $rs_item->item_currency,
			  'price' => $rs_item->item_price,
			  'quantity' => 1,
			  'amount' => $amount,
			  'gateway_identifier' => $gateway_identifier,
			  'gateway_event_id' => '',
			  'item_ids' => $rs_item->ids,
			  'item_name' => $rs_item->item_name,
			  'redirect_status' => 'pending',
			  'callback_status	' => 'pending',
			  'created_time' => my_server_time(),
			  'visible_for_user' => 1,
			  'generate_invoice' => 1,
			  'description' => '',
			  'coupon' => $coupon_code,
			  'coupon_discount' => $coupon_discount,
			  'tax' => $tax
			);
			$this->db->insert('payment_log', $insert_data);
		}
		return TRUE;
	}
	
	
	public function send_2FA($user_ids, $type, $send_target) {
		if ($type == 'email') {  // current only email is supported
			$rs_email_template = $this->db->where('purpose', '2FA_email')->get('email_template', 1)->row();
			$code = random_string('numeric', 6);
			$body = str_replace('{{code}}', $code, $rs_email_template->body);
			$email = array(
			  'email_to' => $send_target,
			  'email_subject' => $rs_email_template->subject,
			  'email_body' => $body
			);
			$res = my_send_email($email);
			if ($res['result']) {
				$insert_data = array(
				  'type' => '2FA',
				  'email' => $send_target,
				  'token' => $code,
				  'reference' => $user_ids,
				  'created_time' => my_server_time(),
				  'done' => 0
				);
				$this->db->insert('token', $insert_data);
				return array('result'=>TRUE, 'message'=>my_caption('signin_2fa_sent_notice') . $send_target);
			}
			else {
				return array('result'=>FALSE, 'message'=>$res['message']);
			}
		}
	}
	
	
	
	public function save_cookie($cookie_name, $user_ids) {
		$cookie_ids = my_random();
		$local_cookie = array(
		  'name' => $cookie_name,
		  'value' => $cookie_ids,
		  'expire' => 365*86400,
		  'domain' => $_SERVER['SERVER_NAME']
		);
		set_cookie($local_cookie);
		
		$server_cookie = array(
		  'ids' => $cookie_ids,
		  'type' => $cookie_name,
		  'user_ids' => $user_ids,
		  'created_time' => my_server_time(),
		  'expired_time' => date('Y-m-d H:i:s', strtotime('+1 years'))
		);
		$this->db->insert('session', $server_cookie);
		return TRUE;
	}
	
	
	
	public function remove_cookie($cookie_name, $cookie_ids) {
		delete_cookie('cookie_name');
		$this->db->delete('session', array('ids'=>$cookie_ids));
	}
	
	
	
	public function user_fileds_builder($rs) {
		return array(
		  'message' => array(
		    'ids' => $rs->ids,
			'status' => $rs->status,
		    'username ' => $rs->username,
			'balance' => $rs->balance,
			'emailAddress' => $rs->email_address,
			'phone' => $rs->phone,
			'firstName' => $rs->first_name,
			'lastName' => $rs->last_name,
			'timezone' => $rs->timezone,
			'dateFormat' => $rs->date_format,
			'timeFormat' => $rs->time_format,
			'language' => $rs->language,
			'currency' => $rs->currency,
			'country' => $rs->country,
			'addressLine1' => $rs->address_line_1,
			'addressLine2' => $rs->address_line_2,
			'city' => $rs->city,
			'state' => $rs->state,
			'zipCode' => $rs->zip_code,
			'status' => $rs->status,
			'createdTime' => my_conversion_from_server_to_local_time($rs->created_time, $rs->timezone, $rs->date_format . ' ' . $rs->time_format),
			'updateTime' => my_conversion_from_server_to_local_time($rs->update_time, $rs->timezone, $rs->date_format . ' ' . $rs->time_format)
          )	  
		);
	}
	
	
	
	public function save_ticket() {
		$ids = my_random();
		$insert_array = array(
		  'ids' => $ids,
		  'ids_father' => 0,
		  'source' => 'user',
		  'user_ids' => $_SESSION['user_ids'],
		  'user_fullname' => $_SESSION['full_name'],
		  'main_status' => 2,
		  'read_status' => 0,
		  'catalog' => my_post('ticket_catalog'),
		  'priority' => my_post('ticket_priority'),
		  'subject' => my_post('ticket_subject'),
		  'description' => my_post('ticket_description'),
		  'associated_files' => '',
		  'created_time' => my_server_time(),
		  'updated_time' => my_server_time(),
		  'rating' => 0
		);
		$this->db->insert('ticket', $insert_array);
		//notify the agent through email if necessary starts
		$ticket_setting_array = json_decode($this->setting->ticket_setting, 1);
		if ($ticket_setting_array['notify_agent_list'] != '') {
			$rs_email = $this->db->where('purpose', 'ticket_notify_agent')->get('email_template', 1)->row();
			$email = array(
			  'email_to' => $ticket_setting_array['notify_agent_list'],
			  'email_subject' => $rs_email->subject,
			  'email_body' => $rs_email->body
		    );
			my_send_email($email);
		}
		//notify the agent through email if necessary ends
		return $ids;
	}
	
	
	
	public function update_ticket($type) {
		$ids_father = my_post('ids_father');
		$ticket_setting_array = json_decode($this->setting->ticket_setting, 1);
		switch ($type) {
			case 'user_update' :
			  $source = 'user';
			  $main_status = 2;
			  if ($ticket_setting_array['notify_agent_list'] != '') {  //ticket updated by user, notify agent if necessary
				  $rs_email = $this->db->where('purpose', 'ticket_notify_agent')->get('email_template', 1)->row();
				  $email = array(
				    'email_to' => $ticket_setting_array['notify_agent_list'],
					'email_subject' => $rs_email->subject,
					'email_body' => $rs_email->body
				  );
				  my_send_email($email);
			  }
			  break;
			case 'agent_update' :
			  $source = 'agent';
			  $main_status = 1;
			  if ($ticket_setting_array['notify_user']) {  //ticket updated by agent, notify user if necessary
				  $rs_email = $this->db->where('purpose', 'ticket_notify_user')->get('email_template', 1)->row();
				  $user_ids = $this->db->where('ids', $ids_father)->get('ticket', 1)->row()->user_ids;
				  $email = array(
				    'email_to' => my_user_setting($user_ids, 'email_address'),
					'email_subject' => $rs_email->subject,
					'email_body' => $rs_email->body
				  );
				  my_send_email($email);
			  }
			  break;
		}
		$insert_array = array(
		  'ids' => my_random(),
		  'ids_father' => $ids_father,
		  'source' => $source,
		  'user_ids' => $_SESSION['user_ids'],
		  'user_fullname' => $_SESSION['full_name'],
		  'main_status' => 0,
		  'read_status' => 0,
		  'catalog' => '',
		  'priority' => 0,
		  'subject' => '',
		  'description' => my_post('ticket_reply'),
		  'associated_files' => '',
		  'created_time' => my_server_time(),
		  'updated_time' => my_server_time(),
		  'rating' => 0
		);
		$this->db->insert('ticket', $insert_array);
		$this->db->where('ids', $ids_father)->update('ticket', array('main_status'=>$main_status, 'read_status'=>0, 'updated_time'=>my_server_time()));
		return $ids_father;
	}
	
	
	
	public function save_free_package($user_ids, $rs_item) {
		if ($rs_item->type == 'purchase') {
			$insert_data = array(
			  'ids' => my_random(),
			  'user_ids' => $user_ids,
			  'payment_ids' => str_repeat('0', 50),
			  'item_type' => 'purchase',
			  'item_ids' => $rs_item->ids,
			  'item_name' => $rs_item->item_name,
			  'created_time' => my_server_time(),
			  'description' => '',
			  'stuff' => $rs_item->stuff_setting,
			  'used_up' => 0,
			  'auto_renew' => $rs_item->auto_renew
			);
			$this->db->insert('payment_purchased', $insert_data);
		}
		elseif ($rs_item->type == 'subscription') {
			$current_time = my_server_time();
			$end_time = date('Y-m-d H:i:s', strtotime($rs_item->recurring_interval_count . ' ' . $rs_item->recurring_interval, strtotime($current_time)));
			$insert_data = array(
			  'ids' => my_random(),
			  'item_ids' => $rs_item->ids,
			  'user_ids' => $user_ids,
			  'payment_gateway' => 'free',
			  'gateway_identifier' => '',
			  'quantity' => 1,
			  'status' => 'active',
			  'start_time' => $current_time,
			  'end_time' => $end_time,
			  'created_time' => $current_time,
			  'updated_time' => $current_time,
			  'description' => '',
			  'stuff' => $rs_item->stuff_setting,
			  'used_up' => 0,
			  'auto_renew' => $rs_item->auto_renew
			);
			$this->db->insert('payment_subscription', $insert_data);
		}
		return TRUE;
	}
	
	
	/*
	*   GET USER APP LOGIN API 
	*
	*/
	
	public function get_app_user_login($mobile){
	    
	    
		$this->db->select('u.id,r.name');
        $this->db->from('user as u');
        $this->db->join('role as r', 'r.ids = u.role_ids');
        $this->db->where('u.phone', $mobile);
        $query = $this->db->get();
        
        if ($query->num_rows()) {
			$rs = $query->row();
			
				return $rs;
			
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_user_login_fileds_builder($rs){
	    return array(
		  'message' => array(
		    'userid'=>$rs->id,
		    'user_type'=>$rs->name,
		    'membership_type'=>'null'
		  )	  
		);
	    
	}
	
	/*
	*   GET USER APP SEND OTP API 
	*
	*/
	
	public function get_app_user_exist($mobile,$userid){
	    $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where(array('u.id'=>$userid,'u.phone'=>$mobile));
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
			return $rs;	
			
		}
		else {
			return FALSE;
		}
	}
	
	public function send_otp_for_vrify($mobile,$otp)
	{
//            "http://sms.auurumdigital.com/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$sender_id."&channel=Trans&DCS=0&flashsms=0&number=".$recipients."&text=".urlencode($messagetext)."&route=8&peid=1001799727186398183"
//            $apikey="0LvamRT5R0aR5Mnrb2X3Sw";
//                $sender_id="APPLEX";
                 $curl = curl_init();
                 $recipients = $mobile;
                
                 $messagetext = "One Time Password ".$otp." to Login for J4E App.If you didn't initiate, report as FRAUD on ".$this->setting->support_no." J4E Team";
                 curl_setopt_array($curl, array(
                 CURLOPT_URL => "http://ocs-sms.com/submitsms.jsp?user=dadhichi&key=11dc3377eeXX&mobile=".$recipients."&message=".urlencode($messagetext)."&senderid=JFENTP&accusage=1&entityid=1201161225010387296&tempid=1207166624969359273",
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_ENCODING => "",
                 CURLOPT_MAXREDIRS => 10,
                 CURLOPT_TIMEOUT => 30,
                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                 CURLOPT_CUSTOMREQUEST => "GET",
                 CURLOPT_SSL_VERIFYHOST => 0,
                 CURLOPT_SSL_VERIFYPEER => 0,));
                // // echo "http://sms.applex360.in/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$sender_id."&channel=Trans&DCS=0&flashsms=0&number=".$recipients."&text=".$messagetext."&route=7";
                 $response = curl_exec($curl);
                 curl_close($curl); 
//	            $apikey="QNyRRsgluUGYvX415HkJxQ";
//                $sender_id="APPLEX";
//                $curl = curl_init();
//                $recipients = $mobile;
//                $messagetext = "One Time Password ".$otp." to Login for J4E App.If you didn't initiate, report as FRAUD on 9673304412 Applex Group";
//                curl_setopt_array($curl, array(
//                CURLOPT_URL => "http://sms.auurumdigital.com/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$sender_id."&channel=Trans&DCS=0&flashsms=0&number=".$recipients."&text=".urlencode($messagetext)."&route=00",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 30,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "GET",
//                CURLOPT_SSL_VERIFYHOST => 0,
//                CURLOPT_SSL_VERIFYPEER => 0,));
//                // echo "http://sms.applex360.in/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$sender_id."&channel=Trans&DCS=0&flashsms=0&number=".$recipients."&text=".$messagetext."&route=7";
//                $response = curl_exec($curl);
//                curl_close($curl); 
                $log_detail = my_ua();
                my_otp_log($mobile, 'Information', 'otp-requested', json_encode($log_detail));
	}
	
	
	public function update_otp($mobile,$userid){
	    
	    $otp=rand(111111,987456);
	    $this->db->where(array('id'=>$userid,'phone'=>$mobile));
        $this->db->update('user',array('otp'=>$otp));
        
        $this->send_otp_for_vrify($mobile,$otp);
        return $otp;
        
        
        
        
        
        
        
        
	    
	}
	
	public function get_app_send_otp_fileds_builder($rs,$otp){
	    
	    return array(
		  'message' => array(
		    'userid'=>$rs->id,
		    'mobile'=>$rs->phone,
		    'otp'=>$otp,
		    
		  )	  
		);
	    
	}
	
	
	/*
	*   GET USER APP VERIFY OTP API 
	*
	*/
	
	public function get_app_user_verify_otp($otp,$userid,$mobile,$device_type,$device_token,$global_setting,$ort){
	    
	    //check mobile no esist or nott
	    $checkmobile=$this->db->query("select * from user_temp where phone='".$mobile."' and otp='".$otp."'")->result();
	    if(isset($checkmobile) && !empty($checkmobile)){
	        //update approved
	        $this->db->where(array('phone'=>$mobile,'id'=>$userid));
	        $this->db->update('user_temp',array('phone_verified'=>1,'otp_verified'=>1));
	        
	        //check data exist or not in user table  
	        
	        $device_data = array(
	            'device_type'=>$device_type,
			    'device_token'=>$device_token
	            );
	        $this->db->where('phone',$mobile)->update('user',$device_data);
	        
                if(!empty($ort))
                {
                    $log_detail = my_ua();
                    my_otp_log($mobile, 'Information', 'otp-receive', json_encode($log_detail),'',$ort);
                }
	        $log_detail = my_ua();
                my_otp_log($mobile, 'Information', 'otp-verify', json_encode($log_detail));
	        
	        $check_in_usertble=$this->db->query("select * from user where phone='".$mobile."'")->row();
	        if(isset($check_in_usertble) && !empty($check_in_usertble)){
	            
	            //update phone verified
	            $this->db->where(array("phone"=>$mobile));
	            $rrrr=$this->db->update('user',array('phone_verified'=>1,'otp_verified'=>1));
	            if($rrrr==true){
	                //$check_in_usertble[0]
	                
	                $get_role_type = $this->db->select('name')->where('ids',$check_in_usertble->role_ids)->get('role')->row();
	                $get_area_name = $this->db->select('functional_area')->where('functional_area_id',$check_in_usertble->business_category)->get('tbl_functional_area')->row();
	                $get_turn_over= $this->db->select('turn_over_value')->where('turn_over_id',$check_in_usertble->turn_over)->get('turn_over')->row();
                        
                        
    	               
    	               $data_user = array(
    	                    "id"=> $check_in_usertble->id,
                            "ids"=> $check_in_usertble->ids,
                            "username"=> $check_in_usertble->username,
                            "api_key"=> $check_in_usertble->api_key,
                            "email_address"=> $check_in_usertble->email_address,
                            "signup_source"=> $check_in_usertble->signup_source,
                            "signup_socialid"=> $check_in_usertble->signup_socialid,
                            "prefix"=> $check_in_usertble->prefix,
                            "first_name"=> $check_in_usertble->first_name,
                            "middle_name"=> $check_in_usertble->middle_name,
                            "last_name"=> $check_in_usertble->last_name,
                            "gender"=> $check_in_usertble->gender,
                            "dob"=> $check_in_usertble->dob,
                            "blood_group"=> $check_in_usertble->blood_group,
                            "designation"=> $check_in_usertble->designation,
                            "wmobile"=> $check_in_usertble->phone,
                            "phone"=> $check_in_usertble->phone,
                            "landline"=> $check_in_usertble->landline,
                            "company"=> $check_in_usertble->company,
                            "total_experience"=> $check_in_usertble->total_experience,
                            "company_address"=> $check_in_usertble->company_address,
                            "company_contact"=> $check_in_usertble->company_contact,
                            "about_company"=> $check_in_usertble->about_company,
                            "business_entity"=> $check_in_usertble->business_entity,
                            "business_category_id"=> $check_in_usertble->business_category,
                            "business_category_name"=> $get_area_name->functional_area,
                            "business_experties"=> $check_in_usertble->business_experties,
                            "business_type"=> $check_in_usertble->business_type,
                            "working_from"=> $check_in_usertble->working_from,
                            "no_of_employees"=> $check_in_usertble->no_of_employees,
                            "turn_over"=> $check_in_usertble->turn_over,
                            "turn_over_value"=> $get_turn_over->turn_over_value,
                            "target_audiance"=> $check_in_usertble->target_audiance,
                            "company_profile"=> $check_in_usertble->company_profile,
                            "company_ppt"=> $check_in_usertble->company_ppt,
                            "vcard_front"=> $check_in_usertble->vcard_front,
                            "vcard_back"=> $check_in_usertble->vcard_back,
                            "company_google"=> $check_in_usertble->company_google,
                            "company_facebook"=> $check_in_usertble->company_facebook,
                            "company_linkedin"=> $check_in_usertble->company_linkedin,
                            "company_instagram"=> $check_in_usertble->company_instagram,
                            "company_twitter"=> $check_in_usertble->company_twitter,
                            "company_youtube"=> $check_in_usertble->company_youtube,
                            "company_skype" => $check_in_usertble->company_skype,
                            "avatar"=> $check_in_usertble->avatar,
                            "timezone"=> $check_in_usertble->timezone,
                            "date_format"=> $check_in_usertble->date_format,
                            "time_format"=> $check_in_usertble->time_format,
                            "language"=> $check_in_usertble->language,
                            "currency"=> $check_in_usertble->currency,
                            "country"=> $check_in_usertble->country,
                            "address_line_1"=> $check_in_usertble->address_line_1,
                            "address_line_2"=> $check_in_usertble->address_line_2,
                            "city"=> $check_in_usertble->city,
                            "state"=> $check_in_usertble->state,
                            "zip_code"=> $check_in_usertble->zip_code,
                            "role_ids"=> $check_in_usertble->role_ids,
                            "role_types"=> $get_role_type->name,
                            "status"=> $check_in_usertble->status,
                            "created_time"=> $check_in_usertble->created_time,
                            "update_time"=> $check_in_usertble->update_time,
                            "login_success_detail"=> $check_in_usertble->login_success_detail,
                            "company_number"=> $check_in_usertble->company_number,
                            "tax_number"=> $check_in_usertble->tax_number,
                            "otp"=> $check_in_usertble->otp,
                            "packages_id"=> $check_in_usertble->packages_id,
                            "packages_startDate"=> $check_in_usertble->packages_startDate,
                            "packages_endDate"=> $check_in_usertble->packages_endDate,
                            "website"=> $check_in_usertble->website,
                            "referral_code"=> $check_in_usertble->referral_code,
                            "login_type"=> $check_in_usertble->login_type,
                            "membership_type"=> ($check_in_usertble->membership_type == 3)?0:$check_in_usertble->membership_type,
                            "is_admin"=>empty($check_in_usertble->membership_type)?1:0,
                            "device_type"=> $check_in_usertble->device_type,
                            "device_token"=> $check_in_usertble->device_token,
                            "chat_id"=> $this->getfirebaseid($check_in_usertble->id),
                            "notification_count" => $this->app_get_notification_count($check_in_usertble->id)
                            
	                );
	                
	                
	                
	                
	                
	                
	                 $messagg=array("status"=>TRUE,"userdata"=>$data_user);
	            $log_detail = my_ua();
            my_log($check_in_usertble->ids, 'Information', 'signin-success', json_encode($log_detail));
	                return $messagg;
	                
	            }else{
	                
	                $messagg=array("status"=>FALSE);
	            
	                return $messagg;
	            }
	            
	            
	        }
	        else
	        {
	            
	            //IINSERT DATA 
	            
	            $user_status=1;
	            
	            $referral_array['src_from'] = '';
	            
	            $referral_array['referral_code'] = '';
	            
	            $user_ids = my_random();
	            
	        $user_array = array(
		    'ids' => $user_ids,
		    'username' => '',
		    'password' => '',
			'api_key' => my_random(),
			'balance' => '{"usd":0}',
		    'email_address' => '',
		    'email_verified' =>'',
			'email_address_pending' => '',
			'oauth_google_identifier' => '',
			'oauth_facebook_identifier' => '',
			'oauth_twitter_identifier' =>'' ,
			'signup_source' => 'api',
		    'first_name' => '',
		    'last_name' => '',
			'company' => '',
		    'avatar' => 'default.jpg',
		    'timezone' => $this->config->item('time_reference'),
			'date_format' => 'Y-m-d',
			'time_format' => 'H:i:s',
			'language' => '',
			'phone'=> $mobile,
			'phone_verified'=>1,
			'otp'=>$otp,
			'otp_verified'=>1,
			'country' => '',
			'currency' => 'USD',
			'address_line_1' => '',
			'address_line_2' => '',
			'city' => '',
			'state' => '',
			'zip_code' => '',
		    'role_ids' => $global_setting->default_role,
		    'status' => $user_status,
		    'created_time' => my_server_time(),
		    'update_time' => my_server_time(),
		    'login_success_detail' => '',
			'online' => 0,
			'online_time' => '',
			'new_notification' => 0,
			'referral' => json_encode($referral_array),
			'affiliate_enabled' => 0,
			'affiliate_code' => '',
			'affiliate_earning' => '{}',
			'affiliate_setting' => '',
			'login_type'=>'normal', 
			'device_type'=>$device_type,
			'device_token'=>$device_token
		  );
		  
		  $ressuu=$this->db->insert('user', $user_array);
    	  $insert_id = $this->db->insert_id();
	        if(isset($insert_id) && !empty($insert_id)){
	            
	             $check_in_usertble=$this->db->query("select * from user where id='".$insert_id."'")->row();
	       
	            $get_role_type = $this->db->select('name')->where('ids',$check_in_usertble->role_ids)->get('role')->row();
	                $get_area_name = $this->db->select('functional_area')->where('functional_area_id',$check_in_usertble->business_category)->get('tbl_functional_area')->row();
	                $get_turn_over= $this->db->select('turn_over_value')->where('turn_over_id',$check_in_usertble->turn_over)->get('turn_over')->row();
    	               
    	               
    	               $data_user = array(
    	                    "id"=> $check_in_usertble->id,
                            "ids"=> $check_in_usertble->ids,
                            "username"=> $check_in_usertble->username,
                            "api_key"=> $check_in_usertble->api_key,
                            "email_address"=> $check_in_usertble->email_address,
                            "signup_source"=> $check_in_usertble->signup_source,
                            "signup_socialid"=> $check_in_usertble->signup_socialid,
                            "prefix"=> $check_in_usertble->prefix,
                            "first_name"=> $check_in_usertble->first_name,
                            "middle_name"=> $check_in_usertble->middle_name,
                            "last_name"=> $check_in_usertble->last_name,
                            "gender"=> $check_in_usertble->gender,
                            "dob"=> $check_in_usertble->dob,
                            "blood_group"=> $check_in_usertble->blood_group,
                            "designation"=> $check_in_usertble->designation,
                            "wmobile"=> $check_in_usertble->wmobile,
                            "phone"=>  $check_in_usertble->phone,
                            "landline"=> $check_in_usertble->landline,
                            "company"=> $check_in_usertble->company,
                            "total_experience"=> $check_in_usertble->total_experience,
                            "company_address"=> $check_in_usertble->company_address,
                            "company_contact"=> $check_in_usertble->company_contact,
                            "about_company"=> $check_in_usertble->about_company,
                            "business_entity"=> $check_in_usertble->business_entity,
                            "business_category_id"=> $check_in_usertble->business_category,
                            "business_category_name"=> $get_area_name->functional_area,              
                            "business_experties"=> $check_in_usertble->business_experties,
                            "business_type"=> $check_in_usertble->business_type,
                            "working_from"=> $check_in_usertble->working_from,
                            "no_of_employees"=> $check_in_usertble->no_of_employees,
                            "turn_over"=> $check_in_usertble->turn_over,
                            "turn_over_value"=> $get_turn_over->turn_over_value,
                            "target_audiance"=> $check_in_usertble->target_audiance,
                            "company_profile"=> $check_in_usertble->company_profile,
                            "company_ppt"=> $check_in_usertble->company_ppt,
                            "vcard_front"=> $check_in_usertble->vcard_front,
                            "vcard_back"=> $check_in_usertble->vcard_back,
                            "company_google"=> $check_in_usertble->company_google,
                            "company_facebook"=> $check_in_usertble->company_facebook,
                            "company_linkedin"=> $check_in_usertble->company_linkedin,
                            "company_instagram"=> $check_in_usertble->company_instagram,
                            "company_twitter"=> $check_in_usertble->company_twitter,
                            "company_youtube"=> $check_in_usertble->company_youtube,
                            "company_skype" => $check_in_usertble->company_skype,
                            "avatar"=> $check_in_usertble->avatar,
                            "timezone"=> $check_in_usertble->timezone,
                            "date_format"=> $check_in_usertble->date_format,
                            "time_format"=> $check_in_usertble->time_format,
                            "language"=> $check_in_usertble->language,
                            "currency"=> $check_in_usertble->currency,
                            "country"=> $check_in_usertble->country,
                            "address_line_1"=> $check_in_usertble->address_line_1,
                            "address_line_2"=> $check_in_usertble->address_line_2,
                            "city"=> $check_in_usertble->city,
                            "state"=> $check_in_usertble->state,
                            "zip_code"=> $check_in_usertble->zip_code,
                            "role_ids"=> $check_in_usertble->role_ids,
                            "role_types"=> $get_role_type->name,
                            "status"=> $check_in_usertble->status,
                            "created_time"=> $check_in_usertble->created_time,
                            "update_time"=> $check_in_usertble->update_time,
                            "login_success_detail"=> $check_in_usertble->login_success_detail,
                            "company_number"=> $check_in_usertble->company_number,
                            "tax_number"=> $check_in_usertble->tax_number,
                            "otp"=> $check_in_usertble->otp,
                            "packages_id"=> $check_in_usertble->packages_id,
                            "packages_startDate"=> $check_in_usertble->packages_startDate,
                            "packages_endDate"=> $check_in_usertble->packages_endDate,
                            "website"=> $check_in_usertble->website,
                            "referral_code"=> $check_in_usertble->referral_code,
                            "login_type"=> $check_in_usertble->login_type,
                            "membership_type"=> ($check_in_usertble->membership_type == 3)?0:$check_in_usertble->membership_type,
                            "is_admin"=>empty($check_in_usertble->membership_type)?1:0,
                            "device_type"=> $check_in_usertble->device_type,
                            "device_token"=> $check_in_usertble->device_token,
                            "chat_id"=> $this->getfirebaseid($check_in_usertble->id),
                            "notification_count" => $this->app_get_notification_count($check_in_usertble->id)
	                );
	            $messagg=array("status"=>TRUE,"userdata"=>$data_user);
	            $log_detail = my_ua();
            my_log($check_in_usertble->ids, 'Information', 'signin-success', json_encode($log_detail));
	            return $messagg;
	            
	        }else{
	            
	             $messagg=array("status"=>FALSE);
	            
	            return $messagg;
	        }    
	            
	            
	            
	            
	        }
	        
	        
	    }else{
	        
	        $messagg=array("status"=>FALSE);
	            
	            return $messagg;
	        
	    }
	    
	    
	    
	    
	   /* $this->db->select('u.otp');
        $this->db->from('user as u');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
			if($rs->otp==$otp){
			    return TRUE;
			}else{
			    return FALSE;
			    
			}
		}
		else {
			return FALSE;
		}*/
	    
	}
	
	/*
	*   GET  APP USER ACCOUNTS DETAILS API 
	*
	*/
	public function get_app_user_account_details($userid,$userid1){
	    $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
                        if($userid != $userid1)
                        {
                        $useriddd=$this->db->query("select * from user where id='".$userid1."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$userid1,'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$userid1,'package_id'=>$useriddd->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $str = explode(',',$user_consumption->type_id);
                    if(!in_array($userid, $str))
                    {
                        $data['used_count'] = $user_consumption->used_count + 1;
                    }
                    if(empty($str))
                    {
                        $data['type_id'] = $userid;
                    }
                    else
                    {
                        if(!in_array($userid, $str))
                        {
                            $data['type_id'] = $user_consumption->type_id.",".$userid;
                        }
                    }
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
                        }
			return $rs;	
			
		}
		else {
			return FALSE;
		}
	    
	}
	public function get_app_user_account_details_fileds_builder($rs){
	    
	    $business_cat = $this->db->where('functional_area_id',$rs->business_category)->get('tbl_functional_area')->row();
	    
	    $get_connection_sent_request=$this->db->query("select * from connection where request_to='".$rs->id."'")->num_rows();
		$get_connection_receive_request=$this->db->query("select * from connection where request_from='".$rs->id."'")->num_rows();
	    
	    $total_buddies = $this->db->get_where('buddies',array('user_id'=>$rs->id))->num_rows();
	    
	    //$total_connection = $get_connection_sent_request + $get_connection_receive_request;
	    
	    $rewardpoint = $this->db->select('sum(point) as total_reward')->where('userid',$rs->id)->get('reward_user_point')->row();
	    
	    if(empty($rewardpoint->total_reward)){$rewardpoint = 0;}else{$rewardpoint =$rewardpoint->total_reward;}
	    if(empty($total_connection)){$total_connections = 0;}else{$total_connections =$total_connection;}
	    
	    
	    
	    //if($total_buddies != ){$total_connections = 0;}else{$total_connections =$total_connection;}
	    
	    //$rank = $this->db->select('SELECT  NTILE(4) OVER( ORDER BY sum(point)) AS NTILERank FROM reward_user_point')->row();
	    //echo $this->db->last_query();
	    
	    $rank = $this->app_find_my_rank_post($rs->id);
	    
	    if(empty($rank))
	    {
	       $ranks =  '0';
	    }
	    else
	    {
	       $ranks =  $rank; 
	    }
	    
	    
	    
	    
	    $usersid=$rs->id;
	    $getbatchesdata = $this->db->where('assign_userid',$usersid)->get('badge_assign')->row();
	    
	    if($getbatchesdata)
	    {
	       $badgesids =  $getbatchesdata->assign_badgeid;
	        $getbatchesdatas = $this->db->where('badge_id',$badgesids)->get('badge')->row();
	        
	    }
	    else
	    {
	       $getbatchesdatas = $this->db->where('badge_default','1')->get('badge')->row(); 
	    }
	    
	    
	    
	    return array(
		  
		    'userid'=>$rs->id,
		    'first_name'=>$rs->first_name,
		    'middle_name'=>$rs->middle_name,
		    'last_name'=>$rs->last_name,
		    'email'=>$rs->email_address,
		    'mobile'=>$rs->phone,
		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
		    'company_phone'=>$rs->company_contact,
		    'company_address'=>$rs->company_address,
		    'dob'=>$rs->dob,
		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
		    'referral_code'=>$rs->referral,
		    'total_experience'=>$rs->total_experience,
		    'business_type'=>$rs->business_type,
		    'business_category_name'=>$business_cat->functional_area,
		    'business_category_id'=>$rs->business_category,
		    'business_entity'=>$rs->business_entity,
		    'account_create'=>$rs->otp_verified,
		  	'reward_point'=>$rewardpoint,
		  	'rank'=>$ranks,
		  	'badge'=>"0",
		  	'connection'=>$total_buddies,
		  	'chat_id'=> $this->getfirebaseid($rs->id),
		  	'badge_title'=>$getbatchesdatas->badge_title,
		    'badge_image'=>base_url().$getbatchesdatas->badge_image,
		    'membership_type'=>$rs->membership_type,
                    'share_url'=> str_replace('admin/','',base_url('profile/'.$rs->phone)),
                    'whatsapp_no'=>$rs->wmobile,
                       'company_whatsapp_no'=>$rs->company_wmobile,
		);
	}
	
//	function get_tiny_url($url)  {  
//        $ch = curl_init();  
//        $timeout = 5;  
//        curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
//        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
//        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
//        $data = curl_exec($ch);  
//        curl_close($ch);  
//        return $data;  
//    }
	public function app_find_my_rank_post($user_id){
        $obj = array();
        
//	    $rank = $this->db->query("SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
//                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC")->result();
	    
	    //$user_id = '124';
	    
//	    foreach($rank as $userrank)
//	    {
//	       
//	       if($userrank->userid == $user_id)
//	       {
//	           return $userrank->rank;
//	       }
	       
	        /*$data_array[] = array(
	            'usersid'=>$userrank->userid,
	            'point'=>$userrank->sumtotal,
	            'rank'=>$userrank->rank,
	            );*/
//	    }
	    return 0;
	    
    }
	
	public function get_my_award__recognition($userid){
	    
                 $this->db->join('rewards','rewards.rewards_id = user_reward.reward_rewardsid','INNER');
	    $query = $this->db->order_by('reward_id','DESC')->where('reward_userdid',$userid)->get('user_reward');
        if ($query->num_rows()) {
			$rs = $query->result();
				
				foreach($rs as $valdata)
				{
				    $startdate =  date('Y-m-d', strtotime($valdata->reward_startdate));
				    $enddate =  date('Y-m-d', strtotime($valdata->reward_enddate));
				    
				   $today_dates = date('Y-m-d');
				   
				   if($startdate > $today_dates )                 
				   {
				       $status = "Pending";
				   }  
				   else if($enddate < $today_dates)
				   {
				      $status = "Experied"; 
				   }
				   else
				   {
				      $status = "Availed";  
				   }
				    
				    $data_array[]=array(
				        "rewardtitle"=>$valdata->rewards_title,
				        "rewarddescription"=>$valdata->rewards_description,
				        "rewardfrom"=>$valdata->reward_startdate,
				        "rewardto"=>$valdata->reward_enddate,
				        "rewardstatus"=>$status,
				        "rewardthumbnil"=>base_url().$valdata->reward_thumbnil,
				        );
				}
				
				
				return $data_array;
		}
		else {
			return FALSE;
		}
	    
	}
	
	
	/*
	*   GET  ALL PLAN DETAILS API 
	*
	*/
	
	public function get_all_plan_details(){
	    
        $query = $this->db->order_by('seq_no','asc')->get('packages');
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_get_all_plan_details_fileds_builder($rs){
	    
	    /*'message' => array()*/
	    
	    foreach($rs as $val)
	    {
	    $result_data[] = array(
		    
		    'membership_id'=>$val->pack_id,
		    'membership_title'=>$val->pack_name,
		    'membership_benifits'=>$val->pack_desc,
		    'membership_cost'=>$val->pack_price,
                'membership_type'=>$val->pack_type,
                'membership_type_name'=>(!empty($val->pack_type))?($val->pack_type == 1)?"Guest":"Paid":"-",
		     'membership_duration'=>$val->pack_duration,
		    'membership_features'=>$this->get_pack_fetures($val->pack_fet,$val->pack_id),
		    'membership_seq_no'=>$val->seq_no
		  	  
		);
	    }
	    
	    return $result_data;
	    
	}
	
	/*
	*   GET  APP USER MEMBERSHIP DETAILS API 
	*
	*/
	
	public function get_app_user_membership_detailsold($userid){
	    $this->db->select('p.pack_id,p.pack_name,p.pack_desc,p.pack_price,p.pack_fet,u.packages_startDate,u.packages_endDate,u.membership_type');
        $this->db->from('user as u');
        $this->db->join('packages as p', 'p.pack_id = u.packages_id');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
				return $rs;
			
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_user_membership_details($userid){
	    //$this->db->select('p.pack_id,p.pack_name,p.pack_desc,p.pack_price,p.pack_fet,u.packages_startDate,u.packages_endDate,u.membership_type');
        $this->db->from('user as u');
        //$this->db->join('packages as p', 'p.pack_id = u.packages_id');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
				return $rs;
			
		}
		else {
			return FALSE;
		}
	    
	}
	
	
	
	
	public function get_app_user_membership_details_fileds_builder($rs,$userid){
	    
	  
	 // print_r($rs);exit();
	 
	
	 
	 
//	 if($rs->membership_type == '2')
//	 {
	    
	    $getplandata = $this->db->where(array('pack_id'=>$rs->packages_id))->get('packages')->row();
	    
	    
	    if($rs->packages_startDate != '')
	    {
	        $stdate = date('Y-m-d',$rs->packages_startDate);
	    }
	    else
	    {
	        $stdate = '-';
	    }
	    
	    if($rs->packages_endDate != '')
	    {
	        $eddate = date('Y-m-d',$rs->packages_endDate);
	    }
	    else
	    {
	        $eddate = '-';
	    }
	    
	    $pack_id = $rs->packages_id;
	    $pack_title = $getplandata->pack_name;
	    $pack_benifits = $getplandata->pack_desc;
	    $pack_cost = $getplandata->pack_price;
	    $pack_feature = $this->get_pack_fetures($getplandata->pack_fet,$rs->packages_id);
	    
	    $check_plan = $this->db->get_where('user_package_purchase',array('user_id'=>$userid,'plan_status'=>'Upcoming'))->num_rows();
	     //echo $check_plan; echo $this->db->last_query();
	     
	     if($check_plan == '0')
	     {
	         $plan_queue = 'No';
	     }
	     else
	     {
	         $plan_queue = 'Yes';
	     }
	    
	    
	    
//	 }
//	 else
//	 {
//	     $pack_id = '0';
//	     $pack_title = 'Guest Member';
//	     $pack_benifits = '-';
//	     $pack_cost = '-';
//	     $pack_feature = array();
//	     $stdate = '-';
//	     $eddate = '-';
//	     
//	     $plan_queue = 'No';
//	     
//	     
//	     
//	 }
	    
	    $data_array = array(
	        'membership_id'=>$pack_id,
	        'membership_type'=>$rs->membership_type,
		    'membership_title'=>$pack_title,
		    'membership_start_date'=>$stdate,
		    'membership_end_date'=>$eddate,
		    'membership_benifits'=>$pack_benifits,
		    'membership_cost'=>$pack_cost,
		    'membership_features'=>$pack_feature,
		    'membership_renewed'=>$plan_queue,
                'membership_seq_no'=>$getplandata->seq_no,
                'referral_code'=>$rs->referral_code,
                'first_name'=>$rs->first_name,
		    'middle_name'=>$rs->middle_name,
		    'last_name'=>$rs->last_name,
		    'email'=>$rs->email_address,
		    'mobile'=>$rs->phone,
		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
		    'company_phone'=>$rs->company_contact,
		    'company_address'=>$rs->company_address
		    );
		    
		return $data_array;    
	    
	    /*return array(
		  'message' => array(
		    'membership_id'=>$rs->pack_id,
		    'membership_title'=>$rs->pack_name,
		    'membership_start_date'=>$stdate,
		    'membership_end_date'=>$eddate,
		    'membership_benifits'=>$rs->pack_desc,
		    'membership_cost'=>$rs->pack_price,
		    'membership_features'=>$this->get_pack_fetures($rs->pack_fet)
		    
		  )	  
		);*/
	    
	}
	
	
	public function get_all_functional_area()
	{
	    $qry=$this->db->where('status','1')->get('tbl_functional_area')->result();
	    if(isset($qry) && !empty($qry)){
	        
	        $result=array("status"=>TRUE,'data'=>$qry);
	        
	        
	    }else{
	       $result=array("status"=>FALSE,'data'=>"");
	    }
	    
	    return $result;
	    
	    
	    
	    
	   
	}
	
	public function get_all_functional_area_fileds_builder($rs)
	{
	    $data_array = array(
	        'area_id'=>$rs->functional_area_id,
		    'area'=>$rs->functional_area,
		    
		    );
		    
		return $data_array;  
	}
	
	
	
	
	public function get_pack_fetures($feat_id=null,$package_id){
	    $qrrres = array();
	   // if($feat_id==null){
	   //     return $qrrres;
	   // }else{
	       //$feat_idex=explode("/",$feat_id);   
	       
	       //foreach($feat_idex as $val_index)
    	   //{
    	   //    $rslt_data[] = $val_index;
    	   //}
	     // $data_merg = implode(" , ",$rslt_data);
	      
	     //  echo $data_merg;
	       
	       //$feat_idex_implode=implode(",",$feat_idex);     $qrrres=$this->db->query("select fet_name as features from features where fet_id in(".$feat_idex_implode.")")->result();
	       
	       $get_data = $this->db->query("select fet_name as features,fet_id as featureid,fet_description from features ")->result();   //where fet_id in(".$val_result.")
	       
	       foreach($get_data as $val_result)
	       {   
	           // if(in_array($val_result->featureid,$feat_idex))
            //     {
            //       $feature_available = 'Yes';
            //     }
            //     else
            //     {
            //       $feature_available = 'No';
            //     }
	           $pf_info = $this->db->where(array('package_id'=>$package_id,'feature_id'=>$val_result->featureid))->get('package_features')->row();
//	           $features = $val_result->features;
                $desc = $val_result->fet_description;
                if(empty($pf_info->count_allowed))
                {
                    if($pf_info->is_allowed == 1)
                    {
                        $features = str_replace('{##var##}', 'Unlimited', $desc);
                        $features1 = $val_result->features;
                        $count = "Unlimited";
                    }
                    else
                    {
                        $features = $val_result->features;
                        $features1 = $val_result->features;
                        $count = "00";
                    }
                }
                else
                {
                   $features = str_replace('{##var##}', $pf_info->count_allowed, $desc);
                   $features1 = $val_result->features;
                //   if($pf_info->count_allowed < 10)
                //   {
                //         $count = "0".$pf_info->count_allowed;
                //   }
                //   else
                //   {
                       $count = $pf_info->count_allowed;
                //   }
                }
                if($pf_info->is_allowed == 1)
                {
                  $feature_available = 'Yes';
                }
                else
                {
                  $feature_available = 'No';
                }
	           $qrrres[] = array('FeaturesName'=>$features1,'FeaturesDesc'=>$features,'FeaturesAvilablity'=>$feature_available,'FeaturesCount'=>$count);
	           
	       }
	       
	        return $qrrres;
	   // }
	    
	}
	
	/*
	*   GET  APP USER UPDATE PROFILE
	*
	*/
	public function update_user_profile($user){
	    
	    $profile=array(
	            "company"=>$user['company_name'],
	            "company_address"=>$user['company_address'],
	            "country"=>$user['countryid'],
	            "state"=>$user['stateid'],
	            "city"=>$user['cityid'],
	            "zip_code"=>$user['pin_code'],
	            "about_company"=>$user['about_company'],
	            "business_entity"=>$user['business_entity'],
	            "business_type"=>$user['business_type'],
	            "working_from"=>$user['working_from'],
	            "no_of_employees"=>$user['no_of_employees'],
	            "turn_over"=>$user['turn_over'],
	            "target_audiance"=>$user['target_audiance'],
	            "company_profile"=>$user['company_profile'],
	            "company_ppt"=>$user['company_ppt'],
	            "vcard_front"=>$user['vcard_front'],
	            "vcard_back"=>$user['vcard_back'],
	            "company_facebook"=>$user['company_facebook'],
	            "company_linkedin"=>$user['company_linkedin'],
	            "company_instagram"=>$user['company_instagram'],
	            "company_twitter"=>$user['company_twitter'],
	            "company_youtube"=>$user['company_youtube'],
	            "company_skype"=>$user['company_skype']
	        
	        );
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	    
	}
	
	/*
	*   GET  APP USER VIEW PROFILE
	*
	*/
	
	public function get_app_user_view_profile($userid){
	   
	   $get_data = $this->db->where('id',$userid)->get('user')->row();
	   
	   if(!empty($get_data))
	   {
	        if($get_data->packages_id == '0')
	        {
	            $this->db->select('u.*');
                $this->db->from('user as u');
                //$this->db->join('packages as p', 'p.pack_id = u.packages_id','INNER');
                $this->db->where('u.id', $userid);
                $query = $this->db->get();   
	        }
	        else
	        {
	            $this->db->select('u.*,p.pack_name');
                $this->db->from('user as u');
                $this->db->join('packages as p', 'p.pack_id = u.packages_id','INNER');
                $this->db->where('u.id', $userid);
                $query = $this->db->get(); 
	        }
	        
	        
	        
            if ($query->num_rows())
            {
    			$rs = $query->row();
    		    return $rs;
    			
    		}
    		else {
    			return FALSE;
    		}
	   }
	   else
	   {
	       
	   }
	    
	}
	
	
	public function app_get_batches_detail($userid){
	    
	    $getdata = $this->db->get('batches')->row();
	    
	    $result_data[] = array(
		  
		    'batches_title'=>$getdata->batches_title,
		    'batches_image'=>base_url().'upload/batches/'.$getdata->batches_images,
		    
		    
		  	  
		);
	    /*
	    foreach($rs as $val)
	    {
	    $result_data[] = array(
		  
		    'batches_title'=>$val->pack_id,
		    'batches_image'=>$val->pack_name,
		    
		    
		  	  
		);
	    }*/
	    
	    return $result_data;
	    
	}
	
	
	
	
	public function get_app_user_view_profile_contact($userid){
	    $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
				return $rs;
			
		}
		else {
			return FALSE;
		}
	}
	
	public function get_app_user_view_profile_fileds_builder($rs){
	    return array(
		  'message' => array(
		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
		    'company_address'=>$rs->company_address,
		    'countryid'=>$rs->country,
		    'stateid'=>$rs->state,
		    'cityid'=>$rs->city,
		    'pin_code'=>$rs->zip_code,
		    'about_company'=>$rs->about_company,
		    'business_entity'=>$rs->business_entity,
		    'business_type'=>$rs->business_type,
		    'working_from'=>$rs->working_from,
		    'no_of_employees'=>$rs->no_of_employees,
		    'turn_over'=>$rs->turn_over,
		    'target_audiance'=>$rs->target_audiance,
		    'membership_title'=>$rs->pack_name,
		    'company_profile'=>$rs->company_profile,
		    'company_ppt'=>$rs->company_ppt,
		    'vcard_front'=>$rs->vcard_front,
		    'vcard_back'=>$rs->vcard_back,
		    'company_facebook'=>$rs->company_facebook,
		    'company_linkedin'=>$rs->company_linkedin,
		    'company_instagram'=>$rs->company_instagram,
		    'company_twitter'=>$rs->company_twitter,
		    'company_youtube'=>$rs->company_youtube,
		    'company_skype'=>$rs->company_skype,
		    'chat_id'=> $this->getfirebaseid($rs->id),
		  )	  
		);
	    
	}
	
	/*
	*   GET  APP USER GET SUBSCRIBER
	*
	*/
		public function get_app_get_subscribe($userid){
	    $this->db->select('u.*'); //,p.*');
        $this->db->from('user as u');
        //$this->db->join('packages as p', 'p.pack_id = u.packages_id');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
				return $rs;
			
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_get_subscribe_fileds_builder($rs){
	    
	    if($rs->packages_id != '0' OR $rs->packages_id != '')
	    {
	        $stdate = '';
	        $eddate = '';
	        $pack_title = 'Guest Member';
	        $pack_desc = '';
	        $pack_fet = 0;
	        $pack_amount = '';
	        $pack_duration = '';
	        $pack_id = 0;
	    }
	    else
	    {
	        $pack_title = $rs->pack_name;
	        $pack_desc = $rs->pack_desc;
	        $pack_fet = $rs->pack_fet;
	        $pack_amount = $rs->pack_price;
	        $pack_duration = $rs->pack_duration;
	        $pack_id =$rs->pack_id;
	    }
	    /*
	    $getplan = $this->db->where('',packages)
	    
	    if($rs->packages_startDate != '')
	    {
	        $stdate = date('Y-m-d',$rs->packages_startDate);
	    }
	    else
	    {
	        $stdate = '-';
	    }
	    
	    if($rs->packages_endDate != '')
	    {
	        $eddate = date('Y-m-d',$rs->packages_endDate);
	    }
	    else
	    {
	        $eddate = '-';
	    }*/
	    
	    
	    $data_array = array(
	        'membership_id'=>$pack_id,
		    'membership_title'=>$pack_title,
		    'membership_start_date'=>$stdate,
		    'membership_end_date'=>$eddate,
		    'membership_benifits'=>$pack_desc,
		    'membership_cost'=>$pack_amount,
		    'membership_duration'=>$pack_duration,
		    'membership_features'=>$this->get_pack_fetures($pack_fet)
		    );
		    
		return $data_array; 
	    
	    
	    
	    
	    
	}
	
	public function get_app_get_subscribe_fileds_builderold($rs){
	    
	    
	    /*
	    $get_plandata = $this->db->where('pack_id',$rs->packages_id)->get('packages')->row();
	    $get_purchaseplandata = $this->db->where('plan_id',$rs->packages_id)->where('plan_status','Active')->get('user_package_purchase')->row();
	    
	    if($get_purchaseplandata->plan_startdate != '')
	    {
	        $stdate = date('Y-m-d',$get_purchaseplandata->plan_startdate);
	    }
	    else
	    {
	        $stdate = '-';
	    }
	    
	    if($get_purchaseplandata->plan_enddate != '')
	    {
	        $eddate = date('Y-m-d',$get_purchaseplandata->plan_enddate);
	    }
	    else
	    {
	        $eddate = '-';
	    }
	    */
	    
	    
	    if($rs->packages_startDate != '')
	    {
	        $stdate = date('Y-m-d',$rs->packages_startDate);
	    }
	    else
	    {
	        $stdate = '-';
	    }
	    
	    if($rs->packages_endDate != '')
	    {
	        $eddate = date('Y-m-d',$rs->packages_endDate);
	    }
	    else
	    {
	        $eddate = '-';
	    }
	    
	    
	    $data_array = array(
	        'membership_id'=>$rs->pack_id,
		    'membership_title'=>$rs->pack_name,
		    'membership_start_date'=>$stdate,
		    'membership_end_date'=>$eddate,
		    'membership_benifits'=>$rs->pack_desc,
		    'membership_cost'=>$rs->pack_price,
		    'membership_duration'=>$rs->pack_duration,
		    'membership_features'=>$this->get_pack_fetures($rs->pack_fet)
		    );
		    
		return $data_array; 
	    
	    
	    
	    
	    
	}
	
	/*
	*   GET  APP USER GET UPGRADE MEMBERSHIP
	*
	*/
	
	
	public function get_app_get_renew_membership_update($user){
	    
	         $stdate = $user['startdate'];
	         $todaydates = date('Y-m-d');
	         
	         
	         
	         $todaydate = strtotime($stdate);
             $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['membership_id']))->row_array();    
             $duration = $get_packages['pack_duration'];
             $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
	                
	         if(strtotime($stdate) >= strtotime($todaydates))
	         {
	               $pur_array = array(
	                'user_id'=>$user['userid'],
	                'plan_id'=>$user['membership_id'],
//	                'plan_startdate'=>$stdate,
//	                'plan_enddate'=>$eddate,
	                'plan_status'=>'Upcoming'
	                );
	                $this->db->insert('user_package_purchase',$pur_array);   //print_r($pur_array);
	            if($get_packages['pack_type'] == 2)
                    {
	            $trans_detail = array(
	                'trans_userid'=>$user['userid'],
	                'trans_paymentids'=>$user['transactionid'],
	                'trans_paymenttype'=>$user['transationpaymenttype'],
	                'trans_amount'=>$user['transationamount'],
	                'trans_datetime'=>date('Y-m-d H:i:s',strtotime($user['transationdatetime'])),
	                'trans_for'=>'Upgrade Membership Payment'
	                );
	            $this->db->insert('transactions',$trans_detail);
                    }
	            return TRUE;
	            
	            
	         }
	         else{
	            return FALSE;
	            
	        }
	          
	        
	    
	}
	
	
	public function get_app_get_upgrade_membership_update($user){
	    
	         $stdate = date('Y-m-d');
	         $todaydate = strtotime($stdate);
             
             $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['membership_id']))->row_array();    
             $duration = $get_packages['pack_duration'];
             $stringpackdate = strtotime($packeddate);
	         
	         
	         $getpackagedata = $getuserdata = $this->db->get_where('user',array('id'=>$user['userid']))->row_array();  
	         
	         if($getpackagedata['packages_endDate'] != '')
	         {
	            $days_left = ($getpackagedata['packages_endDate'] - $todaydate);   
                $daysremain = round($days_left / (60 * 60 * 24));
             
             
                $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['membership_id']))->row_array();    
                $duration = $get_packages['pack_duration'];
                $eddates = date("Y-m-d", strtotime("+$duration month", $todaydate));  
                $eddate = date("Y-m-d", strtotime("+$daysremain day", strtotime($eddates)));  //echo $eddate; exit();
	         }
	         
             else
             {
                 $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['membership_id']))->row_array();    
                 $duration = $get_packages['pack_duration'];
                 $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
             }
	                
	         
	          
	                
	                $membership=array(
	                    "packages_id"=>$user['membership_id'],
	                    "packages_startDate"=> strtotime($stdate),
	                    "packages_endDate"=> strtotime($eddate),
	                     "membership_type"=>'2'
	                    );
	                $this->db->where(array('id'=>$user['userid']));
	                $res=$this->db->update('user',$membership);
	        
	        
	        if($res==TRUE){
	            $act_package = $this->db->get_where('user_package_purchase',array('user_id'=>$user['userid'],'plan_status'=>'Active'))->row();
                    $get_packages = $this->db->get_where('user_package_purchase',array('user_id'=>$user['userid']))->result();
	            foreach($get_packages as $valpackages)
	            {
                        if($valpackages->plan_status == "Active" || $valpackages->plan_status == "Upcoming")
                        {
                            $this->db->set('plan_status','Inactive');
                            $this->db->where('pur_id',$valpackages->pur_id);
                            $this->db->update('user_package_purchase');
                        }
	            }
                    $pur_array = array(
	                'user_id'=>$user['userid'],
	                'plan_id'=>$user['membership_id'],
	                'plan_startdate'=>$stdate,
	                'plan_enddate'=>$eddate,
	                'plan_status'=>'Active'
	                );
	                $this->db->insert('user_package_purchase',$pur_array);
                        $ppid = $this->db->insert_id();
                    $user_package = $this->db->get_where('user_package_features',array('user_id'=>$user['userid'],'package_purchase_id'=>$act_package->pur_id))->result();
                    if(!empty($user_package))
                    {
                        foreach($user_package as $val)
                        {
                            $pur_array1 = array(
	                'package_purchase_id'=>$ppid,
	                'package_id'=>$user['membership_id'],
	                'feature_id'=>$val->feature_id,
	                'user_id'=>$user['userid'],
	                'used_count'=>$val->used_count,
                        'type_id'=>  $val->type_id      
	                );
	                $this->db->insert('user_package_features',$pur_array1);
                        }
                    }
                    
	            
	            
	            
	            
	            
	               //print_r($pur_array);
	            
	            $trans_detail = array(
	                'trans_userid'=>$user['userid'],
	                'trans_paymentids'=>$user['transactionid'],
	                'trans_paymenttype'=>$user['transationpaymenttype'],
	                'trans_amount'=>$user['transationamount'],
	                'trans_datetime'=>date('Y-m-d H:i:s',strtotime($user['transationdatetime'])),
	                'trans_for'=>'Upgrade Membership Payment'
	                );
	            $this->db->insert('transactions',$trans_detail);
	            
	            
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	/*
	*   GET  APP USER BASIC INFO
	*
	*/
	public function get_app_user_basicinfo_view($userid){
	    $this->db->select('u.*');
        $this->db->from('user as u');
        $this->db->where('u.id', $userid);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
			return $rs;	
			
		}
		else {
			return FALSE;
		}
	}
	
	public function get_app_user_basicinfo_view_fileds_builder($rs){
	    
	    return array(
		  'message' => array(
		    'userid'=>$rs->id,
		    'prefix'=>$rs->prefix,
		    'fname'=>$rs->first_name,
		    'mname'=>$rs->middle_name,
		    'lname'=>$rs->last_name,
		    'gender'=>$rs->gender,
		    'dob'=>$rs->dob,
		    'blood_group'=>$rs->blood_group,
		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
		    'profile_pic'=>base_url()."upload/avatar/".$rs->avatar,
		    'email'=>$rs->email_address,
		    'mobile'=>$rs->phone,
		    'address'=>$rs->address_line_1.",".$rs->address_line_2,
		    'countryid'=>$rs->country,
		    'stateid'=>$rs->state,
		    'cityid'=>$rs->city,
		    'pin_code'=>$rs->zip_code,
		    'wmobile'=>$rs->wmobile,
		    'landline'=>$rs->landline,
		    
		  )	  
		);
	    
	    
	}
	
	/*
	*   GET  APP USER EDIT PROFILE PICTURE INFO
	*
	*/
	
	public function update_user_edit_profile_pic($user,$avatar_file){
	    $profilepic=array(
	            "avatar"=>$avatar_file,
	            
	        );
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profilepic);
	        if($res==TRUE){
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	
	
	/*
	*   GET  APP USER UPDATE PROFILE BASIC PART 1
	*
	*/
	public function update_user_profile_basic_part1($user){
	    
	    $profile=array(
	            "first_name"=>$user['fname'],
	            "middle_name"=>$user['mname'],
	            "last_name"=>$user['lname'],
	            "gender"=>$user['gender'],
	            "dob"=>$user['dob'],
	            "blood_group"=>$user['blood_group'],
	            "designation"=>$user['designation']
	        );
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	    
	}
	
	public function app_delete_account($userid)
	{
	    $query = $this->db->set('user_delete','2')->where('id',$userid)->update('user');
	    if($query)
	    {
                $info = $this->db->where('id',$userid)->get('user')->row();
                 $log_detail = my_ua();
		  my_log($info->ids, 'Warning', 'user-deactivate', json_encode($log_detail));
	       return TRUE; 
	    }
	    else
	    {
	       return FALSE; 
	    }
	}
	
	
	
	public function update_user_profile_basic_part2($user){
	    
	    $profile=array(
	            "email_address"=>$user['email'],
	            "phone"=>$user['mobile'],
	            "address_line_1"=>$user['address1'],
	            "address_line_2"=>$user['address2'],
	            "country"=>$user['countryid'],
	            "city"=>$user['cityid'],
	            "state"=>$user['stateid'],
	            "wmobile"=>$user['wmobile'],
	            "landline"=>$user['landline'],
	            "zip_code"=>$user['pin_code']
	        );
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	public function save_user_mobile($global_setting, $source = 'web', $mobile){
	    //check mobile number exist or not 
	    $res=$this->db->query("select * from user where phone='".$mobile."' ")->result();   //AND user_delete='1'
	    if(isset($res) && !empty($res)){
	        //update otp 
	        
	        //update login type
	        //$this->db->where(array('phone'=>$mobile));
	        //$this->db->update('user',array('login_type'=>2));
//	        $package_info1 = $this->db->where(array('user_id'=>$res[0]->id))->get('user_package_purchase')->result();
//	        
//	        $package_info = $this->db->where(array('user_id'=>$res[0]->id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
//	        $dt = date('Y-m-d');
//	        if((!empty($package_info1)) && (empty($package_info) || (!empty($package_info) && $dt>$package_info->plan_enddate)))
//	        {
//	            return array(
//        		  'message' => array(
//        		    'otp'=>'0',
//        		    'login_type'=>'',
//        		    'message'=>'Plan Expired',
//        		    'result'=>FALSE,
//        		    'mobile'=>'',
//        		    'userid'=>'',
//        		    'membership_type'=>0
//        		  )	  
//        		);
//	        }
                if($res->user_delete == 2)
                {
                    return array(
        		  'message' => array(
        		    'otp'=>'0',
        		    'login_type'=>'',
        		    'message'=>'Account Deactivated',
        		    'result'=>FALSE,
        		    'mobile'=>'',
        		    'userid'=>'',
        		    'membership_type'=>0
        		  )	  
        		);
                }
	        else
	        {
	            if($mobile == "9049718692")
	            {
	                $otp="1635";
	            }
	            else
	            {
	                $otp=rand(1111,9874);
	            }
	           // echo $otp;die;
	         //get otpp
	         $this->db->where(array('phone'=>$mobile));
	        $q = $this->db->update('user',array('otp'=>$otp));
	         
	         
	         $this->db->where(array('phone'=>$mobile));
	         $q1 = $this->db->update('user_temp',array('otp'=>$otp));
	         
	         $otp_mob=$this->db->query("select * from user_temp where phone='".$mobile."'")->result();
	         
	        
            
             if(isset($otp_mob) && !empty($otp_mob)){
                
                $this->send_otp_for_vrify($mobile,$otp_mob[0]->otp); 
                 return array(
        		  'message' => array(
        		    'userid'=>$res[0]->id,
        		    'mobile'=>$mobile,
        		    'otp'=>$otp_mob[0]->otp,
        		    'login_type'=>'normal',
        		    'result'=>'TRUE',
        		    //'user_data'=>$res[0],
        		    'message'=>'Otp sent successfully to your mobile number',
        		    'membership_type'=>0
        		  )	  
        		);
        		
             }else{
                 if($mobile == "9049718692")
	            {
	                $otp="1635";
	            }
	            else
	            {
                $otp=rand(1111,9874); 
	            }
                  $user_array = array(
        		    'phone'=>$mobile,
        			'otp'=>$otp
        	   );
		  
    		  $ressuu=$this->db->insert('user_temp', $user_array);
    		  $insert_id = $this->db->insert_id();
    		  
    		  if(isset($insert_id) && !empty($insert_id)){
    		      
    		      $get_users_data = $this->db->where(array('phone',$mobile))->get('user')->row();
    		      $getusername = $this->getusernames($get_users_data->id);
	              // $getrewardusername = $this->getusernames($user['userid']);
    		     
    		      $get_guest_check = $this->db->get_where('event_invite',array('event_invite_type'=>'2','event_invite_mobileno'=>$mobile));
    		      //echo $this->db->last_query();
    		      if($get_guest_check->num_rows() != '0')
    		      {
    		        $reqqs = $get_guest_check->row_array();
    		        $currentdate = date('d M Y'); 
    		        $currenttime =  date('g:i A'); 
    		        $getusername = $this->getusernames($get_users_data->id);
	              // $getrewardusername = $this->getusernames($user['userid']);
    		        
    		        
//    		        $this->add_reward_point('GuestBecomeMember',$reqqs['event_invite_byuserid'],$currentdate,$currenttime,$getusername);  
    		      }
    		     
    		      
    		      
    		       /*// *** log started
    		  $log_detail = my_ua() + array('mobile' => $mobile, 'user_status' => $user_status);
    		  my_log($user_ids, 'Information', 'signup-success', json_encode($log_detail));*/
    	       /*return array(
        		  'message' => array(
        		    'otp'=>$otp,
        		    'login_type'=>'normal',
        		    'message'=>'Otp sent successfully to your mobile number',
        		    'result'=>TRUE,
        		    'mobile'=>$mobile,
        		    'user_data'=>$res[0],
        		    'membership_type'=>0
        		    //'userid'=>$res[0]->id,
        		    
        		    
        		    
        		  )	  
        		);*/
    		      
    		  }else{
    		      
    		 
    	        return array(
        		  'message' => array(
        		    'otp'=>$otp,
        		    'login_type'=>'normal',
        		    'message'=>'Otp not sent',
        		    'result'=>TRUE,
        		    'mobile'=>$mobile,
        		    'membership_type'=>0
        		    
        		    
        		  )	  
        		);
    		      
    		  }
                 
                 
                 
             }
             
	        } 
             
             
	    }
	    else
	    {
	        //user inserrt
	        if($mobile == "9049718692")
	            {
	                $otp="1635";
	            }
	            else
	            {
	         $otp=rand(1111,9874);
	            }
		  //check user is exist or not 
		  
		  $checkmobile=$this->db->query("select * from user_temp where phone='".$mobile."'")->result();
		  
		  if(isset($checkmobile) && !empty($checkmobile)){
		      
		      $user_array = array(
        		    
        			'otp'=>$otp
        	   );
		      
		              $this->db->where(array('phone'=>$mobile,'id'=>$checkmobile[0]->id));
		      $ressuu=$this->db->update('user_temp', $user_array);
		      $this->send_otp_for_vrify($mobile,$otp);
		      return array(
        		  'message' => array(
        		    'otp'=>$otp,
        		    'login_type'=>'normal',
        		    'message'=>'Otp sent successfully to your mobile number',
        		    'result'=>TRUE,
        		    'mobile'=>$mobile,
        		    'userid'=>$checkmobile[0]->id,
        		    'membership_type'=>0
        		  )	  
        		);
		      
		      
		  }
		  else
		  {
		      
		      
		      $user_array = array(
        		    'phone'=>$mobile,
        			'otp'=>$otp
        	   );
		  
    		  $ressuu=$this->db->insert('user_temp', $user_array);
    		  $insert_id = $this->db->insert_id();
    		  if(isset($insert_id) && !empty($insert_id)){
    		      
    		      $get_guest_check = $this->db->get_where('event_invite',array('event_invite_type'=>'2','event_invite_mobileno'=>$mobile));
    		      //echo $this->db->last_query();
    		      if($get_guest_check->num_rows() != '0')
    		      {
    		        $reqqs = $get_guest_check->row_array();
    		        $currentdate = date('d M Y'); 
    		        $currenttime =  date('g:i A'); 
    		        
    		        $get_users_data = $this->db->where(array('phone',$mobile))->get('user')->row();
    		        $getusername = $this->getusernames($get_users_data->id);
	                // $getrewardusername = $this->getusernames($user['userid']);
    		        
    		        
//    		        $this->add_reward_point('GuestBecomeMember',$reqqs['event_invite_byuserid'],$currentdate,$currenttime,$get_users_data);  
    		      }
    		      
    		      
    		       // *** log started
    		  //$log_detail = my_ua() + array('mobile' => $mobile, 'user_status' => $user_status);
    		  //my_log($user_ids, 'Information', 'signup-success', json_encode($log_detail));*/
    	       
    	       $this->send_otp_for_vrify($mobile,$otp);
    	       return array(
        		  'message' => array(
        		    'otp'=>$otp,
        		    'login_type'=>'normal',
        		    'message'=>'Otp sent successfully to your mobile number',
        		    'result'=>TRUE,
        		    'mobile'=>$mobile,
        		    'userid'=>$insert_id,
        		    'membership_type'=>0
        		    
        		    
        		    
        		  )	  
        		);
    		      
    		  }else{
    		      
    		 
    	        return array(
        		  'message' => array(
        		    'otp'=>$otp,
        		    'login_type'=>'normal',
        		    'message'=>'Otp not sent',
        		    'result'=>TRUE,
        		    'mobile'=>$mobile,
        		    'membership_type'=>0
        		    
        		  )	  
        		);
    		      
    		  }
		  
		  }
		  
		 
	        
	    }
	    
	}
	
	public function update_app_user_edit_profile_about($user){
	    
	    if ($_FILES['company_profile']['name'] != '')
		{
           
           $avatar_file = $user['userid'].'.'.pathinfo($_FILES['company_profile']['name'], PATHINFO_EXTENSION);
           
           
           $config = array();
           $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
           $config['allowed_types'] = '*'; //'gif|jpg|png|pdf';
           $config['encrypt_name']  = TRUE;
           $config['file_name'] = $avatar_file;
           $this->load->library('upload',$config);
           $this->upload->do_upload('company_profile');
           $upload_data = $this->upload->data();
           $pdffilename = $upload_data['file_name'];
           $profile = array("company_profile" => $pdffilename);
           $this->db->where(array('id'=>$user['userid']));
	       $this->db->update('user',$profile);
          
        } 
        
        
		if ($_FILES['company_ppt']['name'] != '')
		{
           
           $avatar_file_pdf = $user['userid'].'.'.pathinfo($_FILES['company_ppt']['name'], PATHINFO_EXTENSION);
           
           $config = array();
           $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
           $config['allowed_types'] = '*'; //'gif|jpg|png|pdf|ppt';
           $config['encrypt_name']  = TRUE;
           $config['file_name'] = $avatar_file_pdf;
           $this->load->library('upload',$config);
           $this->upload->do_upload('company_ppt');
           $upload_data = $this->upload->data();
           $pptfilename = $upload_data['file_name'];
           $profile = array("company_ppt" => $pptfilename);
           $this->db->where(array('id'=>$user['userid']));
	       $this->db->update('user',$profile);
          
        } 	
        
        	
	    
	   
	    
	    $profile=array(
	            "company"=>$user['company_name'],
	            "about_company"=>$user['about_company'],
	            "business_entity"=>$user['business_entity'],
	            "business_type"=>$user['business_type'],
	            "business_experties"=>$user['business_experties'],
	            "working_from"=>$user['working_from'],
	            "no_of_employees"=>$user['no_of_employees'],
	            "turn_over"=>$user['expected_turnover'],
	            "target_audiance"=>$user['target_audiance'],
	            
	            
	        );
	        
	        
	        // print_r($profile);exit();
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	public function update_app_user_edit_profile_contact($user){
	    //$profile = array();
	    	
        
        if ($_FILES['vcard_front']['name'] != '')
		{
           
           $avatar_file_vcard = $user['userid'].'.'.pathinfo($_FILES['vcard_front']['name'], PATHINFO_EXTENSION);  
           
           $config = array();
           $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
           $config['allowed_types'] = '*'; //'gif|jpg|png';
           $config['encrypt_name']  = TRUE;
           $config['file_name'] = $avatar_file_vcard;
           $this->load->library('upload',$config);
           $this->upload->do_upload('vcard_front');
           $upload_data = $this->upload->data();
           $pdffilename = $upload_data['file_name'];
           $profile = array("vcard_front" => $pdffilename);
           $this->db->where(array('id'=>$user['userid']));
	       $this->db->update('user',$profile);
          
        } 	
        
        if ($_FILES['vcard_back']['name'] != '')
		{
           
           $avatar_file_vcard_back = $user['userid'].'.'.pathinfo($_FILES['vcard_back']['name'], PATHINFO_EXTENSION);
           
           $config = array();
           $config['upload_path'] = $this->config->item('my_upload_directory') . 'requirements/' ;
           $config['allowed_types'] = '*'; //'gif|jpg|png';
           $config['encrypt_name']  = TRUE;
           $config['file_name'] = $avatar_file_vcard_back;
           $this->load->library('upload',$config);
           $this->upload->do_upload('vcard_back');
           $upload_data = $this->upload->data();
           $pdffilename = $upload_data['file_name'];
           $profile = array("vcard_back" => $pdffilename);
           $this->db->where(array('id'=>$user['userid']));
	       $this->db->update('user',$profile);
          
        } 
	    
	    
	    
	    
	    
	    $profile=array(
	            /*"first_name"=>$user['first_name'],
	            "middle_name"=>$user['middle_name'],
	            "last_name"=>$user['last_name'],*/
	            "email_address"=>$user['email'],
	            "phone"=>$user['mobile'],
	            "gender"=>$user['gender'],
	            "company"=>$user['company'],
	            "dob"=>$user['date_of_birth'],
	            "designation"=>$user['designation'],
	            "total_experience"=>$user['total_experience'],
	            "business_category"=>$user['business_category'],
	            "website"=>$user['website'],
	            "company_address"=>$user['company_address'],
	            "wmobile"=>$user['whatsapp_no'],
                    "company_wmobile"=>$user['company_whatsapp_no'],
	            "company_facebook"=>$user['company_facebook'],
	            "company_linkedin"=>$user['company_linkedin'],
	            "company_instagram"=>$user['company_instagram'],
	            "company_twitter"=>$user['company_twitter'],
	            "company_youtube"=>$user['company_youtube'],
	            "company_skype"=>$user['company_skype'],
	            "company_google"=>$user['company_google']
	        );
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	

	
	public function get_app_user_view_profile_contact_fileds_builder($rs){
	    
	    $business_cat = $this->db->where('functional_area_id',$rs->business_category)->get('tbl_functional_area')->row();
	    
	    if($rs->company_google == ''){$google = '';} else{$google = $rs->company_google;}
	    
	    
	    return array(
		  
		    /*'first_name'=>$rs->first_name,
		    'middle_name'=>$rs->middle_name,
		    'lastt_name'=>$rs->last_name,*/
		    'userids'=>$rs->id,
		    'email'=>$rs->email_address,
		    'date_of_birth'=>$rs->dob,
		    'mobile'=>$rs->phone,
		    'gender'=>$rs->gender,
		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
		    'total_experience'=>$rs->total_experience,
		    'business_category_name'=>$business_cat->functional_area,
		    'business_category_id'=>$rs->business_category,
		    'website'=>$rs->website,
		    'company_address'=>$rs->company_address,
		    'countryid'=>$rs->country,
		    'stateid'=>$rs->state,
		    'cityid'=>$rs->city,
		    'pin_code'=>$rs->zip_code,
		    'established_on'=>'',
		    'vcard_front'=> empty($rs->vcard_front)?'':base_url().'upload/requirements/'.$rs->vcard_front,
	        'vcard_back'=> empty($rs->vcard_back)?'':base_url().'upload/requirements/'.$rs->vcard_back,
	        'company_facebook'=>$rs->company_facebook,
	        'company_linkedin'=>$rs->company_linkedin,
	         'company_instagram'=>$rs->company_instagram,
	         'company_twitter'=>$rs->company_twitter,
	         'company_youtube'=>$rs->company_youtube,
	         'company_google'=>$google,
	          'company_skype'=>$rs->company_skype,
		    'chat_id'=> $this->getfirebaseid($rs->id),
		    'whatsapp_no'=>$rs->wmobile,
                       'company_whatsapp_no'=>$rs->company_wmobile,
		);
	    
	}
	
	public function get_app_user_view_profile_about_fileds_builder($rs){
	    
	    
	   $turnover = $this->db->where('turn_over_id',$rs->turn_over)->get('turn_over')->row();
	   $employee = $this->db->where('id',$rs->no_of_employees)->get('employee')->row();  
	    
	    
	    return array(
		  
		    'about_company'=>$rs->about_company,
		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
		    'business_entity'=>$rs->business_entity,
		    'business_type'=>$rs->business_type,
		    'business_expertise'=>$rs->business_experties,
		    'working_from'=>$rs->working_from,
		    'no_of_employees'=>$employee->title,
		    'no_of_employees_id'=>$rs->no_of_employees,
		    'expected_turnover_id'=>$rs->turn_over,
		    'expected_turnover_value'=>$turnover->turn_over_value,
		    'target_audiance'=>$rs->target_audiance,
		    'membership_title'=>$rs->pack_name,
		    'company_profile'=> empty($rs->company_profile)?'':base_url().'upload/requirements/'.$rs->company_profile,
		    'company_ppt'=> empty($rs->company_ppt)?'':base_url().'upload/requirements/'.$rs->company_ppt,
		    'chat_id'=> $this->getfirebaseid($rs->id),
		  	  
		);
	    
	}
	public function check_email_exist($email){
	    
	    $sqlll="select * from user where email_address='".$email."' ";
	    $resss=$this->db->query($sqlll)->result();
	    if(isset($resss) && !empty($resss)){
	        $msss=array('status'=>TRUE,'user_id'=>$resss[0]->id);
	        return $msss;
	    }else{
	        $msss=array('status'=>FALSE);
	        return $msss;
	       
	        
	    }
	    
	}
	
	
	public function check_socialid_exist($socialid){
	    
	    $sqlll="select * from user where signup_socialid='".$socialid."' ";
	    $resss=$this->db->query($sqlll)->result();
	    if(isset($resss) && !empty($resss)){
	        $msss=array('status'=>TRUE,'user_id'=>$resss[0]->id);
	        return $msss;
	    }else{
	        $msss=array('status'=>FALSE);
	        return $msss;
	       
	        
	    }
	    
	}
	
	
	
	public function save_social_user_info($global_setting, $source = 'web', $user){
	    
	        $user_status=1;
	        
	        $user_ids = my_random();
	        $referral_array['src_from'] = '';$referral_array['referral_code'] = '';
	        $user_array = array(
		    'ids' => $user_ids,
		    'username' => '',
		    'password' => '',
			'api_key' => my_random(),
			'balance' => '{"usd":0}',
		    'email_address' => $user['email'],
		    'email_verified' => '',
			'email_address_pending' => '',
			'oauth_google_identifier' => '',
			'oauth_facebook_identifier' => '',
			'oauth_twitter_identifier' => '',
			'signup_source' => $user['social_type'],
			'signup_socialid' => $user['socialid'],
		    'first_name' => $user['first_name'],
		    'last_name' => $user['last_name'],
			'company' => '',
		    'avatar' => 'default.jpg',
		    'timezone' => $this->config->item('time_reference'),
			'date_format' => 'Y-m-d',
			'time_format' => 'H:i:s',
			'language' => ucfirst($language),
			'country' => '',
			'currency' => 'USD',
			'address_line_1' => '',
			'address_line_2' => '',
			'city' => '',
			'state' => '',
			'zip_code' => '',
		    'role_ids' => '', // $global_setting->default_role,
		    'status' => $user_status,
		    'created_time' => my_server_time(),
		    'update_time' => my_server_time(),
		    'login_success_detail' => '',
			'online' => 0,
			'phone'=>'',
			'online_time' => '',
			'new_notification' => 0,
			'referral' => json_encode($referral_array),
			'affiliate_enabled' => 0,
			'affiliate_code' => '',
			'affiliate_earning' => '{}',
			'affiliate_setting' => '',
			'otp'=>'',
			'login_type'=>'social',
			'membership_type'=> '0',
			'device_type' => $user['device_type'],
			'device_token' => $user['device_token'],
		  );
		  $ressuu=$this->db->insert('user', $user_array);
		  $insert_id = $this->db->insert_id();
		  if(isset($insert_id) && !empty($insert_id)){
		      $rrrr=array('result'=>TRUE,'lastuserid'=>$insert_id);   
		      return $rrrr;
		  }else{
		     $rrrr=array('result'=>FALSE);  
		     return $rrrr; 
		  }
		  
		 
	    
	}
	
	/*
	//
	*/
	public function update_app_user_edit_membership_details($user){
	    
	            if($user['membership_type'] != '')
	            {
	                $profiles=array("membership_type"=>$user['membership_type']);
	                $this->db->where(array('id'=>$user['userid']));
	                $res=$this->db->update('user',$profiles);
	            }
	    
	    
	    
	       $profile=array(
	            "first_name"=>$user['first_name'],
	            "middle_name"=>$user['middle_name'],
	            "last_name"=>$user['last_name'],
	            "email_address"=>$user['email'],
	            //"phone"=>$user['mobile'],
	            "designation"=>$user['designation'],
	            "company"=>$user['company_name'],
	            "company_contact"=>$user['company_phone'],
	            "company_address"=>$user['company_address'],
	            "referral_code"=>$user['referral_code'],
                   "wmobile"=>$user['whatsapp_no'],
                   "company_wmobile"=>$user['company_whatsapp_no'],
	           // "membership_type"=>$user['membership_type'],
	        );
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
	            
	            
	            
	            
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	public function update_app_user_add_membership_details($user){
	    
	    
	    $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['packages_id']))->row_array(); 
            $user['membership_type'] = $get_packages['pack_type'];
	    
	    if($user['membership_type'] == '2')
	    {
	        $stdate = date('Y-m-d');
	        $todaydate = strtotime($stdate);
              
                $duration = $get_packages['pack_duration'];
                $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
	                
	              //$edsdate = strtotime($eddate);
	                
	                
	                
	                $profile=array(
	                    "packages_id"=>$user['packages_id'],
	                    "packages_startDate"=> strtotime($stdate),
	                    "packages_endDate"=> strtotime($eddate),
	                    );
	                $this->db->where(array('id'=>$user['userid']));
	                $res=$this->db->update('user',$profile);
	            
	            $trans_detail = array(
	                'trans_userid'=>$user['userid'],
	                'trans_paymentids'=>$user['transactionid'],
	                'trans_paymenttype'=>$user['transationpaymenttype'],
	                'trans_amount'=>$user['transationamount'],
	                'trans_datetime'=>date('Y-m-d H:i:s',strtotime($user['transationdatetime'])),
	                'trans_for'=>'Membership Payment'
	                );
	            $this->db->insert('transactions',$trans_detail);
	            
	                
	                
	            }
                    
                    if($user['membership_type'] == '1')
	    {
	        $stdate = date('Y-m-d');
	        $todaydate = strtotime($stdate);
              
            $duration = $get_packages['pack_duration'];
            $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
	                
	              //$edsdate = strtotime($eddate);
	                
	                
	                
	                $profile=array(
	                    "packages_id"=>$user['packages_id'],
	                    "packages_startDate"=> strtotime($stdate),
	                    "packages_endDate"=> strtotime($eddate),
	                    );
	                $this->db->where(array('id'=>$user['userid']));
	                $res=$this->db->update('user',$profile);
	            
//	            $trans_detail = array(
//	                'trans_userid'=>$user['userid'],
//	                'trans_paymentids'=>$user['transactionid'],
//	                'trans_paymenttype'=>$user['transationpaymenttype'],
//	                'trans_amount'=>$user['transationamount'],
//	                'trans_datetime'=>$user['transationdatetime'],
//	                'trans_for'=>'Membership Payment'
//	                );
//	            $this->db->insert('transactions',$trans_detail);
	            
	                
	                
	            }
	    
	    $pur_array = array(
	                'user_id'=>$user['userid'],
	                'plan_id'=>$user['packages_id'],
	                'plan_startdate'=>$stdate,
	                'plan_enddate'=>$eddate,
	                'plan_status'=>'Active'
	                );
	                $this->db->insert('user_package_purchase',$pur_array); 
	    
	    
	    
	    $profile=array(
	            "first_name"=>$user['first_name'],
	            "middle_name"=>$user['middle_name'],
	            "last_name"=>$user['last_name'],
	            "email_address"=>$user['email'],
	            "phone"=>$user['mobile'],
	            "designation"=>$user['designation'],
	            "company"=>$user['company_name'],
	            "company_contact"=>$user['company_phone'],
	            "company_address"=>$user['company_address'],
	            "referral_code"=>substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 6),
	            "membership_type"=>$user['membership_type'],
                    "referred_by"=>$user['referred_by'],
                    "wmobile"=>$user['whatsapp_no'],
                    "company_wmobile"=>$user['company_whatsapp_no'],
	        );
	        
	        
	        
	        
	        $this->db->where(array('id'=>$user['userid']));
	        $res=$this->db->update('user',$profile);
	        if($res==TRUE){
                    if(!empty($user['referred_by']))
                    {
                    $this->add_reward_point('GuestBecomeMember',$user['referred_by'],date('Y-m-d'),date('H:i:s'),$user['first_name']);  
                    }
                    $rs_email = $this->db->where('purpose', 'welcome')->get('email_template')->row(); 
            $user_info = $this->db->where('id',$user['userid'])->get('user')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['user'] = $user_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/welcome', $data,true);
//            echo $body;
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
//                print_r($res);
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	
	
	
	
	
	/*
	/// check request sent or not
	
	*/
	public function check_connection_sent_or_not($userid,$receiverid){
	    
	   // $rs=$this->db->query("select * from connection where (user_one_id='".$userid."' and user_two_id='".$receiverid."') or (user_one_id='".$receiverid."' and user_two_id='".$userid."')")->result();
	     $rs=$this->db->query("select * from connection where (request_to='".$userid."' and request_from='".$receiverid."') or (request_to='".$receiverid."' and request_from='".$userid."')")->result();
	   
	    if(isset($rs) && !empty($rs)){
	        
	        return TRUE;
	    }else{
	        return FALSE;
	    }
	}
	
	/*  
	*
	*   sent connection request
	*/
	
	public function sent_connection_rest($userid,$receiverid){
	    
	    $data_sent=array(
	            "request_to"=>$userid,
	            "request_from"=>$receiverid,
	            "status"=>0
	        
	        );
	    
	    $rs=$this->db->insert('connection',$data_sent);
	    if($rs==TRUE){
	        
	        $last_insert_id = $this->db->insert_id();
	        
	        $notification = array(
	            'ids'=>my_random(),
	            'by_user_ids'=>$receiverid,
	            'to_user_ids'=>$userid,
	            'subject'=>'New Connection Request',
	            'body'=>'New Connection Request',
	            'request_for'=>"Connection",
    	        'request_id'=>$last_insert_id,
	            'is_read' => '0',
	            
	            );
	        $this->add_notification($notification);
	        
	        
	       /* $notification = array(
	            'ids'=>my_random(),
	            'by_user_ids'=>$receiverid,
	            'to_user_ids'=>$userid,
	            'subject'=>'New Connection Request',
	            'body'=>'New Connection Request',
	            'request_for'=>"Connection",
    	        'request_id'=>$last_insert_id,
	            'is_read' => '0',
	            
	            );
	        $this->add_notification($notification);*/
	        $useriddd=$this->db->query("select * from user where id='".$userid."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$userid,'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$userid,'package_id'=>$useriddd->packages_id,'feature_id'=>6,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
	        return TRUE;
	    }else{
	        return FALSE;
	    }
	    
	    
	}
	
	/*
	*
	*
	*/
	public function check_already_accept_or_not($receiverid,$senderid){
	    
	    $rs=$this->db->query("select * from connection where (request_to='".$senderid."' and request_from='".$receiverid."') OR (request_from='".$senderid."' and request_to='".$receiverid."')")->result();
	    if(isset($rs) && !empty($rs)){
	        
	        return $rs;
	    }else{
	        return FALSE;
	    }
	    
	}
	
	/*
	*
	*Connection accept request
	*/
	public function accept_connection_request($receiverid,$senderid){
	    
	    
	    $data_upd=array(
	            "status"=>1
	            
	        );
	        
	        $this->db->where(array("request_to"=>$senderid,"request_from"=>$receiverid));
	        $rss=$this->db->update("connection",$data_upd);
	        if($rss==TRUE){
	            
	            $data_1 = array('user_id'=>$senderid,'buddy_id'=>$receiverid);
	            $this->db->insert('buddies',$data_1);
	            
	            $data_2 = array('user_id'=>$receiverid,'buddy_id'=>$senderid);
	            $this->db->insert('buddies',$data_2);
	            
	            $notification = array(
    	            'ids'=>my_random(),
    	            'by_user_ids'=>$senderid,
    	            'to_user_ids'=>$receiverid,
    	            'subject'=>'Connection Request Accepted',
    	            'body'=>'Connection Request Accepted',
    	            'request_for'=>"Connection",
    	            'request_id'=>"",
    	            'is_read' => '0',
    	            
    	            );
	            $this->add_notification($notification);
	            
	            
	            return TRUE;
	        }else{
	            return FALSE;
	            
	        }
	    
	    
	}
	
	/*
	*
	*/
	public function check_connect_sent_or_not($userid){
	    $sentdata=$this->db->query("select * from connection where request_to='".$userid."' ORDER BY `id` DESC")->result();  //ORDER BY `id` DESC
	    if(isset($sentdata) && !empty($sentdata)){
	        
	        return $sentdata;
	    }else{
	        
	        return FALSE;
	    }
	    
	}
	
		/*
	*
	*/
	public function check_connect_receive_or_not($userid){
	    $sentdata=$this->db->query("select * from connection where request_to='".$userid."'  ORDER BY `id` DESC")->result();    // $senderid  or request_from='".$userid."'
	    if(isset($sentdata) && !empty($sentdata)){
	        
	        return $sentdata;
	    }else{
	        
	        return FALSE;
	    }
	    
	}
	/*
	*
	*/
	public function delete_connection_request($receiverid,$senderid){
	    
	    $rsss=$this->db->query("delete from connection where (request_to='".$senderid."' and request_from='".$receiverid."') OR (request_from='".$senderid."' and request_to='".$receiverid."')");
	    if($rsss == TRUE){
	        
	            $this->db->where(array('user_id'=>$senderid,'buddy_id'=>$receiverid));
	            $this->db->delete('buddies');
	            
	            $this->db->where(array('user_id'=>$receiverid,'buddy_id'=>$senderid));
	            $this->db->delete('buddies');
	        
	        $notification = array(
    	            'ids'=>my_random(),
    	            'by_user_ids'=>$senderid,
    	            'to_user_ids'=>$receiverid,
    	            'subject'=>'Connection Request Decline',
    	            'body'=>'Connection Request Decline',
    	            'request_for'=>"Connection",
    	            'request_id'=>"",
    	            'is_read' => '0',
    	            
    	            );
	            $this->add_notification($notification);
	        
	        return TRUE;
	    }else{
	        return FALSE;
	        
	    }
	    
	}
	
	/*
	*
	*
	*/
	
	public function get_membership_plan_details(){
	    
        $query = $this->db->order_by('seq_no','asc')->get('packages');
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_get_membership_plan_details_fileds_builder($rs){
	    
//	    $result_data[] = array(
//    		  
//    		    'membership_id'=>"0",
//    		    'membership_title'=>"Guest Member",
//    		    
//    		);
	    
	    foreach($rs as $val)
	    {
    	    $result_data[] = array(
    		  
    		    'membership_id'=>$val->pack_id,
    		    'membership_title'=>$val->pack_name,
    		    'membership_seq_no'=>$val->seq_no
    		);
	    }
	    
	    return $result_data;
	    
	}
	
	function check_user_visibility($user_id,$user_id1)
        {
            $check_in_usertble = $this->db->where('id',$user_id)->get('user')->row();
	    $package_info1 = $this->db->where(array('user_id'=>$user_id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$user_id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            $str = explode(',',$user_consumption->type_id);
            if(in_array($user_id1,$str))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        
        function check_lead_visibility($user_id,$user_id1)
        {
            $check_in_usertble = $this->db->where('id',$user_id)->get('user')->row();
	    $package_info1 = $this->db->where(array('user_id'=>$user_id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$user_id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            $str = explode(',',$user_consumption->type_id);
            if(in_array($user_id1,$str))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
	
	public function get_app_get_all_members($user_id){
	    $data_array = array();
	    $sql = '';
	    if($this->json_array['min_employee']  == '')
	    {
	        $min_employees = '0';
	    }
	    else
	    {
	        $min_employees = $this->json_array['min_employee'];
	    }
	    
	    if($this->json_array['membershiptype'] != '')
	    {
	        $sql.=" AND ( user.packages_id = '".$this->json_array['membershiptype']."')";  
	    }
	    
	    //if(($this->json_array['min_employee'] != '' && $this->json_array['max_employee'] != '') OR ($this->json_array['min_employee'] != '0' && $this->json_array['max_employee'] != '0'))
	    //if($this->json_array['min_employee'] != '0' && $this->json_array['max_employee'] != '0')  //|| $this->json_array['max_employee'] == '0'
	    if($min_employees != '0' )
	    {
	       // $sql.=" AND ( no_of_employees BETWEEN '".$this->json_array['min_employee']."' AND '".$this->json_array['max_employee']."' )";
	         $sql.=" AND ( user.no_of_employees = '".$this->json_array['min_employee']."')";
	    }
	    
	    if($this->json_array['business_category'] != '')
	    {
	        $bus_cat_array = (explode(",",$this->json_array['business_category']));
	        $bus_ids = implode(',',$bus_cat_array);   
	        $sql.=" AND ( user.business_category IN (".$bus_ids."))";
	    }
	    
	    
	    if($this->json_array['keyword'] != '')
	    {
	        $keyword = $this->json_array['keyword'];
	       // $sql.=" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%') OR (user.company LIKE '%$keyword%') OR (user.company_address LIKE '%$keyword%') OR (user.designation LIKE '%$keyword%') OR (user.business_entity LIKE '%$keyword%') )";
	       //$sql.=" HAVING ( (user.company LIKE '%$keyword%') OR (user.company_address LIKE '%$keyword%') OR (user.designation LIKE '%$keyword%') )";
	    }
	    
	    
	    if($this->json_array['turn_over'] != '')
	    {
	        $sql.=" AND ( user.turn_over = '".$this->json_array['turn_over']."')";
	    }
	    
	    if($this->json_array['location'] != '')
	    {
	        $locations = $this->json_array['location'];
	        $sql.=" AND ( (user.company_address LIKE '%$locations%') )";
	    }
	    
	    $check_in_usertble = $this->db->where('id',$user_id)->get('user')->row();
	    $package_info1 = $this->db->where(array('user_id'=>$user_id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$user_id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	    //$query = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,email_address as email,phone as mobile,designation,company as company_name,company_contact,company_address,dob,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type from user where `id`!=$user_id  AND membership_type !='0' $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
            $str = explode(',',$user_consumption->type_id);
        $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,prefix,first_name,middle_name,last_name,email_address as email,phone as mobile,designation,company as company_name,company_contact,company_address,dob,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type,packages_id,wmobile,company_wmobile from user where `id`!=$user_id  AND membership_type IN ('1','2') $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
       //echo $this->db->last_query();exit();
        
        foreach($getdata as $query)
        {
            if($query->packages_id == '' OR $query->packages_id == '0')
            {
                $membership_name = '';
            }
            else
            {
                $packages_ids = $query->packages_id;
                $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                $membership_name = $getpackage->pack_name;
            }
            
            $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query->id)->get('reward_user_point')->row();
        
            if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
            $name = "";
            // if(!empty($query->prefix))
            // {
            //     $name = $name.$query->prefix;
            // }
            if(!empty($query->first_name))
            {
                $name = $name.trim($query->first_name);
            }
            if(!empty($query->middle_name))
            {
                $name = $name." ".trim($query->middle_name);
            }
            if(!empty($query->last_name))
            {
                $name = $name." ".trim($query->last_name);
            }
            // if($query->id == 21)
            // {
            // echo $name;
            // }
            $flag = 1;
            if($this->json_array['keyword'] != '')
            {
                $kw = $this->json_array['keyword'];
                if(stripos(ucwords($name), $kw) !== false)
                {
                    $flag = 1;
                }
                else
                {
                    $flag = 0;
                }
            }
            // echo strpos($name, $this->json_array['keyword']);die;
            
            if($flag == 1)
            {
             $data_array[] = array(
                "id"=> $query->id,
                "full_name"=>ucwords($name),
                "email"=> $query->email,
                "mobile"=> $query->mobile,
                "designation"=> $query->designation,
                "company_name"=>$query->company_name,
                "company_contact"=> $query->company_contact,
                "company_address"=> $query->company_address,
                "dob"=> $query->dob,
                "profile_pic"=>$query->profile_pic,
                "membership_type"=>$query->membership_type,
                "membership_name"=>$membership_name,
                "check_connection"=>$this->get_check_connection($query->id,$user_id),
                "total_point"=>$toal_points,
                "chat_id"=> $this->getfirebaseid($query->id),
                 "is_viewed"=>(in_array($query->id,$str))?1:0,
                 'whatsapp_no'=>$query->wmobile,
                       'company_whatsapp_no'=>$query->company_wmobile,
                );
            }
        }
        
        if (isset($getdata) && !empty($getdata)) {
			
		   if($this->json_array['rank'] != '')
	       {
			
			array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $data_array), SORT_DESC, $data_array);
			
			
			  if($this->json_array['rank'] == '1')
	          {
	            $data_array = array_slice($data_array, 0, 10);
                  
	          }
	          
	          elseif($this->json_array['rank'] == '2')
	          {
	            $data_array = array_slice($data_array, 0, 100);  
	          }
	          
	          elseif($this->json_array['rank'] == '3')
	          {
	            $data_array = array_slice($data_array, 0, 500);  
	          }
			  else
			  {
			      array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $data_array), SORT_ASC, $data_array);
	           
			  
//			  return $data_array;
			  }
			  
			  
			  array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $data_array), SORT_ASC, $data_array);
	           
			  
//			  return $data_array;
			
	       }
	       else
	       {
	           array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $data_array), SORT_ASC, $data_array);
	           
	           
//	           return $data_array;
	       }
		$data['member_info'] = $data_array;
            $recommendation = 0;
                    
                    $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>6))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>6,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $recommendation = 1;
                   }
                }                                   
            }
            $data['is_connection_exhausted'] = $recommendation;	
				return $data;
		}
		else {
			return FALSE;
		}
	    
	}
	
	/*
	*
	*
	*/
	
	
	public function get_check_connections($userid,$receiverid)
	{
	   // $rs=$this->db->query("select * from connection where (request_to='".$userid."' and request_from='".$receiverid."') or (request_to='".$receiverid."' and request_from='".$userid."')")->result();
	   
	   
	   $rs=$this->db->query("select * from buddies where (user_id='".$userid."' AND buddy_id='".$receiverid."')")->result();
	   
	   
	    if(isset($rs) && !empty($rs)){
	        
	        return "0";
	    }else{
	        return "1";
	    }
	}
	
	
	public function get_check_connection($userid,$receiverid)
	{
	   // $rs=$this->db->query("select * from connection where (request_to='".$userid."' and request_from='".$receiverid."') or (request_to='".$receiverid."' and request_from='".$userid."')")->result();
	   
	   
	   $rs=$this->db->query("select * from buddies where (user_id='".$userid."' AND buddy_id='".$receiverid."')")->result();
	   
	   
	    if(isset($rs) && !empty($rs)){
	        
	        return "Yes";
	    }else{
	        return "No";
	    }
	}
	
	
	public function get_app_get_all_members_fileds_builder($rs){
	    $i=0;
	    $userdata=array();
	    
	    
	    foreach($rs as $rs){
	        
	        $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>ucwords($rs->first_name." ".$rs->middle_name." ". $rs->last_name),
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
        		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
        		    'company_phone'=>$rs->company_phone,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
	                'chat_id'=> $this->getfirebaseid($rs->id),
	            );
	            array_push($userdata,$daaa);
	            $i++;
	    }
	    
	     return array(
		  'message' => array(
		      
		     "user_data"=>$daaa
		    
		    
		  )	  
		);
	    
	}
	
	/*
	*
	*
	*/
	public function get_buddies_list($userid){ 
	    //$get_connection=$this->db->query("select * from connection where (user_one_id='".$userid."' or user_two_id='".$userid."') and status='1'")->result();
	    
	    $get_connection=$this->db->query("select * from buddies where (user_id='".$userid."') ")->result();
	    
	    if(isset($get_connection) && !empty($get_connection)){
	        
	        return $get_connection;
	    }else{
	        
	        return FALSE;
	    }
	    
	}
	
	
	
	public function get_buddies_list_with_membership_type($users){
	    
	    $buddy_array=array();
	    $i=0;
	    
	    if($this->json_array['min_employee'] == '')
	    {
	      $employees = '0';  
	    }
	    else
	    {
	      $employees =   $this->json_array['min_employee'];
	    }
	    
	    
	    //first check what user sent
	    //$get_sent_user=$this->db->query("select * from connection where user_one_id='".$userid."' and status='1'")->result();
	    
	    $users = $this->json_array['userid'];
	    $sql = '';
	    
	    if($this->json_array['membershiptype'] != '')
	    {
	        $sql.=" AND ( user.packages_id = '".$this->json_array['membershiptype']."')";
	    }
	    
	    
	    
	    
	    if($employees != '0')
	    {
	        //$sql.=" AND ( no_of_employees BETWEEN '".$this->json_array['min_employee']."' AND '".$this->json_array['max_employee']."' )";
	       // echo $sql;
	       $sql.=" AND ( user.no_of_employees = '".$this->json_array['min_employee']."')";
	    }
	    
	    
	    if($this->json_array['turn_over'] != '')
	    {
	        $sql.=" AND ( user.turn_over = '".$this->json_array['turn_over']."')";
	    }
	    
	    if($this->json_array['business_category'] != '')
	    {
	        $bus_cat_array = (explode(",",$this->json_array['business_category']));
	        $bus_ids = implode(',',$bus_cat_array);   
	        $sql.=" AND ( user.business_category IN (".$bus_ids."))";
	    }
	    
	    if($this->json_array['keyword'] != '')
        {
            $keyword = $this->json_array['keyword'];
            
	            $get_user_searchdata = $this->db->query("select id as usersid from user where (user.first_name LIKE '%$keyword%')OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%') OR (user.company LIKE '%$keyword%') OR (user.company_address LIKE '%$keyword%') OR (user.designation LIKE '%$keyword%') OR (user.business_entity LIKE '%$keyword%')")->result();
	            
	            //echo $this->db->last_query();
	            foreach($get_user_searchdata as $valdata)
	            {
	                $getusersearchdata[] = $valdata->usersid;
	            }
	           
	            //$getusersearchdata = implode(",",$data_array);
	            
	            
        }
	    
	    
	    if($this->json_array['location'] != '')
	    {
	        $locations = $this->json_array['location'];
	        $sql.=" AND ( (user.company_address LIKE '%$locations%') )";
	    }
	    
	    
	    
	    $get_sent_user=$this->db->query("select * from buddies LEFT JOIN user ON buddies.buddy_id=user.id where buddies.user_id='".$users."' $sql")->result(); 
	    
	    //echo $this->db->last_query();
	    
	    if(isset($get_sent_user) && !empty($get_sent_user)){
	       
	       if($this->json_array['keyword'] != '')
           {
             
             foreach($get_sent_user as $rrr){
	            //get user details
	            $useriddd=$rrr->buddy_id;
	            
	            
	            $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
	            $rs=$userdetailss[0];
	            
	            if($rs->membership_type == '' OR $rs->membership_type == '1')
                {
                    $membership_name = 'Guest Member';
                }
                else
                {
                    $packages_ids = $rs->packages_id;
                    $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                    $membership_name = $getpackage->pack_name;
                }
	            
	            
	           
	            if(in_array($rs->id,$getusersearchdata))
                {
                   
                   $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$rs->id)->get('reward_user_point')->row();
                   if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
                   
                   if($rs->membership_type == '2'){
                       $daaa=array(
    	                "id"=>$i,
    	                'userid'=>$rs->id,
            		   
            		    'full_name'=>ucfirst($rs->first_name)." ".ucfirst($rs->middle_name)." ".ucfirst($rs->last_name),
            		    'email'=>$rs->email_address,
            		    'mobile'=>$rs->phone,
            		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
            		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
            		    'company_phone'=>$rs->company_number,
            		    'company_address'=>$rs->company_address,
            		    'dob'=>$rs->dob,
            		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
            		    'total_point'=>$toal_points,
    	                'chat_id'=> $this->getfirebaseid($rs->id),
    	                'membership_name'=>$membership_name,
    	                'membership_type'=>$rs->membership_type
    	            );
    	               array_push($buddy_array,$daaa);
                   }    
                }
	           
	           
	            
	            //if(!in_array($daaa,$buddy_array)){
	                //array_push($buddy_array,$daaa);
	            //}
	            
	           $i++; 
	        }  
               
           }       
	        
	       else { 
	        foreach($get_sent_user as $rrr){
	            //get user details
	            $useriddd=$rrr->buddy_id;
	            
	            
	            
	            
	            $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
	            $rs=$userdetailss[0];
	            
	            $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$rs->id)->get('reward_user_point')->row();
                if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
                   
	           
	           if($rs->membership_type == '' OR $rs->membership_type == '1')
                {
                    $membership_name = 'Guest Member';
                }
                else
                {
                    $packages_ids = $rs->packages_id;
                    $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                    $membership_name = $getpackage->pack_name;
                }
	           
	           if($rs->membership_type == '2'){
	            $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>ucfirst($rs->first_name)." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
        		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
        		    'company_phone'=>$rs->company_number,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'total_point'=>$toal_points,
        		    'chat_id'=> $this->getfirebaseid($rs->id),
        		    'membership_name'=>$membership_name,
	                'membership_type'=>$rs->membership_type
	            );
	            
	                array_push($buddy_array,$daaa);
	            }
	            
	           $i++; 
	        }
	       } 
	    }
	    
	    //$get_sent_user2=$this->db->query("select * from connection where user_two_id='".$userid."' and status='1'")->result();
	    /*
	    $usersids = $this->json_array['userid'];
	    $get_sent_user2=$this->db->query("select * from buddies where buddy_id='".$usersids."'")->result();
	    
	    
	    if(isset($get_sent_user2) && !empty($get_sent_user2)){
	        
	       
	        foreach($get_sent_user2 as $rrr){
	            //get user details
	            $useriddd=$rrr->user_id;
	           
	            
	            if($this->json_array['keyword'] != '')
                {
    	          $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
    	            $rs=$userdetailss[0];
    	            
    	           
    	            if(in_array($rs->id,$getusersearchdata))
                    {
                       $daaa=array(
    	                "id"=>$i,
    	                'userid'=>$rs->id,
            		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
            		    'email'=>$rs->email_address,
            		    'mobile'=>$rs->phone,
            		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
            		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
            		    'company_phone'=>$rs->company_number,
            		    'company_address'=>$rs->company_address,
            		    'dob'=>$rs->dob,
            		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar
    	                
    	            );
    	            array_push($buddy_array,$daaa);
                    }
    	           
                } 
	         
	            else
                {
    	          $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
    	            $rs=$userdetailss[0];
    	            
    	           
    	            
                       $daaa=array(
    	                "id"=>$i,
    	                'userid'=>$rs->id,
            		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
            		    'email'=>$rs->email_address,
            		    'mobile'=>$rs->phone,
            		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
            		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
            		    'company_phone'=>$rs->company_number,
            		    'company_address'=>$rs->company_address,
            		    'dob'=>$rs->dob,
            		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar
    	                
    	            );
    	            array_push($buddy_array,$daaa);
                    
    	           
                }
	            
	            
	            
	            
	            
	            
	            
	            
	            
	           // if(!in_array($daaa,$buddy_array)){
	                //array_push($buddy_array,$daaa);
	           // }
	            
	           $i++; 
	        }
	        
	    }*/
	    
	    if(isset($buddy_array) && !empty($buddy_array)){
	        
	       if($this->json_array['rank'] != '')
	       {
			
		    	array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $buddy_array), SORT_DESC, $buddy_array);
			
			
			  if($this->json_array['rank'] == '1')
	          {
	            $buddy_array = array_slice($buddy_array, 0, 10);
                  
	          }
	          
	          elseif($this->json_array['rank'] == '2')
	          {
	            $buddy_array = array_slice($buddy_array, 0, 100);  
	          }
	          
	          elseif($this->json_array['rank'] == '3')
	          {
	            $buddy_array = array_slice($buddy_array, 0, 500);  
	          }
			  else
			  {
			      array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $buddy_array), SORT_ASC, $buddy_array);
			  
			  
			      return $buddy_array;
			  }
			  
			  
			  return $buddy_array;
			
	       }
	       else
	       {
	            array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $buddy_array), SORT_ASC, $buddy_array);
			  
	        return $buddy_array;
	       } 
	        
	        
	        
	    }else{
	        return FALSE;
	    }
	    
	}
	
	
	public function get_all_buddy_list($users){
	    
	    $buddy_array=array();
	    $i=0;
	    
	    if($this->json_array['min_employee'] == '')
	    {
	      $employees = '0';  
	    }
	    else
	    {
	      $employees =   $this->json_array['min_employee'];
	    }
	    
	    
	    //first check what user sent
	    //$get_sent_user=$this->db->query("select * from connection where user_one_id='".$userid."' and status='1'")->result();
	    
	    $users = $this->json_array['userid'];
	    $sql = '';
	    
	    if($this->json_array['membershiptype'] != '')
	    {
	        $sql.=" AND ( user.packages_id = '".$this->json_array['membershiptype']."')";
	    }
	    
	    
	    
	    
	    if($employees != '0')
	    {
	        //$sql.=" AND ( no_of_employees BETWEEN '".$this->json_array['min_employee']."' AND '".$this->json_array['max_employee']."' )";
	       // echo $sql;
	       $sql.=" AND ( user.no_of_employees = '".$this->json_array['min_employee']."')";
	    }
	    
	    
	    if($this->json_array['turn_over'] != '')
	    {
	        $sql.=" AND ( user.turn_over = '".$this->json_array['turn_over']."')";
	    }
	    
	    if($this->json_array['business_category'] != '')
	    {
	        $bus_cat_array = (explode(",",$this->json_array['business_category']));
	        $bus_ids = implode(',',$bus_cat_array);   
	        $sql.=" AND ( user.business_category IN (".$bus_ids."))";
	    }
	    
	    if($this->json_array['keyword'] != '')
        {
            $keyword = $this->json_array['keyword'];
            
	            $get_user_searchdata = $this->db->query("select id as usersid from user where (user.first_name LIKE '%$keyword%')OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%') OR (user.company LIKE '%$keyword%') OR (user.company_address LIKE '%$keyword%') OR (user.designation LIKE '%$keyword%') OR (user.business_entity LIKE '%$keyword%')")->result();
	            
	            //echo $this->db->last_query();
	            foreach($get_user_searchdata as $valdata)
	            {
	                $getusersearchdata[] = $valdata->usersid;
	            }
	           
	            //$getusersearchdata = implode(",",$data_array);
	            
	            
        }
	    
	    
	    if($this->json_array['location'] != '')
	    {
	        $locations = $this->json_array['location'];
	        $sql.=" AND ( (user.company_address LIKE '%$locations%') )";
	    }
	    
	    
	    
	    $get_sent_user=$this->db->query("select * from buddies LEFT JOIN user ON buddies.buddy_id=user.id where buddies.user_id='".$users."' $sql")->result(); 
	    
	    //echo $this->db->last_query();
	    
	    if(isset($get_sent_user) && !empty($get_sent_user)){
	       
	       if($this->json_array['keyword'] != '')
           {
             
             foreach($get_sent_user as $rrr){
	            //get user details
	            $useriddd=$rrr->buddy_id;
	            
	            
	            $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
	            $rs=$userdetailss[0];
	            
	            if($rs->membership_type == '' OR $rs->membership_type == '1')
                {
                    $membership_name = 'Guest Member';
                }
                else
                {
                    $packages_ids = $rs->packages_id;
                    $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                    $membership_name = $getpackage->pack_name;
                }
	            
	            
	           
	            if(in_array($rs->id,$getusersearchdata))
                {
                   
                   $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$rs->id)->get('reward_user_point')->row();
                   if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
                   
                   $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		   
        		    'full_name'=>ucfirst($rs->first_name)." ".ucfirst($rs->middle_name)." ".ucfirst($rs->last_name),
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
        		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
        		    'company_phone'=>$rs->company_number,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'total_point'=>$toal_points,
	                'chat_id'=> $this->getfirebaseid($rs->id),
	                'membership_name'=>$membership_name,
	                'membership_type'=>$rs->membership_type,
                       'is_viewed'=>$this->check_user_visibility($users,$rs->id),
                       'whatsapp_no'=>$rs->wmobile,
                       'company_whatsapp_no'=>$rs->company_wmobile,
	            );
	            array_push($buddy_array,$daaa);
                }
	           
	           
	            
	            //if(!in_array($daaa,$buddy_array)){
	                //array_push($buddy_array,$daaa);
	            //}
	            
	           $i++; 
	        }  
               
           }       
	        
	       else { 
	        foreach($get_sent_user as $rrr){
	            //get user details
	            $useriddd=$rrr->buddy_id;
	            
	            
	            
	            
	            $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
	            $rs=$userdetailss[0];
	            
	            $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$rs->id)->get('reward_user_point')->row();
                if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
                   
	           
	           if($rs->membership_type == '' OR $rs->membership_type == '1')
                {
                    $membership_name = 'Guest Member';
                }
                else
                {
                    $packages_ids = $rs->packages_id;
                    $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                    $membership_name = $getpackage->pack_name;
                }
	           
	            $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>ucfirst($rs->first_name)." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
        		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
        		    'company_phone'=>$rs->company_number,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'total_point'=>$toal_points,
        		    'chat_id'=> $this->getfirebaseid($rs->id),
        		    'membership_name'=>$membership_name,
	                'membership_type'=>$rs->membership_type,
                        'is_viewed'=>$this->check_user_visibility($users,$rs->id),
                        'whatsapp_no'=>$rs->wmobile,
                       'company_whatsapp_no'=>$rs->company_wmobile,
	            );
	            //if(!in_array($daaa,$buddy_array)){
	                array_push($buddy_array,$daaa);
	            //}
	            
	           $i++; 
	        }
	       } 
	    }
	    
	    //$get_sent_user2=$this->db->query("select * from connection where user_two_id='".$userid."' and status='1'")->result();
	    /*
	    $usersids = $this->json_array['userid'];
	    $get_sent_user2=$this->db->query("select * from buddies where buddy_id='".$usersids."'")->result();
	    
	    
	    if(isset($get_sent_user2) && !empty($get_sent_user2)){
	        
	       
	        foreach($get_sent_user2 as $rrr){
	            //get user details
	            $useriddd=$rrr->user_id;
	           
	            
	            if($this->json_array['keyword'] != '')
                {
    	          $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
    	            $rs=$userdetailss[0];
    	            
    	           
    	            if(in_array($rs->id,$getusersearchdata))
                    {
                       $daaa=array(
    	                "id"=>$i,
    	                'userid'=>$rs->id,
            		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
            		    'email'=>$rs->email_address,
            		    'mobile'=>$rs->phone,
            		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
            		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
            		    'company_phone'=>$rs->company_number,
            		    'company_address'=>$rs->company_address,
            		    'dob'=>$rs->dob,
            		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar
    	                
    	            );
    	            array_push($buddy_array,$daaa);
                    }
    	           
                } 
	         
	            else
                {
    	          $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();  //echo $this->db->last_query();
    	            $rs=$userdetailss[0];
    	            
    	           
    	            
                       $daaa=array(
    	                "id"=>$i,
    	                'userid'=>$rs->id,
            		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
            		    'email'=>$rs->email_address,
            		    'mobile'=>$rs->phone,
            		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
            		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
            		    'company_phone'=>$rs->company_number,
            		    'company_address'=>$rs->company_address,
            		    'dob'=>$rs->dob,
            		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar
    	                
    	            );
    	            array_push($buddy_array,$daaa);
                    
    	           
                }
	            
	            
	            
	            
	            
	            
	            
	            
	            
	           // if(!in_array($daaa,$buddy_array)){
	                //array_push($buddy_array,$daaa);
	           // }
	            
	           $i++; 
	        }
	        
	    }*/
	    
	    if(isset($buddy_array) && !empty($buddy_array)){
	        
	       if($this->json_array['rank'] != '')
	       {
			
		    	array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $buddy_array), SORT_DESC, $buddy_array);
			
			
			  if($this->json_array['rank'] == '1')
	          {
	            $buddy_array = array_slice($buddy_array, 0, 10);
                  
	          }
	          
	          elseif($this->json_array['rank'] == '2')
	          {
	            $buddy_array = array_slice($buddy_array, 0, 100);  
	          }
	          
	          elseif($this->json_array['rank'] == '3')
	          {
	            $buddy_array = array_slice($buddy_array, 0, 500);  
	          }
			  else
			  {
			      array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $buddy_array), SORT_ASC, $buddy_array);
			  
			  
			      return $buddy_array;
			  }
			  
			  
			  return $buddy_array;
			
	       }
	       else
	       {
	            array_multisort(array_map(function($element)
	              {
                      return $element['full_name'];
                  }, $buddy_array), SORT_ASC, $buddy_array);
			  
	        return $buddy_array;
	       } 
	        
	        
	        
	    }else{
	        return FALSE;
	    }
	    
	}
	
	/*
	*
	*
	*/
	public function get_conection_list($userid){
	    
	    $get_connection_sent_request=$this->db->query("select * from connection where request_to='".$userid."' order by `id` DESC")->result();  //echo $this->db->last_query();
	    if(isset($get_connection_sent_request) && !empty($get_connection_sent_request)){
	        
	        return $get_connection_sent_request;
	         
	    }else{
	        
	        return FALSE;
	    }
	    
	}
	
	/*
	*
	*
	*/
	public function get_all_connection_list_sent($userid){
	    
	    
	    $sent_request_array=array();   
	    $i=0;
	    
	    //first check what user sent
	    $get_sent_user=$this->db->query("select * from connection where request_to='".$userid."' order by `id` DESC ")->result();    //echo $this->db->last_query();
	    if(isset($get_sent_user) && !empty($get_sent_user)){
	        foreach($get_sent_user as $rrr){
	            //get user details
	            $useriddd=$rrr->request_from;
	            $statusss=$rrr->status;
	            $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();
	            $rs=$userdetailss[0];
	            
	            
	            $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
        		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
        		    'company_phone'=>$rs->company_phone,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'connection_status'=>$statusss,
                            'is_viewed'=>$this->check_user_visibility($userid,$rs->id)
	                
	            );
	            //if(!in_array($daaa,$buddy_array)){
	                
	                
	                
	                array_push($sent_request_array,$daaa);
	            //}
	            
	           $i++; 
	        }
	        
	    }
	    
	     if(isset($sent_request_array) && !empty($sent_request_array)){
	        
	        
	       
	        
	        
	        return $sent_request_array;
	        
	       // return $sent_request_array;
	    }else{
	        return FALSE;
	    }
	}
	
	/*
	*
	*
	*/
	
	public function get_conection_list_receive_req($userid){
	    $get_connection_sent_request=$this->db->query("select * from connection where request_from='".$userid."' order by `id` DESC")->result();
	    if(isset($get_connection_sent_request) && !empty($get_connection_sent_request)){
	        
	        return $get_connection_sent_request;
	    }else{
	        
	        return FALSE;
	    }
	    
	    
	}
	
	/*
	*
	*
	*/
	public function get_all_connection_list_receive($userid){
	    
	     
	    $receive_request_array=array();
	    $i=0;
	    
	    //first check what user sent
	    $get_sent_user=$this->db->query("select * from connection where request_from='".$userid."' order by `id` DESC")->result();
	    if(isset($get_sent_user) && !empty($get_sent_user)){
	        foreach($get_sent_user as $rrr){
	            //get user details
	            $useriddd=$rrr->request_to;
	            $statusss=$rrr->status;
	            $userdetailss=$this->db->query("select * from user where id='".$useriddd."'")->result();
	            $rs=$userdetailss[0];
	            
	            
	            $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>empty($rs->designation)?'Not Available':$rs->designation,
        		    'company_name'=>empty($rs->company)?'Not Available':$rs->company,
        		    'company_phone'=>$rs->company_phone,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'connection_status'=>$statusss,
                            'is_viewed'=>$this->check_user_visibility($userid,$rs->id)
	                
	            );
	            //if(!in_array($daaa,$buddy_array)){
	                array_push($receive_request_array,$daaa);
	            //}
	            
	           $i++; 
	        }
	        
	    }
	    
	     if(isset($receive_request_array) && !empty($receive_request_array)){
	        
	        return $receive_request_array;
	    }else{
	        return FALSE;
	    }
	    
	}
	
	/*
	*
	*/
	public function get_requirement_title($userid,$req_title){
	    
	    $query=$this->db->query("select * from requirements where user_id='".$userid."' and title='".$req_title."'")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	/*
	*
	*/
	
	public function save_req_deetails($reqq,$filename){
	    
	    $data_insert=array(
	           "user_id"=>$reqq['userid'],
	           "functional_area_id"=>$reqq['functional_area_id'],
	           "title"=>$reqq['requirement_title'],
	           "description"=>$reqq['requirement_description'],
	           "address"=>$reqq['address'],
	           "thumbnil"=>$filename,
	           "created_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "created_time"=>date('H:i:s',strtotime($reqq['created_time']))
	        );
	        
	        $ress=$this->db->insert('requirements',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
                    
                    $rs_email = $this->db->where('purpose', 'requirement')->get('email_template')->row(); 
            $requirement_info = $this->db->where('id',$insert_id)->get('requirements')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement'] = $requirement_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/requirement', $data,true);
//            echo $body;
            $user_info = $this->db->where('id',$requirement_info->user_id)->get('user')->row();
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
//                print_r($res);
                    
                    $data_insert1=array(
	           "post_userid"=>$reqq['userid'],
	           "post_catid"=>0,
	           "post_description"=>$reqq['requirement_description'],
	           "post_image"=>$filename,
	           "post_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "post_time"=>date('H:i:s',strtotime($reqq['created_time'])),
                       "post_type"=>2,
                       "post_type_id"=>$insert_id
	        );
	        
	        $ress1=$this->db->insert('postdetail',$data_insert1);
	            $this->add_reward_point('LeadCreate',$reqq['userid'],$reqq['created_date'],$reqq['created_time'],$reqq['requirement_title']);
	            
	            //return TRUE;
	            //get all details
	            $reqqq=$this->db->query("select * from requirements where id='".$insert_id."'")->result();
                    $useriddd=$this->db->query("select * from user where id='".$reqq['userid']."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$reqq['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$reqq['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>2,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	/*
	*
	*/
	public function get_all_requirement_title($userid){
	    
	    $query=$this->db->query("select * from requirements where user_id='".$userid."' AND requirements_status='1' ")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_requirement_title_byuser($userid){
	    
	    $query=$this->db->query("select * from recomendation where userid='".$userid."'")->result();  
	    if(isset($query) && !empty($query)){
	        
	        foreach($query as $val_data)
	        {
	            $roww = $this->db->query("select * from requirements where id='".$val_data->requirement_id."' AND requirements_status='1' ")->row();  //echo $this->db->last_query();
	            
	            $userdetails=$this->db->query("select * from user where id='".$roww->user_id."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            
	            $query_data[]=array(
	                
	                    "userid"=>$userrr,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "full_name"=>$full_name,
	                    "email"=>$email,
	                    "mobile"=>$mobile,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "company_phone"=>$company_phone,
	                    "company_address"=>$company_address,
	                    "dob"=>$dob,
	                    "profile_pic"=>$profilepic
	                
	                
	                );
	        }
	        
	        //print_r($query_data);
	        return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_all_requirement_title_except_user_itself($userid){
	    $query=$this->db->query("select * from requirements where user_id!='".$userid."' AND requirements_status='1' ORDER BY id DESC")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function get_all_pending_requirement($userid){
	    
	    
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select * from requirements where user_id='".$userid."' AND requirements_status='1' ")->result();
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->id."'")->row();
	           
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	         //echo $this->db->last_query();
	           $dataarrays = array();
        	   foreach($querygetdata as $valquerygetdata)
        	   {
        	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
        	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
        	       
        	   }
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (!in_array("3", $data_explode)){
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                 "thumbnil"=> empty($val_data->thumbnil)?'':base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
	             );
	           }
	        
	       
	       
	      }
	     
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function get_all_complete_requirement($userid){
	    
	    
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select * from requirements where user_id='".$userid."' AND requirements_status='1' ")->result();
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->id."' AND requirements_status='1' ")->row();
	           
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	         //echo $this->db->last_query();
	           $dataarrays = array();
        	   foreach($querygetdata as $valquerygetdata)
        	   {
        	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
        	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
        	       
        	   }
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (in_array("3", $data_explode)){
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                 "thumbnil"=> empty($val_data->thumbnil)?'':base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
	             );
	           }
	        
	       
	       
	      }
	     
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function get_all_complete_requirement_old($userid){
	    
	   
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid = '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid = '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->requirementids."'")->row();
	           
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         if($get_datas->req_user_status_statusid == '12' OR $get_datas->req_user_status_statusid == '13' OR $get_datas->req_user_status_statusid == '14')
	         {
	           $icon = base_url().'upload/deal/DealClose.png'; 
	         }
	         else
	         {
	           $icon = base_url().'upload/deal/DealCompleted.png'; 
	         }
	        
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                 "thumbnil"=> base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                 "icon"=>$icon,
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
	             );
	        
	        
	       
	       
	      }
	      
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function get_requirement_pending_byuser($userid){
	    // recomend_by
	   $query=$this->db->query("select requirement_id from recomendation where userid='".$userid."' GROUP BY `requirement_id`")->result();  
	    //$query=$this->db->query("select * from recomendation where recomend_by='".$userid."'")->result();  
	    
	    
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	                
	            
	            $queries = $this->db->query("select * from requirements where  id='".$val_data->requirement_id."'")->row();    //status = '1' AND
	            if(isset($queries))
	            {
	               $get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$queries->user_id)->get('user')->row();
	               
	               $querygetdatas = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$val_data->requirement_id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	               $dataarrays = array();
            	   foreach($querygetdatas as $valquerygetdata)
            	   {
            	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
            	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
            	       
            	   }
            	   
            	   $data_implodes = implode(",",$dataarrays);
            	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (!in_array("3", $data_explode)){
	              
	               $query_data[] = array(
	                    "id"=> $queries->id,
                        "user_id"=> $queries->user_id,
                        "user_name"=> $get_user->full_name,
                        "user_profile"=> $get_user->profile_pic,
                        "functional_area_id"=> $queries->functional_area_id,
                        "title"=> $queries->title,
                        "description"=> $queries->description,
                        "address"=> $queries->address,
                        "thumbnil"=> empty($queries->thumbnil)?'':base_url().'upload/requirements/'.$queries->thumbnil,
                        "created_date"=> $queries->created_date,
                        "created_time"=> $queries->created_time,
                        "status"=> $queries->status,
                        "doe"=> $queries->doe,
                        "filterdate"=> date('Y-m-d', strtotime($queries->created_date)),
                           "is_viewed"=>$this->check_lead_visibility($userid,$queries->id),
                           'is_user_viewed'=>$this->check_user_visibility($userid,$queries->user_id),
                   ); 
	            } }
	        }
	        
	        array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $query_data), SORT_DESC, $query_data);

             return $query_data;
	        
	       // return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_requirement_complete_byuser($userid){
	    
	    $query=$this->db->query("select requirement_id from recomendation where userid='".$userid."' GROUP BY `requirement_id`")->result();  
	   
	    
	   // $query=$this->db->query("select * from recomendation where userid='".$userid."'")->result();  //echo $this->db->last_query();
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	            $queries = $this->db->query("select * from requirements where  id='".$val_data->requirement_id."'")->row();   //status = '2' AND
	            
	            
	            
	            if(isset($queries))
	            {
	               $get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$queries->user_id)->get('user')->row();
	               
	               $get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->requirement_id))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	               
	               if($get_datas->req_user_status_statusid == '12' OR $get_datas->req_user_status_statusid == '13' OR $get_datas->req_user_status_statusid == '14')
	               {
	                  $icon = base_url().'upload/deal/DealClose.png'; 
	               }
	               else
	               {
	                   $icon = base_url().'upload/deal/DealCompleted.png'; 
	               }
	              
	              
	              $querygetdatas = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$val_data->requirement_id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	               $dataarrays = array();
            	   foreach($querygetdatas as $valquerygetdata)
            	   {
            	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
            	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
            	       
            	   }
            	   
            	   $data_implodes = implode(",",$dataarrays);
            	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (in_array("3", $data_explode)){
	              
	                
	              
	              
	               $query_data[] = array(
	                    "id"=> $queries->id,
                        "user_id"=> $queries->user_id,
                        "user_name"=> $get_user->full_name,
                        "user_profile"=> $get_user->profile_pic,
                        "functional_area_id"=> $queries->functional_area_id,
                        "title"=> $queries->title,
                        "description"=> $queries->description,
                        "address"=> $queries->address,
                        "thumbnil"=> empty($queries->thumbnil)?'':base_url().'upload/requirements/'.$queries->thumbnil,
                        "created_date"=> $queries->created_date,
                        "created_time"=> $queries->created_time,
                        "status"=> $queries->status,
                        "doe"=> $queries->doe,
                        "icon"=>$icon,
                        "filterdate"=> date('Y-m-d', strtotime($queries->created_date)),
                           "is_viewed"=>$this->check_lead_visibility($userid,$queries->id),
                           'is_user_viewed'=>$this->check_user_visibility($userid,$queries->user_id),
                   ); 
	            } }
	            
	        }
	        
	  
	        array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $query_data), SORT_DESC, $query_data);

             return $query_data;
	        
	       // return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	
	public function get_all_leads($userid){
	    $query=$this->db->query("select * from requirements where user_id!='".$userid."' AND status='1' order by id DESC")->result();
	   
	    $dattty=array();
	    if(isset($query) && !empty($query)){
	        $check_in_usertble = $this->db->where('id',$userid)->get('user')->row();
	    $package_info1 = $this->db->where(array('user_id'=>$userid,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$userid,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	    
            $str = explode(',',$user_consumption->type_id);
	        
	        
	        foreach($query as $roww){
	            $userrr=$roww->user_id;
	            //get user details
	            $userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            
	            $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$roww->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	            $dataarrays = array();
            	foreach($querygetdata as $valquerygetdata)
            	{
            		       $dataarrays[] = $valquerygetdata->req_user_status_catid;
            	}
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (!in_array("3", $data_explode)){
	            
	            
	            
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "full_name"=>$full_name,
	                    "email"=>$email,
	                    "mobile"=>$mobile,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "company_phone"=>$company_phone,
	                    "company_address"=>$company_address,
	                    "dob"=>$dob,
	                    "profile_pic"=>$profilepic,
                            "is_viewed"=>(in_array($roww->id,$str))?1:0,
                        'is_user_viewed'=>$this->check_user_visibility($userid,$userrr),
	                
	                );
	                
	                array_push($dattty,$dataaaerrr);
	           }
	        }
	        
	        if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function get_all_requirementss_list(){
	    $query=$this->db->query("select * from requirements order by user_id asc")->result();
	    $dattty=array();
	    if(isset($query) && !empty($query)){
	        
	        foreach($query as $roww){
	            $userrr=$roww->user_id;
	            //get user details
	            $userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "full_name"=>$full_name,
	                    "email"=>$email,
	                    "mobile"=>$mobile,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "company_phone"=>$company_phone,
	                    "company_address"=>$company_address,
	                    "dob"=>$dob,
	                    "profile_pic"=>$profilepic
	                
	                
	                );
	                
	                array_push($dattty,$dataaaerrr);
	            
	        }
	        
	        if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	/*
	*
	*
	*/
	public function get_all_recomendation_check($user,$recom,$note,$reqi){
	    
	    //check exist or not
	    //$res=$this->db->query("select * from recomendation where userid='".$user."' and requirement_id='".$reqi."' and recomend_by='".$recom."' and ucase(recom_note)='".strtoupper($note)."'")->result();
	    
	    $res=$this->db->query("select * from recomendation where userid='".$user."' and requirement_id='".$reqi."' and recomend_by='".$recom."' ")->result();
	    if(isset($res) && !empty($res)){
	        return $res;
	        
	    }else{
	        return FALSE;
	    }
	}
	
	public function insert_recomanadte($user,$recom,$note,$reqi,$creatdate,$creattime){
	    $data_insert=array(
	            "userid"=>$user,
	            "recomend_by"=>$recom,
	            "recom_note"=>$note,
	            "requirement_id"=>$reqi,
	            "doe"=>date('Y-m-d H:i:s',strtotime($creatdate.$creattime))
	        );
	        $req_info = $this->db->where('id',$reqi)->get('requirements')->row();
	        $insertt=$this->db->insert('recomendation',$data_insert);
	        
	        if($insertt){
	             $insert_id = $this->db->insert_id();
	             $rs_email = $this->db->where('purpose', 'recommendation')->get('email_template')->row(); 
            $recommendation_info = $this->db->where('id',$insert_id)->get('recomendation')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['recommendation'] = $recommendation_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/recommendation', $data,true);
//            echo $body;
            $user_info1 = $this->db->where('id',$user)->get('user')->row();
            $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
                $user_info2 = $this->db->where('id',$recom)->get('user')->row();
            $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
//                print_r($res);
	             // `req_user_status_date`, `req_user_status_answer`, `req_user_status_time`, ``, ``, 
	             
	             
	             $leadstatus=array(
    	            "req_user_status_userid"=>$req_info->user_id,
    	            "req_user_status_addedby"=>$user,
    	            "req_user_status_reqid"=>$reqi,
    	            "req_user_status_catid"=>'1',
    	            "req_user_status_statusid"=>'1',
    	            "req_user_status_msg"=>'',
    	            "req_user_status_desc"=>'',
    	            "req_user_status_creatdate"=>date('Y-m-d',strtotime($creatdate)),
    	            "req_user_status_creatday"=>date('D', strtotime($creatdate)),
    	            "req_user_status_creattime"=>date('H:i:s',strtotime($creattime)),
    	            "req_user_status_amount"=>'',
    	        );
	        
	        
	        $res=$this->db->insert('requirements_user_status',$leadstatus);
	       
	        $recomdid = $this->db->insert_id();
	       $rs_email = $this->db->where('purpose', 'requirement_status_update')->get('email_template')->row(); 
            $requirement_status_info = $this->db->where('req_user_status_id',$recomdid)->get('requirements_user_status')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement_status'] = $requirement_status_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/requirement_status_update', $data,true);
//            echo $body;
            $req_info = $this->db->where('id',$user['requirementsid'])->get('requirements')->row();
            $user_info = $this->db->where('id',$req_info->user_id)->get('user')->row(); 
            $user_info1 = $this->db->where('id',$req_info->user_id)->get('user')->row(); 
            $user_info2 = $this->db->where('id',$user)->get('user')->row(); 
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
                $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
                $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
//                print_r($res);
	         $getleads = $this->db->select('requirements.title as reqstitle')->get_where('requirements',array('id'=>$reqi))->row();
	       
	         /*
	         'by_user_ids'=>$recom,
             'to_user_ids'=>$user,
	         */
	        
	                 $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$user,
            	            'to_user_ids'=>$recom,
            	            'subject'=>'New Recommendation',
            	            'body'=>'Lead Status Update',
            	            'request_for'=>"LeadStatus",
            	            'request_id'=>$recomdid,
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
	       
	       
	        $this->add_reward_point('RecommendedBy',$user,$creatdate,$creattime,$getleads->reqstitle); 
	             
	             //echo $this->db->last_query();
	             
	             $get_lastres=$this->db->query("select * from recomendation where id='".$insert_id."' ")->result();
	             return $get_lastres;
	        }else{
	            
	            return FALSE;
	        }
	        
	    
	}
	
	/*
	*
	*/
	public function get_recomendation_chk($recom_by,$userids,$note){
	    
	    
	    
	}
	
	/*
	*
	*
	*/
	public function get_all_recomendation_list(){
	    
	    $resss=$this->db->query("select * from recomendation order by id asc")->result();
	    $dattty=array();
	    if(isset($resss) && !empty($resss)){
	        
	        foreach($resss as $roww){
	            $userrr=$roww->userid;
	            //get user details
	            $userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "recomendation_id"=>$roww->id,
	                    "recomendation_note"=>$roww->recom_note,
	                    "full_name"=>$full_name,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "profile_pic"=>$profilepic,
	                    "recomendation_note"=>$roww->recom_note
	                
	                
	                );
	                
	                array_push($dattty,$dataaaerrr);
	            
	        }
	        
	        if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function get_all_recomendate_ee($userid,$reqid){
	    
	   $req_info = $this->db->where('id',$reqid)->get('requirements')->row();
           if($req_info->user_id == $userid)
           {
	   
	              
	              $this->db->select('userid');
	              $this->db->group_by('userid');   // recomendation.requirement_id,
	   $ressss =  $this->db->get_where("recomendation",array('requirement_id'=>$reqid))->result();
	   
	    
	   
	    if(isset($ressss) && !empty($ressss)){
	        $dattty=array();
	        $recomm_arr=array();
	        
	        foreach($ressss as $roww)
	        {
	            $userrr=$roww->userid;    
	            //get user details
	            //$userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();   
	            $userdetails=$this->db->get_where('user',array('id'=>$userrr))->row(); 
	            
	            $getrecomendation = $this->db->get_where("recomendation",array('userid'=>$userrr,'requirement_id'=>$reqid))->row();
	            
	            
	             //$userdetails=$this->db->query("select * from user where id='".$userid."'")->result();
	             //$rs=$userdetails[0];
	             $full_name=$userdetails->first_name." ".$userdetails->middle_name." ".$userdetails->last_name;
	             $email=$userdetails->email_address;
	             $mobile=$userdetails->phone;
	             $designation=$userdetails->designation;
	             $company_name=$userdetails->company;
	             $profilepic=base_url()."upload/avatar/".$userdetails->avatar;
	            
	             
	              
	              
	              $resssss=$this->db->get_where("recomendation",array('requirement_id'=>$reqid,'userid'=>$userrr))->result();
	              
	              foreach($resssss as $rowsssss)
	              {
	                  
	                  
	                  
	                   $recommeded = $rowsssss->recomend_by; 
	                   $recouserdetails=$this->db->query("select * from user where id='".$recommeded."'")->result();
    	               foreach($recouserdetails as $rec_val)
    	               {
    	                   $full_name2=$rec_val->first_name." ".$rec_val->middle_name." ".$rec_val->last_name;
            	            if(empty($full_name2) || trim($full_name2)=="" ){
            	                $full_name2="Guest User";
            	            }
    	           
            	            $designation2=$rec_val->designation;
            	            $company_name2=$rec_val->company;
            	            $profilepic2=base_url()."upload/avatar/".$rec_val->avatar;
    	            
    	                    $dataaaerrr2=array(
    	                
    	                    "recommended_user_id"=>$recommeded,
    	                    "recomendation_note"=>$rowsssss->recom_note,
    	                    "recommended_by_user_fullname"=>$full_name2,
    	                    "recommended_by_user_designation"=>$designation2,
    	                    "recommended_by_user_company"=>$company_name2,
    	                    "recommendation_note"=>$rowsssss->recom_note,
    	                    "recommended_by_user_profile_pic"=>$profilepic2,
    	                    "recomendation_date"=>$rowsssss->doe,
    	                
    	                
    	                );
    	                
    	                    array_push($recomm_arr,$dataaaerrr2);
    	               }
	              }
	              
	               
	            
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "recomended_by"=>$recomm_arr,
	                    "full_name"=>$full_name,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "profile_pic"=>$profilepic,
	                    "recomendation_note"=>$getrecomendation->recom_note,
	                     "recomendation_date"=>$getrecomendation->doe,
                            'is_viewed'=>$this->check_user_visibility($userid,$userrr)
	                
	                );$recomm_arr=array();
	        
	        array_push($dattty,$dataaaerrr);
	            
	            
	        }
                if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
            }else{
	        
	        return FALSE;
	    }
	          //exit();
  
	    }
            else
            {
                $reco_info = $this->db->where(array('recomend_by'=>$userid,'requirement_id'=>$reqid))->get('recomendation')->result();
                if(!empty($reco_info))
                {
                     $this->db->select('userid');
	              $this->db->group_by('userid');   // recomendation.requirement_id,
	   $ressss =  $this->db->get_where("recomendation",array('requirement_id'=>$reqid,'recomend_by'=>$userid))->result();
	   
	    
	   
	    if(isset($ressss) && !empty($ressss)){
	        $dattty=array();
	        $recomm_arr=array();
	        
	        foreach($ressss as $roww)
	        {
	            $userrr=$roww->userid;    
	            //get user details
	            //$userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();   
	            $userdetails=$this->db->get_where('user',array('id'=>$userrr))->row(); 
	            
	            $getrecomendation = $this->db->get_where("recomendation",array('userid'=>$userrr,'requirement_id'=>$reqid))->row();
	            
	            
	             //$userdetails=$this->db->query("select * from user where id='".$userid."'")->result();
	             //$rs=$userdetails[0];
	             $full_name=$userdetails->first_name." ".$userdetails->middle_name." ".$userdetails->last_name;
	             $email=$userdetails->email_address;
	             $mobile=$userdetails->phone;
	             $designation=$userdetails->designation;
	             $company_name=$userdetails->company;
	             $profilepic=base_url()."upload/avatar/".$userdetails->avatar;
	            
	             
	              
	              
	              $resssss=$this->db->get_where("recomendation",array('requirement_id'=>$reqid,'userid'=>$userrr))->result();
	              
	              foreach($resssss as $rowsssss)
	              {
	                  
	                  
	                  
	                   $recommeded = $rowsssss->recomend_by; 
	                   $recouserdetails=$this->db->query("select * from user where id='".$recommeded."'")->result();
    	               foreach($recouserdetails as $rec_val)
    	               {
    	                   $full_name2=$rec_val->first_name." ".$rec_val->middle_name." ".$rec_val->last_name;
            	            if(empty($full_name2) || trim($full_name2)=="" ){
            	                $full_name2="Guest User";
            	            }
    	           
            	            $designation2=$rec_val->designation;
            	            $company_name2=$rec_val->company;
            	            $profilepic2=base_url()."upload/avatar/".$rec_val->avatar;
    	            
    	                    $dataaaerrr2=array(
    	                
    	                    "recommended_user_id"=>$recommeded,
    	                    "recomendation_note"=>$rowsssss->recom_note,
    	                    "recommended_by_user_fullname"=>$full_name2,
    	                    "recommended_by_user_designation"=>$designation2,
    	                    "recommended_by_user_company"=>$company_name2,
    	                    "recommendation_note"=>$rowsssss->recom_note,
    	                    "recommended_by_user_profile_pic"=>$profilepic2,
    	                    "recomendation_date"=>$rowsssss->doe,
    	                
    	                
    	                );
    	                
    	                    array_push($recomm_arr,$dataaaerrr2);
    	               }
	              }
	              
	               
	            
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "recomended_by"=>$recomm_arr,
	                    "full_name"=>$full_name,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "profile_pic"=>$profilepic,
	                    "recomendation_note"=>$getrecomendation->recom_note,
	                     "recomendation_date"=>$getrecomendation->doe,
                            'is_viewed'=>$this->check_user_visibility($userid,$userrr)
	                
	                );$recomm_arr=array();
	        
	        array_push($dattty,$dataaaerrr);
	            
	            
	        }
                if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
            }else{
	        
	        return FALSE;
	    }
                }
                else
                {
                    $this->db->select('userid');
	              $this->db->group_by('userid');   // recomendation.requirement_id,
	   $ressss =  $this->db->get_where("recomendation",array('requirement_id'=>$reqid,'userid'=>$userid))->result();
	   
	    
	   
	    if(isset($ressss) && !empty($ressss)){
	        $dattty=array();
	        $recomm_arr=array();
	        
	        foreach($ressss as $roww)
	        {
	            $userrr=$roww->userid;    
	            //get user details
	            //$userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();   
	            $userdetails=$this->db->get_where('user',array('id'=>$userrr))->row(); 
	            
	            $getrecomendation = $this->db->get_where("recomendation",array('userid'=>$userrr,'requirement_id'=>$reqid))->row();
	            
	            
	             //$userdetails=$this->db->query("select * from user where id='".$userid."'")->result();
	             //$rs=$userdetails[0];
	             $full_name=$userdetails->first_name." ".$userdetails->middle_name." ".$userdetails->last_name;
	             $email=$userdetails->email_address;
	             $mobile=$userdetails->phone;
	             $designation=$userdetails->designation;
	             $company_name=$userdetails->company;
	             $profilepic=base_url()."upload/avatar/".$userdetails->avatar;
	            
	             
	              
	              
	              $resssss=$this->db->get_where("recomendation",array('requirement_id'=>$reqid,'userid'=>$userrr))->result();
	              
	              foreach($resssss as $rowsssss)
	              {
	                  
	                  
	                  
	                   $recommeded = $rowsssss->recomend_by; 
	                   $recouserdetails=$this->db->query("select * from user where id='".$recommeded."'")->result();
    	               foreach($recouserdetails as $rec_val)
    	               {
    	                   $full_name2=$rec_val->first_name." ".$rec_val->middle_name." ".$rec_val->last_name;
            	            if(empty($full_name2) || trim($full_name2)=="" ){
            	                $full_name2="Guest User";
            	            }
    	           
            	            $designation2=$rec_val->designation;
            	            $company_name2=$rec_val->company;
            	            $profilepic2=base_url()."upload/avatar/".$rec_val->avatar;
    	            
    	                    $dataaaerrr2=array(
    	                
    	                    "recommended_user_id"=>$recommeded,
    	                    "recomendation_note"=>$rowsssss->recom_note,
    	                    "recommended_by_user_fullname"=>$full_name2,
    	                    "recommended_by_user_designation"=>$designation2,
    	                    "recommended_by_user_company"=>$company_name2,
    	                    "recommendation_note"=>$rowsssss->recom_note,
    	                    "recommended_by_user_profile_pic"=>$profilepic2,
    	                    "recomendation_date"=>$rowsssss->doe,
    	                
    	                
    	                );
    	                
    	                    array_push($recomm_arr,$dataaaerrr2);
    	               }
	              }
	              
	               
	            
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "recomended_by"=>$recomm_arr,
	                    "full_name"=>$full_name,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "profile_pic"=>$profilepic,
	                    "recomendation_note"=>$getrecomendation->recom_note,
	                     "recomendation_date"=>$getrecomendation->doe,
                            'is_viewed'=>$this->check_user_visibility($userid,$userrr)
	                
	                );$recomm_arr=array();
	        
	        array_push($dattty,$dataaaerrr);
	            
	            
	        }
                if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
            }else{
	        
	        return FALSE;
	    }
                }
            }
	}
	
	
	
	public function get_all_recomendate_ee_old($userid,$reqid){
	    
	   // $ressss=$this->db->query("select * from recomendation where userid='".$userid."' and requirement_id='".$reqid."'")->result();
	   $ressss=$this->db->query("select * from recomendation where  requirement_id='".$reqid."'")->result();
	    if(isset($ressss) && !empty($ressss)){
	        $dattty=array();
	        $recomm_arr=array();
	        foreach($ressss as $roww){
	            $userrr=$roww->userid;
	            //get user details
	            $userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            //get recomended userrdetailss
	            $recouserdetails=$this->db->query("select * from user where id='".$roww->id."'")->result();
	            $rs2=$recouserdetails[0];
	            $full_name2=$rs2->first_name." ".$rs2->middle_name." ".$rs2->last_name;
	            if(empty($full_name2) || trim($full_name2)=="" ){
	                $full_name2="Guest User";
	            }
	           // $email=$rs->email_address;
	           // $mobile=$rs->phone;
	            $designation2=$rs2->designation;
	            $company_name2=$rs2->company;
	            $profilepic2=base_url()."upload/avatar/".$rs2->avatar;
	            
	            $dataaaerrr2=array(
	                
	                    "recommended_user_id"=>$roww->id,
	                    "recomendation_note"=>$roww->recom_note,
	                    "recommended_by_user_fullname"=>$full_name2,
	                    "recommended_by_user_designation"=>$designation2,
	                    "recommended_by_user_company"=>$company_name2,
	                    "recommendation_note"=>$roww->recom_note,
	                    "recommended_by_user_profile_pic"=>$profilepic2,
	                    
	                
	                
	                );
	                
	                array_push($recomm_arr,$dataaaerrr2);
	            
	        }
	        
	            $userdetails=$this->db->query("select * from user where id='".$userid."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	        
	            $dataaaerrr=array(
	                
	                    "userid"=>$userid,
	                    "recomended_by"=>$recomm_arr,
	                    "full_name"=>$full_name,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "profile_pic"=>$profilepic,
	                    "recomendation_note"=>$roww->recom_note
	                
	                
	                );
	        
	        array_push($dattty,$dataaaerrr);
	        
	        
	        if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        return FALSE;
	    }
	}
	
	public function get_all_requirement_details($requid,$userid){
	    
	    $query=$this->db->query("select * from requirements where id='".$requid."' ")->result();
	    $dattty=array();
            $userrr = 0;
	    if(isset($query) && !empty($query)){
	        
	        foreach($query as $roww){
	            $userrr=$roww->user_id;
	            //get user details
	            $userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            if(!empty($roww->referral_for))
	            {
	                $rinfo = $this->db->query("select * from user where id='".$roww->referral_for."'")->row();
	                $ref_name = $rinfo->first_name." ".$rinfo->middle_name." ".$rinfo->last_name;
	                $ref_photo = base_url()."upload/avatar/".$rinfo->avatar;
//	                $ref_chid = $rinfo->chapterid;
//	                $ref_chname = $this->getchapterid($rinfo->chapterid);
//	                $ref_membershipid = $rinfo->member_code;
	                $ref_userid = $roww->referral_for;
	                $ref_dob = $rinfo->dob;
	                if(empty($rinfo->business_category))
    	           {
    	               $ref_buss_cat = "";
    	           }
    	           else
    	           {
    	               $ref_buss_cat = "";
    	               $str = explode(',',$rinfo->business_category);
    	               $c=1;
    	               for($i=0;$i<count($str);$i++)
    	               {
    	                   $bcat_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
    	                   if(!empty($bcat_info))
    	                   {
    	                       if($c==1)
    	                       {
    	                            $ref_buss_cat = $ref_buss_cat.$bcat_info->functional_area;
    	                       }
    	                       else
    	                       {
    	                           $ref_buss_cat = $ref_buss_cat.", ".$bcat_info->functional_area;
    	                       }
    	                       $c++;
    	                   }
    	               }
    	           }
	           
	            }
	            else
	            {
	                $ref_name = "";
	                $ref_photo = "";
//	                $ref_chid = 0;
//	                $ref_chname = "";
//	                $ref_membershipid = "";
	                $ref_userid = 0;
	                $ref_dob = "";
	                $ref_buss_cat = "";
	            }
	            
	            if(empty($rs->business_category))
	           {
	               $buss_cat = "N/A";
	           }
	           else
	           {
	               $buss_cat = "";
	               $str = explode(',',$rs->business_category);
	               $c=1;
	               for($i=0;$i<count($str);$i++)
	               {
	                   $bcat_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
	                   if(!empty($bcat_info))
	                   {
	                       if($c==1)
	                       {
	                            $buss_cat = $buss_cat.$bcat_info->functional_area;
	                       }
	                       else
	                       {
	                           $buss_cat = $buss_cat.", ".$bcat_info->functional_area;
	                       }
	                       $c++;
	                   }
	               }
	           }
	           
	           if(empty($roww->functional_area_id))
	           {
	               $fa = "N/A";
	           }
	           else
	           {
	               $fa_info = $this->db->where('functional_area_id',$roww->functional_area_id)->get('tbl_functional_area')->row();
	               if(!empty($fa_info))
	               {
	                   $fa = $fa_info->functional_area;
	               }
	               else
	               {
	                   $fa = "";
	               }
	           }
//	           if(empty($roww->subfunctional_area_id))
//	           {
//	               $sfa = "N/A";
//	           }
//	           else
//	           {
//	               $sfa = "";
//	               $str = explode(',',$roww->subfunctional_area_id);
//	               $c=1;
//	               for($i=0;$i<count($str);$i++)
//	               {
//	                   $sfa_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
//	                   if(!empty($sfa_info))
//	                   {
//	                       if($c==1)
//	                       {
//	                            $sfa = $sfa.$sfa_info->functional_area;
//	                       }
//	                       else
//	                       {
//	                           $sfa = $sfa.", ".$sfa_info->functional_area;
//	                       }
//	                       $c++;
//	                   }
//	               }
//	           }
	            
	            if($userdetails[0]->membership_type == '1')
	            {
	                $membertype = 'Guest Member';
	            }
	            else
	            {
	                $membertype = 'Paid Member';
	            }
	            
	            $get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->requirement_id))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	               
	               if($get_datas->req_user_status_statusid == '12' OR $get_datas->req_user_status_statusid == '13' OR $get_datas->req_user_status_statusid == '14')
	               {
	                  $icon = base_url().'upload/deal/DealClose.png'; 
	               }
	               else
	               {
	                   $icon = base_url().'upload/deal/DealCompleted.png'; 
	               }
	            
	           // if($roww->is_referral == '1')
	           // {
	               $get_persondata = $this->db->where('referal_reqid',$roww->id)->get('referal_preson')->row(); //echo $this->db->last_query();
	               
	               
	               if($get_persondata->referal_type == '1' || $get_persondata->referal_type == '2')
	               {
	                   if($get_persondata->referal_type == '1') { $referral_type = 'My Self'; }
	                   else if($get_persondata->referal_type == '2') { $referral_type = 'Inside'; }
	                   
	                   $contact_person = $get_persondata->referal_contactperson;
	                   
//	                                   $this->db->join('user_business_info','user_profile.profile_ids = user_business_info.info_profileid','LEFT');
//	                    $get_profile = $this->db->where(array('profile_userid'=>$rs->id,'profile_isdefault'=>'1'))->get('user_profile')->row();
	                    $get_user_data = $this->db->where('id',$contact_person)->get('user')->row();          
	                   
	                   $person_name = $get_user_data->prefix.' '.$get_user_data->first_name.' '.$get_user_data->middle_name.' '.$get_user_data->last_name;
	                   $pic = base_url()."upload/avatar/".$get_user_data->avatar;
//	                   $mem_id = $get_user_data->member_code;
//	                   $cid = $get_user_data->chapterid;
//	                   $cname = $this->getchapterid($get_user_data->chapterid);
	                   $cmp_name = $get_user_data->company_name;
	                   $desgn =  $get_user_data->company_designation;
	                   $phno = $get_persondata->phone;
	                   $telno = '';
	                   $emailaddress = $get_persondata->email_address;
	                   $address = $get_persondata->referal_address;
	                   $wp_no = $get_persondata->wmobile;  
	                   if(empty($get_user_data->business_category))
        	           {
        	               $buss_cat1 = "N/A";
        	           }
        	           else
        	           {
        	               $buss_cat1 = "";
        	               $str1 = explode(',',$get_user_data->business_category);
        	               $c=1;
        	               for($i=0;$i<count($str1);$i++)
        	               {
        	                   $bcat_info1 = $this->db->where('functional_area_id',$str1[$i])->get('tbl_functional_area')->row();
        	                   if(!empty($bcat_info1))
        	                   {
        	                       if($c==1)
        	                       {
        	                            $buss_cat1 = $buss_cat1.$bcat_info1->functional_area;
        	                       }
        	                       else
        	                       {
        	                           $buss_cat1 = $buss_cat1.", ".$bcat_info1->functional_area;
        	                       }
        	                       $c++;
        	                   }
        	               }
        	           }
	                   
	               }
	               else
	               {
	                   $referral_type = 'Outside';
	                   $person_name = $get_persondata->referal_name;
	                   $cmp_name = $get_persondata->referal_cmpname;
	                   $desgn =  $get_persondata->referal_desgn;
	                   $phno = $get_persondata->referal_mobileno;
	                   $telno = $get_persondata->referal_stdcode.'-'.$get_persondata->referal_phno;
	                   $emailaddress = $get_persondata->referal_email;
	                   $address = $get_persondata->referal_address;
	                   $wp_no = $get_persondata->referal_wpno;   
	               }
	               
	               
	                $hot_rank =$get_persondata->referal_hotrank;
	                $refferal_status = array();
	                if($roww->is_referral == '1')
	            {
	                $ref_status = explode(',',$get_persondata->referal_status);
	                $rs_info = $this->db->get('referral_status')->result();
	                if(!empty($rs_info))
	                {
	                    foreach($rs_info as $val)
	                    {
	                        if(in_array($val->status_id,$ref_status))
	                        {
	                            array_push($refferal_status,array('id'=>$val->status_id,'name'=>$val->status_title,'value'=>"Yes"));
	                        }
	                        else
	                        {
	                            array_push($refferal_status,array('id'=>$val->status_id,'name'=>$val->status_title,'value'=>"No"));
	                        }
	                    }
	                }
	            }
	            
	            $dataaaerrr=array(
	                
	                     "userid"=>$userrr,
	                    "is_referral"=>$roww->is_referral,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "requirement_functional_area"=>$fa,
//	                    "requirement_subfunctional_area"=>$sfa,
	                    "requirement_address"=>$roww->address,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
//	                    "lead_chapter_id"=>$chpt_id,
//	                    "lead_chapter_name"=>$chpt_name,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "referal_given_by_full_name"=>$full_name,
	                   // "email"=>$email,
	                   // "mobile"=>$mobile,
	                   // "whatsappnumber"=>$wp_no,
	                   // "designation"=>$designation,
	                   // "company_name"=>$company_name,
	                   // "company_phone"=>$company_phone,
	                   // "company_address"=>$company_address,
	                   // "dob"=>$dob,
	                   "referal_given_by_id"=>$userdetails[0]->id,
	                    "referal_given_by_profile_pic"=>$profilepic,
	                    "referal_given_by_membership_id"=>$userdetails[0]->member_code,
//	                    "referal_given_by_chatpter_id"=> $userdetails[0]->chapterid,
//	                    "referal_given_by_chatpter_name"=> $this->getchapterid($userdetails[0]->chapterid),
	                    "referal_given_by_functional_area"=>$buss_cat,
	                    "referal_given_by_dob"=>$dob,
	                    
	                    "referal_received_by_full_name"=>$ref_name,
	                    "referal_received_by_id"=>$ref_userid,
	                    "referal_received_by_profile_pic"=>$ref_photo,
//	                    "referal_received_by_membership_id"=>$ref_membershipid,
//	                    "referal_received_by_chatpter_id"=> $ref_chid,
//	                    "referal_received_by_chatpter_name"=> $ref_chname,
	                    "referal_received_by_functional_area"=>$ref_buss_cat,
	                    "referal_received_by_dob"=>$ref_dob,
	                    
	                    "icon"=>$icon,
//	                    "chat_id" => $this->getfirebaseid($userrr),
	                    "created_by_membershiptype"=>$membertype,
	                    "membership_type"=>$userdetails[0]->membership_type,
	                    
	                    "contact_person_id"=>$contact_person,
	                    "contact_person_name"=>$person_name,
	                    "contact_person_pic"=>$pic,
//	                    "contact_person_membership_id"=>$mem_id,
//	                    "contact_person_chapter_id"=>$cid,
//	                    "contact_person_chapter_name"=>$cname,
	                    "contact_person_functional_area"=>$buss_cat1,
	                    
    	                "company_names"=>$cmp_name,
    	                "designations"=>$desgn,
    	                "mobilenumber"=>$phno,
    	                "telphno"=>$telno,
    	                "emailaddrss"=>$emailaddress,
    	                "adddress"=>$address,
    	                "whatsappnumbers"=>$wp_no,
    	                
	                    
	                    "referral_type"=>$referral_type,
	                    "refferal_hot_rank"=>$hot_rank,   
	                    "refferal_status"=>$refferal_status,
                        "whatsapp_no"=>$rs->wmobile,
                        "company_whatsapp_no"=>$rs->company_wmobile,
                        "doe_date"=>date('Y-m-d',strtotime($roww->doe)),
                        "doe_time"=>date('H:i:s',strtotime($roww->doe)),
	                );
	                
	                array_push($dattty,$dataaaerrr);
	            
	        }
	        
	        if(isset($dattty) && !empty($dattty)){
                    if(empty($query[0]->is_referral) && $userid != $userrr)
                    {
                     $useriddd=$this->db->query("select * from user where id='".$userid."'")->row();
                    $package_info1 = $this->db->where(array('user_id'=>$userid,'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption1 = $this->db->where(array('user_id'=>$userid,'package_id'=>$useriddd->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $str = explode(',',$user_consumption1->type_id);
                    if(!in_array($requid, $str))
                    {
                        $data1['used_count'] = $user_consumption1->used_count + 1;
                    }
                    if(empty($str))
                    {
                        $data1['type_id'] = $requid;
                    }
                    else
                    {
                        if(!in_array($requid, $str))
                        {
                            $data1['type_id'] = $user_consumption1->type_id.",".$requid;
                        }
                    }
                    $q = $this->db->where('id',$user_consumption1->id)->set($data1)->update('user_package_features');
                    }
	            $data['requirement_info'] = $dattty;
                    $recommendation = 0;
                    $check_in_usertble = $this->db->where('id',$userid)->get('user')->row();
                    $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>7))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>7,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $recommendation = 1;
                   }
                }                                   
            }
            $data['is_recommendation_exhausted'] = $recommendation;
	            return $data;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function get_user_exist_or_not($userid,$reviewid){
	    
	    $ress=$this->db->query("select * from user where id in('".$userid."','".$reviewid."')")->result();
	    if(isset($ress) && !empty($ress)){
	        if(count($ress)==2){
	            
	            $ress=array("status"=>TRUE,"message"=>"User Find");
	            
	        }else{
	            $idww=$ress[0]->id;
	            if($userid!=$idww){
	                $ress=array("status"=>FALSE,"message"=>"User id not found");
	                
	            }else{
	                
	                 $ress=array("status"=>FALSE,"message"=>"Reviewed id not found");
	            }
	            
	        }
	    }else{
	        
	         $ress=array("status"=>FALSE,"message"=>"User Id and Reviewed Id not found");
	    }
	    
	    return $ress;
	}
	
	public function check_review_ratings_ex($userid,$reviewid){
	    
	    $qrr=$this->db->query("select * from ratings_reviews where status = '1' AND user_id='".$userid."' and reviewed_by='".$reviewid."'")->result();
	    if(isset($qrr) && !empty($qrr)){
	        
	         $ress=array("status"=>TRUE,"id"=>$qrr[0]->id);
	    }else{
	        
	         $ress=array("status"=>FALSE,"id"=>"null");
	        
	        
	    }
	    
	    return $ress;
	    
	}
	public function insert_ratings_review($userdata){
	    
	    $data_insert=array(
	            "user_id"=>$userdata['userid'],
	            "reviewed_by"=>$userdata['reviewed_by'],
	            "ratings"=>$userdata['ratings'],
	            "review_note"=>$userdata['review_note'],
	            "review_date"=>date('Y-m-d',strtotime($userdata['date'])),
	            "review_time"=>date('H:i:s',strtotime($userdata['time'])),
	            
	        );
	        
	     $this->db->insert('ratings_reviews',$data_insert); 
	      $insert_id = $this->db->insert_id();
	      
	      $getusername = $this->getusernames($userdata['reviewed_by']);
	      $getrewardusername = $this->getusernames($userdata['userid']);
	      
	      $this->add_reward_point('TestimonialShared',$userdata['userid'],$userdata['date'],$userdata['time'],$getrewardusername);
	      $this->add_reward_point('TestimonialReceived',$userdata['reviewed_by'],$userdata['date'],$userdata['time'],$getusername);
	      $useriddd=$this->db->query("select * from user where id='".$userdata['userid']."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$userdata['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$userdata['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>8,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
	      return $insert_id;
	        
	    
	}
	
	
	public function getusernames($userids)
	{
	    $get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name")->where('id',$userids)->get('user')->row();  
	    return $get_user->full_name;
	}
	
	
	public function get_user_ratings_data($user_rating_rev){
	    
	    $result=$this->db->query("select id,user_id,reviewed_by,ratings,review_note from  ratings_reviews where status = '1' AND id='".$user_rating_rev."' ORDER BY id desc")->result();
	    
	    /*foreach($result as $valdata)
	    {
	        $data_array[] = array(
	            'id'=>$valdata->,
	            'user_id'=>$valdata->,
	            'reviewed_by'=>$valdata->,
	            'ratings'=>$valdata->,
	            'review_note'=>$valdata->,
	            );
	    }*/
	    
	    return $result;
	    
	}
	
	public function update_ratings_review($userdata,$ratings_idd){
	    
	      $data_update=array(
	            "user_id"=>$userdata['userid'],
	            "reviewed_by"=>$userdata['reviewed_by'],
	            "ratings"=>$userdata['ratings'],
	            "review_note"=>$userdata['review_note'],
	            "review_date"=>date('Y-m-d',strtotime($userdata['date'])),
	            "review_time"=>date('H:i:s',strtotime($userdata['time'])),
	        );
	        
	        $this->db->where('id',$ratings_idd);
	        $ressttt=$this->db->update('ratings_reviews',$data_update);
	        if($ressttt==TRUE){
	            
	            $result=$this->db->query("select id,user_id,reviewed_by,ratings,review_note from ratings_reviews where status = '1' AND id='".$ratings_idd."'")->result();
	            $ress=array("status"=>TRUE,"message"=>$result);
	            
	        }else{
	            
	            $ress=array("status"=>FALSE,"message"=>"");
	            
	            
	        }
	        
	        return $ress;
	    
	    
	}
	
	public function check_user_ratings_exist_or_not($userid){
	    
	   // $qrr=$this->db->query("select * from ratings_reviews where status = '1' AND reviewed_by='".$userid."'")->result();    //user_id='".$userid."'"
	   $qrr=$this->db->query("select * from ratings_reviews where status = '1' AND user_id='".$userid."' ORDER BY `id` DESC")->result();    //user_id='".$userid."'"
	    if(isset($qrr) && !empty($qrr)){
	        
	         $ress=array("status"=>TRUE,"message"=>$qrr);
	    }else{
	        
	         $ress=array("status"=>FALSE,"message"=>"null");
	        
	        
	    }
	    
	    return $ress;
	    
	}
	
	public function check_user_exist_or_not($userid){
	    
	    $qry=$this->db->query("select * from user where id='".$userid."'")->result();
	    if(isset($qry) && !empty($qry)){
	        
	        $result=array("status"=>TRUE,"data"=>$qry);
	        
	    }else{
	        
	        $result=array("status"=>FALSE,"data"=>"");
	    }
	    return $result;
	}
	
	public function check_user_exist_or_not_recomendation($userid,$requirementid){
	    
	    $qry=$this->db->query("select * from recomendation where userid='".$userid."' AND requirement_id='".$requirementid."' ")->result();
	    if(isset($qry) && !empty($qry)){
	        
	        $result=array("status"=>TRUE,"data"=>'Yes');
	        
	    }else{
	        
	        $result=array("status"=>FALSE,"data"=>"No");
	    }
	    return $result;
	}
	
	public function get_user_profile_gallery($userid,$type){
	    $qry=$this->db->query("select * from gallery where gallery_type='".$type."' and user_id='".$userid."' and status='1'")->result();
	    if(isset($qry) && !empty($qry)){
	        
	        $result=array("status"=>TRUE,'data'=>$qry);
	        
	        
	    }else{
	       $result=array("status"=>FALSE,'data'=>"select * from gallery where gallery_type='".$type."' and user_id='".$userid."'");
	         
	        
	        
	    }
	    
	    return $result;
	}
	
	public function view_profile_gallery_field_builder($viewgallery,$user_id){
	    $gallerydata=array();
	    foreach($viewgallery as $roww){
	        
	        $gallerydata[]=array("userid"=>$roww->user_id,"imageid"=>$roww->id,"image_link"=>base_url().'upload/gallery/profile/'.$roww->image);
	        
	    }
//	    return $gallerydata;
            $data = array();
            $data['gallery_info'] = $gallerydata;
            $recommendation = 0;
                    $check_in_usertble = $this->db->where('id',$user_id)->get('user')->row();
                    $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>5))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>5,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $recommendation = 1;
                   }
                }                                   
            }
            $data['is_gallery_exhausted'] = $recommendation;	
				return $data;
	}
	
	public function delete_image_gallery($galryid,$userid){
	    
	             $this->db->where('id',$galryid);
	             $this->db->where('user_id',$userid);
	             $this->db->set('status','2');
	        
	        $ress=$this->db->update('gallery'); //echo $this->db->last_query();
	        if($ress==TRUE){
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	public function upload_gallery_images($userid,$gallerytpe,$filen){
	    
	    //check already upload or  not
	    $checkgg=$this->db->query("select * from gallery where image='".$filen."' and user_id='".$userid."' and gallery_type='".$gallerytpe."' and status='1'")->result();
	    if(isset($checkgg) && !empty($checkgg)){
	        
	        
	    }else{
	        
	        $q1 = $this->db->insert('gallery',array("user_id"=>$userid,"gallery_type"=>$gallerytpe,"image"=>$filen));
                    $useriddd=$this->db->query("select * from user where id='".$userid."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$userid,'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$userid,'package_id'=>$useriddd->packages_id,'feature_id'=>5,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
	    }
	    
	    
	}
	
	

	
	public function app_user_add_lead_status($user){
	    
	    
	    $leadstatus=array(
	            "req_user_status_userid"=>$user['userid'],
	            "req_user_status_addedby"=>$user['addedby'],
	            "req_user_status_reqid"=>$user['requirementsid'],
	            "req_user_status_catid"=>$user['catid'],
	            "req_user_status_statusid"=>$user['statusid'],
	            "req_user_status_msg"=>$user['msg'],
	            "req_user_status_desc"=>'',
	            "req_user_status_date"=>date('Y-m-d',strtotime($user['date'])),
	            "req_user_status_answer"=>$user['answer'],
	            "req_user_status_time"=>date('H:i:s',strtotime($user['time'])),
	            "req_user_status_amount"=>$user['amount'],
	            "req_user_status_creatdate"=>date('Y-m-d',strtotime($user['creatdate'])),
	            "req_user_status_creattime"=>date('H:i:s',strtotime($user['creattime'])),
	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
	        );
	        
	        
	        
	        $res=$this->db->insert('requirements_user_status',$leadstatus);
	        $insids = $this->db->insert_id();
	        $last_status_id = $this->db->insert_id();
	        if($res==TRUE){
	            $rs_email = $this->db->where('purpose', 'requirement_status_update')->get('email_template')->row(); 
            $requirement_status_info = $this->db->where('req_user_status_id',$insids)->get('requirements_user_status')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement_status'] = $requirement_status_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/requirement_status_update', $data,true);
//            echo $body;
            $req_info = $this->db->where('id',$user['requirementsid'])->get('requirements')->row();
            $user_info = $this->db->where('id',$req_info->user_id)->get('user')->row(); 
            $user_info1 = $this->db->where('id',$user['userid'])->get('user')->row(); 
            $user_info2 = $this->db->where('id',$user['addedby'])->get('user')->row(); 
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
                $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
                $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
//                print_r($res);
                    
                    
	            $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$user['userid'],
            	            'to_user_ids'=>$user['addedby'],
            	            'subject'=>'Lead Status Update',
            	            'body'=>'Lead Status Update',
            	            'request_for'=>"LeadStatus",
            	            'request_id'=>$last_status_id,
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
	            
	            
	            
	            
	            
	            if($leadstatus['req_user_status_catid'] == '2')
	            {
	                $getreqcheck = $this->db->get_where('requirements_user_status',array('req_user_status_reqid'=>$user['requirementsid'],$leadstatus['req_user_status_catid'] == '2'));
	                if($getreqcheck->num_rows() == '0')
	                {
	                    $getusername = $this->getusernames($user['addedby']);
	                   $this->add_reward_point('LeadsReceived',$user['userid'],$user['creatdate'],$user['creattime'],$getusername);   
	                }
	            }
	            
	            
	            
	            if($leadstatus['req_user_status_catid'] == '2' && ( $leadstatus['req_user_status_statusid'] == '7'))
	            {
	                
	                
	                
	                $check_data = $this->db->where(array('req_user_status_userid'=>$user['userid'],'req_user_status_reqid'=>$user['requirementsid'],'req_user_status_statusid'=>$user['statusid']))->get('requirements_user_status');
	                
	               // echo $check_data->num_rows();exit();
	                
	                //if($check_data->num_rows() != '0')
	                //{
	                    $result = $check_data->result();
	                    $total_amount = '0';
	                    foreach($result as $key=>$val_leadstatus)
	                    {
	                        
	                            $total_amount += $val_leadstatus->req_user_status_amount;
	                            
	                    }
	                    
	                    if($total_amount != 0)
	                    {   
	                        //$this->db->set('req_user_status_amount',$total_amount)->where('req_user_status_id',$insids)->update('requirements_user_status');
	                        $leadstatusdata=array(
                	            "req_user_status_userid"=>$user['userid'],
                	            "req_user_status_addedby"=>$user['addedby'],
                	            "req_user_status_reqid"=>$user['requirementsid'],
                	            "req_user_status_catid"=>'2',
                	            "req_user_status_statusid"=>'8',
                	            "req_user_status_msg"=>'',
                	            "req_user_status_desc"=>'',
                	            "req_user_status_date"=>date('Y-m-d',strtotime($user['date'])),
                	            "req_user_status_answer"=>'',
                	            "req_user_status_time"=>date('H:i:s',strtotime($user['time'])),
                	            "req_user_status_amount"=>$total_amount,
                	            "req_user_status_creatdate"=>date('Y-m-d',strtotime($user['creatdate'])),
                	            "req_user_status_creattime"=>date('H:i:s',strtotime($user['creattime'])),
                	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
                	        );
	            	        $this->db->insert('requirements_user_status',$leadstatusdata);
	                    }
	                    else
	                    {
	                        $leadstatusdata=array(
                	            "req_user_status_userid"=>$user['userid'],
                	            "req_user_status_addedby"=>$user['addedby'],
                	            "req_user_status_reqid"=>$user['requirementsid'],
                	            "req_user_status_catid"=>'2',
                	            "req_user_status_statusid"=>'8',
                	            "req_user_status_msg"=>'',
                	            "req_user_status_desc"=>'',
                	            "req_user_status_date"=>date('Y-m-d',strtotime($user['date'])),
                	            "req_user_status_answer"=>'',
                	            "req_user_status_time"=>date('H:i:s',strtotime($user['time'])),
                	            "req_user_status_amount"=>$user['amount'],
                	            "req_user_status_creatdate"=>date('Y-m-d',strtotime($user['creatdate'])),
                	            "req_user_status_creattime"=>date('H:i:s',strtotime($user['creattime'])),
                	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
                	        );
	            	        $this->db->insert('requirements_user_status',$leadstatusdata);
	                    }
	                    
	                    
	                    
	                     
	                     $getdata = $this->db->get_where('requirements',array('id'=>$user['requirementsid']))->row();
	                     
	                     if($getdata->user_id == $user['addedby'])
	                     {
	                         $useridss = $user['userid'];
	                     }
	                     else
	                     {
	                         $useridss = $user['addedby']; 
	                     }
	                     
	                     
	                     $reqids = $user['requirementsid'];
	                     $reqid_user = $getdata->user_id;
	                    
	                      //$user['requirementsid']         
               	                    
	                    $getbusinesstrans = $this->db->where(array('bns_trans_reqid'=>$last_status_id,'bns_trans_mode'=>'Online','bns_trans_byuser'=>$reqid_user,'bns_trans_touser'=>$useridss))->get('business_transaction');
	                    
	                    //echo $this->db->last_query();exit();
	                    
	                    /*
	                    if($getbusinesstrans->num_rows() == '0')
	                    {
	                     */
	                     
	                    
	                     
	                     
	                    // echo $useridss;
	                     
	                     
	                     $data_insert=array(
            	           "bns_trans_type"=>'Given',
            	           "bns_trans_mode"=>'Online',
            	           "bns_trans_reqid"=>$last_status_id,
            	           "bns_trans_touser"=>$useridss, 
            	           "bns_trans_byuser"=>$reqid_user,
            	           "bns_trans_amount"=>$user['amount'],
            	           //"bns_trans_title"=>$reqq['title'],
            	           //"bns_trans_remark"=>$reqq['remark'],
            	           "bns_trans_date"=>date('Y-m-d',strtotime($user['creatdate'])),
            	           "bns_trans_status"=>'1',
            	           
            	        );
            	        
            	        //print_r($data_insert);exit();
            	        
            	        $ress=$this->db->insert('business_transaction',$data_insert); 
            	        $id = $this->db->insert_id();
            	        $currenttime =  date('g:i A');
            	        $currentdate = date('d M Y'); 
            	        
            	        $getusername = $this->getusernames($user['addedby']);
	                    $getrewardusername = $this->getusernames($user['userid']);
            	        
            	        $this->add_reward_point('BusinessShared',$user['userid'],$currentdate,$currenttime,$getusername);   
            	        $this->add_reward_point('BusinessReceived',$user['addedby'],$currentdate,$currenttime,$getrewardusername);   
            	        
                        $rs_email = $this->db->where('purpose', 'business_transaction')->get('email_template')->row(); 
            $transaction_info = $this->db->where('bns_trans_id',$id)->get('business_transaction')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['transaction'] = $transaction_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/business_transaction', $data,true);
//            echo $body;
            if(!empty($transaction_info->bns_trans_byuser))
            {
                $user_info1 = $this->db->where('id',$transaction_info->bns_trans_byuser)->get('user')->row();
            $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
            }
            if(!empty($transaction_info->bns_trans_touser))
            {
                $user_info2 = $this->db->where('id',$transaction_info->bns_trans_touser)->get('user')->row();
            $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
            }
//                print_r($res);
                        
            	        /*
	                    }
	                    else
	                    {
	                        $result = $getbusinesstrans->row();
	                        
	                       
	                        $data_insert=array(
                	           
                	           "bns_trans_amount"=>$total_amount,
                	          
                	           "bns_trans_date"=>$user['creatdate'],
                	           
                	           
                	        );
                	        
                	        //echo $result->bns_trans_id;exit();
                	        
                	        $this->db->where('bns_trans_id',$result->bns_trans_id)->update('business_transaction',$data_insert);  
	                    }*/
	                    
	                    
	                //}
	                
	                
	                
	                
	             }
	            
	            
	            
	            
	            //	            if($leadstatus['req_user_status_catid'] == '3' && ( $leadstatus['req_user_status_statusid'] == '12' OR $leadstatus['req_user_status_statusid'] == '14' OR $leadstatus['req_user_status_statusid'] == '15'))
//	            {
////                        $getdata = $this->db->get_where('requirements',array('id'=>$user['requirementsid']))->row();
////                        if($user['addedby'] == $getdata->user_id)
////                        {
//	                $this->db->set('status','2');
//	                $this->db->where('id',$leadstatus['req_user_status_reqid']);
//	                $this->db->update('requirements');
////                        }
//	                $leadstatus=array(
//                	            "req_user_status_userid"=>$user['userid'],
//                	            "req_user_status_addedby"=>$user['addedby'],
//                	            "req_user_status_reqid"=>$user['requirementsid'],
//                	            "req_user_status_catid"=>$user['catid'],
//                	            "req_user_status_statusid"=>'16',
//                	            "req_user_status_msg"=>'',
//                	            "req_user_status_desc"=>'',
//                	            "req_user_status_creatdate"=>$user['creatdate'],
//                	            "req_user_status_creattime"=>$user['creattime'],
//                	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
//                	        );
//	        
//	                 $this->db->insert('requirements_user_status',$leadstatus);
//	             }
	            
	            if($leadstatus['req_user_status_catid'] == '3' && ( $leadstatus['req_user_status_statusid'] == '13'))
	            {
//                        $getdata = $this->db->get_where('requirements',array('id'=>$user['requirementsid']))->row();
//                        if($user['addedby'] == $getdata->user_id)
//                        {
	                $this->db->set('status','2');
	                $this->db->where('id',$leadstatus['req_user_status_reqid']);
	                $this->db->update('requirements');
//                        }
	                $leadstatus=array(
                	            "req_user_status_userid"=>$user['userid'],
                	            "req_user_status_addedby"=>$user['addedby'],
                	            "req_user_status_reqid"=>$user['requirementsid'],
                	            "req_user_status_catid"=>$user['catid'],
                	            "req_user_status_statusid"=>'16',
                	            "req_user_status_msg"=>'',
                	            "req_user_status_desc"=>'',
                	            "req_user_status_creatdate"=>$user['creatdate'],
                	            "req_user_status_creattime"=>$user['creattime'],
                	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
                	        );
	        
	                 $this->db->insert('requirements_user_status',$leadstatus);
	             }
	            
	            
	            
	            
	            return TRUE;
	            
	        }else{
	            return FALSE;
	            
	        }
	    
	}
	
	
	public function app_get_notification_count($userid)
	{
	    $post_count = $this->db->where('post_status','1')->get("postdetail")->num_rows(); 
	    $event_count = $this->db->where('event_status','1')->where('event_date >=',date('Y-m-d'))->get("events")->num_rows(); 
	    //$lead_count = $this->db->where('requirements_status','1')->get("requirements")->num_rows(); 
	    $buddy_count = $this->db->where('user_id',$userid)->get("buddies")->num_rows(); 
	    $notificat_count = $this->db->where('by_user_ids',$userid)->order_by('id','DESC')->get('notification')->num_rows(); 
	    $get_connection_sent_request=$this->db->query("select * from connection where request_to='".$userid."'")->num_rows();
		$get_connection_receive_request=$this->db->query("select * from connection where request_from='".$userid."'")->num_rows();
	    
	    $lead_count = count($this->get_all_leads($userid));
	    
	    
	                     $this->db->select('user.role_ids,module_permission.create_per');
	                     $this->db->join('module_permission','module_permission.role_id = user.role_ids','INNER');
	    $get_user_data = $this->db->where('menu_id','5')->where('id',$userid)->get('user')->row();
	    
	    
	    
	    $data_array = array(
	        'post_count'=>$post_count,
	        'event_count'=>$event_count,
	        'lead_count'=>$lead_count,
	        'buddy_count'=>$buddy_count,
	        'notificat_count'=>$notificat_count,
	        'connection_sent_count'=>$get_connection_sent_request,
	        'connection_receive_count'=>$get_connection_receive_request,
	        'add_permission'=>$get_user_data->create_per,
	        );
	   return  $data_array;    
	    
	}
	
	
	
	
	
	public function get_app_get_lead_status($userid,$requirementsid){
	    $query=$this->db->query("select * from requirements_user_status where (req_user_status_userid ='".$userid."' OR req_user_status_addedby ='".$userid."')  AND req_user_status_reqid ='".$requirementsid."'")->result(); //AND requirements_status='1'
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	
		public function get_app_confirm_business_transaction($businessid){
	    
	    $this->db->set('bns_trans_status','2');
	    $this->db->where('bns_trans_id',$businessid);
	    $this->db->update('business_transaction');
	    
	    
	    $get_data = $this->db->where('bns_trans_id',$businessid)->get('business_transaction')->row();
	    
	    $this->db->set('lead_status','2');
	    $this->db->where('lead_id',$get_data->bns_trans_reqid);
	    $this->db->update('offline_lead');
	    
	    $notification = array(
                	            'ids'=>my_random(),
                	            'by_user_ids'=>$get_data->bns_trans_touser,
                	            'to_user_ids'=>$get_data->bns_trans_byuser,
                	            'subject'=>'Business Transaction Confirm',
                	            'body'=>'Offline Business Transaction Request',
                	            'request_for'=>"BusinessTransaction",
                	            'request_id'=>$businessid,
                	            'is_read' => '0',
                	            
                	            );
                	     $this->add_notification($notification);   
	    
	     
	    
	    
	    return TRUE;
	    
	}
	
	
	
	
	
	
	public function get_app_get_lead_status_fileds_builder($rs,$userid){
	    
	    /*'message' => array()*/
	    
	    foreach($rs as $val)
	    {
	        
	        
	        
	   if($val->req_user_status_statusid == '8' || $val->req_user_status_statusid == '7')
	   {
	       if($val->req_user_status_statusid == '8')
               {
                   $req_info = $this->db->where('id',$val->req_user_status_reqid)->get('requirements')->row();
                   if($userid == $req_info->user_id)
                   {
                        $msg = $val->req_user_status_msg.' '.$val->req_user_status_amount;
                   }
                   else
                   {
                       $total = 0;
                       $info = $this->db->where(array('req_user_status_id <'=>$val->req_user_status_id,'req_user_status_reqid'=>$val->req_user_status_reqid,'req_user_status_addedby'=>$userid,'req_user_status_statusid'=>7))->get('requirements_user_status')->result();
                       if(!empty($info))
                       {
                           foreach($info as $val1)
                           {
                               $total = $total + $val1->req_user_status_amount;
                           }
                       }
                       $msg = $val->req_user_status_msg.' '.$total;
                   }
               }
               else
               {
                    $msg = $val->req_user_status_msg.' '.$val->req_user_status_amount;
               }
	   }
	   
	   else
	   {
	       $msg = $val->req_user_status_msg;
	   }
	   
	     if($val->req_user_status_date != '')
	     {
	         $datenew = str_replace('/', '-', $val->req_user_status_date);
	         $newDates = date("d M Y", strtotime($datenew));
	     }
	     else
	     {
	        $newDates = $val->req_user_status_creatdate; 
	     }
	     
	     if($val->req_user_status_time != '')
	     {
	         
	         $newtimes = $val->req_user_status_time;
	     }
	     else
	     {
	        $newtimes = $val->req_user_status_creattime;//date("G:i", strtotime($val->req_user_status_creattime));  
	     }
	     
	     
	        
	    $result_data[] = array(
		  
		    'status_name'=>$this->get_lead_status_detail($val->req_user_status_statusid),
		    'status_catid'=>$val->req_user_status_catid,
		    'status_msg'=>$msg,
		    'status_date'=> $newDates, //,
		    'status_time'=>$newtimes,
		    'status_day'=>$val->req_user_status_creatday,
		    //'status_date'=>$val->req_user_status_creatdate,
		    //'status_time'=>$val->req_user_status_creattime,
		    'status_day'=>$val->req_user_status_creatday,
		    
		    
		  	  
		);
	    }
	    
	    return $result_data;
	    
	}
	
	public function get_lead_status_detail($leadstatusid)
	{
	    $query = $this->db->where('req_status_id',$leadstatusid)->get('requirements_status')->row();
	    return $query->req_status_title;
	}
	
	
	public function add_notification($notification)
	{
	    $this->db->insert('notification',$notification);
	    $notifyid =$this->db->insert_id();
	    
	    date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d H:i:s');
	    $this->db->set('created_time',$date);
	    $this->db->where('id',$notifyid);
	    $this->db->update('notification');
	    $this->checkcodefcm_post($notifyid);
	}
	
	public function checkcodefcm_post($notifyid)
     {
        
        $notifydata = $this->db->get_where('notification',array('id'=>$notifyid))->row();       
        
        $by_user =$notifydata->by_user_ids;
        $from_user =$notifydata->to_user_ids;
        $sellerdata = $this->db->get_where('user',array('id'=>$by_user))->row(); 
        
        
        
               
           
               $visitorid = $from_user;
               $notifydate = $notifydata->created_time;
               $notifytime = $notifydata->created_time;
               $title = $notifydata->subject;
               $msg = $notifydata->body;  
               $username = $from_user;  

                $visitordata = $this->db->get_where('user',array('id'=>$visitorid))->row();  
                $visitorname = $visitordata->first_name;
                $visitorprofile = base_url().'upload/avatar/'.$visitordata->avatar;
       
       $request_for = $notifydata->request_for;    
	      
       
       
       
       if($request_for == 'Connection')
	    {
	        $req_id = $notifydata->request_id;
	       $buddydata = $this->db->get_where('connection',array('id'=>$req_id))->row();
	       $userids = $buddydata->request_from;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	    
	    elseif($request_for == 'Followup')
	    {
	        $req_id = $notifydata->request_id;
	       $buddydata = $this->db->get_where('followup',array('followup_id'=>$req_id))->row();
	       $userids = $buddydata->followup_touserid;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	    
	    elseif($request_for == 'LeadStatus')
	    {
	       $req_id = $notifydata->request_id;
	       $requser_id = $notifydata->by_user_ids;
	       /*$reqdata = $this->db->get_where('recomendation',array('id'=>$req_id))->row();
	       $reqids = $reqdata->requirement_id; */     
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic_show")->where('id',$requser_id)->get('user')->row();
	       
	       $getimages = $getprofile->profile_pic_show;
	    }
	    
	    
	    
	    
	    
	    elseif($request_for == 'BuddyMeet')
	    {
	       $req_id = $notifydata->request_id;
	       $buddydata = $this->db->get_where('buddy_meet',array('buddy_meet_withuserid'=>$req_id))->row();
	       $userids = $buddydata->buddy_meet_withuserid;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	    
	    
	    elseif($request_for == 'Event')
	    {
	       $eventids = $notifydata->request_id;
	       $req_id = $notifydata->request_id;
	       //$eventdata = $this->db->select("CONCAT('".base_url()."upload/events/', event_thumbnil)  as event_pic")->where('event_id',$eventids)->get('events')->row();
	       
	       $eventdata = $this->db->select('event_thumbnil')->get_where('events',array('event_id'=>$eventids,"event_status"=>'1'))->row();
	       
	       if($eventdata->event_thumbnil == '')
	       {
	           $getimages = base_url().'upload/j4e.png';
	       }
	       else
	       {
	           $getimages = base_url().'upload/events/'.$eventdata->event_thumbnil; 
	       }
	       
	       
	    }
	    elseif($request_for == 'BusinessTransaction')
	    {
	       $req_id = $notifydata->request_id;
	       $getimages = base_url().'upload/j4e.png';
	      
	    }
	   
	      
	      if($getimages == '')
	      {
	          $getthumbnil = base_url().'upload/j4e.png';
	      }
	      else
	      {
	          $getthumbnil = $getimages;
	      }

       $curl = curl_init();
       $tockentake = $sellerdata->device_token;
       
       
       curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
                "to": "'.$tockentake.'",
                "notification": {
                    "title": "'.$title.'",
                    "message": "'.$msg.'",
                    "image": "'.$getthumbnil.'",
                    "sound": "audio.mp3"
                },
                "data": {
                    
                    "from_user_id": "'.$visitorid.'",
                    "body": "'.$title.'",
                    "Msg": "'.$msg.'",
                    "Date": "'.$notifydate.'",
                    "Time": "'.$notifytime.'",
                    "type": "'.$request_for.'",
		            "id": "'.$req_id.'",
		            "thumbnil": "'.$getthumbnil.'"
		    
                }
}',
  CURLOPT_HTTPHEADER => array(
    //'Authorization: key=AAAAuc1Wnwo:APA91bFnP03hGfE3EwNQYSIg8SHZRNYgEEpb7fD8tbr0jARxkCqTsOhI2f9YiuE9UmbOZBpvvWBfAz0-kw2Cen8WayxcF69EMX1FGhhXKfqJNTeb1SfW78ph8bnTfSdYknU2sgYrP7P0',
    'Authorization: key=AAAAidYY9zQ:APA91bGq1ZcpHK_YQxgHMx_pyEz8qiZE2Bh1wKXVvG2BpFlB_3VRSCYh4g5KylpIAYy7Nf4Zb_jXYGVCOfDFGyCJb6pShoHMQ2-EHIZZwil1vnUIe-A1ZDAOm3fL4tqqzAmaP5nJc7Gs',
    'Content-Type: application/json'
  ),
));
       
    

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
   }
	
	
	
	
	public function get_app_notification($userid){
	    
        $query = $this->db->where('by_user_ids',$userid)->order_by('id','DESC')->get('notification');
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_notification_fileds_builder($rs){
	    
	    /*'message' => array()*/
	    
	    foreach($rs as $val)
	    {
	       $confirm_status = 'Approved';
	       $subtitle_name = $amount = $cat_name = $lead_status = $bus_type = $note = ''; 
	   $get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name")->where('id',$val->to_user_ids)->get('user')->row();     
	   
	   $to_get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name")->where('id',$val->by_user_ids)->get('user')->row();     
	       
	   $request_for = $val->request_for;    
	      
	       
	   if($request_for == 'Connection')
	   {
	       $req_id = $val->request_id;  
	       $buddydata = $this->db->get_where('connection',array('id'=>$req_id))->row();
	       $userids = $buddydata->request_from;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	       
	       $subjects = $val->subject;
	       $subtitle_name = '';
	       $amount = '';
	       
	   }
	   elseif($request_for == 'LeadStatus')
	    {
	       $status_ids = $val->request_id;
	                            $this->db->select('requirements_user_status.*,requirements_status.req_status_title');
	                            $this->db->join('requirements_status','requirements_user_status.req_user_status_statusid = requirements_status.req_status_id','INNER');
	       $getleadstatusdata = $this->db->get_where('requirements_user_status',array('req_user_status_id'=>$status_ids))->row();
	       
	       
	       $subjects = $val->subject;
	       $req_id = $getleadstatusdata->req_user_status_reqid;
	       $requser_id = $val->by_user_ids;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic_show")->where('id',$requser_id)->get('user')->row();
	       $getimages = $getprofile->profile_pic_show;
	       
	       if($getleadstatusdata->req_user_status_catid == '1')
	       {
	           $cat_name = 'Pending';
	       }
	       elseif($getleadstatusdata->req_user_status_catid == '2')
	       {
	           $cat_name = 'Inprogress';
	       }
	       else
	       {
	           $cat_name = 'Close';
	       }
	       
	       $lead_data = $this->db->select('title')->where('id',$req_id)->get('requirements')->row();
	       $leadtitle = ucwords($lead_data->title);
	       
	       $subtitle_name = $leadtitle;
	       
	       $lead_status = $getleadstatusdata->req_status_title;
	       $note = $getleadstatusdata->req_user_status_msg;
	    }
	   
	   elseif($request_for == 'BuddyMeet')
	    {
	        $req_id = $val->request_id;  
	       $buddydata = $this->db->get_where('buddy_meet',array('buddy_meet_id'=>$req_id))->row();
	       $userids = $buddydata->buddy_meet_withuserid;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	       
	       $subjects = $val->subject;
	       $subtitle_name = $buddydata->buddy_meet_desc;
	    }
	   
	   elseif($request_for == 'Followup')
	   {
	       $req_id = $val->request_id;  
	       $buddydata = $this->db->get_where('followup',array('followup_id'=>$req_id))->row();
	       $userids = $buddydata->followup_touserid;
	       
	       $requirementids = $buddydata->followup_requirementid;
	       $reqdata = $this->db->select('title')->where('id',$requirementids)->get('requirements')->row();
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	       
	       $subjects = $val->subject;
	       $subtitle_name = $reqdata->title;
	    }
	   
	   elseif($request_for == 'Event')
	   {
	       $eventids = $val->request_id;
	       $req_id = $val->request_id;  
	       //$eventdata = $this->db->select("CONCAT('".base_url()."upload/events/', event_thumbnil)  as event_pic")->where('event_id',$eventids)->get('events')->row();
	       
	       $eventdata = $this->db->select('event_thumbnil,event_title')->get_where('events',array('event_id'=>$eventids,'event_status'=>'1'))->row();
	       
	       $subjects = $val->subject;
	       if($eventdata->event_thumbnil == '')
	       {
	           $getimages = base_url().'upload/j4e.png';
	       }
	       else
	       {
	           $getimages = base_url().'upload/events/'.$eventdata->event_thumbnil; 
	       }
	       
	       $eventtitles = ucwords($eventdata->event_title);
	       $subtitle_name = $eventtitles;
	       
	   }
	   
	   
	   elseif($request_for == 'BusinessTransaction')
	   {
	      $req_id = $val->request_id;
	      $get_bus_trans_data = $this->db->where('bns_trans_id',$req_id)->get('business_transaction')->row();
	      $busid = $get_bus_trans_data->bns_trans_reqid;
	      
	      
	      if($get_bus_trans_data->bns_trans_mode == 'Offline')
	      {
	         $subjects = "Offline Business Transaction"; 
	         $offlinelead = $this->db->where('lead_id',$busid)->get('offline_lead')->row();
	         $subtitle_name = $offlinelead->lead_title;
	         $note = $offlinelead->lead_remark;
	         $amount = $offlinelead->lead_amount;
	         $bus_type = $offlinelead->lead_type;
	         
	         if($offlinelead->lead_status == '2') { $confirm_status = 'Approved'; }  else {$confirm_status = 'Pending';}
	         
	        // $confirm_status = $offlinelead->lead_status;
	         
	      }
	      else
	      {
	        $subjects = "New Business Transaction";  
	                       $this->db->select('requirements_user_status.*,requirements.title');
	                       $this->db->join('requirements','requirements.id = requirements_user_status.req_user_status_reqid','INNER');
	         $offlinelead = $this->db->where('req_user_status_id',$busid)->get('requirements_user_status')->row();
	         $subtitle_name = $offlinelead->title;
	         $note = $offlinelead->req_user_status_msg;
	         $amount = $get_bus_trans_data->bns_trans_amount;
	         $bus_type = $get_bus_trans_data->bns_trans_type;
	         
	      }
	      
	      
	       
	         
	       $getimages = base_url().'upload/j4e.png';
	       
	      
	   }
	   
	   
	   elseif($request_for == 'InviteApproval')
	   {
	      $req_id = $val->request_id;
	                         $this->db->select('events.event_thumbnil,events.event_title,event_invite.*');
	                         $this->db->join('events','events.event_id = event_invite.event_invite_eventid','LEFT');
	      $get_invite_data = $this->db->where('event_invite_id',$req_id)->get('event_invite')->row();
	      $busid = $get_bus_trans_data->bns_trans_reqid;
	      
	      
	      
	         $subjects = "Guest Invite Approved For ".$get_invite_data->event_title; 
	         $subtitle_name = $get_invite_data->event_invite_guestname;
	         $note = '';
	         $amount = $get_invite_data->payment_amount;
	         $bus_type = '';
	         
	         if($get_invite_data->payment_id != '') { $confirm_status = 'Approved'; }  else {$confirm_status = 'Pending';}
	         
	         if($get_invite_data->event_thumbnil == '')
    	       {
    	           $getimages = base_url().'upload/j4e.png';
    	       }
    	       else
    	       {
    	           $getimages = base_url().'upload/events/'.$get_invite_data->event_thumbnil; 
    	       }
	       
	       
	      
	   }
	   
	   elseif($request_for == 'system_notification')
	   {
	       $req_id = $val->request_id;  
	       $getimages = base_url().'upload/j4e.png';
	       $subjects = $val->subject;
	       $subtitle_name = '';
	       
	   }
	   
	      
	      if($getimages == '')
	      {
	          $getthumbnil = base_url().'upload/j4e.png';
	      }
	      else
	      {
	          $getthumbnil = $getimages;
	      }
	      
	       
	        
	    $result_data[] = array(
		    'notify_id'=>$val->id,
		    'by_user'=>ucwords($get_user->full_name),
		    'subject'=>ucwords($subjects),
		    'subtitle'=>ucwords($subtitle_name),
		    'amount'=>$amount,  //$val->body,
		    'type'=>$request_for,
		    'id'=>$req_id,
		    'cat_name'=>$cat_name,
		    'lead_status'=>$lead_status,
		    'note'=>$note,
		    'business_type'=>$bus_type,
		    'thumbnil'=>$getthumbnil,
		    'is_read'=>$val->is_read,
		    'created_time'=>$val->created_time,
		    'to_user'=>ucwords($to_get_user->full_name),
		    'confirm_status'=>$confirm_status
		  	  
		);
	    }
	    
	    return $result_data;
	    
	}
	
	
	
	public function save_post_deetails($reqq,$filename){
	    
	    $data_insert=array(
	           "post_userid"=>$reqq['userid'],
	           "post_catid"=>$reqq['catid'],
	           "post_description"=>$reqq['post_description'],
	           "post_image"=>$filename,
	           "post_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "post_time"=>date('H:i:s',strtotime($reqq['created_time']))
	        );
	        
	        $ress=$this->db->insert('postdetail',$data_insert);
	        if($ress==TRUE){
                    $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from postdetail where post_id='".$insert_id."'")->row();
                    $useriddd=$this->db->query("select * from user where id='".$reqq['userid']."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$reqq['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$reqq['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>1,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
                    
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
        
        public function update_post_deetails($reqq,$filename){
	    if(!empty($filename))
            {
	    $data_insert=array(
	           "post_catid"=>$reqq['catid'],
	           "post_description"=>$reqq['post_description'],
	           "post_image"=>$filename
	        );
            }else{
              $data_insert=array(
	           "post_catid"=>$reqq['catid'],
	           "post_description"=>$reqq['post_description']
	        );  
            }   
	        $ress=$this->db->where('post_id',$reqq['post_id'])->update('postdetail',$data_insert);
	        if($ress==TRUE){
//                    $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from postdetail where post_id='".$reqq['post_id']."'")->row_array();
                    $reqqq['post_image'] = empty($reqqq['post_image'])?'':base_url('upload/post/'.$reqqq['post_image']);
                    
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function get_all_posts_detail($user_id,$type){
	    
	    if($type == '2')
	    {
	        $query = $this->db->where(array('post_userid'=>$user_id,'post_status'=>'1'))->order_by('post_creatat','DESC')->get('postdetail');
	    }
	    else
	    {
	        $query = $this->db->where(array('post_status'=>'1'))->order_by('post_creatat','DESC')->get('postdetail');
	    }
	    //echo $this->db->last_query();
        
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
        
        public function app_edit_posts($id){
	    
	    
	        $query = $this->db->where(array('post_id'=>$id))->get('postdetail');
	    
	    //echo $this->db->last_query();
        
        if ($query->num_rows()) {
			$rs = $query->row_array();
			$post_catid = $this->db->get_where('postcategory',array('cat_id'=>$rs['post_catid']))->row();
                        $rs['post_image'] = empty($rs['post_image'])?'':base_url('upload/post/'.$rs['post_image']);
                        $rs['post_catname'] = $post_catid->cat_name;
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	
	public function get_app_get_all_post_details_fileds_builder($rs,$userid){
	    
	    
	    
	    foreach($rs as $val)
	    {
	        if($val->post_type == 0)
                {
	       $post_catid = $this->db->get_where('postcategory',array('cat_id'=>$val->post_catid))->row();
	       $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$val->post_userid AND membership_type !='0'")->row();
         
	       $post_like_count = $this->db->where('post_like_dislike_postid',$val->post_id)->get('post_like_dislike')->num_rows();
	       $post_cmt_count = $this->db->where(array('post_cmt_postid'=>$val->post_id,'post_cmt_status'=>'1'))->get('post_comment')->num_rows();
	        
	       $get_check_user_like = $this->db->where(array('post_like_dislike_postid'=>$val->post_id,'post_like_dislike_userid'=>$userid))->get('post_like_dislike')->result(); 
	        
	        
	       if($get_check_user_like) { $avl_status = 'Yes';}
	       else { $avl_status = 'No';}
	        
	        $is_edit = 0;
                $td = date('Y-m-d');
                $sd = date('Y-m-d',strtotime($val->post_creatat));
                $ed = date('Y-m-d',strtotime($val->post_creatat.'+'.$this->setting->edit_allowed_days.' days'));
                if($td >= $sd && $td <= $ed && $val->post_userid == $userid )
                {
                    $is_edit = 1;
                }
	        
	        
	    $result_data[] = array(
		  
		    'post_id'=>$val->post_id,
		    'post_cat_name'=>$post_catid->cat_name,
		    'post_cat_icon'=>base_url().'upload/post/postcategory/PostIcons/'.$post_catid->cat_icon,
		    'post_by_user_id'=>$val->post_userid,
		    'post_by_user_name'=>$query->full_name,
		    'post_by_user_image'=>$query->profile_pic,
		    'post_description'=>$val->post_description,
		    'post_date'=>$val->post_date,
		    'post_time'=>$val->post_time,
		    'post_image'=>empty($val->post_image)?'':base_url().'upload/post/'.$val->post_image,
		  	'post_total_comment'=> $post_cmt_count,
		  	'post_total_like'=> $post_like_count,
		  	'post_like_given_by_you'=> $avl_status,
                'is_viewed'=>$this->check_user_visibility($userid,$val->post_userid),
                'is_edit'=>$is_edit,
                "post_type"=>$val->post_type
		);
	    }
            if($val->post_type == 1)
            {
                $post_like_count = $this->db->where('post_like_dislike_postid',$val->post_id)->get('post_like_dislike')->num_rows();
	       $post_cmt_count = $this->db->where(array('post_cmt_postid'=>$val->post_id,'post_cmt_status'=>'1'))->get('post_comment')->num_rows();
	        
	       $get_check_user_like = $this->db->where(array('post_like_dislike_postid'=>$val->post_id,'post_like_dislike_userid'=>$userid))->get('post_like_dislike')->result(); 
               if($get_check_user_like) { $avl_status = 'Yes';}
	       else { $avl_status = 'No';} 
               $val_data = $this->db->where('buddy_meet_id',$val->post_type_id)->get('buddy_meet')->row();
//                if($userid == $val_data->buddy_meet_touserid)
//	           {
//	               $userids = $val_data->buddy_meet_withuserid;
//                       $userids1 = $val_data->buddy_meet_touserid;
//	               $chatid = $this->getfirebaseid($val_data->buddy_meet_withuserid);
//	           }
//	           else
//	           {
	               $userids = $val_data->buddy_meet_touserid;
                       $userids1 = $val_data->buddy_meet_withuserid;
	               $chatid = $this->getfirebaseid($val_data->buddy_meet_touserid);
//	           }
	           
	           
	           $user_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids  AND membership_type !='0'")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
                   $user_data1 = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids1  AND membership_type !='0'")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
       
               $meetdate = $val_data->buddy_meet_date;
       
	           $result_data[] = array(
                       'post_id'=>$val->post_id,
	                    "buddymeet_id"=> $val_data->buddy_meet_id,
                        "buddymeet_description"=> $val_data->buddy_meet_desc,
                        "buddymeet_location"=> $val_data->buddy_meet_location,
                        "buddymeet_date"=> $val_data->buddy_meet_date,
                        "buddymeet_time"=> $val_data->buddy_meet_time,
                        "buddymeet_day"=> $val_data->buddy_meet_day,
                        "buddymeet_touserid"=> $user_data->id,
                        "buddymeet_tousername"=> $user_data->full_name,
                        "buddymeet_touserprofile"=> $user_data->profile_pic,
                       "buddymeet_withuserid"=> $user_data1->id,
                        "buddymeet_withusername"=> $user_data1->full_name,
                        "buddymeet_withuserprofile"=> $user_data1->profile_pic,
                        "chat_id"=>$chatid ,
                        "is_viewed"=>$this->check_user_visibility($userid,$user_data->id),
                       "is_viewed2"=>$this->check_user_visibility($userid,$user_data1->id),
                       "post_type"=>$val->post_type,
                       'post_total_comment'=> $post_cmt_count,
		  	'post_total_like'=> $post_like_count,
		  	'post_like_given_by_you'=> $avl_status
                  ); 
            }
            if($val->post_type == 2)
            {
                $post_like_count = $this->db->where('post_like_dislike_postid',$val->post_id)->get('post_like_dislike')->num_rows();
	       $post_cmt_count = $this->db->where(array('post_cmt_postid'=>$val->post_id,'post_cmt_status'=>'1'))->get('post_comment')->num_rows();
	        
	       $get_check_user_like = $this->db->where(array('post_like_dislike_postid'=>$val->post_id,'post_like_dislike_userid'=>$userid))->get('post_like_dislike')->result(); 
               if($get_check_user_like) { $avl_status = 'Yes';}
	       else { $avl_status = 'No';} 
               $check_in_usertble = $this->db->where('id',$userid)->get('user')->row();
	    $package_info1 = $this->db->where(array('user_id'=>$userid,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$userid,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>10,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	    
            $str = explode(',',$user_consumption->type_id);
	        
	        $roww = $this->db->where('id',$val->post_type_id)->get('requirements')->row();
	        
	            $userrr=$roww->user_id;
	            //get user details
	            $userdetails=$this->db->query("select * from user where id='".$userrr."'")->result();
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;	            
	            
	            $result_data[]=array(
                            'post_id'=>$val->post_id,
	                    "userid"=>$userrr,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "full_name"=>$full_name,
	                    "email"=>$email,
	                    "mobile"=>$mobile,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "company_phone"=>$company_phone,
	                    "company_address"=>$company_address,
	                    "dob"=>$dob,
	                    "profile_pic"=>$profilepic,
                            "is_viewed"=>(in_array($roww->id,$str))?1:0,
	                "post_type"=>$val->post_type,
                        'post_total_comment'=> $post_cmt_count,
		  	'post_total_like'=> $post_like_count,
		  	'post_like_given_by_you'=> $avl_status
	                );
	                
	                
	           
	        
            }
            if($val->post_type == 3)
            {
                $post_like_count = $this->db->where('post_like_dislike_postid',$val->post_id)->get('post_like_dislike')->num_rows();
	       $post_cmt_count = $this->db->where(array('post_cmt_postid'=>$val->post_id,'post_cmt_status'=>'1'))->get('post_comment')->num_rows();
	        
	       $get_check_user_like = $this->db->where(array('post_like_dislike_postid'=>$val->post_id,'post_like_dislike_userid'=>$userid))->get('post_like_dislike')->result(); 
               if($get_check_user_like) { $avl_status = 'Yes';}
	       else { $avl_status = 'No';}
               $get_about = $this->db->get('aboutus')->row();
                $val_data = $this->db->where('event_id',$val->post_type_id)->get('events')->row();
                 $userids = $val_data->event_userid;
	              $get_user = $this->db->select('phone,membership_type')->get_where('user',array('id'=>$userids))->row(); 
	            
	             
	             $register_event = $this->db->select("booking_id")->where(array('booking_userid'=>$userid,'booking_eventid'=>$val_data->event_id))->get('event_booking');      
	        
	        if($register_event->num_rows() == '0') { $booking = 'No'; }  else{ $booking = 'Yes'; }
	             
	             $get_event_type = $this->db->where(array('attend_userid'=>$userid,'attend_eventid'=>$val_data->event_id))->group_by('attend_id','DESC')->limit('1')->get('event_attending_status')->row();
	            
	             if($get_event_type->attend_type == '1'){ $attend_type = 'Interested'; }
	             elseif($get_event_type->attend_type == '2'){ $attend_type = 'Registered'; }
	             elseif($get_event_type->attend_type == '3'){ $attend_type = 'Maybe'; }
	             else{ $attend_type = ''; }
	            
	             $result_data[] = array(
                         'post_id'=>$val->post_id,
	                    "event_id"=> $val_data->event_id,
                        "event_cat_id"=> $val_data->event_cat_id,
                        "event_cat_name"=> $val_data->event_cat_name,
                        "event_title"=> $val_data->event_title,
                        "event_description"=> $val_data->event_description,
                        "event_address"=> $val_data->event_address,
                        "event_shortabout"=> $get_about->shortabout,
                        "event_about"=> $get_about->details,
                        "event_longitude"=> $get_about->longitude,
                        "event_latitude"=> $get_about->latitude,
                        "event_phno"=> $get_about->phonenumber,
                        "event_date"=> $val_data->event_date,
                        "event_startdate"=> strtoupper($val_data->event_startdate),
                        "event_enddate"=> strtoupper($val_data->event_enddate),
                        "event_fees"=> $val_data->event_fees,
                        "event_guest_fees"=> $val_data->event_guestfees,
                        "event_thumbnil"=> base_url().'upload/events/'.$val_data->event_thumbnil,
                        "event_creatdate"=> $val_data->event_creatdate,
                        "event_creattime"=> $val_data->event_creattime,
                        "event_organized_by"=>$val_data->event_userid,
                        "chat_id"=> $this->getfirebaseid($val_data->event_userid),
                        "event_booked_byuser"=>$booking,
                        "event_type"=>$attend_type,
                        "event_publish_status"=>$val_data->event_publish_status,
//                        "event_sorttype"=>$type,
                        "membership_type"=>$get_user->membership_type,
                        "share_url"=>"https://just4entrepreneurs.com/event_detail/".$val_data->event_id, 
                         "post_type"=>$val->post_type,
                         'post_total_comment'=> $post_cmt_count,
		  	'post_total_like'=> $post_like_count,
		  	'post_like_given_by_you'=> $avl_status
                  ); 
            }
            }
	    
	    return $result_data;
	    
	}
	

	
	public function save_post_comments($reqq){
	    
	    $data_insert=array(
	           "post_cmt_userid"=>$reqq['userid'],
	           "post_cmt_postid"=>$reqq['postid'],
	           "post_cmt_comment"=>$reqq['message'],
	           "post_cmt_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "post_cmt_time"=>date('H:i:s',strtotime($reqq['created_time']))
	        );
	        
	        $ress=$this->db->insert('post_comment',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from post_comment where post_cmt_id='".$insert_id."'")->row();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	public function get_all_posts_comment_detail($postid){
	    
	    
	      $query = $this->db->where(array('post_cmt_postid'=>$postid,'post_cmt_status'=>'1'))->order_by('post_cmt_id','DESC')->get('post_comment');
	    //$query = $this->db->where(array('post_cmt_postid'=>$postid,'post_cmt_status'=>'1'))->order_by('post_cmt_id','ASC')->get('post_comment');
        
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	
	public function get_app_get_all_post_comment_details_fileds_builder($rs){
	    
	    $result_data = $obj = array();
	       $post_comment_count = 0;
	    
	    foreach($rs as $val)
	    {
	       
	       
	       $query = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$val->post_cmt_userid AND membership_type !='0'")->row();
         
	       
	    $result_data[] = array(
		  
		    'post_cmt_id'=>$val->post_cmt_id,
		    'post_cmt_by_user_id'=>$query->id,
		    'post_cmt_by_user_name'=>$query->full_name,
		    'post_cmt_by_user_image'=>$query->profile_pic,
		    'post_cmt_message'=>$val->post_cmt_comment,
		    'post_cmt_date'=>$val->post_cmt_date,
		    'post_cmt_time'=>$val->post_cmt_time,
		    
		);
	    }
	    array_push($obj,array("Count"=>count($result_data),"CommentData"=>$result_data));
	    
	    return $obj;
	    
	}

    public function delete_post_comments($commentid){
	    
	             $this->db->where('post_cmt_id',$commentid);
	        
	        $ress=$this->db->delete('post_comment');
	        if($ress==TRUE){
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}


    public function delete_posts_details($postid){
	    
	              $this->db->where('post_cmt_id',$postid);
	        $ress=$this->db->delete('postdetail');
	        if($ress==TRUE){
	            
	            $get_post_like_data = $this->db->where('post_like_dislike_postid',$postid)->get('post_like_dislike')->result();
	            foreach($get_post_like_data as $val_likedata)
	            {
	                $this->db->where(array('post_like_dislike_postid'=>$postid,'post_like_dislike_id'=>$val_likedata->post_like_dislike_id));
	                $this->db->delete('post_like_dislike');
	            }
	            
	            $get_post_cmt_data = $this->db->where(array('post_cmt_postid'=>$postid,'post_cmt_status'=>'1'))->get('post_comment')->result();
	            //where('post_cmt_postid',$postid)
	            foreach($get_post_cmt_data as $val_cmtdata)
	            {
	                $this->db->where(array('post_cmt_postid'=>$postid,'post_cmt_id'=>$val_cmtdata->post_cmt_id));
	                $this->db->delete('post_comment');
	            }
	            
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}

        public function app_delete_post_image($id){
	
	        $ress=$this->db->where('post_id',$id)->update('postdetail',array('post_image'=>''));
	        if($ress==TRUE){
//                    $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from postdetail where post_id='".$id."'")->row_array();
                    $reqqq['post_image'] = empty($reqqq['post_image'])?'':base_url('upload/post/'.$reqqq['post_image']);
                    
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
     public function save_offline_business_transaction($reqq)
     {
         $str = explode('/',$reqq['created_date']);
         
	    
	    if($reqq['type'] == '2')  // GIVEN
	    {
	       $checkdata = $this->db->query("select * from offline_lead where lead_type= 'Received' AND  lead_date = '".$reqq['created_date']."' AND lead_amount = '".$reqq['amount']."' AND ((lead_touser = '".$reqq['userid']."' AND lead_byuser = '".$reqq['businesswith']."') OR (lead_touser = '".$reqq['businesswith']."' AND lead_byuser = '".$reqq['userid']."')) ");
	    }
	    else
	    {
	        $checkdata = $this->db->query("select * from offline_lead where lead_type= 'Given' AND  lead_date = '".$reqq['created_date']."' AND lead_amount = '".$reqq['amount']."' AND ((lead_touser = '".$reqq['userid']."' AND lead_byuser = '".$reqq['businesswith']."') OR (lead_touser = '".$reqq['businesswith']."' AND lead_byuser = '".$reqq['userid']."')) ");
	    
	    }
	    //$checkdata->num_rows();
	    //echo $this->db->last_query();
	    //exit();
	    
	    
	    if($checkdata->num_rows() == '0')
	    {
	    
	        if($reqq['type'] == '2')  // GIVEN
    	    {
    	        $status = '2';
    	        $touser = $reqq['userid'];
    	        $byuser = $reqq['businesswith'];
    	        $busns_type = 'Given';
    	    }
    	    else
    	    {
    	        $status = '2';
    	        $touser = $reqq['businesswith'];
    	        $byuser = $reqq['userid'];
    	        $busns_type = 'Received';
    	    }
	    
    	    $offline_lead=array(
    	           "lead_type"=>$busns_type,
    	           "lead_trans_ids"=>$reqq['uniqueid'],
    	           "lead_touser"=>$touser,
    	           "lead_byuser"=>$byuser,
    	           "lead_amount"=>$reqq['amount'],
    	           "lead_title"=>$reqq['title'],
    	           "lead_remark"=>$reqq['remark'],
    	           "lead_date"=>date('Y-m-d',strtotime($str[2]."-".$str[1]."-".$str[0])),
    	           "lead_status"=>$status,
    	           
    	        );
    	    
    	    $insid = $this->db->insert('offline_lead',$offline_lead);
    	    $insert_id = $this->db->insert_id(); 
    	    
    	    if($insid==TRUE)
    	    {
    	            
    	        $data_insert=array(
        	       "bns_trans_type"=>$busns_type,
        	       "bns_trans_mode"=>'Offline',
        	       "bns_trans_reqid"=>$insert_id,
        	       "bns_trans_touser"=>$byuser,
        	       "bns_trans_byuser"=>$touser,
        	       "bns_trans_amount"=>$reqq['amount'],
        	       "bns_trans_date"=>date('Y-m-d',strtotime($str[2]."-".$str[1]."-".$str[0])),
        	       "bns_trans_status"=>$status,
        	    );
        	    $ress=$this->db->insert('business_transaction',$data_insert);     //echo $this->db->last_query();//exit();
    	            $id = $this->db->insert_id();
                    $rs_email = $this->db->where('purpose', 'business_transaction')->get('email_template')->row(); 
            $transaction_info = $this->db->where('bns_trans_id',$id)->get('business_transaction')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['transaction'] = $transaction_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/business_transaction', $data,true);
//            echo $body;
            if(!empty($transaction_info->bns_trans_byuser))
            {
                $user_info1 = $this->db->where('id',$transaction_info->bns_trans_byuser)->get('user')->row();
            $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
            }
            if(!empty($transaction_info->bns_trans_touser))
            {
                $user_info2 = $this->db->where('id',$transaction_info->bns_trans_touser)->get('user')->row();
            $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
            }
    	         
    	        $notification = array(
                	            'ids'=>my_random(),
                	            'by_user_ids'=>$reqq['businesswith'],
                	            'to_user_ids'=>$reqq['userid'],
                	            'subject'=>'Business Transaction Request '.$busns_type,
                	            'body'=>'Offline Business Transaction Request',
                	            'request_for'=>"BusinessTransaction",
                	            'request_id'=>$id,
                	            'is_read' => '0',
                	            
                	            );
                	     $this->add_notification($notification);      
    	            
    	           
    	            $reqqq=$this->db->query("select * from offline_lead where lead_id='".$insert_id."'")->row();
    	            //return $reqqq;
    	            return TRUE;
    	        }else{
    	            return FALSE;
    	        }
	    }
	    else
	    {
	        if($reqq['type'] == '2')  // GIVEN
    	    {
    	        $status = '1';
    	        $touser = $reqq['userid'];
    	        $byuser = $reqq['businesswith'];
    	        $busns_type = 'Given';
    	    }
    	    else
    	    {
    	        $status = '1';
    	        $touser = $reqq['businesswith'];
    	        $byuser = $reqq['userid'];
    	        $busns_type = 'Received';
    	    }
	    
    	    $offline_lead=array(
    	           "lead_type"=>$busns_type,
    	           "lead_trans_ids"=>$reqq['uniqueid'],
    	           "lead_touser"=>$touser,
    	           "lead_byuser"=>$byuser,
    	           "lead_amount"=>$reqq['amount'],
    	           "lead_title"=>$reqq['title'],
    	           "lead_remark"=>$reqq['remark'],
    	           "lead_date"=>date('Y-m-d',strtotime($str[2]."-".$str[1]."-".$str[0])),
    	           "lead_status"=>$status,
    	           
    	        );
    	    
    	    $insid = $this->db->insert('offline_lead',$offline_lead);
    	    $insert_id = $this->db->insert_id(); 
    	    
    	    if($insid==TRUE)
    	    {
    	            
    	        $data_insert=array(
        	       "bns_trans_type"=>$busns_type,
        	       "bns_trans_mode"=>'Offline',
        	       "bns_trans_reqid"=>$insert_id,
        	       "bns_trans_touser"=>$byuser,
        	       "bns_trans_byuser"=>$touser,
        	       "bns_trans_amount"=>$reqq['amount'],
        	       "bns_trans_date"=>date('Y-m-d',strtotime($str[2]."-".$str[1]."-".$str[0])),
        	       "bns_trans_status"=>$status,
        	    );
        	    $ress=$this->db->insert('business_transaction',$data_insert);     //echo $this->db->last_query();//exit();
    	            $id = $this->db->insert_id();
                    $rs_email = $this->db->where('purpose', 'business_transaction')->get('email_template')->row(); 
            $transaction_info = $this->db->where('bns_trans_id',$id)->get('business_transaction')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['transaction'] = $transaction_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/business_transaction', $data,true);
//            echo $body;
            if(!empty($transaction_info->bns_trans_byuser))
            {
                $user_info1 = $this->db->where('id',$transaction_info->bns_trans_byuser)->get('user')->row();
            $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
            }
            if(!empty($transaction_info->bns_trans_touser))
            {
                $user_info2 = $this->db->where('id',$transaction_info->bns_trans_touser)->get('user')->row();
            $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
            }
    	         
    	        $notification = array(
                	            'ids'=>my_random(),
                	            'by_user_ids'=>$reqq['businesswith'],
                	            'to_user_ids'=>$reqq['userid'],
                	            'subject'=>'Same Business Transaction Request is available',
                	            'body'=>'Offline Business Transaction Request',
                	            'request_for'=>"BusinessTransaction",
                	            'request_id'=>$id,
                	            'is_read' => '0',
                	            
                	            );
                	     $this->add_notification($notification);      
    	            
    	           
    	            $reqqq=$this->db->query("select * from offline_lead where lead_id='".$insert_id."'")->row();
    	            //return $reqqq;
    	            return TRUE;
    	        }else{
    	            return FALSE;
    	        }
	    }
	    
	}




    public function save_offline_business_transaction_old($reqq){
	    
	    
	    
	    
	    if($reqq['type'] == '2')  // GIVEN
	    {
	        $status = '1';
	        $touser = $reqq['userid'];
	        $byuser = $reqq['businesswith'];
	        $busns_type = 'Given';
	        
	         
	        
	    }
	    else
	    {
	        $status = '2';
	        $touser = $reqq['businesswith'];
	        $byuser = $reqq['userid'];
	        $busns_type = 'Received';
	    }
	    
	    
	    
	    $offline_lead=array(
	           "lead_type"=>$busns_type,
	           "lead_trans_ids"=>$reqq['uniqueid'],
	           "lead_touser"=>$touser,
	           "lead_byuser"=>$byuser,
	           "lead_amount"=>$reqq['amount'],
	           "lead_title"=>$reqq['title'],
	           "lead_remark"=>$reqq['remark'],
	           "lead_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "lead_status"=>$status,
	           
	        );
	    
	    $insid = $this->db->insert('offline_lead',$offline_lead);
	    
	    
	    
	        
	        
	        if($insid==TRUE){
	            
	          $insert_id = $this->db->insert_id();  
	            
	             
	            $data_insert=array(
    	           "bns_trans_type"=>$busns_type,
    	           "bns_trans_mode"=>'Offline',
    	           "bns_trans_reqid"=>$insert_id,
    	           "bns_trans_touser"=>$byuser,
    	           "bns_trans_byuser"=>$touser,
    	           "bns_trans_amount"=>$reqq['amount'],
    	           //"bns_trans_title"=>$reqq['title'],
    	           //"bns_trans_remark"=>$reqq['remark'],
    	           "bns_trans_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
    	           "bns_trans_status"=>$status,
    	           
    	        );
    	        $ress=$this->db->insert('business_transaction',$data_insert);     //echo $this->db->last_query();//exit();
	            
	            if($reqq['type'] == '2')  // GIVEN
        	    {
        	        $touser = $reqq['userid'];
        	        $byuser = $reqq['businesswith'];
        	        $busns_type = 'Given';
        	        
        	         $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$touser,
            	            'to_user_ids'=>$byuser,
            	            'subject'=>'Business Transaction Request Given',
            	            'body'=>'Offline Business Transaction Request',
            	            'request_for'=>"BusinessTransaction",
            	            'request_id'=>$this->db->insert_id(),
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
        	    }
        	    else
        	    {
        	        
        	        $touser = $reqq['userid'];
        	        $byuser = $reqq['businesswith'];
        	        $busns_type = 'Received';
        	        
        	         $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$byuser,
            	            'to_user_ids'=>$touser,
            	            'subject'=>'Business Transaction Request Received',
            	            'body'=>'Offline Business Transaction Request',
            	            'request_for'=>"BusinessTransaction",
            	            'request_id'=>$this->db->insert_id(),
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
        	    
        	    }
	            
	            
	            
	            
	            $reqqq=$this->db->query("select * from offline_lead where lead_id='".$insert_id."'")->row();
	            //return $reqqq;
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}


    public function get_app_update_business_transaction($transid)
    {
	    
	    $this->db->where(array('bns_trans_id'=>$transid));
	    $this->db->set('bns_trans_status','2');
	    $update_status = $this->db->update('business_transaction');
	    
	    
	    if($update_status==TRUE)
	    {
	            
	          $gettransdata = $this->db->get_where('business_transaction',array('bns_trans_id'=>$transid))->row();
	          
	          
        	  $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$gettransdata->bns_trans_touser,
            	            'to_user_ids'=>$gettransdata->bns_trans_byuser,
            	            'subject'=>'Business Transaction Request Accepted',
            	            'body'=>'Offline Business Transaction Request Accepted',
            	            'request_for'=>"BusinessTransaction",
            	            'request_id'=>$transid,
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
        	    
	            
	          
	            return TRUE;
	        }
	        else{
	            return FALSE;
	        }
	    
	    
	}


    public function get_offline_business_transaction($userid){
	    
	    
	        $query = $this->db->where('bns_trans_touser',$userid)->or_where('bns_trans_byuser',$userid)->where('bns_trans_status','2')->get('business_transaction');
	    
        
        if ($query->num_rows()) {
			//$rs = $query->result();
				return TRUE;
		}
		else {
			return FALSE;
		}
	    
	}

    public function get_all_transaction_details_fileds_builder($userid){
	    
	    //$receiveddata = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_touser',$userid)->where('bns_trans_status','2')->get('business_transaction')->row();
	    //$givenddata = $this->db->select('sum(bns_trans_amount) as givenamount')->where('bns_trans_byuser',$userid)->where('bns_trans_status','2')->get('business_transaction')->row();
	    
	    $receiveddata = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_touser',$userid)->get('business_transaction')->row();
	    $givenddata = $this->db->select('sum(bns_trans_amount) as givenamount')->where('bns_trans_byuser',$userid)->get('business_transaction')->row();
	    
	    if(empty($receiveddata->receveamount)){$receiveddatas = '0';}else { $receiveddatas = $receiveddata->receveamount;}
		if(empty($givenddata->givenamount)){$givendatas = '0';}else { $givendatas = $givenddata->givenamount;}
		if(empty($given_data)){$given_data = '0';}
	       
	   $totalamount = floatval($receiveddatas) + floatval($givendatas);    
	   
	   $alltransaction = $this->db->select('sum(bns_trans_amount) as receveamount')->get('business_transaction')->row();
	   //$alltransaction = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_status','2')->get('business_transaction')->row();
	   if(empty($alltransaction->receveamount)){$alltransactions = '0';}else { $alltransactions = $alltransaction->receveamount;}
	       
	    $result_data[] = array(
		  
		    'total_amount'=>floatval($alltransactions),
		    'receive_amount'=> intval($receiveddatas),
		    'given_amount'=> intval($givendatas),
		    
		    
		);
	    
	    
	    return $result_data;
	    
	}


    
    public function get_transaction_details_fileds_builder($userid){
	    
	    //$receiveddata = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_touser',$userid)->where('bns_trans_status','2')->get('business_transaction')->row();
	    //$givenddata = $this->db->select('sum(bns_trans_amount) as givenamount')->where('bns_trans_byuser',$userid)->where('bns_trans_status','2')->get('business_transaction')->row();
	    
	    $receiveddata = $this->db->select('sum(bns_trans_amount) as receveamount')->where('bns_trans_touser',$userid)->get('business_transaction')->row();
	    $givenddata = $this->db->select('sum(bns_trans_amount) as givenamount')->where('bns_trans_byuser',$userid)->get('business_transaction')->row();
	    
	    if(empty($receiveddata->receveamount)){$receiveddatas = '0';}else { $receiveddatas = $receiveddata->receveamount;}
		if(empty($givenddata->givenamount)){$givendatas = '0';}else { $givendatas = $givenddata->givenamount;}
		if(empty($given_data)){$given_data = '0';}
	       
	   $totalamount = floatval($receiveddatas) + floatval($givendatas);    
	       
	    $result_data[] = array(
		  
		    'total_amount'=>$totalamount,
		    'receive_amount'=> intval($receiveddatas),
		    'given_amount'=> intval($givendatas),
		    
		    
		);
	    
	    
	    return $result_data;
	    
	}
	
	public function get_transaction_details_by_received_fileds_builder($userid){
	    
	    
	    //$getdata = $this->db->where('bns_trans_touser',$userid)->where('bns_trans_status','2')->get('business_transaction')->result();
	    $getdata = $this->db->where('bns_trans_touser',$userid)->get('business_transaction')->result();
	    
	    if(count($getdata) != '0')
	    {
	       
	       foreach($getdata as $valdata)
	       {
    	       $userid = $valdata->bns_trans_byuser;
    	       $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userid AND membership_type !='0'")->row();
             
    	       
    	       $result_data[] = array(
    		    'transaction_id'=>$valdata->bns_trans_id,
    		    'user_name'=>$query->full_name,
    		    'user_profile'=>$query->profile_pic,
    		    'transaction_type'=>$valdata->bns_trans_type,
    		    'transaction_amount'=>intval($valdata->bns_trans_amount),
    		    'transaction_date'=>$valdata->bns_trans_date,
    		    );
    	       }
	    }
	    else
	    {
	        $result_data[] = array();
	    }
	       
	    
	    
	    
	    return $result_data;
	    
	}
	
	public function get_transaction_details_by_given_fileds_builder($userid){
	    
	    $getdata = $this->db->where('bns_trans_byuser',$userid)->where('bns_trans_status','2')->get('business_transaction')->result();
	   
	    
	    if(count($getdata) != '0')
	    {
	       
	       foreach($getdata as $valdata)
	       {
	           $userid = $valdata->bns_trans_touser;
	       $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userid AND membership_type !='0'")->row();
         
	       
	       $result_data[] = array(
		    'transaction_id'=>$valdata->bns_trans_id,
		    'user_name'=>$query->full_name,
		    'user_profile'=>$query->profile_pic,
		    'transaction_type'=>$valdata->bns_trans_type,
		    'transaction_amount'=>intval($valdata->bns_trans_amount),
		    'transaction_date'=>$valdata->bns_trans_date,
		    );
	       }
	       
	    }
	    else{
	     $result_data[] = array();   
	    }
	       
	    
	    
	    
	    return $result_data;
	    
	}
	
	public function get_transaction_details_by_all_fileds_builder($builderdata){
	    $sql = '';
	    $userids = $this->json_array['userid'];
	    
	    
	    if($this->json_array['keyword'] != '')
	    {
	           $keyword = $this->json_array['keyword'];
	          $query_data = $this->db->query("select id from user where ((user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%') OR ( user.last_name LIKE '%$keyword%')) ")->result();
	      
	          foreach($query_data as $val_user)
	          {
	              $userdata[] = $val_user->id;
	          }
	          
	          
	          
	         // $bus_cat_array = (explode(",",$userdata));  //echo $bus_cat_array;
	          $bus_ids = implode(',',$userdata);   //print_r($bus_ids);
	        //$sql.=" AND ( user.id IN (".$bus_ids."))";
	       }
	       
	    
	    $getdata = $this->db->query("select * from business_transaction where  (`bns_trans_byuser`=$userids  OR `bns_trans_touser` =$userids)   $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'  AND bns_trans_status='2'
        
	    
	    $userid = $builderdata['userid'];
	    
	    
	    if($getdata)
	    //if(count($getdata) != '0')
	    {
	       
	       foreach($getdata as $valdata)
	       {
	        
	        if($valdata->bns_trans_byuser == $userids)
	        {
	          $userid = $valdata->bns_trans_touser;
	          $mode_type = 'Given';
	        }
	        else
	        {
	           $userid = $valdata->bns_trans_byuser;
	           $mode_type = 'Received';
	        }
	        
	        
	        if($valdata->bns_trans_mode == 'Offline')
	        {
	            $payment_date = $valdata->bns_trans_date;
	        }
	        else
	        {
	           $get_transdata = $this->db->where(array("req_user_status_id"=>$valdata->bns_trans_reqid))->get('requirements_user_status')->row(); 
	           $payment_date = $get_transdata->req_user_status_date;
	           //$payment_date = date('d/m/Y',strtotime($valdata->bns_trans_date)); 
	        }
	        /*
	        if($valdata->bns_trans_type == 'Given')
	        {
	            $userid = $valdata->bns_trans_byuser;
	        }
	        else
	        {
	            $userid = $valdata->bns_trans_touser;
	        }
	        */
	           
	       $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userid AND membership_type !='0'")->row();
         
            
	      if($this->json_array['keyword'] != '')
	      {
	        if(in_array($userid,$userdata))  
	         { 
	          $result_data[] = array(
    		    'transaction_id'=>$valdata->bns_trans_id,
    		    'user_id'=>$userid,
    		    'user_name'=>$query->full_name,
    		    'user_profile'=>$query->profile_pic,
    		    'transaction_type'=>$mode_type, //$valdata->bns_trans_type,
    		    'payment_type'=>$valdata->bns_trans_mode,
    		    'transaction_amount'=>intval($valdata->bns_trans_amount),
    		    'transaction_date'=>$payment_date,
    		    'is_viewed'=>$this->check_user_visibility($userids,$userid)
    		    );
	         } 
	       
	      }
	      else
	      {
	          $result_data[] = array(
    		    'transaction_id'=>$valdata->bns_trans_id,
    		    'user_id'=>$userid,
    		    'user_name'=>$query->full_name,
    		    'user_profile'=>$query->profile_pic,
    		    'transaction_type'=>$mode_type, //$valdata->bns_trans_type,
    		    'payment_type'=>$valdata->bns_trans_mode,
    		    'transaction_amount'=>intval($valdata->bns_trans_amount),
    		    'transaction_date'=>$payment_date,
    		    'is_viewed'=>$this->check_user_visibility($userids,$userid)
    		    );
	      }
	       
	       }
	       
	    }
	    else{
	     return array();   
	    }
	       
	    
	    
	    if(empty($result_data))
	    {
	        return array();
	    }
	    
	    
	    if($this->json_array['type'] != '')
	    {
	        if($this->json_array['type'] == '1')
	        {
	           
	           
                $obj = array();
	           foreach($result_data as $var) {    
                    if($var['transaction_type'] == 'Received')
                    {
                        array_push($obj,$var);
                    }
                }
	           
	            array_multisort(array_map(function($element) {
                      return $element['transaction_id'];
                  }, $obj), SORT_DESC, $obj);
	           
	           return $obj;
	           
	        }
	        else
	        {
	            $obj = array();
	           foreach($result_data as $var) {    
                    if($var['transaction_type'] == 'Given')
                    {
                        array_push($obj,$var);
                    }
                }
	           array_multisort(array_map(function($element) {
                      return $element['transaction_id'];
                  }, $obj), SORT_DESC, $obj);
	           
	           return $obj;
	           
	           
	        }
	        
	    }
	    else
	    {
	        
	            array_multisort(array_map(function($element) {
                      return $element['transaction_id'];
                  }, $result_data), SORT_DESC, $result_data);
                  return $result_data;
	        
	           
	    }
	    
	    
	    
	    
	    
	    
	}
	
	
	public function get_offline_business_transaction_detail($transaction_id){
	    
        $this->db->from('business_transaction');
        $this->db->where('bns_trans_id', $transaction_id);
       // $this->db->where('bns_trans_status','2');
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
			return $rs;	
			
		}
		else {
			return FALSE;
		}
	    
	}
	public function get_offline_business_transaction_detail_fileds_builder($rs,$userids){
	    
	    /*
	    if($rs->bns_trans_type == 'Received')
	    {
	        $userid = $rs->bns_trans_byuser;
	    }
	    else
	    {
	        $userid = $rs->bns_trans_touser;
	    }
	    */
	    
	    /*if($valdata->bns_trans_byuser == $userids)
	        {
	          $userid = $rs->bns_trans_touser;
	          $mode_type = 'Received';
	        }
	        else
	        {
	           $userid = $rs->bns_trans_byuser;
	           $mode_type = 'Given';
	        }*/
	       
	  //  echo  $rs->bns_trans_byuser .'---'.$userids; 
	   
	    if($rs->bns_trans_byuser == $userids)
	    {
	        $useridss = $rs->bns_trans_touser;   
	        $mode_type = 'Given';
	    }
	    else
	    {
	       $useridss = $rs->bns_trans_byuser;
	       $mode_type = 'Received';
	    }
	        
	   // echo $useridss;
	    
//	    if($rs->bns_trans_mode == 'Offline')
//	    {
	        $payment_date = $rs->bns_trans_date;
//	    }
//	    else
//	    {
//	        $payment_date = date('d/m/Y',strtotime($rs->bns_trans_date)); 
//	    }
	    
	    if($rs->bns_trans_status == '1')
	    {
	       $status = 'Pending'; 
	    }
	    else
	    {
	       $status = 'Accepted';  
	    }
	    
	    
	    $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$useridss AND membership_type !='0'")->row();
         
        $off_lead_data = $this->db->where(array("lead_id"=>$rs->bns_trans_reqid))->get('offline_lead')->row(); 
         
         
        if($rs->bns_trans_mode == 'Offline')
	    {
	        
	        return array(
		  
		    'user_name'=>$query->full_name,
		    'user_profile'=>$query->profile_pic,
		    'transaction_type'=>$mode_type, //$rs->bns_trans_type,
		    'transaction_title'=>$off_lead_data->lead_title,
		    'transaction_remark'=>$off_lead_data->lead_remark,
		    //'transaction_amount'=>intval($off_lead_data->lead_amount),
		    'transaction_amount'=>intval($rs->bns_trans_amount),
		    'transaction_date'=>$payment_date,
		    'transaction_no'=>$off_lead_data->lead_trans_ids,
		    'transaction_status'=>$status,
		);
	    }
	    else
	    {
	       $get_transdata = $this->db->where(array("req_user_status_id"=>$rs->bns_trans_reqid))->get('requirements_user_status')->row(); 
	       
	       $payment_date = $get_transdata->req_user_status_date;
	        return array(
		  
		    'user_name'=>$query->full_name,
		    'user_profile'=>$query->profile_pic,
		    'transaction_type'=>$mode_type, //$rs->bns_trans_type,
		    'transaction_title'=>$get_transdata->req_user_status_msg,
		    'transaction_remark'=>'',//$get_transdata->lead_remark,
		    //'transaction_amount'=>intval($off_lead_data->lead_amount),
		    'transaction_amount'=>intval($rs->bns_trans_amount),
		    'transaction_date'=>$payment_date,
		    'transaction_no'=>$off_lead_data->lead_trans_ids,
		    'transaction_status'=>$status,
		);
	    } 
         
         
         
	    
	}
	
	

	
	
	public function get_event_title($userid,$evt_title){
	    
	    $query=$this->db->query("select * from events where event_userid='".$userid."' and event_title='".$req_title."'")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	
	public function save_event_details($eventdetails,$filename){
	    
	    $eventstartdate = $eventdetails['start_datetime'];
	    $eventenddate = $eventdetails['end_datetime'];
	    
	    $startdate = substr($eventstartdate,0,11);
	    $enddate = substr($eventenddate,0,11);
        
        $new_startdate = date("D", strtotime($startdate)).', '.$eventstartdate; 
        $new_enddate = date("D", strtotime($enddate)).', '.$eventenddate; 
         
	    $event_date = date("Y-m-d",strtotime($startdate));
	    
	    
	    
	    $startdate = date('D', strtotime($creatdate));
	    $enddate = date('D', strtotime($creatdate));
	     
	    $data_insert=array(
	           "event_userid"=>$eventdetails['userid'],
	           "event_cat_id"=>$eventdetails['cat_id'],
	           "event_title"=>$eventdetails['event_title'],
	           "event_description"=>$eventdetails['event_description'],
	           "event_address"=>$eventdetails['venue'],
	           "event_date"=>$event_date,
	           "event_startdate"=>$new_startdate,
	           "event_enddate"=>$new_enddate,
	           "event_fees"=>$eventdetails['entry_fees'],
	           "event_guestfees"=>$eventdetails['event_guestfees'],
	           "event_ticketqty"=>$eventdetails['max_ticket'],
	           "event_thumbnil"=>$filename,
	           "event_creatdate"=>date('Y-m-d',strtotime($eventdetails['created_date'])),
	           "event_creattime"=>date('H:i:s',strtotime($eventdetails['created_time'])),
	           "event_publish_status"=>$eventdetails['created_type'],
	           "event_permission"=>$eventdetails['event_permission']
	        );
	        
	        $ress=$this->db->insert('events',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
                    $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
            $event_info = $this->db->where('event_id',$insert_id)->get('events')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['event'] = $event_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/event_invitation', $data,true);
//            echo $body;
            $user_info = $this->db->where_in('membership_type',array('1','2'))->where('user_delete','1')->get('user')->result();
            if(!empty($user_info))
            {
                foreach($user_info as $val)
                {
            $email = array(
			  'email_to' => $val->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
                }
            }
//                print_r($res);
                    $data_insert1=array(
	           "post_userid"=>$eventdetails['userid'],
	           "post_catid"=>0,
	           "post_description"=>$eventdetails['event_description'],
	           "post_image"=>$filename,
	           "post_date"=>date('Y-m-d',strtotime($eventdetails['created_date'])),
	           "post_time"=>date('H:i:s',strtotime($eventdetails['created_time'])),
                       "post_type"=>3,
                       "post_type_id"=>$insert_id
	        );
	        
	        $ress1=$this->db->insert('postdetail',$data_insert1);
	           // $this->add_reward_point('EventCreate',$eventdetails['userid'],$eventdetails['created_date'],$eventdetails['created_time']);
	            
	            //return TRUE;
	            //get all details
	            
	            $address = $eventdetails['venue'];
	            
	            $get_address = $this->db->get_where('address',array('address_name'=>$address));
	            if($get_address->num_rows() == '0')
	            {
	                $get_address = array("address_name"=>$address);
	                $this->db->insert("address",$get_address);
	            }
	            
	            
	            $reqqq=$this->db->query("select * from events where event_id='".$insert_id."'")->result();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function update_event_details($eventdetails)
	{
	    
	    
	   $eventstartdate = $eventdetails['start_datetime'];
	    $eventenddate = $eventdetails['end_datetime'];
	    
	    $startdate = substr($eventstartdate,0,11);
	    $enddate = substr($eventenddate,0,11);
        
        $new_startdate = date("D", strtotime($startdate)).', '.$eventstartdate; 
        $new_enddate = date("D", strtotime($enddate)).', '.$eventenddate; 
         
	    $event_date = date("Y-m-d",strtotime($startdate));
	    
	    
	    
	    $startdate = date('D', strtotime($creatdate));
	    $enddate = date('D', strtotime($creatdate));
	     
	    $data_insert=array(
	           "event_userid"=>$eventdetails['userid'],
	           "event_cat_id"=>$eventdetails['cat_id'],
	           "event_title"=>$eventdetails['event_title'],
	           "event_description"=>$eventdetails['event_description'],
	           "event_address"=>$eventdetails['venue'],
	           "event_date"=>$event_date,
	           "event_startdate"=>$new_startdate,
	           "event_enddate"=>$new_enddate,
	           "event_fees"=>$eventdetails['entry_fees'],
	           "event_guestfees"=>$eventdetails['event_guestfees'],
	           "event_ticketqty"=>$eventdetails['max_ticket'],
	           //"event_thumbnil"=>$filename,
	           "event_creatdate"=>date('Y-m-d',strtotime($eventdetails['created_date'])),
	           "event_creattime"=>date('H:i:s',strtotime($eventdetails['created_time'])),
	           "event_creattime"=>$eventdetails['created_type'],
	           "event_publish_status"=>$eventdetails['created_type'],
	        );
	        
	            $this->db->where('event_id',$eventdetails['event_id']);
	            $this->db->where('event_userid',$eventdetails['userid']);
	   $query = $this->db->update('events',$data_insert);   
	   
	   //echo $this->db->last_query();
	   
	   if($query){
	        
	        if ($_FILES['event_thumbnail']['name'] != '')
    		{
               
               $avatar_file_vcard = $eventdetails['userid'].'.'.pathinfo($_FILES['event_thumbnail']['name'], PATHINFO_EXTENSION);  
               
               $config = array();
               $config['upload_path'] = $this->config->item('my_upload_directory') . 'events/' ;
               $config['allowed_types'] = '*'; //'gif|jpg|png';
               $config['encrypt_name']  = TRUE;
               $config['file_name'] = $avatar_file_vcard;
               $this->load->library('upload',$config);
               $this->upload->do_upload('event_thumbnail');
               $upload_data = $this->upload->data();
               $pdffilename = $upload_data['file_name'];
               $profile = array("event_thumbnil" => $pdffilename);
               $this->db->where('event_id',$eventdetails['event_id']);
	           $this->db->where('event_userid',$eventdetails['userid']);
	           $this->db->update('events',$profile); 
              
            } 	
	        
	        
	        
	        
	        $lastid = $eventdetails['event_id'];
	        
	        if(!empty($_FILES['images']['name']) && count(array_filter($_FILES['images']['name'])) > 0)
			                    { 
                                    $filesCount = count($_FILES['images']['name']); 
                                    for($i = 0; $i < $filesCount; $i++)
                                    {// echo $i;
                                        $_FILES['file']['name']     = $_FILES['images']['name'][$i]; 
                                        $_FILES['file']['type']     = $_FILES['images']['type'][$i]; 
                                        $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i]; 
                                        $_FILES['file']['error']     = $_FILES['images']['error'][$i]; 
                                        $_FILES['file']['size']     = $_FILES['images']['size'][$i]; 
                     
                                        $path2=$this->config->item('my_upload_directory') . 'events/event_details/' ;
        			                    $config['upload_path'] = $path2;
                                        
                                        $config['allowed_types'] = '*'; 
                                        //$config['max_size']    = '100'; 
                                        //$config['max_width'] = '1024'; 
                                        //$config['max_height'] = '768'; 
                     
                                        $this->load->library('upload', $config); 
                                        $this->upload->initialize($config); 
                     
                    
                                    if($this->upload->do_upload('file')){ 
                                        // Uploaded file data
                                        $eventid = $lastid; 
                                        $fileData = $this->upload->data(); 
                                        $uploadData[$i]['file_name'] = $fileData['file_name'];   //echo $fileData['file_name'];
                                        $imagesupload=$this->db->insert('event_gallery',array("event_gallery_eventid"=>$eventid,"event_gallery_userid"=>$eventdetails['userid'],"event_gallery_image"=>$uploadData[$i]['file_name']));
                                    }else{  
                                        $errorUploadType .= $_FILES['file']['name'].' | ';  
                                    } 
                                } 
			                    }
	        
	        
	        
	        return TRUE;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	   
	}
	
	
	
	public function delete_event_detail($eventid,$userid){
	    
	             $this->db->where(array('event_id'=>$eventid));
	        
	        $ress=$this->db->delete('events');
	        if($ress==TRUE){
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	public function get_all_event_title($userid){
	    
	    $query=$this->db->query("select * from events where event_userid='".$userid."'")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function app_confirm_event_status_post($eventid){
	    
	              $this->db->set('event_publish_status','1');
	              $this->db->where('event_id',$eventid);
	    $query = $this->db->update('events');
	    
	    if($query)
	    {
	        return TRUE;
	    }
	    else
	    {
	       return TRUE; 
	    }
	     
	    
	     
	    
	    
	    
	    
	}
	
	
	
	
	public function upload_event_images($userid,$eventid,$filen){
	    
	    
	    
	        $this->db->insert('event_gallery',array("event_gallery_eventid"=>$eventid,"event_gallery_userid"=>$userid,"event_gallery_image"=>$filen));
	        
	   // echo $this->db->last_query();
	    
	    
	}
	
	public function update_event_attending_status($userid,$eventid,$status){
	    
	    $this->db->set('bookin_attedance',$status);
	    $this->db->where('booking_eventid',$eventid);
	    $this->db->where('booking_userid',$userid);
	        
	        $ress=$this->db->update('event_booking');
	        if($ress==TRUE){
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function get_my_pending_all_past_event($type,$useridss){
	   
	   $today_date = date("Y-m-d");
	   
	   if($type == '')
	   {
	      $type == '1'; 
	   }
	   
	   $sql = '';
	   if($this->json_array['category'] != '')
    	    {
    	        $event_cat_array = (explode(",",$this->json_array['category']));
    	        $cat_ids = implode(',',$event_cat_array);      
    	        $sql.=" AND  ( events.event_cat_id IN (".$cat_ids."))";
    	    }
	   if($this->json_array['keyword'] != '')
    	    {
    	        $kw = $this->json_array['keyword'];
    	        $sql.=" AND  ( events.event_title LIKE '%{$kw}%')";
    	    } 
	   
	   
	   
	   
	   if($type == '2') 
	   {
	       
	      $query = $this->db->query("select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`>='$today_date' AND `event_status`='1'  $sql ")->result();  // print_r($query); ORDER BY event_startdate DESC 
       
	       
	       //$this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	       //$query = $this->db->where(array('event_date >='=>$today_date,'event_status'=>'1'))->get('events')->result();
	       
	   } 
	   elseif($type == '3') 
	   {
	      
	      $query = $this->db->query("select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_date`<'$today_date' AND `event_status`='1'  $sql ")->result();  // print_r($query); ORDER BY event_startdate DESC 
      
	      
	      //$this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	      //$query = $this->db->where(array('event_date <'=>$today_date,'event_status'=>'1'))->get('events')->result(); 
	   }
	   else
	   {
	      
	      //$this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	    
    	    
	    
        $query = $this->db->query("select events.*,event_category.* from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id WHERE `event_status`='1'  $sql ")->result();  // print_r($query); ORDER BY event_startdate DESC 
          
	   }
	   //echo $this->db->last_query();
	    $get_about = $this->db->get('aboutus')->row();
	    
	    if(isset($query) && !empty($query) && $type == '3'){
	        $query_data = array();
	        
	        foreach($query as $val_data)
	        {
	              $userids = $val_data->event_userid;
	              $get_user = $this->db->select('phone,membership_type')->get_where('user',array('id'=>$userids))->row();  
	            
	             
	             $register_event = $this->db->select("booking_id")->where(array('booking_userid'=>$useridss,'booking_eventid'=>$val_data->event_id))->get('event_booking');      
	        
	             if($register_event->num_rows() == '0') { $booking = 'No'; }  else{ $booking = 'Yes'; }
	             
	             
	             $get_event_type = $this->db->where(array('attend_userid'=>$useridss,'attend_eventid'=>$val_data->event_id))->group_by('attend_id','DESC')->limit('1')->get('event_attending_status')->row();
	            
	             if($get_event_type->attend_type == '1'){ $attend_type = 'Interested'; }
	             elseif($get_event_type->attend_type == '2'){ $attend_type = 'Registered'; }
	             elseif($get_event_type->attend_type == '3'){ $attend_type = 'Maybe'; }
	             else{ $attend_type = ''; }
	            
	             if($booking == 'Yes'){
	             $query_data[] = array(
	                    "event_id"=> $val_data->event_id,
                        "event_cat_id"=> $val_data->event_cat_id,
                        "event_cat_name"=> $val_data->event_cat_name,
                        "event_title"=> $val_data->event_title,
                        "event_description"=> $val_data->event_description,
                        "event_address"=> $val_data->event_address,
                        "event_shortabout"=> $get_about->shortabout,
                        "event_about"=> $get_about->details,
                        "event_longitude"=> $get_about->longitude,
                        "event_latitude"=> $get_about->latitude,
                        "event_phno"=> $get_about->phonenumber,
                        "event_date"=> $val_data->event_date,
                        "event_startdate"=> strtoupper($val_data->event_startdate),
                        "event_enddate"=> strtoupper($val_data->event_enddate),
                        "event_fees"=> $val_data->event_fees,
                        "event_guest_fees"=> $val_data->event_guestfees,
                        "event_thumbnil"=> base_url().'upload/events/'.$val_data->event_thumbnil,
                        "event_creatdate"=> $val_data->event_creatdate,
                        "event_creattime"=> $val_data->event_creattime,
                        "event_organized_by"=>$val_data->event_userid,
                        "chat_id"=> $this->getfirebaseid($val_data->event_userid),
                        "event_booked_byuser"=>$booking,
                        "event_type"=>$attend_type,
                        "event_publish_status"=>$val_data->event_publish_status,
                        "event_sorttype"=>$type,
                        "membership_type"=>$get_user->membership_type,
                         "share_url"=>"https://just4entrepreneurs.com/event_detail/".$val_data->event_id
                  ); 
	             }
	        }
	        
	        array_multisort(array_map(function($element) {
                      return $element['event_date'];
                  }, $query_data), SORT_DESC, $query_data);

             return $query_data;
	        
	        //return $query_data;
	        
	    } 
	    elseif(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	              $userids = $val_data->event_userid;
	              $get_user = $this->db->select('phone,membership_type')->get_where('user',array('id'=>$userids))->row(); 
	            
	             
	             $register_event = $this->db->select("booking_id")->where(array('booking_userid'=>$useridss,'booking_eventid'=>$val_data->event_id))->get('event_booking');      
	        
	        if($register_event->num_rows() == '0') { $booking = 'No'; }  else{ $booking = 'Yes'; }
	             
	             $get_event_type = $this->db->where(array('attend_userid'=>$useridss,'attend_eventid'=>$val_data->event_id))->group_by('attend_id','DESC')->limit('1')->get('event_attending_status')->row();
	            
	             if($get_event_type->attend_type == '1'){ $attend_type = 'Interested'; }
	             elseif($get_event_type->attend_type == '2'){ $attend_type = 'Registered'; }
	             elseif($get_event_type->attend_type == '3'){ $attend_type = 'Maybe'; }
	             else{ $attend_type = ''; }
	            
	             $query_data[] = array(
	                    "event_id"=> $val_data->event_id,
                        "event_cat_id"=> $val_data->event_cat_id,
                        "event_cat_name"=> $val_data->event_cat_name,
                        "event_title"=> $val_data->event_title,
                        "event_description"=> $val_data->event_description,
                        "event_address"=> $val_data->event_address,
                        "event_shortabout"=> $get_about->shortabout,
                        "event_about"=> $get_about->details,
                        "event_longitude"=> $get_about->longitude,
                        "event_latitude"=> $get_about->latitude,
                        "event_phno"=> $get_about->phonenumber,
                        "event_date"=> $val_data->event_date,
                        "event_startdate"=> strtoupper($val_data->event_startdate),
                        "event_enddate"=> strtoupper($val_data->event_enddate),
                        "event_fees"=> $val_data->event_fees,
                        "event_guest_fees"=> $val_data->event_guestfees,
                        "event_thumbnil"=> base_url().'upload/events/'.$val_data->event_thumbnil,
                        "event_creatdate"=> $val_data->event_creatdate,
                        "event_creattime"=> $val_data->event_creattime,
                        "event_organized_by"=>$val_data->event_userid,
                        "chat_id"=> $this->getfirebaseid($val_data->event_userid),
                        "event_booked_byuser"=>$booking,
                        "event_type"=>$attend_type,
                        "event_publish_status"=>$val_data->event_publish_status,
                        "event_sorttype"=>$type,
                        "membership_type"=>$get_user->membership_type,
                         "share_url"=>"https://just4entrepreneurs.com/event_detail/".$val_data->event_id
                  ); 
	            
	        }
	        
	        array_multisort(array_map(function($element) {
                      return $element['event_date'];
                  }, $query_data), SORT_DESC, $query_data);

             return $query_data;
	        
	        //return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function get_event_details($eventid,$userid){
	   
	  //$this->setting = my_global_setting('all_fields');
	   //echo $this->setting->default_role;exit();
	   
	   $today_date = date("d-m-Y");
	   
	   $this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	   $query = $this->db->where(array('event_id'=>$eventid,'event_status'=>'1'))->get('events')->row();   
	   
	   
	  // $event_invited_user = $this->db->get_where('event_invite',array('event_invite_eventid'=>$eventid))->result();
	   $event_invited_user = $this->db->get_where('event_invite',array('event_invite_eventid'=>$eventid,'event_invite_byuserid'=>$userid))->result();
	   
	   
	   $user_data = array();
	   foreach($event_invited_user as $val_user)
	   {
	       $user_ids = $val_user->event_invite_touserid;
	       $query_data = $this->db->query("select CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id` =$user_ids  AND `role_ids` !='SxqZbYeT616269fcbeb5a87e3cee75d2266df3fffRXmspJqAE' AND membership_type !='0'")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
      //echo $this->db->last_query();
	       if($user_ids != '0'){
	       $user_data[] = array(
	           'userid'=>$user_ids,
	           'images'=>$query_data->profile_pic
	           );
	       }    
	   }
	   
	   $event_invited = $this->db->get_where('event_invite',array('event_invite_eventid'=>$eventid,'event_invite_byuserid'=>$userid))->num_rows();
	   
	   $event_interested = $this->db->get_where('event_attending_status',array('attend_eventid'=>$eventid,'attend_type'=>'1'))->num_rows();
	   $event_attended = $this->db->get_where('event_attending_status',array('attend_eventid'=>$eventid,'attend_type'=>'2'))->num_rows();
	   $event_maybe = $this->db->get_where('event_attending_status',array('attend_eventid'=>$eventid,'attend_type'=>'3'))->num_rows();
	    
	    
	      
	    if(empty($event_invited)){$event_invited = 0;}
	    if(empty($event_interested)){$event_interested = 0;}
	    if(empty($event_attended)){$event_attended = 0;}
	    if(empty($event_maybe)){$event_maybe = 0;}
	    
	    
	    
	    
	    $get_about = $this->db->get('aboutus')->row();
	    
	    $organizename =  "J4E Group"; //$get_about->shortabout;
	    $shortabout = $get_about->shortabout;
        $about = $get_about->details;
	    $address = $get_about->address;
	    $emails = $get_about->email;
	    $phno = $get_about->phonenumber;
	    $wpno = $get_about->whatsappnumber;
	    $longitude = $get_about->longitude;
	    $latitude = $get_about->latitude;
	    $map = $get_about->maplink;
	    $facebooklink = $get_about->facebook;
	    $linkdinlink = $get_about->linkdin;
	    $twitterlink = $get_about->twitter;
	    
	    $chat_id = $this->getfirebaseid($query->event_userid);
	    
	    $organizer_data[]=array("organizename"=>$organizename,"about"=>$about,"shortabout"=>$shortabout,"address"=>$address,"emails"=>$emails,"phonenumber"=>$phno,"longitude"=>$longitude,"latitude"=>$latitude,"maplink"=>$map,"facebook"=>$facebooklink,"linkdin"=>$linkdinlink,"twitter"=>$twitterlink,"chat_id"=>$chat_id);
		
		$review_count = '0';
			        
	    
	    if(isset($query) && !empty($query)){
	        $query_data = $obj = array();
	        
	        $userdetail = $this->db->select("id,company,phone,email_address,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$query->event_userid)->get('user')->row();
	         
	        $register_event = $this->db->select("booking_id")->where(array('booking_userid'=>$userid,'booking_eventid'=>$eventid))->get('event_booking');      
	        
	        if($register_event->num_rows() == '0') { $booking = 'No'; }  else{ $booking = 'Yes'; }
	        
	            $query_data = array(
	                    "event_id"=> $query->event_id,
                        "event_cat_id"=> $query->event_cat_id,
                        "event_cat_name"=> $query->event_cat_name,
                        "event_title"=> $query->event_title,
                        "event_description"=> $query->event_description,
                        "event_address"=> $query->event_address,
                        "event_date"=> $query->event_date,
                        "event_startdate"=> strtoupper($query->event_startdate),
                        "event_enddate"=> strtoupper($query->event_enddate),
                        "event_fees"=> $query->event_fees,
                        "event_guest_fees"=> $query->event_guestfees,
                        "event_thumbnil"=> base_url().'upload/events/'.$query->event_thumbnil,
                        "event_creatdate"=> $query->event_creatdate,
                        "event_creattime"=> $query->event_creattime,
                        "event_createdby_id"=> $userdetail->id,
                        "event_createdby_name"=>'J4E', //$userdetail->full_name,
                        "event_createdby_profile"=> base_url().'upload/j4e.png',   //.$userdetail->profile_pic,
                        "event_createdby_email"=> $emails, //$userdetail->email_address,
                        "event_createdby_phno"=> $phno, //$userdetail->phone,
                        "event_createdby_company"=> $userdetail->company,
                        "event_booked_byuser"=>$booking,
                        "event_publish_status"=>$query->event_publish_status,
                        "event_allocated_ticket"=>$query->event_ticketqty
                  ); 
	            
	            
	            $query_image = $this->db->where('event_gallery_eventid',$eventid)->get('event_gallery')->result();  
	            foreach($query_image as $val_img)
	            {
	                $gallery_data[] = array("event_img_id"=>$val_img->event_gallery_id,"images"=>base_url().'upload/events/event_details/'.$val_img->event_gallery_image);
	            }     
	            
	                //$ratingsss=$this->db->where('event_id',$eventid)->get('event_ratings_reviews')->result();
			        $ratingsss=$this->db->where(array('event_catid'=>$query->event_cat_id,'status' => '1'))->order_by('review_date','DESC')->get('event_ratings_reviews')->result();
			        
			        $usss=0;
			        $review_note=array();
			        $ratingg=0;
			        $one_star = $two_star = $three_star = $four_star = $five_star = $total_no_of_count = 0;
			        $one_star_user = $two_star_user = $three_star_user = $four_star_user = $five_star_user = 0;
			        
			        foreach($ratingsss as $rattt){
			            
			            $ratingg= $ratingg+ floatval($rattt->ratings);
			            
			            //$userdata = $this->db->query("select user. from ratings_reviews where user_id='".$rattt->reviewed_by."'")->row();
			            //$userdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,avatar as profilepic from user where `id`=$rattt->user_id AND membership_type !='0'")->row();
                        $userdata = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$rattt->user_id)->get('user')->row();
	               
        
                        $total_no_of_count = count($ratingsss);  
        
                        if($rattt->ratings == '1' || $rattt->ratings == '1.5')
                        {
                            $one_star += '1'; 
                        }
                        else if($rattt->ratings == '2' || $rattt->ratings == '2.5') 
                        {
                            $two_star += '1';
                        }
                        else if($rattt->ratings == '3'|| $rattt->ratings == '3.5' )
                        {
                            $three_star += '1';
                        }
                        else if($rattt->ratings == '4'|| $rattt->ratings == '4.5')
                        {
                            $four_star += '1';
                        }
                        else if($rattt->ratings == '5')
                        {
                            $five_star += '1';
                        }
                           
                         //  $profileimg = base_url().'upload/avatar/'.$userdata->avatar;
			            $profileimg = $userdata->profile_pic;
			            if($rattt->review_note != ''){
			                $review_count += '1';
			                $review_note[]=array("reviewed_by_id"=>$rattt->user_id,"reviewed_by"=>$userdata->full_name,"review_rate"=>$rattt->ratings,"review_note"=>$rattt->review_note,"profile_img"=>$profileimg,"review_date"=>$rattt->review_date,"review_time"=>$rattt->review_time);
			            }
			            $usss++;
			        }
			        //echo $usss;
			        $review_star[]=array("one_star"=>$one_star,"two_star"=>$two_star,"three_star"=>$three_star,"four_star"=>$four_star,"five_star"=>$five_star,"total_rate_review"=>$total_no_of_count);
			        
			        $average_ratings=floatval($ratingg)/floatval($usss);
			        
			        $avegare_ratss=number_format((float)$average_ratings, 1, '.', '');
	            
	                if (is_numeric($avegare_ratss)) { $avegare_rat = $avegare_ratss; } else { $avegare_rat = '0'; }
	                
	                if(isset($review_note) && !empty($review_note))  { $review_notes = $review_note; }
	                else{ $review_notes = array(); }
	                
	                
	                
	            
	            array_push($obj,array("event_data"=>$query_data,"gallery_data"=>$gallery_data,"review_star"=>$review_star,"average_ratings"=>$avegare_rat,"total_review_count"=>$review_count,"all_reviews"=>$review_notes,"event_interestedcount"=>$event_interested,"event_attendedcount"=>$event_attended,"event_maybecount"=>$event_maybe,"event_invitedcount"=>$event_invited,"event_invited"=>$user_data,"event_organizer"=>$organizer_data));
	            
	            
	        
	        return $obj;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_event_details_for_booking($eventid)
	{
	   
	   $today_date = date("d-m-Y");
	   
	   $this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	   $query = $this->db->where(array('event_id'=>$eventid,'event_status'=>'1'))->get('events')->row();   
	   
	   if(isset($query) && !empty($query))
	   {
	        $query_data = $obj = array();
	        
	        $userdetail = $this->db->select("id,company,phone,email_address,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$query->event_userid)->get('user')->row();
	         
	        $register_event = $this->db->select("booking_id")->where(array('booking_userid'=>$userid,'booking_eventid'=>$eventid))->get('event_booking');      
	        
	        if($register_event->num_rows() == '0') { $booking = 'No'; }  else{ $booking = 'Yes'; }
	        
	            
	            $get_about = $this->db->get('aboutus')->row();
	    
	            $shortabout = $get_about->shortabout;
                $about = $get_about->details;
        	    $address = $get_about->address;
        	    $emails = $get_about->email;
        	    $phno = $get_about->phonenumber;
        	    $wpno = $get_about->whatsappnumber;
        	    $longitude = $get_about->longitude;
        	    $latitude = $get_about->latitude;
        	    $map = $get_about->maplink;
        	    $facebooklink = $get_about->facebook;
        	    $linkdinlink = $get_about->linkdin;
        	    $twitterlink = $get_about->twitter;
        	    
        	    //$organizer_data[]=array("address"=>$address,"emails"=>$emails,"phonenumber"=>$phno,"longitude"=>$longitude,"latitude"=>$latitude,"maplink"=>$map,"facebook"=>$facebooklink,"linkdin"=>$linkdinlink,"twitter"=>$twitterlink);
        		
        		
	            
	            
	            
	            
	            $query_data = array(
	                    "event_id"=> $query->event_id,
                        "event_cat_id"=> $query->event_cat_id,
                        "event_cat_name"=> $query->event_cat_name,
                        "event_title"=> $query->event_title,
                        "event_description"=> $query->event_description,
                        "event_address"=> $query->event_address,
                        "event_date"=> $query->event_date,
                        "event_startdate"=> $query->event_startdate,
                        "event_enddate"=> $query->event_enddate,
                        "event_fees"=> $query->event_fees,
                        "event_guest_fees"=> $query->event_guestfees,
                        "event_thumbnil"=> base_url().'upload/events/'.$query->event_thumbnil,
                        "event_creatdate"=> $query->event_creatdate,
                        "event_creattime"=> $query->event_creattime,
                        "event_createdby_id"=> $userdetail->id,
                        "event_createdby_name"=> $userdetail->full_name,
                        "event_createdby_profile"=> $userdetail->profile_pic,
                        "event_createdby_email"=> $emails,
                        "event_createdby_phno"=> $phno,
                        "event_createdby_company"=> $userdetail->company,
                        "event_booked_byuser"=>$booking,
                        "event_shortabout" => $shortabout,
                        "event_about" => $about,
                  ); 
	            
	            
	                           
	            
	            array_push($obj,array("event_data"=>$query_data));
	            
	            
	        
	        return $obj;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	
	public function get_user_exist_or_not_for_event($userid,$eventid){
	    
	    $ress=$this->db->query("select * from user where id in('".$userid."')")->result();
	    if(isset($ress) && !empty($ress))
	    {
	        $ress=array("status"=>TRUE,"message"=>"User Find");
	    }
	    else
	    {
	        $ress=array("status"=>FALSE,"message"=>"User id not found");
	    }
	    
	    return $ress;
	}
	
	
	public function check_review_ratings_event($userid,$eventid){
	    
	    $qrr=$this->db->query("select * from event_ratings_reviews where status = '1' AND user_id='".$userid."' and event_id='".$eventid."'")->result();
	    if(isset($qrr) && !empty($qrr)){
	        
	         $ress=array("status"=>TRUE,"id"=>$qrr[0]->id);
	    }else{
	        
	         $ress=array("status"=>FALSE,"id"=>"null");
	        
	        
	    }
	    
	    return $ress;
	    
	}
	public function insert_event_ratings_review($userdata){
	    
	    $data_insert=array(
	            "user_id"=>$userdata['userid'],
	            "event_id"=>$userdata['eventid'],
	            "event_catid"=>$userdata['event_catid'],
	            "ratings"=>$userdata['ratings'],
	            "review_note"=>$userdata['review_note'],
	            "review_date"=>date('Y-m-d',strtotime($userdata['date'])),
	            "review_time"=>date('H:i:s',strtotime($userdata['time'])),
	        );
	        
	      $this->db->insert('event_ratings_reviews',$data_insert);   
	      $insert_id = $this->db->insert_id();
	      
	      $getusername = $this->getusernames($userdata['userid']);
	      // $getrewardusername = $this->getusernames($user['userid']);
	      
	        $this->add_reward_point('TestimonialShared',$userdata['userid'],$userdata['date'],$userdata['time'],$getusername);  
	      
	      return $insert_id;
	        
	    
	}
	
	public function get_check_participation_status($userid,$eventid,$type){
	    
	    $query=$this->db->query("select * from event_attending_status where attend_userid='".$userid."' and attend_eventid='".$eventid."' and attend_type ='".$type."'")->row();
	    if(isset($query) && !empty($query)){
	        
	        $attend_data = array(
	            "attend_id"=> $query->attend_id,
                "attend_userid"=> $query->attend_userid,
                "attend_eventid"=> $query->attend_eventid,
                "attend_type"=> $query->attend_type,
                "attend_creattime"=> $query->attend_creattime,
                "attend_creatdate"=> $query->attend_creatdate,
                "attend_creatat"=> $query->attend_creatat);
	        
	        
	        return $attend_data;
	        
	    }else{
	        
	        return FALSE;
	    }
	    
	}
	
	public function save_participation_status_deetails($participationdata){
	    
	     
	    $data_insert=array(
	           "attend_userid"=>$participationdata['userid'],
	           "attend_eventid"=>$participationdata['eventid'],
	           "attend_type "=>$participationdata['type'],
	           "attend_creattime"=>date('Y-m-d',strtotime($participationdata['created_date'])),
	           "attend_creatdate"=>date('H:i:s',strtotime($participationdata['created_time'])),
	           
	        );
	        
	        
	        $checkdata = $this->db->where(array('attend_userid'=>$participationdata['userid'],'attend_eventid'=>$participationdata['eventid']))->get('event_attending_status')->num_rows();
	        if($checkdata == '0')
	        {
	            $ress=$this->db->insert('event_attending_status',$data_insert);
    	        if($ress==TRUE){
    	            $insert_id = $this->db->insert_id();
    	            
    	            $reqqq=$this->db->query("select * from event_attending_status where attend_id='".$insert_id."'")->row();
    	            return $reqqq;
    	        }else{
    	            return FALSE;
    	        }
	    
	        }
	        else
	        {
	            $ress=$this->db->where(array('attend_userid'=>$participationdata['userid'],'attend_eventid'=>$participationdata['eventid']))->update('event_attending_status',$data_insert);
    	        if($ress==TRUE){
    	            
    	            $checkdatas = $this->db->where(array('attend_userid'=>$participationdata['userid'],'attend_eventid'=>$participationdata['eventid']))->get('event_attending_status')->row();
    	            $reqqq=$this->db->query("select * from event_attending_status where attend_id='".$checkdatas->attend_id."'")->row();
    	            return $reqqq;
    	        }else{
    	            return FALSE;
    	        }
	        }
	        
	        
	        
	    
	}
	
    public function get_check_invite_byuser($touserid,$byuserid,$eventid){
	    
	    $query=$this->db->query("select * from event_invite where event_invite_byuserid='".$byuserid."' and event_invite_touserid='".$touserid."' and event_invite_eventid='".$eventid."'")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        return FALSE;
	    }
	    
	}

    public function save_event_invite_deetails($eventdata){
	    
	    $useriddd=$this->json_array['touserid'];
		$explodrec=explode(",",$useriddd);
	    
	    foreach($explodrec as $rid)
	    { 
	       $data_insert=array(
	           "event_invite_byuserid"=>$eventdata['byuserid'],
	           "event_invite_touserid"=>$rid,
	           "event_invite_eventid"=>$eventdata['eventid'],
	           "event_invite_creatdate"=>date('Y-m-d',strtotime($eventdata['created_date'])),
	           "event_invite_creattime"=>date('H:i:s',strtotime($eventdata['created_time'])),
	           "event_invite_type"=>"1"
	        );
	        
	        $ress=$this->db->insert('event_invite',$data_insert); 
	        
	        if($ress==TRUE){
	           
	           $notification = array(
	            'ids'=>my_random(),
	            'by_user_ids'=>$rid,
	            'to_user_ids'=>$eventdata['byuserid'],
	            'subject'=>'Event Invite',
	            'body'=>'Event Invite',
	            'request_for'=>"Event",
    	        'request_id'=>$eventdata['eventid'],
	            'is_read' => '0',
	            
	            );
	        $this->user_model->add_notification($notification);
	           
	           
	            
	        }
	        
	        
	    }    
	       
	    return TRUE;   
	       
	        
	    
	    
	}
	
	public function get_check_event_attedance($user_id,$eventid)
	{
	    $get = $this->db->where(array('booking_userid'=>$user_id,'booking_eventid'=>$eventid))->get('event_booking')->row();
	    
	    if($get->bookin_attedance == '1'){ $booking_attedance = 'Present'; }
	    if($get->bookin_attedance == '2'){ $booking_attedance = 'Absent'; }
	    if($get->bookin_attedance == '3'){ $booking_attedance = 'Pending Conformation'; }
	    return $get->bookin_attedance;
	    //return $booking_attedance;
	}
	
	
   	public function get_all_event_register_list($eventid,$user_id,$keyword){
	    $query=$this->db->query("select * from event_booking where booking_eventid ='".$eventid."' order by booking_id desc")->result();  
	    $data_array=array();
	    
	    $sql = '';
	    
	    if($keyword != '')
	    {
	        //$keyword = $this->json_array['keyword'];
	        $sql.=" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%'))";
	    }
	    
	    
	    if(isset($query) && !empty($query)){
	     
	        foreach($query as $resultdata){
	            
	       $user_ids =     $resultdata->booking_userid; 
	            
	           $usr_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,designation,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type from user where `id`=$user_ids  AND membership_type !='0' $sql")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
	           if($usr_data)
	           {
	            $dataarray=array(
	                    "registerid"=>$resultdata->booking_id,
	                    "eventid"=>$resultdata->booking_eventid,
	                    "userid"=>$usr_data->id,
	                    "username"=> ucwords($usr_data->full_name),
	                    "userimage"=>$usr_data->profile_pic,
	                    "designation"=>$usr_data->designation,
	                    "check_connection"=>$this->get_check_connections($usr_data->id,$user_id),
	                    "event_attedance"=>$this->get_check_event_attedance($usr_data->id,$eventid),
	                );
	                
	                array_push($data_array,$dataarray);
	           } 
	        }
	        
	        if(isset($data_array) && !empty($data_array)){
	            
	            return $data_array;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}


    public function get_all_event_attending_status_list($eventid){
	    $query=$this->db->query("select * from event_attending_status where attend_eventid ='".$eventid."' order by attend_id desc")->result();  
	    $data_array=array();
	    if(isset($query) && !empty($query)){
	     
	        foreach($query as $key=>$resultdata){
	            
	       $user_ids =  $resultdata->attend_userid; 
	            
	           $query = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,designation,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type from user where `id`=$user_ids  AND membership_type !='0' $sql")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
               
        
               if($resultdata->attend_type == '1')
	           {
	              $type = 'Interested'; 
	           }
	           elseif($resultdata->attend_type == '2')
	           {
	              $type = 'Attending';     
	           }
	           else
	           {
	             $type = 'May Be';   
	           }
	           
	            $dataarray=array(
	                    "srno"=> $key+1,
	                    "userid"=>$query->id,
	                    "username"=>$query->full_name,
	                    "userimage"=>$query->profile_pic,
	                    "statustype"=>$type
	                    
	                );
	                
	                array_push($data_array,$dataarray);
	            
	        }
	        
	        if(isset($data_array) && !empty($data_array)){
	            
	            return $data_array;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}


	public function get_check_bookdetail($userid,$eventid){
	    
	    $query=$this->db->query("select * from event_booking where booking_userid='".$userid."' and booking_eventid='".$eventid."'")->row();
	    if(isset($query) && !empty($query)){
	         
	        
	       $bookingdata = array( 
	        
	         "booking_id"=> $query->booking_userid,
             "booking_userid"=> $query->booking_userid,
             "booking_eventid"=> $query->booking_eventid,
             "booking_username"=> $query->booking_username,
             "booking_cmpname"=> $query->booking_cmpname,
             "booking_category"=> $query->booking_category,
             "booking_useremail"=> $query->booking_useremail,
             "booking_userphno"=> $query->booking_userphno,
             "booking_amount"=> $query->booking_amount,
             "booking_creatdate"=> $query->booking_creatdate,
             "booking_creattime"=> $query->booking_creattime,
             "booking_creatat"=> $query->booking_creatat,
             "bookin_status"=> $query->bookin_status,
             "bookin_attedance" => $query->bookin_attedance
	        );
	        
	        return $bookingdata;
	        
	    }else{
	        
	        return FALSE;
	    }
	    
	}
	
	
	public function save_booking_deetails($bookdata){
	    
	     
	    $data_insert=array(
	           "booking_userid"=>$bookdata['userid'],
	           "booking_eventid"=>$bookdata['eventid'],
	           "booking_username"=>$bookdata['username'],
	           "booking_cmpname"=>$bookdata['companyname'],
	           "booking_category"=>$bookdata['categoryname'],
	           "booking_useremail"=>$bookdata['useremail'],
	           "booking_userphno"=>$bookdata['userphno'],
	           "booking_amount"=>$bookdata['amount'],
	           "booking_creatdate"=>date('Y-m-d',strtotime($bookdata['created_date'])),
	           "booking_creattime"=>date('H:i:s',strtotime($bookdata['created_time'])),
	           "bookin_status"=>"1",
	           "bookin_attedance"=>"3"
	        );
	        
	        $ress=$this->db->insert('event_booking',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from event_booking where booking_id='".$insert_id."'")->row();
	            
	            
	            $event_participate_status=array(
        	           "attend_userid"=>$bookdata['userid'],
        	           "attend_eventid"=>$bookdata['eventid'],
        	           "attend_type "=>'2',
        	           "attend_creattime"=>date('Y-m-d',strtotime($bookdata['created_date'])),
        	           "attend_creatdate"=>date('H:i:s',strtotime($bookdata['created_time'])),
        	           
        	        );
	        
	            $ress=$this->db->insert('event_attending_status',$event_participate_status);
	            
	            $bookingdata = array( 
	        
	         "booking_id"=> $reqqq->booking_userid,
             "booking_userid"=> $reqqq->booking_userid,
             "booking_eventid"=> $reqqq->booking_eventid,
             "booking_username"=> $reqqq->booking_username,
             "booking_cmpname"=> $reqqq->booking_cmpname,
             "booking_category"=> $reqqq->booking_category,
             "booking_useremail"=> $reqqq->booking_useremail,
             "booking_userphno"=> $reqqq->booking_userphno,
             "booking_amount"=> $reqqq->booking_amount,
             "booking_creatdate"=> $reqqq->booking_creatdate,
             "booking_creattime"=> $reqqq->booking_creattime,
             "booking_creatat"=> $reqqq->booking_creatat,
             "bookin_status"=> $reqqq->bookin_status,
             "bookin_attedance" => $reqqq->bookin_attedance
	        );
	        
	        return $bookingdata;
	            
	            //return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	public function get_list_recommendations_to($userid){
	    
	    $sql = '';
	    
	    if($this->json_array['keyword'] != '')
	    {
	        $keyword = $this->json_array['keyword'];
	        $sql.=" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%'))";
	    }
	    
	    
	    if($this->json_array['sortby'] == '1')
	    {
	        
	        $sort_by = "ORDER BY `first_name` ASC";
	    }
	    elseif($this->json_array['sortby'] == '2')
	    {
	        
	        $sort_by = "ORDER BY `first_name` DESC";
	    }
	    elseif($this->json_array['sortby'] == '3')
	    {
	        
	        $sort_by = "ORDER BY `doe` ASC";
	    }
	    elseif($this->json_array['sortby'] == '4')
	    {
	        
	        $sort_by = "ORDER BY `doe` DESC";
	    }
	    else
	    {
	        $sort_by = "";
	    }
	    
	    
	    if($this->json_array['filterby'] == '1')   // most recommended
	    {
	       //$query=$this->db->query("select recomendation.id as recom_id,COUNT(recomendation.id) as visits from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='".$userid."' $sql GROUP BY recomendation.id ORDER BY visits DESC")->result(); 
	     $query=$this->db->query("select recomendation.id as recom_id from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='".$userid."' $sql  $sort_by")->result(); 
	       
	    }
	    elseif($this->json_array['filterby'] == '2') //Self recommended
	    {
	       $query=$this->db->query("select recomendation.id as recom_id from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='".$userid."' AND recomendation.userid='".$userid."' $sql  $sort_by")->result(); 
	       
	    }
	    else
	    {
	       $query=$this->db->query("select recomendation.id as recom_id from `recomendation` INNER JOIN user ON user.id = recomendation.userid  where recomendation.recomend_by='".$userid."' $sql  $sort_by")->result(); 
	       
	    }
	    
	    
	            
	    
	    
	    if(isset($query) && !empty($query)){
	        
	        foreach($query as $valdata)
	        {
	            $recom_id = $valdata->recom_id;
	            
	            $val_data = $this->db->where(array("id"=>$recom_id))->get('recomendation')->row();
	            $roww = $this->db->query("select * from requirements where id='".$val_data->requirement_id."'")->row();  //echo $this->db->last_query();
	            
	            $userdetails=$this->db->query("select * from user where id='".$val_data->userid."'")->result();
	            
	            $get_recommendedto_count = $this->db->query("select * from `recomendation` where recomend_by !='".$userid."' AND requirement_id = '".$val_data->requirement_id."'")->num_rows(); 
        	   // echo $this->db->last_query();
        	    if(empty($get_recommendedto_count)){$get_recommendedto_counts = '0';} else { $get_recommendedto_counts = "$get_recommendedto_count";}
	            
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            
	            $query_data[]=array(
	                
	                    "userid"=>$roww->user_id,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "full_name"=>$full_name,
	                    "email"=>$email,
	                    "mobile"=>$mobile,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "company_phone"=>$company_phone,
	                    "company_address"=>$company_address,
	                    "dob"=>$dob,
	                    "profile_pic"=>$profilepic,
	                    "count"=>$get_recommendedto_counts,
                            "is_viewed"=>$this->check_user_visibility($userid,$roww->user_id)
	                );
	        }
	        
	        //print_r($query_data);
	        //return $query_data;
	        
	        if($this->json_array['filterby'] == '1')   // most recommended
    	    {
    	       array_multisort(array_map(function($element) {
                      return $element['count'];
                  }, $query_data), SORT_DESC, $query_data);
    	    }
	        
	        
	        if($this->json_array['sortby'] == '5')
    	    {
    	        
    	        array_multisort(array_map(function($element) {
                      return $element['count'];
                  }, $query_data), SORT_ASC, $query_data);

             return $query_data;
    	    }
    	    elseif($this->json_array['sortby'] == '6')
    	    {
    	        
    	        array_multisort(array_map(function($element) {
                      return $element['count'];
                  }, $query_data), SORT_DESC, $query_data);

             return $query_data;
    	    }
    	    else
    	    {
    	        return $query_data;
    	    }
	        
	        
	        
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	

	
	public function get_list_recommendations_by($userid){
	    
	    $sql = '';
	    
	    if($this->json_array['keyword'] != '')
	    {
	        $keyword = $this->json_array['keyword'];
	        $sql.=" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%'))";
	    }
	    
	    
	    if($this->json_array['sortby'] == '1')
	    {
	        
	        $sort_by = "ORDER BY `first_name` ASC";
	    }
	    elseif($this->json_array['sortby'] == '2')
	    {
	        
	        $sort_by = "ORDER BY `first_name` DESC";
	    }
	    elseif($this->json_array['sortby'] == '3')
	    {
	        
	        $sort_by = "ORDER BY `doe` ASC";
	    }
	    elseif($this->json_array['sortby'] == '4')
	    {
	        
	        $sort_by = "ORDER BY `doe` DESC";
	    }
	    else
	    {
	        $sort_by = "";
	    }
	    
	    
	    if($this->json_array['filterby'] == '1')   // most recommended
	    {
	        
	    $query=$this->db->query("select recomendation.id as recom_id from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='".$userid."' $sql  $sort_by")->result(); 
	   
	    }
	    elseif($this->json_array['filterby'] == '2') //Self recommended
	    { 
	        $query=$this->db->query("select recomendation.id as recom_id from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='".$userid."' AND recomendation.recomend_by='".$userid."' $sql  $sort_by")->result(); 
	       
	    }
	    else
	    {
	        $query=$this->db->query("select recomendation.id as recom_id from `recomendation` INNER JOIN user ON user.id = recomendation.recomend_by  where recomendation.userid='".$userid."' $sql  $sort_by")->result(); 
	   
	        
	    }
	    
	    
	    
//	    print_r($query);die;
	    if(isset($query) && !empty($query)){
	        
	        foreach($query as $valdata1)
	        {
	            $recom_id = $valdata1->recom_id;
	            
	            $val_data = $this->db->where(array("id"=>$recom_id))->get('recomendation')->row();
	            $roww = $this->db->query("select * from requirements where id='".$val_data->requirement_id."'")->row();  //echo $this->db->last_query();
	            
	            $get_recommendedby_count = $this->db->query("select * from `recomendation` where userid !='".$userid."' AND requirement_id = '".$val_data->requirement_id."'")->num_rows(); 
	   
	            
	            if(empty($get_recommendedby_count)){$get_recommendedby_counts = '0';} else { $get_recommendedby_counts = $get_recommendedby_count;}
	            
	            //$roww=$this->db->query("select * from `requirements` INNER JOIN user ON user.id = requirements.user_id  where requirements.id='".$val_data->requirement_id."' $sql")->result(); 
	            
	            
	            //$userdetails=$this->db->query("select * from user where id='".$roww->user_id."'")->result();
	            
	            $userdetails=$this->db->query("select * from user where id='".$val_data->recomend_by."'")->result();
	            
	            $rs=$userdetails[0];
	            $full_name=$rs->first_name." ".$rs->middle_name." ".$rs->last_name;
	            $email=$rs->email_address;
	            $mobile=$rs->phone;
	            $designation=$rs->designation;
	            $company_name=$rs->company;
	            $company_phone=$rs->company_contact;
	            $company_address=$rs->company_address;
	            $dob=$rs->dob;
	            $profilepic=base_url()."upload/avatar/".$rs->avatar;
	            
	            
	            $query_data[]=array(
	                
	                    "userid"=>$roww->user_id,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>empty($roww->thumbnil)?'':base_url().'upload/requirements/'.$roww->thumbnil,
	                    "created_date"=>$roww->created_date,
	                    "created_time"=>$roww->created_time,
	                    "full_name"=>$full_name,
	                    "email"=>$email,
	                    "mobile"=>$mobile,
	                    "designation"=>$designation,
	                    "company_name"=>$company_name,
	                    "company_phone"=>$company_phone,
	                    "company_address"=>$company_address,
	                    "dob"=>$dob,
	                    "profile_pic"=>$profilepic,
	                    "count"=>$get_recommendedby_count,
                            "is_viewed"=>$this->check_user_visibility($userid,$roww->user_id)
	                
	                );
	        }
	        
	        if($this->json_array['filterby'] == '1')   // most recommended
    	    {
    	       array_multisort(array_map(function($element) {
                      return $element['count'];
                  }, $query_data), SORT_DESC, $query_data);
    	    }
	        
	        
	        if($this->json_array['sortby'] == '5')
    	    {
    	        
    	        array_multisort(array_map(function($element) {
                      return $element['count'];
                  }, $query_data), SORT_ASC, $query_data);

             return $query_data;
    	    }
    	    elseif($this->json_array['sortby'] == '6')
    	    {
    	        
    	        array_multisort(array_map(function($element) {
                      return $element['count'];
                  }, $query_data), SORT_DESC, $query_data);

             return $query_data;
    	    }
    	    else
    	    {
    	        return $query_data;
    	    }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function save_buddy_meet($buddymeetdetails){
	    
	    
	    
	    $data_insert=array(
	           "buddy_meet_touserid"=>$buddymeetdetails['userid'],
	           "buddy_meet_withuserid"=>$buddymeetdetails['buddiesid'],
	           "buddy_meet_desc"=>$buddymeetdetails['description'],
	           "buddy_meet_location"=>$buddymeetdetails['location'],
	           "buddy_meet_date"=>date('Y-m-d',strtotime($buddymeetdetails['date'])),
	           "buddy_meet_time"=>date('H:i:s',strtotime($buddymeetdetails['time'])),
	           "buddy_meet_day"=>date('D', strtotime($buddymeetdetails['date'])), 
	           "buddy_meet_creatdate"=>date('Y-m-d',strtotime($buddymeetdetails['created_date'])),
	           "buddy_meet_creattime"=>date('H:i:s',strtotime($buddymeetdetails['created_time'])),
	           "buddy_meet_monthyear"=>substr($buddymeetdetails['date'],3,12)
	        );
	        
	        $ress=$this->db->insert('buddy_meet',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
                    $rs_email = $this->db->where('purpose', 'invitation')->get('email_template')->row(); 
            $buddy_meet_info = $this->db->where('buddy_meet_id',$insert_id)->get('buddy_meet')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['buddy_meet'] = $buddy_meet_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/buddy_meet_invitation', $data,true);
//            echo $body;
            $user_info = $this->db->where('id',$buddymeetdetails['userid'])->get('user')->row();
            $user_info1 = $this->db->where('id',$buddymeetdetails['buddiesid'])->get('user')->row();
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
                $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
//                print_r($res);
	           $data_insert1=array(
	           "post_userid"=>$buddymeetdetails['userid'],
	           "post_catid"=>0,
	           "post_description"=>$buddymeetdetails['description'],
	           "post_image"=>'',
	           "post_date"=>date('Y-m-d',strtotime($buddymeetdetails['date'])),
	           "post_time"=>date('H:i:s',strtotime($buddymeetdetails['time'])),
                       "post_type"=>1,
                       "post_type_id"=>$insert_id
	        );
	        
	        $ress1=$this->db->insert('postdetail',$data_insert1);
	            $notification = array(
    	            'ids'=>my_random(),
    	            'by_user_ids'=>$buddymeetdetails['buddiesid'],
    	            'to_user_ids'=>$buddymeetdetails['userid'],
    	            'subject'=>'New Buddy Meet Request',
    	            'body'=>'New Buddy Meet Request',
    	            'request_for'=>"BuddyMeet",
        	        'request_id'=>$insert_id,
    	            'is_read' => '0',
    	            
    	            );
	        $this->add_notification($notification);
	            
	            $getusername = $this->getusernames($buddymeetdetails['buddiesid']);
	      // $getrewardusername = $this->getusernames($user['userid']);
	            
	            $this->add_reward_point('BuddyMeet',$buddymeetdetails['userid'],$buddymeetdetails['date'],$buddymeetdetails['time'],$getusername); 
	           
	            $reqqq=$this->db->query("select * from buddy_meet where buddy_meet_id='".$insert_id."'")->result();
	            $useriddd=$this->db->query("select * from user where id='".$buddymeetdetails['userid']."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$buddymeetdetails['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$buddymeetdetails['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>3,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
                    return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	function compareByTimeStamp($time1, $time2)
    {
        if (strtotime($time1) < strtotime($time2))
            return 1;
        else if (strtotime($time1) > strtotime($time2)) 
            return -1;
        else
            return 0;
    }
	
	
	
	public function app_get_buddy_meet_list($userid)
	{
	   $obj = array();
	   $check_month = $this->db->select('buddy_meet_monthyear as monthyers')->order_by('buddy_meet_monthyear','DESC')->group_by('buddy_meet_monthyear')->get('buddy_meet')->result();
	   
	   
	   
	   foreach($check_month as $val_month)
	   {
	       $month = $val_month->monthyers;
	      // $query = $this->db->where(array('buddy_meet_monthyear'=>$month))->where(array('buddy_meet_touserid'=>$userid))->or_where(array('buddy_meet_withuserid'=>$userid))->order_by('buddy_meet_id','DESC')->get('buddy_meet')->result();   
	    //echo $this->db->last_query();
	    
	    
	    $query=$this->db->query("select * from buddy_meet where buddy_meet_monthyear='$month' AND ( buddy_meet_touserid = $userid OR buddy_meet_withuserid =$userid) ORDER BY buddy_meet_id DESC ")->result();
	    
	    
	        if(isset($query) && !empty($query)){
	        $query_data = array();
	        
	        foreach($query as $val_data)
	        {
	           
	           if($userid == $val_data->buddy_meet_touserid)
	           {
	               $userids = $val_data->buddy_meet_withuserid;
	               $chatid = $this->getfirebaseid($val_data->buddy_meet_withuserid);
	           }
	           else
	           {
	               $userids = $val_data->buddy_meet_touserid;
	               $chatid = $this->getfirebaseid($val_data->buddy_meet_touserid);
	           }
	           
	           
	           $user_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids  AND membership_type !='0'")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
       
               $meetdate = $val_data->buddy_meet_date;
       
	           $query_data[] = array(
	                    "buddymeet_id"=> $val_data->buddy_meet_id,
                        "buddymeet_description"=> $val_data->buddy_meet_desc,
                        "buddymeet_location"=> $val_data->buddy_meet_location,
                        "buddymeet_date"=> $val_data->buddy_meet_date,
                        "buddymeet_time"=> $val_data->buddy_meet_time,
                        "buddymeet_day"=> $val_data->buddy_meet_day,
                        "buddymeet_userid"=> $user_data->id,
                        "buddymeet_username"=> $user_data->full_name,
                        "buddymeet_userprofile"=> $user_data->profile_pic,
                        "chat_id"=>$chatid ,
                        "is_viewed"=>$this->check_user_visibility($userid,$user_data->id)
                  ); 
	            
	        }
	        
	        if($query_data)
	        {
	            array_push($obj,array("monthname"=>$month,'buddymeetdata'=>$query_data));
	        }
	        
	        
	        
	        
	    }
	       
	       
	   }
	   
//	   return $obj;
	    $data['buddy_meet_info'] = $obj;
            $recommendation = 0;
                    $check_in_usertble = $this->db->where('id',$userid)->get('user')->row();
                    $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>3))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>3,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $recommendation = 1;
                   }
                }                                   
            }
            $data['is_buddy_meet_exhausted'] = $recommendation;	
				return $data;
	}
	
	
	
	
	public function save_recognition_deetails($reqq,$filename){
	    
	    $data_insert=array(
	           "recognition_userid"=>$reqq['userid'],
	           "recognition_title"=>$reqq['title'],
	           "recognition_description"=>$reqq['description'],
	           "recognition_image"=>$filename,
	           "recognition_creatdate"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "recognition_creattime"=>date('H:i:s',strtotime($reqq['created_time']))
	        );
	        
	        $ress=$this->db->insert('recognition',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
                    $rs_email = $this->db->where('purpose', 'recognition')->get('email_template')->row(); 
            $recognition_info = $this->db->where('recognition_id',$insert_id)->get('recognition')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['recognition'] = $recognition_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/recognition', $data,true);
//            echo $body;
            $user_info = $this->db->where('id',$reqq['userid'])->get('user')->row();
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
//                print_r($res);
	            $reqqq=$this->db->query("select * from recognition where recognition_id='".$insert_id."'")->row();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function get_all_recognition($userid,$type){
	    
	    if($type == '1')
	    {
	        $query=$this->db->query("select * from recognition WHERE recognition_status='1' order by recognition_id desc")->result();
	    }
	    else
	    {
	        $query=$this->db->query("select * from recognition where recognition_userid ='".$userid."' AND recognition_status='1' order by recognition_id desc")->result();
	    }
	    
	      
	    $data_array=array();
	    if(isset($query) && !empty($query)){
	     
	        foreach($query as $resultdata){
	            
	            $dataarray=array(
	                
	                    "id"=>$resultdata->recognition_id,
	                    "title"=>$resultdata->recognition_title,
	                    "description"=>$resultdata->recognition_description,
	                    "thumbnail"=>base_url().'upload/recognition/'.$resultdata->recognition_image,
	                    "created_date"=>$resultdata->recognition_creatdate,
	                    "created_time"=>$resultdata->recognition_creattime,
	                    
	                );
	                
	                array_push($data_array,$dataarray);
	            
	        }
	        
	        if(isset($data_array) && !empty($data_array)){
	            
	            return $data_array;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function delete_recognition($recognid,$userid){
	    
	             $this->db->where('recognition_id',$recognid);
	             $this->db->where('recognition_userid',$userid);
	        
	        $ress=$this->db->delete('recognition');
	        if($ress==TRUE){
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	public function get_fallowup_lead_requirement_data($userid,$type,$keyword){
	    
	    if($type == '1')   // MY LEAD
	    {
	        $req = array();
	         $query=$this->db->query("select requirement_id from recomendation where (userid='".$userid."')   GROUP BY requirement_id")->result();  //recomend_by
    	     if(isset($query) && !empty($query))
    	     {
    	        foreach($query as $valdata)
    	        {
    	            array_push($req,$valdata->requirement_id);
    	          
    	        } 
    	        if(empty($keyword))
    	        {
    	            $roww = $this->db->query("select * from requirements where id IN(".implode(',',$req).")")->result();  
    	        }
    	        else
    	        {
    	            $roww = $this->db->query("select * from requirements where id IN(".implode(',',$req).") AND title like '%{$keyword}%'")->result();  
    	        }
    	        if(!empty($roww))
    	        {
    	            foreach($roww as $val)
    	            {
    	          $data_array[] = array(
    	              'requirement_id'=>$val->id,
    	              'requirement_title'=>$val->title,
    	              );
    	            }
    	            return $data_array;
    	        }
    	        else
    	        {
    	            return FALSE;
    	        }
    	     }
    	     else
    	     {
    	         return FALSE;
    	     }
	    }     
	    else
	    {
	        if(empty($keyword))
	        {
	            $query=$this->db->query("select * from requirements where user_id='".$userid."'")->result();
	        }
	        else
	        {
	            $query=$this->db->query("select * from requirements where user_id='".$userid."' AND title like '%{$keyword}%'")->result();
	        }
	        if(isset($query) && !empty($query))
    	    {
    	        foreach($query as $valdata)
    	        {
    	          
    	          $data_array[] = array(
    	              'requirement_id'=>$valdata->id,
    	              'requirement_title'=>$valdata->title,
    	              );
    	        } 
    	        return $data_array;
    	    } 
    	    else
    	     {
    	         return FALSE;
    	     }
	    }
	    
	    
	    
	    
	}
	
	
	public function get_fallowup_lead_requirement_user_data($reqid,$type){
	    
	    if($type == '1')   
	    {
	         $query=$this->db->query("select recomend_by from recomendation where requirement_id='".$reqid."' GROUP BY recomend_by ")->result();  //GROUP BY requirement_id
    	     
    	   
    	     if(isset($query) && !empty($query))
    	     {
    	        foreach($query as $valdata)
    	        {
    	          
    	           $requserid = $valdata->recomend_by;
	        
	               $user_data = $this->db->select("id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name")->where('id',$requserid)->get('user')->row();
    	          
    	          
    	          
    	          $data_array[] = array(
    	              'user_id'=>$user_data->id,
    	              'user_name'=>$user_data->full_name,
    	              );
    	        } 
    	        return $data_array;
    	     }
    	     else
    	     {
    	         return FALSE;
    	     }
	    }     
	    else  // MY LEAD
	    {
	        $query=$this->db->query("select * from requirements where id='".$reqid."'")->row();
	        $requserid = $query->user_id;
	        
	        //$user_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids  AND membership_type !='0' $sql")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
            $user_data = $this->db->select("id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name")->where('id',$requserid)->get('user')->result();
	        
	        if(isset($user_data) && !empty($user_data))
    	    {
    	        foreach($user_data as $valdata)
    	        {
    	          
    	          $data_array[] = array(
    	              'user_id'=>$valdata->id,
    	              'user_name'=>$valdata->full_name,
    	              );
    	        } 
    	        /*$data_arrays = group_by("user_id", $data_array);
    	        return $data_arrays;*/
    	        return $data_array;
    	    } 
    	    else
    	     {
    	         return FALSE;
    	     }
	    }
	    
	    
	    
	    
	}
	
	

	public function save_follow_up($followupdata){
	    
	   
	    
	    $followdate = $followupdata['date'];
	    //$followsdate = substr($followdate,0,11);
	    
        
        $follow_date = date("D", strtotime($followsdate)).', '.$followdate; 
        
	    $data_insert=array(
	           "followup_type"=>$followupdata['type'],
	           "followup_requirementid"=>$followupdata['requirementid'],
	           "followup_byuserid"=>$followupdata['byuserid'],
	           "followup_touserid"=>$followupdata['touserid'],
	           "followup_description"=>$followupdata['description'],
	           "followup_date"=>date('Y-m-d',strtotime($followupdata['date'])),
	           "followup_time"=>date('H:i:s',strtotime($followupdata['time'])),
	           "followup_day"=>date('D', strtotime($followupdata['date'])),
	           "followup_creatdate"=>date('Y-m-d',strtotime($followupdata['created_date'])),
	           "followup_creattime"=>date('H:i:s',strtotime($followupdata['created_time'])),
	           "followup_monthyear"=>substr($followupdata['date'],3,12)
	        );
	        
	        $ress=$this->db->insert('followup',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	           
	            $notification = array(
    	            'ids'=>my_random(),
    	            'by_user_ids'=>$followupdata['touserid'],
    	            'to_user_ids'=>$followupdata['byuserid'],
    	            'subject'=>'New Followup Request',
    	            'body'=>'New Followup Request',
    	            'request_for'=>"Followup",
        	        'request_id'=>$insert_id,
    	            'is_read' => '0',
    	            
    	            );
	        $this->add_notification($notification);
	            
	            $reqqq=$this->db->query("select * from followup where followup_id='".$insert_id."'")->result();
	            $useriddd=$this->db->query("select * from user where id='".$followupdata['byuserid']."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$followupdata['byuserid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$followupdata['byuserid'],'package_id'=>$useriddd->packages_id,'feature_id'=>4,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
                    return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function app_get_fallowup_list($userid){
	   
	   $check_month = $this->db->select('followup_monthyear as monthyers')->order_by('followup_monthyear','DESC')->group_by('followup_monthyear')->get('followup')->result();
	   
	   $obj = array();
	   
	   foreach($check_month as $val_month)
	   {
	       $month = $val_month->monthyers;
	       $query = $this->db->query("select * FROM followup where followup_monthyear='$month' AND (followup_byuserid=$userid or followup_touserid=$userid) ORDER BY `followup_date` DESC")->result();   
	    
	    
	        if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	           $req_data = $this->db->where(array('id'=>$val_data->followup_requirementid))->get('requirements')->row();
	           
	           if($userid == $val_data->followup_byuserid)
	           {
	               $userids = $val_data->followup_touserid;
	           }
	           else
	           {
	               $userids = $val_data->followup_byuserid;
	           }
	           
	           
	           $user_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids  AND membership_type !='0' ")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
	             $query_data[] = array(
	                    "followup_id"=> $val_data->followup_id,
                        "followup_reqid"=> $req_data->id,
                        "followup_title"=> $req_data->title,
                        "followup_description"=> $val_data->followup_description,
                        "followup_date"=> $val_data->followup_date,
                        "followup_time"=> $val_data->followup_time,
                        "followup_day"=> $val_data->followup_day,
                        
                        "followup_userid"=> $user_data->id,
                        "followup_username"=> $user_data->full_name,
                        "followup_userprofile"=> $user_data->profile_pic,
                        "is_viewed"=>$this->check_user_visibility($userid,$user_data->id)
                  ); 
	            
	        }

            if($query_data)
	        {
	            array_push($obj,array("monthname"=>$month,'followupdata'=>$query_data));
	        }


	        }
	    	 
	    }
            $data['followup_info'] = $obj;
            $recommendation = 0;
                    $check_in_usertble = $this->db->where('id',$userid)->get('user')->row();
                    $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>4))->get('package_features')->row();
            $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
            $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>4,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
            if($pf_info->count_allowed > 0)
            {                                   
                if(!empty($user_consumption))
                {
                   if($user_consumption->used_count == $pf_info->count_allowed)
                   {
                       $recommendation = 1;
                   }
                }                                   
            }
            $data['is_followup_exhausted'] = $recommendation;
	    return $data;
	        
	       
	    
	}
	
	public function app_get_guest_invite_event_list($userid){
	   
	   
	    $query = $this->db->where(array('event_invite_byuserid'=>$userid,'event_invite_type'=>'2'))->order_by('event_invite_id','DESC')->get('event_invite')->result();   
	    
	    
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	           $req_data = $this->db->select('event_title')->where(array('event_id'=>$val_data->event_invite_eventid,'event_status'=>'1'))->get('events')->row();
	           
	           if($val_data->status == '1')
	           {
	               $status = 'Confirmed';
	           }
	           elseif($val_data->status == '2')
	           {
	               $status = 'Requested';
	           }
	           elseif($val_data->status == '3')
	           {
	               $status = 'Pending';
	           }
	           else
	           {
	               $status = '';
	           }
	          
	           if($val_data->approval_status == ''){$approval_status = '0';} else{$approval_status = $val_data->approval_status;}
	          
	          
	             $query_data[] = array(
	                    "invite_id"=> $val_data->event_invite_id,
                        "guestname"=> $val_data->event_invite_guestname,
                        "guestemail"=> $val_data->event_invite_email,
                        "guestphno"=> $val_data->event_invite_mobileno,
                        "guestcompany"=> $val_data->event_invite_companyname,
                        "guestdesignation"=> $val_data->event_invite_designation,
                        "eventname"=> $req_data->event_title,
                        "eventamount"=> $val_data->payment_amount,
                        "status"=> $status,
                        "approval_status"=> $approval_status,
                 ); 
	            
	        }
	        
	        
	        return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	
	public function app_get_guest_invite_event_detail($userid,$inviteid){
	   
	   
	    $query = $this->db->where(array('event_invite_id'=>$inviteid,'event_invite_byuserid'=>$userid,'event_invite_type'=>'2'))->order_by('event_invite_id','DESC')->get('event_invite')->result();   
	    
	    
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	           $req_data = $this->db->select('event_title')->where(array('event_id'=>$val_data->event_invite_eventid,'event_status'=>'1'))->get('events')->row();
	           
	           if($val_data->status == '1')
	           {
	               $status = 'Confirm';
	           }
	           elseif($val_data->status == '2')
	           {
	               $status = 'Requested';
	           }
	           elseif($val_data->status == '3')
	           {
	               $status = 'Pending';
	           }
	           else
	           {
	               $status = '';
	           }
	          
	           if($val_data->approval_status == ''){$approval_status = '0';} else{$approval_status = $val_data->approval_status;}
	          
	          
	             $query_data[] = array(
	                    "invite_id"=> $val_data->event_invite_id,
                        "guestname"=> $val_data->event_invite_guestname,
                        "guestemail"=> $val_data->event_invite_email,
                        "guestphno"=> $val_data->event_invite_mobileno,
                        "guestcompany"=> $val_data->event_invite_companyname,
                        "guestdesignation"=> $val_data->event_invite_designation,
                        "eventname"=> $req_data->event_title,
                        "amount"=> $val_data->payment_amount,
                        "status"=> $status,
                        "approval_status"=> $approval_status,
                 ); 
	            
	        }
	        
	        
	        return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function app_do_guest_invite_payment($invite_data){
	   
	  // $this->db->where('',$invite_data['payment_amount']);
	   $this->db->where('event_invite_byuserid',$invite_data['userid']);
	   $this->db->where('event_invite_id',$invite_data['invite_id']);
	   //$this->db->where('',$invite_data['invite_id']);
	   $this->db->set('payment_datetime',$invite_data['payment_datetime']);
	   $this->db->set('status',$invite_data['status']);
	   $this->db->set('payment_id',$invite_data['status']);
	   $query = $this->db->update('event_invite'); 
	   
	    if(isset($query) && !empty($query)){
	        
	        return TRUE;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	public function check_guest_event_invite($mobilenumber,$eventid){
	    
	    $qrr=$this->db->query("select * from event_invite where event_invite_type='2' AND event_invite_mobileno='".$mobilenumber."' AND event_invite_eventid='".$eventid."'")->result();
	    if(isset($qrr) && !empty($qrr)){
	        
	         $ress=array("status"=>TRUE,"id"=>$qrr[0]->event_invite_id);
	    }else{
	        
	         $ress=array("status"=>FALSE,"id"=>"null");
	        
	        
	    }
	    //print_r($ress);exit();
	    return $ress;
	    
	}
	
	public function save_guest_event_invite($eventdata){
	    
	        if($eventdata['verification_need'] == '1')
	        {
	            $approval_status = '2';
	        }
	        else
	        {
	           $approval_status = '1';
	        }
	    
	    $data_insert=array(
	           "event_invite_byuserid"=>$eventdata['userid'],
	           "event_invite_touserid"=>'',
	           "event_invite_eventid"=>$eventdata['eventid'],
	           "event_invite_guestname"=>$eventdata['guestname'],
	           "event_invite_mobileno"=>$eventdata['mobilenumber'],
	           "event_invite_email"=>$eventdata['emailid'],
	           "event_invite_designation"=>$eventdata['designation'],
	           "event_invite_companyname"=>$eventdata['companyname'],
	           "event_invite_creatdate"=>date('Y-m-d',strtotime($eventdata['created_date'])),
	           "event_invite_creattime"=>date('H:i:s',strtotime($eventdata['created_time'])),
	           "event_invite_type"=>"2",
	           "payment"=>$eventdata['payment'],
	           "payment_by"=>$eventdata['payment_by'],
	           "payment_amount"=>$eventdata['payment_amount'],
	           "payment_id"=>$eventdata['payment_id'],
	           "verification_need"=>$eventdata['verification_need'],
	           "status"=>$eventdata['status'],
	           "approval_status"=>$approval_status,
	           "payment_datetime"=>date('Y-m-d H:i:s',strtotime($eventdata['payment_datetime']))
	        );
	        
	        
	        
	        
	        $ress=$this->db->insert('event_invite',$data_insert); // echo $this->db->last_query();
	        if($ress==TRUE){
	           
	           $rs_email = $this->db->where('purpose', 'invite_email')->get('email_template', 1)->row();   
	           
	           $getevent = $this->db->where('event_id',$eventdata['eventid'])->get('events')->row();
	           
	           $eventschedules = $getevent->event_startdate.' to '.$getevent->event_enddate;
	           
	           //$body = str_replace('{{username}}', $eventdata['guestname'], str_replace('{{eventtitle}}',$getevent->event_title , $rs_email->body));
	           
	           $body = str_replace('{{username}}', $eventdata['guestname'], str_replace('{{eventtitle}}',$getevent->event_title , str_replace('{{eventaddress}}',$getevent->event_address , str_replace('{{eventschedule}}',$eventschedules , $rs_email->body))));
		
	
		$email = array(
			  'email_to' => $eventdata['emailid'],
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
	           
	           
	           
	           
	           
	          
	          // print_r($email);exit();
	           
	           
	            return $ress;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function add_reward_point($type,$userid,$creatdate,$creattime,$operations)
	{
	    if($type == 'LeadCreate')
	    {
	        $reward_id = '1';
	    }
	    elseif($type == 'RecommendedBy')
	    {
	        $reward_id = '2';
	    }
	    
	    elseif($type == 'LeadsReceived')
	    {
	        $reward_id = '3';
	    }
	    
	    elseif($type == 'BusinessShared')
	    {
	        $reward_id = '4';
	    }
	    
	    elseif($type == 'BusinessReceived')
	    {
	        $reward_id = '5';
	    }
	    
	    elseif($type == 'TestimonialShared')
	    {
	        $reward_id = '6';
	    }
	    
	    elseif($type == 'TestimonialReceived')
	    {
	        $reward_id = '7';
	    }
	    
	    elseif($type == 'BuddyMeet')
	    {
	        $reward_id = '8';
	    }
	    
	    elseif($type == 'GuestBecomeMember')
	    {
	        $reward_id = '10';
	    }
	    
	    elseif($type == 'AttendedtheMeet')
	    {
	        $reward_id = '9';
	    }
	    
	    
	    elseif($type == 'TotalNumberofMeetsAttended')
	    {
	        $reward_id = '11';
	    }
	    
	    
	    
	    $getdata = $this->db->where('id',$reward_id)->get('reward_point')->row();
	    
	    
	    // $getdata->activity
	    
	    $data_insert = array(
	        'userid'=>$userid,
	        'rewardid'=>$getdata->id,
	        'activity'=>$operations,
	        'point'=>$getdata->point,
	        'date'=>date('Y-m-d',strtotime($creatdate)),
	        'time'=>date('H:i:s',strtotime($creattime)),
	        );
	        
	        //print_r($data_insert);
	        
	    $this->db->insert('reward_user_point',$data_insert);
	    
	    
	}
	
	
	public function app_get_my_report_card($userid){
	   $obj = $reward_obj = array();
	   
	    $total_reward= $this->db->select('sum(point) as total_point')->where(array('userid'=>$userid))->get('reward_user_point')->row();   
	    
	    $get_reward_list = $this->db->select('id,activity')->get('reward_point')->result();
	    
	    foreach($get_reward_list as $val_reward)
	    {
	        $total_reward_point = $this->db->select('sum(point) as total_point')->where(array('userid'=>$userid,'rewardid'=>$val_reward->id))->get('reward_user_point')->row();  
	        
	        if(is_null($total_reward_point->total_point)){$total_reward_points = "0";} else {$total_reward_points = $total_reward_point->total_point;}
	        
	        $RewardActivity = array(
	            'RewardTitle'=>$val_reward->activity,
	            'RewardPoint'=>$total_reward_points,
	            'RewardDetail' =>$this->app_get_reward_detail_by_reward_id($val_reward->id,$userid)
	            );
	        
	        
	        array_push($reward_obj,array($RewardActivity));
	    }
	    
	    
	    if(empty($total_reward)){$total_reward = 0;}
	    
	    
	    
	    array_push($obj,array("TotalReward"=>$total_reward,"RewardDetail"=>$reward_obj));
	    return $obj;
	}
	
	public function app_get_reward_detail_by_reward_id($rewardid,$userid)
	{
	    $obj = array();
	    $getdata = $this->db->where(array('userid'=>$userid,'rewardid'=>$rewardid))->get('reward_user_point')->result();
	    
	    if(count($getdata) != '0')
	    {
	        foreach($getdata as $valdata)
	        {
	            $obj[] = array(
	               'ActivityName'=>$valdata->activity, 
	               'ActivityDate'=>$valdata->date,
	               'ActivityTime'=>$valdata->time,
	               'ActivityPoint'=>$valdata->point,
	                );
	        }
	        return $obj;
	    }
	    else
	    {
	        return $obj;
	    }
	    
	    
	    
	}
	
	public function app_get_testimonials($user_id){
	    $obj = array();
        
        $getuserdata = $this->db->query("select * from ratings_reviews where  review_note !='' AND status = '1' AND `user_id`=$user_id")->result();  //review_note !='NULL' AND
       // print_r($getuserdata);
        foreach($getuserdata as $valuser)
        {
            $userids = $valuser->reviewed_by;  //echo $userids;
            $givenuser = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
            if($valuser->review_note != '')
            {
               $userdata[] = array(
                'id'=>$userids,
                'title'=>$givenuser->full_name,
                'thumbnil'=>$givenuser->profile_pic,
                'review'=>$valuser->review_note,
                'rate'=>$valuser->ratings,
                'date'=>$valuser->review_date,
                'time'=>$valuser->review_time,
                'type'=>'User Review',
                'filterdate'=>$valuser->review_date.','.$valuser->review_time,
                   'is_viewed'=>$this->check_user_visibility($user_id,$givenuser->id)
                );
                
                
                
            }    
        }
        
        $geteventdata = $this->db->query("select * from event_ratings_reviews where  review_note !='' AND status = '1' AND  `user_id`=$user_id")->result();  //review_note !='NULL' AND
       // print_r($getuserdata);
        foreach($geteventdata as $valevent)
        {
            $eventids = $valevent->event_id;  //echo $userids;
            $givenevent = $this->db->query("select event_title,event_thumbnil from events where `event_id`=$eventids")->row();  
        
            if($valevent->review_note != '')
            {
            $userdata[] = array(
                'id'=>$eventids,
                'title'=>$givenevent->event_title,
                'thumbnil'=> base_url().'upload/events/'.$givenevent->event_thumbnil,
                'review'=>$valevent->review_note,
                'rate'=>$valevent->ratings,
                'date'=>$valevent->review_date,
                'time'=>$valevent->review_time,
                'type'=>'Event Review',
                'filterdate'=>$valevent->review_date.','.$valevent->review_time,
                );
            }    
        }
       
       $obj = array();
       
        if (!empty($userdata)) {
			
			$counts = count($getuserdata)+count($geteventdata); 
			
			if($counts == '' OR $counts == '0')
			{
			  $totalcounts = 0;  
			}
			else
			{
			  $totalcounts = $counts; 
			}
			
			array_multisort(array_map(function($element)
	              {
                      return $element['filterdate'];
                  }, $userdata), SORT_ASC, $userdata);
			
			
			array_push($obj,array("toalcount"=>$totalcounts,"reviewdata"=>$userdata));
			
			return $obj;	
			
		}
		else {
			return FALSE;
		}
	    
	}
	
	
	
	
	public function app_get_toprank_list($userid)
	{
	   $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,email_address as email,phone as mobile,designation,company as company_name,company_contact,company_address,dob,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type,packages_id from user where  membership_type !='0' $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
       $last_point = $i = '0';    
        foreach($getdata as $query)
        {
           
            $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query->id)->get('reward_user_point')->row();
            if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
        
             if($toal_points != "0"){
             
                 
                
                     $data_array[] = array(
                        "id"=> $query->id,
                        "full_name"=> $query->full_name,
                        "designation"=> $query->designation,
                        "company_name"=>$query->company_name,
                        "company_contact"=> $query->company_contact,
                        "profile_pic"=>$query->profile_pic,
                        "total_point"=>$toal_points,
                         "is_viewed"=>$this->check_user_visibility($userid,$query->id)
                        );
                    $i++;    
                        
                
                 
             }
        }
	    
	    if(isset($data_array) && !empty($data_array)){
	              array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $data_array), SORT_DESC, $data_array);
	        
	        
	        return  array_slice($data_array, 0, 10);
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
		public function check_review_ratings_j4e($userid){
	    
	    $qrr=$this->db->query("select * from j4e_ratings_reviews where status = '1' AND userid='".$userid."'")->result();
	    if(isset($qrr) && !empty($qrr)){
	        
	         $ress=array("status"=>TRUE,"id"=>$qrr[0]->id);
	    }else{
	        
	         $ress=array("status"=>FALSE,"id"=>"null");
	        
	        
	    }
	    
	    return $ress;
	    
	}
	
	public function get_j4e_ratings_data($user_rating_rev){
	    
	    $result=$this->db->query("select id,userid,ratings,review_note,review_date,review_time from j4e_ratings_reviews where status = '1' AND id='".$user_rating_rev."'")->result();
	    return $result;
	    
	}
	
	public function insert_j4e_ratings_review($userdata){
	    
	    
	    
	    $data_insert=array(
	            "userid"=>$userdata['userid'],
	            "ratings"=>$userdata['ratings'],
	            "review_note"=>$userdata['review_note'],
	            "review_date"=>$userdata['date'],
	            "review_time"=>$userdata['time'],
	        );
	        
	     $this->db->insert('j4e_ratings_reviews',$data_insert);   
	      $insert_id = $this->db->insert_id();
              
	      return $insert_id;
	        
	    
	}
	
	
	public function app_get_search_data($keyword,$userid){
	    
	   
	    //$buddiesmeetsql =" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%'))";
	    //$buddiesmeetsql .=" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%'))";
	    //$get_buddy_meet = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,email_address as email,phone as mobile,designation,company as company_name,company_contact,company_address,dob,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type,packages_id from user where `id`!=$user_id  AND membership_type !='0' $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
        $obj = $obj1 = array();
        $data_post = array();
        $data_post_count = 0;
        
        $postsql = '';
        $postsql .= " AND (  (postdetail.post_description LIKE '%$keyword%'))";
        //$postsql .= "  ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%') OR ( user.last_name LIKE '%$keyword%'))";
        
        $postquery=$this->db->query("select postdetail.*,user.id from `postdetail` INNER JOIN user ON user.id = postdetail.post_userid  where post_status = '1' $postsql")->result(); 
	     
	    if(isset($postquery) && !empty($postquery))
	    {
	        foreach($postquery as $valpost)
	        {
	            $data_post[] = array(
	                "id"=>$valpost->post_id,
	                "title"=>$valpost->post_description,
	                "thumbnil"=>base_url().'upload/post/'.$valpost->post_image,
	                "type"=>"POST",
	                );
	        }
	        
	        $data_post_count =  count($data_post);
	        array_push($obj1,array("Category"=>"POST","Count"=>$data_post_count,"Data"=>$data_post));
	        
	    }
	    
	    
	   
        $data_event = array();
        $data_event_count = 0;
        
        $eventsql = '';
        $eventsql .= "  ( (events.event_title LIKE '%$keyword%') OR ( events.event_address LIKE '%$keyword%') OR ( events.event_description LIKE '%$keyword%') )";
        
        
        $eventquery=$this->db->query("select events.*  from `events` where $eventsql")->result(); 
	     
	    if(isset($eventquery) && !empty($eventquery))
	    {
	        foreach($eventquery as $valevent)
	        {
	            $data_event[] = array(
	                "id"=>$valevent->event_id,
	                "title"=>$valevent->event_title,
	                "thumbnil"=>base_url().'upload/events/'.$valevent->event_thumbnil,
	                "type"=>"EVENT",
	                );
	        }
	        
	        $data_event_count =  count($data_event);
	        array_push($obj1,array("Category"=>"EVENT","Count"=>$data_event_count,"Data"=>$data_event));
	        
	    }
	    
	    
	    $data_recognization = array();
        $data_recognization_count = 0;
        
        $recognizationsql = '';
        $recognizationsql .= " ( (recognition.recognition_title LIKE '%$keyword%')  OR (recognition.recognition_description LIKE '%$keyword%'))";
        //$postsql .= "  ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%') OR ( user.last_name LIKE '%$keyword%'))";
        
        $recognizationquery=$this->db->query("select recognition.*,user.id from `recognition` INNER JOIN user ON user.id = recognition.recognition_userid  where $recognizationsql")->result(); 
	     
	    if(isset($recognizationquery) && !empty($recognizationquery))
	    {
	        foreach($recognizationquery as $valrecognization)
	        {
	            $data_recognization[] = array(
	                "id"=>$valrecognization->recognition_id,
	                "title"=>$valrecognization->recognition_title,
	                "thumbnil"=>base_url().'upload/recognition/'.$valrecognization->recognition_image,
	                "type"=>"RECOGNITION",
	                );
	        }
	        
	        $data_recognization_count =  count($data_recognization);
	        array_push($obj1,array("Category"=>"RECOGNITION","Count"=>$data_recognization_count,"Data"=>$data_recognization));
	        
	    }
	    
	    
	    
	    $leadsql = '';
        $leadsql .= " ( (requirements.title LIKE '%$keyword%') OR (requirements.description LIKE '%$keyword%') )";
        //$postsql .= "  ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%') OR ( user.last_name LIKE '%$keyword%'))";
        
        $leadquery=$this->db->query("select requirements.id as req_id,requirements.*,user.id from `requirements` INNER JOIN user ON user.id = requirements.user_id  where requirements.requirements_status ='1' AND $leadsql")->result(); 
	     
	    if(isset($leadquery) && !empty($leadquery))
	    {
	        foreach($leadquery as $vallead)
	        {
	            $data_lead[] = array(
	                "id"=>$vallead->req_id,
	                "title"=>$vallead->title,
	                "thumbnil"=>base_url().'upload/requirements/'.$vallead->thumbnil,
	                "type"=>"LEAD",
	                );
	        }
	        
	        $data_lead_count =  count($data_lead);
	        array_push($obj1,array("Category"=>"LEAD","Count"=>$data_lead_count,"Data"=>$data_lead));
	        
	    }
	    
	    
	    $membersql = '';
        $membersql .= " ( (user.first_name LIKE '%$keyword%') OR (user.middle_name LIKE '%$keyword%') OR (user.last_name LIKE '%$keyword%') )";
        
        
        
        $memberquery=$this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from `user` WHERE $membersql")->result(); 
	     
	    if(isset($memberquery) && !empty($memberquery))
	    {
	        foreach($memberquery as $valmember)
	        {
	            $data_member[] = array(
	                "id"=>$valmember->id,
	                "title"=>$valmember->full_name,
	                "thumbnil"=>base_url().'upload/requirements/'.$valmember->profile_pic,
	                "type"=>"J4EMEMBER",
	                );
	        }
	        
	        $data_member_count =  count($data_member);
	        array_push($obj1,array("Category"=>"J4EMEMBER","Count"=>$data_member_count,"Data"=>$data_member));
	        
	    }
	    
	    
	    $buddysql = '';    
	    //$buddysql .= " ( AND (CONCAT(user.first_name, user.middle_name,user.last_name) LIKE '%$keyword%'))";
        $buddysql .= " AND  ( (user.first_name LIKE '%$keyword%') OR (user.middle_name LIKE '%$keyword%') OR (user.last_name LIKE '%$keyword%') )";
        
        
        //$buddyquery=$this->db->query("select buddies.*,user.id, user.avatar from `buddies` INNER JOIN user ON user.id = buddies.buddy_id  where $buddysql")->result(); 
	    
	    //user.first_name,user.middle_name ,user.last_name ,
	    
	    $buddyquery=$this->db->query("select buddies.*,user.id,user.first_name,user.middle_name,user.last_name, user.avatar from `buddies` INNER JOIN user ON user.id = buddies.buddy_id   where `buddies`.user_id=$userid $buddysql")->result(); 
	    
	    
	    if(isset($buddyquery) && !empty($buddyquery))
	    {
	        foreach($buddyquery as $valbuddy)
	        {
	           // CONCAT_WS(' ',first_name,middle_name,last_name)
	            $data_buddy[] = array(
	                "id"=>$valbuddy->id,
	                "title"=>$valbuddy->first_name.' '.$valbuddy->middle_name.' '.$valbuddy->last_name,
	                "thumbnil"=>base_url().'upload/avatar/'.$valbuddy->avatar,
	                "type"=>"BUDDY",
	                );
	        }
	        
	        $data_buddy_count =  count($data_buddy);
	        array_push($obj1,array("Category"=>"BUDDY","Count"=>$data_buddy_count,"Data"=>$data_buddy));
	        
	    }
	    
	    
	    if($obj1)
	    {
	        return $obj1;
	    }
	    else
	    {
	        return FALSE;
	    }
	    
	    
	    
	    
	}
	
        public function get_all_referral_title($userid){
	    
	    $query=$this->db->query("select * from requirements where requirements_status='1' AND is_referral='1' AND user_id='".$userid."'")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
        
        public function get_referral_title($userid,$req_title){
	    
	    $query=$this->db->query("select * from requirements where is_referral='1' AND user_id='".$userid."' and title='".$req_title."'")->result();
	    if(isset($query) && !empty($query)){
	        	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
        
        public function save_referal_deetails($reqq){
	    
	   // if($reqq['visible'] == 'Yes')
	   // {
	   //    $getuserdata = $this->db->get_where('user',array('id'=>$reqq['userid']))->row();
	   //    $chapter_ids = $getuserdata->chapterid;   
	   // }
	   // else
	   // {
//	        $chapter_ids = '0';
	   // }
	    
	    
	    
	    $data_insert=array(
	           "user_id"=>$reqq['userid'],
	           "referral_for"=>$reqq['referral_for'],
	           "functional_area_id"=>$reqq['functional_area_id'],
//	           "subfunctional_area_id"=>$reqq['subfunctional_area_id'],
	           "title"=>$reqq['requirement_title'],
	           "description"=>$reqq['requirement_description'],
	           "address"=>$reqq['address'],
	           //"thumbnil"=>$filename,
	           "created_date"=>date('Y-m-d',strtotime($reqq['created_date'])),
	           "created_time"=>date('Y-m-d',strtotime($reqq['created_time'])),
	           //"visible"=>$reqq['visible'],
//	           "chapter_id"=>$chapter_ids,
	           "is_referral"=>'1'
	        );
	        
	        $ress=$this->db->insert('requirements',$data_insert);  //echo $this->db->last_query();exit();
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            $rs_email = $this->db->where('purpose', 'referral')->get('email_template')->row(); 
            $requirement_info = $this->db->where('id',$insert_id)->get('requirements')->row();
            $web_setting = $this->db->get('website_settings')->row();
            $setting = my_global_setting('all_fields');
            $data['setting'] = $setting;
            $data['web_setting'] = $web_setting;
            $data['template'] = $rs_email;
            $data['requirement'] = $requirement_info;
            $CI = &get_instance();
                        $body = $CI->load->view('themes/default/Mail/referral', $data,true);
//            echo $body;
            $user_info = $this->db->where('id',$reqq['userid'])->get('user')->row();
            $user_info1 = $this->db->where('id',$reqq['referral_for'])->get('user')->row();
            $email = array(
			  'email_to' => $user_info->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res = my_send_email($email);
                $email1 = array(
			  'email_to' => $user_info1->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res1 = my_send_email($email1);
//                print_r($res);
	            if($reqq['type'] == '1' OR $reqq['type'] == '2')
	            {
	               $person_ids = $reqq['contact_person_id'];
                       $user_info1 = $this->db->where('id',$reqq['contact_person_id'])->get('user')->row();
                       $email2 = array(
			  'email_to' => $user_info2->email_address,
			  'email_subject' => $rs_email->subject,
			  'email_body' => $body
		    );
		$res2 = my_send_email($email2);
	            }
	            else
	            {
	                $person_ids = '';
	            }
	            
	            $data_referral = array(
	                'referal_reqid'=>$insert_id,
	                'referal_name'=>$reqq['username'],
	                'referal_cmpname'=>$reqq['cmpname'],
	                'referal_desgn'=>$reqq['desgn'],
	                'referal_mobileno'=>$reqq['mobileno'],
	                'referal_wpno'=>$reqq['whatsappno'],
	                'referal_stdcode'=>$reqq['stdcode'],
	                'referal_phno'=>$reqq['phno'],
	                'referal_email'=>$reqq['email'],
	                'referal_address'=>$reqq['address'],
	                'referal_type'=>$reqq['type'],
	                'referal_status'=>$reqq['referral_status'],
	                'referal_hotrank'=>$reqq['hotrank'],
	                'referal_contactperson'=>$person_ids,
	                );
	            $this->db->insert('referal_preson',$data_referral);
	            
	            
//	            $this->add_reward_point('LeadCreate',$reqq['userid'],$reqq['created_date'],$reqq['created_time'],$reqq['requirement_title']);
	            
	            //return TRUE;
	            //get all details
                    $useriddd=$this->db->query("select * from user where id='".$reqq['userid']."'")->row();
                    $package_info = $this->db->where(array('user_id'=>$reqq['userid'],'plan_id'=>$useriddd->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                    $user_consumption = $this->db->where(array('user_id'=>$reqq['userid'],'package_id'=>$useriddd->packages_id,'feature_id'=>11,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
	            $data['used_count'] = $user_consumption->used_count + 1;
                    $q = $this->db->where('id',$user_consumption->id)->set($data)->update('user_package_features');
	            $reqqq=$this->db->query("select * from requirements where id='".$insert_id."'")->result();
                    
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
        
        public function get_all_pending_referral($userid){
	    
	    
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select * from requirements where requirements_status='1' AND is_referral='1' AND user_id='".$userid."'")->result();
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->id."'")->row();
	           $user_info = $this->db->where('id',$val_data->referral_for)->get('user')->row();
	           $rp_info = $this->db->where('referal_reqid',$val_data->id)->get('referal_preson')->row();
	           if(empty($user_info->business_category))
	           {
	               $buss_cat = "N/A";
	           }
	           else
	           {
	               $buss_cat = "";
	               $str = explode(',',$user_info->business_category);
	               $c=1;
	               for($i=0;$i<count($str);$i++)
	               {
	                   $bcat_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
	                   if(!empty($bcat_info))
	                   {
	                       if($c==1)
	                       {
	                            $buss_cat = $buss_cat.$bcat_info->functional_area;
	                       }
	                       else
	                       {
	                           $buss_cat = $buss_cat.", ".$bcat_info->functional_area;
	                       }
	                       $c++;
	                   }
	               }
	           }
	           
	           if($rp_info->referal_type == 1)
	           {
	               $rtype = "My Self";
	           }
	           elseif($rp_info->referal_type == 2)
	           {
	               $rtype = "Inside";
	           }
	           else
	           {
	               $rtype = "Outside";
	           }
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	         //echo $this->db->last_query();
	           $dataarrays = array();
        	   foreach($querygetdata as $valquerygetdata)
        	   {
        	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
        	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
        	       
        	   }
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (!in_array("3", $data_explode)){
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "user_name"=>$user_info->first_name." ".$user_info->middle_name." ".$user_info->last_name,
                 "avatar"=>base_url('upload/avatar/'.$user_info->avatar),
//                 "membershipid"=>$user_info->member_code,
                 "user_functional_area"=>$buss_cat,
//                 "user_chapter_name"=>$chapter_name,
                 "referral_type"=>$rtype,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                //  "thumbnil"=> base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                     "doe_date"=> date('Y-m-d', strtotime($val_data->doe)),
                     "doe_time"=> date('H:i:s', strtotime($val_data->doe)),
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
                 "referral_for"=>$val_data->referral_for,
                 "dob"=>$user_info->dob
	             );
	           }
	        
	       
	       
	      }
	     
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_all_pending_referral_received($userid){
	    
	    
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select * from requirements where requirements_status='1' AND is_referral='1' AND referral_for='".$userid."'")->result();
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->id."'")->row();
	           $user_info = $this->db->where('id',$val_data->user_id)->get('user')->row();
	           $rp_info = $this->db->where('referal_reqid',$val_data->id)->get('referal_preson')->row();
	           if(empty($user_info->business_category))
	           {
	               $buss_cat = "N/A";
	           }
	           else
	           {
	               $buss_cat = "";
	               $str = explode(',',$user_info->business_category);
	               $c=1;
	               for($i=0;$i<count($str);$i++)
	               {
	                   $bcat_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
	                   if(!empty($bcat_info))
	                   {
	                       if($c==1)
	                       {
	                            $buss_cat = $buss_cat.$bcat_info->functional_area;
	                       }
	                       else
	                       {
	                           $buss_cat = $buss_cat.", ".$bcat_info->functional_area;
	                       }
	                       $c++;
	                   }
	               }
	           }
	           
	           if($rp_info->referal_type == 1)
	           {
	               $rtype = "My Self";
	           }
	           elseif($rp_info->referal_type == 2)
	           {
	               $rtype = "Inside";
	           }
	           else
	           {
	               $rtype = "Outside";
	           }
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	         //echo $this->db->last_query();
	           $dataarrays = array();
        	   foreach($querygetdata as $valquerygetdata)
        	   {
        	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
        	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
        	       
        	   }
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (!in_array("3", $data_explode)){
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "user_name"=>$user_info->first_name." ".$user_info->middle_name." ".$user_info->last_name,
                 "avatar"=>base_url('upload/avatar/'.$user_info->avatar),
//                 "membershipid"=>$user_info->member_code,
                 "user_functional_area"=>$buss_cat,
//                 "user_chapter_name"=>$chapter_name,
                 "referral_type"=>$rtype,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                //  "thumbnil"=> base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                     "doe_date"=> date('Y-m-d', strtotime($val_data->doe)),
                     "doe_time"=> date('H:i:s', strtotime($val_data->doe)),
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
                 "referral_for"=>$val_data->referral_for,
                 "dob"=>$user_info->dob
	             );
	           }
	        
	       
	       
	      }
	     
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	
	
	
	public function get_all_complete_referral($userid){
	    
	    
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select * from requirements where status='2' AND is_referral='1' AND user_id='".$userid."'")->result();
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->id."'")->row();
	        $rp_info = $this->db->where('referal_reqid',$val_data->id)->get('referal_preson')->row();
	           $user_info = $this->db->where('id',$val_data->referral_for)->get('user')->row();
	           if(empty($user_info->business_category))
	           {
	               $buss_cat = "N/A";
	           }
	           else
	           {
	               $buss_cat = "";
	               $str = explode(',',$user_info->business_category);
	               $c=1;
	               for($i=0;$i<count($str);$i++)
	               {
	                   $bcat_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
	                   if(!empty($bcat_info))
	                   {
	                       if($c==1)
	                       {
	                            $buss_cat = $buss_cat.$bcat_info->functional_area;
	                       }
	                       else
	                       {
	                           $buss_cat = $buss_cat.", ".$bcat_info->functional_area;
	                       }
	                       $c++;
	                   }
	               }
	           }
	           
	           if($rp_info->referal_type == 1)
	           {
	               $rtype = "My Self";
	           }
	           elseif($rp_info->referal_type == 2)
	           {
	               $rtype = "Inside";
	           }
	           else
	           {
	               $rtype = "Outside";
	           }
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	         //echo $this->db->last_query();
	           $dataarrays = array();
        	   foreach($querygetdata as $valquerygetdata)
        	   {
        	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
        	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
        	       
        	   }
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (in_array("3", $data_explode)){
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "user_name"=>$user_info->first_name." ".$user_info->middle_name." ".$user_info->last_name,
                 "avatar"=>base_url('upload/avatar/'.$user_info->avatar),
//                 "membershipid"=>$user_info->member_code,
                 "user_functional_area"=>$buss_cat,
//                 "user_chapter_name"=>$chapter_name,
                 "referral_type"=>$rtype,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                //  "thumbnil"=> base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                     "doe_date"=> date('Y-m-d', strtotime($val_data->doe)),
                     "doe_time"=> date('H:i:s', strtotime($val_data->doe)),
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
                 "referral_for"=>$val_data->referral_for,
                 "dob"=>$user_info->dob
	             );
	           }
	        
	       
	       
	      }
	     
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_all_complete_referral_received($userid){
	    
	    
	    //$query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    $query_get_data = $this->db->query("select * from requirements where status='2' AND is_referral='1' AND referral_for='".$userid."'")->result();
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->id."'")->row();
	        $rp_info = $this->db->where('referal_reqid',$val_data->id)->get('referal_preson')->row();
	           $user_info = $this->db->where('id',$val_data->user_id)->get('user')->row();
	           if(empty($user_info->business_category))
	           {
	               $buss_cat = "N/A";
	           }
	           else
	           {
	               $buss_cat = "";
	               $str = explode(',',$user_info->business_category);
	               $c=1;
	               for($i=0;$i<count($str);$i++)
	               {
	                   $bcat_info = $this->db->where('functional_area_id',$str[$i])->get('tbl_functional_area')->row();
	                   if(!empty($bcat_info))
	                   {
	                       if($c==1)
	                       {
	                            $buss_cat = $buss_cat.$bcat_info->functional_area;
	                       }
	                       else
	                       {
	                           $buss_cat = $buss_cat.", ".$bcat_info->functional_area;
	                       }
	                       $c++;
	                   }
	               }
	           }
	           
	           if($rp_info->referal_type == 1)
	           {
	               $rtype = "My Self";
	           }
	           elseif($rp_info->referal_type == 2)
	           {
	               $rtype = "Inside";
	           }
	           else
	           {
	               $rtype = "Outside";
	           }
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->id."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
	         //echo $this->db->last_query();
	           $dataarrays = array();
        	   foreach($querygetdata as $valquerygetdata)
        	   {
        	       //$dataarrays[] = explode(",",$valquerygetdata->req_user_status_catid);
        	       $dataarrays[] = $valquerygetdata->req_user_status_catid;
        	       
        	   }
        	   
        	   $data_implodes = implode(",",$dataarrays);
        	   $data_explode = explode(",",$data_implodes);
        	  
        	  
	           if (in_array("3", $data_explode)){
	        
	         $data_array[] = array(
	             "id"=>$val_data->id,
                 "user_id"=> $val_data->user_id,
                 "user_name"=>$user_info->first_name." ".$user_info->middle_name." ".$user_info->last_name,
                 "avatar"=>base_url('upload/avatar/'.$user_info->avatar),
//                 "membershipid"=>$user_info->member_code,
                 "user_functional_area"=>$buss_cat,
//                 "user_chapter_name"=>$chapter_name,
                 "referral_type"=>$rtype,
                 "functional_area_id"=> $val_data->functional_area_id,
                 "title"=> $val_data->title,
                 "description"=> $val_data->description,
                 "address"=> $val_data->address,
                //  "thumbnil"=> base_url().'upload/requirements/'.$val_data->thumbnil,
                 "created_date"=> $val_data->created_date,
                 "created_time"=> $val_data->created_time,
                 "status"=> $val_data->status,
                 "doe"=> $val_data->doe,
                     "doe_date"=> date('Y-m-d', strtotime($val_data->doe)),
                     "doe_time"=> date('H:i:s', strtotime($val_data->doe)),
                 "filterdate"=> date('Y-m-d', strtotime($val_data->created_date)),
                 "referral_for"=>$val_data->referral_for,
                 "dob"=>$user_info->dob
	             );
	           }
	        
	       
	       
	      }
	     
	      array_multisort(array_map(function($element) {
                      return $element['filterdate'];
                  }, $data_array), SORT_DESC, $data_array);

             return $data_array;
	      
	       //return $data_array;
	        
	    }
	    else
	    {
	        
	        
	        return FALSE;
	    }
	}
	public function app_get_referral_status()
	{
	    $getdata = $this->db->get('referral_status')->result();
	    
	    $data_array = array();
	    
	    if($getdata)
	    {
    	    foreach($getdata as $valdata)
    	    {
    	        $data_array[] = array('id'=>$valdata->status_id,'title'=>$valdata->status_title);
    	    }
    	    return $data_array;
	    }
	    else
	    {
	        return FALSE;
	    }
	    
	}
        
        
	
	
}