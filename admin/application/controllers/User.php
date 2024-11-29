<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    public function __construct() {
		parent::__construct();
		
    }
	
	
	
	public function index() {
		//
	}
	
	
	
	public function my_profile() {
		$data['rs'] = $this->db->where('ids', $_SESSION['user_ids'])->get('user', 1)->row();
		my_load_view($this->setting->theme, 'User/my_profile', $data);
	}
	
	
	
	public function my_profile_action() {
		my_check_demo_mode();  //check if it's in demo mode
		if ($_SESSION['is_admin'] && my_uri_segment(3) != '') {  // admin modifies user's profile
		    my_check_demo_mode();  //check if it's in demo mode
			$ids = my_uri_segment(3);
		}
		else { //user modify his own profile
			$ids = $_SESSION['user_ids'];
		}
		// when update this part, don't forget to update api model to sync the same rule
		
		$data['rs'] = $this->db->where('ids', $ids)->get('user', 1)->row();
		$avatar_file = '';
		$this->form_validation->set_rules('email_address', my_caption('global_email_address'), 'trim|required|valid_email|max_length[50]|callback_email_duplicated_check[' . $ids . ']');
		if (my_post('username') != '') { $this->form_validation->set_rules('username', my_caption('global_username'), 'trim|min_length[5]|max_length[20]|alpha_dash|callback_username_duplicated_check[' . $ids . ']'); }
		$this->form_validation->set_rules('first_name', my_caption('mp_first_name_label'), 'trim|required|max_length[50]');
		$this->form_validation->set_rules('last_name', my_caption('mp_last_name_label'), 'trim|required|max_length[50]');
		$this->form_validation->set_rules('company', my_caption('mp_company_label'), 'trim|max_length[255]');
		$this->form_validation->set_rules('date_format', my_caption('mp_date_format_label'), 'trim|max_length[20]');
		$this->form_validation->set_rules('time_format', my_caption('mp_time_format_label'), 'trim|max_length[20]');
		$this->form_validation->set_rules('timezone', my_caption('mp_timezone_label'), 'trim|max_length[50]');
		$this->form_validation->set_rules('language', my_caption('mp_language_label'), 'trim|max_length[50]');
		$this->form_validation->set_rules('country', my_caption('mp_county_label'), 'trim|max_length[2]');
		$this->form_validation->set_rules('currency', my_caption('mp_currency_label'), 'trim|max_length[3]');
		$this->form_validation->set_rules('address_line_1', my_caption('mp_address_line_1_label'), 'trim|max_length[255]');
		$this->form_validation->set_rules('address_line_2', my_caption('mp_address_line_2_label'), 'trim|max_length[255]');
		$this->form_validation->set_rules('city', my_caption('mp_city_label'), 'trim|max_length[50]');
		$this->form_validation->set_rules('state', my_caption('mp_state_label'), 'trim|max_length[50]');
		$this->form_validation->set_rules('zip_code', my_caption('mp_zip_code_label'), 'trim|max_length[20]');
		$this->form_validation->set_rules('phone', my_caption('mp_phone_label'), 'trim|max_length[21]');
		if (isset($_FILES['userfile']['name'])) {
			if ($_FILES['userfile']['name'] != '') {
				$this->form_validation->set_rules('userfile', 'Upload File', 'callback_avatar_upload');
				$avatar_file = $_SESSION['user_ids'] . '.' . pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				}
		}
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('flash_danger', my_caption('global_something_failed'));
			if ($_SESSION['is_admin'] && my_uri_segment(3) != '') {
				my_load_view($this->setting->theme, 'Admin/edit_user', $data);
			}
			else {
				my_load_view($this->setting->theme, 'User/my_profile', $data);
			}
		}
		else {
			$this->load->model('user_model');
			$res = $this->user_model->update_profile($ids, $avatar_file);
			if ($res['result']) {
			    
			    //firebase insertion
			    $user_info = $this->db->where('ids',$ids)->get('user')->row();
//			    if(!empty($user_info->firebase_uid))
//			    {
//				    $this->load->library('firebase');
//                    $factory = $this->firebase->init();
//                    $db = $factory->getDatabase();
//                    $auth = $factory->getAuth();
//                    if(!empty($user_info->avatar))
//                    {
//                    $avatar = base_url('upload/avatar/'.$user_info->avatar);
//                    $avatar1 = base64_encode(file_get_contents($avatar));
//                    }else{
//                        $avatar = 'https://firebasestorage.googleapis.com/v0/b/j4e-app.appspot.com/o/default_user_img.png?alt=media&token=d65a3232-b36d-4386-8814-c23986808d83';
//        $avatar1 = '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\n';
//                    }
//                    $dname = my_post('first_name')." ".my_post('last_name');
//                    $fdata = [
//                        'name' => $dname,
//                        'photo' => $avatar,
//                        'thumbImg' => $avatar1,
//                        'designation' => '',
//                          'email' => my_post('email_address'),
//                          'company_name' => '',
//                          'company_address' => ''
//                    ];
//                    $ref = "users/".$user_info->firebase_uid."/";
//                    $properties = [
//                    'displayName' => $dname,
//                    'photoUrl' => $avatar
//                    ];
//                
//                $updatedUser = $auth->updateUser($user_info->firebase_uid, $properties);
//                        $postdata = $db->getReference($ref)->update($fdata);
//			    }
                    
				$this->session->set_flashdata('flash_success', $res['message']);
			}
			else {
				$this->session->set_flashdata('flash_danger', $res['message']);
			}
			if ($_SESSION['is_admin'] && my_uri_segment(3) != '') {
				redirect(base_url('admin/edit_user/' . my_uri_segment(3)));
			}
			else {
				redirect(base_url('user/my_profile'));
			}
		}
	}
	
	
	
	public function my_profile_impersonate_action() {
		$this->my_profile_action();
	}
	
	
	
	public function change_password() {
		my_load_view($this->setting->theme, 'User/change_password');
	}
	
	
	
	public function change_password_action() {
		my_check_demo_mode();  //check if it's in demo mode
		$throttle_check = my_throttle_check($_SESSION['user_ids']);
		if (!$throttle_check['result']) {
			$this->session->set_flashdata('flash_danger', $throttle_check['message']);
			redirect(base_url('user/change_password'));
		}
		else {
			$this->form_validation->set_rules('old_password', my_caption('cp_old_password_label'), 'trim|required|callback_check_old_password');
			if (!empty(my_post('new_password'))) {
				switch ($this->setting->psr) {
					case 'medium' :
					  $min_length = 8;
					  break;
					case 'strong' :
					  $min_length = 12;
					  break;
					default :
					  $min_length = 6;
				}
				$condition = 'trim|required|min_length[' . $min_length . ']|max_length[20]|callback_password_strength[' . $this->setting->psr . ']';
			}
			else {
				$condition = 'trim|required';
			}
			$this->form_validation->set_rules('new_password', my_caption('cp_new_password_label'), $condition);
			$this->form_validation->set_rules('new_password_confirm', my_caption('cp_new_password_confirm_label'), 'trim|required|matches[new_password]');
			if ($this->form_validation->run() == FALSE) {
				my_load_view($this->setting->theme, 'User/change_password');
			}
			else {
				my_log($_SESSION['user_ids'], 'Information', 'update-password', json_encode(my_ua()));  // log
				$this->db->where('ids', $_SESSION['user_ids'])->update('user', array('password'=>my_hash_password(my_post('new_password'))));
				$this->session->set_flashdata('flash_success', my_caption('cp_success'));
				redirect(base_url('user/change_password'));
			}
		}
	}
	
	
	
	public function my_activity_log() {
		my_load_view($this->setting->theme, 'User/my_activity');
	}
	
	
	
	public function my_notification() {
		($this->new_notification_tag) ? $this->db->where('ids', $_SESSION['user_ids'])->update('user', array('new_notification'=>0)) : null;
		my_load_view($this->setting->theme, 'User/my_notification');
	}
	
	
	
	public function my_notification_view() {
		$query = $this->db->where('ids', my_uri_segment(3))->group_start()->where('to_user_ids', $_SESSION['user_ids'])->or_where('to_user_ids', 'all')->group_end()->get('notification', 1);
		if ($query->num_rows()) {
			$data['rs'] = $query->row();
			($this->new_notification_tag) ? $this->db->where('ids', $_SESSION['user_ids'])->update('user', array('new_notification'=>0)) : null;
			($data['rs']->is_read == 0) ? $this->db->where('ids', $data['rs']->ids)->update('notification', array('is_read'=>1)) : null;
			my_load_view($this->setting->theme, 'Generic/view_notification', $data);
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	
	
	public function pay_now() {
		(!$this->payment_swtich) ? die(my_caption('payment_module_disabled')) : null;
		$payment_setting_array = json_decode($this->setting->payment_setting, 1);
		if (!empty($_SESSION['access_code'])) {
			$data['rs'] = $this->db->where('enabled', 1)->where('access_code', $_SESSION['access_code'])->order_by('id', 'asc')->get('payment_item')->result();
		}
		else {
			$data['rs'] = $this->db->where('enabled', 1)->where('access_code', '')->order_by('id', 'asc')->get('payment_item')->result();
		}
		$data['payment_gateway_stripe_one_time'] = $payment_setting_array['stripe_one_time_enabled'];
		$data['payment_gateway_stripe_recurring'] = $payment_setting_array['stripe_recurring_enabled'];
		$data['payment_gateway_paypal_one_time'] = $payment_setting_array['paypal_one_time_enabled'];
		$data['payment_gateway_paypal_recurring'] = $payment_setting_array['paypal_recurring_enabled'];
		(!empty($payment_setting_array['tax_rate'])) ? $data['payment_tax_rate'] = $payment_setting_array['tax_rate'] : $data['payment_tax_rate'] = 0;
		my_load_view($this->setting->theme, 'User/pay_now', $data);
	}
	
	
	
	public function pay_retry() {
		(!$this->payment_swtich) ? die(my_caption('payment_module_disabled')) : null;
		$query = $this->db->where('user_ids', $_SESSION['user_ids'])->where('ids', my_uri_segment(3))->where('redirect_status!=', 'success')->where('callback_status!=', 'success')->get('payment_log', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			($rs->type == 'purchase' || $rs->type == 'top-up') ? $pay_type = 'pay_once' : $pay_type = 'pay_recurring';
			redirect(base_url('user/' . $pay_type . '/' . $rs->gateway . '/' . $rs->item_ids . '/' . $rs->coupon . '/?quantity=' . $rs->quantity));
		}
		else {
			$this->session->set_flashdata('flash_danger', my_caption('payment_repay_unavailable'));
			redirect(base_url('user/pay_list'));
		}
	}
	
	
	
	public function pay_subscription_list() {
		my_load_view($this->setting->theme, 'User/pay_subscription_list');
	}
	
	
	
	public function pay_subscription_list_view() {
		$query = $this->db->where('user_ids', $_SESSION['user_ids'])->where('ids', my_uri_segment(3))->get('payment_subscription', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			$data['rs'] = $rs;
			$data['rs_item'] = $this->db->where('ids', $rs->item_ids)->get('payment_item', 1)->row();
			my_load_view($this->setting->theme, 'User/pay_subscription_list_view', $data);
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	
	
	public function pay_subscription_action() {
		my_check_demo_mode('alert_json');  //check if it's in demo mode
		$action = my_uri_segment(3);
		$query = $this->db->where('user_ids', $_SESSION['user_ids'])->where('ids', my_uri_segment(4))->get('payment_subscription', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			$result = my_payment_gateway_subscription_action($action, $rs, 'user/pay_subscription_list');
		}
		else {
			$result = '{"result":false, "title":"' . my_caption('global_failure') . '", "text":"'. my_caption('global_no_entries_found') . '", "redirect":"CallBack"}';
		}
		echo my_esc_html($result);
	}
	
	
	
	public function pay_list() {
		my_load_view($this->setting->theme, 'User/pay_list');
	}
	
	
	
	public function pay_once() {
		my_check_demo_mode();  //check if it's in demo mode
		(!$this->payment_swtich) ? die(my_caption('payment_module_disabled')) : null;
		$quantity = html_purify(my_get('quantity'));
		(!is_int($quantity)) ? $quantity = 1 : $quantity = abs($quantity);
		$query = $this->db->where('ids', my_uri_segment(4))->where('enabled', 1)->group_start()->where('type', 'top-up')->or_where('type', 'purchase')->group_end()->get('payment_item', 1);
		if (!$query->num_rows()) {
			echo my_caption('global_no_entries_found');
		}
		else {
			$rs = $query->row();
			if ($rs->purchase_limit != '0') {  //limit the purchase times
				if (my_check_purchase_by_item(my_uri_segment(4))) { //already bought
					$this->session->set_flashdata('flash_danger', my_caption('payment_purchase_times_limit'));
					redirect('user/pay_now');
				}
			}
			if ($rs->access_condition != '0') {  //limit the condition of purchase, if someone wants to buy this item, he should buy the basic one first.
				$access_condition_array = explode(',', $rs->access_condition);
				if ($access_condition_array[0] != '0') {
					$check_result = FALSE;
					foreach ($access_condition_array as $condition) {
						if (my_check_purchase_by_item($condition)) {  //purchase detected
							$check_result = TRUE;
							break;
						}
					}
					if (!$check_result) {
						$this->session->set_flashdata('flash_danger', my_caption('payment_purchase_violate_condition'));
						redirect('user/pay_now');
					}
				}
			}
			$this->load->model('user_model');
			$item_price = $rs->item_price;
			if (my_coupon_module() && my_uri_segment(5) != '') {  //coupon enabled, calculate the new price if necessary
				$coupon_array = my_coupon_check($rs->ids, my_uri_segment(5));
				($coupon_array['result']) ? $item_price = $coupon_array['amount'] : null;
			}
			$payment_setting_array = json_decode($this->setting->payment_setting, 1);
			if (!empty($payment_setting_array['tax_rate'])) {
				$tax = $payment_setting_array['tax_rate'];
				($tax) ? $item_price = round($item_price * (1 + $tax/100), 2) : null;  //tax
			}
			else {
				$tax = 0;
			}
			if (my_uri_segment(3) == 'stripe' && $payment_setting_array['stripe_one_time_enabled']) {
				\Stripe\Stripe::setApiKey($payment_setting_array['stripe_secret_key']);
				try {
					$stripe_amount = $item_price * 100;
					(strtolower($rs->item_currency) == 'jpy') ? $stripe_amount = intval($item_price) : null;   // for Japanese Yen only
					$checkout_session = \Stripe\Checkout\Session::create([
					  'success_url' => base_url('/user/pay_success/{CHECKOUT_SESSION_ID}'),
					  'cancel_url' => base_url('/user/pay_cancel/{CHECKOUT_SESSION_ID}'),
					  'payment_method_types' => ['card'],
					  'mode' => 'payment',
					  'line_items' => [[
					    'name' => $rs->item_name,
						'description' => $rs->item_description,
						'amount' => $stripe_amount,
						'currency' => strtolower($rs->item_currency),
						'quantity' => 1,
					  ]]
					]);
					$data['publishable_key'] = $payment_setting_array['stripe_publishable_key'];
					$data['checkout_session'] = $checkout_session['id'];
					$this->user_model->payment_log('stripe', $checkout_session['id'], $rs, $item_price, $tax);
					my_load_view($this->setting->theme, 'User/pay_stripe', $data); //redirect to the payment page
				}
				catch (\Exception $e) {
					log_message('error', $e->getMessage());
					die(my_caption('payment_exception'));
				}
			}
			elseif (my_uri_segment(3) == 'paypal' && $payment_setting_array['paypal_one_time_enabled']) {
				  $paypal_clientid = $payment_setting_array['paypal_client_id'];
				  $paypal_secret = $payment_setting_array['paypal_secret'];
				  ($payment_setting_array['type'] == 'sandbox') ? $paypal_environment = new \PayPalCheckoutSdk\Core\SandboxEnvironment($paypal_clientid, $paypal_secret) : $paypal_environment = new \PayPalCheckoutSdk\Core\ProductionEnvironment($paypal_clientid, $paypal_secret);
				  $paypal_client = new \PayPalCheckoutSdk\Core\PayPalHttpClient($paypal_environment);
				  $paypal_request = new \PayPalCheckoutSdk\Orders\OrdersCreateRequest();
				  $paypal_request->prefer('return=representation');
				  $paypal_request->body = [
				    'intent' => 'AUTHORIZE',
                    'purchase_units' => [[
					  'reference_id' => my_random(),
                      'amount' => [
					    'value' => $item_price,
                        'currency_code' => strtolower($rs->item_currency)
                      ]
                    ]],
                    'application_context' => [
					  'cancel_url' => base_url('/user/pay_cancel/'),
                      'return_url' => base_url('/user/pay_success/')
                    ]
				  ];
				  try {
					  $paypal_response = $paypal_client->execute($paypal_request);
					  $paypal_order_result = $paypal_response->result;
					  $this->user_model->payment_log('paypal', $paypal_order_result->id, $rs, $item_price, $tax);
					  header('Location: ' . $paypal_order_result->links[1]->href);
				  }
				  catch(\Exception $e) {
					  die(my_caption('payment_exception'));
				  }
			}
			else {
				echo my_caption('payment_payment_gateway_unavailable');
			}
		}
	}
	
	
	
	public function pay_recurring() {
		my_check_demo_mode();  //check if it's in demo mode
		(!$this->payment_swtich) ? die(my_caption('payment_module_disabled')) : null;
		$quantity = html_purify(my_get('quantity'));
		(!is_int($quantity)) ? $quantity = 1 : $quantity = abs($quantity);
		$query = $this->db->where('ids', my_uri_segment(4))->where('enabled', 1)->where('type', 'subscription')->get('payment_item', 1);
		if (!$query->num_rows()) {
			echo my_caption('global_no_entries_found');
		}
		else {
			$rs = $query->row();
			if ($rs->purchase_limit != '0') {  //limit the purchase times
				if (my_check_subscription_by_item($rs->ids)) { //already subscribe
					$this->session->set_flashdata('flash_danger', my_caption('payment_purchase_times_limit'));
					redirect('user/pay_now');
				}
			}
			$this->load->model('user_model');
			$item_price = $rs->item_price;
			if (my_coupon_module() && my_uri_segment(5) != '') {  //coupon enabled, calculate the new price if necessary
				$coupon_array = my_coupon_check($rs->ids, my_uri_segment(5));
				($coupon_array['result']) ? $item_price = $coupon_array['amount'] : null;
			}
			$payment_setting_array = json_decode($this->setting->payment_setting, 1);
			$item_stuff_array = json_decode($rs->stuff_setting, 1);
			if (!empty($payment_setting_array['tax_rate'])) {
				$tax = $payment_setting_array['tax_rate'];
				($tax) ? $item_price = round($item_price * (1 + $tax/100), 2) : null;  //tax
			}
			else {
				$tax = 0;
			}
			if (my_uri_segment(3) == 'stripe' && $payment_setting_array['stripe_recurring_enabled']) {
				\Stripe\Stripe::setApiKey($payment_setting_array['stripe_secret_key']);
				//There are 3 steps in the subscription process
				//step 1: try to retrieve product from stripe, Create one if it doesn't exist, The product should exist at the end of this step.
				(!array_key_exists('stripe_product_id', $item_stuff_array)) ? $product_id = 'foo' : $product_id = $item_stuff_array['stripe_product_id'];
				try {
					$product = \Stripe\Product::retrieve($product_id);
					($product->active) ? $product_id = $product->id : null;
				}
				catch (\Exception $e) {
					$product_id = 'foo';
                }
				if ($product_id == 'foo') { //create product at stripe if product doesn't exist
					try {
						$product = \Stripe\Product::create(['name'=>$rs->item_name]);
						$product_id = $product->id;
						my_save_payment_item_stuff_setting(my_uri_segment(4), 'stripe_product_id', $product_id);
					}
					catch (\Exception $e) {
						die(my_caption('payment_exception'));
					}
				}
				//step 2: try to retrieve the price related to the product from stripe, Create one if it doesn't exist, The price should exist at the end of this step.
				(!array_key_exists('stripe_price_id', $item_stuff_array)) ? $price_id = 'foo' : $price_id = $item_stuff_array['stripe_price_id'];
				try {
					$price = \Stripe\Price::retrieve($price_id);
					$price_id = $price->id;
				}
				catch (\Exception $e) {
					$price_id = 'foo';
				}
				if ($price_id == 'foo') { //create price at stripe if price doesn't exist
					try {
						$stripe_amount = $item_price * 100;
						(strtolower($rs->item_currency) == 'jpy') ? $stripe_amount = intval($item_price) : null;   // for Japanese Yen only
						$price = \Stripe\Price::create([
						  'unit_amount' => $stripe_amount,
						  'currency' => strtolower($rs->item_currency),
						  'recurring' => [
						    'interval' => $rs->recurring_interval,
							'interval_count' => $rs->recurring_interval_count
						  ],
						  'product' => $product_id
						]);
						$price_id = $price->id;
						my_save_payment_item_stuff_setting(my_uri_segment(4), 'stripe_price_id', $price_id);
					}
					catch (\Exception $e) {
						log_message('error', $e->getMessage());
						die(my_caption('payment_exception'));
					}
				}
				//step 3: create subscription and redirect to stripe checkout
				try {
					$checkout_session = \Stripe\Checkout\Session::create([
					  'payment_method_types' => ['card'],
					  'line_items' => [[
					    'price' => $price_id,
						'quantity' => 1
					  ]],
					  'mode' => 'subscription',
					  'success_url' => base_url('/user/pay_success/{CHECKOUT_SESSION_ID}'),
					  'cancel_url' => base_url('/user/pay_cancel/{CHECKOUT_SESSION_ID}'),
					]);
				}
				catch (\Exception $e) {
					die(my_caption('payment_exception'));
				}
				$data['publishable_key'] = $payment_setting_array['stripe_publishable_key'];
				$data['checkout_session'] = $checkout_session['id'];
				$this->user_model->payment_log('stripe', $checkout_session['id'], $rs, $item_price, $tax);
				my_load_view($this->setting->theme, 'User/pay_stripe', $data); //redirect to payment page
			}
			elseif (my_uri_segment(3) == 'paypal' && $payment_setting_array['paypal_recurring_enabled']) {
				//will come later
			}
			else {
				echo my_caption('payment_payment_gateway_unavailable');
			}
		}
	}
	
	
	
	public function pay_free() {
		$query = $this->db->where('ids', my_uri_segment(3))->where('enabled', 1)->where('item_price', 0)->get('payment_item', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			if ($rs->purchase_limit != '0') {  //limit the purchase times
				if (my_check_purchase_by_item($rs->ids)) { //already bought
					$this->session->set_flashdata('flash_danger', my_caption('payment_purchase_times_limit'));
					redirect('user/pay_now');
				}
				if (my_check_subscription_by_item($rs->ids, TRUE)) { //already subscribe
					$this->session->set_flashdata('flash_danger', my_caption('payment_purchase_times_limit'));
					redirect('user/pay_now');
				}
			}
			$this->load->model('user_model');
			$this->user_model->save_free_package($_SESSION['user_ids'], $rs);
			redirect('user/pay_success/');
		}
		else {  //package is not existed
			echo my_caption('global_no_entries_found');
		}
		
	}



	public function pay_success() {
		(!$this->payment_swtich) ? die(my_caption('payment_module_disabled')) : null;
		$this->session->set_flashdata('flash_success', my_caption('payment_payment_success'));
		$this->db->where('gateway_identifier', my_uri_segment(3))->or_where('gateway_identifier', html_purify(my_get('token')))->update('payment_log', array('redirect_status'=>'success'));
		redirect(base_url('user/pay_now'));
	}
	
	
	
	public function pay_cancel() {
		(!$this->payment_swtich) ? die(my_caption('payment_module_disabled')) : null;
		$this->session->set_flashdata('flash_warning', my_caption('payment_payment_cancel'));
		$this->db->where('gateway_identifier', my_uri_segment(3))->or_where('gateway_identifier', html_purify(my_get('token')))->update('payment_log', array('redirect_status'=>'cancel'));
		redirect(base_url('user/pay_now'));
	}
	
	
	
	public function remove_self() {
		my_check_demo_mode();  //check if it's in demo mode
		my_remove_user($_SESSION['user_ids']);
		redirect(base_url('generic/sign_out'));
	}
	
	
	
	//This method is used to generate invoice
	public function invoice() {
		$query = $this->db->where('user_ids', $_SESSION['user_ids'])->where('ids', my_uri_segment(3))->get('payment_log', 1);
		if ($query->num_rows()) {
			$rs = $query->row();
			if (!$rs->generate_invoice) {
				$this->session->set_flashdata('flash_warning', my_caption('payment_invoice_not_applicable'));
				redirect(base_url('user/pay_list'));
			}
			else {
				$rs_item = $this->db->where('ids', $rs->item_ids)->get('payment_item', 1)->row();
				$rs_user = $this->db->where('ids', $_SESSION['user_ids'])->get('user', 1)->row();
				$issued_to = my_user_setting($_SESSION['user_ids'], 'company');
				if (empty($issued_to)) {
					$issued_to = $_SESSION['full_name'];
					$agency = FALSE;
				}
				else {
					$agency = TRUE;
				}
				$data = array(
				  'agency' => $agency,
				  'invoice_no' => strtoupper(substr($_SESSION['user_ids'], -10) . strtotime($rs->created_time)),
				  'generated_date' => my_conversion_from_server_to_local_time($rs->callback_time, $this->user_timezone, $this->user_date_format),
				  'issued_to' => $issued_to,
				  'address_line_1' => $rs_user->address_line_1,
				  'address_line_1' => $rs_user->address_line_2,
				  'city' => $rs_user->city,
				  'state' => $rs_user->state,
				  'country' => $rs_user->country,
				  'zip_code' => $rs_user->zip_code,
				  'payment_method' => ucfirst($rs->gateway),
				  'transaction_no' => substr($rs->gateway_identifier, -10),
				  'item' => $rs->item_name,
				  'currency' => $rs->currency,
				  'price' => $rs->price,
				  'quantity' => $rs->quantity,
				  'discount' => $rs->coupon_discount,
				  'tax_rate' => $rs->tax . '%',
				  'tax' => ($rs->price - $rs->coupon_discount) * ($rs->tax/100),
				  'amount' => $rs->amount  //currently only support one item so it's same as amount
				);
				if ($agency) {
					$data['company_no'] = $rs_user->company_number;
					$data['tax_no'] = $rs_user->tax_number;
				}
				$html = my_load_view($this->setting->theme, 'User/invoice', $data, TRUE);
				$dompdf = new Dompdf\Dompdf();
				$invoice_css = '<style>' . file_get_contents(FCPATH . 'assets/themes/' . $this->setting->theme . '/css/invoice_default.css') . '</style>';
				$dompdf->loadHtml($invoice_css . $html);
				$dompdf->setPaper('A4', 'portrait');
				$dompdf->render();
				$dompdf->stream(my_uri_segment(3) . '.pdf', array('Attachment' => 0));
			}
		}
		else {
			echo my_caption('global_no_entries_found');
		}
	}
	
	
	
	// List ticket
	public function ticket() {
		my_load_view($this->setting->theme, 'User/ticket_list');
	}
	
	
	
	// New ticket
	public function ticket_new() {
		$data['catalog_options'] = my_get_catalog('support_ticket');
		my_load_view($this->setting->theme, 'User/ticket_new', $data);
	}
	
	
	
	// New ticket action
	public function ticket_new_action() {
		my_check_demo_mode();  //check if it's in demo mode
		$this->form_validation->set_rules('ticket_catalog', my_caption('global_catalog'), 'trim|required|max_length[50]');
		$this->form_validation->set_rules('ticket_priority', my_caption('support_ticket_priority'), 'trim|required|integer');
		$this->form_validation->set_rules('ticket_subject', my_caption('support_ticket_subject'), 'trim|required|max_length[255]');
		$this->form_validation->set_rules('ticket_description', my_caption('support_ticket_description'), 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['catalog_options'] = my_get_catalog('support_ticket');
			my_load_view($this->setting->theme, 'User/ticket_new', $data);
		}
		else {
			$this->load->model('user_model');
			$res_ids = $this->user_model->save_ticket();
			$this->session->set_flashdata('flash_success', my_caption('support_ticket_submit_success'));
			redirect(base_url('user/ticket_view/' . $res_ids));
		}
	}
	
	
	
	// View ticket
	public function ticket_view() {
		$res = $this->get_ticket(my_uri_segment(3));
		if ($res == FALSE) {
			echo my_caption('global_no_entries_found');
		}
		else {
			if ($res['rs']->main_status == 1) {
				$this->db->where('ids', my_uri_segment(3))->where('read_status', 0)->update('ticket', array('read_status'=>1));  //update the follow-up ticket's read status
			}
			my_load_view($this->setting->theme, 'Generic/view_ticket', $res);
		}
	}
	
	
	
	// Followup ticket
	public function ticket_view_action() {
		my_check_demo_mode();  //check if it's in demo mode
		$this->form_validation->set_rules('ticket_reply', my_caption('global_reply'), 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$res = $this->get_ticket(my_post('ids_father'));
			my_load_view($this->setting->theme, 'Generic/view_ticket', $res);
		}
		else {
			$query = $this->db->where('ids', my_post('ids_father'))->where('user_ids', $_SESSION['user_ids'])->get('ticket', 1);
			if ($query->num_rows()) {
				$this->load->model('user_model');
				$ids = $this->user_model->update_ticket('user_update');
				$this->session->set_flashdata('flash_success', my_caption('support_ticket_notice_reply_saved'));
				redirect(base_url('user/ticket_view/' . $ids));
			}
			else {
				echo my_caption('global_no_entries_found');
			}
		}
	}
	
	
	
	public function ticket_close_action() {
		my_check_demo_mode('alert_json');  //check if it's in demo mode
		$this->db->where('ids', my_uri_segment(3))->where('main_status!=', 0)->where('user_ids', $_SESSION['user_ids'])->update('ticket', array('main_status'=>0, 'read_status'=>1, 'updated_time'=>my_server_time()));
		echo '{"result":true, "title":"", "text":"'. my_caption('support_ticket_notice_close') . '", "redirect":"' . base_url('user/ticket_view/' . my_uri_segment(3)) . '"}';
	}	
	
	
	
	public function ticket_rating_action() {
		my_check_demo_mode('alert_json');  //check if it's in demo mode
		$query = $this->db->where('ids', my_uri_segment(3))->where('user_ids', $_SESSION['user_ids'])->get('ticket', 1);
		if ($query->num_rows()) {
			(my_uri_segment(4) != '1' && my_uri_segment(4) != '2' && my_uri_segment(4) != '3') ? $rating = 3 : $rating = my_uri_segment(4);
			$this->db->where('ids', my_uri_segment(3))->update('ticket', array('rating'=>$rating));
		}
		echo '{"result":true, "title":"", "text":"'. my_caption('support_ticket_notice_rating_saved') . '", "redirect":"' . base_url('user/ticket_view/' . my_uri_segment(3)) . '"}';
	}
	
	
	
	// callback for form_validation
	public function check_old_password($old_password) {
		$query = $this->db->where('ids', $_SESSION['user_ids'])->get('user', 1);
		if ($query->num_rows()) {
			if (password_verify($old_password, $query->row()->password)) {
				return TRUE;
			}
			else {
				my_throttle_log($_SESSION['user_ids']);
				$this->form_validation->set_message('check_old_password', my_caption('cp_old_password_error'));
				return FALSE;
			}
		}
		else {
			my_throttle_log($_SESSION['user_ids']);
			$this->form_validation->set_message('check_old_password', my_caption('cp_old_password_error'));
			return FALSE;
		}
	}
	
	
	
	// callback for form_validation
	public function email_duplicated_check($email_address, $ids) {
		if (my_duplicated_check('user', array('email_address'=>$email_address), $ids)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('email_duplicated_check', my_caption('mp_email_taken'));
			return FALSE;
		}
	}
	
	
	// callback for form_validation
	public function username_duplicated_check($username, $ids) {
		if (my_duplicated_check('user', array('username'=>$username), $ids)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('username_duplicated_check', my_caption('mp_username_taken'));
			return FALSE;
		}
	}
	
	
    public function avatar_upload() {
		$this->load->library('m_upload');
		$this->m_upload->set_upload_path('/' . '/' . $this->config->item('my_upload_directory') . 'avatar/');
		$this->m_upload->set_allowed_types('png|gif|jpg|jpeg');
		$this->m_upload->set_file_name($_SESSION['user_ids']);
		//$this->my_upload->set_remove_file();
		$res = $this->m_upload->upload_done();
		if ($res['status']) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('avatar_upload', $res['error']);
			return FALSE;
		}
	}
	
	
	
	protected function get_ticket($ids) {
		$query = $this->db->where('ids', $ids)->where('user_ids', $_SESSION['user_ids'])->where('ids_father', 0)->get('ticket', 1);
		if ($query->num_rows()) {
			$data['rs'] = $query->row();  //one record only
			$data['rs_follow'] = $this->db->where('ids_father', $ids)->order_by('created_time', 'asc')->get('ticket')->result();  //full recordset
			return $data;
		}
		else {
			return FALSE;
		}
	}
	
}
?>