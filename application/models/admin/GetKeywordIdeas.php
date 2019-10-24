<?php

require __DIR__ . '/vendor/autoload.php';
use Google\AdsApi\AdWords\AdWordsServices;
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\v201809\cm\Language;
use Google\AdsApi\AdWords\v201809\cm\Location;
use Google\AdsApi\AdWords\v201809\cm\NetworkSetting;
use Google\AdsApi\AdWords\v201809\cm\Paging;
use Google\AdsApi\AdWords\v201809\o\AttributeType;
use Google\AdsApi\AdWords\v201809\o\IdeaType;
use Google\AdsApi\AdWords\v201809\o\LanguageSearchParameter;
use Google\AdsApi\AdWords\v201809\o\LocationSearchParameter;
use Google\AdsApi\AdWords\v201809\o\NetworkSearchParameter;
use Google\AdsApi\AdWords\v201809\o\RelatedToQuerySearchParameter;
use Google\AdsApi\AdWords\v201809\o\RequestType;
use Google\AdsApi\AdWords\v201809\o\SeedAdGroupIdSearchParameter;
use Google\AdsApi\AdWords\v201809\o\TargetingIdeaSelector;
use Google\AdsApi\AdWords\v201809\o\TargetingIdeaService;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Common\Util\MapEntries;
/**
 * This example gets keyword ideas related to a seed keyword.
 */
class GetKeywordIdeas extends CI_Model
{
    // If you do not want to use an existing ad group to seed your request, you
    // can set this to null.
    const AD_GROUP_ID = '';
    const PAGE_LIMIT = 30;

    public  function get_idea_with_keyword($kewword_input,$website_input)
    {
        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();

        $session = (new AdWordsSessionBuilder())->fromFile()->withOAuth2Credential($oAuth2Credential)->build();

        if($kewword_input !='')
        {
            try
            {
                $key_word_data = self::get_idea_with_keyword_inner($kewword_input,$website_input,new AdWordsServices(), $session);
                return $key_word_data;
            }
            catch(Exception $e) {
                //echo 'Message: ' .$e->getMessage();
               // die;
               return false;
              }
            
  
              
         
               // cretae_new_account();
        }
    }






    public static function get_idea_with_keyword_inner(
        $kewword_input,
        $website_input,
        AdWordsServices $adWordsServices,
        AdWordsSession $session
    ) {
        $targetingIdeaService = $adWordsServices->get($session, TargetingIdeaService::class);
        // Create selector.
        $selector = new TargetingIdeaSelector();
        $selector->setRequestType(RequestType::IDEAS);
        $selector->setIdeaType(IdeaType::KEYWORD); 
      //  $selector->setIdeaType(IdeaType::LOCATION); 
        if (!empty($website_input)) 
        {
        $selector->EXTRACTED_FROM_WEBPAGE=$website_input;
        
        }
        
        $selector->setRequestedAttributeTypes(
            [
                AttributeType::KEYWORD_TEXT,
                AttributeType::SEARCH_VOLUME,
                AttributeType::AVERAGE_CPC,
                AttributeType::COMPETITION,
                AttributeType::CATEGORY_PRODUCTS_AND_SERVICES
            ]
        );
        $paging = new Paging();
        $paging->setStartIndex(0);
        $paging->setNumberResults(10);
        $selector->setPaging($paging);
        $searchParameters = [];
        // Create related to query search parameter.
        $relatedToQuerySearchParameter = new RelatedToQuerySearchParameter();
        $relatedToQuerySearchParameter->setQueries(
            [
                "'".$kewword_input."'",
            ]
        );
        $searchParameters[] = $relatedToQuerySearchParameter;
        // Create language search parameter (optional).
        // The ID can be found in the documentation:
        // https://developers.google.com/adwords/api/docs/appendix/languagecodes
        $languageParameter = new LanguageSearchParameter();
        $english = new Language();
        $english->setId(1000);
        $languageParameter->setLanguages([$english]);
        $searchParameters[] = $languageParameter;

//Add location search parameter

        $locationParameter  = new LocationSearchParameter();
        $india = new Location();
        $india ->setId(20456);
        $locationParameter->setLocations([$india ]);
        $searchParameters[] = $locationParameter;



        // Create network search parameter (optional).
        $networkSetting = new NetworkSetting();
        $networkSetting->setTargetGoogleSearch(true);
        $networkSetting->setTargetSearchNetwork(false);
        $networkSetting->setTargetContentNetwork(false);
        $networkSetting->setTargetPartnerSearchNetwork(false);
        $networkSearchParameter = new NetworkSearchParameter();
        $networkSearchParameter->setNetworkSetting($networkSetting);
        $searchParameters[] = $networkSearchParameter;
        // Optional: Use an existing ad group to generate ideas.
        if (!empty($adGroupId)) {
            $seedAdGroupIdSearchParameter = new SeedAdGroupIdSearchParameter();
            $seedAdGroupIdSearchParameter->setAdGroupId($adGroupId);
            $searchParameters[] = $seedAdGroupIdSearchParameter;
        }
        $selector->setSearchParameters($searchParameters);
        $selector->setPaging(new Paging(0, self::PAGE_LIMIT));
        // Get keyword ideas.
        $page = $targetingIdeaService->get($selector);
        // Print out some information for each targeting idea.
        $entries = $page->getEntries();
        if ($entries !== null) {
          
            foreach ($entries as $targetingIdea) {
                $data = MapEntries::toAssociativeArray($targetingIdea->getData());
                $keyword = $data[AttributeType::KEYWORD_TEXT]->getValue();
                $searchVolume = ($data[AttributeType::SEARCH_VOLUME]->getValue() !== null)
                    ? $data[AttributeType::SEARCH_VOLUME]->getValue() : 0;
                $averageCpc = $data[AttributeType::AVERAGE_CPC]->getValue();
                $competition = $data[AttributeType::COMPETITION]->getValue();
                $categoryIds = ($data[AttributeType::CATEGORY_PRODUCTS_AND_SERVICES]->getValue() === null)
                    ? $categoryIds = ''
                    : implode(
                        ', ',
                        $data[AttributeType::CATEGORY_PRODUCTS_AND_SERVICES]->getValue()
                    );
                    $keywordData[]=array(
                        $keyword,
                        $searchVolume,
                        ($averageCpc === null) ? 0 : $averageCpc->getMicroAmount(),
                        $competition
                    );


            }
            return $keywordData;
        }
        if (empty($entries)) {
            print "No related keywords were found.\n";
        }
    }
   

  
}
