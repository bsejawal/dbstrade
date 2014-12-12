<?php

class editContent extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('updateInfo');
    }

    function index() {
        $contentId = $this->input->post('contentId');
        $headingContact = $this->input->post('headingContact');
        $bodyContact = $this->input->post('bodyContact');
        $updateData = $this->updateInfo->updateContent($contentId, $headingContact, $bodyContact);
        if (!empty($updateData)) {
            $this->load->helper('url');
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Record Updated');
            redirect('admin/contentManagement', 'refresh');
        }
    }

}
