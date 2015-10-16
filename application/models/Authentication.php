<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function validateUser($input_data){

		$username = $input_data['username'];
		$password = $input_data['password'];

		
		$encrypted_password = encodeString($password);
		$decode_password    = decodeString($encrypted_password);

		$sql = "SELECT * FROM users 
		        WHERE username ={$this->db->escape($username)} ";

		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0) {
		 	
		 	$user_data = $result->result();

		 	$decode_db_password = decodeString($user_data[0]->password);

		 	if($decode_db_password==$decode_password){
		 		$this->session->set_userdata('user_id', $user_data[0]->id);
		 		$this->session->set_userdata('user_role', $user_data[0]->role);
		 		return $user_data;
		 	} else {
		 		return false;
		 	}
		 	
		 } else
		 	return false;
	}
	function addGoogleCredentials($google_user_data){
		
		$first 		= $google_user_data->givenName;
		$last  		= $google_user_data->familyName;
		$google_id 	= $google_user_data->id;
		$profile_picture = $google_user_data->picture;
		$email      = $google_user_data->email;
		$gender     = $google_user_data->gender;


		$isAdmin   = $this->checkIsAdmin($email);
		
		if($isAdmin) {
			
			$this->session->set_userdata('user_id', $isAdmin[0]->id);
		 	$this->session->set_userdata('user_role', 'admin');
		 	$this->session->set_userdata('first', $isAdmin[0]->first);
		 	return true;
		} else {

		 $user_data = $this->checkIfUserExists($email);
		 
		 if($user_data) {

		 	$this->session->set_userdata('user_id', $user_data[0]->id);
		 	$this->session->set_userdata('user_role', 'user');
		 	$this->session->set_userdata('first', $user_data[0]->first);

		 } else {

				$insert_array = array('first'=>$first,
		    						  'last'=>$last,
		    						  'google_id'=>$google_id,
		    						  'profile_picture'=>$profile_picture,
		    						  'email'=>$email,
		    						  'gender'=>$gender);

	    	$query  = $this->db->insert_string('google_account',$insert_array);
	    	$result = $this->db->query($query);
	    	$id     = $this->db->insert_id();

	    	$this->session->set_userdata('user_id', $id);
	    	$this->session->set_userdata('user_role', 'user');
	    	$this->session->set_userdata('first', $first);
			}
	 	}
	}

	function checkIfUserExists($email) {

		$sql = "SELECT * FROM google_account 
		        WHERE email ={$this->db->escape($email)} ";

		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0) {

		 	$user_data = $result->result();
		 	return $user_data;
		 }
		 else {
		 	return false;
		 }	
	}

	function checkIsAdmin($email) {

		$sql = "SELECT * FROM admin 
		        WHERE email ={$this->db->escape($email)} ";

		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0) {

		 	$user_data = $result->result();
		 	return $user_data;
		 }
		 else {
		 	return false;
		 }
	}
}
?>