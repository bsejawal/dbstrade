<?php

Class updateInfo extends CI_Model {

    function updateContent($contentId, $headingContact, $bodyContact) {
        $data = array(
            'id' => $contentId,
            'heading' => $headingContact,
            'content' => $bodyContact
        );

        $this->db->where('id', $contentId);
        if ($this->db->update('info', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

}
