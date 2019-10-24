<?php
require_once __DIR__ . '/vendor_analytics/autoload.php';
class GA_orgnic_nonorganic{




function initializeAnalytics()
{
  $KEY_FILE_LOCATION= __DIR__ . '/key_540635147.json';
  $client = new Google_Client();
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_Analytics ($client);
 
  return $analytics;
}







function OrganicResults($analytics, $profileId, $start_date, $end_date){
  $optParams= array(
    'dimensions'=>'ga:source',
    'filters'=>'ga:medium==organic',
    'metrics'=>'ga:sessions'
  );

  return $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessions',
    $optParams
  );

}






function NonOrganicResults($analytics, $profileId, $start_date, $end_date){
  $optParams= array(
    'dimensions'=>'ga:source',
    'filters'=>'ga:medium!=organic',
    'metrics'=>'ga:sessions'
  );

  return $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessions',
    $optParams
  );

}





function OutputData(){
  $analytics= $this->initializeAnalytics();
  //$profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  $profile=$_SESSION['projview_id_sesn'];

  $organic=array();
  $nonorganic=array();

  for($j=5; $j>=0; $j--)
  {
      $start_date=date('Y-m', strtotime("-$j month")).'-01';
 
    $d= new DateTime($start_date);
      $end_date=$d->format('Y-m-t');
      try {
              $organic[$j]=$this->OrganicResults($analytics, $profile, $start_date, $end_date)['totalsForAllResults']['ga:sessions'];
          } catch (\Google_Service_Exception $e) {
          $errorMsg= $e->getMessage();
          }
          try {
            $nonorganic[$j]=$this->NonOrganicResults($analytics, $profile, $start_date, $end_date)['totalsForAllResults']['ga:sessions'];
          } catch (\Google_Service_Exception $e) {
            $errorMsg= $e->getMessage();
            }
  }
  
if(!empty($errorMsg))
{
  $data=array(
    "resultError"=>"1"
  );
}
else
{
  $data=array(
    "organic"=>$organic,
    "nonorganic"=>$nonorganic
    
  );
}


  
 //print_r($data);
return $data;

}


function seo_user_home($analytics, $profileId, $start_date,$end_date){

  $optParams= array(
    'metrics'=>'ga:users'
  );

  return $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:users',
    $optParams
  );
}


function seo_session_home($analytics, $profileId, $start_date,$end_date){

  $optParams= array(
    'metrics'=>'ga:sessions'
  );

  return $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessions',
    $optParams
  );
}


function seo_bounceRate_home($analytics, $profileId, $start_date,$end_date){

  $optParams= array(
    'metrics'=>'ga:bounceRate'
  );

  return $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:bounceRate',
    $optParams
  );
}


function seo_sessionDuration_home($analytics, $profileId, $start_date,$end_date){

  $optParams= array(
    'metrics'=>'ga:sessionDuration'
  );

  return $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessionDuration',
    $optParams
  );
}


function user_home_graph(){
  $analytics= $this->initializeAnalytics();
  $errorMsg="";
  $profile=$_SESSION['projview_id_sesn'];

  $current_month=array();
  $old_month=array();
  $current_month1=array();
  $old_month1=array();
  $current_month2=array();
  $old_month2=array();
  $current_month3=array();
  $old_month3=array();

  $current_month0;
  $old_month0;
  $current_month01;
  $old_month01;
  $current_month02;
  $old_month02;
  $current_month03;
  $old_month03;

  $strat_date_all="";
  $end_date_all="";
  
  

  for($i = 29; $i >= 0; $i--) 
  {
       $start_date = date("Y-m-d", strtotime('-'. $i .' days'));
      if($i=='29')
      {
        $strat_date_all= $start_date;
      }
      if($i=='0')
      {
        $end_date_all= $start_date;
      }
     
      try {

              $current_month[$i]=$this->seo_session_home($analytics, $profile, $start_date, $start_date)['totalsForAllResults']['ga:sessions'];
              $current_month1[$i]=$this->seo_user_home($analytics, $profile, $start_date, $start_date)['totalsForAllResults']['ga:users'];
              $current_month2[$i]=$this->seo_bounceRate_home($analytics, $profile, $start_date, $start_date)['totalsForAllResults']['ga:bounceRate'];
              $current_month3[$i]=$this->seo_sessionDuration_home($analytics, $profile, $start_date, $start_date)['totalsForAllResults']['ga:sessionDuration'];

             


          } catch (\Google_Service_Exception $e) {
            $errorMsg= $e->getMessage();
          }
  }
  // print_r($current_month2);
  // die;
    //for current date all data between range

    $current_month0=$this->seo_session_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:sessions'];

    $current_month01=$this->seo_user_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:users'];
    $current_month02=$this->seo_bounceRate_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:bounceRate'];
    $current_month03=$this->seo_sessionDuration_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:sessionDuration'];



  for($i = 59; $i >= 30; $i--) 
  {
       $start_date1 = date("Y-m-d", strtotime('-'. $i .' days'));
       if($i=='59')
       {
         $strat_date_all= $start_date1;
       }
       if($i=='30')
       {
         $end_date_all= $start_date1;
       }
     
      try {
               $old_month[$i]=$this->seo_session_home($analytics, $profile, $start_date1, $start_date1)['totalsForAllResults']['ga:sessions'];
               $old_month1[$i]=$this->seo_user_home($analytics, $profile, $start_date1, $start_date1)['totalsForAllResults']['ga:users'];
               $old_month2[$i]=$this->seo_bounceRate_home($analytics, $profile, $start_date1, $start_date1)['totalsForAllResults']['ga:bounceRate'];
               $old_month3[$i]=$this->seo_sessionDuration_home($analytics, $profile, $start_date1, $start_date1)['totalsForAllResults']['ga:sessionDuration'];

          } catch (\Google_Service_Exception $e) {
            $errorMsg= $e->getMessage();
          }
  }
  // print_r($old_month2);
  //  die;
  // for all data before date range

  $old_month0=$this->seo_session_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:sessions'];
    $old_month01=$this->seo_user_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:users'];
    $old_month02=$this->seo_bounceRate_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:bounceRate'];
    $old_month03=$this->seo_sessionDuration_home($analytics, $profile, $strat_date_all, $end_date_all)['totalsForAllResults']['ga:sessionDuration'];


    

    $per1=round((($current_month0-$old_month0)/$current_month0)*100, 2);
    $per2=round((($current_month01-$old_month01)/$current_month01)*100, 2);
    $per3=round((($current_month02-$old_month02)/$current_month02)*100, 2);
    $per4=round((($current_month03-$old_month03)/$current_month03)*100, 2);


if(!empty($errorMsg))
{
  $data=array(
    "resultError"=>"1"
  );
}
else
{
  $data=array(
    "current_month"=>$current_month,
    "old_month"=>$old_month,
    "current_month1"=>$current_month1,
    "old_month1"=>$old_month1,
    "current_month2"=>$current_month2,
    "old_month2"=>$old_month2,
    "current_month3"=>$current_month3,
    "old_month3"=>$old_month3,
    "current_month0"=>$current_month0,
    "current_month01"=>$current_month01,
    "current_month02"=>$current_month02,
    "current_month03"=>$current_month03,
    "per1"=>$per1,
    "per2"=>$per2,
    "per3"=>$per3,
    "per4"=>$per4
  );
}
return $data;

}






}