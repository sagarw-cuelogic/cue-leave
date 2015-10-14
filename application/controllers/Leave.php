<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function add_leave() {

		if(!$this->session->userdata('user_id')>0){
			redirect('login');
		}
		
		$form_data = $this->input->post();
		
		$form_data['user_id'] = $this->session->userdata('user_id');
		
		if($form_data['leave_plan'] =='half_day' || $form_data['leave_plan']=='one_day') {
			$form_data['leave_start_date'] = $form_data['date'];
			$form_data['leave_end_date']   = $form_data['date'];
			unset($form_data['date']);
		}
		
		$this->load->model('leaves');
		$result = $this->leaves->add_leaves($form_data);
		if($result){
			$this->session->set_flashdata('success', 'You have successfully applied for the leave');
		}
		else
		{
			$this->session->flashdata('error','Sorry We are unable to process the request');
		}
		redirect('admin/landing/add_leaves');

	}
	public function view_user_leaves() {

	}
}
?>