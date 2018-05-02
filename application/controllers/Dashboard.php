<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_isvalidated();
    }

    public function index() {
        if ($this->session->userdata('employee_id')) {
            $this->load->view('welcome_dashboard');
        }
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('employee_id')) {
            $data['error_message'] = "Please login first.";
            $this->load->view('login_user', $data);
        }
    }

}
