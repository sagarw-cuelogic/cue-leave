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

	public function landing($page_topic='view_leaves'){

		if(!$this->session->userdata('user_id')>0){
			redirect('login');
		}
		$this->load->model('users');

		$user_id   = $this->session->userdata('user_id');
		$script    = array();
		switch ($page_topic) {
			case 'manage_employees':
				$user_data = $this->users->get_user_data();
				$script    = array('scripts'=>array('assign_employee'));
				break;
			case 'view_employees':
				$user_data = $this->users->get_user_data(array('manager_id'=>$user_id));
				break;
			case 'view_leaves':
				$this->load->model('leaves');
				$this->load->helper('leave_date');
				$user_role   = $this->session->userdata('user_role');
				$script    = array('scripts'=>array('manage_leave'));
				$user_data = $this->leaves->get_user_leaves($user_id,$user_role);
				break;
			default:
				$this->load->model('leaves');
				$this->load->helper('leave_date');
				$user_role   = $this->session->userdata('user_role');
				$user_data = $this->leaves->get_user_leaves($user_id,$user_role);
				break;
		}
		
		
		$page_data = array('navigation'=>$page_topic,'user_data'=>$user_data,'controller'=>'admin');
		
		$this->load->view('common/header',$script);
		$this->load->view('landing_page',$page_data);
		$this->load->view('common/footer');
		
	}

	public function assign_to_manager($action) {

		$this->load->model('users');

		$post = $this->input->post();

		$user_id = $post['user_id'];

		switch ($action) {
			case 'assign':
				$manager_id   = $this->session->userdata('user_id');
				break;
			case 'unassign':
				$manager_id   = NULL;
				break;
		}

		$this->users->assign_user_to_manager($manager_id,$user_id);
		return true;
	}
}
?>