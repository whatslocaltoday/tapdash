

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Add New User</a></li>
          </ol>
        </nav>
        <div><?php echo $message_display;?></div>
        <div class="title_left col-md-12">
          <h3>User Information</h3>
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-8 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
      <div class="x_panel">
          <div class="x_content">
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Dashboard/new_user_registration" onsubmit="return(validate());" >
                      <div class="form-group">
              <label for="fullname">First Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User First name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="f_name" class="form-control"  autocomplete="off" name="f_name" value="<?=$f_name?>" required /><span class="error"> <?=form_error('f_name');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Last Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User Last  name"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="l_name" class="form-control"  autocomplete="off" name="l_name" value="<?=$l_name?>"  required/><span class="error"> <?=form_error('l_name');?></span>
            </div>

            <div class="form-group">
              <label for="fullname">Email<span style="color:red;">*</span> <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User Email id."><i class="fa fa-question-circle"></i></span></label>
              <input type="email" id="admin_email" class="form-control"  autocomplete="off" name="email" value="<?=$email?>" required /><span class="error"> <?=form_error('email');?></span>
            </div>

            
            <div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
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
            <label for="message">User Type <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This is for User Type"><i class="fa fa-question-circle"></i></span></label>
            <select name="user_type" class="form-control" required>
              <option value="">Select User Type</option>
              <?php 
              $selected="";
             
              foreach($admin_type as $adt_row){
                if($user_type==$adt_row->id){

                   $selected="selected";
                }else{
                
                  $selected="";
                }
                ?>
                <option  value="<?php echo $adt_row->id;?>" <?php echo  $selected;?>> <?php echo $adt_row->name?></option>
              <?php }
              ?>
            </select><span class="error"> <?=form_error('user_type');?></span>
            
            </div>
            <div id="checkboxes1" style="display: none;">
            <input type="checkbox" id="checkAllcheck">Selet All Role & Rights
<hr />
            <div id="checkboxes" style="display: none;">User permission control
            <div class="col-md-4">
            <div class="checkbox"> 
            
            </div>
            </div>
            </div>

            </div>

            <div class="clearfix"></div>
              <hr>
              Select the projects a user has access to.
              <hr>
              <p></p>
<div class="selectedlistsmultiselect">
<div class="row">
<div class="col-md-6">
<h4>Available Website</h4>
              <ul class="" onmouseleave="myFunction()">
           
              
              <?php 
              $selected="";
             
              foreach($web_proj as $adt_web){
               
                ?>


            <li id="<?php echo $adt_web->id; ?>"> <?php echo $adt_web->website?></li>
            <?php }
              ?>
          
  </ul>
  </div>
 
  <div class="col-md-6">
  <h4>Selected Website</h4>
  <ul id="selectd_web" onmouseleave="myFunction()">
     
  </ul>
  </div>
</div>
</div>

<input type="hidden" id="select_web_project"  name="select_web_project"/>

        <div class="clearfix"></div>

             <div class="form-group">
            <label for="message">Status <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This is for User Status"><i class="fa fa-question-circle"></i></span></label>
            
            <select id="admin_status" name="admin_status" class="form-control">
							<option value="1">Active</option>
						  <option value="0">Inctive</option>
		        </select>

            
            
            </div>
            
            

             <div class="admin-bar-inner">
    <button type="button" class="btn btn-info" onclick="window.location.href='<?=base_url(); ?>dashboard';"><i class="fa fa-angle-left"></i> Back</button>
    <button class="btn btn-success" type="submit">Submit</button>
    <!--<button id="preview" class="btn btn-success btn-sm btn-small" type="submit"><i class="fa fa-eye"></i> Preview</button>-->
  </div>
                    </form>
                  </div>
      </div>
      <!-- /SEO Information End -->
     </div>


     <div class="col-md-4">
		<div class="x_panel">
		<div class="x_content">
			<div class="showContant">
				<ul>
        <li>Please Select atleast 1 website and drop to selected website box </li>
					<li>Click to select individual Website </li>
					<li>Ctrl + Click to select multiple items</li>
          <span> </span>
				</ul>
			</div>
			<p></p>
		</div>
		</div>
		
	 </div>
        </div>
        <!-- /page content -->
       



<script type="text/javascript">

$("#checkAllcheck").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
       
       $(document).ready(function(){
        
 
       // get model data
       $('select[name=user_type]').on('change',function(){
        
        user_type=$('select[name=user_type]').val();

           // brand=$(this).val();
        

              $.ajax({
                type: 'post',
                 url: '<?=base_url(); ?>admin/Dashboard/get_master_role',
                 data: 'ajdevice='+user_type, // Send dataFields var
                   success:function(data) {
                    dataObj=JSON.stringify(data);
                    if(dataObj=='false')
                    {
                      $('#checkboxes').hide();
                    }
                    else
                    {
                     // $("checkboxes").empty();

                     jQuery('#checkboxes').html('');
                   // alert (JSON.stringify(data)); 
                        // var dataObj = $.parseJSON(data);
                      
                          
                         $.each(data, function(key, value) {
                          $('#checkboxes1').show();
                          $('#checkboxes').show();
                          $('#checkboxes').append('<div class="col-md-3"><input type="checkbox"  value="'+key +'" name="permsn_name[]" /> ' + value + '</div>');

                         }); 
                     }
                   }     
 
                 });
         });



  
 
       });
 
      </script>


<script type="text/javascript">

function validate()
{

  var count_checked = $("[name='permsn_name[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
          alert("Please select Rights.");
            return false;
        }
        var str_array =[];
        var mystring = document.getElementById('select_web_project').value; 
        
        if(!mystring.match(/\S/)) {

            alert ('Please Select webiste');
            return false;
        }
        var result = mystring.split(',');
      
        if( result.length > 1 ) {

          alert ('Please Select only single Website for User Profile creation');
        return false;
        }
        else
        {
          var r=confirm("Do you want to update this?")
          if (r==true)
            return true;
          else
            return false;
        }
}



function myFunction(val) {

  var web_proj = [];
 
    $('#selectd_web li').each(function(i)
      {
       // web_proj = [];
        web_proj.push($(this).attr('id')); // This is your rel value
      });

      //alert(web_proj);
      $('#select_web_project').val(web_proj)
}





</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script
  src="https://code.jquery.com/ui/1.9.1/jquery-ui.min.js"
  integrity="sha256-UezNdLBLZaG/YoRcr48I68gr8pb5gyTBM+di5P8p6t8="
  crossorigin="anonymous"></script>

  
<script>
$("ul").on('click', 'li', function (e) {
    if (e.ctrlKey || e.metaKey) {
        $(this).toggleClass("selected");
    } else {
        $(this).addClass("selected").siblings().removeClass('selected');
    }
}).sortable({
    connectWith: "ul",
    delay: 150, //Needed to prevent accidental drag when trying to select
    revert: 0,
    helper: function (e, item) {
        if (!item.hasClass('selected')) {
            item.addClass('selected').siblings().removeClass('selected');
        }
        var elements = item.parent().children('.selected').clone();
        
      
        item.data('multidrag', elements).siblings('.selected').remove();
        
       
        var helper = $('<li/>');
        return helper.append(elements);
    },
    stop: function (e, ui) {
        //Now we access those items that we stored in `item`s data!
        var elements = ui.item.data('multidrag');
        
        ui.item.after(elements).remove();
    }

});








</script>

