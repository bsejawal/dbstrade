<?php

Class insert extends CI_Model {

    function insertContent($headingContent, $bodyContent, $desc, $key) {
        $data = array(
            'heading' => $headingContent,
            'content' => $bodyContent,
            'description' => $desc,
            'keyword' => $key
        );

        if ($this->db->insert('info', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

    function insertProduct($title, $category, $desc, $imgPath, $date) {
        $data = array(
            'title' => $title,
            'category' => $category,
            'desc' => $desc,
            'imgPath' => $imgPath,
            'date' => $date
        );

        if ($this->db->insert('product', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

    function insertCategory($category, $description) {
        $data = array(
            'category' => $category,
            'description' => $description
        );

        if ($this->db->insert('category', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

}
