<!-- Libraries -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script type="text/javascript">




$(document).ready(function() {

  var poppy = localStorage.getItem('myPopuP');

if(!poppy){
    function PopUp(){
      $("#custom-modal").modal("show");
    }
    setTimeout(function(){
        PopUp();
    },1000); 

    $('.popup-close').click(function() {
     
      $("#custom-modal").modal("hide");
    });
    localStorage.setItem('myPopuP','true');
}
});


/* Close the popup when the a selection is made */

</script>
<!-- A Bootstrap Modal -->
<div id="custom-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close popup-close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Website</h4>
      </div>
      <div class="modal-body">
       <a href="<?php echo base_url(); ?>dashboard/add-webiste/"><h3 class="label label-primary">Click Here To add Website</h3></a>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default popup-close" data-dismiss="modal">Dismiss</button>
      </div>
    </div>
  </div>
</div>