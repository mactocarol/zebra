<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CommonBack {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
		$this->check_admin_user_session();
	}

	function index(){
		$this->load->view('admin/admin/login');
	}

	function loginAdmin(){
		$postData = $this->input->post();
		$result = $this->Admin_model->loginAdmin($postData);
		print_r($result);
	}
	
}