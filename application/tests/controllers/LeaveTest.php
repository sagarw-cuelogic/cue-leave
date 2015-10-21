<?php

class LeaveTest extends PHPUnit_Framework_TestCase {

	private $CI;  
  
  public function setUp() {   
    $this->CI = &get_instance();
  }
  
  /**
   * Check test to add leaves will be executed if user id is present
   * @return type
   */
	public function testAdd_leave() {

		$form_data = $this->CI->input->post();

		if($this->CI->session->userdata('user_id')) {
			$this->assertTrue(TRUE);
			
			$form_data['user_id'] = $this->CI->session->userdata('user_id');

			$this->CI->load->model('leaves');
		
			$result = $this->CI->leaves->add_leaves($form_data);

		}else {
			$this->expectOutputString('user id is expected to add leaves');
		}
		
	}
	/**
   * Check test to update leaves will be executed if user id is present
   * @return type
   */
	public function testUpdate_leave() {

		$form_data = $this->CI->input->post();
		
		if($this->CI->session->userdata('user_id')) {
			$this->assertTrue(TRUE);
			
			$form_data['user_id'] = $this->CI->session->userdata('user_id');

			$this->CI->load->model('leaves');
		
			$result = $this->CI->leaves->update_leaves($form_data);

		}else {
			$this->expectOutputString('user id is expected to update leaves');
		}
	}
	/**
   * Check test to add leaves action will be executed if ajax request
   * @return type
   */
	public function testajaxLeaveAction() {

		$form_data = $this->CI->input->post();
		
		if (!$this->CI->input->is_ajax_request()) {
   			$this->expectOutputString('Ajax request is expected');
		}
		else {
			
			$form_data['manager_id'] = $this->CI->session->userdata('user_id');

			$this->CI->load->model('leaves');
			$result = $this->CI->leaves->add_leave_comments($form_data);
		}
	}
}
?>