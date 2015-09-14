<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('get');
    }

    public function index() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->helper('url'); // base url define in config.php
        $login_data = $this->get->getUserLogin($username, $password);
        $this->load->library('session'); // starts session
        if (!empty($login_data)) {
            foreach ($login_data as $user_details) {
                $user_data = array('id' => $user_details->id); // creating array before storing inside session
                $this->session->set_userdata($user_data); //sets seesion data 
                $this->compareImage();
                redirect('admin/home', 'refresh'); // redirects to another page (remo)   
            }
        } else {
            $this->session->set_flashdata('error', 'Incorrect Username or Password'); // sets data before redirect
            redirect('login', 'refresh');
        }
    }

    public function compareImage() {
        $files = scandir('images/thumb/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $thumbData[] = $file;
            }
        }

        $img = scandir('images/product/');
        foreach ($img as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $imgData[] = $file;
            }
        }

        $data = array_diff($thumbData, $imgData);
        foreach ($data as $rmImg) {
            unlink('images/thumb/' . $rmImg);
        }
    }

}
