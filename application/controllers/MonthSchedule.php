<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MonthSchedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_isvalidated();

        //  Calling cURL Library
        $this->load->library('curl');
    }

    public function index() {
        if ($this->session->userdata('employee_id')) {
            $this->load->view('month_schedule_view');
        }
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('employee_id')) {
            $data['error_message'] = "Please login first.";
            $this->load->view('login_user', $data);
        }
    }

}
