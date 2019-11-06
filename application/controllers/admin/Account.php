<?php
class Account extends CI_Controller {
    private $logged = '';
    private $check_premission = "";
    private $url = "";
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-cache, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        $this->load->library("pagination");
        $this->logged = $this->session_check();
        $this->load->helper(array('cookie', 'url'));
        $this->load->model('admin/Setting_model');
        $this->load->model('admin/Admintype_model');
        $this->load->model('admin/Account_model');
        $this->url = uri_string();
        if (!$this->logged) {
            redirect(base_url() . 'login/');
        }
    }
    public function accounts() {
        $role_id = $this->session->userdata('role_id');
        $all_count = $this->Account_model->read_count_fetch_webiste_under_useraccount($role_id);
        $config = array('base_url' => base_url('admin/Account/accounts'), 'per_page' => 20, 'total_rows' => $all_count, 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_link' => false, 'last_link' => false, 'first_tag_open' => '<li class="page-link">', 'first_tag_close' => '</li>', 'prev_link' => 'Previous ', 'prev_tag_open' => '<li class="page-link">', 'prev_tag_close' => '</li>', 'next_link' => ' Next', 'next_tag_open' => '<li>', 'next_tag_close' => '</li>', 'last_tag_open' => '<li>', 'last_tag_close' => '</li>', 'cur_tag_open' => '<li class="page-item active"><a class="page-link">', 'cur_tag_close' => '</a></li>', 'num_tag_open' => '<li class="page-link">', 'num_tag_close' => '</li>',);
        $this->pagination->initialize($config);
        $uri = $this->uri->segment(5);
        $data["results"] = $this->Account_model->fetch_webiste_under_useraccount($role_id, $config["per_page"], $this->uri->segment(4));
        $data['all_count'] = $all_count;
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('account/accounts', $data);
        $this->load->view('template/footer');
    }
    public function get_timezone() {
        $ajcountry = $this->input->post('ajcountry');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->fetch_per_country_zone($ajcountry)));
    }
    // get master list per user
    public function get_master_role() {
        $ajdevice = $this->input->post('ajdevice');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->fetch_per_user_masterlist_role($ajdevice)));
    }
    // get permission list per user
    public function get_permission_list() {
        $ajper = $this->input->post('ajper');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->permision_list($ajper)));
    }
    // get role per user when permission change
    public function get_role_per_user_as_change() {
        $ajdevice = $this->input->post('ajdevice');
        $userid = $this->input->post('userid');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->get_role_per_user_as_change($ajdevice, $userid)));
    }
    // get direct manager porj
    public function get_directmanagerporj() {
        $project_id = $this->input->post('project_id');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Account_model->get_directmanagerasper_proj($project_id)));
    }
    //change user activation
    public function update_user_flag() {
        $ajdevice = $this->input->post('ajdevice');
        $ajuserid = $this->input->post('ajuserid');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->update_user_flag_status($ajdevice, $ajuserid)));
    }
    //change account activation
    public function update_project_flag() {
        $ajdevice = $this->input->post('ajdevice');
        $ajuserid = $this->input->post('ajuserid');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->update_project_flag_status($ajdevice, $ajuserid)));
    }
    public function session_check() {
        if ($this->session->userdata('logged_in') != null) return TRUE;
        else return FALSE;
    }
    function check_default() {
        $option = $this->input->post('user_type');
        if ($option == 0) {
            $this->form_validation->set_message('check_default', 'Please Select %s');
            return false;
        } else {
            return true;
        }
    }
    public function check_type($post) {
        if ($post == 0) {
            $this->form_validation->set_message('check_type', 'Please Select %s');
            return false;
        } else {
            return true;
        }
    }
    public function check_permission($post) {
        $user_ap = $this->session->userdata('user_ap');
        $menu_option = explode(",", $user_ap);
        if (in_array($post, $menu_option, true)) {
            $data = 1;
        } else {
            $data = 0;
        }
        return $data;
    }
}
?>