<?php

class View extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->clear_cache();
        $this->load->database();
        $this->load->library('session'); // something like session start
        $this->load->helper('url'); // Helps to get base url defined in config.php
    }

    public function checkFilepath($page, $area) {
        if (!file_exists(APPPATH . '/views/' . $page . '.php') && $area == 'user') {
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

    public function index($page) {
        if ($this->getFlashdata()) {
            $data['flashData'] = $this->getFlashdata();
        }
        $dataPerPage = 9;
        $this->checkFilepath($page, 'user');
        $data['type'] = $this->getCategory();
        if ($page == 'home') {
            $data['sliderImage'] = $this->get_image();
            if (!empty($this->input->get('category'))) {
                $data['searchResult'] = $this->checkAvail($this->input->get('category'), 'category');
            } elseif (!empty($this->input->get('keyword'))) {
                $data['search'] = $this->checkAvail($this->input->get('keyword'), 'search');
            } else {
                $data['productData'] = $this->getProduct($dataPerPage);
                $totalData = $this->getAllCount();
                $data['num_page'] = ceil($totalData / $dataPerPage);
            }
        } elseif ($page == 'about') {
            $data['aboutData'] = $this->getAbout();
        } elseif ($page == 'contact') {
            $data['contactData'] = $this->getContact();
        }
        $data['footerData'] = $this->getFooter();
        $this->loadView_user($data, $page);
    }

    public function sendRequest() {
        $this->load->library('email');
        $this->load->model('get');
        $userData = $this->get->getUserInfo($id = NULL, 'yes'); // calling model
        foreach ($userData as $userInfo) {
            $email[] = $userInfo->email;
        }
        $to = implode(",", $email);
        $subject = 'Product Request';
        $message = '<table width="500px" cellspacing="0" border="1" style="font-size:15px">
            <tr>
                <td>Customer Name:</td>
                <td>' . $this->input->post('name') . '</td>
            </tr>
            <tr>
                <td>Contact Information:</td>
                <td>' . $this->input->post('contact') . '</td>
            </tr>
            <tr>
                <td>Request:</td>
                <td>' . $this->input->post('request') . '</td>
            </tr>
            <tr>
                <td>Product Name:</td>
                <td>' . $this->input->post('product') . '</td>
            </tr>
            </table>';
        $headers = 'From: DBSTradeCentre' . "\r\n" . "Content-type: text/html; charset=iso-8859-1\r\n";
        if (mail($to, $subject, $message, $headers)) {
            $this->session->set_flashdata('success', 'Message was sent successfully');
            redirect('home', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Message could not be sent');
            redirect('home', 'refresh');
        }
    }

    public function get_image() {
        $files = scandir('images/slideShow/');
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $filePath[] = $file;
            }
        }
        if (!empty($filePath)) {
            return $filePath;
        } else {
            return false;
        }
    }

    public function passGen() {
        echo sha1($this->input->post('password'));
    }

    public function search($keyword) {
        $this->load->model('get');
        $result = $this->get->searchAll($keyword);
        foreach ($result as $Product) {
            $status = $this->checkThumb($Product->imgPath);
            if (empty($status)) {
                $thumbPath = $this->createThumbnail($Product->imgPath);
            } else {
                $thumbPath = $status;
            }
            $info[] = array('keyword' => $keyword, 'id' => $Product->id, 'title' => $Product->title, 'category' => $Product->category, 'desc' => $Product->desc, 'imgPath' => base_url() . $thumbPath);
        }
        if (!empty($info)) {
            return $info;
        } else {
            return FALSE;
        }
    }

    public function checkAvail($category, $show) {
        if ($show == 'search') {
            if ($this->search($category)) {
                return $this->search($category);
            } else {
                return $category;
            }
        } else {
            if ($this->searchProduct($category)) {
                return $this->searchProduct($category);
            } else {
                return $category;
            }
        }
    }

    public function searchProduct($category) {
        $this->load->model('get');
        $searchData = $this->get->searchProduct($category);
        foreach ($searchData as $Product) {
            $status = $this->checkThumb($Product->imgPath);
            if (empty($status)) {
                $thumbPath = $this->createThumbnail($Product->imgPath);
            } else {
                $thumbPath = $status;
            }
            $info[] = array('id' => $Product->id, 'title' => $Product->title, 'category' => $Product->category, 'desc' => $Product->desc, 'imgPath' => base_url() . $thumbPath);
        }
        if (!empty($info)) {
            return $info;
        } else {
            return FALSE;
        }
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

    public function getProduct($dataPerPage) {
        $this->load->model('get');
        if (!empty($this->input->get('page'))) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }
        $prodData = $this->get->getProduct($page, $dataPerPage); // calling model
        if ($page > 1) {
            $i = (($page - 1) * $dataPerPage) + 1;
        } else {
            $i = 1;
        }
        foreach ($prodData as $Product) {
            $status = $this->checkThumb($Product->imgPath);
            if (empty($status)) {
                $thumbPath = $this->createThumbnail($Product->imgPath);
            } else {
                $thumbPath = $status;
            }
            $info[] = array('page' => $page, 'id' => $Product->id, 'title' => $Product->title, 'desc' => $Product->desc, 'imgPath' => base_url() . $thumbPath);
        }
        if (!empty($info)) {
            return $info;
        } else {
            return FALSE;
        }
    }

    public function getReadMore() {
        $id = $this->input->get('id');
        $this->load->model('get');
        $readMoreData = $this->get->prodReadMore($id);
        foreach ($readMoreData as $readMore) {
            $prodId = $readMore->id;
            $title = $readMore->title;
            $desc = $readMore->desc;
            $imgPath = $readMore->imgPath;
        }
        include APPPATH . '/views/templates/readMore.php';
    }

    public function getBookPanel() {
        $id = $this->input->get('id');
        $this->load->model('get');
        $readMoreData = $this->get->prodReadMore($id);
        foreach ($readMoreData as $readMore) {
            $title = $readMore->title;
        }
        include APPPATH . '/views/templates/bookPanel.php';
    }

    public function getAllCount() {
        $this->load->model('get');
        $totalData = count($this->get->allData('product')); // calling model
        return $totalData;
    }

    public function getAbout() {
        $this->load->model('get');
        $aboutData = $this->get->getAbout(); // calling model
        foreach ($aboutData as $aboutInfo) {
            $info[] = array('heading' => $aboutInfo->heading, 'content' => $aboutInfo->content);
        }
        return $info;
    }

    public function getContact() {
        $this->load->model('get');
        $contactData = $this->get->getContact(); // calling model
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

    public function getFooter() {
        $this->load->model('get');
        $footerData = $this->get->getFooter(); // calling model
        foreach ($footerData as $footerInfo) {
            $info = $footerInfo->content;
        }
        return $info;
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
        $mime = $data[1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = ($img_width + $img_height) / ($img_width * ($img_height / 200));
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

    public function clear_cache() { // this fucntion clears browser cache to prevent reloging into system after logout
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}
