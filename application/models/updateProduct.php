<?php

Class updateProduct extends CI_Model {

    function updateContent($contentId, $title, $desc, $imgPath) {
        $data = array(
            'id' => $contentId,
            'title' => $title,
            'desc' => $desc,
            'imgPath' => $imgPath
        );

        $this->db->where('id', $contentId);
        if ($this->db->update('product', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

}
