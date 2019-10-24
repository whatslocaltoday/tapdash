<?php

require_once realpath(__DIR__ . '/vendor_seostats/autoload.php');
use \SEOstats\Services\Alexa as Alexa;
try {
    $url = 'http://tapouts.online/';
    // Create a new SEOstats instance.
    $seostats = new \SEOstats\SEOstats;
    // Bind the URL to the current SEOstats instance.
    if ($seostats->setUrl($url)) {
        echo "Alexa metrics for " . $url . PHP_EOL;
        // Get the global Alexa Traffic Rank (last 3 months).
        echo "Global Rank:      " .
            Alexa::getGlobalRank() . PHP_EOL;
        // Get the country-specific Alexa Traffic Rank.
        echo "Country Rank:     ";
        $countryRank = Alexa::getCountryRank();
        if (is_array($countryRank)) {
            echo $countryRank['rank'] . ' (in ' .
                 $countryRank['country'] . ")" . PHP_EOL;
        }
        else {
            echo "{$countryRank}\r\n";
        }
        // Get Alexa's backlink count for the given domain.
        echo "Total Backlinks:  " .
            Alexa::getBacklinkCount() . PHP_EOL;
        // Get Alexa's page load time info for the given domain.
        echo "Page load time:   " .
            Alexa::getPageLoadTime() . PHP_EOL;
    }
}
catch (\Exception $e) {
    echo 'Caught SEOstatsException: ' .  $e->getMessage();
}


// try {
//     $url = 'http://google.co.in';
//     // Create a new SEOstats instance.
//     $seostats = new \SEOstats\SEOstats;
//     // Bind the URL to the current SEOstats instance.
//     if ($seostats->setUrl($url)) {
//         /**
//          *  Print HTML code for the 'daily traffic trend'-graph.
//          */
//         echo Alexa::getTrafficGraph(1);
//         /**
//          *  Print HTML code for the 'daily pageviews (percent)'-graph.
//          */
//         echo Alexa::getTrafficGraph(2);
//         /**
//          *  Print HTML code for the 'daily pageviews per user'-graph.
//          */
//         echo Alexa::getTrafficGraph(3);
//         /**
//          *  Print HTML code for the 'time on site (in minutes)'-graph.
//          */
//         echo Alexa::getTrafficGraph(4);
//         /**
//          *  Print HTML code for the 'bounce rate (percent)'-graph.
//          */
//         echo Alexa::getTrafficGraph(5);
//         /**
//          *  Print HTML code for the 'search visits'-graph, using
//          *  specific graph dimensions of 320*240 px.
//          */
//         echo Alexa::getTrafficGraph(6, false, 320, 240);
//     }
// }
// catch (\Exception $e) {
//     echo 'Caught SEOstatsException: ' .  $e->getMessage();
// }