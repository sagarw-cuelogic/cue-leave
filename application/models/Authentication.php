<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }
    /**
     * function to add the google credentials in database
     * @param type $google_user_data 
     * @return type
     */
	function addGoogleCredentials($google_user_data){
		
		$first 		= $google_user_data->givenName;
		$last  		= $google_user_data->familyName;
		$google_id 	= $google_user_data->id;
		$profile_picture = $google_user_data->picture;
		$email      = $google_user_data->email;
		$gender     = $google_user_data->gender;


		 $user_data = $this->checkIfUserExists($email);
		 
		 if($user_data) {

		 	$this->session->set_userdata('user_id', $user_data[0]->id);
		 	$this->session->set_userdata('user_email', $user_data[0]->email);
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
	    	$this->session->set_userdata('user_email', $user_data[0]->email);
	    	$this->session->set_userdata('first', $first);
		}
	}
	/**
	 * Function to check whether email address exists in db
	 * @param type $email 
	 * @return type
	 */
	function checkIfUserExists($email) {

		$sql = "SELECT * FROM google_account 
		        WHERE email ={$this->db->escape($email)} ";

		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0) {

		 	$user_data = $result->result();
		 	return $user_data;
		 } else {
		 	return false;
		 }	
	}
	/**
	 * Function to check the user roles
	 * @param type $email 
	 * @return type
	 */
	function checkUserRole($email) {

		$sql = "SELECT * FROM admin 
		        WHERE email ={$this->db->escape($email)} ";

		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0) {

		 	$user_data = $result->result();
		 	$this->session->set_userdata('user_role', 'admin');
		 	return $user_data;
		 } else {
		 		
		 		$sql = "SELECT * FROM google_account LEFT JOIN designations ON (google_account.designation = designations.designation_id) 
		            WHERE email = {$this->db->escape($email)} ";

		    $result = $this->db->query($sql);

		    if($result->num_rows()>0) {

				 	$user_data = $result->result();
				 	//add the user role as manager
				 	if($user_data[0]->designation_name=='Project Manager') {
				 		$this->session->set_userdata('user_role', 'manager');
				 		$this->session->set_userdata('first', $user_data[0]->first);
				 	}
				 	else {
				 		$this->session->set_userdata('user_role', 'user');
				 		$this->session->set_userdata('first', $user_data[0]->first);
				 	}
				 	return true;
				}
				 else {
				 	 return false;
				}
		 }
	}
}
?>