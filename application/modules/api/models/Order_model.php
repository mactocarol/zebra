<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model  {

	function getOrder($userId,$latitude,$longitude,$status){
		switch ($status) {
		    case "New":
		        $where    = array('driverId' => 0);
		        $where_in = array('New');
		        $having   = 100;
		        break;
		    case "myOrder":
		        $where    = array('driverId' => $userId);
		        $where_in = array('Accept','Picked','Delivered');
		        $having   = 1000;
		        break;
		    case "myDelivered":
		        $where    = array('driverId' => $userId);
		        $where_in = array('Delivered');
		        $having   = 1000;
		        break;
		    default:
		        return array();
		        break;
		}
		
		$userImagePath = base_url().'uploads/userImage/';
        $base_url = base_url();

		$order = $this->db
		->select(
			'
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
            END ) as userProfileThumb,'.
            
            USERS.'.userId,firstName,lastName,businessName,businessType,mobileNumber,'.
            
            ORDER.'.*,

            (
			3959*acos(cos(radians('.$latitude.'))*cos(radians(pickupLatitude))*cos(radians(pickupLongitude )-radians('.$longitude.'))+sin(radians('.$latitude.'))*sin(radians(pickupLatitude)))
			) AS distance'

		)
		->join(USERS,USERS.'.userId = '.ORDER.'.userId')
		->having(array('distance <=' => $having))
		->where($where)
		->where_in('orderStatus',$where_in)
		->get(ORDER)
		->result_array();
		return $order;
	}

}


