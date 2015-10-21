<?php
class UserTest extends PHPUnit_Framework_TestCase {

	private $CI;  
    
  public function setUp() {   
    $this->CI = &get_instance();
  }
  /**
   * Check if the user is user only
   * @return type
   */
  public function testRole() {
     $session_role ='user';
     //check role is admin
     $this->assertEquals('user',$session_role);
  }
  /**
   * Check whether the case is add_leaves and user data is not empty
   * @return type
   */
  public function testAdd_leaves($case='add_leaves') {
     
    $this->CI->load->model('leaves');
    $this->CI->load->model('users');

    //has case manage_employees
    $this->assertEquals('add_leaves', $case);

    $user_id = '3';//example
    
    $userdata  = $this->CI->users->getUserById($user_id);

    $holiday_list =  $this->CI->leaves->get_holiday_list();
  	$script    = array('scripts'=>array('add_leave'));
   
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
   public function testView_leaves($case='view_leaves') {

    $this->CI->load->model('leaves');
    $this->CI->load->model('users');

    

    //has case view_employees
    $this->assertEquals('view_leaves', $case);

    $user_id = '3';//example
    $user_role = 'user';
    
		$userdata  = $this->CI->users->getUserById($user_id);
    $leave_data = $this->CI->leaves->get_user_leaves($user_id,$user_role);
     
    //contains the manager_employee_data
    foreach ($leave_data as $category) {

      $leaves = $this->leaveArray($category);

      $this->assertArrayHasKey('leave_start_date', $leaves);
      $this->assertArrayHasKey('leave_end_date', $leaves);
      $this->assertArrayHasKey('leave_type', $leaves);
      $this->assertArrayHasKey('leave_plan', $leaves);
      $this->assertArrayHasKey('leave_subject', $leaves);
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
   * Check for the case edit_profile and user data is not empty
   * @return type
   */
  public function testEdit_profile($case='edit_profile') {
    
    $this->CI->load->model('users');

    $userdata  = $this->CI->users->get_user_data();
     
    //has case edit_profile
    $this->assertEquals('edit_profile', $case);

    //contains the employee_data
    foreach ($userdata as $category) {
      $user = $this->userArray($category);

      $this->assertArrayHasKey('first', $user);
      $this->assertArrayHasKey('last', $user);
      $this->assertArrayHasKey('email', $user);
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