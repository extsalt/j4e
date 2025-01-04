<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ServiceController extends CI_Controller
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
        echo @json_encode($results);
    }
}
