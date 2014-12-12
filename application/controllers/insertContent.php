<?php

class insertContent extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('addContent');
    }

    function index() {
        $headingContent = $this->input->post('headingContent');
        $bodyContent = $this->input->post('bodyContent');
        $desc = $this->input->post('desc');
        $key = $this->input->post('keyword');
        $insertData = $this->addContent->insertContent($headingContent, $bodyContent, $desc, $key);
        if (!empty($insertData)) {
            $this->load->helper('url');
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Record Inserted');
            redirect('admin/contentManagement', 'refresh');
        }
    }

}
