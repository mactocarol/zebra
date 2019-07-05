<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CommonBack {
	
	public function __construct(){
		parent::__construct();
		//$this->check_admin_user_session();
		$this->load->model('Users_model');
	}

	function users(){
		$data['title'] = 'USER-LIST';
		$this->load->admin_render('users/users',$data);
	}

	function usersList(){
		$this->load->library('ajax_pagination');
        $postData = $this->input->post();
        $config['base_url'] = base_url().'admin/users/usersList';

        $where = array('userType' => 'Customer');

        $config['total_rows'] = $this->Users_model->countUser($where);
        $config['uri_segment'] = 4;
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['full_tag_open'] = '<ul class="pagination1">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['anchor_class'] = 'class="paginationlink" ';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $page = $this->uri->segment(4);
        $limit = $config['per_page'];
        $start = $page > 0 ? $page : 0;
        $this->ajax_pagination->initialize($config);
        $result['userList'] = $this->Users_model->userList($limit,$start,$where);
        $result['links'] =$this->ajax_pagination->create_links();
        $result['startFrom'] = $start + 1;
		$this->load->view('users/usersList',$result);
	}

	function driver(){
		$data['title'] = 'DRIVER-LIST';
		$this->load->admin_render('users/driver',$data);
	}
	
}