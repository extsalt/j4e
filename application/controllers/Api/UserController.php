<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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
        $location = $_GET['location'];
        $service = $_GET['service'];
        $industry = $_GET['industry'];
        $sql = "SELECT `id`,`first_name`,`middle_name`,`last_name`,`phone`,`designation`,`company`,`avatar`,`company_address`,
                `business_category`,`membership_type`,`target_audiance`,`business_entity`,`business_experties`,`business_type` FROM user WHERE user_type = '1' AND membership_type IN (2, 1) ";
        if ($query) {
            $sql .= " AND `first_name` LIKE '%$query%' OR `middle_name` LIKE '%query%' OR `last_name` LIKE '%$query%' ";
        }
        if ($location) {
            $sql .= " AND `company_address` LIKE '%$location%' ";
        }
        if ($industry) {
            $sql .= " AND `business_type` LIKE '%$industry%' ";
        }
        if ($service) {
            $sql .= " AND `business_experties` LIKE '%$service%' ";
        }
        $sql .= " LIMIT 20";
        //return response as array rather than standard object

        $results = $this->db->query($sql)->result_array();
        $response = [];
        foreach ($results as $result) {
            $member = [];
            $member['id'] = $result['id'];
            $member['firstName'] = $result['first_name'] ?? '';
            $member['middleName'] = $result['middle_name'] ?? '';
            $member['lastName'] = $result['last_name'] ?? '';
            $member['phone'] = $result['phone'] ?? '';
            $member['designation'] = $result['designation'] ?? '';
            $member['company'] = $result['company'] ?? '';
            $member['avatar'] = $result['avatar'] ?? '';
            $member['companyAddress'] = $result['company_address'] ?? '';
            $member['businessCategory'] = $result['business_category'] ?? '';
            $member['targetAudience'] = $result['target_audience'] ?? '';
            $member['businessEntity'] = $result['business_entity'] ?? '';
            $member['businessExpertise'] = $result['business_experise'] ?? '';
            $member['businessType'] = $result['business_type'] ?? '';
            if ($result['membership_type'] == '2') {
                $member['membershipType'] = 'Registered';
            } else {
                $member['membershipType'] = 'Visitor Member';
            }
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
