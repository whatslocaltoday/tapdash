

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Traffic Source Medium</li>            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Page Title</h3>
				</div>      
			</div>
            <div class="clearfix"></div>



            <div class="x_panel">
            
            <div class="col-md-6 col-sm-12 col-xs-6">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="2%" class="column-title text-center">S.NO. </th>
                            <th width="12%" class="column-title">Source Medium </th> 
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
		
		
		
		
			</div>



	 
		<div class="clearfix"></div>
        </div>
		
        <!-- /page content -->
      </div>
    </div>
	
   
