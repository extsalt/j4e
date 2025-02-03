<?php



defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
 * @property ApiTokenModel $ApiTokenModel
 * @property CI_Input $input
 */
class HomeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function index()
    {
        $this->load->model('UserModel');
        $postData = $this->input->post();
        if (empty($postData['email']) || empty($postData['password'])) {
            http_response_code(400);
            echo json_encode(array('status' => 'error','message' => 'Email and password are required'));
            return;
        }
        $email = filter_var($postData['email'], FILTER_SANITIZE_EMAIL);
        $user = $this->UserModel->getUserByEmail($email);
        if ($user && password_verify($postData['password'], $user->password)) {
            http_response_code(200);
            $token = bin2hex(random_bytes(16));
            $tokenInsertData['token'] = $token;
            $tokenInsertData['user_id'] = $user->id;
            $this->load->model('ApiTokenModel');
            $tokenInsertID = $this->ApiTokenModel->insertToken($tokenInsertData);
            echo json_encode(array('status' => 'success', 'message' => 'Login successful', 'token' => $token, 'name' => $user->first_name));
            return;
        }
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid email or password'));
    }
}
