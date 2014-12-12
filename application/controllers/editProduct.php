<?php

class editProduct extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('updateProduct');
    }

    function index() {
        $contentId = $this->input->post('contentId');
        $title = $this->input->post('title');
        $desc = $this->input->post('desc');
        $imgPath = $this->input->post('imgPath');
        $updateData = $this->updateProduct->updateContent($contentId, $title, $desc, $imgPath);
        if (!empty($updateData)) {
            $this->load->helper('url');
            $this->load->library('session');
            $this->session->set_flashdata('success', 'Record Updated');
            redirect('admin/productManagement', 'refresh');
        }
    }

}
