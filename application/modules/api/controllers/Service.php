<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CommonService {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Service_model');
	}

	function registration_post(){

		$this->load->library('form_validation');
		$postData = $this->input->post();

		$this->form_validation->set_rules('firstName','First Name','trim|required|xss_clean');
		$this->form_validation->set_rules('lastName','Last Name','trim|required|xss_clean');
		$this->form_validation->set_rules('mobileNumber','Mobile Number','trim|required|is_unique[users.mobileNumber]|xss_clean');
		$this->form_validation->set_rules('userType','User Type','trim|required|xss_clean'); //(Customer,Driver)
		$this->form_validation->set_rules('deliverAlcohol','Deliver Alcohol','trim|required|xss_clean'); //(Yes,No)
		$this->form_validation->set_rules('deviceType','Device Type','trim|required|xss_clean'); //(Ios,Android)
		$this->form_validation->set_rules('deviceToken','Device Token','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[15]|xss_clean');
		$this->form_validation->set_rules('deviceType','Device Type','trim|required|xss_clean');
		$this->form_validation->set_rules('deviceToken','Device Token','trim|required|xss_clean');
		
		if($postData['userType'] == 'Customer'){
			$this->form_validation->set_rules('businessName','Business Name','trim|required|xss_clean');
			$this->form_validation->set_rules('businessType','Business Type','trim|required|xss_clean'); //(Busness,Individual)
		}else{
			$this->form_validation->set_rules('vehicleType','Vehicle Type','trim|required|xss_clean');
			$this->form_validation->set_rules('homeAddress','Home Address','trim|required|xss_clean');
			$this->form_validation->set_rules('latitude','Latitude','trim|required|xss_clean');
			$this->form_validation->set_rules('longitude','Longitude','trim|required|xss_clean');
		}

        if($this->form_validation->run() == FALSE){
            $response = array(
            	'status'  => FAIL,
            	'message' => strip_tags(validation_errors()));
        }else{
        	
        	$postData['password'] = password_hash($postData['password'],PASSWORD_DEFAULT);
        	
        	if(isset($_FILES['userProfile']) && !empty($_FILES['userProfile'])){
        		$image = $this->image_model->updateMedia('userProfile','userImage');
        		if(isset($image['error']) && !empty($image['error'])){
        			$response = array(
        				'status'  => FAIL,
        				'message' => $image['error']
        			);
        		}else{
        			$postData['userProfile']  = $image;
        		}
        	}else{
				$response = array(
					'status' => FAIL,
					'message' => 'Please Select Profile Image'
				);
        	}

        	$postData['authToken'] = authToken();
        	$userId = $this->common_model->insertData(USERS,$postData);

			$select = '*';
			$where = array('userId' => $userId);
        	$userDetail = $this->common_model->getUserDetail($select,USERS,$postData);
        	
			$response = array(
				'status' => SUCCESS,
				'message' => ResponseMessages::getStatusCodeMessage(110),
				'userDetail' => $userDetail,
			);
        }
        $this->response($response);
	}

	function login_post(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email','Email','trim|required|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|xss_clean');
		$this->form_validation->set_rules('userType','User Type','trim|required|xss_clean'); //(Customer,Driver)
		$this->form_validation->set_rules('deviceType','Device Type','trim|required|xss_clean');//(Ios,Android)
		$this->form_validation->set_rules('deviceToken','Device Token','trim|required|xss_clean');
		
        if($this->form_validation->run() == FALSE){
            $response = array(
            	'status'  => FAIL,
            	'message' => strip_tags(validation_errors())
            );
        }else{
        	$postData = $this->input->post();

        	$where = array(
        		'email'    => $postData['email'],
        		'userType' => $postData['userType'],
        	);

        	$checkMail = $this->common_model->getSingleData('userId,password',USERS,$where);
        	if(isset($checkMail) && !empty($checkMail)){
        		if(password_verify($postData['password'], $checkMail['password'])){
					$update = array(
						'deviceType'   => $postData['deviceType'],
						'deviceToken'  => $postData['deviceToken'],
						'onlineStatus' => 'Online',
						'authToken'    => authToken(),
					);
	        		$this->common_model->updateRecord($where,USERS,$update);

					$select = '*';
					$where = array('userId' => $checkMail['userId']);
		        	$userDetail = $this->common_model->getUserDetail($select,USERS,$where);
					
					$response = array(
						'status' => SUCCESS,
						'message' => ResponseMessages::getStatusCodeMessage(106),
						'userDetail' => $userDetail,
					);
				}else{
					$response = array(
						'status'     => FALSE,
						'message'    => ResponseMessages::getStatusCodeMessage(105),
						'userDetail' => array(),
					);
				}
        	}else{
				$response = array(
					'status'     => FALSE,
					'message'    => ResponseMessages::getStatusCodeMessage(105),
					'userDetail' => array(),
				);
        	}
        }
        $this->response($response);
	}
}
