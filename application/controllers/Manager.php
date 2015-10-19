<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 * Function to get the manager list
	 * @return type
	 */
	public function getManagers() {
	
		$this->load->model('users');
		$post = $this->input->post();
		$user_id = $post['id'];
		$managers = $this->users->getManagers($user_id);
		$page_data = array('managers'=>$managers);
		$this->load->view('content/manager_list',$page_data);
	}
	/**
	 * Function to display the manager landing page
	 * @param type $page_topic 
	 * @return type
	 */
	public function landing($page_topic='profile'){

		//access the page if manager
		if($this->session->userdata('user_id')>0 && $this->session->userdata('user_role')!='manager'){
			redirect('login');
		}
		$this->load->model('users');

		$user_id    = $this->session->userdata('user_id');
		$user_role  = $this->session->userdata('user_role');
		$page_data  = array();
		$script     = array();
		
		switch ($page_topic) {
			//view user profile
			case 'profile':
					
					$user_data = $this->users->getUserById($user_id);
					$designations = $this->users->get_designations();
					$script    = array('scripts'=>array('profile'));
					$page_data['designations'] = $designations;
					$user_data = $user_data[0];
			break;
			//manage the employees under the manager
			case 'manage_employees':

				$emp_data = $this->users->getManagerEmployees($user_id);
				$user_data  = $this->users->getUserById($user_id);
				$user_data  = $user_data[0];
				$page_data['emp_data'] = $emp_data;
				$script    = array('scripts'=>array('assign_employee'));
			break;
			//view employees under manager
			case 'view_employees':
				$user_data = $this->users->getManagerEmployees($user_id);
			break;
			//view leaves
			case 'view_leaves':
					
					$this->load->model('leaves');
					$this->load->helper('leave_date');

					
					$script     = array('scripts'=>array('manage_leave'));
					$user_data  = $this->users->getUserById($user_id);
					$user_data  = $user_data[0];
					$leave_data = $this->leaves->get_user_leaves($user_id,$user_role='user');
					$page_data['leave_data'] = $leave_data;
			break;
			//get leaves by the leave id
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