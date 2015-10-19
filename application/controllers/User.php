<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 * Function for sign up new user
	 * @return type
	 */
	public function sign_up() {
		$this->load->view('common/header');
		$this->load->view('user');
		$this->load->view('common/footer');
	}
	/**
	 * Function to add new user records in db 
	 * Currently not using these function as login is done for already existing employee
	 * @return type
	 */
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
	/**
	 * Function for the use landing page
	 * Load the page as per the navigation 
	 * @param type $page_topic 
	 * @return type
	 */
	public function landing($page_topic='profile'){

		
		if(!$this->session->userdata('user_id')>0){
			redirect('login');
		}
		$this->load->model('users');

		$user_id    = $this->session->userdata('user_id');
		$user_role  = $this->session->userdata('user_role');
		$page_data  = array();
		
		switch ($page_topic) {
			
			case 'profile':
					
					$user_data = $this->users->getUserById($user_id);
					$designations = $this->users->get_designations();
					$script    = array('scripts'=>array('profile'));
					$page_data['designations'] = $designations;
					$user_data = $user_data[0];
			break;

			case 'edit_profile':
					
					$form_data = $this->input->post();

					if($form_data) {

						$this->load->model('users');
						$user_id   = $this->session->userdata('user_id');
						$user_role  = $this->session->userdata('user_role');
						$form_data['user_id'] = $user_id;
						$result = $this->users->update_profile($form_data);
						
						if($result){
							$this->session->set_flashdata('success', 'You have successfully updated your profile');
						}else{
							$this->session->flashdata('error','Sorry We are unable to process the request');
						}
						redirect('user/landing/profile');
					}
			break;
			
			case 'add_leaves':

					$this->load->model('leaves');
					$user_data = $this->users->getUserById($user_id);
					$holiday_list = $this->leaves->get_holiday_list();
					$script    = array('scripts'=>array('add_leave'));
					$user_data = $user_data[0];
					$page_data['holiday_list'] = $holiday_list;
			break;

			case 'view_leaves':
					
					$this->load->model('leaves');
					$this->load->helper('leave_date');

					
					$script     = array('scripts'=>array('manage_leave'));
					$user_data  = $this->users->getUserById($user_id);
					$user_data  = $user_data[0];
					$leave_data = $this->leaves->get_user_leaves($user_id,$user_role);
					$page_data['leave_data'] = $leave_data;
			break;
			
			case 'edit_leave':

					$this->load->model('leaves');
					$this->load->helper('leave_date');
					
					if(! $this->uri->segment(4)){
						redirect('user/landing/profile');
					}

					$leave_id = (int)$this->uri->segment(4);

					$page_data['leave_id'] = $leave_id;
					$script    = array('scripts'=>array('add_leave'));
					$user_data = $this->leaves->get_leave_details($leave_id,$user_id);
					
					if($user_data)
					$user_data = $user_data[0];
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
		$page_data['controller']  = 'user';
		
		$this->load->view('common/header',$script);
		$this->load->view('landing_page',$page_data);
		$this->load->view('common/footer');
		
	}
	/**
	 * Function to upload the picture or change the profile picture
	 * Currently not using these function as we get the profile picture from google data auth
	 * @return type
	 */
	public function upload_picture() {
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		
        $this->load->library('upload', $config);
         
        $this->upload->initialize($config);

		if($this->upload->do_upload('user_file')) {
		  
		  $this->load->model('users');

			$user_id   = $this->session->userdata('user_id');
			$form_data['user_id'] = $user_id;
			$file_data = $this->upload->data();
		  $form_data['profile_picture'] = $file_data['file_name'];
			$result = $this->users->update_profile_picture($form_data);
			redirect('user/landing/profile');
		}
		else {
		   echo  $this->upload->display_errors();
		}
	}
	
}
?>