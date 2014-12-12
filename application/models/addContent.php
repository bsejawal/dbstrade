<?php

Class addContent extends CI_Model {

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

}
