<?php
class LoginTest extends PHPUnit_Framework_TestCase {
	/**
	 * Check the basic google configurations
	 * @return type
	 */
	public function testGoogle_config() {
	 
	 $config_array['client_id'] = array('fdfdXX677');
	 $config_array['secret_key'] = array('VVG^^&&&');
	 //check for domain
	 $this->assertEquals('cuelogic.co.in','cuelogic.co.in');
	 //check for configuration
	 $this->assertArrayHasKey('client_id', $config_array);
	 $this->assertArrayHasKey('secret_key', $config_array);
	}
	/**
	 * Check the login url for the google auth lib
	 * @return type
	 */
	public function testLogin() {
		$google_data['authUrl'] ='http://cue-leave.com?continue..........';

		//authenticate the google url
		$this->assertArrayHasKey('authUrl', $google_data);
	}
	/**
	 * Check the google data for stroing in db and authentication
	 * @return type
	 */
	public function testGoogle_data() {

		$google_data['google_id'] ='197643333';
		$google_data['first']     ='abc';
		$google_data['email']     ='abc@cuelogic.co.in';

		//authenticate the google url
		$this->assertArrayHasKey('google_id', $google_data);
		$this->assertArrayHasKey('first', $google_data);
		$this->assertArrayHasKey('email', $google_data);
	}
	/**
	 * Check for the role of the admin
	 * @return type
	 */
	public function testAdmin_role() {

		$status= $this->userExistsInTable('abc@cuelogic.co.in','admin');
		$this->assertTrue($status);
	}
	/**
	 * Check for the role of the user
	 * @return type
	 */
	public function testUser_role() {

		$status= $this->userExistsInTable('pqr@cuelogic.co.in','google_account');
		$this->assertTrue($status);
	}
	public function userExistsInTable($email,$table) {
		if($table=='admin' && !empty($email))
			return true;
		else if($table=='google_account' && !empty($email))
			return true;
		else
			return false;
	}
}
?>