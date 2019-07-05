<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CommonService {
	
	public function __construct(){
		parent::__construct();
		$this->check_service_auth();
	}

	function checkPayment_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pickupLatitude','Pickup Latitude','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupLongitude','Pickup Longitude','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryLatitude','Delivery Latitude','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryLongitude','Delivery Longitude','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryOption','Delivery Option','trim|required|xss_clean');

		if($this->form_validation->run() == FALSE){
            $response = array(
            	'status'  => FAIL,
            	'message' => strip_tags(validation_errors())
            );
        }else{
			$postData = $this->input->post();
			// M : Miles, K : Kilometers, N : Nautical Miles 
			$distance = distance($postData['pickupLatitude'],$postData['pickupLongitude'],$postData['deliveryLatitude'],$postData['deliveryLongitude'],"K");


			$extra = 0;
			if($postData['deliveryOption'] == '1hour'){
				$extra = 3;
			}else if($postData['deliveryOption'] == '2hour'){
				$extra = 1.5;
			}else if($postData['deliveryOption'] == '3hour'){
				$extra = 2;
			}

			$response = array(
				'status' => SUCCESS,
				'message' => ResponseMessages::getStatusCodeMessage(200),
				'distance' => $distance,
				'price' => Round(($distance*2)+$extra,2),
			);
		}
		$this->response($response);
	}

	function createOrder_post(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('itemQuantity','Item Quantity','trim|required|xss_clean');
		$this->form_validation->set_rules('itemDescription','Item Description','trim|required|xss_clean');
		$this->form_validation->set_rules('vehicleType','Vehicle Type','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryOption','Delivery Option','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupAddress','Pickup Address','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupLatitude','Pickup Latitude','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupLongitude','Pickup Longitude','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupLandmark','Pickup Landmark','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupInstructions','Pickup Instructions','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupDate','Pickup Date','trim|required|xss_clean');
		$this->form_validation->set_rules('pickupTime','Pickup Time','trim|required|xss_clean');
		$this->form_validation->set_rules('senderName','Sender Name','trim|required|xss_clean');
		$this->form_validation->set_rules('senderNumber','Sender Number','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryAddress','Delivery Address','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryLatitude','Delivery Latitude','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryLongitude','Delivery Longitude','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryLandmark','Delivery Landmark','trim|required|xss_clean');
		$this->form_validation->set_rules('deliveryInstructions','Delivery Instructions','trim|required|xss_clean');
		$this->form_validation->set_rules('receiverName','Receiver Name','trim|required|xss_clean');
		$this->form_validation->set_rules('receiverNumber','Receiver Number','trim|required|xss_clean');
		$this->form_validation->set_rules('sendMsg','Send Msg','trim|required|xss_clean');
		$this->form_validation->set_rules('checkRecipientId','Check Recipient Id','trim|required|xss_clean');
		$this->form_validation->set_rules('alcoholDelivery','Alcohol Delivery','trim|required|xss_clean');
		$this->form_validation->set_rules('leaveUnattended','Leave Unattended','trim|required|xss_clean');
		$this->form_validation->set_rules('fragileItem','Fragile Item','trim|required|xss_clean');
		$this->form_validation->set_rules('otherInstructions','Other Instructions','trim|required|xss_clean');
		$this->form_validation->set_rules('referenceId','Reference Id','trim|required|xss_clean');
		$this->form_validation->set_rules('distance','Distance','trim|required|xss_clean');
		$this->form_validation->set_rules('price','Price','trim|required|xss_clean');

		if($this->form_validation->run() == FALSE){
            $response = array(
            	'status'  => FAIL,
            	'message' => strip_tags(validation_errors())
            );
        }else{
			$postData = $this->input->post();
			
			$postData['userId']     = $this->authData->userId;
			$postData['orderToken'] = 'ORDER_'.rand().time();
			$postData['pickupDate'] = date('Y-m-d', strtotime($postData['pickupDate']));
			$postData['pickupTime'] = date('H:i:s', strtotime($postData['pickupTime']));
			
			$orderId = $this->common_model->insertData(ORDER,$postData);

			$response = array(
				'status'     => SUCCESS,
				'message'    => ResponseMessages::getStatusCodeMessage(151),
				'userDetail' => $orderId,
			);
		}
		$this->response($response);
	}

	function getOrder_get(){
		$userId    = $this->authData->userId;
		$latitude  = $this->authData->latitude;
		$longitude = $this->authData->longitude;
		$status    = $this->input->get('status');

		$this->load->model('Order_model');
		$orderList = $this->Order_model->getOrder($userId,$latitude,$longitude,$status);

		if(!empty($orderList)){
			$response = array(
				'status'    => SUCCESS,
				'message'   => ResponseMessages::getStatusCodeMessage(700),
				'orderList' => $orderList,
			);
		}else{
			$response = array(
				'status'    => FAIL,
				'message'   => ResponseMessages::getStatusCodeMessage(204),
				'orderList' => array(),
			);
		}
		$this->response($response);
	}

	function updateStatus_post(){
		$userId    = $this->authData->userId;
		$status    = $this->input->post('status');
		$orderId   = $this->input->post('orderId');

		switch ($status) {
		    case "Accept":
		        $checkWhere = $where = array(
		        	'orderId' => $orderId,
		        );
		        $update = array(
		        	'orderStatus' => 'Accept',
		        	'driverId'    => $userId,
		        );
		        $statusCode = 701;

		        $checkWhere['orderStatus'] = 'New';
		        $checkStatus = $this->common_model->getSingleData('*',ORDER,$checkWhere);
		        if(empty($checkStatus)){
		        	$statusCode = 405;
		        }
				

		        $checkCountWhere = array(
		        	'driverId'   => $userId,
		        	'pickupDate' => date('Y-m-d'),
		        );
		        $checkCount = $this->common_model->getData('*',ORDER,$checkCountWhere);
		        //print_r(count($checkCount));die();
		        if(count($checkCount) >= 5){
		        	$statusCode = 704;
		        }

		        break;
		    case "Picked":
		        $checkWere = $where = array(
		        	'orderId' => $orderId,
		        );
		        $update = array(
		        	'orderStatus' => 'Picked',
		        );
		        $statusCode = 702;

		        $checkWhere['orderStatus'] = 'Accept';
		        $checkStatus = $this->common_model->getSingleData('*',ORDER,$checkWhere);
		        if(empty($checkStatus)){
		        	$statusCode = 405;
		        }

		        break;
		    case "Delivered":
		        $checkWere = $where = array(
		        	'orderId' => $orderId,
		        );
		        $update = array(
		        	'orderStatus' => 'Delivered',
		        );
		        $statusCode = 703;

		        $checkWhere['orderStatus'] = 'Picked';
		        $checkStatus = $this->common_model->getSingleData('*',ORDER,$checkWhere);
		        if(empty($checkStatus)){
		        	$statusCode = 405;
		        }

		        break;
		    default:
		        $statusCode = 405;
		        break;
		}

		if(($statusCode == 405) ||  ($statusCode == 704)){
			$response = array(
				'status'  => FAIL,
				'message' => ResponseMessages::getStatusCodeMessage($statusCode),
			);
		}else{
			$orderId = $this->common_model->updateRecord($where,ORDER,$update);
			$response = array(
				'status'  => SUCCESS,
				'message' => ResponseMessages::getStatusCodeMessage($statusCode),
			);
		}
		$this->response($response);
	}
}


