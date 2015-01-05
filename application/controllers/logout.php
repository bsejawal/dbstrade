<?php

class Logout extends CI_Controller {

    public function index() {
        $this->load->helper('url'); // base url define in config.php
        $this->load->library('session');
        $user_data = array('username' => '', 'role' => ''); // creating empty array before unsetting session
        $this->session->unset_userdata($user_data); // pushing empty data to session
        echo $this->session->userdata('username');
        $this->session->sess_destroy(); // like session destroy
        $this->compareImage();
        redirect('login', 'refresh');
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
