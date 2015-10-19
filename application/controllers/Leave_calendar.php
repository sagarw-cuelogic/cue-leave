<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_calendar extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

function generateLeaveCalender(){

	$this->load->model('leaves');
	$this->load->library('calendar');
	$this->load->helper('leave_date');
	$highlight_date = array();
	$days = array();
	$form_data = $this->input->post();
	$leave_id  = $form_data['leave_id'];
	$user_id   = $form_data['user_id'];
	$dates     = $this->leaves->get_leave_details($leave_id,$user_id);
	
	$start_date_month = date('m',strtotime($dates[0]->leave_start_date));
	$start_date_year  = date('Y',strtotime($dates[0]->leave_start_date));
	$start_date       = $dates[0]->leave_start_date;
	$end_date         = $dates[0]->leave_end_date;
	
	$end_date_month = date('m',strtotime($dates[0]->leave_end_date));
	$end_date_year  = date('Y',strtotime($dates[0]->leave_end_date));
    
    $days = businessWorkingDays($start_date,$end_date,true);
   
   	foreach ($days as $key => $value) {
   		$month = date('m',strtotime($value));
   		$d = ltrim(date('d',strtotime($value)), '0');
   		$highlight_date[$month][$d]= '#';
   	}
    
    for ($i=$start_date_month; $i <=$end_date_month ; $i++) { 

    	$selected_date = $highlight_date[$i];
    	$calendars[] = $this->calendar->generate($start_date_year, $i,$selected_date);
    }
    $page_data = array('calendars'=>$calendars);
    //$this->load->view('common/header');
	$this->load->view('utilities/calendar',$page_data);
	//$this->load->view('common/footer');
}
}
?>