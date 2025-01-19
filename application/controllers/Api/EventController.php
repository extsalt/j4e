<?php

defined('BASEPATH') or exit('No direct script access allowed');

class EventController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    public function index()
    {
        $query = $_GET['query'];
        $page = $_GET['page'] ?: 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $sql = "SELECT `event_id`,`event_title`,`event_description`,`event_address`,`event_startdate`,`event_enddate`,`event_fees`,`event_guestfees`,`event_ticketqty`,`event_thumbnil` FROM events ";
        if ($query) {
            $sql .= " WHERE `event_title` LIKE '%$query%' OR `event_description` LIKE '%$query%' OR `event_address` LIKE '%$query%' ";
        }
        $sql .= " ORDER BY `event_date` DESC LIMIT $limit OFFSET $offset";
        // echo $sql;
        // die;
        // file_put_contents(__FILE__ . '.sql', $sql . PHP_EOL, FILE_APPEND);
        $results = $this->db->query($sql)->result_array();
        $response = [];
        foreach ($results as $result) {
            $member = [];
            $member['id'] = $result['event_id'];
            $member['title'] = ucfirst($result['event_title']) ?? '';
            $member['description'] =  $result['event_description'] ?? '';
            $member['address'] = $result['event_address'] ?? '';
            $member['startDate'] = $result['event_startdate'] ?? '';
            $member['endDate'] = $result['event_enddate'] ?? '';
            $member['coverPhoto'] = "https://just4entrepreneurs.com/admin/upload/events/$result[event_thumbnil]" ?? '';
            $member['eventFees'] = $result['event_fees'] ?? '';
            $member['guestFees'] = $result['event_guestfees'] ?? '';
            $member['totalTicket'] = $result['event_ticketqty'] ?? '';
            $response[] = $member;
        }
        echo @json_encode($response);
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
