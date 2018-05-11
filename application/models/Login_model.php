<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();

        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->database();

        // Load mail library
        $this->load->library('email', array('mailtype' => 'html'));
    }

    public function validate() {
        // grab user input
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = md5($this->security->xss_clean($this->input->post('password')));

        // Prep the query
        $this->db->where('email', $email);
        $this->db->where('password', $password);

        // Run the query
        $query = $this->db->get('employee');

        // Let's check if there are any results
        if ($query->row()) {
            // If there is a user, then create session data
            $data = array(
                'employee_id' => $query->row()->employee_id,
                'name' => $query->row()->name,
                'role' => $query->row()->role,
                'email' => $query->row()->email,
                'is_logged_in' => True
            );
            $this->session->set_userdata($data);
            return true;
        }

        // If the previous process did not validate
        // then return false.
        return false;
    }

    //funtion to get email of user to send password
    public function check_forgotpassword_email($email) {
        $this->db->select('email');
        $this->db->from('employee');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function send_resetpassword_link($findemail) {
        $this->load->library('email');

        $config['protocol'] = 'smtp';

        $config['smtp_host'] = 'ssl://smtp.gmail.com';

        $config['smtp_port'] = '465';

        $config['smtp_timeout'] = '7';

        $config['smtp_user'] = 'tushar@linkwok.com';

        $config['smtp_pass'] = '99789tushar@';

        $config['charset'] = 'utf-8';

        $config['newline'] = "\r\n";

        $config['mailtype'] = 'html'; // or text

        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $email = $findemail['email'];
        $tokan = uniqid();

        $data = array(
            'forgot_pass_tokan' => $tokan
        );

        $this->db->where('email', $email);
        $this->db->update('employee', $data);

        $this->email->from("productionplanner@cybit.com", "Cybit");
        $this->email->to($email);
        $this->email->subject("Reset your Password");
        $message = "<p>This email has been sent as a request to reset our password</p>";
        $message .= "<p><a href='" . base_url() . "login/forgetpassword/$tokan'>Click here </a>if you want to reset your password, if not, then ignore</p>";
        $this->email->message($message);
        $this->email->send();
    }

    public function insert_forgot_data() {
        $password = md5($this->security->xss_clean($this->input->post('password')));
        $tokan = $this->security->xss_clean($this->input->post('tokan'));

        $this->db->where('forgot_pass_tokan', $tokan);
        $query = $this->db->get('employee');
        //echo '<pre>';print_r($query->row());exit;
        if (!empty($query->row())) {
            $this->db->where('forgot_pass_tokan', $tokan);
            $data = array('password' => $password);
            $this->db->update('employee', $data);

            return TRUE;
        } else {
            return FALSE;
        }
    }

}
