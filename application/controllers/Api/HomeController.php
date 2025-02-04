<?php



defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
 * @property EventModel $EventModel
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
        $this->load->model('EventModel');
        $events = $this->EventModel->get_events_home();
        $users = $this->UserModel->get_user_home();
        echo json_encode(array('status' => 'sucess', 'events' => $events, 'users' => $users));
    }
}
