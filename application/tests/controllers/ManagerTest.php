<?php
class Manager extends PHPUnit_Framework_TestCase {

	private $CI;  
    
  public function setUp() {   
      $this->CI = &get_instance();
  }
	/**
	 * Function to get the manager list
	 * @return type
	 */
	public function testGetManagers() {
	
		$this->CI->load->model('users');
		$user_id = "2";//example
		$managers = $this->CI->users->getManagers($user_id);

		//contains the employee_data
    foreach ($managers as $category) {
      $user = $this->userArray($category);

      $this->assertArrayHasKey('first', $user);
      $this->assertArrayHasKey('last', $user);
      $this->assertArrayHasKey('email', $user);
    }
	}
	/**
   * Check for the case profile and user data is not empty
   * @return type
   */
  public function testProfile($case='profile') {
      
    $this->CI->load->model('users');

    $userdata  = $this->CI->users->get_user_data();
     
    //has case profile
    $this->assertEquals('profile', $case);

    //contains the employee_data
    foreach ($userdata as $category) {
      $user = $this->userArray($category);

      $this->assertArrayHasKey('first', $user);
      $this->assertArrayHasKey('last', $user);
      $this->assertArrayHasKey('email', $user);
    }
  }
	/**
   * Check whether the case is manage_employees and user data is not empty
   * @return type
   */
  public function testManage_employees($case='manage_employees') {
       
    $this->CI->load->model('users');

    $manager_id='2';
    
    $userdata  = $this->CI->users->getManagerEmployees($manager_id);
   
    //has case manage_employees
    $this->assertEquals('manage_employees', $case);
     
    //contains the employee_data
    foreach ($userdata as $category) {
      $user = $this->userArray($category);

      $this->assertArrayHasKey('first', $user);
      $this->assertArrayHasKey('last', $user);
      $this->assertArrayHasKey('email', $user);
    }
  }
  /**
   * Check whether the case is view_empployees and user data is not empty
   * @return type
   */
  public function testView_employees($case='view_employees') {

    $this->CI->load->model('users');

    $manager_id='2';
    $userdata  = $this->CI->users->getManagerEmployees($manager_id);

    //has case view_employees
    $this->assertEquals('view_employees', $case);
     
    //contains the manager_employee_data
    foreach ($userdata as $category) {

      $user = $this->userArray($category);

      $this->assertArrayHasKey('first', $user);
      $this->assertArrayHasKey('last', $user);
      $this->assertArrayHasKey('email', $user);
    }
  }
	/**
   * Check whether the case is view_leaves and leave data is not empty
   * @return type
   */
  public function testView_leaves($case='view_leaves') {
    
    $this->CI->load->model('leaves');

    $user_id    ='3';
    $user_role  ='manager';

    $leavedata  = $this->CI->leaves->get_user_leaves($user_id,$user_role);
    
    //has case view_leaves
    $this->assertEquals('view_leaves', $case);
     //contains the leave_data
    foreach ($leavedata as $category) {

      $leaves = $this->leaveArray($category);

      $this->assertArrayHasKey('leave_start_date', $leaves);
      $this->assertArrayHasKey('leave_end_date', $leaves);
      $this->assertArrayHasKey('leave_type', $leaves);
      $this->assertArrayHasKey('leave_plan', $leaves);
      $this->assertArrayHasKey('leave_subject', $leaves);
    }
  }
  /**
   * Check whether the case is view_leaves and leave data is not empty
   * @return type
   */
  public function testEmployee_leaves($case='employee_leaves') {
    
    $this->CI->load->model('leaves');

    $manager_id ='2';
    $user_role  ='manager';

    $leavedata  = $this->CI->leaves->get_user_leaves($manager_id,$user_role);
    
    //has case view_leaves
    $this->assertEquals('employee_leaves', $case);
     //contains the leave_data
    foreach ($leavedata as $category) {

      $leaves = $this->leaveArray($category);

      $this->assertArrayHasKey('leave_start_date', $leaves);
      $this->assertArrayHasKey('leave_end_date', $leaves);
      $this->assertArrayHasKey('leave_type', $leaves);
      $this->assertArrayHasKey('leave_plan', $leaves);
      $this->assertArrayHasKey('leave_subject', $leaves);
    }
  }
	private function userArray($array) {
      $user['first'] = $array->first;
      $user['last']  = $array->last;
      $user['email'] = $array->email;
      return $user;
  }
  private function leaveArray($array) {
      $leaves['leave_start_date'] = $array->leave_start_date;
      $leaves['leave_end_date']   = $array->leave_end_date;
      $leaves['leave_type']       = $array->leave_type;
      $leaves['leave_plan']       = $array->leave_plan;
      $leaves['leave_subject']    = $array->leave_subject;
      return $leaves;
  }
}
?>