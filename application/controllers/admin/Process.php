<?php 

class Process extends CI_Controller{

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

            $this->load->model('admin/Setting_model');

            $this->load->model('admin/Admintype_model');

            $this->load->model('admin/Account_model');

            $this->load->model('admin/GetKeywordIdeas');



            $this->url=uri_string();

            

            if(!$this->logged)

             {

                 redirect(base_url().'login/');

                 

             }



	 	}



         public function list_plan_process()

         {

             $post='17';

             $ch_permsn=$this->check_permission($post);

             if ($ch_permsn=='0')

             {

                 redirect(base_url().'dashboard');

             }

             else{

                $proj_id = "";

                $from_date = "";

                $to_date="";
                $social_id='1';

                if (isset($_POST['search']) || isset($_POST['from_date']) || isset($_POST['to_date']) || isset($_POST['proj_id']) )


                {

                    $proj_id = $this->input->post('proj_id');

                    $from_date = $this->input->post('from_date');

                    $to_date = $this->input->post('to_date');

                    //$social_id='1';

                    $all_leads_count= $this->Account_model->record_countview_project_plan_process($proj_id,$from_date,$to_date,$social_id);



                    $config = array(

                        'base_url' => base_url('admin/Process/list_plan_process'),

                        'per_page' => 30,

                        'total_rows' => $all_leads_count,

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

                    

                    $all_leads =$this->Account_model->view_project_plan_process($config["per_page"],$this->uri->segment(4),$proj_id,$from_date,$to_date,$social_id);

                    $data['all_leads'] = $all_leads;

                    $data['all_leads_count'] = $all_leads_count;

    

                     $this->load->view('template/header');

                     $this->load->view('template/sidebar');

                     $this->load->view('plan/view_plan', $data);

                     $this->load->view('template/footer');

                }

                else

                {


                $all_leads_count= $this->Account_model->record_countview_project_plan_process($proj_id,$from_date,$to_date,$social_id);

                

                $config = array(

                    'base_url' => base_url('admin/Process/list_plan_process'),

                    'per_page' => 30,

                    'total_rows' => $all_leads_count,

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

    

                $uri=$this->uri->segment(4);

             

                $all_leads =$this->Account_model->view_project_plan_process($config["per_page"],$this->uri->segment(4),$proj_id,$from_date,$to_date,$social_id);

                $data['all_leads'] = $all_leads;

                $data['all_leads_count'] = $all_leads_count;



                 $this->load->view('template/header');

                 $this->load->view('template/sidebar');

                 $this->load->view('plan/view_plan', $data);

                 $this->load->view('template/footer');

             }

            }

         }


         public function fb_list_plan_process()

         {

             $post='66';

             $ch_permsn=$this->check_permission($post);

             if ($ch_permsn=='0')

             {

                 redirect(base_url().'dashboard');

             }

             else{

                $proj_id = "";

                $from_date = "";

                $to_date="";
                $social_id='2';

                if (isset($_POST['search']) || isset($_POST['from_date']) || isset($_POST['to_date']) || isset($_POST['proj_id']) )


                {

                    $proj_id = $this->input->post('proj_id');

                    $from_date = $this->input->post('from_date');

                    $to_date = $this->input->post('to_date');

                    //$social_id='1';

                    $all_leads_count= $this->Account_model->record_countview_project_plan_process($proj_id,$from_date,$to_date,$social_id);



                    $config = array(

                        'base_url' => base_url('admin/Process/fb_list_plan_process'),

                        'per_page' => 30,

                        'total_rows' => $all_leads_count,

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

                    

                    $all_leads =$this->Account_model->view_project_plan_process($config["per_page"],$this->uri->segment(4),$proj_id,$from_date,$to_date,$social_id);

                    $data['all_leads'] = $all_leads;

                    $data['all_leads_count'] = $all_leads_count;

    

                     $this->load->view('template/header');

                     $this->load->view('template/sidebar');

                     $this->load->view('plan/view_plan', $data);

                     $this->load->view('template/footer');

                }

                else

                {


                $all_leads_count= $this->Account_model->record_countview_project_plan_process($proj_id,$from_date,$to_date,$social_id);

                

                $config = array(

                    'base_url' => base_url('admin/Process/fb_list_plan_process'),

                    'per_page' => 30,

                    'total_rows' => $all_leads_count,

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

    

                $uri=$this->uri->segment(4);

             

                $all_leads =$this->Account_model->view_project_plan_process($config["per_page"],$this->uri->segment(4),$proj_id,$from_date,$to_date,$social_id);

                $data['all_leads'] = $all_leads;

                $data['all_leads_count'] = $all_leads_count;



                 $this->load->view('template/header');

                 $this->load->view('template/sidebar');

                 $this->load->view('plan/fb_view_plan', $data);

                 $this->load->view('template/footer');

             }

            }

         }





         public function add_plan_process()

         {

             $post='13';

             $ch_permsn=$this->check_permission($post);

             if ($ch_permsn=='0')

             {

                 redirect(base_url().'dashboard');

             }

             else{



                 $data_web_sel = $this->Admintype_model->usr_my_project();

                 $data=array(

                     "daily_budget"=>$this->input->post('daily_budget'),

                     "plan_cost"=>$this->input->post('plan_cost'),

                     "plan_view"=>$this->input->post('plan_view'),

                     "plan_trafic"=>$this->input->post('plan_trafic'),

                     "data_web_sel"=>$data_web_sel,

                     "plan_lead"=>$this->input->post('plan_lead'),

                     "message_display"=>""

                 );

                 $this->load->view('template/header');

                 $this->load->view('template/sidebar');

                 $this->load->view('plan/add_plan', $data);

                 $this->load->view('template/footer');

             }

         }

         public function fb_add_plan_process()

         {

             $post='67';

             $ch_permsn=$this->check_permission($post);

             if ($ch_permsn=='0')

             {

                 redirect(base_url().'dashboard');

             }

             else{



                 $data_web_sel = $this->Admintype_model->usr_my_project();

                 $data=array(

                     "daily_budget"=>$this->input->post('daily_budget'),

                     "plan_cost"=>$this->input->post('plan_cost'),

                     "plan_view"=>$this->input->post('plan_view'),

                     "plan_trafic"=>$this->input->post('plan_trafic'),

                     "data_web_sel"=>$data_web_sel,

                     "plan_lead"=>$this->input->post('plan_lead'),

                     "message_display"=>""

                 );

                 $this->load->view('template/header');

                 $this->load->view('template/sidebar');

                 $this->load->view('plan/fb_add_plan', $data);

                 $this->load->view('template/footer');

             }

         }




         public function new_plan_process_add() { 

                $post='13';

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $logged_user_id=$this->session->userdata('user_id');

                    $role_id=$this->session->userdata('role_id');

                

                    $data_web_sel = $this->Admintype_model->usr_my_project();

                    



                    $this->form_validation->set_rules('plan_view', 'Daily view', 'trim|required|xss_clean');

                    $this->form_validation->set_rules('plan_trafic', 'Daily trafic', 'trim|required|xss_clean');

            

                if ($this->form_validation->run() == FALSE) {

            

                //if validation fail from redirect to same page as selected data

                $data=array(

                    "daily_budget"=>$this->input->post('daily_budget'),

                    "plan_cost"=>$this->input->post('plan_cost'),

                    "plan_view"=>$this->input->post('plan_view'),

                    "plan_trafic"=>$this->input->post('plan_trafic'),

                    "data_web_sel"=>$data_web_sel,

                    "plan_lead"=>$this->input->post('plan_lead'),

                    "message_display"=>""

                );

            

                        $this->load->view('template/header');

                        $this->load->view('template/sidebar');

                        $this->load->view('plan/add_plan', $data);

                        $this->load->view('template/footer');

                }

                else {

                    $data1 = array(

                        "buget"=>$this->input->post('daily_budget'),

                        "cost"=>$this->input->post('plan_cost'),
                        "social_id"=>'1',

                        "view"=>$this->input->post('plan_view'),

                        "traffic"=>$this->input->post('plan_trafic'),

                        "proj_id"=>$this->input->post('web_id'),

                        "lead"=>$this->input->post('plan_lead'),

                        "plan_date"=>$this->input->post('date'),

                        'cdate'=>date('Y-m-d'),

                        'cuser'=>$logged_user_id

                    );


                $result = $this->Account_model->insert_new_daily_plan_process($data1);

                if ($result == TRUE) {

                

                    $this->session->set_flashdata('success_message', 'Data Added');

                    redirect(base_url().'process/add-plan-process');



                    }

                    else

                    {

                        $this->session->set_flashdata('error_message', 'Something Went Wrong Please Try Again Later');

                        redirect(base_url().'process/add-plan-process');

                    } 

                }

            }

        } 



        public function fb_new_plan_process_add() { 

            $post='13';

            $ch_permsn=$this->check_permission($post);

            if ($ch_permsn=='0')

            {

                redirect(base_url().'dashboard');

            }

            else{

                $logged_user_id=$this->session->userdata('user_id');

                $role_id=$this->session->userdata('role_id');

            

                $data_web_sel = $this->Admintype_model->usr_my_project();

                



                $this->form_validation->set_rules('plan_view', 'Daily view', 'trim|required|xss_clean');

                $this->form_validation->set_rules('plan_trafic', 'Daily trafic', 'trim|required|xss_clean');

        

            if ($this->form_validation->run() == FALSE) {

        

            //if validation fail from redirect to same page as selected data

            $data=array(

                "daily_budget"=>$this->input->post('daily_budget'),

                "plan_cost"=>$this->input->post('plan_cost'),

                "plan_view"=>$this->input->post('plan_view'),

                "plan_trafic"=>$this->input->post('plan_trafic'),

                "data_web_sel"=>$data_web_sel,

                "plan_lead"=>$this->input->post('plan_lead'),

                "message_display"=>""

            );

        

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('plan/add_plan', $data);

                    $this->load->view('template/footer');

            }

            else {

                $data1 = array(

                    "buget"=>$this->input->post('daily_budget'),

                    "cost"=>$this->input->post('plan_cost'),
                    "social_id"=>'2',

                    "view"=>$this->input->post('plan_view'),

                    "traffic"=>$this->input->post('plan_trafic'),

                    "proj_id"=>$this->input->post('web_id'),

                    "lead"=>$this->input->post('plan_lead'),

                    "plan_date"=>$this->input->post('date'),

                    'cdate'=>date('Y-m-d'),

                    'cuser'=>$logged_user_id

                );


            $result = $this->Account_model->insert_new_daily_plan_process($data1);

            if ($result == TRUE) {

            

                $this->session->set_flashdata('success_message', 'Data Added');

                redirect(base_url().'process/fb-add-plan-process');



                }

                else

                {

                    $this->session->set_flashdata('error_message', 'Something Went Wrong Please Try Again Later');

                    redirect(base_url().'process/fb-add-plan-process');

                } 

            }

        }

    } 



       



        public function view_edit_plan_progress()

        {

         $post='14';

        

         $plan_p_id=$this->input->post('plan_p_id');

      

         $ch_permsn=$this->check_permission($post);

         if ($ch_permsn=='0' || $plan_p_id === NULL)

         {

             redirect(base_url().'dashboard');

         }

         else{

                $result = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                foreach($result as $row)

                {

                    $data=array(

                        "id"=>$row->id,

                        "daily_budget"=>$row->buget,

                        "plan_cost"=>$row->cost,

                        "plan_view"=>$row->view,

                        "plan_trafic"=>$row->traffic,

                        "data_web_sel"=>$row->proj_id,

                        "website_url"=>$row->website,

                        "website_title"=>$row->pname,

                        "plan_lead"=>$row->lead,

                        "date"=>$row->plan_date,

                        "message_display"=>""

                    );

                }

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('plan/edit_plan', $data);

                $this->load->view('template/footer');

            }

     }


     public function fb_view_edit_plan_progress()

        {

         $post='68';

        

         $plan_p_id=$this->input->post('plan_p_id');

      

         $ch_permsn=$this->check_permission($post);

         if ($ch_permsn=='0' || $plan_p_id === NULL)

         {

             redirect(base_url().'dashboard');

         }

         else{

                $result = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                foreach($result as $row)

                {

                    $data=array(

                        "id"=>$row->id,

                        "daily_budget"=>$row->buget,

                        "plan_cost"=>$row->cost,

                        "plan_view"=>$row->view,

                        "plan_trafic"=>$row->traffic,

                        "data_web_sel"=>$row->proj_id,

                        "website_url"=>$row->website,

                        "website_title"=>$row->pname,

                        "plan_lead"=>$row->lead,

                        "date"=>$row->plan_date,

                        "message_display"=>""

                    );

                }

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('plan/fb_edit_plan', $data);

                $this->load->view('template/footer');

            }

     }





       //get user data for edite

       public function edit_plan_progress()

       {

        

         $plan_p_id=$this->input->post('id');

          $post='14';

         

         $ch_permsn=$this->check_permission($post);

         if ($ch_permsn=='0' || $plan_p_id === NULL)

         {

             redirect(base_url().'dashboard');

         }



         $logged_user_id=$this->session->userdata('user_id');

         $role_id=$this->session->userdata('role_id');

       

            

             // Check validation for user input in SignUp form

             $this->form_validation->set_rules('daily_budget', 'Budget Empty', 'trim|required');

             $this->form_validation->set_rules('plan_cost', 'Cost Empty', 'trim|required');

             $this->form_validation->set_rules('plan_view', 'View Empty', 'trim|required');

             $this->form_validation->set_rules('plan_trafic', 'Traffic Empty', 'trim|required');

             $this->form_validation->set_rules('plan_lead', 'Lead Empty', 'trim|required');



             if ($this->form_validation->run() == FALSE) {



                $result = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                foreach($result as $row)

                {

                    $data_web_sel=$row->proj_id;

                    $website_url=$row->website;

                    $website_title=$row->pname;

                }

                 $data=array(

                    "id"=>$this->input->post('id'),

                    "daily_budget"=>$this->input->post('daily_budget'),

                    "plan_cost"=>$this->input->post('plan_cost'),

                    "plan_view"=>$this->input->post('plan_view'),

                    "plan_trafic"=>$this->input->post('plan_trafic'),

                    "data_web_sel"=>$data_web_sel,

                    "website_url"=>$website_url,

                    "website_title"=>$website_title,

                    "plan_lead"=>$this->input->post('plan_lead'),

                    "date"=>$this->input->post('date'),

                    "message_display"=>""





                );



                     $this->load->view('template/header');

                     $this->load->view('template/sidebar');

                     $this->load->view('plan/edit_plan', $data);

                     $this->load->view('template/footer');

             }  

              else 

              {



                $data1 = array(

                    "buget"=>$this->input->post('daily_budget'),

                    "cost"=>$this->input->post('plan_cost'),

                    "view"=>$this->input->post('plan_view'),

                    "traffic"=>$this->input->post('plan_trafic'),

                    "lead"=>$this->input->post('plan_lead'),

                    "plan_date"=>$this->input->post('date'),

                    'edate'=>date('Y-m-d'),

                    'euser'=>$logged_user_id

                );

                

                    

            $result = $this->Account_model->update_daily_plan_process($data1,$plan_p_id);



                 if ($result == TRUE) {

                    $result1 = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                    foreach($result1 as $row)

                    {

                    

                        $data=array(

                            "id"=>$row->id,

                            "daily_budget"=>$row->buget,

                            "plan_cost"=>$row->cost,

                            "plan_view"=>$row->view,

                            "plan_trafic"=>$row->traffic,

                            "data_web_sel"=>$row->proj_id,

                            "website_url"=>$row->website,

                            "website_title"=>$row->pname,

                            "plan_lead"=>$row->lead,

                            "date"=>$row->plan_date

                        );

                    }

                    $this->session->set_flashdata('success_message', 'Plan Progress updated');

                         $this->load->view('template/header');

                         $this->load->view('template/sidebar');

                         $this->load->view('plan/edit_plan', $data);

                         $this->load->view('template/footer');



                 }

                 else

                 {

                    $result1 = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                    foreach($result1 as $row)

                    {

                        $data_web_sel=$row->proj_id;

                        $website_url=$row->website;

                        $website_title=$row->pname;

                    }

                     $data=array(

                        "id"=>$this->input->post('id'),

                        "daily_budget"=>$this->input->post('daily_budget'),

                        "plan_cost"=>$this->input->post('plan_cost'),

                        "plan_view"=>$this->input->post('plan_view'),

                        "plan_trafic"=>$this->input->post('plan_trafic'),

                        "data_web_sel"=>$data_web_sel,

                        "website_url"=>$website_url,

                        "website_title"=>$website_title,

                        "plan_lead"=>$this->input->post('plan_lead'),

                        "date"=>$this->input->post('date')

    

    

                    );

                    $this->session->set_flashdata('success_message', 'Something Went Wrong Please Try Again Later');

            

                         $this->load->view('template/header');

                         $this->load->view('template/sidebar');

                         $this->load->view('plan/edit_plan', $data);

                         $this->load->view('template/footer');

                 } 

                 // End code for update admin user data



             }

       }



       public function fb_edit_plan_progress()

       {

        

         $plan_p_id=$this->input->post('id');

          $post='68';

         

         $ch_permsn=$this->check_permission($post);

         if ($ch_permsn=='0' || $plan_p_id === NULL)

         {

             redirect(base_url().'dashboard');

         }



         $logged_user_id=$this->session->userdata('user_id');

         $role_id=$this->session->userdata('role_id');

       

            

             // Check validation for user input in SignUp form

             $this->form_validation->set_rules('daily_budget', 'Budget Empty', 'trim|required');

             $this->form_validation->set_rules('plan_cost', 'Cost Empty', 'trim|required');

             $this->form_validation->set_rules('plan_view', 'View Empty', 'trim|required');

             $this->form_validation->set_rules('plan_trafic', 'Traffic Empty', 'trim|required');

             $this->form_validation->set_rules('plan_lead', 'Lead Empty', 'trim|required');



             if ($this->form_validation->run() == FALSE) {



                $result = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                foreach($result as $row)

                {

                    $data_web_sel=$row->proj_id;

                    $website_url=$row->website;

                    $website_title=$row->pname;

                }

                 $data=array(

                    "id"=>$this->input->post('id'),

                    "daily_budget"=>$this->input->post('daily_budget'),

                    "plan_cost"=>$this->input->post('plan_cost'),

                    "plan_view"=>$this->input->post('plan_view'),

                    "plan_trafic"=>$this->input->post('plan_trafic'),

                    "data_web_sel"=>$data_web_sel,

                    "website_url"=>$website_url,

                    "website_title"=>$website_title,

                    "plan_lead"=>$this->input->post('plan_lead'),

                    "date"=>$this->input->post('date'),

                    "message_display"=>""





                );



                     $this->load->view('template/header');

                     $this->load->view('template/sidebar');

                     $this->load->view('plan/fb_edit_plan', $data);

                     $this->load->view('template/footer');

             }  

              else 

              {



                $data1 = array(

                    "buget"=>$this->input->post('daily_budget'),

                    "cost"=>$this->input->post('plan_cost'),

                    "view"=>$this->input->post('plan_view'),

                    "traffic"=>$this->input->post('plan_trafic'),

                    "lead"=>$this->input->post('plan_lead'),

                    "plan_date"=>$this->input->post('date'),

                    'edate'=>date('Y-m-d'),

                    'euser'=>$logged_user_id

                );

                

                    

            $result = $this->Account_model->update_daily_plan_process($data1,$plan_p_id);



                 if ($result == TRUE) {

                    $result1 = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                    foreach($result1 as $row)

                    {

                    

                        $data=array(

                            "id"=>$row->id,

                            "daily_budget"=>$row->buget,

                            "plan_cost"=>$row->cost,

                            "plan_view"=>$row->view,

                            "plan_trafic"=>$row->traffic,

                            "data_web_sel"=>$row->proj_id,

                            "website_url"=>$row->website,

                            "website_title"=>$row->pname,

                            "plan_lead"=>$row->lead,

                            "date"=>$row->plan_date

                        );

                    }

                    $this->session->set_flashdata('success_message', 'Plan Progress updated');

                         $this->load->view('template/header');

                         $this->load->view('template/sidebar');

                         $this->load->view('plan/edit_plan', $data);

                         $this->load->view('template/footer');



                 }

                 else

                 {

                    $result1 = $this->Account_model->view_project_plan_process_slected($plan_p_id);

                    foreach($result1 as $row)

                    {

                        $data_web_sel=$row->proj_id;

                        $website_url=$row->website;

                        $website_title=$row->pname;

                    }

                     $data=array(

                        "id"=>$this->input->post('id'),

                        "daily_budget"=>$this->input->post('daily_budget'),

                        "plan_cost"=>$this->input->post('plan_cost'),

                        "plan_view"=>$this->input->post('plan_view'),

                        "plan_trafic"=>$this->input->post('plan_trafic'),

                        "data_web_sel"=>$data_web_sel,

                        "website_url"=>$website_url,

                        "website_title"=>$website_title,

                        "plan_lead"=>$this->input->post('plan_lead'),

                        "date"=>$this->input->post('date')

    

    

                    );

                    $this->session->set_flashdata('success_message', 'Something Went Wrong Please Try Again Later');

            

                         $this->load->view('template/header');

                         $this->load->view('template/sidebar');

                         $this->load->view('plan/fb_edit_plan', $data);

                         $this->load->view('template/footer');

                 } 

                 // End code for update admin user data



             }

       }



       public function upload_plan_process()

       {

         $post='16';

      

        $ch_permsn=$this->check_permission($post);

        if ($ch_permsn=='0')

        {

            redirect(base_url().'dashboard');

        }

            $this->load->view('template/header');

            $this->load->view('template/sidebar');

            $this->load->view('plan/upload_plan');

            $this->load->view('template/footer');

       }

       public function fb_upload_plan_process()

       {

         $post='70';

      

        $ch_permsn=$this->check_permission($post);

        if ($ch_permsn=='0')

        {

            redirect(base_url().'dashboard');

        }

            $this->load->view('template/header');

            $this->load->view('template/sidebar');

            $this->load->view('plan/fb_upload_plan');

            $this->load->view('template/footer');

       }

       

       public function csv_adword_import()

       {

        $post='16';

        $logged_user_id=$this->session->userdata('user_id');

        $ch_permsn=$this->check_permission($post);

        if ($ch_permsn=='0')

        {

            redirect(base_url().'dashboard');

        }



        if($_FILES['csv']['name'])

        { 

           

            $filename = explode(".", $_FILES['csv']['name']);

            if($filename[1] == 'csv')

            {

                $handle = fopen($_FILES['csv']['tmp_name'], "r");

                $handle2 = fopen($_FILES['csv']['tmp_name'], "r");

                $handle3 = fopen($_FILES['csv']['tmp_name'], "r");

                $count = 0;

                $count_check = 0;



                $is_validated = TRUE;

                $line_numbers = 0;

                $error_lines = '';



                while ($data_csv1 = fgetcsv($handle2)) {

                    $line_numbers++;

                    $count_check++;



                    /*skip first column*/

                    if($count_check == 1) {



                        /*check if heading are not set properly*/

                    //  print   $data_csv1[0];

                    //     die;

                        if(count($data_csv1) == 7){



                        }else {

                            /*redirect to same page*/

                            $this->session->set_flashdata('error_message', 'Please check Heading Columns with Sample Download.All Columns Should Fill');

                            redirect(base_url().'admin/Process/upload_plan_process');

                            // $url = "admin/Process/upload_plan_process";

                            // $this->redirector($url);

                        }

                    }else{



                        $counting_errors = 0;



                        if ($counting_errors == 0) {

                            $proj_acc_id = $data_csv1[0];

                            if ($proj_acc_id == '') {

                                $is_validated = FALSE;

                                $counting_errors = 1;

                                $error_lines = $error_lines . ', ' . $line_numbers;

                            }

                        }



                        if ($counting_errors == 0) {

                            $campgn_date = $data_csv1[1];

                            if ($campgn_date == '') {

                                $is_validated = FALSE;

                                $counting_errors = 1;

                                $error_lines = $error_lines . ', ' . $line_numbers;

                            }

                        }



                        if ($counting_errors == 0) {

                            $campgn_imprsion = $data_csv1[2];

                            if ($campgn_imprsion == '') {

                                $is_validated = FALSE;

                                $counting_errors = 1;

                                $error_lines = $error_lines . ', ' . $line_numbers;

                            }

                        }



                       



                        $counting_errors = 0;



                    }



                }





                if($is_validated) {

                    $row = 1;

                    $check_pojID="";

                    while ($data_csv = fgetcsv($handle)) {

                        if (count($data_csv) == 7 && $count != 1) {



                            $num = count($data_csv);	

                            $row++;

                            if($row>2)

                            {

                              //  $data_web_sel = $this->Admintype_model->usr_my_project();

                                $result5 = $this->Admintype_model->usr_my_project_for_upload(trim($data_csv[0]));

                                if($result5)

                                {

    

                                    $check_pojID="1";

                                

                                }

                                else

                                {

                                    $check_pojID="0";

                                    fclose($handle);

                                    $this->session->set_flashdata('error_message', 'Account id mismatch- '.$data_csv[0].' Please Correct or Remove Row');

                                    redirect(base_url().'admin/Process/upload_plan_process');

                                    

                                }



                            $result1 = $this->Account_model->get_prject_account_no($data_csv[0]);

                            if($result1)

                            {



                                $check_pojID="1";

                            

                            }

                            else

                            {

                                $check_pojID="0";

                                fclose($handle);

                                $this->session->set_flashdata('error_message', 'Account id mismatch- '.$data_csv[0].' Please Correct or Remove Row');

                                redirect(base_url().'admin/Process/upload_plan_process');

                                

                            }

                        }}}



                        if( $check_pojID=="1")

                        {

                              $row1 = 1;

                              $proIDget="";

                            //die;

                        while ($data_csv3 = fgetcsv($handle3)) {

                           

                            if (count($data_csv3) == 7 && $count != 1) {

    

                                $num = count($data_csv3);	

                                 $row1++;

                                if($row1>2)

                                {

                                   

                                    $result3 = $this->Account_model->get_prject_account_no($data_csv3[0]);

                                    if($result3)

                                    {

                                        foreach($result3 as $row3)

                                        {

                                            $proIDget= $row3->id;

                                           

                                        }

                                     

                                  

                                    $planDate = date('Y-m-d', strtotime(trim($data_csv3[1])));

                               

                                   

                                    $adword_camp_data = array(

                                        'proj_id' =>$proIDget,

                                        'view' => $data_csv3[2],

                                        'traffic' => $data_csv3[3],

                                        'lead' => $data_csv3[4],

                                        'cost' => $data_csv3[6],

                                        'buget' => $data_csv3[5],

                                        'plan_date' => $planDate,

                                        'cuser' => $logged_user_id,
                                        'social_id'=>'1',

                                        'cdate' => date('Y-m-d')

                                    );



                                   $result3 = $this->Account_model->insert_day_wise_adwordtata($adword_camp_data);



                                }

                            }

                        }

                    }



                 

					fclose($handle3);

                    /*redirect to same page*/

                   

					$this->session->set_flashdata('success_message', 'Adwords data uploaded Successfully');

                    redirect(base_url().'admin/Process/upload_plan_process');

                }

                }





            }else{

                /*redirect to same page*/

                $this->session->set_flashdata('error_message', 'Please Upload Only CSV File.');

                redirect(base_url().'admin/Process/upload_plan_process');

            }

        }else{

            /*redirect to same page*/

            $this->session->set_flashdata('error_message', 'Please Upload Only CSV File.');

           redirect(base_url().'admin/Process/upload_plan_process');

        }  

       }
       
       

       // for facebook upload

       public function fb_csv_adword_import()

       {

        $post='70';

        $logged_user_id=$this->session->userdata('user_id');

        $ch_permsn=$this->check_permission($post);

        if ($ch_permsn=='0')

        {

            redirect(base_url().'dashboard');

        }



        if($_FILES['csv']['name'])

        { 

           

            $filename = explode(".", $_FILES['csv']['name']);

            if($filename[1] == 'csv')

            {

                $handle = fopen($_FILES['csv']['tmp_name'], "r");

                $handle2 = fopen($_FILES['csv']['tmp_name'], "r");

                $handle3 = fopen($_FILES['csv']['tmp_name'], "r");

                $count = 0;

                $count_check = 0;



                $is_validated = TRUE;

                $line_numbers = 0;

                $error_lines = '';



                while ($data_csv1 = fgetcsv($handle2)) {

                    $line_numbers++;

                    $count_check++;



                    /*skip first column*/

                    if($count_check == 1) {



                        /*check if heading are not set properly*/

                    //  print   $data_csv1[0];

                    //     die;

                        if(count($data_csv1) == 7){



                        }else {

                            /*redirect to same page*/

                            $this->session->set_flashdata('error_message', 'Please check Heading Columns with Sample Download.All Columns Should Fill');

                            redirect(base_url().'admin/Process/fb_upload_plan_process');

                            // $url = "admin/Process/upload_plan_process";

                            // $this->redirector($url);

                        }

                    }else{



                        $counting_errors = 0;



                        if ($counting_errors == 0) {

                            $proj_acc_id = $data_csv1[0];

                            if ($proj_acc_id == '') {

                                $is_validated = FALSE;

                                $counting_errors = 1;

                                $error_lines = $error_lines . ', ' . $line_numbers;

                            }

                        }



                        if ($counting_errors == 0) {

                            $campgn_date = $data_csv1[1];

                            if ($campgn_date == '') {

                                $is_validated = FALSE;

                                $counting_errors = 1;

                                $error_lines = $error_lines . ', ' . $line_numbers;

                            }

                        }



                        if ($counting_errors == 0) {

                            $campgn_imprsion = $data_csv1[2];

                            if ($campgn_imprsion == '') {

                                $is_validated = FALSE;

                                $counting_errors = 1;

                                $error_lines = $error_lines . ', ' . $line_numbers;

                            }

                        }



                       



                        $counting_errors = 0;



                    }



                }





                if($is_validated) {

                    $row = 1;

                    $check_pojID="";

                    while ($data_csv = fgetcsv($handle)) {

                        if (count($data_csv) == 7 && $count != 1) {



                            $num = count($data_csv);	

                            $row++;

                            if($row>2)

                            {

                              //  $data_web_sel = $this->Admintype_model->usr_my_project();

                                $result5 = $this->Admintype_model->usr_my_project_for_upload(trim($data_csv[0]));

                                if($result5)

                                {

    

                                    $check_pojID="1";

                                

                                }

                                else

                                {

                                    $check_pojID="0";

                                    fclose($handle);

                                    $this->session->set_flashdata('error_message', 'Account id mismatch- '.$data_csv[0].' Please Correct or Remove Row');

                                    redirect(base_url().'admin/Process/fb_upload_plan_process');

                                    

                                }



                            $result1 = $this->Account_model->get_prject_account_no($data_csv[0]);

                            if($result1)

                            {



                                $check_pojID="1";

                            

                            }

                            else

                            {

                                $check_pojID="0";

                                fclose($handle);

                                $this->session->set_flashdata('error_message', 'Account id mismatch- '.$data_csv[0].' Please Correct or Remove Row');

                                redirect(base_url().'admin/Process/fb_upload_plan_process');

                                

                            }

                        }}}



                        if( $check_pojID=="1")

                        {

                              $row1 = 1;

                              $proIDget="";

                            //die;

                        while ($data_csv3 = fgetcsv($handle3)) {

                           

                            if (count($data_csv3) == 7 && $count != 1) {

    

                                $num = count($data_csv3);	

                                 $row1++;

                                if($row1>2)

                                {

                                   

                                    $result3 = $this->Account_model->get_prject_account_no($data_csv3[0]);

                                    if($result3)

                                    {

                                        foreach($result3 as $row3)

                                        {

                                            $proIDget= $row3->id;

                                           

                                        }

                                     

                                  

                                    $planDate = date('Y-m-d', strtotime(trim($data_csv3[1])));

                               

                                   

                                    $adword_camp_data = array(

                                        'proj_id' =>$proIDget,

                                        'view' => $data_csv3[2],

                                        'traffic' => $data_csv3[3],

                                        'lead' => $data_csv3[4],

                                        'cost' => $data_csv3[6],

                                        'buget' => $data_csv3[5],

                                        'plan_date' => $planDate,

                                        'cuser' => $logged_user_id,
                                        'social_id'=>'2',

                                        'cdate' => date('Y-m-d')

                                    );



                                   $result3 = $this->Account_model->insert_day_wise_adwordtata($adword_camp_data);



                                }

                            }

                        }

                    }



                 

					fclose($handle3);

                    /*redirect to same page*/

                   

					$this->session->set_flashdata('success_message', 'Facebook data uploaded Successfully');

                    redirect(base_url().'admin/Process/fb_upload_plan_process');

                }

                }





            }else{

                /*redirect to same page*/

                $this->session->set_flashdata('error_message', 'Please Upload Only CSV File.');

                redirect(base_url().'admin/Process/fb_upload_plan_process');

            }

        }else{

            /*redirect to same page*/

            $this->session->set_flashdata('error_message', 'Please Upload Only CSV File.');

           redirect(base_url().'admin/Process/fb_upload_plan_process');

        }  

       }


            



            public function delete_plan_progress_selected()

            {

                 $ajuserid=$this->input->post('ajuserid');

                  header('Content-Type: application/x-json; charset=utf-8');

                  echo (json_encode($this->Account_model->fn_delete_plan_progress_selected($ajuserid)));

            }



            

            public function keyword_idea()

            {

                $post='1';

                $ch_permsn=$this->check_permission($post);

               

                if ($ch_permsn=='0')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    

                    $data_web_sel = $this->Admintype_model->usr_my_project();

                    $data=array(

                        "keyword_name"=>$this->input->post('keyword_name'),

                        "data_web_sel"=>$data_web_sel,

                        "message_display"=>""

                    );

                    

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('plan/keyword_idea', $data);

                    $this->load->view('template/footer');

                }

            }



            // public function get_keyword_idea()

            // {

            //      $keyword_name=$this->input->post('keyword_name');

            //       header('Content-Type: application/x-json; charset=utf-8');

            //       echo (json_encode($this->Admintype_model->fetch_per_user_masterlist_role($keyword_name)));

            // }

            



            public function get_keyword_idea()

            {

                $keywordwebsite;

                $post='1';

                $keyword_name=$this->input->post('keyword_name');

                $ch_permsn=$this->check_permission($post);

                if ($ch_permsn=='0' || $keyword_name=='')

                {

                    redirect(base_url().'dashboard');

                }

                else{

                    $role_id=$this->session->userdata('role_id');

                    

                    //$proj_web=$this->input->post('web_id');

                    $proj_web="repairmyphone.today";

                    if (!empty($proj_web)) 

                    {

                        if (strpos($proj_web, '//') !== false) {



                            $data_web_sel[] = $proj_web; 

                            

                            $new_website=explode('//', $data_web_sel[0]);

                        

                            $keywordwebsite= $new_website[1];

                         

                        }

                        else

                        {

                               $keywordwebsite= $proj_web."das";

                            

                        }


                    }



                    $keywordName=$this->input->post('keyword_name');

                   // $keywordwebsite="tapouts.online";

                     $keywordresult = $this->GetKeywordIdeas->get_idea_with_keyword($keywordName,$keywordwebsite);

                     if ($keywordresult == TRUE) {

                    $data=array(

                        "keyword_name"=>$this->input->post('keyword_name'),

                        "keywordresult"=>$keywordresult,

                        "message_display"=>""

                    );

                    

                    $this->load->view('template/header');

                    $this->load->view('template/sidebar');

                    $this->load->view('plan/keyword_idea', $data);

                    $this->load->view('template/footer');

                }

                else

                {

                    $this->keyword_idea();

                }

                }

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







}

?>