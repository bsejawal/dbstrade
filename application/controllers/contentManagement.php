<?php

class contentManagement extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->clear_cache();
        $this->load->database();
        $this->load->library('session'); // something like session start
        $this->load->helper('url'); // Helps to get base url defined in config.php
    }

    public function checkFilepath($page, $area) {
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php') && $area == 'admin') {
            show_404();
        }
    }

    public function getFlashdata() {
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
        $status = $this->session->userdata('id'); // gets session data
        if (!empty($status)) {
            return $status;
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index() {
        $dataPerPage = 10;
        $page = 'contentManagement';
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
        $data['getInfo'] = $this->getInfo($dataPerPage);
        $totalData = $this->getContPage();
        $data['num_pages'] = ceil($totalData / $dataPerPage);
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function editSlider() {
        $data['imageName'] = $this->input->get('img');
        $page = 'editSlider';
        if ($page != 'login') {
            $data['id'] = $this->checkAccess();
            $userData = $this->getUserInfo($data['id']);
            $data['name'] = $userData['name'];
            $data['username'] = $userData['username'];
            $data['gender'] = $userData['gender'];
            $data['role'] = $userData['role'];
        }
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    function insertContent() {
        $this->load->model('insert');
        $headingContent = $this->input->post('headingContent');
        $bodyContent = $this->input->post('bodyContent');
        $desc = $this->input->post('desc');
        $key = $this->input->post('keyword');
        $insertData = $this->insert->insertContent($headingContent, $bodyContent, $desc, $key);
        if (!empty($insertData)) {
            $this->session->set_flashdata('success', 'Record Inserted');
            redirect('admin/contentManagement', 'refresh');
        }
    }

    public function getUserInfo($id) {
        $this->load->model('get');
        $userData = $this->get->getUserInfo($id); // calling model
        foreach ($userData as $userInfo) {
            $info = array('name' => $userInfo->name, 'gender' => $userInfo->gender, 'username' => $userInfo->username, 'role' => $userInfo->role);
        }
        return $info;
    }

    public function getInfo($dataPerPage) {
        $this->load->model('get');
        if (!empty($this->input->get('page'))) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }
        $infoData = $this->get->getInfo($page, $dataPerPage); // calling model
        if ($page > 1) {
            $i = (($page - 1) * $dataPerPage) + 1;
        } else {
            $i = 1;
        }
        foreach ($infoData as $getInfo) {
            $info[] = array('sn' => $i++, 'id' => $getInfo->id, 'heading' => $getInfo->heading, 'content' => $getInfo->content, 'description' => $getInfo->description);
        }
        return $info;
    }

    public function getContPage() {
        $this->load->model('get');
        $totalData = count($this->get->allData('info')); // calling model
        return $totalData;
    }

    public function editContent($id) {
        $this->load->model('get');
        $contactData = $this->get->getId($id); // calling model
        foreach ($contactData as $contactInfo) {
            $id = $contactInfo->id;
            $heading = $contactInfo->heading;
            $content = $contactInfo->content;
        }
        return array($id, $heading, $content);
    }

    function updateContent() {
        $this->load->model('update');
        $contentId = $this->input->post('contentId');
        $headingContact = $this->input->post('headingContact');
        $bodyContact = $this->input->post('bodyContact');
        $updateData = $this->update->updateInfo($contentId, $headingContact, $bodyContact);
        if (!empty($updateData)) {
            $this->session->set_flashdata('success', 'Record Updated');
            redirect('admin/contentManagement', 'refresh');
        }
    }

    public function editInfo() {
        $page = 'editInfo';
        $this->checkFilepath($page, 'admin');
        $data['id'] = $this->checkAccess();
        $userData = $this->getUserInfo($data['id']);
        $data['name'] = $userData['name'];
        $data['username'] = $userData['username'];
        $data['gender'] = $userData['gender'];
        $data['role'] = $userData['role'];
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        $editData = $this->editContent($this->input->get('id'));
        $data['id'] = $editData[0];
        $data['heading'] = $editData[1];
        $data['content'] = $editData[2];
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function deleteInfo() {
        $deleteInfo = $this->deleteContent($this->input->get('id'));
        if ($deleteInfo == TRUE) {
            $this->session->set_flashdata('success', 'Record Deleted');
            redirect('admin/contentManagement', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Record cannot be deleted');
            redirect('admin/contentManagement', 'refresh');
        }
    }

    public function deleteContent($id) {
        $this->load->model('delete');
        $contactData = $this->delete->deleteContent($id); // calling model
        return $contactData;
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
