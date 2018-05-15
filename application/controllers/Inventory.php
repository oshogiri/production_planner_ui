<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->check_isvalidated();
    }

    public function index() {
        $do_upload = $this->session->flashdata('do_upload');
        if ($this->session->userdata('employee_id') && $this->session->userdata('role') == 'planner') {
            //$this->load->view('dcs_report_view');
            if (isset($do_upload)) {
                if (empty($do_upload->success)) {
                    $view_data['fail_message'] = $do_upload->message;
                    if(isset($do_upload->errors)){
                        $view_data['success_errors'] = $do_upload->errors;
                    }
                    $this->load->view('inventory_upload', $view_data);
                } else {
                    $view_data['success_message'] = $do_upload->message;
                    $this->load->view('inventory_upload', $view_data);
                }
            } else {
                //$view_data['fail_message'] = 'No Responce';
                $this->load->view('inventory_upload');
            }
        }
    }

    private function check_isvalidated() {
        if (!($this->session->userdata('employee_id') && $this->session->userdata('role') == 'planner')) {
            //$data = "Please login first.";
            //$this->session->set_flashdata('error_message', $data);
            redirect('dashboard', 'refresh');
            //$this->load->view('login_user', $data);
        }
    }

    public function upload_inventory() {
        //$config['upload_path'] = './uploads/';
        $filepath = './uploads/';
        $config['upload_path'] = $filepath;
        $config['allowed_types'] = 'csv|xls|xlsx';
        $config['max_size'] = 100;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {

            $error = array('error' => $this->upload->display_errors());
            $this->load->view('inventory_upload', $error);
        } else {

            $data = array('upload_data' => $this->upload->data());
            $file_name = $data['upload_data']['file_name'];
            $fullpath = $data['upload_data']['full_path'];
            $filetype = $data['upload_data']['file_type'];

            // Create a CURLFile object
            $filedata = new CURLFile($fullpath, $filetype, $file_name);
            $post = array('inventory' => $filedata);

            $target_url = 'http://172.16.0.22:1313/api/v1/inventories/upload_inventory';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $target_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            $result = curl_exec($ch);
            curl_close($ch);
            $decode_data = json_decode($result);
            //echo '<pre>';print_r($decode_data);die();
            $this->session->set_flashdata('do_upload', $decode_data);
            redirect('Inventory', 'refresh');

        }
    }

}
