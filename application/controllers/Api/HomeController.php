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
        $members = $this->db->query("SELECT id, first_name, last_name, company FROM user ORDER BY created_time DESC LIMIT 5")->result_array();
        foreach ($members as &$member) {
            $member['id'] = $member['id'];
            $member['first_name'] = ucfirst($member['first_name']) ?? '';
            $member['last_name'] = ucfirst($member['last_name']) ?? '';
            $member['company'] = ucfirst($member['company']) ?? '';
        }
        $this->load->model('EventModel');
        $events = $this->EventModel->get_events_home();
        echo json_encode(array('events' => $events, 'members' => $members));
    }
}
