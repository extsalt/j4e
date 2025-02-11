<?php



defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
 * @property ApiTokenModel $ApiTokenModel
 * @property CI_Input $input
 */
class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function login()
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
            if (!$user->avatar) {
                $user->avatar = "https%3A%2F%2Fj4e.s3.ap-south-1.amazonaws.com%2Fpublic%2Fdefault.png";
            }
            $data['firstName'] = $user->first_name ?? '';
            $data['lastName'] = $user->last_name ?? '';
            $data['avatar'] = $user->avatar ?? '';
            $data['token'] = $token ?? '';
            $data['phone'] = $user->phone ?? '';
            $data['email'] = $user->email_address ?? '';
            $data['company'] = $user->company ?? '';
            $data['designation'] = $user->designation ?? '';
            echo json_encode($data);
            return;
        }
        http_response_code(400);
        echo json_encode(array('status' => 'error', 'message' => 'Invalid email or password'));
    }
}
