<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Load the database library (if not autoloaded)
        $this->load->database();
    }

   
    // Get a single user by ID from the 'users' table
    public function get_otp_by_phone($phone)
    {
        $query = $this->db->get_where('otp_phone', array('phone' => $phone))->limit(1);
        return $query->row_array();
    }

    // Insert a new user into the 'users' table
    public function insert($data)
    {
        $this->db->insert('otp_phone', $data);
        return $this->db->insert_id(); // Return the ID of the inserted row
    }
}