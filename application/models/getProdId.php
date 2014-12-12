<?php

Class getProdId extends CI_Model {

    function content($id) {
        $this->db->select('id, title, desc, imgPath');
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

}
