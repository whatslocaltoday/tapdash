<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
Class User_authentication extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-cache, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->helper(array('cookie', 'url'));
        // Load database
        $this->load->library('form_validation');
        $this->load->model('admin/Login_model');
    }
    // Show login page
    public function index() {
        $this->load->view('users/login', array('message_display' => '', 'error_message' => ''));
    }
    // Show registration page
    public function user_registration_show() {
        //$this->load->view('admin/admin-registration');
        
    }
    // Validate and store registration data in database
    // Check for user login process
    function email_exists() {
        $u_email = $this->input->post('u_email');
        $result = $this->Login_model->email_exists($u_email);
        if ($result == TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function user_login_process() {
        $this->form_validation->set_rules('u_email', 'Email', 'trim|required|xss_clean|callback_email_exists');
        $this->form_validation->set_rules('u_password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            if (isset($this->session->userdata['logged_in'])) {
                redirect(base_url() . 'dashboard');
            } else {
                $this->session->set_flashdata('error_message', 'Email id or Password mismatch');
                redirect(base_url() . 'login');
            }
        } else {
            $data = array('u_email' => $this->input->post('u_email'), 'u_password' => md5($this->input->post('u_password')));
            $result = $this->Login_model->login($data);
            if ($result == TRUE) {
                redirect(base_url() . 'dashboard');
            } else {
                $this->session->set_flashdata('error_message', 'Email id or Password mismatch');
                redirect(base_url() . 'login');
            }
        }
    }
    // public function forgot_Pass_word($auth) {
    // 	if($auth !='')
    // 	{
    // 		$cond = "f_pass_auth =".$auth ." and flag=1";
    // 		$this->db->select('*');
    // 		$this->db->from('user');
    // 		$this->db->where($cond);
    // 		$this->db->limit(1);
    // 		$query1 = $this->db->get();
    // 		if ($query1->num_rows() == 1) {
    // 			$this->load->view('account/accounts', $auth);
    // 		}
    // 		else
    // 		{
    // 			$this->session->set_flashdata('error_message', 'url does not exit');
    // 			redirect(base_url().'login');
    // 		}
    // 	}
    // 	else
    // 	{
    // 		$this->session->set_flashdata('error_message', 'url does not exit');
    // 		redirect(base_url().'login');
    // 	}
    // }
    //check permission for user
    // Logout from admin page
    public function logout() {
        $sess_array = array('username' => '', 'projID' => '', 'user_id' => '', 'uemail' => '', 'role_id' => '', 'session_role_name' => '', 'logged_in' => '', 'user_ap' => '', 'user_name' => '', 'uemail' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->session->sess_destroy();
        $this->session->set_flashdata('success_message', 'Successfully Lagout');
        redirect(base_url() . 'login');
    }
    public function registration_user_clientview() {
        $this->load->view('users/registration', array('message_display' => '', 'error_message' => ''));
    }
    public function check_type($post) {
        if ($post == 0) {
            $this->form_validation->set_message('check_type', 'Please Select %s');
            return false;
        } else {
            return true;
        }
    }
    //reset password
    public function resetPassword() {
        $this->load->view('users/reset-password', array('message_display' => '', 'error_message' => ''));
    }
    public function reset_send_password() {
        $user_email = $this->input->post('u_email');
        $res = $this->Login_model->send_reset_password($user_email);
        $this->session->set_flashdata('success_message', 'Password send to you email');
        redirect(base_url() . 'login');
    }
    // New user registration for user type 5 (Client Account Admin)
    public function registration_user_client() {
        $user_email = $this->input->post('u_email');
        $f_name = $this->input->post('f_name');
        if ($user_email == '' || $f_name == "") {
            redirect(base_url() . 'registration');
        }
        $this->form_validation->set_rules('u_email', 'Email ID is alredy exist', 'trim|required|xss_clean|is_unique[user.u_email]');
        $this->form_validation->set_rules('proj_website', 'Webiste is alredy exist', 'trim|required|xss_clean|is_unique[project_details.website]');
        if ($this->form_validation->run() == false) {
            $data = array('f_name' => $this->input->post('f_name'), 'l_name' => $this->input->post('l_name'), 'proj_name' => $this->input->post('proj_name'), 'proj_website' => $this->input->post('proj_website'), 'u_email' => $this->input->post('u_email'));
            $cookie = array('name' => 'unsucsess_cokiee', 'value' => 'An account already exist, please use Login screen to access', 'expire' => 2, 'prefix' => 'dash_',);
            set_cookie($cookie);
            // print_r($cookie);
            // die;
            redirect(base_url() . 'registration', $data);
            //$this->load->view('users/registration',$data);
            
        } else {
            //for user table
            $insdatauser = array('f_name' => $this->input->post('f_name'), 'l_name' => $this->input->post('l_name'), 'proj_name' => $this->input->post('proj_name'), 'proj_website' => $this->input->post('proj_website'), 'u_email' => $this->input->post('u_email'), 'n_password' => $this->input->post('n_password'), 'cdate' => date('Y-m-d'));
            $res = $this->Login_model->registration_insertclientadmin($insdatauser);
            if ($res) {
                $cookie = array('name' => 'sucsess_cokiee', 'value' => 'Thank You For Registration', 'expire' => 2, 'prefix' => 'dash_',);
                set_cookie($cookie);
                redirect(base_url() . 'login');
            }
        }
    }
}
?>