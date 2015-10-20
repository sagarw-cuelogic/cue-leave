<?php
class AdminTest extends PHPUnit_Framework_TestCase
{
    /**
     * Check if the user is admin only
     * @return type
     */
    public function testRole() {
       //check role is admin
       $this->assertEquals('admin','admin');
    }
    /**
     * Check whether the case is manage_employees and user data is not empty
     * @return type
     */
    public function testManage_employees() {

       $userdata  = array('employee_data','script_data');
       //has case manage_employees
       $this->assertArrayHasKey('manage_employees', array('manage_employees' => $userdata));
       //contains the employee_data
       $this->assertContains('employee_data', $userdata);
     }
     /**
      * Check whether the case is view_empployees and user data is not empty
      * @return type
      */
     public function testView_employees() {

       $userdata  = array('employee_data');
       //has case view_employees
       $this->assertArrayHasKey('view_employees', array('view_employees' => $userdata));
       //contains the employee_data
       $this->assertContains('employee_data', $userdata);
    }
    /**
     * Check whether the case is view_leaves and leave data is not empty
     * @return type
     */
    public function testView_leaves() {

       $leave_data  = array('leave_data');
       //has case view_leaves
       $this->assertArrayHasKey('view_leaves', array('view_leaves' => $leave_data));
       //contains the leave_data
       $this->assertContains('leave_data', $leave_data);
    }
    /**
     * Check for the case profile and user data is not empty
     * @return type
     */
    public function testProfile() {

       $userdata  = array('employee_data');
       //has case profile
       $this->assertArrayHasKey('profile', array('profile' => $userdata));
       //contains the employee_data
       $this->assertContains('employee_data', $userdata);
    }
    /**
     * Check for the case edit_profile and user data is not empty
     * @return type
     */
    public function testEdit_profile() {

       $userdata  = array('employee_data');
       //has case edit_profile
       $this->assertArrayHasKey('edit_profile', array('edit_profile' => $userdata));
       //contains the employee_data
       $this->assertContains('employee_data', $userdata);
    }
}
?>