

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Add Permission</a></li>
          </ol>
        </nav>
        <div><?php echo $message_display;?></div>
        <div class="title_left col-md-12">
          <h3>Add Permission</h3>
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-8 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
      <div class="x_panel">
          <div class="x_content">
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Setting/new_permission_add" onsubmit="return(validate());" >
            <div class="form-group">
              <label for="fullname">Permission Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Permission name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="permsn_name" class="form-control"  autocomplete="off" name="permsn_name" value="<?=$permsn_name?>" required /><span class="error"> <?=form_error('permsn_name');?></span>
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


