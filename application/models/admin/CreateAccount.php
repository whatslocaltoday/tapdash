<?php
/**
 * Copyright 2017 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

//namespace Google\AdsApi\AdWords\v201809\AccountManagement;

require __DIR__ . '/vendor/autoload.php';

use Google\AdsApi\AdWords\AdWordsServices;
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\v201809\cm\Operator;
use Google\AdsApi\AdWords\v201809\mcm\ManagedCustomer;
use Google\AdsApi\AdWords\v201809\mcm\ManagedCustomerOperation;
use Google\AdsApi\AdWords\v201809\mcm\ManagedCustomerService;
use Google\AdsApi\Common\OAuth2TokenBuilder;

/**
 * This example creates a new account under an AdWords manager account. Note:
 * this example must be run using the credentials of an AdWords manager account,
 * and by default the new account will only be accessible via the parent AdWords
 * manager account.
 */
class CreateAccount extends CI_Model 
{

    
    public  function cretae_new_accountmain($acc_name,$currency_code,$zone_name)
    {
        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();

        // Construct an API session configured from a properties file and the
        // OAuth2 credentials above.
        // You can use withClientCustomerId() of AdWordsSessionBuilder to specify
        // your manager account ID under which you want to create an account.
        $session = (new AdWordsSessionBuilder())->fromFile()->withOAuth2Credential($oAuth2Credential)->build();
       
        if($acc_name !='')
        {
            $a_new_acc_id = self::cretae_new_account($acc_name,$currency_code,$zone_name,new AdWordsServices(), $session);
        
          return $a_new_acc_id;
               // cretae_new_account();
        }
    }
    public static function cretae_new_account(
        $acc_name,
        $currency_code,
        $zone_name,
        AdWordsServices $adWordsServices,
        AdWordsSession $session
    ) {
        $managedCustomerService = $adWordsServices->get(
            $session,
            ManagedCustomerService::class
        );

        // Create a managed customer.
    
        $customer = new ManagedCustomer();
        $customer->setName($acc_name);
        $customer->setCurrencyCode($currency_code);
        $customer->setDateTimeZone($zone_name);

        // Create a managed customer operation and add it to the list.
        $operations = [];
        $operation = new ManagedCustomerOperation();
        $operation->setOperator(Operator::ADD);
        $operation->setOperand($customer);

        $operations[] = $operation;
        // Create a managed customer on the server and print out some info
        // about it.
        $customer = $managedCustomerService->mutate($operations)->getValue()[0];
     
        $data=$customer->getCustomerId();
     
    return $data;
    }

}

//CreateAccount::main();
