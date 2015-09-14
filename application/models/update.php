<?php

Class update extends CI_Model {

    function updateInfo($contentId, $headingContact, $bodyContact) {
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

    function updateProduct($contentId, $title, $category, $desc, $imgPath) {
        $data = array(
            'id' => $contentId,
            'title' => $title,
            'category' => $category,
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

    function updateCategory($cateId, $category, $desc) {
        $data = array(
            'category' => $category,
            'description' => $desc,
        );

        $this->db->where('id', $cateId);
        if ($this->db->update('category', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

    function updateUser($userId, $name, $email, $gender, $username) {
        $data = array(
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'gender' => $gender,
            'username' => $username
        );

        $this->db->where('id', $userId);
        if ($this->db->update('user_info', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

    function updatePassword($userId, $newPassword) {
        $data = array(
            'password' => $newPassword
        );

        $this->db->where('id', $userId);
        if ($this->db->update('user_info', $data)) {
            return TRUE;
        } else {
            return false;
        }
    }

}
