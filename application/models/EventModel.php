<?php

class EventModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //  gets events from the database
    public function get_events_home()
    {
        $sql = "SELECT `event_id`,`event_title`,`event_description`,`event_address`,`event_startdate`,`event_enddate`,`event_fees`,`event_guestfees`,`event_ticketqty`,`event_thumbnil` FROM events ";
        $sql .= " ORDER BY `event_date` DESC LIMIT 5";
        $results = $this->db->query($sql)->result_array();
        $response = [];
        foreach ($results as $result) {
            $member = [];
            $member['id'] = $result['event_id'];
            $member['title'] = ucfirst($result['event_title']) ?? '';
            $member['address'] = $result['event_address'] ?? '';
            $member['startDate'] = $result['event_startdate'] ?? '';
            $member['endDate'] = $result['event_enddate'] ?? '';
            $member['coverPhoto'] = "https://just4entrepreneurs.com/admin/upload/events/$result[event_thumbnil]" ?? '';
            $member['eventFees'] = $result['event_fees'] ?? '';
            $member['guestFees'] = $result['event_guestfees'] ?? '';
            $member['totalTicket'] = $result['event_ticketqty'] ?? '';
            $member['shareURL'] = "https://just4entrepreneurs.com/event_detail/$result[event_id]" ?? '';
            $response[] = $member;
        }
        return $response;
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
        $query = $this->db->get_where('user', array('email_address' => $email));
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