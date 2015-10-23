<?php
/**
 * The Login Controller file is used for the login PHP version 5.6.10
 * @category Front-Controller
 * @package  CodeIgniter
 * @author   Sagar sagarwadiyar@cuelogic.co.in
 * @license  www.cuelogic.com cuelogic
 * @link     http://cue-leave/application/controllers/Login.php
 **/
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Function to add the user leaves
     * @return type
     */
    public function add_leave()
    {

        if (!$this->session->userdata('user_id')>0) {
            redirect('login');
        }
    
        $form_data = $this->input->post();
    
        $form_data['user_id'] = $this->session->userdata('user_id');

        //set the start date and end date for the one day and half day leave
        if ($form_data['leave_plan'] =='half_day'
            || $form_data['leave_plan']=='one_day'
        ) {
            $form_data['leave_start_date'] = $form_data['date'];
            $form_data['leave_end_date']   = $form_data['date'];
            unset($form_data['date']);
        }
    
        $this->load->model('leaves');

        $result = $this->leaves->add_leaves($form_data);

        if ($result) {
            $this->session->set_flashdata('success', 'You have successfully applied for the leave');
        } else {
            $this->session->flashdata('error', 'Sorry We are unable to process the request');
        }
        redirect('user/landing/add_leaves');

    }
    /**
     * Function to update the leave
     * @return type
     */
    public function update_leave()
    {

        if (!$this->session->userdata('user_id')>0) {
            redirect('login');
        }
    
        $form_data = $this->input->post();
    
        $form_data['user_id'] = $this->session->userdata('user_id');
        $leave_id = $form_data['leave_id'];
        
        if ($form_data['leave_plan'] =='half_day'
            || $form_data['leave_plan']=='one_day'
        ) {
            $form_data['leave_start_date'] = $form_data['date'];
            $form_data['leave_end_date']   = $form_data['date'];
            unset($form_data['date']);
        }
    
        $this->load->model('leaves');
        $result = $this->leaves->update_leaves($form_data);
        if ($result) {
            $this->session->set_flashdata('success', 'You have successfully updated your leave');
        } else {
            $this->session->flashdata('error', 'Sorry We are unable to process the request');
        }
        redirect('user/landing/edit_leave/'.$leave_id);

    }
    /**
     * Leave action handle by manager of the employees under him
     * @return type
     */
    public function ajaxLeaveAction()
    {

        $form_data = $this->input->post();

        $form_data['manager_id'] = $this->session->userdata('user_id');

        $this->load->model('leaves');
        $result = $this->leaves->add_leave_comments($form_data);
    }
}
