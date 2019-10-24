<?php
/**
 * SEOstats Example - Get Alexa Traffic Metrics' Graphs
 *
 * @package    SEOstats
 * @author     Stephan Schmitz <eyecatchup@gmail.com>
 * @copyright  Copyright (c) 2010 - present Stephan Schmitz
 * @license    http://eyecatchup.mit-license.org/  MIT License
 * @updated    2013/12/04
 */

//require_once realpath(__DIR__ . '/vendor_seostats/bootstrap.php');
require_once realpath(__DIR__ . '/vendor_seostats/autoload.php');
use \SEOstats\Services\Alexa as Alexa;

try {
   $url = $_SESSION['projWebiste_sesn'];
  // print $url = "https://facebook.com";
    // Create a new SEOstats instance.
    $seostats = new \SEOstats\SEOstats;
      $graph1="0";
      $graph2="0";
      $graph3="0";
      $graph4="0";
      $graph5="0";
      $graph6="0";
    // Bind the URL to the current SEOstats instance.
    if ($seostats->setUrl($url)) {
        /**
         *  Print HTML code for the 'daily traffic trend'-graph.
         */
        //echo Alexa::getTrafficGraph(1);
        $graph1=Alexa::getTrafficGraph(1);
        /**
         *  Print HTML code for the 'daily pageviews (percent)'-graph.
         */
        //echo Alexa::getTrafficGraph(2);
        $graph2=Alexa::getTrafficGraph(2);
        /**
         *  Print HTML code for the 'daily pageviews per user'-graph.
         */
        //echo Alexa::getTrafficGraph(3);
        $graph3=Alexa::getTrafficGraph(3);
        /**
         *  Print HTML code for the 'time on site (in minutes)'-graph.
         */
       // echo Alexa::getTrafficGraph(4);
       $graph4=Alexa::getTrafficGraph(4);
        /**
         *  Print HTML code for the 'bounce rate (percent)'-graph.
         */
        //echo Alexa::getTrafficGraph(5);
        $graph5=Alexa::getTrafficGraph(5);
        /**
         *  Print HTML code for the 'search visits'-graph, using
         *  specific graph dimensions of 320*240 px.
         */
       // echo Alexa::getTrafficGraph(6, false, 320, 240);
       $graph6=Alexa::getTrafficGraph(6);
    }
}
catch (\Exception $e) {
   // echo 'Caught SEOstatsException: ' .  $e->getMessage();
}
?>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
        <h3>Alexa Graph</h3>
        </div>

        <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
           
        </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Daily traffic trend</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php echo $graph1; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Daily pageviews (percent)</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php echo $graph2; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Daily pageviews per user</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php echo $graph3; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Time on site (in minutes)</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php echo $graph4; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Bounce rate (percent)</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php echo $graph5; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Search visits-graph</h2>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <?php echo $graph6; ?>
            </div>
        </div>
    </div>

              

    </div>


</div>