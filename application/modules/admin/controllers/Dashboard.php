<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CommonBack {
	
	public function __construct(){
		parent::__construct();
	}

	function index(){
		$data['title'] = 'DASHBOARD';
		$this->load->admin_render('dashboard/dashboard',$data);
	}
	
}