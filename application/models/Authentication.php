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
}
?>