<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MonthSchedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_isvalidated();

        //  Calling cURL Library
        $this->load->library('curl');
        $this->load->model('Month_Schedule');
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

    public function month_schedule() {
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        if (isset($_GET['month']))
            $month = $_GET['month'];
        else
            $month = null;

        $get_inventories = $this->Month_Schedule->get_inventories($month);
        $get_batch_plan = $this->Month_Schedule->get_batch_plans($month);
        //echo '<pre>';print_r($month);die();

        if (isset($month))
            $condate = date('F Y', $month);
        else
            $condate = date('F Y');
        $view_data['month'] = $condate;
//        echo '<pre>';print_r($view_data['month']);die();

        if (isset($get_inventories)) {
            if (!empty($get_inventories->success)) {
                //echo '<pre>';print_r($get_inventories->inventories);die();
                $view_data['batch_plans'] = $get_batch_plan['batch_plans'];
                $view_data['inventories'] = $get_inventories->inventories;

                $view_data['date_header_array'] = $get_batch_plan['date_range'];
                $this->load->view('month_schedule_view', $view_data);
            } else {
                $view_data['error_message'] = $get_inventories->message;
                $this->load->view('month_schedule_view', $view_data);
            }
        } else {
            $view_data['error_message'] = 'No Responce';
            $this->load->view('month_schedule_view', $view_data);
        }
    }

}
