<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function sign_up() {
		$this->load->view('common/header');
		$this->load->view('user');
		$this->load->view('common/footer');
	}

	public function getManagers() {
	
		$this->load->model('users');
		$post = $this->input->post();
		$user_id = $post['id'];
		$managers = $this->users->getManagers($user_id);
		$page_data = array('managers'=>$managers);
		$this->load->view('content/manager_list',$page_data);
	}

	public function landing($page_topic='profile'){

		
		if($this->session->userdata('user_id')>0 && $this->session->userdata('user_role')!='manager'){
			redirect('login');
		}
		$this->load->model('users');

		$user_id    = $this->session->userdata('user_id');
		$user_role  = $this->session->userdata('user_role');
		$page_data  = array();
		$script     = array();
		
		switch ($page_topic) {
			
			case 'profile':
					
					$user_data = $this->users->getUserById($user_id);
					$designations = $this->users->get_designations();
					$script    = array('scripts'=>array('profile'));
					$page_data['designations'] = $designations;
					$user_data = $user_data[0];
			break;
			case 'manage_employees':

				$user_data = $this->users->getManagerEmployees($user_id);
				$script    = array('scripts'=>array('assign_employee'));
			break;
			case 'view_employees':
				$user_data = $this->users->getManagerEmployees($user_id);
			break;
			case 'view_leaves':
					
					$this->load->model('leaves');
					$this->load->helper('leave_date');

					
					$script     = array('scripts'=>array('manage_leave'));
					$user_data  = $this->users->getUserById($user_id);
					$user_data  = $user_data[0];
					$leave_data = $this->leaves->get_user_leaves($user_id);
					$page_data['leave_data'] = $leave_data;
			break;
			case 'employee_leaves':
				$this->load->model('leaves');
				$this->load->helper('leave_date');

				
				$script     = array('scripts'=>array('manage_leave'));
				$user_data  = $this->users->getUserById($user_id);
				$user_data  = $user_data[0];
				$leave_data = $this->leaves->get_user_leaves($user_id,$user_role);
				$page_data['leave_data'] = $leave_data;
				break;
			default:

				$user_data  = $this->users->getUserById($user_id);
				$script     = array('scripts'=>array('profile'));
				$page_topic = 'profile';
				$user_data  = $user_data[0];
				break;
		}
		
		$page_data['navigation']  = $page_topic;
		$page_data['user_data']   = $user_data;
		$page_data['controller']  = 'manager';
		
		$this->load->view('common/header',$script);
		$this->load->view('landing_page',$page_data);
		$this->load->view('common/footer');
		
	}
}
?>