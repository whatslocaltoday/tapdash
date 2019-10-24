

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Manage Permission</li>
            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Manage Permission</h3>
				</div>
      
       
			</div>
            <div class="clearfix"></div>
         <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                   
										<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr class="headings">                           
                            <th width="7%" class="column-title text-center">S.NO. </th>
                            <th width="30%" class="column-title">Permission Name </th>  
                            <th width="20%" class="column-title no-link last text-center"><span class="nobr">ACTION</span></th>
                           
                          </tr>
                        </thead>

                        <tbody>
													<?php 
													
												
													//echo '<option value="'.$value.'" '.(($value=='United States')?'selected="selected"':"").'>'.$value.'</option>';
														 $sl='1';
														 $full_name="";
														
														 if (!empty($results)) 
															{
                        	foreach($results as $row) {
													
												
														
													echo "
                                                
													<tr class=\"gradeU\">
													".form_open('admin/Setting/view_edit_permission')."
															<td hidden > <input type=\"text\" id=\"permsn_id\" name=\"permsn_id\" value='".$row->id."' ></td>
															<td align=\"center\">".$sl++."</td>
															<td>".$row->name."</td>
																
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
	


			<script type="text/javascript">
function checkvalstatus(userid,statusid)
{

	var r=confirm("Do you want to update this?")
    if (r==true)
		{
			
			$.ajax({
				type: 'post',
				url: '<?=base_url(); ?>admin/Dashboard/update_user_flag',
				data: 'ajuserid='+userid+'&ajdevice='+statusid, // Send dataFields var
					success:function(data) {
									
									
							return true;
							
						}



				});
		}
			else
			{
				return false;
			}
     
      
}
</script>