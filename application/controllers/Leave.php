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
		redirect('user/landing/add_leaves');

	}
	public function update_leave() {

		if(!$this->session->userdata('user_id')>0){
			redirect('login');
		}
		
		$form_data = $this->input->post();
		
		$form_data['user_id'] = $this->session->userdata('user_id');
		$leave_id = $form_data['leave_id'];
		
		if($form_data['leave_plan'] =='half_day' || $form_data['leave_plan']=='one_day') {
			$form_data['leave_start_date'] = $form_data['date'];
			$form_data['leave_end_date']   = $form_data['date'];
			unset($form_data['date']);
		}
		
		$this->load->model('leaves');
		$result = $this->leaves->update_leaves($form_data);
		if($result){
			$this->session->set_flashdata('success', 'You have successfully updated your leave');
		}
		else
		{
			$this->session->flashdata('error','Sorry We are unable to process the request');
		}
		redirect('user/landing/edit_leave/'.$leave_id);

	}
	public function ajaxLeaveAction() {

		$form_data = $this->input->post();

		$form_data['manager_id'] = $this->session->userdata('user_id');

		$this->load->model('leaves');
		$result = $this->leaves->manage_leaves($form_data);


	}
}
?>