<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model('login_model');
    }

    public function index($data = NULL) {
        if (null !== $this->session->flashdata('success_message')) {
            $data = $this->session->flashdata('success_message');
        } else {
            $data = $this->session->flashdata('error_message');
        }
        //print_r($data);exit;
        $this->load->view('login_user', $data);
    }

    public function register_view() {

        $this->load->view('register_user');
    }

    /*
     *  Login process
     */

    public function process() {

        // Validate the user can login
        $result = $this->login_model->validate();
        //echo '<pre>';print_r($result);die();
        // Now we verify the result
        if (!($result)) {
            // If user did not validate, then show them login page again
            $data['error_message'] = "Username or Password incorrect...";
            $this->load->view('login_user', $data);
            //redirect('login', $data);
        } else {
            // If user did validate, 
            // Send them to members area
            $this->load->view('welcome_dashboard');
            //redirect(base_url('schedule/get_planned_batches'));
        }
    }

    /*
     *  Logout User
     */

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    /*
     * Forgetpassword page
     */

    public function forgetpassword() {
        $this->load->view('forgetpassword_user');
    }

    /*
     *  Forgotpassword email sender:
     */

    public function forgotpassword_sendemail() {
        $email = $this->security->xss_clean($this->input->post('forgotemail'));
        $findemail = $this->login_model->check_forgotpassword_email($email);
        if ($findemail) {
            $this->login_model->send_resetpassword_link($findemail);
            $data['success_message'] = 'Reset password link send to '.$findemail['email'].'.';
            $this->session->set_flashdata('success_message', $data);
            redirect('login', $data);
        } else {
            $this->session->set_flashdata('msg', ' Email not found!');
            $data['error_message'] = "Email not found!";
            $this->session->set_flashdata('error_message', $data);
            redirect('login', $data);
        }
    }

    public function insertforgotpassword() {
        $data = $this->input->post();
        
        $insert = $this->login_model->insert_forgot_data();
        //print_r($insert);exit;
        if (!empty($insert)) {
            $removetokan = array('forgot_pass_tokan' => '');
            $this->db->update('employee', $removetokan);
            $data['success_message'] = 'Reset password successfully, Please login.';
            $this->session->set_flashdata('success_message', $data);
            redirect('login', $data);
        } else {
            $data['error_message'] = 'Your reset password link is expired.';
            $this->session->set_flashdata('error_message', $data);
            redirect('login', $data);
        }
    }

}
