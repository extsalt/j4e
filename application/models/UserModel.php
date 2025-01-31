<?php

class UserModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Load the database library (if not autoloaded)
        $this->load->database();
    }

    // Get all users from the 'users' table
    public function get_all_users()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    // Get a single user by ID from the 'users' table
    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row();
    }

    public function getUserByEmail($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        var_dump($query);
        die;
        return $query->row();
    }
    
    // Insert a new user into the 'users' table
    public function insert_user($data)
    {
        $this->db->insert('user', $data);
        return $this->db->insert_id(); // Return the ID of the inserted row
    }

    // Update a user in the 'users' table
    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    // Delete a user from the 'users' table
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}