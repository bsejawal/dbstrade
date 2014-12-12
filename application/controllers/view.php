<?php

class View extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->clear_cache();
        $this->load->database();
        $this->load->helper('url'); // Helps to get base url defined in config.php
    }

    public function checkFilepath($page, $area) {
        if (!file_exists(APPPATH . '/views/' . $page . '.php') && $area == 'user') {
            show_404();
        }
        if (!file_exists(APPPATH . '/views/admin/' . $page . '.php') && $area == 'admin') {
            show_404();
        }
    }

    public function index($page) {
        $this->checkFilepath($page, 'user');
        if ($page == 'home') {
            $this->cleanUpThumb();
            $data['productData'] = $this->getProduct();
        } elseif ($page == 'about') {
            $data['aboutData'] = $this->getAbout();
        } elseif ($page == 'contact') {
            $data['contactData'] = $this->getContact();
        }
        $data['footerData'] = $this->getFooter();
        $this->loadView_user($data, $page);
    }

    public function getProduct() {
        $this->load->model('getProduct');
        $prodData = $this->getProduct->products(); // calling model
        foreach ($prodData as $Product) {
            $thumbPath = $this->createThumbnail($Product->imgPath);
            $info[] = array('id' => $Product->id, 'title' => $Product->title, 'desc' => $Product->desc, 'imgPath' => base_url() . $thumbPath);
        }
        return $info;
    }

    public function getAbout() {
        $this->load->model('getAbout');
        $aboutData = $this->getAbout->getContent(); // calling model
        foreach ($aboutData as $aboutInfo) {
            $info[] = array('heading' => $aboutInfo->heading, 'content' => $aboutInfo->content);
        }
        return $info;
    }

    public function getContact() {
        $this->load->model('getContact');
        $contactData = $this->getContact->getContent(); // calling model
        foreach ($contactData as $contactInfo) {
            $info[] = array('heading' => $contactInfo->heading, 'content' => $contactInfo->content);
        }
        return $info;
    }

    public function loadView_user($data, $page) {
        $data['title'] = ucfirst($page);
        $this->load->view('templates/header', $data);
        $this->load->view($page);
        $this->load->view('templates/footer');
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
        $status = $this->session->userdata('username'); // gets session data
        if (!empty($status)) {
            return $status;
        } else {
            redirect('login', 'refresh');
        }
    }

    public function admin($page) {
        $dataPerPage = 10;
        $this->checkFilepath($page, 'admin');
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        if ($page != 'login') {
            $data['username'] = $this->checkAccess();
            $data['name'] = $this->session->userdata('name');
            $data['gender'] = $this->session->userdata('gender');
            $data['role'] = $this->session->userdata('role');
        }
        if ($page == 'editInfo') {
            $editData = $this->editContent($this->input->get('id'));
            $data['id'] = $editData[0];
            $data['heading'] = $editData[1];
            $data['content'] = $editData[2];
        }
        if ($page == 'contentManagement') {
            $data['getInfo'] = $this->getInfo($dataPerPage);
            $totalData = $this->getContPage();
            $data['num_pages'] = ceil($totalData / $dataPerPage);
        }
        if ($page == 'productManagement') {
            $data['Product'] = $this->getProductInfo($dataPerPage);
            $totalData = $this->getProdPage();
            $data['num_pages'] = ceil($totalData / $dataPerPage);
        }
        if ($page == 'editProdInfo') {
            $editData = $this->editProduct($this->input->get('id'));
            $data['id'] = $editData[0];
            $data['prodTitle'] = $editData[1];
            $data['desc'] = $editData[2];
            $data['imgPath'] = base_url() . $editData[3];
            $data['mainPath'] = $editData[4];
        }
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function getFooter() {
        $this->load->model('getFooter');
        $footerData = $this->getFooter->getContent(); // calling model
        foreach ($footerData as $footerInfo) {
            $info = $footerInfo->content;
        }
        return $info;
    }

    public function getInfo($dataPerPage) {
        $this->load->model('getInfo');
        if (!empty($this->input->get('page'))) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }
        $infoData = $this->getInfo->info($page, $dataPerPage); // calling model
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
        $this->load->model('getInfo');
        $totalData = count($this->getInfo->allData()); // calling model
        return $totalData;
    }

    public function getProductInfo($dataPerPage) {
        $this->load->model('getProductInfo');
        $this->cleanUpThumb();
        if (!empty($this->input->get('page'))) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }
        $productInfo = $this->getProductInfo->product($page, $dataPerPage); // calling model
        if ($page > 1) {
            $i = (($page - 1) * $dataPerPage) + 1;
        } else {
            $i = 1;
        }
        foreach ($productInfo as $getProduct) {
            $imgPath = $getProduct->imgPath;
            $thumbPath = $this->createThumbnail($imgPath);
            $info[] = array('sn' => $i++, 'id' => $getProduct->id, 'title' => $getProduct->title, 'desc' => $getProduct->desc, 'imgPath' => base_url() . $thumbPath);
        }
        return $info;
    }

    public function getProdPage() {
        $this->load->model('getProductInfo');
        $totalData = count($this->getProductInfo->allData()); // calling model
        return $totalData;
    }

    public function editContent($id) {
        $this->load->model('getId');
        $contactData = $this->getId->content($id); // calling model
        foreach ($contactData as $contactInfo) {
            $id = $contactInfo->id;
            $heading = $contactInfo->heading;
            $content = $contactInfo->content;
        }
        return array($id, $heading, $content);
    }

    public function editProduct($id) {
        $this->load->model('getProdId');
        $prodData = $this->getProdId->content($id); // calling model
        foreach ($prodData as $prodInfo) {
            $id = $prodInfo->id;
            $prodTitle = $prodInfo->title;
            $desc = $prodInfo->desc;
            $mainPath = $prodInfo->imgPath;
            $this->cleanUpThumb();
            $thumbPath = $this->createThumbnail($mainPath);
        }
        return array($id, $prodTitle, $desc, $thumbPath, $mainPath);
    }

    public function createThumbnail($imgPath) {
        $mime = getimagesize($imgPath);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($imgPath);
        } elseif ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($imgPath);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        }
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = ($img_width + $img_height) / ($img_width * ($img_height / 60));
        $img_width_new = $img_width * $new_size;
        $img_height_new = $img_height * $new_size;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        $background = imagecolorallocate($new_image, 0, 0, 0);
        imagecolortransparent($new_image, $background);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $new_file_path = 'images/thumb/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime);
    }

    public function create_image($new_image, $new_file_path, $mime) {
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($new_image, $new_file_path, 9);
        } elseif ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        }
        return $new_file_path;
    }

    public function loadView($data, $page) {
        $data['title'] = ucfirst($page); // sets title of the page
        $this->load->view('templates/header', $data);
        $this->load->view('admin/' . $page);
        $this->load->view('templates/footer', $data);
    }

    public function cleanUpThumb() {
        $files = glob('images/thumb/*'); // get all file names
        foreach ($files as $file) { // iterate files
            unlink($file); // delete file
        }
    }

    function clear_cache() { // this fucntion clears browser cache to prevent reloging into system after logout
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}
