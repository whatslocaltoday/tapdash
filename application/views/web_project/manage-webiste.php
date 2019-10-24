

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Manage Website</li>
            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Manage Website</h3>
				</div>
      
       
			</div>
            <div class="clearfix"></div>
         <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="table-responsive reduce-height">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="7%" class="column-title text-center">S.NO. </th>
														<th width="20%" class="column-title">Account </th> 
                            <th width="30%" class="column-title">Website Title </th>  
                            <th width="24%" class="column-title">Website URL </th>                      
                            <th width="8%" class="column-title text-center">STATUS </th>
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
														$status='';
														if($row->flag=='1')
														{
															$status="1";
														}
														else
														{
															$status="0";
														}
														
													//	$full_name=$row->f_name." ".$row->l_name;
														
													echo "
                                                
													<tr class=\"gradeU\">
													".form_open('admin/Dashboard/view_edit_proj_web')."
															<td hidden > <input type=\"text\" id=\"proj_id\" name=\"proj_id\" value='".$row->id."' ></td>
															<td>".$sl++."</td>
															<td>".$row->accountnumber."</td>
															<td>".$row->pname."</td>
															<td><a href=\"$row->website\" target=\"_blank\">".$row->website."</a></td>
															<td align='center'>
															
															<select class=\"form-control\" onchange=\"checkvalstatus($row->id,this.value)\" id=\"user_status\" name=\"user_status\">";
														?>
											

												<option value="1" <?php if($row->flag=="1") echo 'selected="selected"';  ?> >Active</option>
												<option value="0" <?php if($row->flag=="0") echo 'selected="selected"'; ?> >Inctive</option>
												

											<?php
														echo "
															</select>
															</td>";
															?>	
											<?php
											echo "
												<td align='center'>
												
												<button class=\"fa fa-cogs\" type=\"submit\" title=\"Settings\" ></button/> 
												
												
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
        </div>


        <!-- /page content -->
		


     
      </div>
    </div>
	


			<script type="text/javascript">
// function checkvalstatus(userid,statusid)
// {

// 	var r=confirm("Do you want to update this?")
//     if (r==true)
// 		{
			
// 			$.ajax({
// 				type: 'post',
// 				url: '<?=base_url(); ?>admin/Dashboard/update_project_flag',
// 				data: 'ajuserid='+userid+'&ajdevice='+statusid, // Send dataFields var
// 					success:function(data) {
									
									
// 							return true;
							
// 						}



// 				});
// 		}
// 			else
// 			{
// 				return false;
// 			}
     
      
// }
</script>