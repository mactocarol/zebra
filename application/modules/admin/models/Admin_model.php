<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Admin_model extends CI_Model {
    
    function loginAdmin($postData){
        $data = $this->db->get_where(ADMIN,array('email' => $postData['loginEmail'],'password' => $postData['loginPassword']))->row_array();
        if(isset($data) && !empty($data)){
            $_SESSION[ADMIN_USER_SESS_KEY] = $data;
            return 1;
        }
        return 0;
    }
}