<?php
class Setting extends CI_Controller {
    private $limit = '';
    private $offset = '';
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
        $this->url = uri_string();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-cache, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
        if (!$this->logged) {
            redirect(base_url() . 'login/');
        }
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
    public function get_permission_list() {
        $ajper = $this->input->post('ajper');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->permision_list($ajper)));
    }
    public function get_role_per_user_as_change() {
        $ajdevice = $this->input->post('ajdevice');
        $userid = $this->input->post('userid');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->get_role_per_user_as_change($ajdevice, $userid)));
    }
    public function update_user_flag() {
        $ajdevice = $this->input->post('ajdevice');
        $ajuserid = $this->input->post('ajuserid');
        header('Content-Type: application/x-json; charset=utf-8');
        echo (json_encode($this->Admintype_model->update_user_flag_status($ajdevice, $ajuserid)));
    }
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
            // die;
            
        } else {
            $data = 0;
        }
        return $data;
    }
    public function permission_add_show() {
        $post = '55';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $permsn_list = $this->Admintype_model->permision_list($limit, $offset);
            $data = array("permsn_name" => $this->input->post('permsn_name'), "message_display" => "");
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/add_permission', $data);
            $this->load->view('template/footer');
        }
    }
    public function new_permission_add() {
        $post = '55';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $this->form_validation->set_rules('permsn_name', 'Permission Name', 'trim|required|is_unique[permission.name]');
            if ($this->form_validation->run() == FALSE) {
                $data = array("permsn_name" => $this->input->post('permsn_name'), "message_display" => "");
                $this->load->view('template/header');
                $this->load->view('template/sidebar');
                $this->load->view('setting/add_permission', $data);
                $this->load->view('template/footer');
            } else {
                $data1 = array("permsn_name" => $this->input->post('permsn_name'));
                $result = $this->Setting_model->permission_insert($data1);
                if ($result == TRUE) {
                    $data2 = array("permsn_name" => "", "message_display" => "Added Successfully!");
                    $this->load->view('template/header');
                    $this->load->view('template/sidebar');
                    $this->load->view('setting/add_permission', $data2);
                    $this->load->view('template/footer');
                } else {
                    $data2 = array("permsn_name" => $this->input->post('permsn_name'), "message_display" => "Something Went Wrong!");
                    $this->load->view('template/header');
                    $this->load->view('template/sidebar');
                    $this->load->view('setting/add_permission', $data2);
                    $this->load->view('template/footer');
                }
            }
        }
    }
    public function list_permission() {
        $post = '56';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $role_id = $this->session->userdata('role_id');
            $all_count = $this->Admintype_model->read_count_permision_list();
            $config = array('base_url' => base_url('admin/Setting/list_permission'), 'per_page' => 10, 'total_rows' => $all_count, 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_link' => false, 'last_link' => false, 'first_tag_open' => '<li class="page-link">', 'first_tag_close' => '</li>', 'prev_link' => 'Previous ', 'prev_tag_open' => '<li class="page-link">', 'prev_tag_close' => '</li>', 'next_link' => ' Next', 'next_tag_open' => '<li>', 'next_tag_close' => '</li>', 'last_tag_open' => '<li>', 'last_tag_close' => '</li>', 'cur_tag_open' => '<li class="page-item active"><a class="page-link">', 'cur_tag_close' => '</a></li>', 'num_tag_open' => '<li class="page-link">', 'num_tag_close' => '</li>',);
            $this->pagination->initialize($config);
            $uri = $this->uri->segment(5);
            $data["results"] = $this->Admintype_model->permision_list($config["per_page"], $this->uri->segment(4));
            $data['all_count'] = $all_count;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/manage-permission', $data);
            $this->load->view('template/footer');
        }
    }
    public function view_edit_permission() {
        $post = '56';
        $permsn_id = $this->input->post('permsn_id');
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0' || $permsn_id === NULL) {
            redirect(base_url() . 'dashboard');
        } else {
            $result = $this->Setting_model->permision_list($permsn_id);
            foreach ($result as $row) {
                $data = array("id" => $row->id, "p_name" => $row->name, "message_display" => "");
            }
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-permission', $data);
            $this->load->view('template/footer');
        }
    }
    //get user data for edite
    public function edit_permission() {
        $permsn_id = $this->input->post('id');
        $post = '56';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0' || $permsn_id === NULL || $permsn_id == '') {
            redirect(base_url() . 'dashboard');
        }
        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('p_name', 'Permission Name', 'trim|required|is_unique[permission.name]');
        if ($this->form_validation->run() == FALSE) {
            $data = array("p_name" => $this->input->post('p_name'), "message_display" => "");
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-permission', $data);
            $this->load->view('template/footer');
        } else {
            $data1 = array("name" => $this->input->post('p_name'));
            $result = $this->Setting_model->permission_name_update($data1, $permsn_id);
            if ($result == TRUE) {
                $data2 = array("id" => $permsn_id, "p_name" => $this->input->post('p_name'), "message_display" => "Update Successfully!");
                $this->load->view('template/header');
                $this->load->view('template/sidebar');
                $this->load->view('setting/edit-permission', $data2);
                $this->load->view('template/footer');
            } else {
                $data2 = array("p_name" => $this->input->post('p_name'), "message_display" => "Something Went Wrong!");
                $this->load->view('template/header');
                $this->load->view('template/sidebar');
                $this->load->view('setting/edit-permission', $data2);
                $this->load->view('template/footer');
            }
        }
    }
    public function country_add_show() {
        $post = '61';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $permsn_list = $this->Admintype_model->get_country_info($limit, $offset);
            $data = array("sortname" => $this->input->post('sortname'), "cuntry_name" => $this->input->post('cuntry_name'), "cuntry_phcode" => $this->input->post('cuntry_phcode'), "message_display" => "");
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/add_countery', $data);
            $this->load->view('template/footer');
        }
    }
    public function new_country_add() {
        $post = '61';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $this->form_validation->set_rules('sortname', 'Sortname Name', 'trim|required|is_unique[countries.sortname]');
            $this->form_validation->set_rules('cuntry_name', 'Country Name', 'trim|required|is_unique[countries.name]');
            if ($this->form_validation->run() == FALSE) {
                $data = array("sortname" => $this->input->post('sortname'), "cuntry_name" => $this->input->post('cuntry_name'), "cuntry_phcode" => $this->input->post('cuntry_phcode'), "message_display" => "");
                $this->load->view('template/header');
                $this->load->view('template/sidebar');
                $this->load->view('setting/add_countery', $data);
                $this->load->view('template/footer');
            } else {
                $data1 = array("sortname" => $this->input->post('sortname'), "name" => $this->input->post('cuntry_name'), "phonecode" => $this->input->post('cuntry_phcode'));
                $result = $this->Setting_model->countery_insert($data1);
                if ($result == TRUE) {
                    $data2 = array("sortname" => "", "cuntry_name" => "", "cuntry_phcode" => "", "message_display" => "Added Successfully!");
                    $this->load->view('template/header');
                    $this->load->view('template/sidebar');
                    $this->load->view('setting/add_countery', $data2);
                    $this->load->view('template/footer');
                } else {
                    $data2 = array("sortname" => $this->input->post('sortname'), "cuntry_name" => $this->input->post('cuntry_name'), "cuntry_phcode" => $this->input->post('cuntry_phcode'), "message_display" => "Something Went Wrong!");
                    $this->load->view('template/header');
                    $this->load->view('template/sidebar');
                    $this->load->view('setting/add_countery', $data2);
                    $this->load->view('template/footer');
                }
            }
        }
    }
    public function list_country() {
        $post = '62';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $all_count = $this->Admintype_model->read_count_get_country_info();
            $config = array('base_url' => base_url('admin/Setting/list_country'), 'per_page' => 10, 'total_rows' => $all_count, 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_link' => false, 'last_link' => false, 'first_tag_open' => '<li class="page-link">', 'first_tag_close' => '</li>', 'prev_link' => 'Previous ', 'prev_tag_open' => '<li class="page-link">', 'prev_tag_close' => '</li>', 'next_link' => ' Next', 'next_tag_open' => '<li>', 'next_tag_close' => '</li>', 'last_tag_open' => '<li>', 'last_tag_close' => '</li>', 'cur_tag_open' => '<li class="page-item active"><a class="page-link">', 'cur_tag_close' => '</a></li>', 'num_tag_open' => '<li class="page-link">', 'num_tag_close' => '</li>',);
            $this->pagination->initialize($config);
            $uri = $this->uri->segment(5);
            $results = $this->Admintype_model->get_country_info($config["per_page"], $this->uri->segment(4));
            $data['results'] = $results;
            $data['all_count'] = $all_count;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/manage-country', $data);
            $this->load->view('template/footer');
        }
    }
    public function view_edit_country() {
        $post = '62';
        $countery_id = $this->input->post('countery_id');
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0' || $countery_id === NULL) {
            redirect(base_url() . 'dashboard');
        } else {
            $result = $this->Setting_model->get_country_info($countery_id);
            foreach ($result as $row) {
                $data = array("id" => $row->id, "sortname" => $row->sortname, "cuntry_name" => $row->name, "cuntry_phcode" => $row->phonecode, "message_display" => "");
            }
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-country', $data);
            $this->load->view('template/footer');
        }
    }
    public function edit_country() {
        $countery_id = $this->input->post('id');
        $post = '62';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0' || $countery_id === NULL || $countery_id == '') {
            redirect(base_url() . 'dashboard');
        }
        // Check validation for user input in SignUp form
        $this->form_validation->set_rules('sortname', 'Sortname Name', 'trim|required|is_unique[countries.sortname]');
        $this->form_validation->set_rules('cuntry_name', 'Country Name', 'trim|required|is_unique[countries.name]');
        if ($this->form_validation->run() == FALSE) {
            $data = array("id" => $this->input->post('id'), "sortname" => $this->input->post('sortname'), "cuntry_name" => $this->input->post('cuntry_name'), "cuntry_phcode" => $this->input->post('cuntry_phcode'), "message_display" => "");
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-country', $data);
            $this->load->view('template/footer');
        } else {
            $data1 = array("sortname" => $this->input->post('sortname'), "name" => $this->input->post('cuntry_name'), "phonecode" => $this->input->post('cuntry_phcode'));
            $result = $this->Setting_model->country_name_update($data1, $countery_id);
            if ($result == TRUE) {
                $this->session->set_flashdata('success_message', 'Country Info updated');
                redirect(base_url() . 'setting/edit-country/');
            } else {
                $this->session->set_flashdata('error_message', 'Something Went wrong');
                redirect(base_url() . 'setting/edit-country/');
            }
        }
    }
    //currency module
    public function list_currency() {
        $post = '60';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0') {
            redirect(base_url() . 'dashboard');
        } else {
            $role_id = $this->session->userdata('role_id');
            $all_count = $this->Setting_model->read_count_currency_info_based_on_countery();
            $config = array('base_url' => base_url('admin/Setting/list_currency'), 'per_page' => 10, 'total_rows' => $all_count, 'full_tag_open' => '<ul class="pagination">', 'full_tag_close' => '</ul>', 'first_link' => false, 'last_link' => false, 'first_tag_open' => '<li class="page-link">', 'first_tag_close' => '</li>', 'prev_link' => 'Previous ', 'prev_tag_open' => '<li class="page-link">', 'prev_tag_close' => '</li>', 'next_link' => ' Next', 'next_tag_open' => '<li>', 'next_tag_close' => '</li>', 'last_tag_open' => '<li>', 'last_tag_close' => '</li>', 'cur_tag_open' => '<li class="page-item active"><a class="page-link">', 'cur_tag_close' => '</a></li>', 'num_tag_open' => '<li class="page-link">', 'num_tag_close' => '</li>',);
            $this->pagination->initialize($config);
            $uri = $this->uri->segment(5);
            $data["results"] = $this->Setting_model->get_currency_info_based_on_countery($config["per_page"], $this->uri->segment(4));
            $data['all_count'] = $all_count;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/manage-currency', $data);
            $this->load->view('template/footer');
        }
    }
    public function view_edit_currency() {
        $post = '60';
        $currency_id = $this->input->post('currency_id');
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0' || $currency_id === NULL) {
            redirect(base_url() . 'dashboard');
        } else {
            $result = $this->Setting_model->get_currency_info($currency_id);
            foreach ($result as $row) {
                $data = array("id" => $row->id, "name" => $row->name, "code" => $row->code, "symbol" => $row->symbol, "message_display" => "");
            }
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-currency', $data);
            $this->load->view('template/footer');
        }
    }
    public function edit_currency() {
        $currency_id = $this->input->post('id');
        $post = '60';
        $ch_permsn = $this->check_permission($post);
        if ($ch_permsn == '0' || $currency_id === NULL || $currency_id == '') {
            redirect(base_url() . 'dashboard');
        }
        // Check validation for user input in SignUp form
        //    $this->form_validation->set_rules('sortname', 'Sortname Name', 'trim|required|is_unique[countries.sortname]');
        //     $this->form_validation->set_rules('cuntry_name', 'Country Name', 'trim|required|is_unique[countries.name]');
        //    if ($this->form_validation->run() == FALSE) {
        //     $data=array(
        //         "id"=>$this->input->post('id'),
        //         "sortname"=>$this->input->post('sortname'),
        //         "cuntry_name"=>$this->input->post('cuntry_name'),
        //         "cuntry_phcode"=>$this->input->post('cuntry_phcode'),
        //         "message_display"=>""
        //     );
        //            $this->load->view('template/header');
        //            $this->load->view('template/sidebar');
        //            $this->load->view('setting/edit-country', $data);
        //            $this->load->view('template/footer');
        //    }
        // else
        // {
        $data1 = array("code" => $this->input->post('code'), "name" => $this->input->post('name'), "symbol" => $this->input->post('symbol'));
        $result = $this->Setting_model->currency_name_update($data1, $currency_id);
        if ($result == TRUE) {
            $data2 = array("id" => "", "name" => "", "code" => "", "symbol" => "", "message_display" => "Update Successfully!");
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-currency', $data2);
            $this->load->view('template/footer');
        } else {
            $data2 = array("id" => $this->input->post('id'), "code" => $this->input->post('code'), "name" => $this->input->post('name'), "symbol" => $this->input->post('symbol'), "message_display" => "Something Went Wrong!");
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('setting/edit-currency', $data2);
            $this->load->view('template/footer');
        }
        // }
        
    }
}
?>