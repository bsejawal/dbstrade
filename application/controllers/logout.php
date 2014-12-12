<?php

class Logout extends CI_Controller {

    function index() {
        $this->load->helper('url'); // base url define in config.php
        $this->load->library('session');
        $user_data = array('username' => '', 'role' => ''); // creating empty array before unsetting session
        $this->session->unset_userdata($user_data); // pushing empty data to session
        echo $this->session->userdata('username');
        $this->session->sess_destroy(); // like session destroy
        redirect('login', 'refresh');
    }

}
