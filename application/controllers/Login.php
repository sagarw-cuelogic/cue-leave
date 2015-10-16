<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once APPPATH . "libraries/Google/autoload.php";

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index() {

		$client_id 			= $this->config->item('google_client_id');
		$client_secret 	= $this->config->item('google_client_secret');
		$redirect_uri 	= $this->config->item('google_redirect_uri');
		$api_key 				= $this->config->item('google_api_key');
		$hosted_domain 	= $this->config->item('google_allow_domain');

		// Create Client Request to access Google API
		$client = new Google_Client();
		$client->setApplicationName("PHP Google OAuth Login Example");
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->setDeveloperKey($api_key);
		$client->setHostedDomain($hosted_domain);
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");

		// Send Client Request
		$objOAuthService = new Google_Service_Oauth2($client);

		// Add Access Token to Session
		if (isset($_GET['code'])) {
			
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}

		// Set Access Token to make Request
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

			$client->setAccessToken($_SESSION['access_token']);
		}

		// Get User Data from Google and store them in $data
		if ($client->getAccessToken()) {

			$userData = $objOAuthService->userinfo->get();
			$data['userData'] = $userData;
			$_SESSION['access_token'] = $client->getAccessToken();
		} else {

			$authUrl = $client->createAuthUrl();
			$data['authUrl'] = $authUrl;
		}
		if(isset($authUrl)){
			
			$this->load->view('login', $data);
		} else {
			
			$this->load->model('authentication');
			$this->authentication->addGoogleCredentials($userData);

			if($this->session->userdata('user_role')=='admin')
				redirect('admin/landing');
			else
				redirect('user/landing');
		}
	}

	public function logout() {

		$this->session->sess_destroy();
		unset($_SESSION['access_token'],$_SESSION['__ci_last_regenerate']);
		redirect(base_url());
	}
}
?>
