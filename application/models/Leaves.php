<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leaves extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

    function add_leaves($input_data) {

    	$user_id 			= $input_data['user_id'];
    	$leave_subject 		= $input_data['leave_subject'];
    	$leave_description  = $input_data['leave_description'];
    	$leave_start_date 	= $input_data['leave_start_date'];
    	$leave_end_date 	= $input_data['leave_end_date'];
    	$leave_type 		= $input_data['leave_type'];
    	$leave_plan 		= $input_data['leave_plan'];

		$start_date 		= date('Y-m-d',strtotime($leave_start_date));
		$end_date 			= date('Y-m-d',strtotime($leave_end_date));
    	
    	$insert_array = array('user_id'=>$user_id,
    						  'leave_subject'=>$leave_subject,
    						  'leave_description'=>$leave_description,
    						  'leave_start_date'=>$start_date,
    						  'leave_end_date'=>$end_date,
    						  'leave_type'=>$leave_type,
    						  'leave_plan'=>$leave_plan);

    	$query  = $this->db->insert_string('users_leaves',$insert_array);
    	$result = $this->db->query($query);
    	if($result)
    		return true;
    	else
    		return false;
    }
    function get_user_leaves($user_id,$role) {

    	$query = "SELECT ul.*, up.first,up.last 
    	          FROM users_leaves ul, user_profile up
    	          WHERE ul.user_id =up.user_id ";
        switch ($role) {
            case 'user':
                $query.="AND ul.user_id = {$this->db->escape($user_id)}";
                break;
            case 'admin':
                $query.="AND up.manager_id = {$this->db->escape($user_id)}";
                break;
            default:
                break;
        }
    	
    	$result = $this->db->query($query); 

    	if($result->num_rows()>0)
    		return $result->result();
    	else
    		return array();
    }
}
?>