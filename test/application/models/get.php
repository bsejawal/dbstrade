<?php

class get extends CI_Model {

    function allData($table) {
        $this->db->select('id');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserInfo($id) {
        $this->db->select('name, gender, username, password, role');
        $this->db->from('user_info');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    // user side models start
    function searchProduct($category) {
        $this->db->select('id, title, category, desc, imgPath');
        $this->db->from('product');
        $this->db->where('category', $category);
        $query = $this->db->get();
        return $query->result();
    }

    function searchAll($keyword) {
        $this->db->select('id, title, category, desc, imgPath');
        $this->db->from('product');
        $this->db->or_like('title', $keyword);
        $this->db->or_like('category', $keyword);
        $this->db->or_like('desc', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

    function getProduct($page, $dataPerPage) {
        $start = ($page - 1) * $dataPerPage;
        $this->db->select('id, title, desc, imgPath');
        $this->db->from('product');
        $this->db->order_by("date", "desc");
        $this->db->limit($dataPerPage, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function prodReadMore($id) {
        $this->db->select('title, desc, imgPath');
        $this->db->from('product');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getContact() {
        $this->db->select('heading, content');
        $this->db->from('info');
        $this->db->where('keyword', 'contact');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getAbout() {
        $this->db->select('heading, content');
        $this->db->from('info');
        $this->db->where('keyword', 'about');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    // user side model end

    function getUserLogin($username, $password) {
        $this->db->select('id, name, gender, username, password, role');
        $this->db->from('user_info');
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getFooter() {
        $this->db->select('content');
        $this->db->from('info');
        $this->db->where('keyword', 'copyright');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getId($id) {
        $this->db->select('id, heading, content');
        $this->db->from('info');
        $this->db->where('id', $id);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getInfo($page, $dataPerPage) {
        $start = ($page - 1) * $dataPerPage;
        $this->db->select('id, heading, content, description');
        $this->db->from('info');
        $this->db->limit($dataPerPage, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getProdId($id) {
        $this->db->select('id, title, category, desc, imgPath');
        $this->db->from('product');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getProductInfo($page, $dataPerPage) {
        $start = ($page - 1) * $dataPerPage;
        $this->db->select('id, title, category, desc, imgPath');
        $this->db->from('product');
        $this->db->limit($dataPerPage, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getProductImg($id) {
        $this->db->select('imgPath');
        $this->db->from('product');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getCategory($page = NUll, $dataPerPage = NULL) {
        $start = ($page - 1) * $dataPerPage;
        $this->db->select('id, category, description');
        $this->db->from('category');
        if ($page != NULL && $dataPerPage != NULL) {
            $this->db->limit($dataPerPage, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getCategoryId($id) {
        $this->db->select('id, category, description');
        $this->db->from('category');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}
