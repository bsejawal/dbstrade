<?php

Class getProductInfo extends CI_Model {

    function product($page, $dataPerPage) {
        $start = ($page - 1) * $dataPerPage;
        $this->db->select('id, title, desc, imgPath');
        $this->db->from('product');
        $this->db->limit($dataPerPage, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function allData() {
        $this->db->select('id');
        $this->db->from('product');
        $query = $this->db->get();
        return $query->result();
    }

}
