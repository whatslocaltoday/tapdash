

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
          <input type="text" name="session_total" value="<?php echo $per1.' '.$current_month0; ?>">
          <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <input type="text" name="user_total" value="<?php echo $per2.' '.$current_month01; ?>">
          <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <input type="text" name="bounce_total" value="<?php echo $per3.' '.$current_month02; ?>">
          <div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <input type="text" name="sessiondr_total" value="<?php echo $per4.' '.$current_month03; ?>">
				</div>
			</div>



   
      
		<div class="clearfix"></div>
        </div>
		
        <!-- /page content -->
      </div>
    </div>
	
   

	  
    <script src="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript">

Highcharts.chart('container', {

title: {
    text: 'Session '
},


xAxis: {
        categories: [
          <?php
            
            for ($j=29; $j >=0; $j--)
            {
              echo '"'.date("y-M-d", strtotime('-'. $j .' days')).'",';
            }
            
            ?>

        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Session'
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
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},



series: [{
    name: 'Before',
    data: [
          <?php

          if(!empty($old_month))
          {
            for ($j=59; $j >=30; $j--)
            {
              echo $old_month[$j].',';
            }
          }
           
            
            ?>
        ]
}, {
    name: 'Current',
    data: [<?php

if(!empty($current_month))
{
  for ($j=29; $j >=0; $j--)
  {
    echo $current_month[$j].',';
  }
}
 
  
  ?>]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});



Highcharts.chart('container1', {

title: {
    text: 'User'
},


xAxis: {
        categories: [
          <?php
            
            for ($j=29; $j >=0; $j--)
            {
              echo '"'.date("y-M-d", strtotime('-'. $j .' days')).'",';
            }
            
            ?>

        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total User'
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
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},



series: [{
    name: 'Before',
    data: [
          <?php

          if(!empty($old_month1))
          {
            for ($j=59; $j >=30; $j--)
            {
              echo $old_month1[$j].',';
            }
          }
           
            
            ?>
        ]
}, {
    name: 'Current',
    data: [<?php

if(!empty($current_month1))
{
  for ($j=29; $j >=0; $j--)
  {
    echo $current_month1[$j].',';
  }
}
 
  
  ?>]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});



Highcharts.chart('container2', {

title: {
    text: 'Bounce Rate'
},


xAxis: {
        categories: [
          <?php
            
            for ($j=29; $j >=0; $j--)
            {
              echo '"'.date("y-M-d", strtotime('-'. $j .' days')).'",';
            }
            
            ?>

        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total bounce rate'
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
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},



series: [{
    name: 'Before',
    data: [
          <?php

          if(!empty($old_month2))
          {
            for ($j=59; $j >=30; $j--)
            {
              echo $old_month2[$j].',';
            }
          }
           
            
            ?>
        ]
}, {
    name: 'Current',
    data: [<?php

if(!empty($current_month2))
{
  for ($j=29; $j >=0; $j--)
  {
    echo $current_month2[$j].',';
  }
}
 
  
  ?>]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});








Highcharts.chart('container3', {

title: {
    text: 'Session Duration'
},


xAxis: {
        categories: [
          <?php
            
            for ($j=29; $j >=0; $j--)
            {
              echo '"'.date("y-M-d", strtotime('-'. $j .' days')).'",';
            }
            
            ?>

        ]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Session Duration'
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
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},



series: [{
    name: 'Before',
    data: [
          <?php

          if(!empty($old_month3))
          {
            for ($j=59; $j >=30; $j--)
            {
              echo $old_month3[$j].',';
            }
          }
           
            
            ?>
        ]
}, {
    name: 'Current',
    data: [<?php

if(!empty($current_month3))
{
  for ($j=29; $j >=0; $j--)
  {
    echo $current_month3[$j].',';
  }
}
 
  
  ?>]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});






       </script>