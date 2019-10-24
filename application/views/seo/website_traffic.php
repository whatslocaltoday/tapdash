

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Website traffic</li>            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Traffic</h3>
				</div>      
			</div>
            <div class="clearfix"></div>
         <div class="custom-graph">
         <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <div id="paichart_avg_session" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>



      <div class="x_panel">
				<div class="x_content">
  
          <div id="paichart_device_catg" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>

      
<?php if(!empty($resultError)) {
  echo "no permission";

  die;
}?>
            <div class="x_panel">
            
            <div class="col-md-6 col-sm-12 col-xs-6">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="2%" class="column-title text-center">S.NO. </th>
                            <th width="12%" class="column-title">Source </th> 
                            <th width="6%" class="column-title">Visiter </th>   

                           
                          </tr>
                        </thead>


                    <?php if(!empty($getReferrers))
                    {

                        $sl="1";
                    
                        foreach($getReferrers as &$value)
                        {
                        
                    ?>
                        <tr>
                            <td>
                            <?php echo $sl++; ?>
                            </td>
                            <td>
                            <?php echo $value[0]; ?>
                            </td>
                            <td>
                            <?php echo $value[1]; ?>
                            </td>
                        </tr>
                <?php }} ?>
												<tbody>
                                   
                                    </tbody>
                                </table>
                               

                      </table>
						
                  </div>
                </div>
              </div>
        </div>
		
		
		<div class="col-md-6 col-sm-12 col-xs-6">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="2%" class="column-title text-center">S.NO. </th>
                            <th width="12%" class="column-title">Browser </th> 
                            <th width="6%" class="column-title">Visiter </th>   

                           
                          </tr>
                        </thead>


                    <?php if(!empty($getBrowsers))

                    {

                        $sl="1";
                    
                        foreach($getBrowsers as &$value1)
                        {
                        
                    ?>
                        <tr>
                            <td>
                            <?php echo $sl++; ?>
                            </td>
                            <td>
                            <?php echo $value1[0]; ?>
                            </td>
                            <td>
                            <?php echo $value1[1]; ?>
                            </td>
                        </tr>
                <?php }} ?>
												<tbody>
                                   
                                    </tbody>
                                </table>
                               

                      </table>
						
                  </div>
                </div>
              </div>
        </div>
		
		
			</div>





            <div class="x_panel">
            
            <div class="col-md-6 col-sm-12 col-xs-6">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="2%" class="column-title text-center">S.NO. </th>
                            <th width="12%" class="column-title">Page Title </th> 
                            <th width="6%" class="column-title">Visiter </th>   

                           
                          </tr>
                        </thead>


                    <?php if(!empty($web_pageTitle))

                    {

                        $sl="1";
                    
                        foreach($web_pageTitle as &$value5)
                        {
                        
                    ?>
                        <tr>
                            <td>
                            <?php echo $sl++; ?>
                            </td>
                            <td>
                            <?php echo $value5[0]; ?>
                            </td>
                            <td>
                            <?php echo $value5[1]; ?>
                            </td>
                        </tr>
                <?php }} ?>
												<tbody>
                                   
                                    </tbody>
                                </table>
                               

                      </table>
						
                  </div>
                </div>
              </div>
        </div>
		
		
		<div class="col-md-6 col-sm-12 col-xs-6">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="2%" class="column-title text-center">S.NO. </th>
                            <th width="12%" class="column-title">Search keyword </th> 
                            <th width="6%" class="column-title">Visiter </th>   

                           
                          </tr>
                        </thead>


                    <?php if(!empty($getSearchWords))

                    {

                        $sl="1";
                    
                        foreach($getSearchWords as &$value1)
                        {
                        
                    ?>
                        <tr>
                            <td>
                            <?php echo $sl++; ?>
                            </td>
                            <td>
                            <?php echo $value1[0]; ?>
                            </td>
                            <td>
                            <?php echo $value1[1]; ?>
                            </td>
                        </tr>
                <?php }} ?>
												<tbody>
                                   
                                    </tbody>
                                </table>
                               

                      </table>
						
                  </div>
                </div>
              </div>
        </div>
		
		
			</div>






		  </div>
          <?php if(!empty($unique_page_view)){ echo $unique_page_view[0][1]; } else { echo "Data is not available"; }?>
          <?php if(!empty($unique_page_view)){ echo $unique_page_view[0][2]; } else { echo "Data is not available"; }?>

      

          <?php $getuserType[1][1]; ?>
          <!-- <?php if(!empty($getReferrers)){ print_r($getReferrers); } else { echo "Data is not available"; }?> -->
	  </div>
        </div>
		<div class="clearfix"></div>
        </div>
		
        <!-- /page content -->
      </div>
    </div>
	
   

	  
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total Visit'
    },
    xAxis: {
        categories: [
          <?php
            $first=strtotime('First day this month');
            for ($j=5; $j >=0; $j--)
            {
              echo '"'.date("m/Y", strtotime(" -$j month", $first)).'",';
            }
            
            ?>

        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Visit By Month'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    series: [{
        name: 'Organic Visits',
        data: [
          <?php

          if(!empty($organic))
          {
            for ($j=5; $j >=0; $j--)
            {
              echo $organic[$j].',';
            }
          }
           
            
            ?>
        ]
    }, {
        name: 'Non-Organic Visits',
        data: [

          <?php
          if(!empty($nonorganic))
          {
            for ($j=5; $j >=0; $j--)
            {
              echo $nonorganic[$j].',';
            }
          }
            
            ?>
        ]
    }]
});






//avarge session

Highcharts.chart('paichart_avg_session', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'User Type'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },

    <?php
        $returnVistr="0";
        $newVistr="0";
          if(!empty($getuserType)){
            if(!empty($getuserType[1][1])){
            $returnVistr=$getuserType[1][1];
            }

            if(!empty($getuserType[0][1])){
              $newVistr=$getuserType[0][1];
              }
          }
          
        ?>
    series: [{
        name: 'User',
        colorByPoint: true,
        data: [{
            name: 'New Visitor',
            y: <?php echo $newVistr; ?>,
            sliced: true,
            selected: true
        }, {
            name: 'Returning Visitor',
            y: <?php echo $returnVistr; ?>
        }]
    }]
});



Highcharts.chart('paichart_device_catg', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Sessions by device'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },

    <?php
        $mobIle="0";
        $tabLet="0";
        $deskTop="0";
          if(!empty($deviceCategory)){
            if(!empty($deviceCategory[1][1])){
            $mobIle=$deviceCategory[1][1];
            }

            if(!empty($deviceCategory[2][1])){
              $tabLet=$deviceCategory[2][1];
              }
            if(!empty($deviceCategory[0][1])){
              $deskTop=$deviceCategory[0][1];
              }
          }
          
        ?>
    series: [{
        name: 'User',
        colorByPoint: true,
        data: [{
            name: 'Mobile',
            y: <?php echo $mobIle; ?>,
            sliced: true,
            selected: true
        }, {
            name: 'Tablet',
            y: <?php echo $tabLet; ?>
        }, {
            name: 'Desktop',
            y: <?php echo $deskTop; ?>
        }]
    }]
});

       </script>