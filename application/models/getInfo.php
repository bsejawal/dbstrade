<?php

Class getInfo extends CI_Model {

    function info($page, $dataPerPage) {
        $start = ($page - 1) * $dataPerPage;
        $this->db->select('id, heading, content, description');
        $this->db->from('info');
        $this->db->limit($dataPerPage, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function allData() {
        $this->db->select('id');
        $this->db->from('info');
        $query = $this->db->get();
        return $query->result();
    }

}
