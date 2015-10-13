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

		$post = $this->input->post();

		if($post){
		$this->load->model('user_login');

		$result = $this->user_login->validateUser($post);
		if($result)
		redirect('admin/landing');
	else{
		$this->session->set_flashdata('error', 'Invalid');
		redirect('login');
	}
		
		}
		
		else
		redirect('login');
	}
}
?>
