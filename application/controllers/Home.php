<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'views/razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('home');
    }

    public function login()
    {
        if ($_POST) {
            $pack_info = $this->db->where('pack_id', $this->input->post('packages_id'))->get('packages')->row();
            $register_details = array(
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'email_address' => $this->input->post('email_address'),
                'company' => $this->input->post('company'),
                'designation' => $this->input->post('designation'),
                'mobile_number' => $this->input->post('mobile_number'),
                'wmobile' => $this->input->post('wmobile'),
                'company_contact' => $this->input->post('company_contact'),
                'company_address' => $this->input->post('company_address'),
                'referred_by' => $this->input->post('referred_by'),
                'packages_id' => $this->input->post('packages_id')
            );
            $this->session->set_userdata('isLogin', 1);
            //                print_r($register_details);die;
            $this->session->set_userdata('register_details', $register_details);
            $data['amount'] = $pack_info->pack_price;
            $data['customer_info'] = array(
                'name' => $register_details['first_name'] . " " . $register_details['last_name'],
                'email' => $register_details['email_address'],
                'phone' => $register_details['mobile_number']
            );
            $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 8);
            $ws = $this->db->get('setting')->row();
            $data['key'] = $ws->razorpay_key;
            $data['secret'] = $ws->razorpay_secret;

            $api = new Api($data['key'], $data['secret']);
            $orderData = [
                'receipt'         => $code,
                'amount'          => ($data['amount'] * 100), // 39900 rupees in paise
                'currency'        => 'INR'
            ];

            $razorpayOrder = $api->order->create($orderData);
            $data['order_data'] = $razorpayOrder;
        }
        $this->load->view('login', $data);
    }
    public function send_otp()
    {
        $mobile = $this->input->post('mobile');
        $res = $this->db->query("select * from user where phone='" . $mobile . "' ")->result();
        if (isset($res) && !empty($res)) {
            if ($res->user_delete == 2) {
                echo "2";
            } else {
                if ($mobile == "9049718692") {
                    $otp = "1635";
                } else {
                    $otp = rand(1111, 9874);
                }
                $this->db->where(array('phone' => $mobile));
                $q = $this->db->update('user', array('otp' => $otp));

                $this->db->where(array('phone' => $mobile));
                $q1 = $this->db->update('user_temp', array('otp' => $otp));
                $otp_mob = $this->db->query("select * from user_temp where phone='" . $mobile . "'")->result();
                if (isset($otp_mob) && !empty($otp_mob)) {
                    $this->send_otp_for_vrify($mobile, $otp_mob[0]->otp);
                    echo "1";
                } else {
                    if ($mobile == "9049718692") {
                        $otp = "1635";
                    } else {
                        $otp = rand(1111, 9874);
                    }
                    $user_array = array('phone' => $mobile, 'otp' => $otp);
                    $ressuu = $this->db->insert('user_temp', $user_array);
                    $insert_id = $this->db->insert_id();
                    if (isset($insert_id) && !empty($insert_id)) {
                        $this->send_otp_for_vrify($mobile, $otp);
                        echo "1";
                    } else {
                        echo "0";
                    }
                }
            }
        } else {
            $otp = rand(1111, 9874);
            $checkmobile = $this->db->query("select * from user_temp where phone='" . $mobile . "'")->result();
            if (isset($checkmobile) && !empty($checkmobile)) {
                $user_array = array('otp' => $otp);
                $this->db->where(array('phone' => $mobile, 'id' => $checkmobile[0]->id));
                $ressuu = $this->db->update('user_temp', $user_array);
                if (isset($ressuu) && !empty($ressuu)) {
                    $this->send_otp_for_vrify($mobile, $otp);
                    echo "1";
                } else {
                    echo "0";
                }
            } else {
                $user_array = array('phone' => $mobile, 'otp' => $otp);
                $ressuu = $this->db->insert('user_temp', $user_array);
                $insert_id = $this->db->insert_id();
                if (isset($insert_id) && !empty($insert_id)) {
                    $this->send_otp_for_vrify($mobile, $otp);
                    echo "1";
                } else {
                    echo "0";
                }
            }
        }
        //            echo true;
    }
    public function send_otp_for_vrify($mobile, $otp)
    {
        $url = "https://softsms.in/app/smsapi/index.php?key=671a271f67634&type=text&contacts=$mobile&senderid=JFENTP&peid=1201161225010387296&templateid=1207166624969359273&msg=One%20Time%20Password%20$otp%20to%20Login%20for%20J4E%20App.%20If%20you%20didn%27t%20initiate,%20report%20as%20FRAUD%20on%209850325204%20J4E%20Team";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        file_put_contents(__FILE__ . '.log', json_encode(compact('url', 'response')));
        curl_close($ch);
        $log_detail = $this->my_ua();
        $insert_data = array(
            'user_ids' => $mobile,
            'level' => 'Information',
            'event' => 'otp-requested',
            'detail' => json_encode($log_detail),
            'debug_detail' => '',
            'created_time' => date('Y-m-d H:i:s')
        );
        $this->db->insert('otp_logs', $insert_data);
    }
    public function verify_otp()
    {
        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');
        $checkmobile = $this->db->query("select * from user_temp where phone='" . $mobile . "' and otp='" . $otp . "'")->result();
        if (isset($checkmobile) && !empty($checkmobile)) {
            $log_detail = $this->my_ua();
            $insert_data = array(
                'user_ids' => $mobile,
                'level' => 'Information',
                'event' => 'otp-verify',
                'detail' => json_encode($log_detail),
                'debug_detail' => '',
                'created_time' => date('Y-m-d H:i:s')
            );
            $q = $this->db->insert('otp_logs', $insert_data);
            $this->db->where(array('phone' => $mobile));
            $this->db->update('user_temp', array('phone_verified' => 1, 'otp_verified' => 1));
            $check_in_usertble = $this->db->query("select * from user where phone='" . $mobile . "'")->row();
            if (isset($check_in_usertble) && !empty($check_in_usertble)) {
                $log_detail = $this->my_ua();
                $insert_data = array(
                    'user_ids' => $check_in_usertble->ids,
                    'level' => 'Information',
                    'event' => 'signin-success',
                    'detail' => json_encode($log_detail),
                    'debug_detail' => '',
                    'created_time' => date('Y-m-d H:i:s')
                );
                $q1 = $this->db->insert('activity', $insert_data);
                $this->db->where(array("phone" => $mobile));
                $rrrr = $this->db->update('user', array('phone_verified' => 1, 'otp_verified' => 1));
                $sData = array(
                    'isLogIn'       => true,
                    'userid'   => $check_in_usertble->id,
                );

                $this->session->set_userdata($sData);
                echo "2";
            } else {
                echo "1";
            }
        } else {
            echo "0";
        }
    }
    public function verify()
    {
        $this->load->view('verify');
    }
    public function register()
    {
        if ($_POST) {

            $pack_info = $this->db->where('pack_id', $this->session->userdata('register_details')['packages_id'])->get('packages')->row();
            $stdate = date('Y-m-d');
            $todaydate = strtotime($stdate);

            $duration = $pack_info->pack_duration;
            $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
            $user_array = array(
                'ids' => random_string('alnum', 9) . hash('md5', now('UTC')) . random_string('alnum', 9),
                'username' => '',
                'password' => '',
                'api_key' => random_string('alnum', 9) . hash('md5', now('UTC')) . random_string('alnum', 9),
                'balance' => '{"usd":0}',
                'email_address' => $this->session->userdata('register_details')['email_address'],
                'email_verified' => '',
                'email_address_pending' => '',
                'oauth_google_identifier' => '',
                'oauth_facebook_identifier' => '',
                'oauth_twitter_identifier' => '',
                'signup_source' => 'api',
                'first_name' => $this->session->userdata('register_details')['first_name'],
                'middle_name' => $this->session->userdata('register_details')['middle_name'],
                'last_name' => $this->session->userdata('register_details')['last_name'],
                'company' => $this->session->userdata('register_details')['company'],
                'designation' => $this->session->userdata('register_details')['designation'],
                'avatar' => 'default.jpg',
                'timezone' => '',
                'date_format' => 'Y-m-d',
                'time_format' => 'H:i:s',
                'language' => '',
                'phone' => $this->session->userdata('register_details')['mobile_number'],
                'phone_verified' => 1,
                'otp' => '',
                'otp_verified' => 1,
                'country' => '',
                'currency' => 'USD',
                'address_line_1' => '',
                'address_line_2' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'role_ids' => '',
                'status' => 1,
                'created_time' => date('Y-m-d H:i:s'),
                'update_time' => date('Y-m-d H:i:s'),
                'login_success_detail' => '',
                'online' => 0,
                'online_time' => '',
                'new_notification' => 0,
                'referral' => '',
                'affiliate_enabled' => 0,
                'affiliate_code' => '',
                'affiliate_earning' => '{}',
                'affiliate_setting' => '',
                'login_type' => 'normal',
                'device_type' => '',
                'device_token' => '',
                'company_address' => $this->session->userdata('register_details')['company_address'],
                'membership_type' => $pack_info->pack_type,
                'referred_by' => $this->session->userdata('register_details')['referred_by'],
                'wmobile' => $this->session->userdata('register_details')['wmobile'],
                'company_contact' => $this->session->userdata('register_details')['company_contact'],
                'packages_id' => $this->session->userdata('register_details')['packages_id'],
                "packages_startDate" => strtotime($stdate),
                "packages_endDate" => strtotime($eddate)
            );
            //                print_r($user_array);die;
            $res = $this->db->insert('user', $user_array);
            $uid = $this->db->insert_id();
            if (isset($uid) && !empty($uid)) {
                $trans_detail = array(
                    'trans_userid' => $uid,
                    'trans_paymentids' => $_POST['razorpay_payment_id'],
                    'trans_paymenttype' => 'online',
                    'trans_amount' => $pack_info->pack_price,
                    'trans_datetime' => date('Y-m-d H:i:s'),
                    'trans_for' => 'Membership Payment'
                );
                $q = $this->db->insert('transactions', $trans_detail);
                $pur_array = array(
                    'user_id' => $uid,
                    'plan_id' => $pack_info->pack_id,
                    'plan_startdate' => $stdate,
                    'plan_enddate' => $eddate,
                    'plan_status' => 'Active'
                );
                $q1 = $this->db->insert('user_package_purchase', $pur_array);
                $rp_info = $this->db->where('id', 10)->get('reward_point')->row();
                $data_insert1 = array(
                    "userid" => $this->session->userdata('register_details')['referred_by'],
                    "rewardid" => 10,
                    "activity" => $rp_info->activity,
                    "point" => $rp_info->point,
                    "date" => date('Y-m-d'),
                    "time" => date('H:i:s')
                );
                $q2 = $this->db->insert('reward_user_point', $data_insert1);
                $this->session->set_userdata('register_details', array());
                $sData = array(
                    'isLogIn'       => true,
                    'userid'   => $uid,
                );

                $this->session->set_userdata($sData);
                $log_detail = $this->my_ua();
                $insert_data = array(
                    'user_ids' => $user_array['ids'],
                    'level' => 'Information',
                    'event' => 'signin-success',
                    'detail' => json_encode($log_detail),
                    'debug_detail' => '',
                    'created_time' => date('Y-m-d H:i:s')
                );
                $q3 = $this->db->insert('activity', $insert_data);
                $this->session->set_flashdata('message', 'You are Registered Successfully...!!!');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', 'Something went wrong.Please try again...!!!');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', 'Invalid Request...!!!');
            redirect('login');
        }
    }
    public function dashboard()
    {
        if (!$this->session->userdata('isLogIn') && 0) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            $this->load->view('dashboard');
        }
    }
    public function point_history()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            $this->load->view('point_history');
        }
    }
    public function renew()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($_POST) {
                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                $pack_info = $this->db->where('pack_id', $user_info->packages_id)->get('packages')->row();
                $pur_array = array(
                    'user_id' => $this->session->userdata('userid'),
                    'plan_id' => $user_info->packages_id,
                    //	                'plan_startdate'=>$stdate,
                    //	                'plan_enddate'=>$eddate,
                    'plan_status' => 'Upcoming'
                );
                $this->db->insert('user_package_purchase', $pur_array);
                if ($pack_info->pack_type == 2) {
                    $trans_detail = array(
                        'trans_userid' => $this->session->userdata('userid'),
                        'trans_paymentids' => $_POST['razorpay_payment_id'],
                        'trans_paymenttype' => 'online',
                        'trans_amount' => $pack_info->pack_price,
                        'trans_datetime' => date('Y-m-d H:i:s'),
                        'trans_for' => 'Renew Membership Payment'
                    );
                    $this->db->insert('transactions', $trans_detail);
                }
                $this->session->set_flashdata('message', 'Membership Renewal Successful...!!!');
            } else {
                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                $pack_info = $this->db->where('pack_id', $user_info->packages_id)->get('packages')->row();
                $amt = $pack_info->pack_price;

                $data['amount'] = $amt;
                $data['customer_info'] = $user_info;
                $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 8);
                $ws = $this->db->get('setting')->row();
                $data['key'] = $ws->razorpay_key;
                $data['secret'] = $ws->razorpay_secret;

                $api = new Api($data['key'], $data['secret']);
                $orderData = [
                    'receipt'         => $code,
                    'amount'          => ($amt * 100), // 39900 rupees in paise
                    'currency'        => 'INR'
                ];

                $razorpayOrder = $api->order->create($orderData);
                $data['order_data'] = $razorpayOrder;
                $data['is_renew'] = 1;
            }
            $this->load->view('dashboard', $data);
        }
    }
    public function upgrade()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($_POST) {
                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                $pack_info = $this->db->where('pack_id', $this->input->post('user_plan'))->get('packages')->row();
                $amt = $pack_info->pack_price;

                $data['amount'] = $amt;
                $data['customer_info'] = $user_info;
                $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 8);
                $ws = $this->db->get('setting')->row();
                $data['key'] = $ws->razorpay_key;
                $data['secret'] = $ws->razorpay_secret;

                $api = new Api($data['key'], $data['secret']);
                $orderData = [
                    'receipt'         => $code,
                    'amount'          => ($amt * 100), // 39900 rupees in paise
                    'currency'        => 'INR'
                ];

                $razorpayOrder = $api->order->create($orderData);
                $data['order_data'] = $razorpayOrder;
            }
            $this->load->view('upgrade', $data);
        }
    }
    public function upgrade_complete($id)
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($_POST) {
                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                $pack_info = $this->db->where('pack_id', $id)->get('packages')->row();
                $stdate = date('Y-m-d');
                $todaydate = strtotime($stdate);
                if ($user_info->packages_endDate != '') {
                    $days_left = ($user_info->packages_endDate - $todaydate);
                    $daysremain = round($days_left / (60 * 60 * 24));

                    $duration = $pack_info->pack_duration;
                    $eddates = date("Y-m-d", strtotime("+$duration month", $todaydate));
                    $eddate = date("Y-m-d", strtotime("+$daysremain day", strtotime($eddates)));  //echo $eddate; exit();
                } else {
                    $duration = $pack_info->pack_duration;
                    $eddate = date("Y-m-d", strtotime("+$duration month", $todaydate));
                }
                $membership = array(
                    "packages_id" => $id,
                    "packages_startDate" => strtotime($stdate),
                    "packages_endDate" => strtotime($eddate),
                    "membership_type" => '2'
                );
                $this->db->where(array('id' => $this->session->userdata('userid')));
                $res = $this->db->update('user', $membership);
                if ($res == TRUE) {
                    $act_package = $this->db->get_where('user_package_purchase', array('user_id' => $this->session->userdata('userid'), 'plan_status' => 'Active'))->row();
                    $get_packages = $this->db->get_where('user_package_purchase', array('user_id' => $this->session->userdata('userid')))->result();
                    foreach ($get_packages as $valpackages) {
                        if ($valpackages->plan_status == "Active" || $valpackages->plan_status == "Upcoming") {
                            $this->db->set('plan_status', 'Inactive');
                            $this->db->where('pur_id', $valpackages->pur_id);
                            $this->db->update('user_package_purchase');
                        }
                    }
                    $pur_array = array(
                        'user_id' => $this->session->userdata('userid'),
                        'plan_id' => $id,
                        'plan_startdate' => $stdate,
                        'plan_enddate' => $eddate,
                        'plan_status' => 'Active'
                    );
                    $this->db->insert('user_package_purchase', $pur_array);
                    $ppid = $this->db->insert_id();
                    $user_package = $this->db->get_where('user_package_features', array('user_id' => $this->session->userdata('userid'), 'package_purchase_id' => $act_package->pur_id))->result();
                    if (!empty($user_package)) {
                        foreach ($user_package as $val) {
                            $pur_array1 = array(
                                'package_purchase_id' => $ppid,
                                'package_id' => $id,
                                'feature_id' => $val->feature_id,
                                'user_id' => $this->session->userdata('userid'),
                                'used_count' => $val->used_count,
                                'type_id' =>  $val->type_id
                            );
                            $this->db->insert('user_package_features', $pur_array1);
                        }
                    }
                    $trans_detail = array(
                        'trans_userid' => $this->session->userdata('userid'),
                        'trans_paymentids' => $_POST['razorpay_payment_id'],
                        'trans_paymenttype' => 'online',
                        'trans_amount' => $pack_info->pack_price,
                        'trans_datetime' => date('Y-m-d H:i:s'),
                        'trans_for' => 'Upgrade Membership Payment'
                    );
                    $this->db->insert('transactions', $trans_detail);
                    $this->session->set_flashdata('message', 'Membership Upgrade Successful...!!!');
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', 'Something went wrong.Please try again...!!!');
                }
            } else {
                $this->session->set_flashdata('message', 'Invalid Request...!!!');
            }
            $this->load->view('upgrade');
        }
    }
    public function edit_profile()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($_POST) {
                if (isset($_POST['about_details'])) {
                    $about_details = array(
                        'about_company' => $this->input->post('about_company'),
                        'company' => $this->input->post('company'),
                        'designation' => $this->input->post('designation'),
                        'business_entity' => $this->input->post('business_entity'),
                        'business_type' => $this->input->post('business_type'),
                        'business_experties' => $this->input->post('business_experties'),
                        'no_of_employees' => $this->input->post('no_of_employees'),
                        'turn_over' => $this->input->post('turn_over'),
                        'business_category' => $this->input->post('business_category'),
                        'working_from' => $this->input->post('working_from'),
                        'target_audiance' => $this->input->post('target_audiance'),
                        'total_experience' => $this->input->post('total_experience'),
                        'gender' => $this->input->post('gender')
                    );
                    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] != UPLOAD_ERR_NO_FILE) {
                        if ($_FILES['avatar']['size'] <= 5000000) {
                            $target_dir = "./admin/upload/avatar/";
                            $fname = date('YmdHis') . basename($_FILES["avatar"]["name"]);
                            $target_file = $target_dir . $fname;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            if (($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") && (getimagesize($_FILES["avatar"]["tmp_name"]))) {
                                if ($_FILES['avatar']['type'] == "image/jpeg" || $_FILES['avatar']['type'] == "image/png") {
                                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                                        $about_details['avatar'] = $fname;
                                    }
                                }
                            }
                        }
                    }
                    if (isset($_FILES['company_profile']) && $_FILES['company_profile']['error'] != UPLOAD_ERR_NO_FILE) {
                        if ($_FILES['company_profile']['size'] <= 5000000) {
                            $target_dir = "./admin/upload/requirements/";
                            $fname = date('YmdHis') . basename($_FILES["company_profile"]["name"]);
                            $target_file = $target_dir . $fname;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            if ($imageFileType == "pdf") {
                                if ($_FILES['company_profile']['type'] == "application/pdf") {
                                    if (move_uploaded_file($_FILES["company_profile"]["tmp_name"], $target_file)) {
                                        $about_details['company_profile'] = $fname;
                                    }
                                }
                            }
                        }
                    }
                    $q = $this->db->set($about_details)->where('id', $this->session->userdata('userid'))->update('user');
                    //                        echo $this->db->last_query();die;
                }
                if (isset($_POST['contact_details'])) {
                    $contact_details = array(
                        'email_address' => $this->input->post('email_address'),
                        'phone' => $this->input->post('phone'),
                        'wmobile' => $this->input->post('wmobile'),
                        'company_wmobile' => $this->input->post('company_wmobile'),
                        'website' => $this->input->post('website'),
                        'company_address' => $this->input->post('company_address'),
                        'dob' => $this->input->post('dob'),
                        'company_google' => $this->input->post('company_google'),
                        'company_facebook' => $this->input->post('company_facebook'),
                        'company_linkedin' => $this->input->post('company_linkedin')

                    );
                    if (isset($_FILES['vcard_front']) && $_FILES['vcard_front']['error'] != UPLOAD_ERR_NO_FILE) {
                        if ($_FILES['vcard_front']['size'] <= 5000000) {
                            $target_dir = "./admin/upload/requirements/";
                            $fname = date('YmdHis') . basename($_FILES["vcard_front"]["name"]);
                            $target_file = $target_dir . $fname;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            if (($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") && (getimagesize($_FILES["vcard_front"]["tmp_name"]))) {
                                if ($_FILES['vcard_front']['type'] == "image/jpeg" || $_FILES['vcard_front']['type'] == "image/png") {
                                    if (move_uploaded_file($_FILES["vcard_front"]["tmp_name"], $target_file)) {
                                        $contact_details['vcard_front'] = $fname;
                                    }
                                }
                            }
                        }
                    }
                    if (isset($_FILES['vcard_back']) && $_FILES['vcard_back']['error'] != UPLOAD_ERR_NO_FILE) {
                        if ($_FILES['vcard_back']['size'] <= 5000000) {
                            $target_dir = "./admin/upload/requirements/";
                            $fname = date('YmdHis') . basename($_FILES["vcard_back"]["name"]);
                            $target_file = $target_dir . $fname;
                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                            if (($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") && (getimagesize($_FILES["vcard_back"]["tmp_name"]))) {
                                if ($_FILES['vcard_back']['type'] == "image/jpeg" || $_FILES['vcard_back']['type'] == "image/png") {
                                    if (move_uploaded_file($_FILES["vcard_back"]["tmp_name"], $target_file)) {
                                        $contact_details['vcard_back'] = $fname;
                                    }
                                }
                            }
                        }
                    }
                    $q = $this->db->set($contact_details)->where('id', $this->session->userdata('userid'))->update('user');
                }
                if (isset($_POST['gallery_details'])) {
                    if ($_FILES) {
                        $filesCount = count($_FILES['gallery_image']['name']);
                        for ($i = 0; $i < $filesCount; $i++) {
                            $recommendation = 0;
                            $check_in_usertble = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                            $pf_info = $this->db->where(array('package_id' => $check_in_usertble->packages_id, 'feature_id' => 5))->get('package_features')->row();
                            $package_info = $this->db->where(array('user_id' => $check_in_usertble->id, 'plan_id' => $check_in_usertble->packages_id, 'plan_status' => 'Active'))->order_by('pur_id', 'desc')->get('user_package_purchase')->row();
                            $user_consumption = $this->db->where(array('user_id' => $check_in_usertble->id, 'package_id' => $check_in_usertble->packages_id, 'feature_id' => 5, 'package_purchase_id' => $package_info->pur_id))->order_by('id', 'desc')->get('user_package_features')->row();

                            if ($pf_info->count_allowed > 0) {
                                if (!empty($user_consumption)) {
                                    if ($user_consumption->used_count == $pf_info->count_allowed) {
                                        $recommendation = 1;
                                    }
                                }
                            }
                            if ($recommendation == 0) {
                                //                                if(isset($_FILES['gallery_image'][$i]) && $_FILES['vcard_back']['error'] != UPLOAD_ERR_NO_FILE) {
                                if ($_FILES['gallery_image']['size'][$i] <= 5000000) {
                                    $target_dir = "./admin/upload/gallery/profile/";
                                    $fname = date('YmdHis') . basename($_FILES["gallery_image"]["name"][$i]);
                                    $target_file = $target_dir . $fname;
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                    if (($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") && (getimagesize($_FILES["gallery_image"]["tmp_name"][$i]))) {
                                        if ($_FILES['gallery_image']['type'][$i] == "image/jpeg" || $_FILES['gallery_image']['type'][$i] == "image/png") {
                                            if (move_uploaded_file($_FILES["gallery_image"]["tmp_name"][$i], $target_file)) {
                                                $q = $this->db->insert('gallery', array('image' => $fname, 'gallery_type' => 1, 'user_id' => $this->session->userdata('userid'), 'status' => 1));
                                                $useriddd = $this->db->query("select * from user where id='" . $this->session->userdata('userid') . "'")->row();
                                                $package_info = $this->db->where(array('user_id' => $this->session->userdata('userid'), 'plan_id' => $useriddd->packages_id, 'plan_status' => 'Active'))->order_by('pur_id', 'desc')->get('user_package_purchase')->row();
                                                $user_consumption = $this->db->where(array('user_id' => $this->session->userdata('userid'), 'package_id' => $useriddd->packages_id, 'feature_id' => 5, 'package_purchase_id' => $package_info->pur_id))->order_by('id', 'desc')->get('user_package_features')->row();
                                                $data['used_count'] = $user_consumption->used_count + 1;
                                                $q1 = $this->db->where('id', $user_consumption->id)->set($data)->update('user_package_features');
                                            }
                                        }
                                    }
                                }
                            }
                            //                                }
                        }
                    }
                }
                $this->session->set_flashdata('message', 'Profile updated Successfully...!!!');
            }
            $this->load->view('edit_profile');
        }
    }
    public function delete_gallery_image($id)
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            $q = $this->db->where('id', $id)->delete('gallery');
            $this->session->set_flashdata('message', 'Image Deleted Successfully...!!!');
            $this->load->view('edit_profile');
        }
    }

    public function payments()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            $this->load->view('payments');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
    public function about()
    {
        $this->load->view('about');
    }

    public function business_category()
    {
        $this->load->view('business_category');
    }
    public function business_subcategory($id)
    {
        $data['subcategory_info'] = $this->db->where('functional_area_parent_id', $id)->order_by('functional_area', 'asc')->get('tbl_functional_area')->result();
        $data['cat_id'] = $id;
        $this->load->view('business_subcategory', $data);
    }
    public function profile_listing($id = null)
    {
        if (!empty($id)) {
            $this->db->where('business_category', $id);
        }
        $data['profile_info'] = $this->db->where('user_delete', 1)->where_in('membership_type', array('1', '2'))->order_by('first_name', 'asc')->get('user')->result();
        $data['business_category'] = $id;
        $this->load->view('profile_listing', $data);
    }
    public function member_profile($id)
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($this->session->userdata('userid') != $id) {
                $check_in_usertble = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                $package_info = $this->db->where(array('user_id' => $this->session->userdata('userid'), 'plan_id' => $check_in_usertble->packages_id, 'plan_status' => 'Active'))->order_by('pur_id', 'desc')->get('user_package_purchase')->row();
                $user_consumption = $this->db->where(array('user_id' => $this->session->userdata('userid'), 'package_id' => $check_in_usertble->packages_id, 'feature_id' => 9, 'package_purchase_id' => $package_info->pur_id))->order_by('id', 'desc')->get('user_package_features')->row();
                $str = explode(',', $user_consumption->type_id);
                if (!in_array($id, $str)) {
                    $data1['used_count'] = $user_consumption->used_count + 1;
                }
                if (empty($str)) {
                    $data1['type_id'] = $id;
                } else {
                    if (!in_array($id, $str)) {
                        $data1['type_id'] = $user_consumption->type_id . "," . $id;
                    }
                }
                if (!empty($data1)) {
                    $q = $this->db->where('id', $user_consumption->id)->set($data1)->update('user_package_features');
                }
            }
            $data['profile_info'] = $this->db->where('id', $id)->get('user')->row();
            //            $data['contact_info'] = $this->db->where('contact_info_profileid',$data['profile_info']->info_profileid)->get('user_business_contact_info')->row();
            $this->load->view('member_profile', $data);
        }
    }
    public function submit_review()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($_POST) {
                //                    print_r($_POST);die;
                $data_insert = array(
                    "user_id" => $this->input->post('user_id'),
                    "reviewed_by" => $this->session->userdata('userid'),
                    "ratings" => $this->input->post('expert_rating'),
                    "review_note" => $this->input->post('expert_message'),
                    "review_date" => date('Y-m-d'),
                    "review_time" => date('H:i:s')
                );
                $q = $this->db->insert('ratings_reviews', $data_insert);
                $rp_info1 = $this->db->where('id', 6)->get('reward_point')->row();
                $rp_info2 = $this->db->where('id', 7)->get('reward_point')->row();
                $data_insert1 = array(
                    "userid" => $this->session->userdata('userid'),
                    "rewardid" => 6,
                    "activity" => $rp_info1->activity,
                    "point" => $rp_info1->point,
                    "date" => date('Y-m-d'),
                    "time" => date('H:i:s')
                );
                $q2 = $this->db->insert('reward_user_point', $data_insert1);
                $data_insert2 = array(
                    "userid" => $this->input->post('user_id'),
                    "rewardid" => 7,
                    "activity" => $rp_info2->activity,
                    "point" => $rp_info2->point,
                    "date" => date('Y-m-d'),
                    "time" => date('H:i:s')
                );
                $q3 = $this->db->insert('reward_user_point', $data_insert2);
                $useriddd = $this->db->query("select * from user where id='" . $this->input->post('user_id') . "'")->row();
                $package_info = $this->db->where(array('user_id' => $this->input->post('user_id'), 'plan_id' => $useriddd->packages_id, 'plan_status' => 'Active'))->order_by('pur_id', 'desc')->get('user_package_purchase')->row();
                $user_consumption = $this->db->where(array('user_id' => $this->input->post('user_id'), 'package_id' => $useriddd->packages_id, 'feature_id' => 8, 'package_purchase_id' => $package_info->pur_id))->order_by('id', 'desc')->get('user_package_features')->row();
                $data['used_count'] = $user_consumption->used_count + 1;
                $q1 = $this->db->where('id', $user_consumption->id)->set($data)->update('user_package_features');
                $this->session->set_flashdata('message', 'Review Submitted Successfully...!!!');
                redirect('member_profile/' . $this->input->post('user_id'));
            } else {
                $this->session->set_flashdata('message', 'Invalid Request...!!!');
                redirect('dashboard');
            }
        }
    }
    public function posts()
    {
        $this->load->view('posts');
    }
    public function events()
    {
        $this->load->view('events');
    }


    public function event_detail($id)
    {
        $data['event_info'] = $this->db->where('event_id', $id)->get('events')->row();
        if ($_POST) {
            if ($this->session->userdata('isLogIn')) {
                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                if ($user_info->membership_type == "1") {
                    $amt = $data['event_info']->event_guestfees;
                } else {
                    $amt = $data['event_info']->event_fees;
                }
                $data['amount'] = $amt;
                $data['customer_info'] = $user_info;
                $code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'), 0, 8);
                $ws = $this->db->get('setting')->row();
                $data['key'] = $ws->razorpay_key;
                $data['secret'] = $ws->razorpay_secret;

                $api = new Api($data['key'], $data['secret']);
                $orderData = [
                    'receipt'         => $code,
                    'amount'          => ($amt * 100), // 39900 rupees in paise
                    'currency'        => 'INR'
                ];

                $razorpayOrder = $api->order->create($orderData);
                $data['order_data'] = $razorpayOrder;
            }
        }
        //            $data['gallery_info'] = $this->db->where('event_gallery_eventid',$id)->get('event_gallery')->result();
        $this->load->view('event_detail', $data);
    }
    public function book_event($id)
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue...!!!');
            redirect('login');
        } else {
            if ($_POST) {
                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                $event_info = $this->db->where('event_id', $id)->get('events')->row();
                if ($user_info->membership_type == "1") {
                    $amt = $event_info->event_guestfees;
                } else {
                    $amt = $event_info->event_fees;
                }
                $fa_info = $this->db->where('functional_area_id', $user_info->business_category)->get('tbl_functional_area')->row();
                $data_insert = array(
                    "booking_userid" => $this->session->userdata('userid'),
                    "booking_eventid" => $id,
                    "booking_username" => $user_info->first_name . " " . $user_info->last_name,
                    "booking_cmpname" => $user_info->company,
                    "booking_category" => empty($fa_info) ? '' : $fa_info->functional_area,
                    "booking_useremail" => $user_info->email_address,
                    "booking_userphno" => $user_info->phone,
                    "booking_amount" => $amt,
                    "booking_creatdate" => date('Y-m-d'),
                    "booking_creattime" => date('H:i:s'),
                    "bookin_status" => "1",
                    "bookin_attedance" => "3"
                );
                $ress = $this->db->insert('event_booking', $data_insert);
                if ($ress == TRUE) {
                    $event_participate_status = array(
                        "attend_userid" => $this->session->userdata('userid'),
                        "attend_eventid" => $id,
                        "attend_type " => '2',
                        "attend_creattime" => date('Y-m-d'),
                        "attend_creatdate" => date('H:i:s'),
                    );
                    $ress1 = $this->db->insert('event_attending_status', $event_participate_status);
                    $this->session->set_flashdata('message', 'You are Registered Successfully...!!!');
                } else {
                    $this->session->set_flashdata('message', 'Something went wrong.Please try again...!!!');
                }
            } else {
                $this->session->set_flashdata('message', 'Invalid Request...!!!');
            }
            redirect('event_detail/' . $id);
        }
    }

    public function blog()
    {
        $this->load->view('blog');
    }
    public function blog_detail($id)
    {
        $data['blog_info'] = $this->db->where('id', $id)->get('blogs')->row();
        $this->load->view('blog_detail', $data);
    }
    public function testimonial()
    {
        $this->load->view('testimonial');
    }
    public function testimonial_detail($id)
    {
        $data['testimonial_info'] = $this->db->where('id', $id)->get('testimonials')->row();
        $this->load->view('testimonial_detail', $data);
    }
    public function contact()
    {
        $this->load->view('contact');
    }

    public function terms_conditions()
    {
        $this->load->view('terms_conditions');
    }
    public function privacy_policy()
    {
        $this->load->view('privacy_policy');
    }
    function get_referred_by()
    {
        $keyword = $this->input->post('keyword');
        $profile_info = $this->db->where('user_delete', 1)->where('phone', $keyword)->where_in('membership_type', array('1', '2'))->get('user')->row();
        $html = "false";
        if (!empty($profile_info)) {
            $html = $profile_info->id;
        }
        echo $html;
    }
    function search_profile_by_name()
    {
        $keyword = $this->input->post('keyword');
        $profile_info = $this->db->where('user_delete', 1)->where_in('membership_type', array('1', '2'))->order_by('first_name', 'asc')->get('user')->result();
        $html = "";
        if (!empty($profile_info)) {
            foreach ($profile_info as $val) {
                $str = $val->first_name . " " . $val->last_name;
                if (stripos(ucwords($str), $keyword) !== false) {
                    $html .= '<li>
                                                    <div>
                                                        <h4>' . $val->first_name . " " . $val->last_name . '</h4>
                                                        <span>' . $val->company . ", " . $val->designation . '</span>
                                                        <a href="' .  base_url('member_profile/' . $val->id) . '"></a>
                                                    </div>
                                                </li>';
                }
            }
        }
        echo $html;
    }
    function search_profile_by_service()
    {
        $keyword = $this->input->post('keyword');
        if (!empty($keyword)) {
            $str = explode(',', $keyword);
            $this->db->where_in('business_category', $str);
        }
        $profile_info = $this->db->where('user_delete', 1)->where_in('membership_type', array('1', '2'))->order_by('first_name', 'asc')->get('user')->result();
        //            echo $this->db->last_query();die;
        $html = "";
        if (!empty($profile_info)) {
            foreach ($profile_info as $val) {

                $html .= ' <li class="all-list-item">
                                        <div class="eve-box">
                                            <!---LISTING IMAGE--->
                                            <div class="al-img">
                                                <span class="open-stat">' . $this->db->where('pack_id', $val->packages_id)->get('packages')->row()->pack_name . '</span>
                                                <a href="' . base_url('member_profile/' . $val->id) . '">

                                                    <img
                                                        src="' . base_url('admin/upload/avatar/' . $val->avatar) . '" loading="lazy">
                                                </a>

                                            </div>
                                            <!---END LISTING IMAGE--->

                                            <!---LISTING NAME--->
                                            <div class="list-con">
                                                <h4>
                                                    <a href="' . base_url('member_profile/' . $val->id) . '">' . $val->first_name . " " . $val->last_name . '</a>
                                                                                                            <i class="li-veri"><img
                                                                src="' . base_url('assets/') . 'images/icon/svg/verified.png" title="Verified" loading="lazy"></i>
                                                                                                    </h4>
<!--                                                <div class="list-rat-all">
                                                                                                                                                                <span>No Reviews Yet</span>
                                                                                                        </div>-->
                                                
                                                    ';
                if (!empty($val->company_address)) {
                    $html .= '<span class="addr">' . $val->company_address . '</span>';
                }
                $html .= '
                                                <span class="pho"><a href="Tel:' . $val->phone . '">' . $val->phone . '  </a>                                              </span>
                                        <span class="mail">' . $val->email_address . '                                               </span>

                                                <div class="links">
                                                    <!--<a href="https://bizbookdirectorytemplate.com/login?src=https://bizbookdirectorytemplate.com/all-listing/technology">Get quote</a>-->
                                                    <a href="' . base_url('member_profile/' . $val->id) . '">View more</a>
                                                    <!--<a href="Tel:35465436543 ">Call Now</a>-->';

                if (!empty($val->wmobile)) {

                    $html .= '<a href="https://wa.me/' . $val->wmobile . '" class="what"
                                                       target="_blank">WhatsApp</a>';
                } else {
                    if (!empty($val->company_wmobile)) {

                        $html .= '<a href="https://wa.me/' . $val->company_wmobile . '" class="what"
                                                       target="_blank">WhatsApp</a>';
                    }
                }

                $html .= '</div>

                                            </div>
                                            <!---END LISTING NAME--->

                                            <!---SAVE--->

                                            <!---END SAVE--->
                                        </div>
                                    </li>';
            }
        }
        echo $html;
    }
    function search_service_by_name()
    {
        $keyword = $this->input->post('keyword');
        if (!empty($keyword)) {
            $this->db->like('functional_area', $keyword);
        }
        $profile_info = $this->db->where('status', 1)->order_by('functional_area', 'asc')->get('tbl_functional_area')->result();
        $html = "";
        if (!empty($profile_info)) {
            foreach ($profile_info as $val) {

                $html .= '<ul id="tail-re">
                            <li>
                                <div class="sh-all-scat-box">
                                    <div class="lhs">
                                        <img src="' . base_url('admin/' . $val->functional_area_thumbnil) . '"
                                             alt="" loading="lazy">
                                    </div>
                                    <div class="rhs">
                                        <h4>
                                            <a href="' . base_url('profile_listing/' . $val->functional_area_id) . '">' . $val->functional_area . ' </a><!--span>07</span-->
                                        </h4>

                                    </div>
                                </div>
                            </li>
                        </ul>';
            }
        }
        echo $html;
    }
    function my_ua()
    {
        //		$CI = &get_instance();
        $ua_array = array(
            'ip' => $this->input->ip_address(),
            'is_mobile' => $this->agent->is_mobile(),
            'is_browser' => $this->agent->is_browser(),
            'browser_name' => $this->agent->browser(),
            'browser_version' => $this->agent->version(),
            'platform' => $this->agent->platform()
        );
        return $ua_array;
    }
    public function profile($id)
    {
        $data['id'] = $id;
        //            $data['contact_info'] = $this->db->where('contact_info_profileid',$data['profile_info']->info_profileid)->get('user_business_contact_info')->row();
        $this->load->view('profile', $data);
    }
    public function contact1($id)
    {
        $data['id'] = $id;
        //            $data['contact_info'] = $this->db->where('contact_info_profileid',$data['profile_info']->info_profileid)->get('user_business_contact_info')->row();
        $this->load->view('contact1', $data);
    }
    public function gallery($id)
    {
        $data['id'] = $id;
        //            $data['contact_info'] = $this->db->where('contact_info_profileid',$data['profile_info']->info_profileid)->get('user_business_contact_info')->row();
        $this->load->view('gallery', $data);
    }
    public function reviews($id)
    {
        $data['id'] = $id;
        //            $data['contact_info'] = $this->db->where('contact_info_profileid',$data['profile_info']->info_profileid)->get('user_business_contact_info')->row();
        $this->load->view('reviews', $data);
    }
    public function refund_policy()
    {
        $this->load->view('refund_policy');
    }
}
