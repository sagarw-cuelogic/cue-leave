<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->landing();
	}

	public function landing($page_topic='profile'){

		$this->load->model('users');

		$user_id   = $this->session->userdata('user_id');
		
		$user_data = $this->users->get_user_data($user_id);
		$user_data = $user_data[0];
		$page_data = array('navigation'=>$page_topic,'user_data'=>$user_data);
		$script    = array('scripts'=>array('profile'));
		$this->load->view('common/header',$script);
		$this->load->view('landing_page',$page_data);
		$this->load->view('common/footer');
		
	}
}
?>