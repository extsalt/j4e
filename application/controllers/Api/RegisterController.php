<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
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
        $this->load->model('UserModel');
        $postData = $this->input->post();
        if (empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['email']) || empty($postData['password'])) {
            http_response_code(400);
            echo json_encode(array('status' => 'error','message' => 'Name, email and password are required'));
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
        $insertData['first_name'] = strip_tags(trim($postData['first_name']));
        $insertData['last_name'] = strip_tags(trim($postData['last_name']));
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
            echo json_encode(array('status' => 'success', 'message' => 'User created successfully','token' => $token, 'firstName' => $firstName, 'lastName' => $lastName));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 'error', 'message' => 'Failed to create user'));
        }
    }
}
