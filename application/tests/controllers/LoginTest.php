<?php
include_once APPPATH . "libraries/Google/autoload.php";
class LoginTest extends PHPUnit_Framework_TestCase {
	

	private $CI; 
	public  $google_data;	

  public function setUp() { 	
			$this->CI = &get_instance();
	}
	/**
	 * Check the google config use for the login by google auth
	 * @return type
	 */
	public function testGoogle_config() {

		$client_id 			= $this->CI->config->item('google_client_id');
		$client_secret 	= $this->CI->config->item('google_client_secret');
		$redirect_uri 	= $this->CI->config->item('google_redirect_uri');
		$api_key 				= $this->CI->config->item('google_api_key');
		$hosted_domain 	= $this->CI->config->item('google_allow_domain');

		if($client_id && $client_secret && $redirect_uri && $api_key && $hosted_domain) {
			$config = TRUE;
		}	else {
			$config = FALSE;
		}
		
		$this->assertTrue($config);
	}
	/**
	 * Check the google credentials to log into db
	 * @return type
	 */
	public function testAdd_GoogleCredentials() {

			$user_email = 'sagar.wadiyaar@cuelogic.co.in';

			$this->CI->load->model('authentication');
			//add the google data in database if not exists

			$user_email = $this->CI->session->userdata('user_email');

			$this->CI->authentication->checkUserRole($user_email);
			
			$forward_to = $this->CI->session->userdata('user_role');
		  //redirect to page as per the role
			printf("Test passed. Redirecting to %s page.....",$forward_to);
	}
	
}
?>