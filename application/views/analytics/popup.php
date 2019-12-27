<!--Quote Modal-->
<div class="modal fade bd-example-modal-lg request-form" tabindex="-1" id="custom-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
  
                           <select name="accunt_d"  required class="form-control" >
                           <option value="0">Select Account</option>
                          <?php 
                          $selected="";
                          foreach($account_detail as $account){
                            ?>
                            <option  value="<?php echo $account->id;?>"> <?php echo $account->name?></option>
                          <?php }
                          ?>
                        </select>
                        <select name="web_proprty" class="form-control">
                        <option value="0">Select Website</option>
                        </select>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('select[name=accunt_d]').on('change',function(){
  accunt_d=$('select[name=accunt_d]').val();
         $.ajax({
           type: 'post',
            url: '<?=base_url(); ?>admin/LoginWithGooglePlus/get_webproperty',
            data: 'accunt_Id='+accunt_d, // Send dataFields var
              success:function(data) {
              //  var dataObj = $.parseJSON(data);
               // console.log(dataObj);
                $('select[name="web_proprty"]').empty();
                $('select[name="web_proprty"]').append('<option value="0">Select Website</option>');
                $.each(data, function(key, value) {
                    $('select[name="web_proprty"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
                $('select option').filter(function(){
                 
                  return ($(this).val().trim()=="" && $(this).text().trim()=="");}).remove();
            }
        });
});
});


$(document).ready(function(){
$('select[name=web_proprty]').on('change',function(){
  web_proprtyId=$('select[name=web_proprty]').val();
  accunt_d=$('select[name=accunt_d]').val();
 
         $.ajax({
           type: 'post',
            url: '<?=base_url(); ?>admin/LoginWithGooglePlus/get_webprofile',
            data: 'web_property_ID='+web_proprtyId+'&accunt_Id='+accunt_d, // Send dataFields var
              success:function(data) {
               // $("#custom-modal").modal("hide");
                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
                
                window.location.href = baseUrl + "/analytics_overview";
            }
        });
});
});

</script>