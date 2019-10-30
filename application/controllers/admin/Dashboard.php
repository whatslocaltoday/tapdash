<?php 

class Dashboard extends CI_Controller{

   var $limit='';
       var $offset='';
    private $logged = '';

    private $check_premission="";

    private $url="";

	 public function __construct()

	 	{

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

            $this->url=uri_string();

            if(!$this->logged)

             {

                 redirect(base_url().'login/'); 

             }

	 	}
    //      function alexa_rank($url){

    //         $url1 = "https://www.alexa.com/minisiteinfo/".$url;

    //         $string = file_get_contents($url1);
    //         $temp_s = substr($string, strpos($string." Flag") + 9);
    //         $temp_s1 =substr($temp_s, 0, strpos($temp_s, "</a></div>"))
    //   //  return(substr($temp_s, 0, strpos($temp_s, "</a></div>")));
    //         print $temp_s1;
    //         die;
    //         $xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
    //     print_r( $xml);
    //     die;
    //         if(isset($xml->SD)):
    //             //return $xml->SD->REACH->attributes();

    //             $globalRank= $xml->SD->REACH->attributes();
    //             $country_wise=$xml->SD->COUNTRY->attributes();
    //             $counteryCode= $country_wise['CODE'];
    //             $counteryRank= $country_wise['RANK'];

    //            $data=array(

    //             "globalRank"=>$globalRank,

    //             "country_wise"=>$country_wise,

    //             "counteryCode"=>$counteryCode,

    //             "counteryRank"=>$counteryRank

    //            );

    //            return $data;
    //         endif;
    //     }

        function AlexaRank($domain, $mode) {
            $url = "https://www.alexa.com/minisiteinfo/".$domain;
            $string = file_get_contents($url);
            if ($mode == "country") {
                $temp_s = substr($string, strpos($string." Flag") + 9 );
                return(substr($temp_s, 0, strpos($temp_s, "</a></div>")));
            }
            else if ($mode == "global") {
                $temp_s = substr($string, strpos($string, "Global") + 38);
                return(substr($temp_s, 0, strpos($temp_s, "</a></div>")));
            }
            else {
                return('something wrong.');
            }
        }

    public function dashboard()

    		{

                $total_view;

                $total_trfc;

                $total_acc_proj_id;

                $total_acc_traffic;

                $total_acc_lead;

                $total_acc_pname;

                $cTr="0";
                $counteryRank="0";
                $counteryCode="";
                $globalRank="0";
                $uniq_avg_page="";

                $result_view = $this->Account_model->fetch_total_view_under_useraccount();

                foreach($result_view as $row_view)

                   {

                    $total_view=$row_view->view;

                   }

                   $result_trfc = $this->Account_model->fetch_total_traffic_under_useraccount();

                foreach($result_trfc as $row_trfc)

                   {

                    $total_trfc=$row_trfc->traffic;

                   }

                   $result_lead = $this->Account_model->fetch_total_lead_under_useraccount();

                   foreach($result_lead as $row_lead)

                      {

                       $total_lead=$row_lead->lead;

                      }

                      if($total_view >0 || $total_trfc >0)

                      {

                       $cTr=number_format($total_trfc/$total_view,2,'.',',');

                      }

//multiaxecs graph

                        $result_Graphdata = $this->Account_model->fetch_graph_data_under_useraccount();

                    //account section

                    $result_acc_data = $this->Account_model->fetch_webiste_under_useraccount_dashboard();
                    // if(!empty($_SESSION['projWebiste_sesn']))
                    // {
                    //     $selectd_Webssite=str_replace(' ', '',$_SESSION['projWebiste_sesn']);
                    //     if(!empty($selectd_Webssite))
                    //     {

                    //         $url="http://data.alexa.com/data?cli=10&url=https://tapouts.online";
                    //        // $url1=file_get_contents($url);
                    //        // var_dump($http_response_header);

                    //         $xml=simplexml_load_file($url);
                    //         print_r($xml);
                    //         die;

                    //         if(isset($xml->SD))
                    //             {
                    //                 // print "dd";
                    //                 // die;
                    //                 $globalRank= $xml->SD->REACH->attributes();
                    //                 $country_wise=$xml->SD->COUNTRY->attributes();
                    //                 $counteryCode= $country_wise['CODE'];
                    //                 $counteryRank= $country_wise['RANK'];
                    //             }
                    //     }
                    // }

                    //     //for avarage time

                         //$uniq_avg_page=$this->unique_Page_view();

                   $data=array(

                    "total_view"=>$total_view,

                    "total_lead"=>$total_lead,

                    "cTr"=>$cTr,

                    "total_trfc"=>$total_trfc,

                    "result_Graphdata"=>$result_Graphdata,

                    "result_acc_data"=>$result_acc_data,
                    "globalRank"=>$globalRank,
                    "counteryRank"=>$counteryRank,
                    "counteryCode"=>$counteryCode,
                    "uniq_avg_page"=>$uniq_avg_page

                   );

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('dashboard',$data);

                $this->load->view('template/footer');

            }

            public function unique_Page_view()
            {
                if(!empty($_SESSION['projview_id_sesn']))
                {

                    require_once __DIR__ . '/analytics/Check5.php';

                    $GA_orgnic_nonorganic=new GA_orgnic_nonorganic();

                    $result = $GA_orgnic_nonorganic->unique_avgTime_OutputData();

                    return $result;
                }
                else
                {
                    return false;
                }              
            }

            public function dashboardmain()

            {

               unset($_SESSION['projID']);

               unset($_SESSION['projWebiste_sesn']);

               unset($_SESSION['projview_id_sesn']);

               redirect(base_url().'dashboard');

            }

            public function change_project($prj_id)

            {
                $post='1';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0' || $prj_id =='')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $user_id=$this->session->userdata('user_id');

                    $role_id=$this->session->userdata('role_id');

                    if($role_id !='1')

                    {

                        $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id =".$prj_id ." and project_details.id !=''";

                    }

                    if($role_id =='1')

                    {

                        $where="project_details.id =".$prj_id ." and project_details.id !=''";

                    }

                    $this->db->distinct();

                    $this->db->select('project_details.*');

                    $this->db->from('project_details');

                    $this->db->join('project_users', 'project_users.project_id =project_details.id');

                        $this->db->where($where);

                    $query = $this->db->get();

                        if($query->num_rows()>0){

                            $data=$query->result();

                            // print_r($data);

                            $_SESSION['projID']=$prj_id;

                            $_SESSION['projWebiste_sesn']=$data[0]->website;

                            $_SESSION['projview_id_sesn']=$data[0]->analytics_view_id;

                            if(!empty($prj_id))

                            {

                                redirect(base_url().'dashboard');

                                    exit();

                            }

                        }

                }

            }

            public function user_profile()

            {

                $post='2';

                $user_id=$this->session->userdata('user_id');

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0' || $user_id === NULL)

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    $result = $this->Admintype_model->fetch_view_edit_admin($user_id);

                    $data_web_sel = $this->Admintype_model->usr_my_project();

                   foreach($result as $row)

                   {

                       $data=array(

                           "id"=>$row->id,

                           "f_name"=>$row->f_name,

                           "l_name"=>$row->l_name,

                           "gender"=>$row->gender,

                           "email"=>$row->u_email,

                           "data_web_sel"=>$data_web_sel,

                           "message_display"=>""

                       );

                   }

                   $this->load->view('template/header');

                   $this->load->view('template/sidebar');

                   $this->load->view('admin_user/user_profile',$data);

                   $this->load->view('template/footer');

               }

            }

            public function get_timezone()

            {

                 $ajcountry=$this->input->post('ajcountry');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Admintype_model->fetch_per_country_zone($ajcountry)));

            }

            public function get_master_role()

            {

                 $ajdevice=$this->input->post('ajdevice');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Admintype_model->fetch_per_user_masterlist_role($ajdevice)));

            }

            public function get_permission_list()

            {

                 $ajper=$this->input->post('ajper');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Admintype_model->permision_list($ajper)));

            }

            public function get_role_per_user_as_change()

            {

                 $ajdevice=$this->input->post('ajdevice');

                 $userid=$this->input->post('userid');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Admintype_model->get_role_per_user_as_change($ajdevice,$userid)));

            }

            public function update_user_flag()

            {
                 $ajdevice=$this->input->post('ajdevice');

                 $ajuserid=$this->input->post('ajuserid');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Admintype_model->update_user_flag_status($ajdevice,$ajuserid)));

            }

            public function update_project_flag()

            {

                 $ajdevice=$this->input->post('ajdevice');

                 $ajuserid=$this->input->post('ajuserid');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Admintype_model->update_project_flag_status($ajdevice,$ajuserid)));

            }

    public function session_check()

        {

        if($this->session->userdata('logged_in') != null)

            return TRUE;

        else

            return FALSE;

        }

       function check_default()

            {

                $option=$this->input->post('user_type');

                if($option==0)

                {

                    $this->form_validation->set_message('check_default',  'Please Select %s');

          return false;

                }

                else{

                    return true;

                }

            }

            // public function allState()

            // {

            //     if( $this->session->userdata('admin_user_type')!=1){ 

            //         redirect(base_url().'webmaster/dashboard');

            //     }

            //     $data["results"] = $this->Location_type_model->fetch_state_list();

            //     $this->load->view('admin/template/header');

            //     $this->load->view('admin/template/sidebar');

            //     $this->load->view('admin/location/state', $data);

            //     $this->load->view('admin/template/footer');

            // }

            // public function allCity()

            // {

            //     if( $this->session->userdata('admin_user_type')!=1){ 

            //         redirect(base_url().'webmaster/dashboard');

            //     }

            //     $data["results"] = $this->Location_type_model->fetch_city_list();

            //     $this->load->view('admin/template/header');

            //     $this->load->view('admin/template/sidebar');

            //     $this->load->view('admin/location/citi', $data);

            //     $this->load->view('admin/template/footer');

            // }

            public function check_type($post)

            {

                if($post==0)

                {

                    $this->form_validation->set_message('check_type', 'Please Select %s');

                    return false;

                }else{

                    return true;

                }

            }

            public function check_permission($post)

            {

                $user_ap=$this->session->userdata('user_ap');

                $menu_option=explode(",", $user_ap);

                if (in_array($post,$menu_option, true))

                {

                  $data=1;

                 // die;

                } 

                else{

                    $data=0;

                }     

                return $data;       

            }

            // user show

            public function user_registration_show()

            {

                $post='1';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    $adm_typ=$this->Admintype_model->get_user_type($role_id);

                    $data_web = $this->Admintype_model->fetch_webiste_under_user_active_proj($role_id);

                    $data=array(

                        "admin_type"=>$adm_typ,

                        "web_proj"=>$data_web,

                        "f_name"=>$this->input->post('f_name'),

                        "l_name"=>$this->input->post('l_name'),

                        "email"=>$this->input->post('email'),

                        "user_type"=>$this->input->post('user_type'),

                        "menu_option"=>$this->input->post('menu_option'),

                        "admin_status"=>$this->input->post('admin_status'),

                        "message_display"=>""

                    );

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('admin_user/admin-registration', $data);

                    $this->load->view('template/footer');

                }

            }

            function permsn_name() {

                if (isset($_POST['permsn_name'])) return true;

                $this->form_validation->set_message('permsn_name', 'Please Select User Role.');

                return false;

            }

              //Start code for admin user registration 

            public function new_user_registration() { 

                $selcd_pro= $this->input->post('select_web_project');

                $post='1';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0' || $selcd_pro=='')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    $data_web = $this->Admintype_model->fetch_webiste_under_user_active_proj($role_id);    

                    $adm_typ=$this->Admintype_model->get_user_type($role_id);

                    //Check validation for user input in SignUp form

                    $this->form_validation->set_rules('f_name', 'First Name', 'trim|required');

                    $this->form_validation->set_rules('l_name', 'Last Name', 'trim|required');

                    $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.u_email]');

                    $this->form_validation->set_rules('gender', 'Gender', 'required');

                    $this->form_validation->set_rules('user_type', 'User Type', 'required|is_natural');

                    $this->form_validation->set_rules('permsn_name[]', 'Please Select Permission', 'callback_permsn_name');

                if ($this->form_validation->run() == FALSE) {

                //if validation fail from redirect to same page as selected data

                    $data=array(

                        "web_proj"=>$data_web,

                        "admin_type"=>$adm_typ,

                        'f_name'=>$this->input->post('f_name'),

                        'l_name'=>$this->input->post('l_name'),

                        'email'=>$this->input->post('email'),

                        "gender"=>$this->input->post('gender'),

                        "user_type"=>$this->input->post('user_type'),

                        "permsn_name"=>$this->input->post('permsn_name'),

                        "admin_status"=>$this->input->post('admin_status'),

                        "message_display"=>""

                    );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/admin-registration', $data);

                        $this->load->view('template/footer');

                }

                else {

                        if(!empty($this->input->post('permsn_name')))

                        {

                            $permsn_name=implode(",", $this->input->post('permsn_name'));

                        }

                        $data1 = array(

                            'f_name'=>$this->input->post('f_name'),

                            'l_name'=>$this->input->post('l_name'),

                            'email'=>$this->input->post('email'),

                            "gender"=>$this->input->post('gender'),

                            "user_type"=>$this->input->post('user_type'),

                            "permsn_name"=>$permsn_name,

                            "selcd_proj"=>$selcd_pro,

                            "admin_status"=>$this->input->post('admin_status'),

                            'cdate'=>date('Y-m-d')

                        );

                $result = $this->Admintype_model->registration_insert($data1);

                if ($result == TRUE) {

                        $data2=array(

                        "web_proj"=>$data_web,

                        "admin_type"=>$adm_typ,

                        "f_name"=>"",

                        "l_name"=>"",

                        "email"=>"",

                        "user_type"=>"",

                        "permsn_name"=>"",

                        "admin_status"=>"",

                        "message_display"=>"Registration Successfully!"

                    );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/admin-registration', $data2);

                        $this->load->view('template/footer');

                    } 

                    else

                    {

                        $data2=array(

                            "web_proj"=>$data_web,

                            "admin_type"=>$adm_typ,

                            "f_name"=>"",

                            "l_name"=>"",

                            "email"=>"",

                            "user_type"=>"",

                            "permsn_name"=>"",

                            "admin_status"=>"",

                            "message_display"=>"Registration Successfully!"

                        );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/admin-registration', $data2);

                        $this->load->view('template/footer');

                    }

                }

            }

} 

            public function list_admin_user()

            {

                $post='2';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    $all_count = $this->Admintype_model->read_count_fetch_user_under_user($role_id);

                    $config = array(

                        'base_url' => base_url('admin/Dashboard/list_admin_user'),

                        'per_page' => 10,

                        'total_rows' => $all_count,

                        'full_tag_open' => '<ul class="pagination">',

                        'full_tag_close' => '</ul>',

                        'first_link' => false,

                        'last_link' => false,

                        'first_tag_open' => '<li class="page-link">',

                        'first_tag_close' => '</li>',

                        'prev_link' => 'Previous ',

                        'prev_tag_open' => '<li class="page-link">',

                        'prev_tag_close' => '</li>',

                        'next_link' => ' Next',

                        'next_tag_open' => '<li>',

                        'next_tag_close' => '</li>',

                        'last_tag_open' => '<li>',

                        'last_tag_close' => '</li>',

                        'cur_tag_open' => '<li class="page-item active"><a class="page-link">',

                        'cur_tag_close' => '</a></li>',

                        'num_tag_open' => '<li class="page-link">',

                        'num_tag_close' => '</li>',

                    );

                    $this->pagination->initialize($config);
                    $uri=$this->uri->segment(5);
                    $data["results"] = $this->Admintype_model->fetch_user_under_user($role_id,$config["per_page"],$this->uri->segment(4));
                    $data['all_count'] = $all_count;

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('admin_user/manage-admin-user', $data);

                    $this->load->view('template/footer');

                }

            }

           //get user data for edite

           public function view_edit_admin_user()

           {

            $post='2';

            $user_id=$this->input->post('user_id');

            $ch_permsn=$this->check_permission($post);

            if ($ch_permsn=='0' || $user_id === NULL)

            {

                redirect(base_url().'dashboard');

            }

            else{

                $role_id=$this->session->userdata('role_id');

                $adm_typ=$this->Admintype_model->get_user_type($role_id);

                $per_name=$this->Admintype_model->permision_list($limit, $offset);

                   $result = $this->Admintype_model->fetch_view_edit_admin($user_id);

                // print_r($result);

             $edit_user_role_id=$result[0]->user_role_id;

                $data_web = $this->Admintype_model->fetch_webiste_under_user_active_proj_for_edit($role_id,$user_id,$edit_user_role_id);

                $data_web_sel = $this->Admintype_model->fetch_webiste_under_user_active_projselected($role_id,$user_id);

               foreach($result as $row)

               {

                   $data=array(

                       "admin_type"=>$adm_typ,

                       "web_proj"=>$data_web,

                       "web_proj_sel"=>$data_web_sel,

                       "user_type"=>$row->user_role_id,

                       "id"=>$row->id,

                       "f_name"=>$row->f_name,

                       "l_name"=>$row->l_name,

                       "gender"=>$row->gender,

                       "email"=>$row->u_email,

                       "per_list"=>$row->aclmaster,

                       "per_name"=>$per_name,

                       "menu_option"=>$row->acluser,

                       "admin_status"=>$row->flag,

                       "message_display"=>""

                   );

               }

               $this->load->view('template/header');

               $this->load->view('template/sidebar');

               $this->load->view('admin_user/edit-admin-user',$data);

               $this->load->view('template/footer');

           }

        }

          //get user data for edite

          public function edit_admin_user()

          {

            $selcd_pro= $this->input->post('select_web_project');

            $user_id=$this->input->post('id');

             $post='2';

            $ch_permsn=$this->check_permission($post);

            if ($ch_permsn=='0' || $user_id === NULL || $selcd_pro=='')

            {

                redirect(base_url().'dashboard');

            }

            $logged_user_id=$this->session->userdata('user_id');

            $role_id=$this->session->userdata('role_id');

            $adm_typ=$this->Admintype_model->get_user_type($role_id);

            $per_name=$this->Admintype_model->permision_list($limit, $offset);

            // Start code for send admin user data on admin user edit form page

                // Start code for updte admin user data

                $role_id=$this->session->userdata('role_id');

                $edit_user_role_id=$this->input->post('user_type'); 

                // $aclmaster=$this->Admintype_model->get_masterrole($id);

                $user_role_id=$this->Admintype_model->get_uaerrole($user_id);

               $role_id_user= $user_role_id[0]->role_id;

                // Check validation for user input in SignUp form

                $this->form_validation->set_rules('f_name', 'First name', 'trim|required');

                $this->form_validation->set_rules('l_name', 'Last name', 'trim|required');

                $this->form_validation->set_rules('gender', 'Gender', 'required');

                $this->form_validation->set_rules('permsn_name[]', 'Please Select Permission', 'callback_permsn_name');

                if ($this->form_validation->run() == FALSE) {

                    $result = $this->Admintype_model->fetch_view_edit_admin($user_id);

                    foreach($result as $row)

                    {

                        $aclmaster=$row->aclmaster;

                        $acluser=$row->acluser;

                    }

                    $data=array(

                        "id"=>$this->input->post('id'),

                       "f_name"=>$this->input->post('f_name'),

                       "l_name"=>$this->input->post('l_name'),

                       "gender"=>$this->input->post('gender'),

                       "email"=>$this->input->post('email'),

                       "per_list"=>$aclmaster,

                       "per_name"=>$per_name,

                       "menu_option"=>$acluser,

                       "admin_status"=>$this->input->post('admin_status'),

                       "message_display"=>""

);

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/edit-admin-user',$data);

                        $this->load->view('template/footer');

                }  

                 else 

                 {

                    if(!empty($this->input->post('permsn_name')))

                    {

                         $menu_option=implode(",", $this->input->post('permsn_name'));

                    }

                        $data1 = array(

                        "f_name"=>$this->input->post('f_name'),

                        "l_name"=>$this->input->post('l_name'),

                        "gender"=>$this->input->post('gender'),

                        "menu_option"=> $menu_option,

                        "euser"=>$logged_user_id,

                        "selcd_proj"=>$selcd_pro,

                        "edate"=>date('Y-m-d'),

                        "role_id"=>$this->input->post('user_type'),

                        "admin_status"=>$this->input->post('admin_status')

                        );
                       
                        $changepassword='';
                        $changepassword=$this->input->post('passwod');
                        if(!empty($changepassword))
                        {
                        $data2 = array(
                            "con_pass"=>$changepassword,
                            "edate"=>date('Y-m-d')
                            );


                        $result = $this->Admintype_model->update_user_info_pass_peruser($data2,$user_id);
                        }
                        
                    $result = $this->Admintype_model->update_admin_user($data1,$user_id);

                    if ($result == TRUE) {

                        $result = $this->Admintype_model->fetch_view_edit_admin($user_id);

                        foreach($result as $row)

                        {

                            $aclmaster=$row->aclmaster;

                            $acluser=$row->acluser;

                        }

                        $data_web = $this->Admintype_model->fetch_webiste_under_user_active_proj_for_edit($role_id,$user_id,$edit_user_role_id);

                        $data_web_sel = $this->Admintype_model->fetch_webiste_under_user_active_projselected($role_id,$user_id);

                        $data2=array(

                            "id"=>$this->input->post('id'),

                            "f_name"=>$this->input->post('f_name'),

                            "l_name"=>$this->input->post('l_name'),

                            "gender"=>$this->input->post('gender'),

                            "email"=>$this->input->post('email'),

                            "per_list"=>$aclmaster,

                            "per_name"=>$per_name,

                            "menu_option"=>$acluser,

                            "web_proj"=>$data_web,

                            "web_proj_sel"=>$data_web_sel,

                            "admin_status"=>$this->input->post('admin_status'),

                            "message_display"=>"User information succuesfully updated"

                        );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/edit-admin-user',$data2);

                        $this->load->view('template/footer');

                    } 

                    // End code for update admin user data

                }

          }

          public function update_user_profile()

          {

            $user_id=$this->input->post('id');

             $post='2';

            $ch_permsn=$this->check_permission($post);

            if ($ch_permsn=='0' || $user_id === NULL)

            {

                redirect(base_url().'dashboard');

            }

                // Check validation for user input in SignUp form

                $this->form_validation->set_rules('f_name', 'First name', 'trim|required');

                $this->form_validation->set_rules('l_name', 'Last name', 'trim|required');

                $this->form_validation->set_rules('gender', 'Gender', 'required');

                $data_web_sel = $this->Admintype_model->usr_my_project();

                if ($this->form_validation->run() == FALSE) {

                    $data=array(

                        "id"=>$this->input->post('id'),

                       "f_name"=>$this->input->post('f_name'),

                       "l_name"=>$this->input->post('l_name'),

                       "gender"=>$this->input->post('gender'),

                       "data_web_sel"=>$data_web_sel,

                       "email"=>$this->input->post('email'),

                       "message_display"=>""

);

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/user_profile',$data);

                        $this->load->view('template/footer');

                }  

                 else 

                 {

                        $data1 = array(

                        "f_name"=>$this->input->post('f_name'),

                        "l_name"=>$this->input->post('l_name'),

                        "gender"=>$this->input->post('gender'),

                        "euser"=>$user_id,

                        "edate"=>date('Y-m-d')

                        );

                    $result = $this->Admintype_model->update_user_info($data1,$user_id);

                    if ($result == TRUE) {

                        $data2=array(

                            "id"=>$this->input->post('id'),

                            "f_name"=>$this->input->post('f_name'),

                            "l_name"=>$this->input->post('l_name'),

                            "gender"=>$this->input->post('gender'),

                            "email"=>$this->input->post('email'),

                            "data_web_sel"=>$data_web_sel,

                            "message_display"=>"information succuesfully updated"

                        );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/user_profile',$data2);

                        $this->load->view('template/footer');

                    } 

                    // End code for update admin user data

                }

          }  

          //add webiste code start

          public function web_registration_show()

            {

                $post='45';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    $countery_info=$this->Admintype_model->get_country_info($limit, $offset);

                    $currency_info=$this->Admintype_model->get_currency_info();

           // print_r($countery_info);

                    $data=array(

                        "pname"=>$this->input->post('pname'),

                        "website"=>$this->input->post('website'),

                        "google_a_id"=>$this->input->post('google_a_id'),

                        "face_analytic_id"=>$this->input->post('face_analytic_id'),

                        "countery_info"=>$countery_info,

                        "currency_info"=>$currency_info,

                        "admin_status"=>$this->input->post('admin_status'),

                        "message_display"=>""

                    );

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('web_project/web-registration', $data);

                    $this->load->view('template/footer');

                }

            }


            
        


            function check_webdupli() {

                $pname = $this->input->post('pname');// get fiest name

                $website = $this->input->post('website');// get last name

                $this->db->select('id');

                $this->db->from('project_details');

                $this->db->where('pname', $pname);

                $this->db->where('website', $website);

                $query = $this->db->get();

                $num = $query->num_rows();

                if ($num > 0) {

                    $this->form_validation->set_message('website', 'Website Title and Website Already Exist.');

                    return false;

                } else {

                    return TRUE;

                }

            }

            public function new_website_registration() { 

                $post='45';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $logged_user_id=$this->session->userdata('user_id');

                    $role_id=$this->session->userdata('role_id');

                    $countery_info=$this->Admintype_model->get_country_info($limit, $offset);

                    $this->form_validation->set_rules('pname', 'Website Title', 'trim|required|xss_clean');

                    $this->form_validation->set_rules('website', 'Website Url', 'trim|required|xss_clean|callback_check_webdupli');

                    $this->form_validation->set_rules('addcountry', 'Country Name', 'required');

                    $this->form_validation->set_rules('cuurency_web', 'Currency', 'required');

                    $this->form_validation->set_rules('time_zone', 'Time zone', 'required|is_natural');

                if ($this->form_validation->run() == FALSE) {

                //if validation fail from redirect to same page as selected data

                $data=array(

                    "pname"=>$this->input->post('pname'),

                    "website"=>$this->input->post('website'),

                    "google_a_id"=>$this->input->post('google_a_id'),

                    "face_analytic_id"=>$this->input->post('face_analytic_id'),

                    "addcountry"=>$this->input->post('addcountry'),

                    "time_zone"=>$this->input->post('time_zone'),

                    "cuurency_web"=>$this->input->post('cuurency_web'),

                    "web_status"=>$this->input->post('web_status'),

                    "message_display"=>""

                );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('web_project/web-registration', $data);

                        $this->load->view('template/footer');

                }

                else {

                    $result32 = $this->Admintype_model->get_zone_name($this->input->post('time_zone'));

                    foreach($result32 as $row32)

                    {

                       $zone_name=$row32->zone_name;

                    }

                    $result33 = $this->Admintype_model->get_currency_code($this->input->post('cuurency_web'));

                    foreach($result33 as $row33)

                    {

                      $currency_code=$row33->code;

                    }

                    $PrJ_Name=$this->input->post('pname'); 

                     $result1232=$this->Login_model->randomPassword();
                   
                    //for adword automation
                 //   $result1232 = $this->CreateAccount->cretae_new_accountmain($PrJ_Name,$currency_code,$zone_name);

                        $data1 = array(

                            'pname'=>$this->input->post('pname'),

                            'account_id'=>$result1232,

                            'website'=>$this->input->post('website'),

                            'google_a_id'=>$this->input->post('google_a_id'),

                            "face_analytic_id"=>$this->input->post('face_analytic_id'),

                            "country_code"=>$this->input->post('addcountry'),

                            "time_zone"=>$this->input->post('time_zone'),

                            "currency_id"=>$this->input->post('cuurency_web'),

                            "flag"=>$this->input->post('web_status'),

                            'cdate'=>date('Y-m-d')
                        );

                    // print_r($data1);

                    // die;  

               $result = $this->Admintype_model->web_registration_insert($data1);

                if ($result == TRUE) {

                    $cookie = array(

						'name'   => 'sucsess_cokiee',

						'value'  => 'Website added successfully',

						'expire' => 7,

						'prefix' => 'dash_',

						);

					set_cookie($cookie);

					redirect(base_url().'dashboard/add-webiste');

                    } 

                }

            }

            } 

            public function list_website()

                {

                    $post='38';

                    $ch_permsn=$this->check_permission($post);

                    if ($ch_permsn=='0')

                    {

                        redirect(base_url().'dashboard');

                    }

                    else{

                        $role_id=$this->session->userdata('role_id');

                        $all_count = $this->Admintype_model->read_count_fetch_webiste_under_user($role_id);

                    $config = array(

                        'base_url' => base_url('admin/Dashboard/list_website'),

                        'per_page' => 10,

                        'total_rows' => $all_count,

                        'full_tag_open' => '<ul class="pagination">',

                        'full_tag_close' => '</ul>',

                        'first_link' => false,

                        'last_link' => false,

                        'first_tag_open' => '<li class="page-link">',

                        'first_tag_close' => '</li>',

                        'prev_link' => 'Previous ',

                        'prev_tag_open' => '<li class="page-link">',

                        'prev_tag_close' => '</li>',

                        'next_link' => ' Next',

                        'next_tag_open' => '<li>',

                        'next_tag_close' => '</li>',

                        'last_tag_open' => '<li>',

                        'last_tag_close' => '</li>',

                        'cur_tag_open' => '<li class="page-item active"><a class="page-link">',

                        'cur_tag_close' => '</a></li>',

                        'num_tag_open' => '<li class="page-link">',

                        'num_tag_close' => '</li>',

                    );

                    $this->pagination->initialize($config);        

                    $uri=$this->uri->segment(5);

                    $data["results"] = $this->Admintype_model->fetch_webiste_under_user($role_id,$config["per_page"],$this->uri->segment(4));

                    $data['all_count'] = $all_count;

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('web_project/manage-webiste', $data);

                        $this->load->view('template/footer');

                    }

                }

                public function seoDashboard()

                {

                    // $post='38';

                    // $ch_permsn=$this->check_permission($post);

                    // if ($ch_permsn=='0')

                    // {

                    //     redirect(base_url().'dashboard');

                    // }

                    // else{

                        // $role_id=$this->session->userdata('role_id');

                        // $data["results"] = $this->Admintype_model->fetch_webiste_under_user($role_id);

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('web_project/seo_Dashboard');

                        $this->load->view('template/footer');

                    // }

                }

                //get user data for edite

                public function view_edit_proj_web()

                {

                $post='46';

                $proj_id=$this->input->post('proj_id');

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0' || $proj_id === NULL)

                {
                    redirect(base_url().'dashboard');
                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    $countery_info=$this->Admintype_model->get_country_info($limit, $offset);

                    $currency_info=$this->Admintype_model->get_currency_info();

                    $zone_info=$this->Admintype_model->get_zone_info();

                    $result = $this->Admintype_model->fetch_view_edit_web_project($proj_id);

                    foreach($result as $row)

                    {

                        $data=array(

                            "countery_info"=>$countery_info,

                            "currency_info"=>$currency_info,

                            "zone_info"=>$zone_info,

                            "id"=>$row->id,

                            "pname"=>$row->pname,

                            "accountnumber"=>$row->accountnumber,

                            "website"=>$row->website,

                            "google_a_id"=>$row->google_a_id,

                            "face_analytic_id"=>$row->face_analytic_id,
                            "google_av_id"=>$row->analytics_view_id,

                            "country_code"=>$row->country_code,

                            "time_zone"=>$row->time_zone,

                            "currency_id"=>$row->currency_id,

                            "flag"=>$row->flag,

                            "message_display"=>""

                        );

                    }
                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('web_project/edit-website', $data);

                    $this->load->view('template/footer');

                }

                }

        //get website data edit

          public function edit_admin_web_proj()

          {

            $proj_id=$this->input->post('id');

             $post='46';

            $ch_permsn=$this->check_permission($post);

            if ($ch_permsn=='0' || $proj_id === NULL)

            {

                redirect(base_url().'dashboard');

            }

            $logged_user_id=$this->session->userdata('user_id');

            $role_id=$this->session->userdata('role_id');

            $countery_info=$this->Admintype_model->get_country_info($limit, $offset);

            $currency_info=$this->Admintype_model->get_currency_info();

            $zone_info=$this->Admintype_model->get_zone_info();

               $this->form_validation->set_rules('pname', 'Website Title', 'trim|required|xss_clean');

               $this->form_validation->set_rules('addcountry', 'Country Name', 'required');

               $this->form_validation->set_rules('cuurency_web', 'Currency', 'required');

               $this->form_validation->set_rules('time_zone', 'Time zone', 'required|is_natural');

                if ($this->form_validation->run() == FALSE) {

                    $data=array(

                        "pname"=>$this->input->post('pname'),

                        "website"=>$this->input->post('website'),

                        "google_a_id"=>$this->input->post('google_a_id'),

                        "face_analytic_id"=>$this->input->post('face_analytic_id'),
                        "google_av_id"=>$this->input->post('google_av_id'),
                        "addcountry"=>$this->input->post('addcountry'),

                        "time_zone"=>$this->input->post('time_zone'),

                        "cuurency_web"=>$this->input->post('cuurency_web'),

                        "flag"=>$this->input->post('web_status'),

                        "message_display"=>""

                    );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('web_project/edit-website', $data);

                        $this->load->view('template/footer');

                }  

                 else 

                 {

                    $data1 = array(

                        'pname'=>$this->input->post('pname'),

                        'google_a_id'=>$this->input->post('google_a_id'),

                        "face_analytic_id"=>$this->input->post('face_analytic_id'),
                        "analytics_view_id"=>$this->input->post('google_av_id'),
                        "country_code"=>$this->input->post('addcountry'),

                        "time_zone"=>$this->input->post('time_zone'),

                        "currency_id"=>$this->input->post('cuurency_web'),

                        "flag"=>$this->input->post('web_status'),

                        'edate'=>date('Y-m-d'),

                        'euser'=>$logged_user_id

                    );

                    $result = $this->Admintype_model->update_web_project_info($data1,$proj_id);

                    if ($result == TRUE) {
                        $countery_info=$this->Admintype_model->get_country_info($limit, $offset);

                        $currency_info=$this->Admintype_model->get_currency_info();

                        $zone_info=$this->Admintype_model->get_zone_info();

                        $result = $this->Admintype_model->fetch_view_edit_web_project($proj_id);

                        foreach($result as $row)

                        {
                            $data3=array(

                                "countery_info"=>$countery_info,

                                "currency_info"=>$currency_info,

                                "zone_info"=>$zone_info,

                                "id"=>$row->id,

                                "pname"=>$row->pname,

                                "accountnumber"=>$row->accountnumber,

                                "website"=>$row->website,

                                "google_a_id"=>$row->google_a_id,

                                "face_analytic_id"=>$row->face_analytic_id,
                                "google_av_id"=>$row->analytics_view_id,

                                "country_code"=>$row->country_code,

                                "time_zone"=>$row->time_zone,

                                "currency_id"=>$row->currency_id,

                                "flag"=>$row->flag,

                                "message_display"=>"Website Detail Successfully Updated"

                            );

                        }

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('web_project/edit-website', $data3);

                        $this->load->view('template/footer');

                    }

                    else

                {

                    $countery_info=$this->Admintype_model->get_country_info($limit, $offset);

                    $currency_info=$this->Admintype_model->get_currency_info();

                    $zone_info=$this->Admintype_model->get_zone_info();

                    $result = $this->Admintype_model->fetch_view_edit_web_project($proj_id);

                    foreach($result as $row)

                    {
                        $data3=array(

                            "countery_info"=>$countery_info,

                            "currency_info"=>$currency_info,

                            "zone_info"=>$zone_info,

                            "id"=>$row->id,

                            "pname"=>$row->pname,

                            "accountnumber"=>$row->accountnumber,

                            "website"=>$row->website,

                            "google_a_id"=>$row->google_a_id,

                            "face_analytic_id"=>$row->face_analytic_id,
                            "google_av_id"=>$row->analytics_view_id,

                            "country_code"=>$row->country_code,

                            "time_zone"=>$row->time_zone,

                            "currency_id"=>$row->currency_id,

                            "flag"=>$row->flag,

                            "message_display"=>"Something Went Wrong"

                        );

                    }

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('web_project/edit-website', $data3);

                    $this->load->view('template/footer');

                } 

                    // End code for update admin user data

                }
          }

          public function accounts()

          {

            $this->load->view('template/header');

            $this->load->view('template/sidebar');

            $this->load->view('account/accounts');

            $this->load->view('template/footer');

          }

          public function change_pass_user()

          {

            $logged_user_id=$this->session->userdata('user_id');

            $data3=array(

                "id"=>$logged_user_id,

                "message_display"=>""

            );

            $this->load->view('template/header');

            $this->load->view('template/sidebar');

            $this->load->view('admin_user/change-password', $data3);

            $this->load->view('template/footer');

          }

          public function update_user_password()

          {
            $user_id=$this->input->post('id');

             $post='2';

            $ch_permsn=$this->check_permission($post);

            if ($ch_permsn=='0' || $user_id === NULL)

            {

                redirect(base_url().'dashboard');

            }
                        $data1 = array(

                        "old_pass"=>$this->input->post('old_pass'),

                        "new_pass"=>$this->input->post('new_pass'),

                        "con_pass"=>$this->input->post('con_pass'),

                        "euser"=>$user_id,

                        "edate"=>date('Y-m-d')

                        );

                    $result = $this->Admintype_model->update_user_info_pass($data1,$user_id);

                    if ($result == TRUE) {

                        $data2=array(

                            "id"=>$this->input->post('id'),

                            "old_pass"=>"",

                            "new_pass"=>"",

                            "con_pass"=>"",

                            "message_display"=>"Password Changed"

                        );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/change-password',$data2);

                        $this->load->view('template/footer');

                    } 

                    else

                    {

                        $data2=array(

                            "id"=>$this->input->post('id'),

                            "old_pass"=>"",

                            "new_pass"=>"",

                            "con_pass"=>"",

                            "message_display"=>"Old Password Mismatch"

                        );

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('admin_user/change-password',$data2);

                        $this->load->view('template/footer');

                    }

                    // End code for update admin user data

          }
          
          

         

}

?>