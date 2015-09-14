<?php

Class delete extends CI_Model {

    public function deleteContent($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('info')) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function deleteProd($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('product')) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function deleteCate($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('category')) {
            return TRUE;
        } else {
            return false;
        }
    }

}
