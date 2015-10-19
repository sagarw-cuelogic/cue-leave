<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {
	
	function __construct() {
        parent::__construct();
    }

    function getManagerEmployees($manager_id) {

    	$where 	   = array("google_account.manager_id"=>$manager_id);
    	$user_data = $this->get_user_data($where);
    	return $user_data;
    }
    function getAllManagerEmployees() {

    	 $sql = "SELECT CONCAT(e.first,' ',e.last) as employee_name ,
    	 								CONCAT(m.first,' ',m.last) as manager_name,
    	 								e.email as employee_email,
    	 								m.email as manager_email,
    	 								d1.designation_name as employee_designation,
    	 								d.designation_name as manager_designation 
    	 				 FROM google_account e 
							 LEFT JOIN designations d1  ON ( e.designation=d1.designation_id ) 
							 LEFT JOIN google_account m ON ( e.manager_id=m.id ) 	
               LEFT JOIN designations d   ON ( m.designation=d.designation_id) WHERE e.manager_id IS NOT NULL ";

    	 $result = $this->db->query($sql);
		 
			 if($result->num_rows()>0){
			 	$user_data = $result->result();
			 	return $user_data;
			 }else {
			 	return false;
			 }
    }
    function getUserById($user_id) {

    	$where     = array("google_account.id"=>$user_id);
    	$user_data = $this->get_user_data($where);
    	return $user_data;
    }

    function getManagers($user_id) {

    	$where     = array("designations.designation_name"=>'Project Manager','google_account.id !'=>$user_id);
    	$user_data = $this->get_user_data($where);
    	return $user_data;
    }
  /**
   * Function to get the user basic details with designation info.
   * @param type $where_filters 
   * @return type
   */
	function get_user_data($where_filters=null){

		 $sql = "SELECT * FROM google_account LEFT JOIN designations ON (google_account.designation = designations.designation_id) ";

		 if($where_filters){
		 	$sql.= " WHERE ";
		 	$sql.= $this->_where_string($where_filters);
		 }
		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0){
		 	$user_data = $result->result();
		 	return $user_data;
		 }else {
		 	return false;
		 }
	}
	/**
	 * Function to get all the designations loaded in database
	 * @return type
	 */
	function get_designations() {

		$sql = "SELECT * FROM designations ";
		$result = $this->db->query($sql);
		 
		 if($result->num_rows()>0){
		 	$user_data = $result->result();
		 	return $user_data;
		 }else {
		 	return false;
		 }
	}
	/**
	 * Function to add new user in db.
	 * currently not using these function as we add user directly once we login by google account
	 * @param type $input_data 
	 * @return type
	 */
	function add_new_user($input_data) {

		$user_name = $input_data['username'];
		$password  = $input_data['password'];
		$email     = $input_data['email'];
		$first     = $input_data['first'];
		$last      = $input_data['last'];


		$encrypted_password = encodeString($password);

		$role = 'user';
		//create user array to insert ibnto users table
		$user_array = array('username'=>$user_name,
							  'password'=>$encrypted_password,
							  'role'=>$role);

		$query  = $this->db->insert_string('users',$user_array);
  	$result = $this->db->query($query);
  	$id     = $this->db->insert_id();
  	//create profile array to insert into profile table
  	$profile_array = array(
  						   'first'=>$first,
  						   'last'=>$last,'email'=>$email);

  	$query  = $this->db->insert_string('google_account',$profile_array);
  	$result = $this->db->query($query);

  	if($result)
  		return true;
  	else
  		return false;
		
	}
	/**
	 * Function to update the profile of the user
	 * @param type $input_data 
	 * @return type
	 */
	function update_profile($input_data) {
	
		$email     	 = $input_data['email'];
		$first     	 = $input_data['first'];
		$last      	 = $input_data['last'];
		$phone     	 = $input_data['phone'];
		$address   	 = $input_data['address'];
		$user_id   	 = $input_data['user_id'];
		$designation = $input_data['designation'];

  	$update_array = array('first'=>$first,
  						  'last'=>$last,
  						  'email'=>$email,
  						  'phone'=>$phone,
  						  'address'=>$address,
  						  'designation'=>$designation);

  	$this->db->where('id',$user_id);
  	$result = $this->db->update('google_account',$update_array);

  	if($result)
  		return true;
  	else
  		return false;
		
	}
	/**
	 * Function to add or update the profile picture
	 * @param type $input_data 
	 * @return type
	 */
	function update_profile_picture($input_data) {
		
		$user_id   	     = $input_data['user_id'];
		$profile_picture = $input_data['profile_picture'];

  	$update_array = array('profile_picture'=>$profile_picture);

  	$this->db->where('id',$user_id);
  	$result = $this->db->update('google_account',$update_array);

  	if($result)
  		return true;
  	else
  		return false;
		
	}
	function assign_user_to_manager($manager_id,$user_id) {

		$query = "UPDATE google_account  
		          SET manager_id = {$this->db->escape($manager_id)} 
		          WHERE id = {$this->db->escape($user_id)} ";

		$result = $this->db->query($query);

    	if($result)
    		return true;
    	else
    		return false;
	}

	private function _where_string($where){

	  foreach($where as $key => $value){
	     
	          $wheres[] = "{$key}= {$this->db->escape($value)}";
	      
	  }

	  $where_string = implode(' AND ', $wheres);

	  return $where_string;
	}
}
?>