<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set($this->config->item('time_reference'));
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
			'affiliate_setting' => ''
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
			  'is_admin' => $is_admin,
			  'company_id'=> $rs->company,
			  'full_name' => $rs->first_name . ' ' . $rs->last_name
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
	public function update_otp($mobile,$userid){
	    $otp=rand(111111,987456);
	    $this->db->where(array('id'=>$userid,'phone'=>$mobile));
        $this->db->update('user',array('otp'=>$otp));
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
	
	public function get_app_user_verify_otp($otp,$userid,$mobile,$device_type,$device_token,$global_setting){
	    
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
                            "membership_type"=> $check_in_usertble->membership_type,
                            "device_type"=> $check_in_usertble->device_type,
                            "device_token"=> $check_in_usertble->device_token,
	                );
	                
	                
	                
	                
	                
	                
	                 $messagg=array("status"=>TRUE,"userdata"=>$data_user);
	            
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
                            "membership_type"=> $check_in_usertble->membership_type,
                            "device_type"=> $check_in_usertble->device_type,
                            "device_token"=> $check_in_usertble->device_token,
	                );
	            $messagg=array("status"=>TRUE,"userdata"=>$data_user);
	            
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
	public function get_app_user_account_details($userid){
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
	    
	    return array(
		  
		    'userid'=>$rs->id,
		    'first_name'=>$rs->first_name,
		    'middle_name'=>$rs->middle_name,
		    'last_name'=>$rs->last_name,
		    'email'=>$rs->email_address,
		    'mobile'=>$rs->phone,
		    'designation'=>$rs->designation,
		    'company_name'=>$rs->company,
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
		);
	}
	
	
	public function app_find_my_rank_post($user_id){
        $obj = array();
        
	    $rank = $this->db->query("SELECT userid, sumtotal, (@rn := @rn + 1) AS rank FROM (SELECT userid, sum(point) as sumtotal   FROM reward_user_point GROUP BY userid ORDER BY sum(point) DESC) agg
                                  CROSS JOIN (SELECT @rn := 0) CONST ORDER BY sumtotal DESC")->result();
	    
	    //$user_id = '124';
	    
	    foreach($rank as $userrank)
	    {
	       
	       if($userrank->userid == $user_id)
	       {
	           return $userrank->rank;
	       }
	       
	        /*$data_array[] = array(
	            'usersid'=>$userrank->userid,
	            'point'=>$userrank->sumtotal,
	            'rank'=>$userrank->rank,
	            );*/
	    }
	    
	    
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
				        "rewardthumbnil"=>base_url().'upload/rewards/'.$valdata->reward_thumbnil,
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
	    
        $query = $this->db->get('packages');
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
		     'membership_duration'=>$val->pack_duration,
		    'membership_features'=>$this->get_pack_fetures($val->pack_fet)
		    
		  	  
		);
	    }
	    
	    return $result_data;
	    
	}
	
	/*
	*   GET  APP USER MEMBERSHIP DETAILS API 
	*
	*/
	
	public function get_app_user_membership_details($userid){
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
	public function get_app_user_membership_details_fileds_builder($rs){
	    
	  
	 // print_r($rs);exit();
	 if($rs->membership_type == '2')
	 {
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
	    
	    $pack_id = $rs->pack_id;
	    $pack_title = $rs->pack_name;
	    $pack_benifits = $rs->pack_desc;
	    $pack_cost = $rs->pack_price;
	    $pack_feature = $this->get_pack_fetures($rs->pack_fet);
	    
	 }
	 else
	 {
	     $pack_id = '0';
	    $pack_title = 'Guest Member';
	    $pack_benifits = '-';
	    $pack_cost = '-';
	    $pack_feature = array();
	    $stdate = '-';
	    $eddate = '-';
	 }
	    
	    $data_array = array(
	        'membership_id'=>$pack_id,
		    'membership_title'=>$pack_title,
		    'membership_start_date'=>$stdate,
		    'membership_end_date'=>$eddate,
		    'membership_benifits'=>$pack_benifits,
		    'membership_cost'=>$pack_cost,
		    'membership_features'=>$pack_feature
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
	    $qry=$this->db->get('tbl_functional_area')->result();
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
	
	
	
	
	public function get_pack_fetures($feat_id=null){
	    
	    if($feat_id==null){
	        return null;
	    }else{
	       $feat_idex=explode("/",$feat_id);   
	       
	       foreach($feat_idex as $val_index)
    	   {
    	       $rslt_data[] = $val_index;
    	   }
	     // $data_merg = implode(" , ",$rslt_data);
	      
	     //  echo $data_merg;
	       
	       //$feat_idex_implode=implode(",",$feat_idex);     $qrrres=$this->db->query("select fet_name as features from features where fet_id in(".$feat_idex_implode.")")->result();
	       
	       $get_data = $this->db->query("select fet_name as features,fet_id as featureid from features ")->result();   //where fet_id in(".$val_result.")
	       
	       foreach($get_data as $val_result)
	       {   
	            if(in_array($val_result->featureid,$feat_idex))
                {
                   $feature_available = 'Yes';
                }
                else
                {
                   $feature_available = 'No';
                }
	           
	           $features = $val_result->features;
	           $qrrres[] = array('FeaturesName'=>$features,'FeaturesAvilablity'=>$feature_available);
	           
	       }
	       
	        return $qrrres;
	    }
	    
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
		    'company_name'=>$rs->company,
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
		    'company_skype'=>$rs->company_skype
		    
		  )	  
		);
	    
	}
	
	/*
	*   GET  APP USER GET SUBSCRIBER
	*
	*/
	public function get_app_get_subscribe($userid){
	    $this->db->select('u.*,p.*');
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
	
	public function get_app_get_subscribe_fileds_builder($rs){
	    
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
	
	public function get_app_get_upgrade_membership_update($user){
	    
	         $stdate = date('Y-m-d');
	         $todaydate = strtotime($stdate);
             $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['membership_id']))->row_array();    
             $duration = $get_packages['pack_duration'];
             $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
	                
	         
	                
	                
	                $membership=array(
	                    "packages_id"=>$user['membership_id'],
	                    "packages_startDate"=> strtotime($stdate),
	                    "packages_endDate"=> strtotime($eddate),
	                    "membership_type"=>'2'
	                    );
	                $this->db->where(array('id'=>$user['userid']));
	                $res=$this->db->update('user',$membership);
	        
	        //$this->db->where(array('id'=>$user['userid']));
	        //$res=$this->db->update('user',$membership);
	        if($res==TRUE){
	            
	            $get_packages = $this->db->get_where('user_package_purchase',array('user_id'=>$user['userid']))->result();
	            foreach($get_packages as $valpackages)
	            {
	                $this->db->set('plan_status','Inactive');
	                $this->db->where('pur_id',$valpackages->pur_id);
	                $this->db->update('user_package_purchase');
	            }
	            
	            $pur_array = array(
	                'user_id'=>$user['userid'],
	                'plan_id'=>$user['membership_id'],
	                'plan_startdate'=>$stdate,
	                'plan_enddate'=>$eddate,
	                'plan_status'=>'Active'
	                );
	                $this->db->insert('user_package_purchase',$pur_array);   //print_r($pur_array);
	            
	            $trans_detail = array(
	                'trans_userid'=>$user['userid'],
	                'trans_paymentids'=>$user['transactionid'],
	                'trans_paymenttype'=>$user['transationpaymenttype'],
	                'trans_amount'=>$user['transationamount'],
	                'trans_datetime'=>$user['transationdatetime'],
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
		    'designation'=>$rs->designation,
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
	    $res=$this->db->query("select * from user where phone='".$mobile."'")->result();
	    if(isset($res) && !empty($res)){
	        //update otp 
	        
	        //update login type
	        //$this->db->where(array('phone'=>$mobile));
	        //$this->db->update('user',array('login_type'=>2));
	        
	         $otp=rand(1111,9874);
	         //get otpp
	         $this->db->where(array('phone'=>$mobile));
	        $this->db->update('user',array('otp'=>$otp));
	         
	         
	         $this->db->where(array('phone'=>$mobile));
	         $this->db->update('user_temp',array('otp'=>$otp));
	         
	         $otp_mob=$this->db->query("select * from user_temp where phone='".$mobile."'")->result();
	         
	        
            
             if(isset($otp_mob) && !empty($otp_mob)){
                 
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
                 
                $otp=rand(1111,9874); 
                 
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
    		        $this->add_reward_point('GuestBecomeMember',$reqqs['event_invite_byuserid'],$currentdate,$currenttime);  
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
	    else
	    {
	        //user inserrt
	         $otp=rand(1111,9874);
		  //check user is exist or not 
		  
		  $checkmobile=$this->db->query("select * from user_temp where phone='".$mobile."'")->result();
		  
		  if(isset($checkmobile) && !empty($checkmobile)){
		      
		      $user_array = array(
        		    
        			'otp'=>$otp
        	   );
		      
		              $this->db->where(array('phone'=>$mobile,'id'=>$checkmobile[0]->id));
		      $ressuu=$this->db->update('user_temp', $user_array);
		      
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
    		        $this->add_reward_point('GuestBecomeMember',$reqqs['event_invite_byuserid'],$currentdate,$currenttime);  
    		      }
    		      
    		      
    		       // *** log started
    		  //$log_detail = my_ua() + array('mobile' => $mobile, 'user_status' => $user_status);
    		  //my_log($user_ids, 'Information', 'signup-success', json_encode($log_detail));*/
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
	    
	    return array(
		  
		    /*'first_name'=>$rs->first_name,
		    'middle_name'=>$rs->middle_name,
		    'lastt_name'=>$rs->last_name,*/
		    'email'=>$rs->email_address,
		    'date_of_birth'=>$rs->dob,
		    'mobile'=>$rs->phone,
		    'gender'=>$rs->gender,
		    'company_name'=>$rs->company,
		    'designation'=>$rs->designation,
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
		    'vcard_front'=> base_url().'upload/requirements/'.$rs->vcard_front,
	        'vcard_back'=> base_url().'upload/requirements/'.$rs->vcard_back,
	        'company_facebook'=>$rs->company_facebook,
	        'company_linkedin'=>$rs->company_linkedin,
	         'company_instagram'=>$rs->company_instagram,
	         'company_twitter'=>$rs->company_twitter,
	         'company_youtube'=>$rs->company_youtube,
	         'company_google'=>$rs->company_google,
	          'company_skype'=>$rs->company_skype
		    
		    
		);
	    
	}
	
	public function get_app_user_view_profile_about_fileds_builder($rs){
	    
	    
	   $turnover = $this->db->where('turn_over_id',$rs->turn_over)->get('turn_over')->row();
	     
	    
	    
	    return array(
		  
		    'about_company'=>$rs->about_company,
		    'company_name'=>$rs->company,
		    'business_entity'=>$rs->business_entity,
		    'business_type'=>$rs->business_type,
		    'business_expertise'=>$rs->business_experties,
		    'working_from'=>$rs->working_from,
		    'no_of_employees'=>$rs->no_of_employees,
		    'expected_turnover_id'=>$rs->turn_over,
		    'expected_turnover_value'=>$turnover->turn_over_value,
		    'target_audiance'=>$rs->target_audiance,
		    'membership_title'=>$rs->pack_name,
		    'company_profile'=> base_url().'upload/requirements/'.$rs->company_profile,
		    'company_ppt'=> base_url().'upload/requirements/'.$rs->company_ppt
		    
		  	  
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
	            "referral_code"=>$user['referral_code'],
	            "membership_type"=>$user['membership_type'],
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
	    
	    
	    
	    
	    if($user['membership_type'] == '2')
	    {
	        $stdate = date('Y-m-d');
	        $todaydate = strtotime($stdate);
            $get_packages = $this->db->get_where('packages',array('pack_id'=>$user['packages_id']))->row_array();   
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
	                'trans_datetime'=>$user['transationdatetime'],
	                'trans_for'=>'Membership Payment'
	                );
	            $this->db->insert('transactions',$trans_detail);
	            
	                
	                
	            }
	    
	    
	    
	    
	    
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
	            "referral_code"=>$user['referral_code'],
	            "membership_type"=>$user['membership_type']
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
	    $sentdata=$this->db->query("select * from connection where request_to='".$userid."'")->result();
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
	    $sentdata=$this->db->query("select * from connection where request_to='".$senderid."' andrequest_from='".$userid."'")->result();
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
	    
        $query = $this->db->get('packages');
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	public function get_app_get_membership_plan_details_fileds_builder($rs){
	    
	    $result_data[] = array(
    		  
    		    'membership_id'=>"0",
    		    'membership_title'=>"Guest Member",
    		    
    		);
	    
	    foreach($rs as $val)
	    {
    	    $result_data[] = array(
    		  
    		    'membership_id'=>$val->pack_id,
    		    'membership_title'=>$val->pack_name,
    		    
    		);
	    }
	    
	    return $result_data;
	    
	}
	
	
	
	public function get_app_get_all_members($user_id){
	    
	    $sql = '';
	    
	    if($this->json_array['membershiptype'] != '')
	    {
	        $sql.=" AND ( user.packages_id = '".$this->json_array['membershiptype']."')";  
	    }
	    
	    //if(($this->json_array['min_employee'] != '' && $this->json_array['max_employee'] != '') OR ($this->json_array['min_employee'] != '0' && $this->json_array['max_employee'] != '0'))
	    //if($this->json_array['min_employee'] != '0' && $this->json_array['max_employee'] != '0')
	    if($this->json_array['min_employee'] != '0' || $this->json_array['max_employee'] != '0')
	    {
	        $sql.=" AND ( no_of_employees BETWEEN '".$this->json_array['min_employee']."' AND '".$this->json_array['max_employee']."' )";
	        
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
	        $sql.=" AND ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%')OR ( user.last_name LIKE '%$keyword%') OR (user.company LIKE '%$keyword%') OR (user.company_address LIKE '%$keyword%') OR (user.designation LIKE '%$keyword%') OR (user.business_entity LIKE '%$keyword%') )";
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
	    
	    
	    
	    //$query = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,email_address as email,phone as mobile,designation,company as company_name,company_contact,company_address,dob,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type from user where `id`!=$user_id  AND membership_type !='0' $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
        $getdata = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,email_address as email,phone as mobile,designation,company as company_name,company_contact,company_address,dob,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type,packages_id from user where `id`!=$user_id  AND membership_type !='0' $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
       //echo $this->db->last_query();exit();
        
        foreach($getdata as $query)
        {
            if($query->membership_type == '' OR $query->membership_type == '1')
            {
                $membership_name = 'Guest Member';
            }
            else
            {
                $packages_ids = $query->packages_id;
                $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                $membership_name = $getpackage->pack_name;
            }
            
            $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$query->id)->get('reward_user_point')->row();
        
            if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
        
             $data_array[] = array(
                "id"=> $query->id,
                "full_name"=> $query->full_name,
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
                "total_point"=>$toal_points
                );
        
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
			      return $data_array;
			  }
			  return $data_array;
			
	       }
	       else
	       {
	           return $data_array;
	       }
			
				
		}
		else {
			return FALSE;
		}
	    
	}
	
	/*
	*
	*
	*/
	
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
        		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>$rs->designation,
        		    'company_name'=>$rs->company,
        		    'company_phone'=>$rs->company_phone,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar
	                
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
	
	public function get_all_buddy_list($users){
	    
	    $buddy_array=array();
	    $i=0;
	    
	    //first check what user sent
	    //$get_sent_user=$this->db->query("select * from connection where user_one_id='".$userid."' and status='1'")->result();
	    
	    $users = $this->json_array['userid'];
	    $sql = '';
	    
	    if($this->json_array['membershiptype'] != '')
	    {
	        $sql.=" AND ( user.packages_id = '".$this->json_array['membershiptype']."')";
	    }
	    
	    
	    
	    
	    if($this->json_array['min_employee'] != '0' || $this->json_array['max_employee'] != '0')
	    {
	        $sql.=" AND ( no_of_employees BETWEEN '".$this->json_array['min_employee']."' AND '".$this->json_array['max_employee']."' )";
	       // echo $sql;
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
	            
	           
	            if(in_array($rs->id,$getusersearchdata))
                {
                   
                   $get_total_point = $this->db->select('sum(point) as toal_point')->where('userid',$rs->id)->get('reward_user_point')->row();
                   if(empty($get_total_point->toal_point)){$toal_points = "0";} else{$toal_points = $get_total_point->toal_point;}
                   
                   $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>$rs->designation,
        		    'company_name'=>$rs->company,
        		    'company_phone'=>$rs->company_number,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'total_point'=>$toal_points
	                
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
                   
	           
	           
	           
	            $daaa=array(
	                "id"=>$i,
	                'userid'=>$rs->id,
        		    'full_name'=>$rs->first_name." ".$rs->middle_name." ". $rs->last_name,
        		    'email'=>$rs->email_address,
        		    'mobile'=>$rs->phone,
        		    'designation'=>$rs->designation,
        		    'company_name'=>$rs->company,
        		    'company_phone'=>$rs->company_number,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'total_point'=>$toal_points
	                
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
            		    'designation'=>$rs->designation,
            		    'company_name'=>$rs->company,
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
            		    'designation'=>$rs->designation,
            		    'company_name'=>$rs->company,
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
			      return $buddy_array;
			  }
			  return $buddy_array;
			
	       }
	       else
	       {
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
	    
	    $get_connection_sent_request=$this->db->query("select * from connection where request_to='".$userid."'")->result();
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
	    $get_sent_user=$this->db->query("select * from connection where request_to='".$userid."'")->result();
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
        		    'designation'=>$rs->designation,
        		    'company_name'=>$rs->company,
        		    'company_phone'=>$rs->company_phone,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'connection_status'=>$statusss
	                
	            );
	            //if(!in_array($daaa,$buddy_array)){
	                array_push($sent_request_array,$daaa);
	            //}
	            
	           $i++; 
	        }
	        
	    }
	    
	     if(isset($sent_request_array) && !empty($sent_request_array)){
	        
	        return $sent_request_array;
	    }else{
	        return FALSE;
	    }
	}
	
	/*
	*
	*
	*/
	
	public function get_conection_list_receive_req($userid){
	    $get_connection_sent_request=$this->db->query("select * from connection where request_from='".$userid."'")->result();
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
	    $get_sent_user=$this->db->query("select * from connection where request_from='".$userid."'")->result();
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
        		    'designation'=>$rs->designation,
        		    'company_name'=>$rs->company,
        		    'company_phone'=>$rs->company_phone,
        		    'company_address'=>$rs->company_address,
        		    'dob'=>$rs->dob,
        		    'profile_pic'=>base_url().'upload/avatar/'.$rs->avatar,
        		    'connection_status'=>$statusss
	                
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
	           "created_date"=>$reqq['created_date'],
	           "created_time"=>$reqq['created_time']
	        );
	        
	        $ress=$this->db->insert('requirements',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            $this->add_reward_point('LeadCreate',$reqq['userid'],$reqq['created_date'],$reqq['created_time']);
	            
	            //return TRUE;
	            //get all details
	            $reqqq=$this->db->query("select * from requirements where id='".$insert_id."'")->result();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	/*
	*
	*/
	public function get_all_requirement_title($userid){
	    
	    $query=$this->db->query("select * from requirements where user_id='".$userid."'")->result();
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
	            $roww = $this->db->query("select * from requirements where id='".$val_data->requirement_id."'")->row();  //echo $this->db->last_query();
	            
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
	                    "rerquirement_thumbnail"=>base_url().'upload/requirements/'.$roww->thumbnil,
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
	    $query=$this->db->query("select * from requirements where user_id!='".$userid."' ORDER BY id DESC")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function get_all_pending_requirement($userid){
	    
	    
	    $query_get_data = $this->db->query("select req_user_status_reqid as requirementids from requirements_user_status  where req_user_status_catid != '3' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."') group by req_user_status_reqid")->result();
	    
	    
	    if(isset($query_get_data) && !empty($query_get_data)){  
	      foreach($query_get_data as $valdatas)
	      {    
	        $val_data=$this->db->query("select * from requirements where id='".$valdatas->requirementids."'")->row();
	           
	         //$get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->req_user_status_reqid))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	         $querygetdata = $this->db->query("select req_user_status_catid  from requirements_user_status  where  req_user_status_reqid ='".$valdatas->requirementids."' AND ( req_user_status_userid='".$userid."' OR req_user_status_addedby ='".$userid."')")->result();
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
                 "thumbnil"=> base_url().'upload/requirements/'.$val_data->thumbnil,
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
	   $query=$this->db->query("select * from recomendation where userid='".$userid."'")->result();  
	    //$query=$this->db->query("select * from recomendation where recomend_by='".$userid."'")->result();  
	    
	    
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	                
	            
	            $queries = $this->db->query("select * from requirements where status = '1' AND id='".$val_data->requirement_id."'")->row(); 
	            if(isset($queries))
	            {
	               $get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$queries->user_id)->get('user')->row();
	               
	              
	               $query_data[] = array(
	                    "id"=> $queries->id,
                        "user_id"=> $queries->user_id,
                        "user_name"=> $get_user->full_name,
                        "user_profile"=> $get_user->profile_pic,
                        "functional_area_id"=> $queries->functional_area_id,
                        "title"=> $queries->title,
                        "description"=> $queries->description,
                        "address"=> $queries->address,
                        "thumbnil"=> base_url().'upload/requirements/'.$queries->thumbnil,
                        "created_date"=> $queries->created_date,
                        "created_time"=> $queries->created_time,
                        "status"=> $queries->status,
                        "doe"=> $queries->doe,
                        "filterdate"=> date('Y-m-d', strtotime($queries->created_date)),
                   ); 
	            }
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
	    
	    $query=$this->db->query("select * from recomendation where userid='".$userid."'")->result();  //echo $this->db->last_query();
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	            $queries = $this->db->query("select * from requirements where status = '2' AND id='".$val_data->requirement_id."'")->row(); 
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
	              
	              
	               $query_data[] = array(
	                    "id"=> $queries->id,
                        "user_id"=> $queries->user_id,
                        "user_name"=> $get_user->full_name,
                        "user_profile"=> $get_user->profile_pic,
                        "functional_area_id"=> $queries->functional_area_id,
                        "title"=> $queries->title,
                        "description"=> $queries->description,
                        "address"=> $queries->address,
                        "thumbnil"=> base_url().'upload/requirements/'.$queries->thumbnil,
                        "created_date"=> $queries->created_date,
                        "created_time"=> $queries->created_time,
                        "status"=> $queries->status,
                        "doe"=> $queries->doe,
                        "icon"=>$icon,
                        "filterdate"=> date('Y-m-d', strtotime($queries->created_date)),
                   ); 
	            }
	            
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
	    $query=$this->db->query("select * from requirements where user_id!='".$userid."' AND status = '1' order by id DESC")->result();
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
	                    "rerquirement_thumbnail"=>base_url().'upload/requirements/'.$roww->thumbnil,
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
	                    "rerquirement_thumbnail"=>base_url().'upload/requirements/'.$roww->thumbnil,
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
	    $res=$this->db->query("select * from recomendation where userid='".$user."' and requirement_id='".$reqi."' and recomend_by='".$recom."' and ucase(recom_note)='".strtoupper($note)."'")->result();
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
	            "requirement_id"=>$reqi
	        );
	        
	        $insertt=$this->db->insert('recomendation',$data_insert);
	        
	        if($insertt==TRUE){
	             $insert_id = $this->db->insert_id();
	             
	             // `req_user_status_date`, `req_user_status_answer`, `req_user_status_time`, ``, ``, 
	             
	             
	             $leadstatus=array(
    	            "req_user_status_userid"=>$user,
    	            "req_user_status_addedby"=>$recom,
    	            "req_user_status_reqid"=>$reqi,
    	            "req_user_status_catid"=>'1',
    	            "req_user_status_statusid"=>'1',
    	            "req_user_status_msg"=>'',
    	            "req_user_status_desc"=>'',
    	            "req_user_status_creatdate"=>$creatdate,
    	            "req_user_status_creatday"=>date('D', strtotime($creatdate)),
    	            "req_user_status_creattime"=>$creattime,
    	            "req_user_status_amount"=>'',
    	        );
	        
	        
	        $res=$this->db->insert('requirements_user_status',$leadstatus);
	       
	        $recomdid = $this->db->insert_id();
	       
	                 $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$recom,
            	            'to_user_ids'=>$user,
            	            'subject'=>'Lead Status Update',
            	            'body'=>'Lead Status Update',
            	            'request_for'=>"LeadStatus",
            	            'request_id'=>$reqi,
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
	       
	       
	        $this->add_reward_point('RecommendedBy',$user,$creatdate,$creattime); 
	             
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
	                     "recomendation_date"=>$getrecomendation->doe
	                
	                );$recomm_arr=array();
	        
	        array_push($dattty,$dataaaerrr);
	            
	            
	        }
	        
	          //exit();
	        
	        
	        if(isset($dattty) && !empty($dattty)){
	            
	            return $dattty;
	            
	        }else{
	            
	             return FALSE;
	        }
	        
	    }else{
	        
	        return FALSE;
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
	
	public function get_all_requirement_details($requid){
	    
	    $query=$this->db->query("select * from requirements where id='".$requid."' ")->result();
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
	            
	            
	            $get_datas = $this->db->where(array('req_user_status_addedby'=>$userid,'req_user_status_reqid'=>$val_data->requirement_id))->order_by('req_user_status_id','DESC')->limit('1')->get('requirements_user_status')->row();
	               
	               
	               if($get_datas->req_user_status_statusid == '12' OR $get_datas->req_user_status_statusid == '13' OR $get_datas->req_user_status_statusid == '14')
	               {
	                  $icon = base_url().'upload/deal/DealClose.png'; 
	               }
	               else
	               {
	                   $icon = base_url().'upload/deal/DealCompleted.png'; 
	               }
	            
	            $dataaaerrr=array(
	                
	                    "userid"=>$userrr,
	                    "requirement_id"=>$roww->id,
	                    "requirement_title"=>$roww->title,
	                    "requirement_description"=>$roww->description,
	                    "rerquirement_thumbnail"=>base_url().'upload/requirements/'.$roww->thumbnil,
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
	                    "icon"=>$icon
	                
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
	    
	    $qrr=$this->db->query("select * from ratings_reviews where user_id='".$userid."' and reviewed_by='".$reviewid."'")->result();
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
	            "review_date"=>$userdata['date'],
	            "review_time"=>$userdata['time'],
	            
	        );
	        
	     $this->db->insert('ratings_reviews',$data_insert); 
	      $insert_id = $this->db->insert_id();
	      
	      
	      
	      $this->add_reward_point('TestimonialShared',$userdata['userid'],$userdata['date'],$userdata['time']);
	      $this->add_reward_point('TestimonialReceived',$userdata['reviewed_by'],$userdata['date'],$userdata['time']);
	      
	      return $insert_id;
	        
	    
	}
	
	public function get_user_ratings_data($user_rating_rev){
	    
	    $result=$this->db->query("select id,user_id,reviewed_by,ratings,review_note from ratings_reviews where id='".$user_rating_rev."'")->result();
	    return $result;
	    
	}
	
	public function update_ratings_review($userdata,$ratings_idd){
	    
	      $data_update=array(
	            "user_id"=>$userdata['userid'],
	            "reviewed_by"=>$userdata['reviewed_by'],
	            "ratings"=>$userdata['ratings'],
	            "review_note"=>$userdata['review_note'],
	        );
	        
	        $this->db->where('id',$ratings_idd);
	        $ressttt=$this->db->update('ratings_reviews',$data_update);
	        if($ressttt==TRUE){
	            
	            $result=$this->db->query("select id,user_id,reviewed_by,ratings,review_note from ratings_reviews where id='".$ratings_idd."'")->result();
	            $ress=array("status"=>TRUE,"message"=>$result);
	            
	        }else{
	            
	            $ress=array("status"=>FALSE,"message"=>"");
	            
	            
	        }
	        
	        return $ress;
	    
	    
	}
	
	public function check_user_ratings_exist_or_not($userid){
	    
	    $qrr=$this->db->query("select * from ratings_reviews where user_id='".$userid."'")->result();
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
	    $qry=$this->db->query("select * from gallery where gallery_type='".$type."' and user_id='".$userid."'")->result();
	    if(isset($qry) && !empty($qry)){
	        
	        $result=array("status"=>TRUE,'data'=>$qry);
	        
	        
	    }else{
	       $result=array("status"=>FALSE,'data'=>"select * from gallery where gallery_type='".$type."' and user_id='".$userid."'");
	         
	        
	        
	    }
	    
	    return $result;
	}
	
	public function view_profile_gallery_field_builder($viewgallery){
	    $gallerydata=array();
	    foreach($viewgallery as $roww){
	        
	        $gallerydata[]=array("userid"=>$roww->user_id,"imageid"=>$roww->id,"image_link"=>base_url().'upload/gallery/profile/'.$roww->image);
	        
	    }
	    return $gallerydata;
	}
	
	public function delete_image_gallery($galryid,$userid){
	    
	             $this->db->where('id',$galryid);
	             $this->db->where('user_id',$userid);
	        
	        $ress=$this->db->delete('gallery'); //echo $this->db->last_query();
	        if($ress==TRUE){
	            
	            return TRUE;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	
	public function upload_gallery_images($userid,$gallerytpe,$filen){
	    
	    //check already upload or  not
	    $checkgg=$this->db->query("select * from gallery where image='".$filen."' and user_id='".$userid."' and gallery_type='".$gallerytpe."'")->result();
	    if(isset($checkgg) && !empty($checkgg)){
	        
	        
	    }else{
	        
	        $this->db->insert('gallery',array("user_id"=>$userid,"gallery_type"=>$gallerytpe,"image"=>$filen));
	        
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
	            "req_user_status_date"=>$user['date'],
	            "req_user_status_answer"=>$user['answer'],
	            "req_user_status_time"=>$user['time'],
	            "req_user_status_amount"=>$user['amount'],
	            "req_user_status_creatdate"=>$user['creatdate'],
	            "req_user_status_creattime"=>$user['creattime'],
	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
	        );
	        
	        
	        
	        $res=$this->db->insert('requirements_user_status',$leadstatus);
	        $insids = $this->db->insert_id();
	        if($res==TRUE){
	            
	            $notification = array(
            	            'ids'=>my_random(),
            	            'by_user_ids'=>$user['addedby'],
            	            'to_user_ids'=>$user['userid'],
            	            'subject'=>'Lead Status Update',
            	            'body'=>'Lead Status Update',
            	            'request_for'=>"LeadStatus",
            	            'request_id'=>$user['requirementsid'],
            	            'is_read' => '0',
            	            
            	            );
            	     $this->add_notification($notification);
	            
	            
	            
	            
	            
	            if($leadstatus['req_user_status_catid'] == '2')
	            {
	                $getreqcheck = $this->db->get_where('requirements_user_status',array('req_user_status_reqid'=>$user['requirementsid'],$leadstatus['req_user_status_catid'] == '2'));
	                if($getreqcheck->num_rows() == '0')
	                {
	                   $this->add_reward_point('LeadsReceived',$user['userid'],$user['creatdate'],$user['creattime']);   
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
	                        /*if($insids != $val_leadstatus->req_user_status_id)
	                        {
	                            echo $key;*/
	                            $total_amount += $val_leadstatus->req_user_status_amount;
	                            //echo $total_amount.'/';
	                        //}
	                        
	                        
	                    }
	                    
	                    if($total_amount != 0)
	                    {   
	                        $this->db->set('req_user_status_amount',$total_amount)->where('req_user_status_id',$insids)->update('requirements_user_status');
	                        $leadstatusdata=array(
                	            "req_user_status_userid"=>$user['userid'],
                	            "req_user_status_addedby"=>$user['addedby'],
                	            "req_user_status_reqid"=>$user['requirementsid'],
                	            "req_user_status_catid"=>'2',
                	            "req_user_status_statusid"=>'8',
                	            "req_user_status_msg"=>'',
                	            "req_user_status_desc"=>'',
                	            "req_user_status_date"=>$user['date'],
                	            "req_user_status_answer"=>'',
                	            "req_user_status_time"=>$user['time'],
                	            "req_user_status_amount"=>$total_amount,
                	            "req_user_status_creatdate"=>$user['creatdate'],
                	            "req_user_status_creattime"=>$user['creattime'],
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
                	            "req_user_status_date"=>$user['date'],
                	            "req_user_status_answer"=>'',
                	            "req_user_status_time"=>$user['time'],
                	            "req_user_status_amount"=>$user['amount'],
                	            "req_user_status_creatdate"=>$user['creatdate'],
                	            "req_user_status_creattime"=>$user['creattime'],
                	            "req_user_status_creatday"=>date('D', strtotime($user['creatdate'])),
                	        );
	            	        $this->db->insert('requirements_user_status',$leadstatusdata);
	                    }
	                    
	                    $getbusinesstrans = $this->db->where(array('bns_trans_reqid'=>$user['requirementsid'],'bns_trans_mode'=>'Online','bns_trans_byuser'=>$user['addedby'],'bns_trans_touser'=>$user['userid']))->get('business_transaction');
	                    if($getbusinesstrans->num_rows() == '0')
	                    {
	                     
	                     
	                     $data_insert=array(
            	           "bns_trans_type"=>'Given',
            	           "bns_trans_mode"=>'Online',
            	           "bns_trans_reqid"=>$user['requirementsid'],
            	           "bns_trans_touser"=>$user['userid'],
            	           "bns_trans_byuser"=>$user['addedby'],
            	           "bns_trans_amount"=>$user['amount'],
            	           //"bns_trans_title"=>$reqq['title'],
            	           //"bns_trans_remark"=>$reqq['remark'],
            	           "bns_trans_date"=>$user['creatdate'],
            	           "bns_trans_status"=>'1',
            	           
            	        );
            	        $ress=$this->db->insert('business_transaction',$data_insert); 
            	        
            	        $currenttime =  date('g:i A');
            	        $currentdate = date('d M Y'); 
            	        $this->add_reward_point('BusinessShared',$user['userid'],$currentdate,$currenttime);   
            	        $this->add_reward_point('BusinessReceived',$user['addedby'],$currentdate,$currenttime);   
            	        
            	        
	                    }
	                    else
	                    {
	                        $result = $getbusinesstrans->row();
	                        $data_insert=array(
                	           
                	           "bns_trans_amount"=>$total_amount,
                	          
                	           "bns_trans_date"=>$user['creatdate'],
                	           
                	           
                	        );
                	        $this->db->where('bns_trans_id',$result->bns_trans_id)->update('business_transaction',$data_insert);  
	                    }
	                    
	                    
	                //}
	                
	                
	                
	                
	             }
	            
	            
	            
	            
	            if($leadstatus['req_user_status_catid'] == '3' && ( $leadstatus['req_user_status_catid'] == '12' OR $leadstatus['req_user_status_catid'] == '14' OR $leadstatus['req_user_status_catid'] == '15'))
	            {
	                $this->db->set('status','2');
	                $this->db->where('id',$leadstatus['req_user_status_reqid']);
	                $this->db->update('requirements');
	                
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
	
	
	public function get_app_get_lead_status($userid,$requirementsid){
	    $query=$this->db->query("select * from requirements_user_status where req_user_status_userid ='".$userid."' AND req_user_status_reqid ='".$requirementsid."'")->result();
	    if(isset($query) && !empty($query)){
	        
	        return $query;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	    
	}
	
	public function get_app_get_lead_status_fileds_builder($rs){
	    
	    /*'message' => array()*/
	    
	    foreach($rs as $val)
	    {
	    $result_data[] = array(
		  
		    'status_name'=>$this->get_lead_status_detail($val->req_user_status_statusid),
		    'status_catid'=>$val->req_user_status_catid,
		    'status_msg'=>$val->req_user_status_msg,
		    'status_date'=>$val->req_user_status_creatdate,
		    'status_time'=>$val->req_user_status_creattime,
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
	       /*$reqdata = $this->db->get_where('recomendation',array('id'=>$req_id))->row();
	       $reqids = $reqdata->requirement_id; */     
	       
	       $reqdata = $this->db->select("CONCAT('".base_url()."upload/requirements/', thumbnil)  as thumbnil_pic")->where('id',$req_id)->get('requirements')->row();
	       $getimages = $reqdata->thumbnil_pic;
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
	       
	       $eventdata = $this->db->select('event_thumbnil')->get_where('events',array('event_id'=>$eventids))->row();
	       
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
    'Authorization: key=AAAAuc1Wnwo:APA91bFnP03hGfE3EwNQYSIg8SHZRNYgEEpb7fD8tbr0jARxkCqTsOhI2f9YiuE9UmbOZBpvvWBfAz0-kw2Cen8WayxcF69EMX1FGhhXKfqJNTeb1SfW78ph8bnTfSdYknU2sgYrP7P0',
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
	        
	   $get_user = $this->db->select("CONCAT_WS(' ',first_name,middle_name,last_name) as full_name")->where('id',$val->to_user_ids)->get('user')->row();     
	       
	   $request_for = $val->request_for;    
	      
	       
	   if($request_for == 'Connection')
	   {
	       $req_id = $val->request_id;  
	       $buddydata = $this->db->get_where('connection',array('id'=>$req_id))->row();
	       $userids = $buddydata->request_from;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	   }
	   
	   elseif($request_for == 'BuddyMeet')
	    {
	        $req_id = $val->request_id;  
	       $buddydata = $this->db->get_where('buddy_meet',array('buddy_meet_withuserid'=>$req_id))->row();
	       $userids = $buddydata->buddy_meet_withuserid;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	   
	   elseif($request_for == 'LeadStatus')
	    {
	       $req_id = $val->request_id;
	       /*$reqdata = $this->db->get_where('recomendation',array('id'=>$req_id))->row();
	       $reqids = $reqdata->requirement_id; */     
	       
	       $reqdata = $this->db->select("CONCAT('".base_url()."upload/requirements/', thumbnil)  as thumbnil_pic")->where('id',$req_id)->get('requirements')->row();
	       $getimages = $reqdata->thumbnil_pic;
	       
	    }
	   
	   
	   
	   elseif($request_for == 'Followup')
	   {
	       $req_id = $val->request_id;  
	       $buddydata = $this->db->get_where('followup',array('followup_id'=>$req_id))->row();
	       $userids = $buddydata->followup_touserid;
	       
	       $getprofile = $this->db->select("CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$userids)->get('user')->row();
	       $getimages = $getprofile->profile_pic;
	    }
	   
	   elseif($request_for == 'Event')
	   {
	       $eventids = $val->request_id;
	       $req_id = $val->request_id;  
	       //$eventdata = $this->db->select("CONCAT('".base_url()."upload/events/', event_thumbnil)  as event_pic")->where('event_id',$eventids)->get('events')->row();
	       
	       $eventdata = $this->db->select('event_thumbnil')->get_where('events',array('event_id'=>$eventids))->row();
	       
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
	       $req_id = $val->request_id;  
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
	      
	       
	        
	    $result_data[] = array(
		    'notify_id'=>$val->id,
		    'by_user'=>$get_user->full_name,
		    'subject'=>$val->subject,
		    'body'=>$val->body,
		    'type'=>$request_for,
		    'id'=>$req_id,
		    'thumbnil'=>$getthumbnil,
		    'is_read'=>$val->is_read,
		    'created_time'=>$val->created_time,
		    
		    
		  	  
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
	           "post_date"=>$reqq['created_date'],
	           "post_time"=>$reqq['created_time']
	        );
	        
	        $ress=$this->db->insert('postdetail',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from postdetail where post_id='".$insert_id."'")->row();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function get_all_posts_detail($user_id,$type){
	    
	    if($type == '2')
	    {
	        $query = $this->db->where('post_userid',$user_id)->order_by('post_creatat','DESC')->get('postdetail');
	    }
	    else
	    {
	        $query = $this->db->order_by('post_creatat','DESC')->get('postdetail');
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
	
	
	public function get_app_get_all_post_details_fileds_builder($rs,$userid){
	    
	    
	    
	    foreach($rs as $val)
	    {
	        
	       $post_catid = $this->db->get_where('postcategory',array('cat_id'=>$val->post_catid))->row();
	       $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$val->post_userid AND membership_type !='0'")->row();
         
	       $post_like_count = $this->db->where('post_like_dislike_postid',$val->post_id)->get('post_like_dislike')->num_rows();
	       $post_cmt_count = $this->db->where('post_cmt_postid',$val->post_id)->get('post_comment')->num_rows();
	        
	       $get_check_user_like = $this->db->where(array('post_like_dislike_postid'=>$val->post_id,'post_like_dislike_userid'=>$userid))->get('post_like_dislike')->result(); 
	        
	        
	       if($get_check_user_like) { $avl_status = 'Yes';}
	       else { $avl_status = 'No';}
	        
	        
	        
	        
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
		    'post_image'=>base_url().'upload/post/'.$val->post_image,
		  	'post_total_comment'=> $post_cmt_count,
		  	'post_total_like'=> $post_like_count,
		  	'post_like_given_by_you'=> $avl_status,
		);
	    }
	    
	    return $result_data;
	    
	}
	

	
	public function save_post_comments($reqq){
	    
	    $data_insert=array(
	           "post_cmt_userid"=>$reqq['userid'],
	           "post_cmt_postid"=>$reqq['postid'],
	           "post_cmt_comment"=>$reqq['message'],
	           "post_cmt_date"=>$reqq['created_date'],
	           "post_cmt_time"=>$reqq['created_time']
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
	    
	    
	        $query = $this->db->where('post_cmt_postid',$postid)->get('post_comment');
	    
        
        if ($query->num_rows()) {
			$rs = $query->result();
				return $rs;
		}
		else {
			return FALSE;
		}
	    
	}
	
	
	public function get_app_get_all_post_comment_details_fileds_builder($rs){
	    
	    
	    
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
	    
	    return $result_data;
	    
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
	            
	            $get_post_cmt_data = $this->db->where('post_cmt_postid',$postid)->get('post_comment')->result();
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


    public function save_offline_business_transaction($reqq){
	    
	    
	    
	    
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
	           "lead_date"=>$reqq['created_date'],
	           "lead_status"=>$status,
	           
	        );
	    
	    $insid = $this->db->insert('offline_lead',$offline_lead);
	    
	    
	    
	        
	        
	        if($insid==TRUE){
	            
	          $insert_id = $this->db->insert_id();  
	            
	             
	            $data_insert=array(
    	           "bns_trans_type"=>$busns_type,
    	           "bns_trans_mode"=>'Offline',
    	           "bns_trans_reqid"=>$insert_id,
    	           "bns_trans_touser"=>$touser,
    	           "bns_trans_byuser"=>$byuser,
    	           "bns_trans_amount"=>$reqq['amount'],
    	           //"bns_trans_title"=>$reqq['title'],
    	           //"bns_trans_remark"=>$reqq['remark'],
    	           "bns_trans_date"=>$reqq['created_date'],
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
            	            'by_user_ids'=>$byuser,
            	            'to_user_ids'=>$touser,
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
        	        $busns_type = 'Given';
        	        
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
	    
	    
	        $query = $this->db->where('bns_trans_touser',$userid)->or_where('bns_trans_byuser',$userid)->get('business_transaction');
	    
        
        if ($query->num_rows()) {
			//$rs = $query->result();
				return TRUE;
		}
		else {
			return FALSE;
		}
	    
	}

    
    public function get_transaction_details_fileds_builder($userid){
	    
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
	    
	    $getdata = $this->db->where('bns_trans_byuser',$userid)->get('business_transaction')->result();
	   
	    
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
	    
	    if($this->json_array['type'] != '')
	    {
	        if($this->json_array['type'] == '1')
	        {
	           $sql.=" AND ( business_transaction.bns_trans_type = 'Given')"; 
	        }
	        else
	        {
	           $sql.=" AND ( business_transaction.bns_trans_type = 'Received')"; 
	        }
	        
	    }
	    
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
	       
	    
	    
	    $userids = $this->json_array['userid'];
	    
	    $getdata = $this->db->query("select * from business_transaction where  (`bns_trans_byuser`=$userids  OR `bns_trans_touser` =$userids)  $sql")->result();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
	    
	    $userid = $builderdata['userid'];
	    
	    
	    
	    if(count($getdata) != '0')
	    {
	       
	       foreach($getdata as $valdata)
	       {
	        
	        if($valdata->bns_trans_type == 'Given')
	        {
	            $userid = $valdata->bns_trans_touser;
	        }
	        else
	        {
	            $userid = $valdata->bns_trans_byuser;
	        }
	        
	           
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
    		    'transaction_type'=>$valdata->bns_trans_type,
    		    'payment_type'=>$valdata->bns_trans_mode,
    		    'transaction_amount'=>intval($valdata->bns_trans_amount),
    		    'transaction_date'=>$valdata->bns_trans_date,
    		    
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
    		    'transaction_type'=>$valdata->bns_trans_type,
    		    'payment_type'=>$valdata->bns_trans_mode,
    		    'transaction_amount'=>intval($valdata->bns_trans_amount),
    		    'transaction_date'=>$valdata->bns_trans_date,
    		    
    		    );
	      }
	       
	       }
	       
	    }
	    else{
	     $result_data[] = array();   
	    }
	       
	    if(empty($result_data))
	    {
	        return array();
	    }
	    
	    
	    return $result_data;
	    
	}
	
	
	public function get_offline_business_transaction_detail($transaction_id){
	    
        $this->db->from('business_transaction');
        $this->db->where('bns_trans_id', $transaction_id);
        $query = $this->db->get();
        if ($query->num_rows()) {
			$rs = $query->row();
			return $rs;	
			
		}
		else {
			return FALSE;
		}
	    
	}
	public function get_offline_business_transaction_detail_fileds_builder($rs){
	    
	    
	    if($rs->bns_trans_type == 'Received')
	    {
	        $userid = $rs->bns_trans_byuser;
	    }
	    else
	    {
	        $userid = $rs->bns_trans_touser;
	    }
	    
	    
	    if($rs->bns_trans_status == '1')
	    {
	       $status = 'Pending'; 
	    }
	    else
	    {
	       $status = 'Accepted';  
	    }
	    
	    
	    $query = $this->db->query("select CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userid AND membership_type !='0'")->row();
         
        $off_lead_data = $this->db->where(array("lead_id"=>$rs->bns_trans_reqid))->get('offline_lead')->row(); 
         
	    return array(
		  
		    'user_name'=>$query->full_name,
		    'user_profile'=>$query->profile_pic,
		    'transaction_type'=>$rs->bns_trans_type,
		    'transaction_title'=>$off_lead_data->lead_title,
		    'transaction_remark'=>$off_lead_data->lead_remark,
		    'transaction_amount'=>intval($off_lead_data->lead_amount),
		    'transaction_date'=>$rs->bns_trans_date,
		    'transaction_no'=>$off_lead_data->lead_trans_ids,
		    'transaction_status'=>$status,
		);
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
         
	    $event_date = date("m/d/Y",strtotime($startdate));
	    
	    
	    
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
	           "event_ticketqty"=>$eventdetails['max_ticket'],
	           "event_thumbnil"=>$filename,
	           "event_creatdate"=>$eventdetails['created_date'],
	           "event_creattime"=>$eventdetails['created_time']
	        );
	        
	        $ress=$this->db->insert('events',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
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
	
	public function get_my_pending_all_past_event($type){
	   
	   $today_date = date("m/d/Y");
	   
	   
	   
	   if($type == '2') 
	   {
	       $this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	       $query = $this->db->where(array('event_date >='=>$today_date))->get('events')->result();
	       
	   } 
	   elseif($type == '3') 
	   {
	      $this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	      $query = $this->db->where(array('event_date <'=>$today_date))->get('events')->result(); 
	   }
	   else
	   {
	      $sql = '';
	      //$this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	    
    	    if($this->json_array['category'] != '')
    	    {
    	        $event_cat_array = (explode(",",$this->json_array['category']));
    	        $cat_ids = implode(',',$event_cat_array);   
    	        $sql.=" where  ( events.event_cat_id IN (".$cat_ids."))";
    	    }
	    
	    
        $query = $this->db->query("select * from events INNER JOIN event_category ON event_category.event_cat_id = events.event_cat_id   $sql ")->result();  // print_r($query); ORDER BY event_startdate DESC 
        //$query = $this->db->get('events')->result();   
	   }
	   //echo $this->db->last_query();
	    $get_about = $this->db->get('aboutus')->row();
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	              $userids = $val_data->event_userid;
	              $get_user = $this->db->select('phone')->get_where('user',array('id'=>$userids))->row();  
	            
	              
	            
	             $query_data[] = array(
	                    "event_id"=> $val_data->event_id,
                        "event_cat_id"=> $val_data->event_cat_id,
                        "event_cat_name"=> $val_data->event_cat_name,
                        "event_title"=> $val_data->event_title,
                        "event_description"=> $val_data->event_description,
                        "event_address"=> $val_data->event_address,
                        "event_longitude"=> $get_about->longitude,
                        "event_latitude"=> $get_about->latitude,
                        "event_phno"=> $get_user->phone,
                        "event_date"=> $val_data->event_date,
                        "event_startdate"=> $val_data->event_startdate,
                        "event_enddate"=> $val_data->event_enddate,
                        "event_fees"=> $val_data->event_fees,
                        "event_thumbnil"=> base_url().'upload/events/'.$val_data->event_thumbnil,
                        "event_creatdate"=> $val_data->event_creatdate,
                        "event_creattime"=> $val_data->event_creattime,
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
	   
	   $today_date = date("d-m-Y");
	   
	   $this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	   $query = $this->db->where('event_id',$eventid)->get('events')->row();   
	   
	   
	   $event_invited_user = $this->db->get_where('event_invite',array('event_invite_eventid'=>$eventid))->result();
	   
	   $user_data = array();
	   foreach($event_invited_user as $val_user)
	   {
	       $user_ids = $val_user->event_invite_touserid;
	       $query_data = $this->db->query("select CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id` =$user_ids  AND membership_type !='0'")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
      //echo $this->db->last_query();
	       $user_data[] = array(
	           'userid'=>$user_ids,
	           'images'=>$query_data->profile_pic
	           );
	   }
	   
	   $event_invited = $this->db->get_where('event_invite',array('event_invite_eventid'=>$eventid))->num_rows();
	   
	   $event_interested = $this->db->get_where('event_attending_status',array('attend_eventid'=>$eventid,'attend_type'=>'1'))->num_rows();
	   $event_attended = $this->db->get_where('event_attending_status',array('attend_eventid'=>$eventid,'attend_type'=>'2'))->num_rows();
	   $event_maybe = $this->db->get_where('event_attending_status',array('attend_eventid'=>$eventid,'attend_type'=>'3'))->num_rows();
	    
	    
	      
	    if(empty($event_invited)){$event_invited = 0;}
	    if(empty($event_interested)){$event_interested = 0;}
	    if(empty($event_attended)){$event_attended = 0;}
	    if(empty($event_maybe)){$event_maybe = 0;}
	    
	    
	    
	    
	    $get_about = $this->db->get('aboutus')->row();
	    
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
	    
	    $organizer_data[]=array("address"=>$address,"emails"=>$emails,"phonenumber"=>$phno,"longitude"=>$longitude,"latitude"=>$latitude,"maplink"=>$map,"facebook"=>$facebooklink,"linkdin"=>$linkdinlink,"twitter"=>$twitterlink);
		
		
			        
	    
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
                        "event_startdate"=> $query->event_startdate,
                        "event_enddate"=> $query->event_enddate,
                        "event_fees"=> $query->event_fees,
                        "event_thumbnil"=> base_url().'upload/events/'.$query->event_thumbnil,
                        "event_creatdate"=> $query->event_creatdate,
                        "event_creattime"=> $query->event_creattime,
                        "event_createdby_id"=> $userdetail->id,
                        "event_createdby_name"=> $userdetail->full_name,
                        "event_createdby_profile"=> $userdetail->profile_pic,
                        "event_createdby_email"=> $userdetail->email_address,
                        "event_createdby_phno"=> $userdetail->phone,
                        "event_createdby_company"=> $userdetail->company,
                        "event_booked_byuser"=>$booking
                  ); 
	            
	            
	            $query_image = $this->db->where('event_gallery_eventid',$eventid)->get('event_gallery')->result();  
	            foreach($query_image as $val_img)
	            {
	                $gallery_data[] = array("event_img_id"=>$val_img->event_gallery_id,"images"=>base_url().'upload/events/event_details/'.$val_img->event_gallery_image);
	            }     
	            
	                //$ratingsss=$this->db->where('event_id',$eventid)->get('event_ratings_reviews')->result();
			        $ratingsss=$this->db->where('event_catid',$query->event_cat_id)->get('event_ratings_reviews')->result();
			        
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
        
                        if($rattt->ratings == '1')
                        {
                            $one_star += '1'; 
                        }
                        else if($rattt->ratings == '2')
                        {
                            $two_star += '1';
                        }
                        else if($rattt->ratings == '3')
                        {
                            $three_star += '1';
                        }
                        else if($rattt->ratings == '4')
                        {
                            $four_star += '1';
                        }
                        else if($rattt->ratings == '5')
                        {
                            $five_star += '1';
                        }
                           
                         //  $profileimg = base_url().'upload/avatar/'.$userdata->avatar;
			            $profileimg = $userdata->profile_pic;
			            $review_note[]=array("reviewed_by_id"=>$rattt->user_id,"reviewed_by"=>$userdata->full_name,"review_rate"=>$rattt->ratings,"review_note"=>$rattt->review_note,"profile_img"=>$profileimg,"review_date"=>$rattt->review_date,"review_time"=>$rattt->review_time);
			            $usss++;
			        }
			        //echo $usss;
			        $review_star[]=array("one_star"=>$one_star,"two_star"=>$two_star,"three_star"=>$three_star,"four_star"=>$four_star,"five_star"=>$five_star,"total_rate_review"=>$total_no_of_count);
			        
			        $average_ratings=floatval($ratingg)/floatval($usss);
			        
			        $avegare_rat=number_format((float)$average_ratings, 1, '.', '');
	            
	                //if(!isset($average_ratings) && !empty($average_ratings))  { $avegare_rats= number_format((float)$average_ratings, 1, '.', ''); }
	                //else{ $average_ratings = '0.0';  }  
	                
	                if(isset($review_note) && !empty($review_note))  { $review_notes = $review_note; }
	                else{ $review_notes = ''; }
	                
	            
	            array_push($obj,array("event_data"=>$query_data,"gallery_data"=>$gallery_data,"review_star"=>$review_star,"average_ratings"=>$avegare_rat,"all_reviews"=>$review_notes,"event_interestedcount"=>$event_interested,"event_attendedcount"=>$event_attended,"event_maybecount"=>$event_maybe,"event_invitedcount"=>$event_invited,"event_invited"=>$user_data,"event_organizer"=>$organizer_data));
	            
	            
	        
	        return $obj;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function get_event_details_for_booking($eventid)
	{
	   
	   $today_date = date("d-m-Y");
	   
	   $this->db->join('event_category','event_category.event_cat_id = events.event_cat_id','INNER');
	   $query = $this->db->where('event_id',$eventid)->get('events')->row();   
	   
	   if(isset($query) && !empty($query))
	   {
	        $query_data = $obj = array();
	        
	        $userdetail = $this->db->select("id,company,phone,email_address,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic")->where('id',$query->event_userid)->get('user')->row();
	         
	        $register_event = $this->db->select("booking_id")->where(array('booking_userid'=>$userid,'booking_eventid'=>$eventid))->get('event_booking');      
	        
	        if($register_event->num_rows() == '0') { $booking = 'No'; }  else{ $booking = 'Yes'; }
	        
	            
	            $get_about = $this->db->get('aboutus')->row();
	    
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
                        "event_thumbnil"=> base_url().'upload/events/'.$query->event_thumbnil,
                        "event_creatdate"=> $query->event_creatdate,
                        "event_creattime"=> $query->event_creattime,
                        "event_createdby_id"=> $userdetail->id,
                        "event_createdby_name"=> $userdetail->full_name,
                        "event_createdby_profile"=> $userdetail->profile_pic,
                        "event_createdby_email"=> $emails,
                        "event_createdby_phno"=> $phno,
                        "event_createdby_company"=> $userdetail->company,
                        "event_booked_byuser"=>$booking
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
	    
	    $qrr=$this->db->query("select * from event_ratings_reviews where user_id='".$userid."' and event_id='".$eventid."'")->result();
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
	            "review_date"=>$userdata['date'],
	            "review_time"=>$userdata['time'],
	        );
	        
	      $this->db->insert('event_ratings_reviews',$data_insert);   
	      $insert_id = $this->db->insert_id();
	      
	      
	        $this->add_reward_point('TestimonialShared',$userdata['userid'],$userdata['date'],$userdata['time']);  
	      
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
	           "attend_creattime"=>$participationdata['created_date'],
	           "attend_creatdate"=>$participationdata['created_time'],
	           
	        );
	        
	        $ress=$this->db->insert('event_attending_status',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            
	            $reqqq=$this->db->query("select * from event_attending_status where attend_id='".$insert_id."'")->row();
	            return $reqqq;
	        }else{
	            return FALSE;
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
	           "event_invite_creatdate"=>$eventdata['created_date'],
	           "event_invite_creattime"=>$eventdata['created_time'],
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
	
   	public function get_all_event_register_list($eventid){
	    $query=$this->db->query("select * from event_booking where booking_eventid ='".$eventid."' order by booking_id desc")->result();  
	    $data_array=array();
	    if(isset($query) && !empty($query)){
	     
	        foreach($query as $resultdata){
	            
	       $user_ids =     $resultdata->booking_userid; 
	            
	           $query = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,designation,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic,membership_type from user where `id`=$user_ids  AND membership_type !='0' $sql")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
	           
	            $dataarray=array(
	                    "registerid"=>$resultdata->booking_id,
	                    "eventid"=>$resultdata->booking_eventid,
	                    "userid"=>$query->id,
	                    "username"=>$query->full_name,
	                    "userimage"=>$query->profile_pic,
	                    "designation"=>$query->designation,
	                    
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
	           "booking_creatdate"=>$bookdata['created_date'],
	           "booking_creattime"=>$bookdata['created_time'],
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
        	           "attend_creattime"=>$bookdata['created_date'],
        	           "attend_creatdate"=>$bookdata['created_time'],
        	           
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
	                    "rerquirement_thumbnail"=>base_url().'upload/requirements/'.$roww->thumbnil,
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
	                    "count"=>$get_recommendedto_counts
	                
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
	    
	    
	    
	    
	    if(isset($query) && !empty($query)){
	        
	        foreach($query as $valdata)
	        {
	            $recom_id = $valdata->recom_id;
	            
	            $val_data = $this->db->where(array("id"=>$recom_id))->get('recomendation')->row();
	            $roww = $this->db->query("select * from requirements where id='".$val_data->requirement_id."'")->row();  //echo $this->db->last_query();
	            
	            $get_recommendedby_count = $this->db->query("select * from `recomendation` where userid !='".$userid."' AND requirement_id = '".$val_data->requirement_id."'")->num_rows(); 
	   
	            
	            if(empty($get_recommendedby_count)){$get_recommendedby_counts = '0';} else { $get_recommendedby_counts = "$get_recommendedby_count";}
	            
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
	                    "rerquirement_thumbnail"=>base_url().'upload/requirements/'.$roww->thumbnil,
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
	                    "count"=>$get_recommendedby_count
	                
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
	           "buddy_meet_date"=>$buddymeetdetails['date'],
	           "buddy_meet_time"=>$buddymeetdetails['time'],
	           "buddy_meet_day"=>date('D', strtotime($buddymeetdetails['date'])),
	           "buddy_meet_creatdate"=>$buddymeetdetails['created_date'],
	           "buddy_meet_creattime"=>$buddymeetdetails['created_time']
	        );
	        
	        $ress=$this->db->insert('buddy_meet',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	           
	            $notification = array(
    	            'ids'=>my_random(),
    	            'by_user_ids'=>$buddymeetdetails['userid'],
    	            'to_user_ids'=>$buddymeetdetails['buddiesid'],
    	            'subject'=>'New Buddy Meet Request',
    	            'body'=>'New Buddy Meet Request',
    	            'request_for'=>"BuddyMeet",
        	        'request_id'=>$insert_id,
    	            'is_read' => '0',
    	            
    	            );
	        $this->add_notification($notification);
	            
	            
	            
	            $this->add_reward_point('BuddyMeet',$buddymeetdetails['userid'],$buddymeetdetails['date'],$buddymeetdetails['time']); 
	           
	            $reqqq=$this->db->query("select * from buddy_meet where buddy_meet_id='".$insert_id."'")->result();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function app_get_buddy_meet_list($userid)
	{
	   
	   
	    $query = $this->db->where(array('buddy_meet_touserid'=>$userid))->or_where(array('buddy_meet_withuserid'=>$userid))->order_by('buddy_meet_id','DESC')->get('buddy_meet')->result();   
	    
	    
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	           //$req_data = $this->db->where(array('id'=>$val_data->followup_requirementid))->get('requirements')->row();
	           
	           if($userid == $val_data->buddy_meet_touserid)
	           {
	               $userids = $val_data->buddy_meet_withuserid;
	           }
	           else
	           {
	               $userids = $val_data->buddy_meet_touserid;
	           }
	           
	           
	           $user_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids  AND membership_type !='0' $sql")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
       
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
                        
                  ); 
	            
	        }
	        
	        
	        return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	
	
	
	public function save_recognition_deetails($reqq,$filename){
	    
	    $data_insert=array(
	           "recognition_userid"=>$reqq['userid'],
	           "recognition_title"=>$reqq['title'],
	           "recognition_description"=>$reqq['description'],
	           "recognition_image"=>$filename,
	           "recognition_creatdate"=>$reqq['created_date'],
	           "recognition_creattime"=>$reqq['created_time']
	        );
	        
	        $ress=$this->db->insert('recognition',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	            $reqqq=$this->db->query("select * from recognition where recognition_id='".$insert_id."'")->row();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function get_all_recognition($userid,$type){
	    
	    if($type == '1')
	    {
	        $query=$this->db->query("select * from recognition  order by recognition_id desc")->result();
	    }
	    else
	    {
	        $query=$this->db->query("select * from recognition where recognition_userid ='".$userid."' order by recognition_id desc")->result();
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
	
	
	public function get_fallowup_lead_requirement_data($userid,$type){
	    
	    if($type == '2')   // MY LEAD
	    {
	         $query=$this->db->query("select requirement_id from recomendation where userid='".$userid."' GROUP BY requirement_id")->result();  
    	     if(isset($query) && !empty($query))
    	     {
    	        foreach($query as $valdata)
    	        {
    	          $roww = $this->db->query("select * from requirements where id='".$valdata->requirement_id."'")->row();  
    	          $data_array[] = array(
    	              'requirement_id'=>$valdata->requirement_id,
    	              'requirement_title'=>$roww->title,
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
	        $query=$this->db->query("select * from requirements where user_id='".$userid."'")->result();
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
	    
	    if($type == '2')   // MY LEAD
	    {
	         $query=$this->db->query("select recomend_by from recomendation where requirement_id='".$reqid."' ")->result();  //GROUP BY requirement_id
    	     
    	   
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
	    else
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
	           "followup_date"=>$followupdata['date'],
	           "followup_time"=>$followupdata['time'],
	           "followup_day"=>date('D', strtotime($followupdata['date'])),
	           "followup_creatdate"=>$followupdata['created_date'],
	           "followup_creattime"=>$followupdata['created_time']
	        );
	        
	        $ress=$this->db->insert('followup',$data_insert);
	        if($ress==TRUE){
	            $insert_id = $this->db->insert_id();
	           
	            $notification = array(
    	            'ids'=>my_random(),
    	            'by_user_ids'=>$followupdata['byuserid'],
    	            'to_user_ids'=>$followupdata['touserid'],
    	            'subject'=>'New Followup Request',
    	            'body'=>'New Followup Request',
    	            'request_for'=>"Followup",
        	        'request_id'=>$insert_id,
    	            'is_read' => '0',
    	            
    	            );
	        $this->add_notification($notification);
	            
	            $reqqq=$this->db->query("select * from followup where followup_id='".$insert_id."'")->result();
	            return $reqqq;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function app_get_fallowup_list($userid){
	   
	   
	    $query = $this->db->where(array('followup_byuserid'=>$userid))->or_where(array('followup_touserid'=>$userid))->get('followup')->result();   
	    
	    
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
	           
	           
	           $user_data = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids  AND membership_type !='0' $sql")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
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
                        
                  ); 
	            
	        }
	        
	        
	        return $query_data;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
	public function app_get_guest_invite_event_list($userid){
	   
	   
	    $query = $this->db->where(array('event_invite_byuserid'=>$userid,'event_invite_type'=>'2'))->get('event_invite')->result();   
	    
	    
	    if(isset($query) && !empty($query)){
	        $query_data = array();
	        foreach($query as $val_data)
	        {
	           $req_data = $this->db->select('event_title')->where(array('event_id'=>$val_data->event_invite_eventid))->get('events')->row();
	           
	          
	             $query_data[] = array(
	                    "invite_id"=> $val_data->event_invite_id,
                        "guestname"=> $val_data->event_invite_guestname,
                        "guestemail"=> $val_data->event_invite_email,
                        "guestphno"=> $val_data->event_invite_mobileno,
                        "guestcompany"=> $val_data->event_invite_companyname,
                        "guestdesignation"=> $val_data->event_invite_designation,
                        "eventname"=> $req_data->event_title,
                 ); 
	            
	        }
	        
	        
	        return $query_data;
	        
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
	    
	    
	    $data_insert=array(
	           "event_invite_byuserid"=>$eventdata['userid'],
	           "event_invite_touserid"=>'',
	           "event_invite_eventid"=>$eventdata['eventid'],
	           "event_invite_guestname"=>$eventdata['guestname'],
	           "event_invite_mobileno"=>$eventdata['mobilenumber'],
	           "event_invite_email"=>$eventdata['emailid'],
	           "event_invite_designation"=>$eventdata['designation'],
	           "event_invite_companyname"=>$eventdata['companyname'],
	           "event_invite_creatdate"=>$eventdata['created_date'],
	           "event_invite_creattime"=>$eventdata['created_time'],
	           "event_invite_type"=>"2"
	        );
	        
	        $ress=$this->db->insert('event_invite',$data_insert); // echo $this->db->last_query();
	        if($ress==TRUE){
	           
	           
	            return $ress;
	        }else{
	            return FALSE;
	        }
	    
	    
	}
	
	public function add_reward_point($type,$userid,$creatdate,$creattime)
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
	    
	    $data_insert = array(
	        'userid'=>$userid,
	        'rewardid'=>$getdata->id,
	        'activity'=>$getdata->activity,
	        'point'=>$getdata->point,
	        'date'=>$creatdate,
	        'time'=>$creattime,
	        );
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
        
        $getuserdata = $this->db->query("select * from ratings_reviews where   `user_id`=$user_id")->result();  //review_note !='NULL' AND
       // print_r($getuserdata);
        foreach($getuserdata as $valuser)
        {
            $userids = $valuser->reviewed_by;  //echo $userids;
            $givenuser = $this->db->query("select id,CONCAT_WS(' ',first_name,middle_name,last_name) as full_name,CONCAT('".base_url()."upload/avatar/', avatar)  as profile_pic from user where `id`=$userids")->row();  //AND `role_ids` = 'S4ZhmaqIO1a311dffa9b3cace791c8993964e5cd95dJi4Nj3F'
        
            
            $userdata[] = array(
                'id'=>$userids,
                'title'=>$givenuser->full_name,
                'thumbnil'=>$givenuser->profile_pic,
                'review'=>$valuser->review_note,
                'rate'=>$valuser->ratings,
                'date'=>$valuser->review_date,
                'time'=>$valuser->review_time,
                'type'=>'User Review'
                );
        }
        
        $geteventdata = $this->db->query("select * from event_ratings_reviews where   `user_id`=$user_id")->result();  //review_note !='NULL' AND
       // print_r($getuserdata);
        foreach($geteventdata as $valevent)
        {
            $eventids = $valevent->event_id;  //echo $userids;
            $givenevent = $this->db->query("select event_title,event_thumbnil from events where `event_id`=$eventids")->row();  
        
            
            $userdata[] = array(
                'id'=>$eventids,
                'title'=>$givenevent->event_title,
                'thumbnil'=> base_url().'upload/events/'.$givenevent->event_thumbnil,
                'review'=>$valevent->review_note,
                'rate'=>$valevent->ratings,
                'date'=>$valevent->review_date,
                'time'=>$valevent->review_time,
                'type'=>'Event Review'
                );
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
                "total_point"=>$toal_points
                );
             }
        }
	    
	    if(isset($data_array) && !empty($data_array)){
	              array_multisort(array_map(function($element)
	              {
                      return $element['total_point'];
                  }, $data_array), SORT_DESC, $data_array);
	        return $data_array;
	        
	    }else{
	        
	        
	        return FALSE;
	    }
	}
	
		public function check_review_ratings_j4e($userid){
	    
	    $qrr=$this->db->query("select * from j4e_ratings_reviews where userid='".$userid."'")->result();
	    if(isset($qrr) && !empty($qrr)){
	        
	         $ress=array("status"=>TRUE,"id"=>$qrr[0]->id);
	    }else{
	        
	         $ress=array("status"=>FALSE,"id"=>"null");
	        
	        
	    }
	    
	    return $ress;
	    
	}
	
	public function get_j4e_ratings_data($user_rating_rev){
	    
	    $result=$this->db->query("select id,userid,ratings,review_note,review_date,review_time from j4e_ratings_reviews where id='".$user_rating_rev."'")->result();
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
        
        $obj = array();
        $data_post = array();
        $data_post_count = 0;
        
        $postsql = '';
        $postsql .= "  ( (user.first_name LIKE '%$keyword%') OR ( user.middle_name LIKE '%$keyword%') OR ( user.last_name LIKE '%$keyword%'))";
        $postsql .= " OR ( (postdetail.post_description LIKE '%$keyword%'))";
        
        $postquery=$this->db->query("select postdetail.*,user.id from `postdetail` INNER JOIN user ON user.id = postdetail.post_userid  where $postsql")->result(); 
	     
	    if(isset($postquery) && !empty($postquery))
	    {
	        foreach($postquery as $valpost)
	        {
	            $data_post[] = array(
	                "id"=>$valpost->post_id,
	                "title"=>$valpost->post_description,
	                );
	        }
	        
	        $data_post_count =  count($data_post);
	        
	    }
	    
	    
	    $obj = array();
        $data_event = array();
        $data_event_count = 0;
        
        $eventsql = '';
        $eventsql .= "  ( (events.event_title LIKE '%$keyword%') OR ( events.event_address LIKE '%$keyword%'))";
        
        
        $eventquery=$this->db->query("select events.*  from `events` where $eventsql")->result(); 
	     
	    if(isset($eventquery) && !empty($eventquery))
	    {
	        foreach($eventquery as $valevent)
	        {
	            $data_event[] = array(
	                "id"=>$valevent->event_id,
	                "title"=>$valevent->event_title,
	                "address"=>$valevent->event_address,
	                );
	        }
	        
	        $data_event_count =  count($data_event);
	        
	    }
	    
	    
	    
	    
	    
	    array_push($obj,array("PostCount"=>$data_post_count,"Postdata"=>$data_post,"EventCount"=>$data_event_count,"Eventdata"=>$data_event));
	    
	    if($obj)
	    {
	        return $obj;
	    }
	    else
	    {
	        return FALSE;
	    }
	    
	    
	    
	    
	}
	
	
	
	
}