<?php

class Pages extends CI_Controller {

    public function view($page = 'home') {

        if (!file_exists(APPPATH . '/views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('pages/' . $page, $data);
        $this->load->view('templates/footer', $data);
    }

//    public function index() {
//        $this->load->view('templates/header');
//        $this->load->view('index_view');
//        $this->load->view('templates/footer');
//    }
//    
//    public function account(){
//       $this->load->view('templates/header');
//        $this->load->view('about_view');
//        $this->load->view('templates/footer'); 
//    } 
}
