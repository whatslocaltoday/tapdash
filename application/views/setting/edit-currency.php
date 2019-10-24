


<?php 
  
  ?>
       <!-- page content -->
          <div class="right_col clearfix" role="main">
        <div class="page-title">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Edit Currency</a></li>
            </ol>
          </nav>
          <div><?php echo $message_display;?></div>
          <div class="title_left col-md-12">
            <h3>Currency Information</h3>
          </div>
        </div>
  
              <div class="clearfix"></div>
           <div class="col-md-8 col-sm-12 col-xs-12">
       
        
        
        <div class="x_panel">
            <div class="x_content">
              
              <form id="demo-form" method="post"  action="<?php echo base_url();?>admin/setting/edit_currency" onsubmit="return(validate());">  
              
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  
              <div class="form-group">
              <label for="fullname">Currency Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Currency name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="name" class="form-control"  autocomplete="off" name="name" value="<?=$name?>" maxlength="10" required /><span class="error"> <?=form_error('name');?></span>
            </div>
            
            <div class="form-group">
              <label for="fullname">Currency Code<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Currency Code"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="code" class="form-control"  autocomplete="off" name="code" value="<?=$code?>" maxlength="4" required /><span class="error"> <?=form_error('code');?></span>
            </div>


            <div class="form-group">
              <label for="fullname">Currency Symbol<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Currency Symbol"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="symbol" class="form-control"  autocomplete="off" name="symbol" value="<?=$symbol?>" maxlength="2" /><span class="error"> <?=form_error('symbol');?></span>
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