



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


	
    <!-- /top tiles -->

    <div id="first_div_graph"  class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-3">
                    <h3>All Channel</h3>
                  </div>
                  <div class="col-md-3">


                    <h5>
<?php 
$cookie_Value_Fst_drP_iT= $this->input->cookie('_dash_f_0047drp_itm',true);

?>
                    <div class="selct_drop ">
                      <select id="firTdropDown" onchange="firTdropDownfunction()" class="col-sm-3">
                      <option value="View">View</option>
                      <option value="Impression">Impression</option>
                      <option value="Conversion">Conversion</option>
                      <option value="Cost">Cost</option>
                      <option value="Cost/Conv.">Cost/Conv.</option>
                      <option value="Conv. Rate">Conv. Rate</option>
                      <option value="CTR">CTR</option>
                      <option value="Avg. CPC">Avg. CPC </option>
                      </select> 
                   </div>
                   <div class="selct_drop ">
                      <select id="seconDdropDown" onchange="seconDdropDownfunction()" class="col-sm-3">
                      <option value="Impression">Impression</option>
                      <option value="View">View</option>
                      <option value="Conversion">Conversion</option>
                      <option value="Cost">Cost</option>
                      <option value="Cost/Conv.">Cost/Conv.</option>
                      <option value="Conv. Rate">Conv. Rate</option>
                      <option value="CTR">CTR</option>
                      <option value="Avg. CPC">Avg. CPC </option>
                      </select> 
                   </div>

                   <div class="selct_drop ">
                      <select id="thirDdropDown" onchange="thirDdropDownfunction()" class="col-sm-3">
                      <option value="Conversion">Conversion</option>
                      <option value="View">View</option>
                      <option value="Impression">Impression</option>
                      <option value="Cost">Cost</option>
                      <option value="Cost/Conv.">Cost/Conv.</option>
                      <option value="Conv. Rate">Conv. Rate</option>
                      <option value="CTR">CTR</option>
                      <option value="Avg. CPC">Avg. CPC </option>
                      </select> 
                   </div>

                    </h5>




                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right tapoutdate" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span></span> <b class="caret"></b>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-9 col-xs-12">
                <div id="container_homegraphmain" style="height: 350%"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br />

		  <div id="second_div_graph" style="display: none;" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Google Activities</h3>
                  </div>
                </div>
                <div class="col-md-12 col-sm-9 col-xs-12">
                <div id="container_homegraphmain_Google" style="height: 350%"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <br/>


          <div id="third_div_graph" style="display: none;" class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Facebbok Activities</h3>
                  </div>
                </div>
                <div class="col-md-12 col-sm-9 col-xs-12">
                <div id="container_homegraphmain_Facebook" style="height: 350%"></div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          
            

          </div>
        </div>
        <!-- /page content -->


        
