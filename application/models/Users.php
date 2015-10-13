<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function get_user_data($id){

		$user_id = $id;

		$sql = "SELECT * FROM user_profile
		        WHERE user_id ={$this->db->escape($user_id)}";
		        
		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0){
		 	$user_data = $result->result();
		 	return $user_data;
		 }
		 	
		 else
		 	return false;
	}
}
?>