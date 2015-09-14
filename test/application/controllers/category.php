<?php

class category extends CI_Controller {

    function __construct() {
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

    public function index() {
        $dataPerPage = 10;
        $page = 'category';
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
        $this->checkFilepath($page, 'admin');
        $data['catInfo'] = $this->getCategory($dataPerPage);
        $totalData = $this->getCatePage();
        $data['num_pages'] = ceil($totalData / $dataPerPage);
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

    public function insertCategory() {
        $this->load->model('insert');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $insertData = $this->insert->insertCategory($category, $description);
        if (!empty($insertData)) {
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Record Inserted');
            redirect('admin/category', 'refresh');
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('error', 'Record cannot be inserted');
            redirect('admin/category', 'refresh');
        }
    }

    public function getCategoryId($id) {
        $this->load->model('get');
        $cateData = $this->get->getCategoryId($id); // calling model
        foreach ($cateData as $cateInfo) {
            $id = $cateInfo->id;
            $category = $cateInfo->category;
            $desc = $cateInfo->description;
        }
        return array($id, $category, $desc);
    }

    public function editCategory() {
        $page = 'editCategory';
        $this->checkFilepath($page, 'admin');
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        $data['username'] = $this->checkAccess();
        $data['id'] = $this->session->userdata('id');
        $userData = $this->getUserInfo($data['id']);
        $data['name'] = $userData['name'];
        $data['gender'] = $userData['gender'];
        $data['role'] = $userData['role'];
        $editData = $this->getCategoryId($this->input->get('id'));
        $data['id'] = $editData[0];
        $data['category'] = $editData[1];
        $data['desc'] = $editData[2];
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function updateCategory() {
        $this->load->model('update');
        $cateId = $this->input->post('cateId');
        $category = $this->input->post('category');
        $desc = $this->input->post('description');
        $updateData = $this->update->updateCategory($cateId, $category, $desc);
        if (!empty($updateData)) {
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Record Updated');
            redirect('admin/category', 'refresh');
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('error', 'Record cannot be updated');
            redirect('admin/category', 'refresh');
        }
    }

    public function deleteCategory() {
        $deleteInfo = $this->deleteCate($this->input->get('id'));
        if ($deleteInfo == TRUE) {
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Record Deleted');
            redirect('admin/category', 'refresh');
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('error', 'Record cannot be deleted');
            redirect('admin/category', 'refresh');
        }
    }

    public function deleteCate($id) {
        $this->load->model('delete');
        $categoryData = $this->delete->deleteCate($id); // calling model
        return $categoryData;
    }

    public function getCategory($dataPerPage) {
        $this->load->model('get');
        if (!empty($this->input->get('page'))) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }
        $totalData = $this->get->getCategory($page, $dataPerPage); // calling model
        if ($page > 1) {
            $i = (($page - 1) * $dataPerPage) + 1;
        } else {
            $i = 1;
        }
        foreach ($totalData as $finalInfo) {
            $info[] = array('sn' => $i++, 'id' => $finalInfo->id, 'category' => $finalInfo->category, 'description' => $finalInfo->description);
        }
        if (!empty($info)) {
            return $info;
        } else {
            return FALSE;
        }
    }

    public function getCatePage() {
        $this->load->model('get');
        $totalData = count($this->get->allData('category')); // calling model and sending table name
        return $totalData;
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
