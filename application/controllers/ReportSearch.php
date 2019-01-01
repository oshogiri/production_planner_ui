<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportSearch extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_isvalidated();

        //  Calling cURL Library
        $this->load->library('curl');

        $this->load->model('Month_Schedule');
        $this->load->model('Get_schedule');
        $this->load->model('Report');
    }

    public function index() {
        if ($this->session->userdata('employee_id')) {

            $get_inventories = $this->Month_Schedule->get_inventories();

            if (isset($get_inventories)) {
                if (!empty($get_inventories->success)) {
                    $view_data['inventories'] = $get_inventories->inventories;
                } else {
                    $view_data['error_message'] = $get_inventories->message;
                }
            } else {
                $view_data['error_message'] = 'No Responce';
            }

            $get_batch_number = $this->Report->get_batch_number();
            if (isset($get_batch_number)) {

                if (!empty($get_batch_number->success)) {
                    $view_data['batch_numbers'] = $get_batch_number->schedules;
                }
            }

            $get_batch_plan = $this->session->flashdata('get_batch_plan');
            if (isset($get_batch_plan)) {
                if (!empty($get_batch_plan->success)) {
                    $view_data['get_batch_plan'] = $get_batch_plan->schedules;
                }
            }

            $this->load->view('report_view', $view_data);
        } else {
            redirect('login/logout', refresh);
        }
    }

    private function check_isvalidated() {
        if (!$this->session->userdata('employee_id')) {
            $data['error_message'] = "Please login first.";
            $this->load->view('login_user', $data);
        }
    }

    public function get_batch_plan_by_product() {
        $get_product = $_GET['batch_number'];

        $get_batch_plan = $this->Report->get_batch_plan_by_batch_number($get_product);

        $this->session->set_flashdata('get_batch_plan', $get_batch_plan);

        redirect('ReportSearch', 'refresh');

    }

    public function get_batch_number() {
        $get_batch_details = $this->input->post();

        $get_batch_number = $this->Report->get_batch_number($get_batch_details);

        return $get_batch_number;
    }

    public function set_batch_plan() {
        $set_batch_number = $this->input->post();
//        echo '<pre>';print_r($set_batch_number);die;
        return $set_batch_number;
    }

}
