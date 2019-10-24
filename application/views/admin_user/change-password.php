

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Password</a></li>
          </ol>
        </nav>
        <div><?php echo $message_display;?></div>
        <div class="title_left col-md-12">
          <h3>User Password</h3>
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-8 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
      <div class="x_panel">
          <div class="x_content">
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Dashboard/update_user_password" onsubmit="return(validate());" >
            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
                      <div class="form-group">
              <label for="fullname">Old Password<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User Current Password"><i class="fa fa-question-circle"></i></span></label>
              <input type="password" id="old_pass" class="form-control"  autocomplete="off" name="old_pass"  required /><span class="error"> <?=form_error('old_pass');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">New Password<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="New Password"><i class="fa fa-question-circle"></i></span></label>
              <input type="password" id="new_pass" class="form-control"  autocomplete="off" name="new_pass" onkeyup="validate_passold();"  required/><span class="error"> <?=form_error('new_pass');?></span>
            </div>
            <b class="captcha_error2 text-danger"></b>
            <div class="form-group">
              <label for="fullname">Confirm Password <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="New Password."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="con_pass" class="form-control"  autocomplete="off" name="con_pass" onkeyup="validate_pass();" required /><span class="error"> <?=form_error('con_pass');?></span>
            </div>
            <b class="captcha_error1 text-danger"></b>


         </div>
          

  

         <div class="admin-bar-inner">
      <button type="button" class="btn btn-info " onclick="window.location.href='<?=base_url(); ?>dashboard/view-user/';"><i class="fa fa-angle-left"></i> Back</button>
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
       

          <script type="text/javascript">
 
    function validate_pass(){
      
        var password = $("#new_pass").val();
            var confirmPassword = $("#con_pass").val();
          
         if(password != confirmPassword)
        {
            $('.captcha_error1').html('* Passwords do not match!');
        }
        else
        {
          $('.captcha_error1').html('');
        }
        
    }


    function validate_passold(){
      
      var password = $("#new_pass").val();
          var old_pass = $("#old_pass").val();
        
       if(password == old_pass)
      {
          $('.captcha_error2').html('* Passwords same as current');
      }
      else
      {
        $('.captcha_error2').html('');
      }
      
  }
   
</script>