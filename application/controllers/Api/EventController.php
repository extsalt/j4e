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
        $results = $this->db->query($sql)->result_array();
        $response = [];
        foreach ($results as $result) {
            $member = [];
            $member['id'] = $result['event_id'];
            $member['title'] = ucfirst($result['event_title']) ?? '';
            $member['description'] =  strip_tags($result['event_description']) ?? '';
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

    public function getEventById($eventID)
    {
        if (empty($eventID)) {
            echo @json_encode([]);
            die;
        }
        $sql = "SELECT `event_id`,`event_title`,`event_description`,`event_address`,`event_startdate`,`event_enddate`,`event_fees`,`event_guestfees`,`event_ticketqty`,`event_thumbnil` FROM events WHERE `event_id` = $eventID LIMIT 1";
        $result = $this->db->query($sql)->row_array();
        $event['id'] = $result['event_id'];
        $event['title'] = ucfirst($result['event_title']) ?? '';
        $event['description'] =  strip_tags($result['event_description']) ?? '';
        $event['address'] = $result['event_address'] ?? '';
        $event['startDate'] = $result['event_startdate'] ?? '';
        $event['endDate'] = $result['event_enddate'] ?? '';
        $event['coverPhoto'] = "https://just4entrepreneurs.com/admin/upload/events/$result[event_thumbnil]" ?? '';
        $event['eventFees'] = $result['event_fees'] ?? '';
        $event['guestFees'] = $result['event_guestfees'] ?? '';
        $event['totalTicket'] = $result['event_ticketqty'] ?? '';
        echo @json_encode($event);
    }

    public function getMembersOfEvent($eventID)
    {
        if (empty($eventID)) {
            echo @json_encode([]);
            die;
        }
        $sql = "SELECT `event_id`,`event_title`,`event_description`,`event_address`,`event_startdate`,`event_enddate`,`event_fees`,`event_guestfees`,`event_ticketqty`,`event_thumbnil` FROM events WHERE `event_id` = $eventID LIMIT 1";
        $result = $this->db->query($sql)->row_array();
        $event['id'] = $result['event_id'];
        $event['title'] = ucfirst($result['event_title']) ?? '';
        $event['description'] =  strip_tags($result['event_description']) ?? '';
        $event['address'] = $result['event_address'] ?? '';
        $event['startDate'] = $result['event_startdate'] ?? '';
        $event['endDate'] = $result['event_enddate'] ?? '';
        $event['coverPhoto'] = "https://just4entrepreneurs.com/admin/upload/events/$result[event_thumbnil]" ?? '';
        $event['eventFees'] = $result['event_fees'] ?? '';
        $event['guestFees'] = $result['event_guestfees'] ?? '';
        $event['totalTicket'] = $result['event_ticketqty'] ?? '';

        $sql = "SELECT u.`id`, u.`first_name` as `firstName`, u.`middle_name`, u.`designation`, u.`company_address` as `companyAddress`, u.`membership_type` as `membershipType` as `middleName`, u.`last_name` as `lastName`, e.`interested` FROM user u INNER JOIN event_booking e ON e.user_id = u.id WHERE e.event_id = $eventID";
        $results = $this->db->query($sql)->result_array();
        foreach ($results as &$result) {
            $result['firstName'] = ucfirst($result['firstName']) ?? '';
            $result['middleName'] = ucfirst($result['middleName']) ?? '';
            $result['lastName'] = ucfirst($result['lastName']) ?? '';
            if ($result['interested'] == '1') {
                $result['interested'] = 'Attending';
            }
            if ($result['interested'] == '0') {
                $result['interested'] = 'Not Attending';
            }
            if ($result['interested'] == '2') {
                $result['interested'] = 'May be';
            }
        }
        $event['members'] = $results;
        echo @json_encode($event);
    }
}
