<?php
class AdminTest extends PHPUnit_Framework_TestCase
{
    private $CI;  
    
    public function setUp() {   
      $this->CI = &get_instance();
    }
    /**
     * Check if the user is admin only
     * @return type
     */
    public function testRole() {
       $session_role ='admin';
       //check role is admin
       $this->assertEquals('admin',$session_role);
    }
    /**
     * Check whether the case is manage_employees and user data is not empty
     * @return type
     */
    public function testManage_employees($case='manage_employees') {
       
      $this->CI->load->model('users');

      $userdata  = $this->CI->users->get_user_data();
        
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

      $userdata  = $this->CI->users->getAllManagerEmployees();

      //has case view_employees
      $this->assertEquals('view_employees', $case);
       
      //contains the manager_employee_data
      foreach ($userdata as $category) {

        $user = $this->managerEmpArray($category);

        $this->assertArrayHasKey('employee_name', $user);
        $this->assertArrayHasKey('manager_name', $user);
        $this->assertArrayHasKey('employee_email', $user);
        $this->assertArrayHasKey('manager_email', $user);
      }
    }
    /**
     * Check whether the case is view_leaves and leave data is not empty
     * @return type
     */
    public function testView_leaves($case='view_leaves') {
      
      $this->CI->load->model('leaves');

      $user_id    ='3';
      $user_role  ='admin';

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
    private function managerEmpArray($array) {
      $user['employee_name']  = $array->employee_name;
      $user['manager_name']   = $array->manager_name;
      $user['employee_email'] = $array->employee_email;
      $user['manager_email']  = $array->manager_email;
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