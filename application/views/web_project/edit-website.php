
<?php 
  
  ?>
       <!-- page content -->
          <div class="right_col clearfix" role="main">
        <div class="page-title">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Edit User</a></li>
            </ol>
          </nav>
          <div><?php echo $message_display;?></div>
          <div class="title_left col-md-12">
            <h3>User Information</h3>
          </div>
        </div>
  
              <div class="clearfix"></div>
           <div class="col-md-8 col-sm-12 col-xs-12">
       
        
        
        <div class="x_panel">
            <div class="x_content">
              
              <form id="demo-form" method="post"  action="<?php echo base_url();?>admin/Dashboard/edit_admin_web_proj" onsubmit="return(validate());">  
              
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">

              <div class="form-group">
                <label for="fullname">Account No.<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Website Account No."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="accountnumber" class="form-control" name="accountnumber" value="<?=$accountnumber?>" readonly />
              </div>
  
              <div class="form-group">
                <label for="fullname">Website URL<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Website URL."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="website" class="form-control" name="website" value="<?=$website?>" readonly autocomplete="off" /><span class="error"> <?=form_error('website');?></span>
              </div>
                        <div class="form-group">
                <label for="fullname">Website Title<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Website Title."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="pname" class="form-control" name="pname" value="<?=$pname?>" required autocomplete="off"  /><span class="error"> <?=form_error('pname');?></span>
              </div>
  
              
  
              <!-- <div class="form-group">
                <label for="fullname">Google Analytics <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This Google Analytics ."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="google_a_id" class="form-control" name="google_a_id" value="<?=$google_a_id?>"  autocomplete="off" /><span class="error"> <?=form_error('google_a_id');?></span>
              </div> -->
                
              <!-- <?php


$post='65';

$user_ap=$this->session->userdata('user_ap');
$menu_option=explode(",", $user_ap);

if (in_array($post,$menu_option, true))
{

  $datacc=1;
} 

else{

    $data=0;
}     

  if ($datacc=='1')

  {

?>
              <div class="form-group">
                <label for="fullname">Google Analytics View ID <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This Google Analytics View ID ."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="google_av_id" class="form-control" name="google_av_id" value="<?=$google_av_id?>"  autocomplete="off" /><span class="error"> <?=form_error('google_av_id');?></span>
              </div>
              <?php } ?> -->
              <!-- <div class="form-group">
                <label for="fullname">Facebook Analytics<span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This Facebook Analytics ."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="face_analytic_id" class="form-control" name="face_analytic_id" value="<?=$face_analytic_id?>"  autocomplete="off" /><span class="error"> <?=form_error('face_analytic_id');?></span>
              </div> -->
  
  
             
  
                <div class="form-group">
            <label for="message">Country<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Country"><i class="fa fa-question-circle"></i></span></label>
            <select class="form-control" name="addcountry">
              <option value="0">Select Country</option>
              <?php 
              $selected="";
             
              foreach($countery_info as $adt_row){
                if($country_code==$adt_row->sortname){

                   $selected="selected";
                }else{
                
                  $selected="";
                }
                ?>
                <option  value="<?php echo $adt_row->sortname;?>" <?php echo  $selected;?>> <?php echo $adt_row->name?></option>
              <?php }
              ?>
            </select><span class="error"> <?=form_error('addcountry');?></span>
            
            </div>
             

            <div class="form-group">
            <label for="fullname">Time Zone<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Time Zone."><i class="fa fa-question-circle"></i></span></label>
              <select name="time_zone" class="form-control">
              
              <?php 
              $selected="";
             
              foreach($zone_info as $zone_row){
                if($zone_info==$zone_row->zone_id){

                   $selected="selected";
                }else{
                
                  $selected="";
                }
                ?>
                <option  value="<?php echo $zone_row->zone_id;?>" <?php echo  $selected;?>> <?php echo $zone_row->zone_name?></option>
              <?php }
              ?>
            </select><span class="error"> <?=form_error('time_zone');?></span>
            
            </div>



            <div class="form-group">
            <label for="fullname">Currency<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for Time Zone."><i class="fa fa-question-circle"></i></span></label>
              <select name="cuurency_web" class="form-control">
              
              <?php 
              $selected="";
             
              foreach($currency_info as $crncy_row){
                if($currency_id==$crncy_row->id){

                   $selected="selected";
                }else{
                
                  $selected="";
                }
                ?>
                <option  value="<?php echo $crncy_row->id;?>" <?php echo  $selected;?>> <?php echo $crncy_row->name?></option>
              <?php }
              ?>
            </select><span class="error"> <?=form_error('time_zone');?></span>
            
            </div>
              
  
              
  
               <div class="form-group">
               <hr>
              <label for="message">Status <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Website Activation status"><i class="fa fa-question-circle"></i></span></label>
              
              <select id="web_status" name="web_status" class="form-control">
							<option value="1" <?=$flag == '1' ? ' selected="selected"' : '';?>>Active</option>
						  <option value="0"<?=$flag == '0' ? ' selected="selected"' : '';?>>Inactive</option>
		        </select>
              
              </div>
              
              
  
               <div class="admin-bar-inner">
      <button type="button" class="btn btn-info btn-sm btn-small" onclick="window.location.href='<?=base_url(); ?>dashboard/view-user/';"><i class="fa fa-angle-left"></i> Back</button>
      <button class="btn btn-success btn-sm btn-small" type="submit">Submit</button>
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
function validate()
{
     var r=confirm("Do you want to update this?")
    if (r==true)
      return true;
    else
      return false;
}
</script>



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
        