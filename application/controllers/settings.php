<?php

class settings extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->clear_cache();
        $this->load->database();
        $this->load->library('session');
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

    public function index() {
        $page = 'settings';
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        if ($page != 'login') {
            $data['id'] = $this->checkAccess();
            $userData = $this->getUserInfo($data['id']);
            $data['name'] = $userData['name'];
            $data['username'] = $userData['username'];
            $data['gender'] = $userData['gender'];
            $data['role'] = $userData['role'];
        }
        $this->checkFilepath($page, 'admin');
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function getUserInfo($id) {
        $this->load->model('get');
        $userData = $this->get->getUserInfo($id); // calling model
        foreach ($userData as $userInfo) {
            $info = array('name' => $userInfo->name, 'email' => $userInfo->email, 'gender' => $userInfo->gender, 'username' => $userInfo->username, 'password' => $userInfo->password, 'role' => $userInfo->role);
        }
        return $info;
    }

    public function editUser() {
        $page = 'editUser';
        if ($page != 'login') {
            $data['id'] = $this->checkAccess();
            $userData = $this->getUserInfo($data['id']);
            $data['name'] = $userData['name'];
            $data['email'] = $userData['email'];
            $data['username'] = $userData['username'];
            $data['gender'] = $userData['gender'];
            $data['role'] = $userData['role'];
        }
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function updateUser() {
        $this->load->model('update');
        $userId = $this->input->post('userId');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');
        $username = $this->input->post('username');
        $updateData = $this->update->updateUser($userId, $name, $email, $gender, $username);
        if (!empty($updateData)) {
            $this->session->set_flashdata('success', 'Record Updated');
            $this->clear_cache();
            redirect('admin/settings', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Record cannot be updated');
            $this->clear_cache();
            redirect('admin/settings', 'refresh');
        }
    }

    public function editPassword() {
        $page = 'editPassword';
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

    public function updatePassword() {
        $this->load->model('update');
        $userId = $this->input->post('userId');
        $userData = $this->getUserInfo($userId);
        if ($userData['password'] != sha1($this->input->post('oldPassword'))) {
            $this->session->set_flashdata('error', 'Incorrect old password. Please enter correct password.');
            $this->clear_cache();
            redirect('admin/settings', 'refresh');
            exit();
        }
        $newPassword = $this->input->post('newPassword');
        $updateData = $this->update->updatePassword($userId, sha1($newPassword));
        if (!empty($updateData)) {
            $this->session->set_flashdata('success', 'Password Changed');
            $this->clear_cache();
            redirect('admin/settings', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Password cannot be changed');
            $this->clear_cache();
            redirect('admin/settings', 'refresh');
        }
    }

    public function getUserId($id) {
        $this->load->model('get');
        $cateData = $this->get->getCategoryId($id); // calling model
        foreach ($cateData as $cateInfo) {
            $id = $cateInfo->id;
            $category = $cateInfo->category;
            $desc = $cateInfo->description;
        }
        return array($id, $category, $desc);
    }

    public function getFooter() {
        $this->load->model('get');
        $footerData = $this->get->getFooter(); // calling model
        foreach ($footerData as $footerInfo) {
            $info = $footerInfo->content;
        }
        return $info;
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
