<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
    
    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function getSingleData($select,$table,$where){
        $data = $this->db->select($select)->get_where($table,$where)->row_array();
        return $data;
    }

    function getData($select,$table,$where){
        $data = $this->db->select($select)->get_where($table,$where)->result_array();
        return $data;
    }

    function updateRecord($where,$table,$data){
        $this->db->where($where);
        $this->db->update($table,$data);
        return true;
    }

    function getUserDetail($select,$table,$where){
        $userImagePath = base_url().'uploads/userImage/';
        $base_url = base_url();
        
        $data = $this->db
        ->select($select.',
            
            (CASE 
                WHEN( '.$table.'.userProfile = "" OR '.$table.'.userProfile IS NULL) 
                    THEN "'.$base_url.'uploads/defaultimage/user.png"
                WHEN '.$table.'.userProfile LIKE "%//%" 
                    THEN '.$table.'.userProfile
                ELSE
                    CONCAT("'.$userImagePath.'",'.$table.'.userProfile) 
            END ) as userProfile,

            (CASE 
                WHEN( '.$table.'.userProfile = "" OR '.$table.'.userProfile IS NULL) 
                    THEN "'.$base_url.'uploads/defaultimage/thumb/user.png"
                WHEN '.$table.'.userProfile LIKE "%//%" 
                    THEN '.$table.'.userProfile
                ELSE
                    CONCAT("'.$userImagePath.'thumb/",'.$table.'.userProfile) 
            END ) as userProfileThumb,
            ')
        ->get_where($table,$where)
        ->row_array();

        return $data;
    }

    function is_data_exists($table, $where){
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        if($rowcount==0){
            return false;
        }
        else {
            return true;
        }
    }
}