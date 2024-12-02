<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboardEvent extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->set_userdata('isLogIn', 1);
        $this->session->set_userdata('userid', 2);
    }

    public function index()
    {
        if (!$this->session->userdata('isLogIn')) {
            $this->session->set_flashdata('message', 'Please Login to continue');
            redirect('login');
        } else {
            $this->load->view('dashboard_event');
        }
    }
}
