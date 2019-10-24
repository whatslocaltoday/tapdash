

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Ranking</li>            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Ranking</h3>
				</div>      
			</div>
            <div class="clearfix"></div>
         <div class="custom-graph">
         <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#google_tab" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Google</a>
                        </li>
                        <!-- <li role="presentation" class=""><a href="#google_tab_change" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Google Changes</a>
                        </li>
                        <li role="presentation" class=""><a href="#bing_tab" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Bing</a>
                        </li>
						<li role="presentation" class=""><a href="#bing_tab_change" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Bing Changes</a>
                        </li> -->
                      </ul>
                      <div id="myTabContent" class="tab-content">
                      
												<!-- <div id="google_tab" style="height: 300px;" role="tabpanel" class="tab-pane fade active in" aria-labelledby="home-tab"></div> -->
                       <div>

                       </div>


                        <div role="tabpanel" class="tab-pane fade" id="google_tab_change" aria-labelledby="profile-tab">
                          <p>B. Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="bing_tab" aria-labelledby="profile-tab">
                          <p>C. xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
						<div role="tabpanel" class="tab-pane fade" id="bing_tab_change" aria-labelledby="profile-tab">
                          <p>D. xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
        </div>
		<div class="clearfix"></div>
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Default Example</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Keyword</th>
                          <th>Google</th>
                          <th>Google Change</th>
                          <th>Bing</th>
                          <th>Beign Change</th>
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td>61</td>
                          <td>2011/04/25</td>
                        </tr>
                        <tr>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>63</td>
                          <td>2011/07/25</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        <!-- /page content -->
      </div>
    </div>
	


	  
		<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
        <script type="text/javascript">
var dom = document.getElementById("google_tab");
var myChart = echarts.init(dom);
var app = {};
option = null;
option = {
    xAxis: {
        type: 'category',
        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        data: [120, 200, 150, 80, 70, 110, 130],
        type: 'bar'
    }]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
       </script>