<?php

Class addProduct extends CI_Model {

    function insertProduct($title, $desc, $imgPath) {
        $data = array(
            'title' => $title,
            'desc' => $desc,
            'imgPath' => $imgPath
        );

        if ($this->db->insert('product', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

}
