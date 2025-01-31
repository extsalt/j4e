<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_id_by_token($token)
    {
        $query = $this->db->get_where('api_token', array('token' => $token));
        return $query->row();
    }

    public function insert_token($data)
    {
        $this->db->insert('api_token', $data);
        return $this->db->insert_id();
    }
}