<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->landing();
	}

	public function landing($page_topic='view_leaves') {

		if($this->session->userdata('user_id')>0 && $this->session->userdata('user_role')!='admin'){
			redirect('login');
		}
		$this->load->model('users');

		$user_id   = $this->session->userdata('user_id');
		$script    = array();
		$page_data = array();
		$employee_id ='';

		switch ($page_topic) {

			case 'manage_employees':

				$user_data = $this->users->get_user_data();

				$script    = array('scripts'=>array('assign_employee'));
			break;

			case 'view_employees':
				$user_data = $this->users->getManagerEmployees($user_id);
			break;

			case 'view_leaves':

				$this->load->model('leaves');
				$this->load->helper('leave_date');
				$user_role   = $this->session->userdata('user_role');
				$script    = array('scripts'=>array('manage_leave'));
				$user_data = $this->leaves->get_user_leaves($user_id,$user_role);
			break;

			case 'profile':

					$employee_id = (int)$this->uri->segment(4);
					
					$user_data = $this->users->getUserById($employee_id);

					if(!$employee_id || empty($user_data)) {
						redirect('admin/landing/manage_employees');
					}
					$designations = $this->users->get_designations();
					$script    = array('scripts'=>array('profile'));
					$page_data['designations'] = $designations;
					$user_data = $user_data[0];
			break;
			case 'edit_profile':
					
					$form_data = $this->input->post();

					if($form_data) {

						$this->load->model('users');

						$employee_id = (int)$this->uri->segment(4);

						if(!$employee_id) {
							redirect('admin/landing/');
						}

						$user_id   = $this->session->userdata('user_id');
						$user_role  = $this->session->userdata('user_role');
						$form_data['user_id'] = $employee_id;
						$result = $this->users->update_profile($form_data);
						
						if($result){
							$this->session->set_flashdata('success', 'You have successfully updated your profile');
						}else{
							$this->session->flashdata('error','Sorry We are unable to process the request');
						}
						redirect('admin/landing/profile/'.$employee_id);
					}
			break;

			default:
				$this->load->model('leaves');
				$this->load->helper('leave_date');
				$user_role   = $this->session->userdata('user_role');
				$user_data = $this->leaves->get_user_leaves($user_id,$user_role);
				break;
		}
		
		$page_data['navigation']  = $page_topic;
		$page_data['user_data']   = $user_data;
		$page_data['controller']  = 'admin';
		$page_data['employee_id'] = ($employee_id)?$employee_id:NULL;
		
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
				$manager_id = $post['manager'];
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