<?php

class ApiTokenModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserByToken($token)
    {
        $query = $this->db->get_where('api_token', array('token' => $token));
        return $query->row();
    }

    public function insertToken($data)
    {
        $this->db->insert('api_token', $data);
        return $this->db->insert_id();
    }
}