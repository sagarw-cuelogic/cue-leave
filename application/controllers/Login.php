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

		$this->load->view('common/header');
		$this->load->view('login');
		$this->load->view('common/footer');
	}
	public function validateLogin(){

		$form_data = $this->input->post();

		if($form_data) {

		$this->load->model('authentication');

		$result = $this->authentication->validateUser($form_data);

			if($result) {

			if($result[0]->role=='admin')
			redirect('admin/landing');
			if($result[0]->role=='user')
			redirect('user/landing');
			}else {
			$this->session->set_flashdata('error', 'Invalid');
			redirect('login');
	    	}
		} else {
		redirect('login');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>
