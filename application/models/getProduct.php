<?php

Class getProduct extends CI_Model {

    function products() {
        $this->db->select('id, title, desc, imgPath');
        $this->db->from('product');
        $query = $this->db->get();
        return $query->result();
    }

}
