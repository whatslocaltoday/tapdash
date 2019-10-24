


<?php 
  
  ?>
       <!-- page content -->
          <div class="right_col clearfix" role="main">
        <div class="page-title">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Edit Country</a></li>
            </ol>
          </nav>
          <div><?php echo $message_display;?></div>
          <div class="title_left col-md-12">
            <h3>Country Information</h3>
          </div>
        </div>
  
              <div class="clearfix"></div>
           <div class="col-md-8 col-sm-12 col-xs-12">
       
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
              
              <form id="demo-form" method="post"  action="<?php echo base_url();?>admin/setting/edit_country" onsubmit="return(validate());">  
              
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  
              <div class="form-group">
              <label for="fullname">Country SortName<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Country SortName"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="sortname" class="form-control"  autocomplete="off" name="sortname" value="<?=$sortname?>" maxlength="3" required /><span class="error"> <?=form_error('sortname');?></span>
            </div>
            
            <div class="form-group">
              <label for="fullname">Country Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Country Name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="cuntry_name" class="form-control"  autocomplete="off" name="cuntry_name" value="<?=$cuntry_name?>" maxlength="20" required /><span class="error"> <?=form_error('cuntry_name');?></span>
            </div>


            <div class="form-group">
              <label for="fullname">Country Phonecode<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Country Phonecode"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="cuntry_phcode" class="form-control"  autocomplete="off" name="cuntry_phcode" onkeypress="return isNumberKey(event)" value="<?=$cuntry_phcode?>" maxlength="4" /><span class="error"> <?=form_error('cuntry_phcode');?></span>
            </div>
  
              <div class="admin-bar-inner">
    <button type="button" class="btn btn-info btn-sm btn-small" onclick="window.location.href='<?=base_url(); ?>dashboard';"><i class="fa fa-angle-left"></i> Back</button>
    <button class="btn btn-success btn-sm btn-small" type="submit">Submit</button>
    <!--<button id="preview" class="btn btn-success btn-sm btn-small" type="submit"><i class="fa fa-eye"></i> Preview</button>-->
  </div>
   </form>
 </div>
      </div>
      <!-- /SEO Information End -->
     </div>


     <div class="col-md-4 bg-grey">
		<div class="x_panel">
		<div class="x_content">
			<div class="showContant">
				<ul>
        <li>Please review your choices carefully and then click 'Submit'.</li>
				
				</ul>
			</div>
			<p></p>
		</div>
		</div>
		
	 </div>
        </div>
        <!-- /page content -->
         

       


<script type="text/javascript">

function validate()
{

          var r=confirm("Do you want to update this?")
          if (r==true)
            return true;
          else
            return false;
}

</script>

<script language="Javascript">

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode != 46 && charCode > 31 
     && (charCode < 48 || charCode > 57))
      return false;

   return true;
}

</script>