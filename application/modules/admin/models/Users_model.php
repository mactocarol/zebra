<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    function countUser($where){
    	$count = $this->db->select('COUNT(userId) as count')->get_where(USERS,$where)->row_array();
    	return $count['count'];
    }

    function userList($limit,$start,$where){
    	$userImagePath = base_url().'uploads/userImage/';
        $base_url = base_url();
    	$data = $this->db
    	->select('*,
            (CASE 
                WHEN( '.USERS.'.userProfile = "" OR '.USERS.'.userProfile IS NULL) 
                    THEN "'.$base_url.'uploads/defaultimage/user.png"
                WHEN '.USERS.'.userProfile LIKE "%//%" 
                    THEN '.USERS.'.userProfile
                ELSE
                    CONCAT("'.$userImagePath.'",'.USERS.'.userProfile) 
            END ) as userProfile,

            (CASE 
                WHEN( '.USERS.'.userProfile = "" OR '.USERS.'.userProfile IS NULL) 
                    THEN "'.$base_url.'uploads/defaultimage/thumb/user.png"
                WHEN '.USERS.'.userProfile LIKE "%//%" 
                    THEN '.USERS.'.userProfile
                ELSE
                    CONCAT("'.$userImagePath.'thumb/",'.USERS.'.userProfile) 
            END ) as userProfileThumb,
            ')
    	->get_where(USERS,$where,$limit,$start)->result_array();
    	return $data;
    }
}