


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
              
              <form id="demo-form" method="post"  action="<?php echo base_url();?>admin/Dashboard/edit_admin_user" onsubmit="return(validate());">  
              
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
  
                        <div class="form-group">
                <label for="fullname">First Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for User First Name."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="f_name" class="form-control" name="f_name" value="<?=$f_name?>"  autocomplete="off" /><span class="error"> <?=form_error('f_name');?></span>
              </div>
  
              <div class="form-group">
                <label for="fullname">Last Name<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for User Last Name."><i class="fa fa-question-circle"></i></span></label>
                <input type="text" id="l_name" class="form-control" name="l_name" value="<?=$l_name?>"  autocomplete="off" /><span class="error"> <?=form_error('l_name');?></span>
              </div>
  
              <div class="form-group">
                <label for="fullname">Email <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This User Email id."><i class="fa fa-question-circle"></i></span></label>
                <input type="email" id="admin_email" class="form-control" name="email" value="<?=$email?>" readonly  autocomplete="off" /><span class="error"> <?=form_error('email');?></span>
              </div>

              <div class="form-group">
                <label for="fullname">Password <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Change Password."><i class="fa fa-question-circle"></i></span></label>
                <div id="gender" class="btn-group" data-toggle="buttons">
                <label for="fullname">
              <input type="text" id="passwod" class="form-control" minlength="8" maxlength="15" name="passwod"  autocomplete="off"  />
                  </label>
                  <label for="fullname">
                  <a href="#" class="generate_password" onclick='generatePassworduser()'>Generate</a>
                  </label>
                  </div>
                
              </div>
  
  
              
              <div class="form-group">
			  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
              <div id="gender" class="btn-group" data-toggle="buttons">
              <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender" value="m" data-parsley-multiple="gender" <?php if ($gender != "m") echo "checked"; ?> class="form-control col-md-7 col-xs-12"/> &nbsp; Male &nbsp;
                  </label>
                  <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender" value="f" data-parsley-multiple="gender" <?php if ($gender != "f") echo "checked"; ?> class="form-control col-md-7 col-xs-12"/> Female
                  </label>
                  </div>
              </div>
  
              
  
                <div class="form-group">
            <label for="message">Admin Type <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for meta keyword of this page"><i class="fa fa-question-circle"></i></span></label>
            <select class="form-control" name="user_type">
              <option value="0">Select User Type</option>
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
             
              
  
               <div class="form-group" id="menu_list">
              <label for="message">Access Permission <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="This field is used for User role and rights"><i class="fa fa-question-circle"></i></span></label>
              <hr>
              <?php 
              $checked="";
               $flag="";
                
                $menu_option=explode(",", $menu_option);
                $per_list=explode(",", $per_list);
  
                foreach($per_name as &$valuenm)
                {
                  $permsn_name=$valuenm->name;
                  $permsn_id=$valuenm->id;
              foreach($per_list as $per_row){
               
                if($per_row==$permsn_id)
                 {
                if(!empty($menu_option)){
  
                  foreach($menu_option as &$value)
                    {
                     if($value==$per_row)
                        {
                          $flag++;
                        
                          break;
                        }
                    }
                }
               
                
                 if($flag==1){
                  $checked="checked='checked'";
                 }else{$checked="";}
                ?>
                <div class="col-md-3"><div class="checkbox"><input type="checkbox" name="permsn_name[]" <?=$checked?>  value="<?php echo $permsn_id ;?>"><?php echo $permsn_name;?></div></div>
              <?php 
              $flag="";
                }
            }
          }
  
              ?>
              <span class="error"> <?=form_error('permsn_name');?></span>
</div>


              <div id="checkboxes1" style="display: none;">
            <input type="checkbox" id="checkAllcheck">Select All Role & Rights
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
<div class="selectedlistsmultiselect">
<div class="row">
<div class="col-md-6">
<h4>Available Website</h4>
              <ul class="" onmouseleave="myFunction()">
           
              
              <?php 
              $selected="";
             if($web_proj !='')
             {
              foreach($web_proj as $adt_web){
               
                ?>


            <li id="<?php echo $adt_web->id; ?>"> <?php echo $adt_web->website?></li>
            <?php }}
              ?>
          
  </ul>
  </div>
  <div class="col-md-6">
  <h4>Selected Website</h4>
  <ul id="selectd_web" onmouseleave="myFunction()">
  <?php 
              $selected="";
             
              foreach($web_proj_sel as $adt_web_sel){
               
                ?>


            <li id="<?php echo $adt_web_sel->id; ?>"> <?php echo $adt_web_sel->website?></li>
            <?php }
              ?>
  </ul>
  </div>
</div>
</div>
<input type="hidden" id="select_web_project"  name="select_web_project"/>





              </div>
  
               <div class="form-group">
               <hr>
              <label for="message">Status <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="User Activation"><i class="fa fa-question-circle"></i></span></label>
              
                <input type="checkbox" <?php if($admin_status==1){?> checked <?php }?> name="admin_status" value="1">
              
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
         

          <script type="text/javascript">

$("#checkAllcheck").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
       
       $(document).ready(function(){
        var data21,data22,data; 
 
       // get model data
       $('select[name=user_type]').on('change',function(){
        
        user_type=$('select[name=user_type]').val();
        var user_id = $('#id').val();

           // brand=$(this).val();
        

              $.ajax({
                type: 'post',
                 url: '<?=base_url(); ?>admin/Dashboard/get_master_role',
                 //data: 'ajdevice='+user_type+'&userid='+user_id, // Send dataFields var
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
                    
                     jQuery('#menu_list').html('');
                     jQuery('#checkboxes').html('');
                   // alert (JSON.stringify(data)); 
                        // var dataObj = $.parseJSON(data);
//                         if(data['id_user'] =='1')
//                           {

//   //from acl_master table
//                             $.ajax({
//                             type: 'post',
//                             url: '<?=base_url(); ?>admin/Dashboard/get_master_role',
//                             data: 'ajdevice='+user_type, // Send dataFields var
                            
//                               success:function(data2) {
                               
//                                // alert (JSON.stringify(data2)); 
//                               }
//                             });


//  //from permission table
//                             $.ajax({
//                             type: 'post',
//                             url: '<?=base_url(); ?>admin/Dashboard/get_permission_list',
//                             data: 'ajper='+user_type, // Send dataFields var
                           
//                               success:function(data1) {
//                                 data21 = data1;
//                               }
//                             });



// //for old user type

                           
//                             $('#checkboxes1').show();
//                           $('#checkboxes').show();
                       
                         
//                            $.each(data, function(key, value) {
                             
//                                 $('#checkboxes').append('<div class="col-md-3"><input type="checkbox"  value="'+key +'" name="permsn_name[]" /> ' + value + '</div>');
                              
//                            });
                          
                       



//                           }





                          // else
                          // {
                      //for Fresh user type




                            $('#checkboxes1').show();
                          $('#checkboxes').show();
                            $.each(data, function(key, value) {
                            $('#checkboxes').append('<div class="col-md-3"><input type="checkbox"  value="'+key +'" name="permsn_name[]" /> ' + value + '</div>');
                          }); 
                         // }
                        
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
        var mystring = document.getElementById('select_web_project').value; 
        
        if(!mystring.match(/\S/)) {
            alert ('Please Select webiste');
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