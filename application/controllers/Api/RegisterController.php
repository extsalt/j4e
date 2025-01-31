<?php



defined('BASEPATH') or exit('No direct script access allowed');

class RegisterController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function register()
    {
        // Load the User_model
        $this->load->model('UserModel');
        // get the post data
        $postData = $this->input->post();
        // check if the user already exists
        $user = $this->UserModel->getUserByEmail($postData['email']);
        if ($user) {
            http_response_code(400);
            echo json_encode(array('status' => 'error', 'message' => 'User already exists'));
            return;
        }
        // insert user data
        $insert = $this->UserModel->insert_user($postData);
        if ($insert) {
            http_response_code(200);
            echo json_encode(array('status' => 'success', 'message' => 'User created successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 'error', 'message' => 'Failed to create user'));
        }
    }
}
