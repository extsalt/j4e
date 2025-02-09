<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
 * @property OTPPhone $OTPPhoneModel
 * @property ApiTokenModel $ApiTokenModel
 * @property CI_Input $input
 */
class RegisterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function register()
    {
        $mobile = '9517677829';
        $otp = random_int(1000, 9999);
        $url = "https://softsms.in/app/smsapi/index.php?key=671a271f67634&type=text&contacts=$mobile&senderid=JFENTP&peid=1201161225010387296&templateid=1207166624969359273&msg=One%20Time%20Password%20$otp%20to%20Login%20for%20J4E%20App.%20If%20you%20didn%27t%20initiate,%20report%20as%20FRAUD%20on%209850325204%20J4E%20Team";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        file_put_contents(__FILE__ . '.log', json_encode(compact('url', 'response')));
        curl_close($ch);
        $this->load->model('UserModel');
        $postData = $this->input->post();
        if (empty($postData['firstName']) || empty($postData['lastName']) || empty($postData['email']) || empty($postData['password']) || empty($postData['phone'])) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'First name, last name, email and password are required'));
            return;
        }
        //sanitize and validate email
        $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
        $user = $this->UserModel->getUserByEmail($email);
        if ($user) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'User already exists'));
            return;
        }
        $insertData['password'] = password_hash($postData['password'], PASSWORD_DEFAULT);
        $insertData['first_name'] = strip_tags(trim($postData['firstName']));
        $insertData['last_name'] = strip_tags(trim($postData['lastName']));
        $insertData['email_address'] = filter_var(strip_tags(trim($postData['email'])), FILTER_SANITIZE_EMAIL);
        $userInsertID = $this->UserModel->insert_user($insertData);
        if ($userInsertID) {
            http_response_code(200);
            $token = bin2hex(random_bytes(16));
            $firstName = $insertData['first_name'];
            $lastName = $insertData['last_name'];
            $tokenInsertData['token'] = $token;
            $tokenInsertData['user_id'] = $userInsertID;
            $this->load->model('ApiTokenModel');
            $tokenInsertID = $this->ApiTokenModel->insertToken($tokenInsertData);
            echo json_encode(array('status' => 'success', 'message' => 'User created successfully', 'token' => $token, 'firstName' => $firstName, 'lastName' => $lastName));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 'error', 'message' => 'Failed to create user'));
        }
    }

    public function sendOTP()
    {
        $this->load->model('OTPPhoneModel');
        $postData = $this->input->post();
        $mobile = trim($postData['phone']);
        if (empty($mobile)) {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid phone number'));
            return;
        }
        $this->OTPPhoneModel->delete($mobile);
        $otp = random_int(1000, 9999);
        $url = "https://softsms.in/app/smsapi/index.php?key=671a271f67634&type=text&contacts=$mobile&senderid=JFENTP&peid=1201161225010387296&templateid=1207166624969359273&msg=One%20Time%20Password%20$otp%20to%20Login%20for%20J4E%20App.%20If%20you%20didn%27t%20initiate,%20report%20as%20FRAUD%20on%209850325204%20J4E%20Team";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        file_put_contents(__FILE__ . '.log', json_encode(compact('url', 'response')));
        curl_close($ch);
        $this->OTPPhoneModel->insert(['otp' => $otp, 'phone' => $postData['phone']]);
        echo json_encode(array('status' => 'success', 'message' => 'OTP sent successfully'));
    }

    public function verifyOTP()
    {
        $this->load->model('OTPPhoneModel');
        $postData = $this->input->post();
        $mobile = trim($postData['phone']);
        $otp = trim($postData['otp']);
        if (empty($mobile) || empty($otp)) {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid phone number or otp'));
            return;
        }
        $otp = $this->OTPPhoneModel->get_by_phone_and_otp($mobile, $otp);
        if (is_array($otp) && count ($otp) > 0) {
            $this->OTPPhoneModel->delete_by_phone_and_otp($mobile, $otp);
            echo json_encode(array('status' => 'success', 'message' => 'OTP verified successfully'));
            return;
        }
        $this->OTPPhoneModel->delete_by_phone_and_otp($mobile, $otp);
        echo json_encode(array('status' => 'error', 'message' => 'Failed to verify OTP.'));
    }
}
