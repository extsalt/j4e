<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once FCPATH . 'vendor/autoload.php';

class Webhook extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
        date_default_timezone_set($this->config->item('time_reference'));		
	}
	
	
	
	public function stripe() {
		$payment_setting_array = json_decode(my_global_setting('payment_setting'), 1);
		\Stripe\Stripe::setApiKey($payment_setting_array['stripe_secret_key']);
		$endpoint_secret = $payment_setting_array['stripe_signing_secret'];
		$payload = @file_get_contents('php://input');
		$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
		$event = null;
		try {
			$event = \Stripe\Webhook::constructEvent(
			  $payload, $sig_header, $endpoint_secret
			);
		}
		catch(\UnexpectedValueException $e) {
			http_response_code(400);  //invalid payload
			exit();
		}
		catch(\Stripe\Exception\SignatureVerificationException $e) {
			http_response_code(400);  // invalid signature
			exit();
		}
		// Handle the event
		switch ($event->type) {
			case 'checkout.session.completed' :
			  $payment_callback = $event->data->object;
			  $this->handle_successful_payment($payment_callback->id, $event->id, $payment_callback);
			  break;
			case 'customer.subscription.updated' :
			  $payment_callback = $event->data->object;
			  if ($payment_callback->status == 'active') {
				  $update_array = array(
				    'start_time' => mdate('%Y-%m-%d %H:%i:%s', $payment_callback->current_period_start),
					'end_time' => mdate('%Y-%m-%d %H:%i:%s', $payment_callback->current_period_end),
					'updated_time' => my_server_time()
				  );
				  $this->create_subscription_updated_payment_log($payment_callback->id, $event->id); // create a payment log
			  }
			  else {
				  $update_array = array('status' => 'expired', 'updated_time' => my_server_time());
			  }
			  $this->db->where('gateway_identifier', $payment_callback->id)->update('payment_subscription', $update_array);
			  break;
		}
		http_response_code(200);
	}
	
	
	
	public function paypal() {
		$webhook_array = json_decode(file_get_contents('php://input'), TRUE);
        if (!json_last_error()) {
			$paypal_event = $webhook_array['event_type'];
			switch ($paypal_event) {
				case 'CHECKOUT.ORDER.APPROVED' :
				  $paypal_order_id = $webhook_array['resource']['id'];
				  if ($this->paypal_authorize_order($paypal_order_id)) {
					  $this->handle_successful_payment($paypal_order_id, $webhook_array['id']);
				  }
				  break;
			}
		}
		http_response_code(200);
	}
	
	
	
	protected function handle_successful_payment($gateway_identifier, $gateway_event_id, $obj = '') { // $obj is only for subscription type
		$query = $this->db->where('gateway_identifier', $gateway_identifier)->where('gateway_event_id!=', $gateway_event_id)->where('callback_status', 'pending')->get('payment_log', 1);  //check gateway_event_id to prevent duplicated
		if ($query->num_rows()) {
			$rs = $query->row();
			$query_item = $this->db->where('ids', $rs->item_ids)->get('payment_item', 1);
			if ($query_item->num_rows()) {
				$auto_renew = $query_item->row()->auto_renew;
			}
			else {
				$auto_renew = 0; //unexpected result
			}
			$this->db->where('id', $rs->id)->update('payment_log', array('gateway_event_id'=>$gateway_event_id, 'redirect_status'=>'success', 'callback_status'=>'success', 'callback_time'=>my_server_time()));
			switch ($rs->type) {
				case 'top-up' :
				  //top up to the account
				  my_user_reload($rs->user_ids, 'Add', $rs->currency, $rs->amount);
				  break;
				case 'purchase' :
				  // log it
				  $insert_array = array(
				    'ids' => my_random(),
					'user_ids' => $rs->user_ids,
					'payment_ids' => $rs->ids,
					'item_type' => 'purchase',
					'item_ids' => $rs->item_ids,
					'item_name' => $rs->item_name,
					'created_time' => my_server_time(),
					'used_up' => 0,
					'auto_renew' => $auto_renew
				  );
				  $this->db->insert('payment_purchased', $insert_array);
				  //you can also handle your further action here
				  //you can also handle your further action here
				  //you can also handle your further action here
				  break;
			    case 'subscription' :
				  //build up subscription
				  switch ($rs->gateway) {
					  case 'stripe' :
					    $subscription = $this->stripe_retrieve_subscription($obj->subscription);
						if ($subscription) {
							$insert_data = array(
							  'ids' => my_random(),
							  'item_ids' => $rs->item_ids,
							  'user_ids' => $rs->user_ids,
							  'payment_gateway' => $rs->gateway,
							  'gateway_identifier' => $obj->subscription,
							  'quantity' => $rs->quantity,
							  'status' => $subscription->status,
							  'start_time' => mdate('%Y-%m-%d %H:%i:%s', $subscription->current_period_start),
							  'end_time' => mdate('%Y-%m-%d %H:%i:%s', $subscription->current_period_end),
							  'created_time' => my_server_time(),
							  'updated_time' => my_server_time(),
							  'description' => '',
							  'used_up' => 0,
							  'auto_renew' => $auto_renew
							);
							$this->db->insert('payment_subscription', $insert_data);
						}
					  case 'paypal' :
					    break;
				  }
			      break;
			}
			if (my_coupon_module() || my_affiliate_module()) {
				$this->load->helper('my_coupon_affiliate');
				my_coupon_applied($rs, $rs->coupon);
				my_affiliate_applied($rs);
			}
			//send email at last step, ignore whether it's successfull, do confirm this operation is always at last step
			$rs_email = $this->db->where('purpose', 'pay_success')->get('email_template', 1)->row();
			$email = array(
			  'email_to' => my_user_setting($rs->user_ids, 'email_address'),
			  'email_subject' => $rs_email->subject,
			  'email_body' => str_replace('{{purchase_item}}', $rs->item_name, str_replace('{{purchase_price}}', $rs->currency . $rs->amount, $rs_email->body))
			);
			my_send_email($email);
		}
	}
	

	
	protected function paypal_authorize_order($paypal_order_id) {
		$payment_setting_array = json_decode(my_global_setting('payment_setting'), 1);
		$paypal_clientid = $payment_setting_array['paypal_client_id'];
		$paypal_secret = $payment_setting_array['paypal_secret'];
		($payment_setting_array['type'] == 'sandbox') ? $paypal_environment = new \PayPalCheckoutSdk\Core\SandboxEnvironment($paypal_clientid, $paypal_secret) : $paypal_environment = new \PayPalCheckoutSdk\Core\ProductionEnvironment($paypal_clientid, $paypal_secret);
		$paypal_client = new \PayPalCheckoutSdk\Core\PayPalHttpClient($paypal_environment);
		$paypal_request = new \PayPalCheckoutSdk\Orders\OrdersAuthorizeRequest($paypal_order_id);
		$paypal_request->prefer('return=representation');
		try {
			$paypal_response = $paypal_client->execute($paypal_request);
			if ($paypal_response->result->status == 'COMPLETED') {
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		catch (\Exception $e) {
			return FALSE;
		}
	}
	
	
	
	protected function stripe_retrieve_subscription($subscription_id) {
		try {
			$subscription = \Stripe\Subscription::retrieve($subscription_id);
			return $subscription;
		}
		catch (\Exception $e) {
			return FALSE;
		}
	}
	
	
	
	public function create_subscription_updated_payment_log($gateway_identifier, $gateway_event_id) {  // no difference between different payment gateway
		$query = $this->db->where('gateway_identifier', $gateway_identifier)->where('gateway_event_id', $gateway_event_id)->get('payment_log', 1);
		if ($query->num_rows == 0) { // no duplicated record, create a new log
			$temporary_checking_time = date('Y-m-d H:i_s', strtotime(my_server_time()) - (5 * 60));
		    $query_subscription = $this->db->where('gateway_identifier', $gateway_identifier)->where('created_time<', $temporary_checking_time)->get('payment_subscription', 1);
			if ($query_subscription->num_rows()) {
				$rs_subscription = $query_subscription->row();
				$rs_item = $this->db->where('ids', $rs_subscription->item_ids)->get('payment_item', 1)->row();
				$current_datetime = my_server_time();
				$insert_array = array(
				  'ids' => my_random(),
				  'user_ids' => $rs_subscription->user_ids,
				  'type' => 'subscription',
				  'gateway' => $rs_subscription->payment_gateway,
				  'currency' => $rs_item->item_currency,
				  'price' => $rs_item->item_price,
				  'quantity' => $rs_subscription->quantity,
				  'amount' => $rs_item->item_price * $rs_subscription->quantity,
				  'gateway_identifier' => $gateway_identifier,
				  'gateway_event_id' => $gateway_event_id,
				  'item_ids' => $rs_subscription->item_ids,
				  'item_name' => $rs_item->item_name,
				  'redirect_status' => 'success',
				  'callback_status' => 'success',
				  'created_time' => $current_datetime,
				  'callback_time' => $current_datetime,
				  'visible_for_user' => 1,
				  'generate_invoice' => 1,
				  'description' => '',
				  'coupon' => ''
				);
				$this->db->insert('payment_log', $insert_array);
			}
		}
		return TRUE;
	}
	
	
	
	
	
	
	
	
}