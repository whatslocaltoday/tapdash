<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GoogleAnalytics {

    var $ga_api_applicationName;
    var $ga_api_clientId;
    var $ga_api_clientSecret;
    var $ga_api_redirectUri;
    var $ga_api_developerKey;
    var $ga_api_profileId;
    var $client;
    var $access_token_ready;
    var $result;
    var $analytics = false;
    private $CI = null; 
    public function __construct($params) {
       
        require_once 'google-api-php-client/src/Google_Client.php';
        require_once 'google-api-php-client/src/contrib/Google_AnalyticsService.php';
       
     
        $this->ga_api_applicationName = $params['applicationName'];
        $this->ga_api_clientId = $params['clientID'];
        $this->ga_api_clientSecret = $params['clientSecret'];
        $this->ga_api_redirectUri = $params['redirectUri'];
        $this->ga_api_developerKey = $params['developerKey'];
        $this->ga_api_profileId = $params['profileID'];
        $token_analytics_pRj=$_SESSION['token_analytics_prj'];
        
         if(!empty($token_analytics_pRj)){
            $_SESSION['token']=$token_analytics_pRj;
         }
         else{
            unset($_SESSION['token']);
         }

        $this->client = new Google_Client();
        $this->client->setApplicationName($this->ga_api_applicationName);
        $this->client->setClientId($this->ga_api_clientId);
        $this->client->setClientSecret($this->ga_api_clientSecret);
        $this->client->setRedirectUri($this->ga_api_redirectUri);
        $this->client->setDeveloperKey($this->ga_api_developerKey);
        $this->client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
      
        $this->analytics = new Google_AnalyticsService($this->client);
        if (isset($_SESSION['token'])) {
         
            $this->client->setAccessToken($_SESSION['token']);
           
        }

        $this->client->setUseObjects(true);
       
       
        if (isset($_GET['code'])) {
           
            $this->client->authenticate();
            
            $_SESSION['token'] = $this->client->getAccessToken();
            $token_check= $_SESSION['token'];
            
       
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        }

        $this->access_token_ready = $this->client->getAccessToken();
        if (!$this->access_token_ready) {
            $authUrl = $this->client->createAuthUrl();
           // return $authUrl;
         //  print "<a class='login' href='$authUrl'>Connect Me!</a>";
        }
        

    }

public function login ()
{
    unset($_SESSION['token']);
    
    $this->analytics = new Google_AnalyticsService($this->client);
        if (isset($_SESSION['token'])) {
            $this->client->setAccessToken($_SESSION['token']);
        }
       
        $this->client->setUseObjects(true);
       
    
        if (isset($_GET['code'])) {
           
            $this->client->authenticate();
            
            $_SESSION['token'] = $this->client->getAccessToken();
             $token_check= $_SESSION['token'];
             
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            
        }
      
        //  $this->access_token_ready = $this->client->getAccessToken();
        // if (!$this->access_token_ready) {
            $authUrl = $this->client->createAuthUrl();
         
            return $authUrl;
         //   print "<a class='login' href='$authUrl'>Connect Me!</a>";
        //}
       
}

  


    public function get_analytics_account_detail() {
        $result;
        $accounts;
        if ($this->access_token_ready) {
          $analytics=$this->analytics;
            try {
               $result = $this->analytics->management_accounts->listManagementAccounts();
                $accounts = $result->items;
            return $accounts;

            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }

    public function get_analytics_webproperties($accountId)
    {
        $analytics=$this->analytics;
        $result = $analytics->management_webproperties->listManagementWebproperties($accountId);
        $webProperties = $result->items;
    
        return $webProperties;
     
    }
    public function get_analytics_profileroperties($accountId,$web_property_ID)
    {
        $analytics=$this->analytics;
        $result = $analytics->management_profiles->listManagementProfiles($accountId, $web_property_ID);
        $webProfile = $result->items;
    
        return $webProfile;
       
    }



    /**
     * 
     * @param type $type Type of result {users,newUsers,percentNewSessions,sessions,bounces}
     * https://developers.google.com/analytics/devguides/reporting/core/dimsmets
     * Use without ga:
     * @return int
     */
    public function get_total($ga_api_profileId,$first_day_this_month,$last_day_this_month) {
        $type = 'users';
        if ($this->access_token_ready) {
            $analytics=$this->analytics;
            try {

                $optParams = array(
                    'max-results' => '100');
               
                $results = $analytics->data_ga->get('ga:' . $ga_api_profileId, $last_day_this_month, $first_day_this_month, 'ga:' . $type, $optParams);

                $ga_total = 0;
                if (count($results->getRows()) > 0) {
                    foreach ($results->getRows() as $row) {
                        foreach ($row as $cell) {
                            $ga_total = $cell;
                        }
                    }
                } else {
                    return 0;
                }
           
                return $ga_total;
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }


    public function organicResults($ga_api_profileId,$first_day_this_month,$last_day_this_month) {
    
        if ($this->access_token_ready) {
            $analytics=$this->analytics;
            try {
                $type='sessions';
                $optParams = array(
                    'filters'=>'ga:medium==organic',
                    'metrics'=>'ga:sessions'
                );
               
                $results = $analytics->data_ga->get('ga:' . $ga_api_profileId, $last_day_this_month, $first_day_this_month, 'ga:' . $type, $optParams);
       
                $ga_total = 0;
                if (count($results->getRows()) > 0) {
                    //$ga_total =  $results->getRows();
                    foreach ($results->getRows() as $row) {
                        foreach ($row as $cell) {
                            $ga_total = $cell;
                        }
                    }
                } else {
                    return 0;
                }
      
                return $ga_total;
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }

    public function nonorganicResults($ga_api_profileId,$each_date) {

   
        if ($this->access_token_ready) {
            $analytics=$this->analytics;
            try {
                $type='sessions';
                $optParams = array(
                    'filters'=>'ga:medium!=organic',
                    'metrics'=>'ga:sessions'
                );
               
                $results = $analytics->data_ga->get('ga:' . $ga_api_profileId, $each_date, $each_date, 'ga:' . $type, $optParams);

                $ga_total = 0;
                if (count($results->getRows()) > 0) {
                   // $ga_total =  $results->getRows();
                // print_r($ga_total);
                // die;
                    foreach ($results->getRows() as $row) {
                        foreach ($row as $cell) {
                            $ga_total = $cell;
                        }
                    }
                  
                } else {
                    return 0;
                }
          
                return $ga_total;
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }

    public function total_Session_count($ga_api_profileId,$each_date) {
      
   
        if ($this->access_token_ready) {
            $analytics=$this->analytics;
            try {
                $type='sessions';
                $optParams = array(
                    'metrics'=>'ga:sessions'
                );
               
                $results = $analytics->data_ga->get('ga:' . $ga_api_profileId, $each_date,$each_date, 'ga:' . $type, $optParams);

                $ga_total = 0;
                if (count($results->getRows()) > 0) {
                
                    foreach ($results->getRows() as $row) {
                        foreach ($row as $cell) {
                            $ga_total = $cell;
                        //    print_r($ga_total);
                        }
                    }
                  
                } else {
                    return 0;
                }
   
                return $ga_total;
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }


public function get_Allorganic_nonorganic($profle_ID, $start_date, $end_date)
{
    $begin = new DateTime($end_date );
    $end   = new DateTime($start_date);
    
    // for($i = $begin; $i <= $end; $i->modify('+1 day')){
    //     echo $i->format("Y-m-d");
    //     die;
    // }

    //die;

    $organic=array();
    $nonorganic=array();
    $sessionCount=array();
    for($i = $begin; $i <= $end; $i->modify('+1 day')){

    $each_date =$i->format("Y-m-d");
    // for($j=5; $j>=0; $j--)
    
    // {
    //     $start_date1=date('Y-m', strtotime("-$j month")).'-01';
   
    //   $d= new DateTime($start_date1);
    //     $end_date1=$d->format('Y-m-t');
        // try {
        //         $organic[$j]=$this->organicResults($profle_ID, $end_date1, $start_date1);
               
        //     } catch (\Google_Service_Exception $e) {
        //     $errorMsg= $e->getMessage();
        //     }
            try {
              $nonorganic[$each_date]=$this->nonorganicResults($profle_ID, $each_date);
              
            } catch (\Google_Service_Exception $e) {
              $errorMsg= $e->getMessage();
              }
            // try {
            // $sessionCount[$each_date]=$this->total_Session_count($profle_ID, $each_date);
         
            // } catch (\Google_Service_Exception $e) {
            // $errorMsg= $e->getMessage();
            // }

    }

    $data=array(
        "organic"=>$organic,
        "nonorganic"=>$nonorganic,
        "sessionCount"=>$sessionCount
    );

   return $data;
}
    

    // function OrganicResults($profileId, $start_date, $end_date){
    //     $analytics=$this->analytics;
    //     $optParams= array(
    //       'dimensions'=>'ga:source',
    //       'filters'=>'ga:medium==organic',
    //       'metrics'=>'ga:sessions'
    //     );
      
    //     return $analytics->data_ga->get(
    //       'ga:'. $profileId,
    //       $start_date,
    //       $end_date,
    //       'ga:sessions',
    //       $optParams
    //     );
      
    //   }


    /**
     * 
     * @param type $dimension Type of dimension to filter {browser,browserVersion,operatingSystem,operatingSystemVersion,isMobile,isTablet,mobileDeviceBranding,mobileDeviceModel,mobileInputSelector,mobileDeviceInfo,mobileDeviceMarketingName,deviceCategory}
     * @param type $type Type of result {users,newUsers,percentNewSessions,sessions,bounces}
     * https://developers.google.com/analytics/devguides/reporting/core/dimsmets
     */
    public function get_dimensions($dimension = 'browser', $type = 'users',$first_day_this_month,$last_day_this_month) {
        $result;
        $accounts;
        if ($this->access_token_ready) {
          // die;
          $analytics=$this->analytics;
     
            try {
            
               $result = $this->analytics->management_accounts->listManagementAccounts();
                $accounts = $result->items;
              
                 foreach ($accounts as $account) {
                   
                    // print "Found an account with an ID of {$account->id} and a name of {$account->name}\n";
                 }
                //     $accountI_d[] = $account->id; 
                //     $accountI_d[] = $account->name; 
                     $accountId = $account->id;
                 // die;
//                       if($accountId=='144275597')
//                       {
// //                 //  if(($accountId !='42094652') || ($accountId !='54063514') || ($accountId !='42094652'))
// //                 //  {
//                 $result = $analytics->management_webproperties->listManagementWebproperties($accountId);
//                     $webProperties = $result->items;
//           //      print_r($webProperties);
//                 foreach ($webProperties as $webProperty) {
//                   // print "Found a web property for the site {$webProperty->websiteUrl}, with an ID of {$webProperty->id} and a name of {$webProperty->name}\n"; 
//                //  print "{$webProperty->name}\n"; 
//                  }
// //                  //code working 
//                  $webPropertyId = $webProperties[0]->id;
              
//                $result = $analytics->management_profiles->listManagementProfiles('144275597', 'UA-144275597-2');
//                $profiles[] = $result->items;
               
//             //    foreach ($profiles as $profile) {
//             //   //     print "Found a profile with an ID of {$profile->id} and a name of {$profile->name}\n"; 
//             //     }
                

               

//                 $profileId = $profiles[0][0]->id;
//                 //print "$profileId\n";

//                 $optParams = array(
//                     'dimensions' => 'ga:' . $dimension,
//                     'max-results' => '100');
//                 $results = $analytics->data_ga->get('ga:' . $profileId, $last_day_this_month, $first_day_this_month, 'ga:' . $type, $optParams);

//                 $ga_dimension = array();
//                 if (count($results->getRows()) > 0) {
//                     foreach ($results->getRows() as $row) {
//                         $ga_dimension[$row[0]] = $row[1];
//                     }
//                 } else {
                   
//                    // return NULL;
//                 }
//                // print_r($ga_dimension);
//                // die;
//                  return $ga_dimension;
return $accounts;
// // //code working close


// //                 //}
                
//              }

          // }
        //    $analytic_data['accounts']=$accounts;
        //    $analytic_data['webProperties']=$webProperties;
        //    $analytic_data['profiles']=$profiles;
        //    print_r($accounts);
        //    print_r($webProperties);
        //  print_r($profiles);
        //  die;  
        // return $analytic_data;



            //}
        //    die;
                // $optParams = array(
                //     'dimensions' => 'ga:' . $dimension,
                //     'max-results' => '100');
                // $results = $analytics->data_ga->get('ga:' . $this->ga_api_profileId, '2018-02-18', '2019-11-19', 'ga:' . $type, $optParams);

                // $ga_dimension = array();
                // if (count($results->getRows()) > 0) {
                //     foreach ($results->getRows() as $row) {
                //         $ga_dimension[$row[0]] = $row[1];
                //     }
                // } else {
                //     return NULL;
                // }
                // return $ga_dimension;
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }

    public function get_profile_info() {
  
        if ($this->access_token_ready) {
            $analytics = new Google_AnalyticsService($this->client);
            try {
                $optParams = array(
                    'max-results' => '1');
                $results = $analytics->data_ga->get('ga:' . $this->ga_api_profileId, '2018-02-18', '2019-11-15', 'ga:users', $optParams);

                $profileInfo = $results->getProfileInfo();

                $html = <<<HTML
<pre>
Account ID               = {$profileInfo->getAccountId()}
Web Property ID          = {$profileInfo->getWebPropertyId()}
Internal Web Property ID = {$profileInfo->getInternalWebPropertyId()}
Profile ID               = {$profileInfo->getProfileId()}
Table ID                 = {$profileInfo->getTableId()}
Profile Name             = {$profileInfo->getProfileName()}
</pre>
HTML;

                return $html;
            } catch (Exception $ex) {
                $error = $ex->getMessage();
                die($error);
            }
        }
    }
}
