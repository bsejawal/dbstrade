<?php

class adminHome extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->clear_cache();
        $this->load->database();
        $this->load->helper('url'); // Helps to get base url defined in config.php
    }

    public function checkFilepath($page, $area) {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php') && $area == 'admin') {
            show_404();
        }
    }

    public function getFlashdata() {
        $this->load->library('session'); // something like session start
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if (!empty($error)) { // pulls data before redirect and checks for login error
            $status = array('error', $error);
            return $status;
        }
        if (!empty($success)) {
            $status = array('ok', $success);
            return $status;
        }
    }

    public function checkAccess() {
        $this->load->library('session'); // something like session start
        $status = $this->session->userdata('id'); // gets session data
        if (!empty($status)) {
            return $status;
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index($page) {
        $this->checkFilepath($page, 'admin');
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        if ($page != 'login') {
            $data['username'] = $this->checkAccess();
            $data['id'] = $this->session->userdata('id');
            $userData = $this->getUserInfo($data['id']);
            $data['name'] = $userData['name'];
            $data['gender'] = $userData['gender'];
            $data['role'] = $userData['role'];
        }
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function getUserInfo($id) {
        $this->load->model('get');
        $userData = $this->get->getUserInfo($id); // calling model
        foreach ($userData as $userInfo) {
            $info = array('name' => $userInfo->name, 'gender' => $userInfo->gender, 'username' => $userInfo->username, 'role' => $userInfo->role);
        }
        return $info;
    }

    public function getFooter() {
        $this->load->model('get');
        $footerData = $this->get->getFooter(); // calling model
        if (!empty($footerData)) {
            foreach ($footerData as $footerInfo) {
                $info = $footerInfo->content;
            }
            return $info;
        }
    }

    public function loadView($data, $page) {
        $data['title'] = ucfirst($page); // sets title of the page
        $this->load->view('templates/header', $data);
        $this->load->view('admin/' . $page);
        $this->load->view('templates/footer', $data);
    }

    public function clear_cache() { // this fucntion clears browser cache to prevent reloging into system after logout
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}
