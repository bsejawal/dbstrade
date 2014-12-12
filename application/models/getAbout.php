<?php

Class getAbout extends CI_Model {

    function getContent() {
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

}
