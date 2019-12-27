<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'on');

// print "asdasd";
	//die;
	
class LoginWithGooglePlus extends CI_Controller{
	
	public function __construct() {
        parent::__construct();
		$this->load->model('admin/Google_analytics_tp');
		$this->config->load('ga_api');
		$ga_params = array(
			'applicationName' => $this->config->item('ga_api_applicationName'),
			 'clientID' => $this->config->item('ga_api_clientId'),
			'clientSecret' => $this->config->item('ga_api_clientSecret'),
			'redirectUri' => $this->config->item('ga_api_redirectUri'),
			 'developerKey' => $this->config->item('ga_api_developerKey'),
			 'profileID' => $this->config->item('ga_api_profileId')
		 );
		$this->load->library('GoogleAnalytics', $ga_params);
		
	}
	
	public function login()
	{
		unset($_SESSION['token_analytics_prj']);
		unset($_SESSION['token']);
		//$_SESSION['token_analytics_prj']="";
		$projIDpop=$this->session->userdata('projID');
		
			$result = $this->Google_analytics_tp->get_analytics_token_session_by_project($projIDpop);
		if(!empty($result))
		{
			$_SESSION['token_analytics_prj'] =$result;
			redirect(base_url('analytics_overview'));
		}
		else{
			
			$_SESSION['token_analytics_prj']="";
			$data['account_detail']=$this->googleanalytics->login();
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('analytics/login', $data);
			$this->load->view('template/footer');	
		}
		
	}

	public function discoonect_analytics()
	{
		unset($_SESSION['token_analytics_prj']);
		unset($_SESSION['token']);
	
		$projIDpop=$this->session->userdata('projID');
		
		$token_check="";
		//$_SESSION['token_analytics_prj']='';
		$result = $this->Google_analytics_tp->update_analytics_token_session_by_project($token_check,$projIDpop);
		if(!empty($result))
		{
			$_SESSION['token_analytics_prj']="";
			$data['account_detail']=$this->googleanalytics->login();
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('analytics/login', $data);
			$this->load->view('template/footer');	
		}
		else{
			
			$_SESSION['token_analytics_prj']="";
			$data['account_detail']=$this->googleanalytics->login();
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('analytics/login', $data);
			$this->load->view('template/footer');	
		}
		
	}
	

	public function index(){
	
		$projIDpop=$this->session->userdata('projID');
			$data['account_detail']=$this->googleanalytics->get_analytics_account_detail();
			if(!empty($_SESSION['token'])){
			
				 $token_check= $_SESSION['token'];

				$_SESSION['token_analytics_prj']=$token_check;
				$result = $this->Google_analytics_tp->update_analytics_token_session_by_project($token_check,$projIDpop);
			}
			if(!empty($data['account_detail'])){
				foreach ($data['account_detail'] as $account) {
							
					$accountId = $account->id;
					$accountName = $account->name;
				
					$result = $this->Google_analytics_tp->insert_google_account_detail($accountId,$accountName,$projIDpop);
				}
				$this->load->view('template/header');
				$this->load->view('template/sidebar');
				$this->load->view('analytics/index', $data);
				$this->load->view('template/footer');
			}
			
		
	}
	
	public function get_webproperty(){
		 $account_id = $this->input->post('accunt_Id');
		 $data['webdetail_detail'] =$this->googleanalytics->get_analytics_webproperties($account_id);
		 foreach ($data['webdetail_detail'] as $webaccount) {
			$web_Id = $webaccount->id;
			$web_Name = $webaccount->name;
			$result = $this->Google_analytics_tp->insert_google_account_webproperty($web_Id,$web_Name,$account_id);
		  }
		 header('Content-Type: application/x-json; charset=utf-8');
		 echo (json_encode($data['webdetail_detail']));
	}


	public function get_webprofile(){
		$account_id = $this->input->post('accunt_Id');
		$web_property_ID = $this->input->post('web_property_ID');
		$data['profile_detail'] =$this->googleanalytics->get_analytics_profileroperties($account_id,$web_property_ID);
		foreach ($data['profile_detail'] as $webprofile) {
		   $profile_Id = $webprofile->id;
		   $profile_Name = $webprofile->name;
		   $result = $this->Google_analytics_tp->insert_google_account_profileproperty($profile_Id,$profile_Name,$web_property_ID);
		 }
		header('Content-Type: application/x-json; charset=utf-8');
		echo (json_encode($data['profile_detail']));
   }

   public function mainAnalyticsDashboard(){
	  $projIDpop=$this->session->userdata('projID');
	  
	$first_day_this_month = date('Y-m-d');
	$last_day_this_month  = date('Y-m-d', strtotime('-30 days'));
	$result = $this->Google_analytics_tp->get_google_account_profileproperty($projIDpop);

	$data['organicSession']=$this->get_allorganic_Nonorganic($result,$first_day_this_month,$last_day_this_month);
	//$data['nonorganicSession']=$this->nonoraganic_session($result,$first_day_this_month,$last_day_this_month);
	// print_r($data);
	// die;
	
	$this->load->view('template/header');
	$this->load->view('template/sidebar');
	$this->load->view('analytics/analytics_home', $data);
	$this->load->view('template/footer');
	
	
   }


   public function get_allorganic_Nonorganic($result,$first_day_this_month,$last_day_this_month){

	$data=$this->googleanalytics->get_Allorganic_nonorganic($result,$first_day_this_month,$last_day_this_month);
 
	return $data;
   }


   

   public function getSession($result,$first_day_this_month,$last_day_this_month){

	$data=$this->googleanalytics->OrganicResults($result,$first_day_this_month,$last_day_this_month);
 
	return $data;
   }


   public function getTotaluser(){
	$data['account_detail']=$this->googleanalytics->get_total($result,$first_day_this_month,$last_day_this_month);
	print_r($data);
   }



	public function profile(){
		if($this->session->userdata('login') == true)
		{
			$data['profileData'] = $this->session->userdata('userProfile');
			$this->load->view('profile',$data);
		}
		else
		{
			redirect('');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->googleplus->revokeToken();
		redirect('');
	}
}//class ends here
