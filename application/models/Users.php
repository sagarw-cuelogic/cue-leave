<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function get_user_data($where_filters=null){

		

		 $sql = "SELECT * FROM user_profile ";

		 if($where_filters){
		 	$sql.= " WHERE ";
		 	$sql.= $this->_where_string($where_filters);
		 }
		
		        
		 $result = $this->db->query($sql);
		 
		 if($result->num_rows()>0){
		 	$user_data = $result->result();
		 	return $user_data;
		 }
		 	
		 else
		 	return false;
	}
	function get_designations() {

		$sql = "SELECT * FROM designations ";
		$result = $this->db->query($sql);
		 
		 if($result->num_rows()>0){
		 	$user_data = $result->result();
		 	return $user_data;
		 }
		 else
		 	return false;
	}
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
    	$profile_array = array('user_id'=>$id,
    						   'first'=>$first,
    						   'last'=>$last,'email'=>$email);

    	$query  = $this->db->insert_string('user_profile',$profile_array);
    	$result = $this->db->query($query);

    	if($result)
    		return true;
    	else
    		return false;
		
	}
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

    	$this->db->where('user_id',$user_id);
    	$result = $this->db->update('user_profile',$update_array);

    	if($result)
    		return true;
    	else
    		return false;
		
	}
	function update_profile_picture($input_data) {
	
		
		$user_id   	     = $input_data['user_id'];
		$profile_picture = $input_data['profile_picture'];

    	$update_array = array('profile_picture'=>$profile_picture);

    	$this->db->where('user_id',$user_id);
    	$result = $this->db->update('user_profile',$update_array);

    	if($result)
    		return true;
    	else
    		return false;
		
	}
	function assign_user_to_manager($manager_id,$user_id) {

		$query = "UPDATE user_profile  
		        SET manager_id = {$this->db->escape($manager_id)} 
		        WHERE user_id = {$this->db->escape($user_id)} ";

		$result = $this->db->query($query);

    	if($result)
    		return true;
    	else
    		return false;


	}
	private function _where_string($where){

        foreach($where as $key => $value){
           
                $wheres[] = "{$key} = {$this->db->escape($value)}";
            
        }

        $where_string = implode(' AND ', $wheres);

        return $where_string;
    }
}
?>