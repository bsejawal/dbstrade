<?php

class insertProduct extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session');
        $this->load->model('addProduct');
    }

    function index() {
        $titleProduct = $this->input->post('titleProduct');
        $desc = $this->input->post('desc');
        $imgFile = $_FILES['imgFile'];
        $filePath = $this->fileCheck($imgFile);
        if (isset($filePath)) {
            $insertData = $this->addProduct->insertProduct($titleProduct, $desc, $filePath);
            if (!empty($insertData)) {
                $this->load->helper('url');
                $this->load->library('session');
                $this->session->set_flashdata('success', 'Product Added');
                redirect('admin/productManagement', 'refresh');
            }
        }
    }

    function fileCheck($imgFile) {
        if (isset($imgFile)) {
            $check = getimagesize($imgFile["tmp_name"]);
            if ($check !== false) {
                return $this->fileUpload($imgFile);
            } else {
                $this->session->set_flashdata('error', 'File is not an image');
                redirect('admin/addProduct', 'refresh');
            }
        } else {
            echo "File not selected";
        }
    }

    function fileUpload($imgFile) {
        $file_path = 'images/product/' . basename($imgFile["name"]);
        if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
            return base_url() . $file_path;
        } else {
            echo "Sorry file cannot be uploaded";
        }
    }

}
