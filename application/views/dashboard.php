



      <?php //print_r($this->session->userdata('logged_in')); ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bgprimary">
				  <span class="count_top"><i class="fa fa-cogs" aria-hidden="true"></i> Total Views</span>
				  <div class="count"><?php if($total_view !=''){echo $total_view;} else { echo "0"; }  ?></div>
				</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bginfo">
				  <span class="count_top"><i class="fa fa-mobile"></i> Total Traffic</span>
				  <div class="count"><?php if($total_trfc !=''){echo $total_trfc;} else { echo "0"; }  ?></div>
				</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bgpink">
				  <span class="count_top"><i class="fa fa-file-text-o"></i> Total Leads</span>
				  <div class="count"><?php if($total_lead !=''){echo $total_lead;} else { echo "0"; }  ?></div>
				</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bgsuccess">
				  <span class="count_top"><i class="fa fa-file-text-o"></i>  CTR (Click Through Rate)</span>
				  <div class="count"><?php if($cTr !=''){echo $cTr;} else { echo "0"; }  ?></div>
				</div>
            </div>
          </div>
          <!-- /top tiles -->

   <!-- top tiles -->

   <?php if(!empty($globalRank)) { ?>
   <div class="row tile_count">
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bgprimary">
				  <span class="count_top"><i class="fa fa-cogs" aria-hidden="true"></i> Global Rank</span>
				  <div class="count"><?php if($globalRank !=''){ print $globalRank;} else { echo "0"; }  ?></div>
				</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bginfo">
				  <span class="count_top"><i class="fa fa-mobile"></i> Country Rank</span>
				  <div class="count"><?php if($counteryRank !=''){echo $counteryRank." ".$counteryCode; } else { echo "0"; }  ?></div>
				</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bgpink">
				  <span class="count_top"><i class="fa fa-file-text-o"></i> Unique Page View (Month)</span>
				  <div class="count"><?php  if(!empty($uniq_avg_page)){ echo $uniq_avg_page[unique_page_view][0][1]; } else { echo "Data is not available"; }  ?></div>
				</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<div class="mini-stat bgsuccess">
       
				  <span class="count_top"><i class="fa fa-file-text-o"></i> Average Time (Month)</span>
				  <div class="count"><?php if(!empty($uniq_avg_page)){ echo round($uniq_avg_page[unique_page_view][0][2], 2); } else { echo "Data is not available"; }  ?></div>
				</div>
            </div>
          </div>
          <!-- /top tiles -->
   <?php } ?>

		<div class="page-title">
			<div class="title_left col-md-12">
			  <h3>Campaign Graph</h3>
			</div>
		</div>
	  <div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div id="container" style="height: 300px;"></div>
				</div>
			</div>
		  </div>
	  </div>

    <!-- /top tiles -->

    <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Network Activities <small>Graph title sub-title</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2018 - January 28, 2019</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-9 col-xs-12">
                  <div id="chart_plot_01" class="demo-placeholder"></div>
                </div>
               

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

            <div class="row">			
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Accounts</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="table-responsive">
								<div id="datatable_wrapper" class="dataTables_wrapper form-inline">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-striped">
												<thead>
													<tr class="headings" role="row">
														<th width="40%">&nbsp;</th>
														
														<th width="20%">Traffic</th>
														<th width="20%">Conversion</th>
													</tr>
												</thead>
												<tbody>
													
                                                <?php 
                                                if(!empty($result_acc_data)){
                                                    
                                                
                                                foreach($result_acc_data as &$value_acc)
           {
                ?>
<tr style="word-break: break-word;" class="">

           <td><div  <?php if($value_acc->flag=='1'){ ?> class="dots-green" <?php } else { ?> class="dots-red" <?php } ?> ><?php echo $value_acc->pname ?> </div></td>
													
                                                    <td><?php echo $value_acc->traffic ?></td>
                                                    <td><?php echo $value_acc->lead ?></td>
                                                </tr>

           <?php } }?>

													
												</tbody>
                                                
											</table>
                                            <a href="<?php echo base_url()?>accounts/"></i>All Accounts</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Result</h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							sdsd
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
            </div>

          

          <?php 
          $grph_plan_date;
          $grph_plan_view;
          $grph_plan_traffic;
          $grph_plan_lead;
          if(!empty($result_Graphdata))
          {
             
            foreach($result_Graphdata as &$value)
            {
                $grph_plan_date[]="'".$value->plan_date."'";
                $grph_plan_view[]=$value->view;
                $grph_plan_traffic[]=$value->traffic;
                $grph_plan_lead[]=$value->lead;
            }
        
       
            $grph_plan_dateimplod= implode(",", $grph_plan_date);
            $grph_plan_viewimplod= implode(",", $grph_plan_view);
            $grph_plan_trafficimplod= implode(",", $grph_plan_traffic);
            $grph_plan_leadimplod= implode(",", $grph_plan_lead);
          }
          else
          {
            $grph_plan_dateimplod;
            $grph_plan_viewimplod;
            $grph_plan_trafficimplod;
            $grph_plan_leadimplod;
          }
           ?>
            

          </div>
        </div>
        <!-- /page content -->


        
        <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
        <script type="text/javascript">
var dom = document.getElementById("container");
var myChart = echarts.init(dom);
var app = {};
option = null;
app.title = 'test';

var colors = ['#5793f3', '#d14a61', '#675bba'];

option = {
    color: colors,

    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross'
        }
    },
    grid: {
        right: '20%'
    },
    toolbox: {
        feature: {
           
            restore: {show: true, title:'Refresh'},
            saveAsImage: {show: true, title:'Download'}
        }
    },
    legend: {
        data:['view','impression','Click']
    },
    xAxis: [
        {
            type: 'category',
            axisTick: {
                alignWithLabel: true
            },
            data: [<?php echo $grph_plan_dateimplod;?>]
        }
    ],
    yAxis: [
        {
            type: 'value',
            name: 'view',
            position: 'right',
            axisLine: {
                lineStyle: {
                    color: colors[0]
                }
            },
            axisLabel: {
                formatter: '{value}'
            }
        },
        {
            type: 'value',
            name: 'impression',
            position: 'right',
            offset: 80,
            axisLine: {
                lineStyle: {
                    color: colors[1]
                }
            },
            axisLabel: {
                formatter: '{value}'
            }
        },
        {
            type: 'value',
            name: 'Click',
            position: 'left',
            axisLine: {
                lineStyle: {
                    color: colors[2]
                }
            },
            axisLabel: {
                formatter: '{value}'
            }
        }
    ],
    series: [
        {
            name:'view',
            type:'bar',
            data:[<?php echo $grph_plan_viewimplod; ?>]
        },
        {
            name:'impression',
            type:'bar',
            yAxisIndex: 1,
            data:[<?php echo $grph_plan_trafficimplod; ?>]
        },
        {
            name:'Click',
            type:'line',
            yAxisIndex: 2,
            data:[<?php echo $grph_plan_leadimplod; ?>]
        }
    ]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
       </script>