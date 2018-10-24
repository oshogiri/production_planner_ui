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

//    public function index() {
//        if ($this->session->userdata('employee_id')) {
//            $this->load->view('month_schedule_view');
//        }
//    }

    private function check_isvalidated() {
        if (!$this->session->userdata('employee_id')) {
            $data['error_message'] = "Please login first.";
            $this->load->view('login_user', $data);
        }
    }

    public function month_schedule() {
        if (!$this->session->userdata('employee_id')) {
            redirect('login/logout');
        }
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        if (isset($_GET['month']))
            $month = $_GET['month'];
        else
            $month = null;

        $get_inventories = $this->Month_Schedule->get_inventories($month);
        $get_batch_plan = $this->Month_Schedule->get_batch_plans($month);
        $generate_batch_plan = $this->session->flashdata('generate_batch_plan');
        $get_nobatch_responce = $this->session->flashdata('get_nobatch_responce');
        $get_addnobatch_responce = $this->session->flashdata('get_addnobatch_responce');
        
//        echo '<pre>';print_r($get_nobatch_responce);die();

        if (isset($month)) {
            $condate = date('d F Y', $month);
            $dispdate = date('F Y', $month);
        } else {
            $condate = date('d F Y');
            $dispdate = date('F Y');
        }
        $view_data['month'] = $condate;
        $view_data['dispmonth'] = $dispdate;
        $view_data['publish'] = "";
        $view_data['get_nobatch_responce'] = $get_nobatch_responce;
        $view_data['get_addnobatch_responce'] = $get_nobatch_responce;
//        echo '<pre>';print_r($get_inventories);//die();
        //echo '<pre>';print_r($get_batch_plan);die();

        if (isset($get_inventories)) {
            if (!empty($get_inventories->success)) {
                //echo '<pre>';print_r($get_inventories->inventories);die();
                if (!empty($get_batch_plan['success'])) {
                    $view_data['batch_plans'] = $get_batch_plan['batch_plans'];
                    $view_data['is_success'] = $get_batch_plan['success'];
                    $view_data['publish'] = $get_batch_plan['published'];
                    $view_data['generate_batch_plan'] = $generate_batch_plan;
                    $view_data['date_header_array'] = $get_batch_plan['date_range'];
                } else {
                    $view_data['error_message'] = $get_batch_plan['message'];
                    $view_data['is_success'] = $get_batch_plan['success'];
                }
                $view_data['inventories'] = $get_inventories->inventories;
                $this->load->view('month_schedule_view', $view_data);
            } else {
                $view_data['date_header_array'] = '';
                if (empty($get_inventories->success)) {
                    $view_data['error_message'] = $get_inventories->message;
                }
                if (empty($get_batch_plan['success'])) {
                    $view_data['batch_plan_message'] = $get_batch_plan['message'];
                }
                $this->load->view('month_schedule_view', $view_data);
            }
        } else {
            $view_data['error_message'] = 'No Responce';
            $this->load->view('month_schedule_view', $view_data);
        }
    }

    public function generate_batch_plan() {
        $generate_batch_plan = $this->Month_Schedule->get_generate_batch_plan();
        
        if (isset($generate_batch_plan)) {
            if (!empty($generate_batch_plan->success)) {
                $this->session->set_flashdata('generate_batch_plan', $generate_batch_plan->message);
                redirect('MonthSchedule/month_schedule', 'refresh');
            } else {
                $this->session->set_flashdata('generate_batch_plan', $generate_batch_plan->message);
                redirect('MonthSchedule/month_schedule', 'refresh');
            }
        }
    }
    
    public function Publish_batchplan() {
        $publish = $this->Month_Schedule->publish_batch_plan();
        echo $publish;
    }
    
    public function Unpublish_batchplan() {
        $unpublish = $this->Month_Schedule->unpublish_batch_plan();
        echo $unpublish;
    }
    
    public function generate_is_success() {
        $get_batch_plan = $this->Month_Schedule->get_batch_plans();
//        $view_data['is_success'] = $get_batch_plan['success'];
//        print_r($view_data['is_success']);        die();
        echo json_encode($get_batch_plan);
    }
    
    public function updateNoBatch() {
        $get_nobatch = $this->input->post();
        $get_nobatch_responce = $this->Month_Schedule->update_nobatch($get_nobatch);
        
        $this->session->set_flashdata('get_nobatch_responce', $get_nobatch_responce);
        redirect('/MonthSchedule/month_schedule', 'refresh');
        //echo '<pre>'; print_r($get_nobatch_responce); exit;
    }
    
    public function addNoBatch() {
        $get_addbatch = $this->input->post();
        $get_addnobatch_responce = $this->Month_Schedule->add_nobatch($get_addbatch);
        $this->session->set_flashdata('get_addnobatch_responce', $get_addnobatch_responce);
        redirect('/MonthSchedule/month_schedule', 'refresh');
//        echo '<pre>'; print_r($get_addnobatch_responce); exit;
    }

}
