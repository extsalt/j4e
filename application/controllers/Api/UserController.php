<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function index()
    {
        $query = $_GET['query'];
        $sql = "SELECT * FROM user";
        if ($query) {
            $sql .= " where first_name LIKE '%$query%' OR last_name LIKE '%$query%' ";
        }
        $sql .= " LIMIT 20";
        $results = $this->db->query($sql)->result();
        //var_dump($results);
        //die;
        foreach ($results as &$result) {
            if ($result->membership_type == '2') {
                $result->membership_type = 'Registered';
            } else {
                $result->membership_type = 'Visitor Member';
            }
        }
        echo @json_encode($results);
    }

    public function getMemberById()
    {
        $memberID = $_GET["id"];
        if (empty($memberID)) {
            echo @json_encode([]);
            die;
        }
        $sql = "SELECT * FROM user WHERE id = '$memberID' LIMIT 1";
        $results = $this->db->query($sql)->row();
        echo @json_encode($results);
    }
}
