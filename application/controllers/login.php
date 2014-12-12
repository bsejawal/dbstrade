<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('getUser');
    }

    function index() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->helper('url'); // base url define in config.php
        $login_data = $this->getUser->login($username, $password);
        $this->load->library('session'); // starts session
        if (!empty($login_data)) {
            foreach ($login_data as $user_details) {
                $user_data = array('name' => $user_details->name, 'gender' => $user_details->gender, 'username' => $user_details->username, 'role' => $user_details->role); // creating array before storing inside session
                $this->session->set_userdata($user_data); //sets seesion data 
                redirect('admin/home', 'refresh'); // redirects to another page (remo)   
            }
        } else {
            $this->session->set_flashdata('error', 'Incorrect Username or Password'); // sets data before redirect
            redirect('login', 'refresh');
        }
    }

}
