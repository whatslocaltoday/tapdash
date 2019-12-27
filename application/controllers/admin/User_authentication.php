<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

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
        //$this->config->load('googleplus');
        $this->load->library('form_validation');
        $this->load->model('admin/Login_model');
        $this->load->library('Googleplus');
    }




    // Show login page



    public function index() {

        //ggoole login 


        if(isset($_GET['code']))
		{
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login_google',true);
			$this->session->set_userdata('userProfile',$this->googleplus->getUserInfo());
			redirect($this->google_login_process());
		}
      
        
        $data['loginURL'] = $this->googleplus->loginURL();
        $data['message_display'] ='';
        $data['error_message'] ='';


        $this->load->view('users/login',$data);
    }


 
    // Show registration page
 
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




    public function google_login_process() {
       
        if($this->session->userdata('login_google') == true)
		{
            $profileData = $this->session->userdata('userProfile');
        }
        else
        {
            redirect($this->index()); 
        }

        $result = $this->Login_model->email_exists($profileData['email']);

       if ($result == false) {
           
            if (isset($this->session->userdata['logged_in'])) {
                redirect(base_url() . 'dashboard');
            } 
            else if(!empty($profileData))
            {
                redirect($this->registration_user_client_google()); 
            }
            
            else {
                $this->session->set_flashdata('error_message', 'Email id or Password mismatch');
                redirect(base_url() . 'login');
            }
        } else {
         
            $data = array('u_email' => $profileData['email'],'u_photo'=> $profileData['picture']);
    
            $result12 = $this->Login_model->login_google($data);
            if ($result12 == TRUE) {
                redirect(base_url() . 'dashboard');
            } else {
                $this->session->set_flashdata('error_message', 'Email id or Password mismatch');
                redirect(base_url() . 'login');
            }
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

 
    // Logout from admin page
    public function logout() {
        if($this->session->userdata('login_google') == true)
		{
            $this->googleplus->revokeToken();
        }
        $sess_array = array('username' => '','session_photo' =>'', 'projID' => '', 'user_id' => '','login_google'=>'','userProfile'=>'', 'uemail' => '', 'role_id' => '', 'session_role_name' => '', 'logged_in' => '', 'user_ap' => '', 'user_name' => '', 'uemail' => '');
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->session->sess_destroy();
        $this->session->set_flashdata('success_message', 'Successfully Lagout');
        redirect(base_url() . 'login');
    }
    public function registration_user_clientview() {

        if(isset($_GET['code']))
		{
         
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login_google',true);
            $this->session->set_userdata('userProfile',$this->googleplus->getUserInfo());
            
			redirect($this->registration_user_client_google());
		}
      
        
        $data['loginURL'] = $this->googleplus->loginURL();
        $data['message_display'] ='';
        $data['error_message'] ='';


        $this->load->view('users/registration',$data);

        //$this->load->view('users/registration', array('message_display' => '', 'error_message' => ''));
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
        //$this->form_validation->set_rules('proj_website', 'Webiste is alredy exist', 'trim|required|xss_clean|is_unique[project_details.website]');
        if ($this->form_validation->run() == false) {
            $data = array('f_name' => $this->input->post('f_name'), 'l_name' => $this->input->post('l_name'), 'proj_name' => $this->input->post('proj_name'), 'proj_website' => $this->input->post('proj_website'), 'u_email' => $this->input->post('u_email'));
            $cookie = array('name' => 'unsucsess_cokiee', 'value' => 'An account already exist, please use Login screen to access', 'expire' => 2, 'prefix' => 'dash_',);
            set_cookie($cookie);
         
            redirect(base_url() . 'registration', $data);
           
            
        } else {
            //for user table
            $insdatauser = array('f_name' => $this->input->post('f_name'), 'l_name' => $this->input->post('l_name'), 'u_email' => $this->input->post('u_email'), 'n_password' => $this->input->post('n_password'), 'cdate' => date('Y-m-d'));
           // $insdatauser = array('f_name' => $this->input->post('f_name'), 'l_name' => $this->input->post('l_name'), 'proj_name' => $this->input->post('proj_name'), 'proj_website' => $this->input->post('proj_website'), 'u_email' => $this->input->post('u_email'), 'n_password' => $this->input->post('n_password'), 'cdate' => date('Y-m-d'));
            $res = $this->Login_model->registration_insertclientadmin($insdatauser);
            if ($res) {
                $cookie = array('name' => 'sucsess_cokiee', 'value' => 'Thank You For Registration', 'expire' => 2, 'prefix' => 'dash_',);
                set_cookie($cookie);
                redirect(base_url() . 'login');
            }
        }
    }



    public function registration_user_client_google() {

        if($this->session->userdata('login_google') == true)
		{
            $profileData = $this->session->userdata('userProfile');
        }
        else
        {
            redirect($this->registration_user_clientview()); 
        }


          $user_email = $profileData['email'];
         $f_name = $profileData['given_name'];
       
        if ($user_email == '' || $f_name == "") {
            redirect(base_url() . 'registration');
        }
      
      
            //for user table
            $insdatauser = array('f_name' => $profileData['given_name'], 'l_name' => $profileData['family_name'], 'u_email' => $profileData['email'], 'u_photo' => $profileData['picture'], 'cdate' => date('Y-m-d'));
           // $insdatauser = array('f_name' => $this->input->post('f_name'), 'l_name' => $this->input->post('l_name'), 'proj_name' => $this->input->post('proj_name'), 'proj_website' => $this->input->post('proj_website'), 'u_email' => $this->input->post('u_email'), 'n_password' => $this->input->post('n_password'), 'cdate' => date('Y-m-d'));
            $res = $this->Login_model->registration_insertclientadmin_google($insdatauser);
            if ($res) {
                $cookie = array('name' => 'sucsess_cokiee', 'value' => 'Thank You For Registration', 'expire' => 2, 'prefix' => 'dash_',);
                set_cookie($cookie);
               
                redirect($this->google_login_process()); 
            }
        
    }
}
?>