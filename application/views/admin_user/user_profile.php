

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
          </ol>
        </nav>
        <div><?php if(!empty($message_display)){ echo $message_display; } ?></div>
        <div class="title_left col-md-12">
          <h3>User Information</h3>
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-8 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
      <div class="x_panel">
          <div class="x_content">
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Dashboard/update_user_profile" onsubmit="return(validate());" >
            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                      <div class="form-group">
              <label for="fullname">First Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User First name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="f_name" class="form-control"  autocomplete="off" name="f_name" value="<?=$f_name?>" required /><span class="error"> <?=form_error('f_name');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Last Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User Last  name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="l_name" class="form-control"  autocomplete="off" name="l_name" value="<?=$l_name?>"  required/><span class="error"> <?=form_error('l_name');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Email <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User Email id."><i class="fa fa-question-circle"></i></span></label>
              <input type="email" id="admin_email" class="form-control"  autocomplete="off" name="email" value="<?=$email?>" readonly required /><span class="error"> <?=form_error('email');?></span>
            </div>


            
            <div class="form-group">
            <div id="gender" class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
								  <input type="radio" name="gender" checked value="m" data-parsley-multiple="gender" class="form-control col-md-7 col-xs-12"/> &nbsp; Male &nbsp;
								</label>
								<label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
								  <input type="radio" name="gender" value="f" data-parsley-multiple="gender" class="form-control col-md-7 col-xs-12"/> Female
								</label>
                </div>
            </div>

            <div class="form-group">
            <label for="fullname">Profile Picture<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right"><i class="fa fa-question-circle"></i></span></label>
							<div class="col-md-3 col-sm-3 col-xs-12">
							  <?php if(!empty($row['u_photo'])){ ?> <img src="images/profiles/<?php echo $row['u_photo']; ?>" width="200" /> <?php } else{ echo "Upload your Photo"; } ?>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-12">
							  <input type="file" id="u_photo" name="u_photo" class="optional form-control col-md-7 col-xs-12" >
							</div>
						  </div>
              <?php 
              
              $role_id=$this->session->userdata('role_id');

              if($role_id !='1')
              {
              ?>
<hr>
<strong>
Website
</strong>
<hr>        
            <div class="form-group">
          <?php 
           foreach($data_web_sel as &$value)
           {
        
          ?>
          <div class="col-md-4"><b> <?php echo $value->website;?></b></div>  
           <?php } ?>
            </div>
            

         </div>
           <?php } ?>


         </div>
          

  

         <div class="admin-bar-inner">
      <button type="button" class="btn btn-info" onclick="window.location.href='<?=base_url(); ?>dashboard/view-user/';"><i class="fa fa-angle-left"></i> Back</button>
      <button class="btn btn-success" type="submit">Submit</button>
      <!--<button id="preview" class="btn btn-success btn-sm btn-small" type="submit"><i class="fa fa-eye"></i> Preview</button>-->
    </div>
                      </form>
                    
                    </div>
        </div>
        <!-- /SEO Information End -->
       </div>
          </div>
          <!-- /page content -->
       


