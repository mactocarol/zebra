<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model  {

	function isValidToken($authToken){

        $this->db->select('*');
        $this->db->where('authToken',$authToken);
        if($sql = $this->db->get(USERS)){
            if($sql->num_rows() > 0){
                return $sql->row();
            }
        }
        return false;
    }
}


