<?php

class productManagement extends CI_Controller {

    function __construct() {
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
        $page = 'productManagement';
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
        $data['Product'] = $this->getProductInfo($dataPerPage);
        $totalData = $this->getProdPage();
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

    public function addProduct() {
        $page = 'addProduct';
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
        $data['category'] = $this->getCategory();
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function insertProduct() {
        $this->load->model('insert');
        $titleProduct = $this->input->post('titleProduct');
        $category = $this->input->post('category');
        $desc = $this->input->post('desc');
        $imgFile = $_FILES['imgFile'];
        $date = date("Y-m-d H:i:s");
        $filePath = $this->fileCheck($imgFile);
        if (isset($filePath)) {
            $insertData = $this->insert->insertProduct($titleProduct, $category, $desc, $filePath, $date);
            if (!empty($insertData)) {
                $this->session->set_flashdata('success', 'Product Added');
                redirect('admin/productManagement', 'refresh');
            }
        }
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
        $file_path = 'images/product/' . basename($imgFile["name"]);
        if ($this->fileExists($file_path)) {
            if (move_uploaded_file($imgFile["tmp_name"], $file_path)) {
                $this->resizeImage($file_path);
                return $file_path;
            } else {
                $this->session->set_flashdata('error', 'File can not be uploaded');
                redirect('admin/addProduct', 'refresh');
                exit();
            }
        } else {
            $this->session->set_flashdata('error', 'Same file cannot be uploaded twice');
            redirect('admin/addProduct', 'refresh');
        }
    }

    public function fileExists($file_path) {
        if (!file_exists($file_path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function resizeImage($imgPath) {
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
        $new_file_path = 'images/product/' . basename($imgPath);
        return $this->create_image($new_image, $new_file_path, $mime, 'upload');
    }

    public function getCategory() {
        $this->load->model('get');
        $totalData = $this->get->getCategory();
        foreach ($totalData as $finalInfo) {
            $info[] = array('category' => $finalInfo->category);
        }
        if (!empty($info)) {
            return $info;
        } else {
            return FALSE;
        }
    }

    public function getProductInfo($dataPerPage) {
        $this->load->model('get');
        if (!empty($this->input->get('page'))) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }
        $productInfo = $this->get->getProductInfo($page, $dataPerPage); // calling model
        if ($page > 1) {
            $i = (($page - 1) * $dataPerPage) + 1;
        } else {
            $i = 1;
        }
        foreach ($productInfo as $getProduct) {
            $status = $this->checkThumb($getProduct->imgPath);
            if (empty($status)) {
                $thumbPath = $this->createThumbnail($getProduct->imgPath);
            } else {
                $thumbPath = $status;
            }
            $info[] = array('sn' => $i++, 'id' => $getProduct->id, 'title' => $getProduct->title, 'category' => $getProduct->category, 'desc' => $getProduct->desc, 'imgPath' => base_url() . $thumbPath);
        }
        if (!empty($info)) {
            return $info;
        } else {
            return FALSE;
        }
    }

    public function getProdPage() {
        $this->load->model('get');
        $totalData = count($this->get->allData('product')); // calling model
        return $totalData;
    }

    public function editProdInfo() {
        $page = 'editProdInfo';
        $this->checkFilepath($page, 'admin');
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        $data['id'] = $this->checkAccess();
        $userData = $this->getUserInfo($data['id']);
        $data['name'] = $userData['name'];
        $data['username'] = $userData['username'];
        $data['gender'] = $userData['gender'];
        $data['role'] = $userData['role'];
        $data['category'] = $this->getCategory();
        $editData = $this->editProduct($this->input->get('id'));
        $data['id'] = $editData[0];
        $data['prodTitle'] = $editData[1];
        $data['editCate'] = $editData[2];
        $data['desc'] = $editData[3];
        $data['imgPath'] = base_url() . $editData[4];
        $data['mainPath'] = $editData[5];
        $data['footerData'] = $this->getFooter();
        $this->loadView($data, $page);
    }

    public function updateProduct() {
        $this->load->model('update');
        $contentId = $this->input->post('contentId');
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        if ($this->input->post('imgDelete')) {
            $rmImage = $this->input->post('imgPath');
            unlink('images/product/' . basename($rmImage));
            $imgFile = $_FILES['imgFile'];
            $imgPath = $this->fileCheck($imgFile);
        } else {
            $imgPath = $this->input->post('imgPath');
        }
        $desc = $this->input->post('desc');
        $updateData = $this->update->updateProduct($contentId, $title, $category, $desc, $imgPath);
        if (!empty($updateData)) {
            $this->session->set_flashdata('success', 'Record Updated');
            redirect('admin/productManagement', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Record cannot be updated');
            redirect('admin/productManagement', 'refresh');
        }
    }

    public function editProduct($id) {
        $this->load->model('get');
        $prodData = $this->get->getProdId($id); // calling model
        foreach ($prodData as $prodInfo) {
            $id = $prodInfo->id;
            $prodTitle = $prodInfo->title;
            $category = $prodInfo->category;
            $desc = $prodInfo->desc;
            $mainPath = $prodInfo->imgPath;
            $status = $this->checkThumb($mainPath);
            if (empty($status)) {
                $thumbPath = $this->createThumbnail($mainPath);
            } else {
                $thumbPath = $status;
            }
        }
        return array($id, $prodTitle, $category, $desc, $thumbPath, $mainPath);
    }

    public function deleteProdInfo() {
        $this->load->model('get');
        $imgPath = $this->get->getProductImg($this->input->get('id'));
        $deleteInfo = $this->deleteProd($this->input->get('id'));
        foreach ($imgPath as $img) {
            $path = $img->imgPath;
        }
        if ($deleteInfo == TRUE) {
            unlink($path);
            $this->session->set_flashdata('success', 'Record Deleted');
            redirect('admin/productManagement', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Record cannot be deleted');
            redirect('admin/productManagement', 'refresh');
        }
    }

    public function deleteProd($id) {
        $this->load->model('delete');
        $contactData = $this->delete->deleteProd($id); // calling model
        return $contactData;
    }

    public function checkThumb($imgPath) {
        $files = scandir('images/thumb/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } elseif ($file == basename($imgPath)) {
                return 'images/thumb/' . basename($imgPath);
            } else {
                continue;
            }
        }
        return NULL;
    }

    public function getMime($imgPath) {
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
        return array($src_img, $mime);
    }

    public function createThumbnail($imgPath) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data [1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = ($img_width + $img_height) / ( $img_width * ($img_height / 200));
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
