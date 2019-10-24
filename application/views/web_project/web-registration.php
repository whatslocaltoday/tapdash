

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Add New Website</a></li>
          </ol>
        </nav>
        <div><?php echo $message_display;?></div>
        <div class="title_left col-md-12">
          <h3>Website Information</h3>
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-8 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
      				
<?php if( get_cookie('dash_sucsess_cokiee') !=''){ ?>	<div  class="msg success-msg alert alert-success fade in alert-dismissible"><?php   echo get_cookie('dash_sucsess_cokiee');  ?></div><?php } ?>
<?php if( get_cookie('dash_unsucsess_cokiee') !=''){ ?>	<div  class="msg success-msg alert alert-danger fade in alert-dismissible"><?php   echo get_cookie('dash_unsucsess_cokiee');  ?></div><?php } ?>
	
      <div class="x_panel">
          <div class="x_content">
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Dashboard/new_website_registration">
                      <div class="form-group">
              <label for="fullname">Webiste Title<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Webiste Title display Dashboard"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="pname" class="form-control" name="pname" value="<?=$pname?>" required  autocomplete="off"/><span class="error"> <?=form_error('pname');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">WebSite Url<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Website URL"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="website" class="form-control" name="website" value="<?=$website?>" required  autocomplete="off"/><span class="error"> <?=form_error('website');?></span>
            </div>

            <!-- <div class="form-group">
              <label for="fullname">Google Analytics <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Webiste Google Analytics."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="google_a_id" class="form-control" name="google_a_id" value="<?=$google_a_id?>"   autocomplete="off"/><span class="error"> <?=form_error('google_a_id');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Facebook Analytics <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Webiste Facebook Analytics."><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="face_analytic_id" class="form-control" name="face_analytic_id" value="<?=$face_analytic_id?>"   autocomplete="off"/><span class="error"> <?=form_error('face_analytic_id');?></span>
            </div> -->

           
            

            <div class="form-group">
            <label for="message">Country <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Website functioning country"><i class="fa fa-question-circle"></i></span></label>
            <select name="addcountry"  required class="form-control" >
              <option value="0">Select Country</option>
              <?php 
              $selected="";

              foreach($countery_info as $cntry_row){
              
                ?>
                <option  value="<?php echo $cntry_row->sortname;?>"> <?php echo $cntry_row->name?></option>
              <?php }
              ?>
            </select><span class="error"> <?=form_error('addcountry');?></span>
            
            </div>



            <div class="form-group">
              <label for="fullname">Time Zone<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Time Zone."><i class="fa fa-question-circle"></i></span></label>
              <select name="time_zone" class="form-control">
                <option value="0">Select Time Zone</option>
                
              </select>
              </span>
              <span><?=form_error('time_zone')?></span>
            </div>


            <div class="form-group">
              <label for="fullname">Currency<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Time Zone."><i class="fa fa-question-circle"></i></span></label>
              <select name="cuurency_web" class="form-control">
           
              <?php 
              $selected="";

              foreach($currency_info as $currency_row){
              
                ?>
                <option  value="<?php echo $currency_row->id;?>"> <?php echo $currency_row->name."(". $currency_row->code." ".$currency_row->symbol.")" ?></option>
              <?php }
              ?>
            </select><span class="error"> <?=form_error('cuurency_web');?></span>
            </div>


        

             <div class="form-group">
            <label for="message">Status <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This is for Website Status"><i class="fa fa-question-circle"></i></span></label>
            
            <select id="web_status" name="web_status" class="form-control">
							<option value="1">Active</option>
						  <option value="0">Inctive</option>
		        </select>

            
            
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
					<li>Your time zone and currency settings can't be changed after you set up your account. </li>
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



        $(document).ready(function(){
        
 
        // get model data
        $('select[name=addcountry]').on('change',function(){
         
          addcountry=$('select[name=addcountry]').val();



                 $.ajax({
                   type: 'post',
                    url: '<?=base_url(); ?>admin/Dashboard/get_timezone',
                    data: 'ajcountry='+addcountry, // Send dataFields var
                      success:function(data) {
                          
                          
                       // var dataObj = $.parseJSON(data);
                        $('select[name="time_zone"]').empty();
                       
                         
                        $.each(data, function(key, value) {
                          
                            $('select[name="time_zone"]').append('<option value="'+ value.zone_id +'">'+ value.zone_name +'</option>');
                          
                        });
                       
                        $('select option').filter(function(){
                          return ($(this).val().trim()=="" && $(this).text().trim()=="");}).remove();
                      
                    }



                });
        });
      });

        </script>

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

