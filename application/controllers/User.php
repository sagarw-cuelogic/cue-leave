<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function sign_up() {
		$this->load->view('common/header');
		$this->load->view('user');
		$this->load->view('common/footer');
	}

	public function add_user() {
		$form_data = $this->input->post();

		if($form_data) {
			$this->load->model('users');
			$this->users->add_new_user($form_data);
		}
		$this->load->view('common/header');
		$this->load->view('user');
		$this->load->view('common/footer');
	}

	public function landing($page_topic='profile'){

		if(!$this->session->userdata('user_id')>0){
			redirect('login');
		}
		$this->load->model('users');

		$user_id   = $this->session->userdata('user_id');
		
		switch ($page_topic) {
			case 'profile':
				$user_data = $this->users->get_user_data($user_id);
				$user_data = $user_data[0];
				break;
				case 'add_leaves':
				$user_data = $this->users->get_user_data($user_id);
				$user_data = $user_data[0];
				break;
				case 'view_leaves':
					$this->load->model('leaves');
					$this->load->helper('leave_date');
					$user_data = $this->leaves->get_user_leaves($user_id);
					break;
			default:
				$user_data = $this->users->get_user_data($user_id);
				$user_data = $user_data[0];
				break;
		}
		
		
		$page_data = array('navigation'=>$page_topic,'user_data'=>$user_data,'controller'=>'user');
		$script    = array('scripts'=>array('profile','add_leave'));
		$this->load->view('common/header',$script);
		$this->load->view('landing_page',$page_data);
		$this->load->view('common/footer');
		
	}
	
}
?>