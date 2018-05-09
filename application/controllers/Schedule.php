<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_isvalidated();

        //  Calling cURL Library
        $this->load->library('curl');

        $this->load->model('planned_batches');
        $this->load->model('get_schedule');
    }

    public function index() {
        if ($this->session->userdata('employee_id')) {
            $this->load->view('schedule_view');
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

    public function get_planned_batches() {
        if (!$this->session->userdata('employee_id')) {
            redirect('login/logout');
        }
        
        if ($this->session->userdata('role') == 'production') {
            redirect('dashboard');
        }
        date_default_timezone_set('Asia/Kolkata');

        //  Setting URL To Fetch Data From
        $this->curl->create('http://172.16.0.22:1313/api/v1/batch_plans/get_planned_batches');

        //  To Temporarily Store Data Received From Server
        $this->curl->option('buffersize', 10);

        //  To Receive Data Returned From Server
        $this->curl->option('returntransfer', 1);

        //  To follow The URL Provided For Website
        $this->curl->option('followlocation', 1);

        //  To Retrieve Server Related Data
        $this->curl->option('HEADER', false);

        //  To Set Time For Process Timeout
        $this->curl->option('connecttimeout', 600);

        //  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
        $data = $this->curl->execute();

        $decode_data = json_decode($data);
        $resequence_data = $this->get_schedule->get_schedule_actual_time();
        $generate_schedule = $this->session->flashdata('generate_schedule');
//        echo '<pre>';
//        print_r($decode_data);
//        die();

        if (isset($decode_data)) {
            if (!($decode_data->success)) {
                if (isset($generate_schedule)) {
                    $view_data['message_error'] = $generate_schedule->message;
                }
                $view_data['message_error'] = $decode_data->message;
                $view_data['error_schedule'] = 'Schedule not published for this date...';
                $view_data['error_batch'] = 'No Batches';
                $this->load->view('schedule_view', $view_data);
            } else {

                if (!($resequence_data->success)) {
                    $view_data['error_schedule'] = $resequence_data->message;
                } else {
                    $batch_schedules = $resequence_data->batch_schedules;
                    $view_data['batch_schedules'] = $batch_schedules;
                }
                if (isset($generate_schedule)) {
                    $view_data['message_success'] = $generate_schedule->message;
                    $view_data['publish'] = $resequence_data->published;
                }
                //
                $batch_sequences = $decode_data->batch_sequences;
                $view_data['get_planned_batches'] = $batch_sequences;
                //echo '<pre>';print_r($view_data);die();
                $this->load->view('schedule_view', $view_data);
            }
        } else {
            //$view_data['message'] = $decode_data->message;
            $view_data['error_schedule'] = 'No responce';
            $view_data['error_batch'] = 'No Responce';
            $this->load->view('schedule_view', $view_data);
        }

//        echo '<pre>';
//        print_r($generate_schedule);
//        die();
    }

    public function generate_schedule() {
        if (!$this->session->userdata('employee_id')) {
            redirect('login/logout');
        }
        date_default_timezone_set('Asia/Kolkata');

        $data = $this->input->post('batch_sequence');

        $sequence = array(
            'batch_sequence' => $data
        );
        $url = 'http://172.16.0.22:1313/api/v1/schedules/generate_schedule';
//        $url = '172.16.20.19:3000/api/v1/schedules/generate_schedule';

        $responce = $this->postCURL($url, $sequence);
        $decode_data = json_decode($responce);

        $this->session->set_flashdata('generate_schedule', $decode_data);
        redirect('schedule/get_planned_batches', 'refresh');
   }

    public function batch_number() {
        //$get_batch = $this->input->post();
        $batch_number = $this->input->post('batch_number');
        $uuid = $this->input->post('uuid');
        $url = 'http://172.16.0.22:1313/api/v1/batches/' . $uuid . '/set_batch_number';
        $responce = $this->postCURL($url, array('batch_number' => $batch_number));
        echo $responce;
    }

    public function postCURL($_url, $_param) {

        $postData = '';
        //create name value pairs seperated by &
        foreach ($_param as $k => $v) {
            $postData .= $k . '=' . $v . '&';
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;
    }

    public function publish_schedule() {
        $url = 'http://172.16.0.22:1313/api/v1/schedules/publish_schedule';
        $responce = $this->postCURL($url, array());
        echo $responce;
    }

    public function get_schedule() {
        if (!$this->session->userdata('employee_id')) {
            redirect('login/logout');
        }
        parse_str($_SERVER['QUERY_STRING'], $_GET);

        if (isset($_GET['date']))
            $date = $_GET['date'];
        else
            $date = null;
//        echo '<pre>';print_r($date);die();

        $url = 'http://172.16.0.22:1313/api/v1/schedules/get_schedule';
        if (isset($date))
            $url = $url . '?schedule_date=' . $date;

        date_default_timezone_set('Asia/Kolkata');

        //  Setting URL To Fetch Data From
        $this->curl->create($url);

        //  To Temporarily Store Data Received From Server
        $this->curl->option('buffersize', 10);

        //  To Receive Data Returned From Server
        $this->curl->option('returntransfer', 1);

        //  To follow The URL Provided For Website
        $this->curl->option('followlocation', 1);

        //  To Retrieve Server Related Data
        $this->curl->option('HEADER', false);

        //  To Set Time For Process Timeout
        $this->curl->option('connecttimeout', 600);

        //  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
        $data = $this->curl->execute();

        $decode_data = json_decode($data);
        //echo '<pre>';print_r($url);die();
        $set_actual_time = $this->session->flashdata('set_actual_time');
        //echo '<pre>';print_r($set_actual_time);die();

        if (isset($date))
            $condate = date('d M Y', $date);
        else
            $condate = date('d M Y');
        $view_data['date'] = $condate;

        if (isset($decode_data)) {
            if (!($decode_data->success)) {

                $view_data['error_schedule'] = $decode_data->message;
                if (isset($set_actual_time)) {
                    $view_data['message'] = $set_actual_time->message;
                }
                $this->load->view('production_view', $view_data);
            } else {

                $batch_schedules = $decode_data->batch_schedules;
                if (isset($set_actual_time)) {
                    $view_data['message'] = $set_actual_time->message;
                }
                $view_data['batch_schedules'] = $batch_schedules;
                $view_data['publish'] = $decode_data->published;
                $this->load->view('production_view', $view_data);
            }
        } else {
            $view_data['error_schedule'] = 'No responce';

            $this->load->view('production_view', $view_data);
        }
    }

    public function set_actual_time() {
        date_default_timezone_set('Asia/Kolkata');
        $get_actual_time = $this->input->post();
        //echo '<pre>';print_r($get_actual_time);//die();
        $actual_start_time_insec = strtotime($get_actual_time['time']);
        $uuid = $get_actual_time['uuid'];

        $data = array(
            'punch_time' => $actual_start_time_insec,
            'comment' => $get_actual_time['comment'],
            'by' => $get_actual_time['employee_id'],
            'punch_type' => $get_actual_time['punch_type'],
            'comment_type' => $get_actual_time['comment_type']
        );
        //echo '<pre>';print_r($data);//die();

        $url = 'http://172.16.0.22:1313/api/v1/schedules/' . $uuid . '/set_actual_time';
//        $url = '172.16.20.19:3000/api/v1/schedules/' . $uuid . '/set_actual_time';

        $responce = $this->postCURL($url, $data);
        $decode_data = json_decode($responce);
        //echo '<pre>';print_r($decode_data);die();
        $this->session->set_flashdata('set_actual_time', $decode_data);
        redirect('schedule/get_schedule', 'refresh');
    }

}
