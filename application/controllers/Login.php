<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		

		$this->login_page();
	}
	public function login_page(){

		//$this->load->view('common/header');
		$this->load->view('login');
		//$this->load->view('common/footer');
	}
	public function validateLogin(){

		$form_data = $this->input->post();

		if($form_data) {

		$this->load->model('authentication');


		$result = $this->authentication->validateUser($form_data);

			if($result) {
			
			if($result[0]->role!='admin'){
				$this->load->model('users');
				$user_id   = $this->session->userdata('user_id');
				$user_data = $this->users->get_user_data(array('user_id'=>$user_id));
				$this->session->set_userdata('first', $user_data[0]->first);
				$this->session->set_userdata('last', $user_data[0]->last);
				redirect('user/landing');
			}else{
				$this->session->set_userdata('first', "Admin");
				redirect('admin/landing');
			}
		} else {
		redirect('login');
		}
	}
}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>
