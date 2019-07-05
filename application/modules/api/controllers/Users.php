<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CommonService {
	
	public function __construct(){
		parent::__construct();
		$this->check_service_auth();
		$this->load->model('Users_model');
	}

	function maximumCheck($num){
	    if($num > 5){
	        $this->form_validation->set_message('maximumCheck','The %s field must be less than 6');
	        return FALSE;
	    }else if($num < 1){
	        $this->form_validation->set_message('maximumCheck','The %s field must be greater than 0');
	        return FALSE;
	    }else{
	        return TRUE;
	    }
	}

	function sendReview_post(){
		
		$this->load->library('form_validation');
		$postData = $this->input->post();

		$this->form_validation->set_rules('userId','User Id','trim|required|xss_clean');
		$this->form_validation->set_rules('orderId','Order Id','trim|required|xss_clean');
		$this->form_validation->set_rules('review','Review','trim|required|xss_clean');
		$this->form_validation->set_rules('rating','Rating','trim|required|xss_clean|callback_maximumCheck');

		if($this->form_validation->run() == FALSE){
            $response = array(
            	'status'  => FAIL,
            	'message' => strip_tags(validation_errors())
            );
        }else{

        	$insertData = array(
				'senderId'   => $this->authData->userId,
				'receiverId' => $postData['userId'],
				'rating'     => $postData['rating'],
				'review'     => $postData['review'],
				'orderId'    => $postData['orderId'],
        	);

        	$where = array(
        		'orderId'    => $postData['orderId'],
        	);

        	$checkRating = $this->common_model->getSingleData('*',RATING,$where);
        	
        	if(!empty($checkRating)){
	        	$response = array(
	            	'status'  => FAIL,
	            	'message' => ResponseMessages::getStatusCodeMessage(706),
	            );
        	}else{
        		$ratingId = $this->common_model->insertData(RATING,$insertData);
	        	$response = array(
	            	'status'   => SUCCESS,
	            	'message'  => ResponseMessages::getStatusCodeMessage(705),
	            	'ratingId' => $ratingId,
	            );
        	}
        }
        $this->response($response);
	}

	function addBankAccount_post(){
		$this->load->library('form_validation');
		$postData = $this->input->post();

		$this->form_validation->set_rules('holderName','Holder Name','trim|required|xss_clean');
		$this->form_validation->set_rules('dob','Date of Birth','trim|required|xss_clean');
		$this->form_validation->set_rules('country','Country','trim|required|xss_clean');
		$this->form_validation->set_rules('routingNumber','Routing Number','trim|required|xss_clean');
		$this->form_validation->set_rules('accountNumber','Account Number','trim|required|xss_clean');
		$this->form_validation->set_rules('address','Address','trim|required|xss_clean');
		$this->form_validation->set_rules('postalCode','Postal Code','trim|required|xss_clean');
		$this->form_validation->set_rules('city','City','trim|required|xss_clean');
		$this->form_validation->set_rules('state','State','trim|required|xss_clean');
		$this->form_validation->set_rules('ssnLast','Ssn Last','trim|required|xss_clean');
		$this->form_validation->set_rules('currency','Currency','trim|required|xss_clean');
		


		if($this->form_validation->run() == FALSE){
            $response = array(
            	'status'  => FAIL,
            	'message' => strip_tags(validation_errors())
            );
        }else{

        	$postData['accNo'] = substr($postData['accountNumber'], -4);
        	$postData['routNo'] = substr($postData['routingNumber'], -4);
        	$postData['userId'] = $this->authData->userId;

        	$postData['accountNumber'] = $this->encryption->encrypt($postData['accountNumber']);
        	$postData['routingNumber'] = $this->encryption->encrypt($postData['routingNumber']);
        	$postData['ssnLast']       = $this->encryption->encrypt($postData['ssnLast']);

        	$where = array(
        		'userId' => $this->authData->userId,
        	);

        	$checkBank = $this->common_model->getSingleData('*',BANKACCOUNT,$where);
           
        	if(!empty($checkBank)){
        		$this->common_model->updateRecord($where,BANKACCOUNT,$postData);
        		$status = 153;
        	}else{
        		$this->common_model->insertData(BANKACCOUNT,$postData);
        		$status = 126;
        	}

			$response = array(
				'status'   => SUCCESS,
				'message'  => ResponseMessages::getStatusCodeMessage($status),
			);
        }
        $this->response($response);
	}

	function getBankDetail_post(){
		$where = array(
			'userId' => $this->authData->userId,
		);

		$password = $this->input->post('password');

		$bankDetail = $this->common_model->getSingleData('*',BANKACCOUNT,$where);

		if(isset($password) && !empty($password)){
			$checkPassword = $this->common_model->getSingleData('password',USERS,$where);
			if(password_verify($password, $checkPassword['password'])){
				$bankDetail['accountNumber'] = $this->encryption->decrypt($bankDetail['accountNumber']);
				$bankDetail['routingNumber'] = $this->encryption->decrypt($bankDetail['routingNumber']);
				$bankDetail['ssnLast']       = $this->encryption->decrypt($bankDetail['ssnLast']);
			}else{
				$bankDetail = '';
			}
		}

		if(!empty($bankDetail)){
			$response = array(
				'status'     => SUCCESS,
				'message'    => ResponseMessages::getStatusCodeMessage(200),
				'bankDetail' => $bankDetail,
			);
		}else{
			$response = array(
				'status'     => FAIL,
				'message'    => ResponseMessages::getStatusCodeMessage(158),
				'bankDetail' => (Object)array(),
			);
		}
		$this->response($response);
	}

	function logout_post(){
		$where = array(
			'userId' => $this->authData->userId,
		);

		$update = array(
			'deviceType'   => '',
			'deviceToken'  => '',
			'onlineStatus' => 'Offline',
			'authToken'    => authToken(),
		);
		$this->common_model->updateRecord($where,USERS,$update);

		$response = array(
			'status'     => SUCCESS,
			'message'    => ResponseMessages::getStatusCodeMessage(106),
		);
		$this->response($response);
	}
}
