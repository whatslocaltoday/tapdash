<?php
class Chart_data extends CI_Controller {
    var $limit = '';
    var $offset = '';
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
        $this->load->model('admin/Admintype_model');
        $this->load->model('admin/Account_model');
        $this->load->model('admin/CreateAccount');
        $this->load->model('admin/Login_model');
        $this->url = uri_string();
        if (!$this->logged) {
            redirect(base_url() . 'login/');
        }
    }
    public function homepage_getfirstgrapho() {
        $firstSelectDate = $this->input->post('firstSelectDate');
        $lastSelectDate = $this->input->post('lastSelectDate');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Account_model->fetch_graph_data_under_useraccount_with_seletdeddat($firstSelectDate, $lastSelectDate)));
    }
    public function homepage_getfirstgrapho_Google() {
        $firstSelectDate = $this->input->post('firstSelectDate');
        $lastSelectDate = $this->input->post('lastSelectDate');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Account_model->fetch_graph_data_under_useraccount_with_seletdeddat_google($firstSelectDate, $lastSelectDate)));
    }
    public function homepage_getfirstgrapho_Facebbok() {
        $firstSelectDate = $this->input->post('firstSelectDate');
        $lastSelectDate = $this->input->post('lastSelectDate');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Account_model->fetch_graph_data_under_useraccount_with_seletdeddat_facebbok($firstSelectDate, $lastSelectDate)));
    }
    public function get_timezone() {
        $ajcountry = $this->input->post('ajcountry');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->fetch_per_country_zone($ajcountry)));
    }
    public function get_master_role() {
        $ajdevice = $this->input->post('ajdevice');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->fetch_per_user_masterlist_role($ajdevice)));
    }
    public function session_check() {
        if ($this->session->userdata('logged_in') != null) return TRUE;
        else return FALSE;
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
            // die;
            
        } else {
            $data = 0;
        }
        return $data;
    }
}
?>