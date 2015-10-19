<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leaves extends CI_Model {
	
	function __construct() {
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
    						  'leave_plan'=>$leave_plan,
                              'leave_status'=>'pending');

    	$query  = $this->db->insert_string('user_leaves',$insert_array);
    	$result = $this->db->query($query);
    	if($result)
    		return true;
    	else
    		return false;
    }

    function update_leaves($input_data) {

        $user_id            = $input_data['user_id'];
        $leave_subject      = $input_data['leave_subject'];
        $leave_description  = $input_data['leave_description'];
        $leave_start_date   = $input_data['leave_start_date'];
        $leave_end_date     = $input_data['leave_end_date'];
        $leave_type         = $input_data['leave_type'];
        $leave_plan         = $input_data['leave_plan'];
        $leave_id           = $input_data['leave_id'];

        $start_date         = date('Y-m-d',strtotime($leave_start_date));
        $end_date           = date('Y-m-d',strtotime($leave_end_date));
        
        $update_array = array('user_id'=>$user_id,
                              'leave_subject'=>$leave_subject,
                              'leave_description'=>$leave_description,
                              'leave_start_date'=>$start_date,
                              'leave_end_date'=>$end_date,
                              'leave_type'=>$leave_type,
                              'leave_plan'=>$leave_plan,
                              'leave_status'=>'pending');

        $this->db->where('leave_id',$leave_id);
        $result = $this->db->update('user_leaves',$update_array);
        if($result)
            return true;
        else
            return false;
    }

    function get_user_leaves($user_id,$role=null) {

    	$query = "SELECT ul.*, ga.first,ga.last,ga.profile_picture 
    	          FROM user_leaves ul, google_account ga
    	          WHERE ul.user_id =ga.id ";
        switch ($role) {
            case 'user':
                $query.="AND ul.user_id = {$this->db->escape($user_id)}";
                break;
            case 'manager':
                $query.="AND ul.manager_id = {$this->db->escape($user_id)}";
                break;
            default:
             $query.="AND ul.user_id = {$this->db->escape($user_id)}";
            break;
        }
    	
    	$result = $this->db->query($query); 

    	if($result->num_rows()>0)
    		return $result->result();
    	else
    		return array();
    }
    function get_leave_details($leave_id,$user_id) {

        $query = " SELECT *
                  FROM user_leaves 
                  WHERE leave_id = {$this->db->escape($leave_id)} and user_id ={$this->db->escape($user_id)}";

        $result = $this->db->query($query); 

        if($result->num_rows()>0)
            return $result->result();
        else
            return array();         
    }
    function get_holiday_list() {

        $query = " SELECT * FROM holiday_list ";

        $result = $this->db->query($query); 

        if($result->num_rows()>0)
            return $result->result();
        else
            return array();         
    }
    
    function manage_leaves($input_data) {

        $leave_comments = $input_data['leave_comments'];
        $leave_status   = $input_data['leave_status'];
        $manager_id     = $input_data['manager_id'];
        $leave_id       = $input_data['leave_id'];

        $update_array = array('leave_comments'=>$leave_comments,
                              'leave_status'=>$leave_status,
                              'manager_id'=>$manager_id);

        $this->db->where('leave_id', $leave_id);
        $this->db->update('user_leaves', $update_array);
    }
}
?>