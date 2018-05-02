<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model('login_model');
    }

    public function index($data = NULL) {

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

    public function forgetpassword($param) {
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
        } else {
            $this->session->set_flashdata('msg', ' Email not found!');
            $data['error_message'] = "Email not found!";
            redirect('login', $data);
            //$this->load->view('login_user', $data);
        }
    }

}
