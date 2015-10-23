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

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
    * Function to load the landing page
    * @return type
    */
    public function index()
    {
        $this->landing();
    }
    /**
    * Function to load landing page as per the navigation
    * @param type $page_topic
    * @return type
    */
    public function landing($page_topic = 'view_leaves')
    {
        //access only for the admin users
        if ($this->session->userdata('user_id')>0
            && $this->session->userdata('user_role')!='admin'
        ) {
            redirect('login');
        }
        $this->load->model('users');

        $user_id   = $this->session->userdata('user_id');
        $script    = array();
        $page_data = array();
        $employee_id ='';

        switch ($page_topic) {
        //manage the employees
            case 'manage_employees':
                $user_data = $this->users->get_user_data();
                $page_data['emp_data']   = $user_data;
                $script    = array('scripts'=>array('assign_employee'));
                break;
             //view the manager employees
            case 'view_employees':
                $user_data = $this->users->getAllManagerEmployees();
                break;
             //view the user leaves
            case 'view_leaves':
                $this->load->model('leaves');
                $this->load->helper('leave_date');
                $user_role   = $this->session->userdata('user_role');
                $script    = array('scripts'=>array('manage_leave'));
                $user_data = $this->leaves->get_user_leaves($user_id, $user_role);
                $page_data['leave_data'] = $user_data;
                break;
             //view user profile
            case 'profile':
                $employee_id = (int)$this->uri->segment(4);
               
                $user_data = $this->users->getUserById($employee_id);

                if (!$employee_id || empty($user_data)) {
                    redirect('admin/landing/manage_employees');
                }
                $designations = $this->users->get_designations();
                $script    = array('scripts'=>array('profile'));
                $page_data['designations'] = $designations;
                $user_data = $user_data[0];
                break;
             //edit user profile
            case 'edit_profile':
                $form_data = $this->input->post();

                if ($form_data) {
                    $this->load->model('users');

                    $employee_id = (int)$this->uri->segment(4);

                    if (!$employee_id) {
                        redirect('admin/landing/');
                    }

                    $user_id   = $this->session->userdata('user_id');
                    $user_role  = $this->session->userdata('user_role');
                    $form_data['user_id'] = $employee_id;
                    $result = $this->users->update_profile($form_data);
                
                    if ($result) {
                        $this->session->set_flashdata('success', 'You have successfully updated your profile');
                    } else {
                        $this->session->flashdata('error', 'Sorry We are unable to process the request');
                    }
                    redirect('admin/landing/profile/'.$employee_id);
                }
                break;
            default:
                    $this->load->model('leaves');
                    $this->load->helper('leave_date');
                    $user_role   = $this->session->userdata('user_role');
                    $user_data = $this->leaves->get_user_leaves($user_id, $user_role);
                break;
        }
  
        $page_data['navigation']  = $page_topic;
        $page_data['user_data']   = $user_data;
        $page_data['controller']  = 'admin';
        $page_data['employee_id'] = ($employee_id)?$employee_id:NULL;
        
        $this->load->view('common/header', $script);
        $this->load->view('landing_page', $page_data);
        $this->load->view('common/footer');
  
    }
      /**
      * Function to assign employee manager
      * @param type $action
      * @return type
      */
    public function assign_to_manager($action)
    {

        $this->load->model('users');
        $post = $this->input->post();
        $user_id = $post['user_id'];

        switch ($action) {
            case 'assign':
                  $manager_id = $post['manager'];
                break;
            case 'unassign':
                  $manager_id = NULL;
                break;
        }

        $this->users->assign_user_to_manager($manager_id, $user_id);
        return TRUE;
    }
}
