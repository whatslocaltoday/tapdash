

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Facebook Edit Plan Process</a></li>
          </ol>
        </nav>
        
        <div class="title_left col-md-12">
          <h3>Plan Process</h3>
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-8 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
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
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Process/fb_edit_plan_progress">
            <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
            <div class="form-group">
              <label for="fullname">Webiste<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Webiste Tilte"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="<?=$data_web_sel?>" class="form-control" name="web_id" readonly value="<?=$website_title." :- ".$website_url ?>"  autocomplete="off"/><span class="error"></span>
            </div>


            <div class="form-group">
              <label for="fullname">Daily Budget<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Daily Budget"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="daily_budget" class="form-control" name="daily_budget" onkeypress="return isNumberKey(event)" value="<?=$daily_budget?>" minlengh="1" maxlength="6"  autocomplete="off"/><span class="error"> <?=form_error('daily_budget');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Cost <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Daily Cost."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="plan_cost" class="form-control" name="plan_cost" value="<?=$plan_cost?>" onkeypress="return isNumberKey(event)" minlengh="1" maxlength="6" autocomplete="off"/><span class="error"> <?=form_error('plan_cost');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">View<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Daily View."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="plan_view" class="form-control" name="plan_view" value="<?=$plan_view?>" required onkeypress="return isNumberKey(event)" minlengh="1" maxlength="6" autocomplete="off"/><span class="error"> <?=form_error('plan_view');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Traffic<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Daily Traffic."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="plan_trafic" class="form-control" name="plan_trafic" value="<?=$plan_trafic?>" required onkeypress="return isNumberKey(event)" minlengh="1" maxlength="6" autocomplete="off"/><span class="error"> <?=form_error('plan_trafic');?></span>
            </div>


            <div class="form-group">
              <label for="fullname">Lead<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Daily Lead."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="plan_lead" class="form-control" name="plan_lead" value="<?=$plan_lead?>" required onkeypress="return isNumberKey(event)" minlengh="1" maxlength="6" autocomplete="off"/><span class="error"> <?=form_error('plan_lead');?></span>
            </div>

            <div class="form-group clearfix">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date<span class="required">*</span>	</label>
						
							  <input type="date" id="date" name="date" value="<?=$date?>" required="required" class="form-control col-md-7 col-xs-12" >
						</div>
		

             <div class="admin-bar-inner">
    <button type="button" class="btn btn-info btn-sm btn-small" onclick="window.location.href='<?=base_url(); ?>dashboard';"><i class="fa fa-angle-left"></i> Back</button>
    <button class="btn btn-success btn-sm btn-small" type="submit">Submit</button>

  </div>
                    </form>
                  </div>
      </div>
      <!-- /SEO Information End -->
     </div>
	 <div class="col-md-4 bg-grey">
	
		
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


function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
</script>

