

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Manage Country</li>
            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Manage Country</h3>
				</div>
      
       
			</div>
            <div class="clearfix"></div>
         <div class="col-md-12 col-sm-12 col-xs-12">
		 
		   <!-- /use For Flash Data -->
      <?php

          $success_message = $this->session->flashdata('success_message');

          ?>

          <?php

          $error_message = $this->session->flashdata('error_message');

          ?>

          <?php
          if (isset($success_message)) {

              echo " <div class=\"alert alert-success alert-square alert-dismissable\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"><i class=\"fa fa-times\"></i></button>
          <strong>Success!</strong> $success_message
          </div>";
          }

          unset($_SESSION['success_message']);
          ?>


          <?php
          if (isset($error_message)) {

              echo " <div class=\"alert alert-danger alert-square alert-dismissable\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"><i class=\"fa fa-times\"></i></button>
          <strong>Warning!</strong> $error_message
          </div>";
          }
          unset($_SESSION['error_message']);
          ?>

 <!-- /end Flash Data -->
		 
                <div class="x_panel">
                  <div class="x_content">
                   
										<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr class="headings">                           
                            <th width="7%" class="column-title text-center">S.NO. </th>
														<th width="30%" class="column-title">Country Sortname </th>  
                            <th width="30%" class="column-title">Country Name </th>
														<th width="30%" class="column-title">Country Phonecode </th>   
                            <th width="20%" class="column-title no-link last text-center"><span class="nobr">ACTION</span></th>
                           
                          </tr>
                        </thead>

                        <tbody>
													<?php 
													
												
									
														 $sl='1';
														 $full_name="";
														
														 if (!empty($results)) 
															{
                        	foreach($results as $row) {
													
												
														
													echo "
                                                
													<tr class=\"gradeU\">
													".form_open('admin/Setting/view_edit_country')."
															<td hidden > <input type=\"text\" id=\"countery_id\" name=\"countery_id\" value='".$row->id."' ></td>
															<td align=\"center\">".$sl++."</td>
															<td>".$row->sortname."</td>
															<td>".$row->name."</td>
															<td>".$row->phonecode."</td>
															<td align='center'>
															<button class=\"glyphicon glyphicon-cog\" type=\"submit\" title=\"Edit\" ></button/> 
															</td>
															
												 ".form_close()."
													</tr>
													
													";
													
													}}?>

                          
                        </tbody>
 </table>
                                <b>Result Showing : <?php echo $all_count?></b>
                                <nav aria-label="Page navigation example" style="float: right;">
                                    <?php echo $this->pagination->create_links(); ?>
                                </nav>
                   
						
                  </div>
                </div>
             
        </div>


        <!-- /page content -->
		


     
      </div>
    </div>
	


		