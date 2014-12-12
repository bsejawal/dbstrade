<?php

Class getId extends CI_Model {

    function content($id) {
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

}
