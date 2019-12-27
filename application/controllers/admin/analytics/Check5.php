<?php
require_once __DIR__ . '/vendor_analytics/autoload.php';
class GA_orgnic_nonorganic{


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




function getFirstProfileId($analytics) {
  // Get the user's first view (profile) ID.

  // Get the list of accounts for the authorized user.
  $accounts = $analytics->management_accounts->listManagementAccounts();

  if (count($accounts->getItems()) > 0) {
    $items = $accounts->getItems();
  
    $firstAccountId = $items[3]->getId();

 

   // print $getName = $items[0]->getSelfLink();

    // Get the list of properties for the authorized user.
    $properties = $analytics->management_webproperties->listManagementWebproperties($firstAccountId);

    if (count($properties->getItems()) > 0) {
      $items = $properties->getItems();
      $firstPropertyId = $items[0]->getId();

      // Get the list of views (profiles) for the authorized user.
      $profiles = $analytics->management_profiles->listManagementProfiles($firstAccountId, $firstPropertyId);

      if (count($profiles->getItems()) > 0) {
        $items = $profiles->getItems();

        // Return the first view (profile) ID.
        // print $items[0]->getId();
        
        return $items[0]->getId();

      } else {
        throw new Exception('No views (profiles) found for this user.');
      }
    } else {
      throw new Exception('No properties found for this user.');
    }
  } else {
    throw new Exception('No accounts found for this user.');
  }
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

function unique_page_view($analytics, $profileId, $start_date, $end_date){

  $Params= array(
      'metrics'=>'ga:uniquePageviews,ga:avgTimeOnPage',
      'dimensions'=>'ga:pagePath',
      'filters'=>'ga:pagePath==/',
      'max-results'=>'10'
    );



  $result= $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessions',
    $Params
  );


  return $result->getRows();
}

function getReferrers($analytics, $profileId, $start_date, $end_date){

  $Params= array(
   'metrics'=>'ga:visits',
   'dimensions'=>'ga:source'
 );


try{
  $result1= $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessions',
    $Params
    );
    
    $result2=$result1->getRows();
    arsort($result2);
    return $result2;
}catch (ExpiredException $e) {
  return false;
}


}



function getPageviews($analytics, $profileId, $start_date, $end_date){

  $Params= array(
   'metrics'=>'ga:pageviews',
   'dimensions'=>'ga:day',
   'sort'=> 'ga:day'
 );


try{
  $result1= $analytics->data_ga->get(
    'ga:'. $profileId,
    $start_date,
    $end_date,
    'ga:sessions',
    $Params
    );
    
    $result2=$result1->getRows();
    arsort($result2);
    return $result2;
}catch (ExpiredException $e) {
  return false;
}


}



public function getBrowsers($analytics, $profileId, $start_date, $end_date){

 // 'dimensions'=>'ga:browser,ga:browserVersion',

  $Params= array(
    'metrics'=>'ga:visits',
    'dimensions'=>'ga:browser',
    'sort'=>'ga:visits'
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




public function getSearchWords($analytics, $profileId, $start_date, $end_date){



  // sort descending by number of visits                                                                                                                                                     

  $Params= array(
    'metrics'=>'ga:visits',
    'dimensions'=>'ga:keyword',
    'sort'=>'ga:keyword'
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


public function getSoucremdeium($analytics, $profileId, $start_date, $end_date){



  // sort descending by number of visits                                                                                                                                                     

  $Params= array(
    'metrics'=>'ga:visits',
    'dimensions'=>'ga:sourceMedium',
    'sort'=>'ga:sourceMedium'
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



public function getuserType($analytics, $profileId, $start_date, $end_date){


  $Params= array(
    'metrics'=>'ga:sessions',
    'dimensions'=>'ga:userType'
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



public function deviceCategory($analytics, $profileId, $start_date, $end_date){


  $Params= array(
    'metrics'=>'ga:sessions',
    'dimensions'=>'ga:deviceCategory'
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
  $profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  //$profile=$_SESSION['projview_id_sesn'];

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
  try {
      $unique_page_view=$this->unique_page_view($analytics, $profile, $start_date, $end_date);
    } catch (\Google_Service_Exception $e) {
      $errorMsg= $e->getMessage();
      }

  $start_dateref="30daysAgo";
  $end_dateref="today";
  try {
    $getReferrers=$this->getReferrers($analytics, $profile, $start_dateref, $end_dateref);
  } catch (\Google_Service_Exception $e) {
  $errorMsg= $e->getMessage();
  }


  try {
    $getPageviews=$this->getPageviews($analytics, $profile, $start_dateref, $end_dateref);
   
  } catch (\Google_Service_Exception $e) {
  $errorMsg= $e->getMessage();
  }

  try {
  $getBrowsers=$this->getBrowsers($analytics, $profile, $start_dateref, $end_dateref);
} catch (\Google_Service_Exception $e) {
  $errorMsg= $e->getMessage();
  }

  try {
 $getSearchWords=$this->getSearchWords($analytics, $profile, $start_dateref, $end_dateref);
//  print_r($getSearchWords);
//  die;
} catch (\Google_Service_Exception $e) {
  $errorMsg= $e->getMessage();
  }

  try {
  $getuserType=$this->getuserType($analytics, $profile, $start_dateref, $end_dateref);
} catch (\Google_Service_Exception $e) {
  $errorMsg= $e->getMessage();
  }



  try {
    $deviceCategory=$this->deviceCategory($analytics, $profile, $start_dateref, $end_dateref);

  } catch (\Google_Service_Exception $e) {
    $errorMsg= $e->getMessage();
    }


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
    "organic"=>$organic,
    "nonorganic"=>$nonorganic,
    "unique_page_view"=>$unique_page_view,
    "getReferrers"=>$getReferrers,
    "getBrowsers"=>$getBrowsers,
    "getSearchWords"=>$getSearchWords,
    "getuserType"=>$getuserType,
    "deviceCategory"=>$deviceCategory,
    "web_pageTitle"=>$web_pageTitle,
    "getPageviews"=>$getPageviews
    
  );
}


  
 //print_r($data);
return $data;

}






function search_title_OutputData(){
  $analytics= $this->initializeAnalytics();
 print $profile=$this->getFirstProfileId($analytics);


  $errorMsg="";
  //$profile=$_SESSION['projview_id_sesn'];


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


function search_Soucremdeium_OutputData(){
  $analytics= $this->initializeAnalytics();
  $profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  //$profile=$_SESSION['projview_id_sesn'];


  $start_dateref="30daysAgo";
  $end_dateref="today";
  


    try {
      $web_pageTitle=$this->getSoucremdeium($analytics, $profile, $start_dateref, $end_dateref);
  
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

return $data;

}



function search_keyword_OutputData(){
  $analytics= $this->initializeAnalytics();
  $profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  //$profile=$_SESSION['projview_id_sesn'];

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



function unique_avgTime_OutputData(){
  $analytics= $this->initializeAnalytics();
  $profile=$this->getFirstProfileId($analytics);
  $errorMsg="";
  //$profile=$_SESSION['projview_id_sesn'];

  $start_dateref="30daysAgo";
  $end_dateref="today";

    try {
      $unique_page_view=$this->unique_page_view($analytics, $profile, $start_dateref, $end_dateref);
      $data=array(
        "unique_page_view"=>$unique_page_view
      );

      return $data;
    } catch(Exception $e) {
      //echo 'Message: ' .$e->getMessage();
     // die;
     return false;
    }


}

}