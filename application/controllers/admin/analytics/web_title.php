<?php
require_once __DIR__ . '/vendor_analytics/autoload.php';
class GA_orgnic_webtile{


//$analytics = initializeAnalytics($KEY_FILE_LOCATION);


//$analytics_reprt = initializeAnalytics_reporting($KEY_FILE_LOCATION);

// $response = getReport($analytics,$analytics_reprt,$KEY_FILE_LOCATION);
// printResults($response);



function initializeAnalytics()
{
  $KEY_FILE_LOCATION= __DIR__ . '/key_540635147.json';
  $client = new Google_Client();
  $client->setAuthConfig($KEY_FILE_LOCATION);
  $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
  $analytics = new Google_Service_Analytics ($client);
 
  return $analytics;
}




// function getFirstProfileId($analytics) {
//   // Get the user's first view (profile) ID.

//   // Get the list of accounts for the authorized user.
//   $accounts = $analytics->management_accounts->listManagementAccounts();

//   if (count($accounts->getItems()) > 0) {
//     $items = $accounts->getItems();
    
//     $firstAccountId = $items[0]->getId();

 

//    // print $getName = $items[0]->getSelfLink();

//     // Get the list of properties for the authorized user.
//     $properties = $analytics->management_webproperties->listManagementWebproperties($firstAccountId);

//     if (count($properties->getItems()) > 0) {
//       $items = $properties->getItems();
//       $firstPropertyId = $items[0]->getId();

//       // Get the list of views (profiles) for the authorized user.
//       $profiles = $analytics->management_profiles->listManagementProfiles($firstAccountId, $firstPropertyId);

//       if (count($profiles->getItems()) > 0) {
//         $items = $profiles->getItems();

//         // Return the first view (profile) ID.
//         // print $items[0]->getId();
        
//         return $items[0]->getId();

//       } else {
//         throw new Exception('No views (profiles) found for this user.');
//       }
//     } else {
//       throw new Exception('No properties found for this user.');
//     }
//   } else {
//     throw new Exception('No accounts found for this user.');
//   }
// }







public function web_pageTitle($analytics, $profileId, $start_date, $end_date){


  $Params= array(
    'metrics'=>'ga:sessions',
    'dimensions'=>'ga:pageTitle'
  );
 
 
 try{
   $aData= $analytics->data_ga->get(
     'ga:'. $profileId,
     $start_date,
     $end_date,
     'ga:sessions',
     $Params
     );
    
     $result2=$aData->getRows();
     arsort($result2);
     return $result2;
 }catch (ExpiredException $e) {
   return false;
 }

}



function OutputData(){
  $analytics= $this->initializeAnalytics();
  //$profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  $profile=$_SESSION['projview_id_sesn'];

 

  $start_dateref="30daysAgo";
  $end_dateref="today";
  

    try {
      $web_pageTitle=$this->web_pageTitle($analytics, $profile, $start_dateref, $end_dateref);
  
    } catch (\Google_Service_Exception $e) {
      $errorMsg= $e->getMessage();
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
    "web_pageTitle"=>$web_pageTitle
    
  );
}


  
 //print_r($data);
return $data;

}






function search_title_OutputData(){
  $analytics= $this->initializeAnalytics();
  //$profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  $profile=$_SESSION['projview_id_sesn'];


  $start_dateref="30daysAgo";
  $end_dateref="today";
  


    try {
      $web_pageTitle=$this->web_pageTitle($analytics, $profile, $start_dateref, $end_dateref);
  
    } catch (\Google_Service_Exception $e) {
      $errorMsg= $e->getMessage();
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
    "web_pageTitle"=>$web_pageTitle
    
  );
}


  
 //print_r($data);
return $data;

}



function search_keyword_OutputData(){
  $analytics= $this->initializeAnalytics();
  //$profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  $profile=$_SESSION['projview_id_sesn'];

  $start_dateref="30daysAgo";
  $end_dateref="today";

    try {
      $getSearchWords=$this->getSearchWords($analytics, $profile, $start_dateref, $end_dateref);
  
    } catch (\Google_Service_Exception $e) {
      $errorMsg= $e->getMessage();
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
    "getSearchWords"=>$getSearchWords
  );
}


  
 //print_r($data);
return $data;

}

}