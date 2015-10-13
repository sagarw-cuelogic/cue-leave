<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_login extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function validateUser($input_data){

		$username = $input_data['username'];
		$password = $input_data['password'];

		$sql = "SELECT * FROM users 
		        WHERE username ={$this->db->escape($username)} AND password ={$this->db->escape($password)} ";
		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0){
		 	$user_data = $result->result();
		 	$this->session->set_userdata('user_id', $user_data[0]->id);
		 	return true;
		 }
		 	
		 else
		 	return false;
	}
}
?>