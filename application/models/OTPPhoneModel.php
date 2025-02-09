<?php

class OTPPhoneModel extends CI_Model
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
        $query = $this->db->get_where('otp_phone', array('phone' => $phone), '1');
        return $query->row_array();
    }

    // Get a single user by ID from the 'users' table
    public function get_by_phone_and_otp($phone, $otp)
    {
        $query = $this->db->get_where('otp_phone', array('phone' => $phone, 'otp' => $otp, 'verified_at' => null), '1');
        return $query->row_array();
    }

    
    // Get a single user by ID from the 'users' table
    public function mark_as_verified($phone, $otp)
    {
        return $this->db->update('otp_phone', ['verified_at' => date('Y-m-d H:is:')], array('phone' => $phone, 'otp' => $otp), '1');
    }

    public function delete_by_phone_and_otp($phone, $otp)
    {
        $this->db->delete('otp_phone', ['phone' => $phone, 'otp' => $otp]);
    }

    
    public function delete_by_phone($phone)
    {
        $this->db->delete('otp_phone', ['phone' => $phone]);
    }

    // Insert a new user into the 'users' table
    public function insert($data)
    {
        $this->db->insert('otp_phone', $data);
        return $this->db->insert_id(); // Return the ID of the inserted row
    }
}