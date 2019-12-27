<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Seo extends CI_Controller{

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

            $this->url=uri_string();


            if(!$this->logged)

             {

                 redirect(base_url().'login/'); 

             }

         }
         public function index() {

            //ggoole login 
    
    
            if(isset($_GET['code']))
            {
                
                $this->googleplus->getAuthenticate();
               // $this->session->set_userdata('login_google',true);
                //$this->session->set_userdata('userProfile',$this->googleplus->getUserInfo());
               
                redirect($this->search_page_title());
            }
          
            
                $data['loginURL'] = $this->googleplus->loginURL();
                 $data['message_display'] ='';
                $data['error_message'] ='';
    
    
                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/login_analytics', $data);

                $this->load->view('template/footer');
        }
         public function session_check()

         {

         if($this->session->userdata('logged_in') != null)

             return TRUE;

         else

             return FALSE;

         }



    public function alexa_graph_seostats()

    		{

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/SEOstats/seostats_alexa-graphs');

                $this->load->view('template/footer');

            }


            public function alexa_rank_seostats()

    		{

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/SEOstats/get-alexa-metrics');

                $this->load->view('template/footer');

            }


            public function web_traffic_analytics()

    		{
                require_once __DIR__ . '/analytics/Check5.php';

                $GA_orgnic_nonorganic=new GA_orgnic_nonorganic();

                $result = $GA_orgnic_nonorganic->OutputData();

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/website_traffic', $result);

                $this->load->view('template/footer');

            }



            public function web_traffic_analytics_home()

    		{
                require_once __DIR__ . '/analytics/Analytics_home.php';

                $GA_orgnic_nonorganic=new GA_orgnic_nonorganic();

                $result = $GA_orgnic_nonorganic->user_home_graph();

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/analytics_home', $result);

                $this->load->view('template/footer');

            }


            public function search_page_title()
            {
               
                require_once __DIR__ . '/analytics/Check5.php';

                $GA_orgnic_nonorganic=new GA_orgnic_nonorganic();

                $result = $GA_orgnic_nonorganic->search_title_OutputData();

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/search_title', $result);

                $this->load->view('template/footer');
            }



            public function source_medium()
            {
                require_once __DIR__ . '/analytics/Check5.php';

                $GA_orgnic_nonorganic=new GA_orgnic_nonorganic();

                $result = $GA_orgnic_nonorganic->search_Soucremdeium_OutputData();

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/search_sourcemedium', $result);

                $this->load->view('template/footer');
            }

            




            public function searched_keyword()
            {
                require_once __DIR__ . '/analytics/Check5.php';

                $GA_orgnic_nonorganic=new GA_orgnic_nonorganic();

                $result = $GA_orgnic_nonorganic->search_keyword_OutputData();

                $this->load->view('template/header');

                $this->load->view('template/sidebar');

                $this->load->view('seo/search_keyword', $result);

                $this->load->view('template/footer');
            }










            





          





}

?>