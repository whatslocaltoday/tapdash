

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">All </li>
            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Facebook Adword</h3>
				</div>
      
       
			</div>
<?php 

$user_ap=$this->session->userdata('user_ap');
?>

			<div class="row">
                <div class="col-lg-12">
                    
                </div>
            </div>

            <div class="clearfix"></div>
         <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
				  <div id="job_filter">
                    
                        <?php echo form_open('admin/Process/fb_list_plan_process', array('method'=>'post'));?>
                        <input type="hidden" name="search" id="search" value="1">
                        <div class="" >
                            <div class="col-sm-2 col-xs-12 no-paddings">
                                <div class="form-group">
																<select class="form-control"  name="proj_id">
                                        <option value="" selected readonly="" >Select Webiste</option>
                                        <?php
																					
                                            $data_web_sel =  	$this->Admintype_model->usr_my_project();
                                            foreach($data_web_sel as $data_web_assign){
              
																							?>
																							<option  value="<?php echo $data_web_assign->id;?>"> <?php echo $data_web_assign->pname." :- ".$data_web_assign->website ?></option>
																						<?php }
																						?>
                                    </select>
                                </div>
                            </div>
                         
                        
                            <div class="col-sm-3">
                                <div class="form-group">
                                <input type="date" id="from_date" name="from_date" class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
																<input type="date" id="to_date" name="to_date"  class="form-control col-md-7 col-xs-12" >
                                </div>
                            </div>
                          

                            <button type="submit" class="btn" value="" style="float: right;">Search</button>
                        </div>

                        <?php echo form_close();?>

                    </div>
                    <div class="table-responsive reduce-height">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr class="headings">                           
                            <th width="2%" class="column-title text-center">S.NO. </th>
							<th width="12%" class="column-title">Website Title </th> 
                            <th width="12%" class="column-title">Website </th> 
                            <th width="6%" class="column-title">Budget </th>                      
                            <th width="6%" class="column-title">View </th>
                            <th width="6%" class="column-title">Traffic </th>
                            <th width="6%" class="column-title">Leads </th>
                            <th width="6%" class="column-title">Cost </th>
                            <th width="6%" class="column-title">Cost/Conv. </th>
                            <th width="6%" class="column-title">Conv. Rate </th>
                            <th width="6%" class="column-title">CTR </th>
                            <th width="6%" class="column-title">Avg. CPC </th>
                            <th width="9%" class="column-title">Date </th>

                            <?php
                            $chkedit="";
                            $chkdel="";
                               $menu_option=explode(",", $user_ap);
                               if (in_array("14",$menu_option, TRUE))
                                  
                              {
                                $chkedit='1';
                              }
                              $menu_option=explode(",", $user_ap);
                               if (in_array("15",$menu_option, TRUE))
                                  
                              {
                                $chkdel='1';
                              }
                            if(  $chkedit !='' || $chkdel !='')
                            {
                            ?>
                            <th width="12%" class="column-title no-link last text-center"><span class="nobr">ACTION</span></th>
                          <?php  } ?>
                          </tr>
                        </thead>

												<tbody>
                                    <?php $count= $this->uri->segment(3,0);?>
                                    <?php
                                        $cosConv='0';
                                        $cosRate='0';
                                        $cTr='0';
                                        $avgCpc='0';
                                    $CI =& get_instance();
                                    if($all_leads) {
																			$sl='1';
                                        for ($i = 0; $i < count($all_leads); $i++) {

                                          if($all_leads[$i]->lead >0)
                                          {
                                            $cosConv=number_format($all_leads[$i]->cost/$all_leads[$i]->lead,2,'.',',');
                                          }
                                          if($all_leads[$i]->traffic >0)
                                          {
                                            $cosRate=number_format($all_leads[$i]->lead/$all_leads[$i]->traffic,2,'.',',');
                                          }
                                          if($all_leads[$i]->view >0)
                                          {
                                            $cTr=number_format($all_leads[$i]->traffic/$all_leads[$i]->view,2,'.',',');
                                          }
                                         if($all_leads[$i]->traffic >0)
                                          {
                                            $avgCpc=number_format($all_leads[$i]->cost/$all_leads[$i]->traffic,2,'.',',');
                                          }

                                          $originalDate = $all_leads[$i]->plan_date;
                                          $planDate = date("d-M-Y", strtotime($originalDate));
                                         
                                          

                                            echo "
                                            
                                        <tr class=\"gradeU\">
                                        " . form_open('admin/Process/fb_view_edit_plan_progress') . "
                                            <td hidden>".$i."</td>
                                            <td hidden> <input type=\"text\" name=\"plan_p_id\" value='" . $all_leads[$i]->id . "' ></td>
                                            <td>".$sl++."</td>
                                         
                                                <td>" . $all_leads[$i]->pname . "</td>
																						  	<td>" . $all_leads[$i]->website . "</td>
                                                <td>" .$all_leads[$i]->symbol." ". $all_leads[$i]->buget . "</td>
																								<td>" . $all_leads[$i]->view . "</td>
                                                <td>" . $all_leads[$i]->traffic . "</td>
                                                <td>" . $all_leads[$i]->lead . "</td>
                                                <td>" .$all_leads[$i]->symbol." ". $all_leads[$i]->cost . "</td>
                                                <td>" . $cosConv . "</td>
																								<td>" . $cosRate . "</td>
                                                <td>" . $cTr . "</td>
                                                <td>" . $avgCpc . "</td>
                                            
                                               <td>" . $planDate . "</td>";
                                               ?>
                                               	<?php
                                                  if(  $chkedit !='' || $chkdel !='')
                                                  {
                                              echo "
                                                <td align='center'>";
                                                ?>
                                                <?php
                                                $menu_option=explode(",", $user_ap);
                                               if (in_array("68",$menu_option, TRUE))
                                                  
                                              {
                                         
                                                echo "<button class=\"center glyphicon glyphicon-cog\" type=\"submit\" title=\"Edit\" ></button/>" ;
                                               }

                                               $menu_option=explode(",", $user_ap);
                                               if (in_array("69",$menu_option, TRUE))
                                                  
                                              {
                                                
                                                echo "<button type=\"button\" onclick=\"delete_plan_progress('" . $all_leads[$i]->id . "')\" id=\"user_status\" name=\"user_status\" class=\"center glyphicon glyphicon-remove\"  title=\"Delete Data\" ></button/>";
                                               }
                                                
                                               ?>
                                               <?php
                                                  }
                                               echo " 
                                                </td>
                                                      
                                                ".form_close()."
                                                  </tr>
                                                  
                                                  ";
                                                  
                                          }}?>
                                    </tbody>
                                </table>
                                <b>Result Showing : <?php echo $all_leads_count?></b>
                                <nav aria-label="Page navigation example" style="float: right;">
                                    <?php echo $this->pagination->create_links(); ?>
                                </nav>

                      </table>
						
                  </div>
                </div>
              </div>
        </div>


        <!-- /page content -->
		


     
      </div>
    </div>
	


			<script type="text/javascript">


document.getElementById('from_date').valueAsDate = new Date();
document.getElementById('to_date').valueAsDate = new Date();

function delete_plan_progress(userid)
{
	var r=confirm("Do you want to delete this?")
    if (r==true)
		{
			$.ajax({
				type: 'post',
				url: '<?=base_url(); ?>admin/Process/delete_plan_progress_selected',
				data: 'ajuserid='+userid,
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