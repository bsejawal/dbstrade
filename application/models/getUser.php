<?php

Class getUser extends CI_Model {

    function login($username, $password) {
        $this->db->select('id, name, gender, username, password, role');
        $this->db->from('user_info');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

}
