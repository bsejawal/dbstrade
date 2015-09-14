<?php

class cropImage extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->library('session'); // something like session start
        $this->load->helper('url'); // Helps to get base url defined in config.php
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

    public function index() {
        $imgPath = $this->input->post('imgPath');
        $coordX = $this->input->post('x');
        $coordY = $this->input->post('y');
        $coordW = $this->input->post('w');
        $coordH = $this->input->post('h');
        $this->cropImage($imgPath, $coordX, $coordY, $coordW, $coordH);
    }

    public function getMime($imgPath) {
        $mime = getimagesize($imgPath);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($imgPath);
        }
        if ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($imgPath);
        }
        if ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        }
        if ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        }
        return array($src_img, $mime);
    }

    public function fileCheck($imgFile) {
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

    public function fileUpload($imgFile) {
        $file_path = 'images/uploads/' . basename($imgFile["name"]);
        if ($this->fileExists($file_path)) {
            if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
                return $file_path;
            } else {
                $this->session->set_flashdata('error', 'File can not be uploaded');
                redirect('admin/showSlider', 'refresh');
                exit();
            }
        } else {
            $this->session->set_flashdata('error', 'Same file cannot be uploaded twice');
            redirect('admin/showSlider', 'refresh');
        }
    }

    public function fileExists($file_path) {
        if (!file_exists($file_path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function uploadImage() {
        $filePath = $_FILES['imgFile'];
        $imgPath = $this->fileCheck($filePath);
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data [1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = $img_height / $img_width;
        $img_width_new = 700;
        $img_height_new = $img_width_new * $new_size;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        $background = imagecolorallocate($new_image, 0, 0, 0);
        imagecolortransparent($new_image, $background);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $new_file_path = 'images/uploads/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime, 'upload');
    }

    public function cropImage($imgPath, $coordX, $coordY, $coordW, $coordH) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data [1];
        $img_width_new = 700;
        $img_height_new = 300;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        imagecopyresampled($new_image, $src_img, 0, 0, $coordX, $coordY, $coordW, $coordH, $img_width_new, $img_height_new); // New save location
        $new_file_path = 'images/slideShow/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime, 'slide');
    }

    public function create_image($new_image, $new_file_path, $mime, $path) {
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($new_image, $new_file_path, 9);
        }
        if ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($new_image, $new_file_path, 90);
        }
        if ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($new_image, $new_file_path, 90);
        }
        if ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($new_image, $new_file_path, 90);
        }
        if ($path == 'slide') {
            $this->session->set_flashdata('success', 'Image crop successful');
            redirect('admin/showSlider', 'refresh');
        } elseif ($path == 'upload') {
            $this->session->set_flashdata('success', 'Upload success');
            redirect('admin/showSlider', 'refresh');
        }
    }

    function deleteImage() {
        $filename = $this->input->get('img');
        if (unlink('images/uploads/' . $filename)) {
            if (file_exists('images/slideShow/' . $filename)) {
                unlink('images/slideShow/' . $filename);
            }
            $this->session->set_flashdata('success', 'Image deleted successfully');
            redirect('admin/showSlider', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Image cannot be deleted');
            redirect('admin/showSlider', 'refresh');
        }
    }

}
