

        <!-- page content -->
        <div class="right_col clearfix" role="main">
			<div class="page-title">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">All </li>
            
					</ol>
				</nav>
				<div class="title_left col-md-6">
					<h3>Upload Bulk Google Adwords Data</h3>
				</div>
      
       
			</div>
<?php 

$user_ap=$this->session->userdata('user_ap');

define('FILE_PATH', base_url() . "admin-assets/csv/");

?>

			<div class="row">
			
			
			<div class="modal fade" id="csv_mobile" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Import csv mobile</h4>
                        </div>
                        <div class="modal-body" style="background: none">
							<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="well clearfix">								
								<div class="col-md-8"><?php echo  form_open_multipart(base_url().'admin/Process/csv_adword_import')?>
								<input type="file" class="choose-file" name="csv" accept=".csv" required style="width: 200px;" /></div>
								<div class="col-md-4"><button type="submit" class="btn btn-primary">Upload CSV <i class="fa fa-arrow-up"></i></button></div>
							</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="well text-center clearfix">
									<a class="btn btn-success" href="<?php echo FILE_PATH?>adword_upload.csv">Download Sample CSV <i class="fa fa-arrow-down"></i></a>
								</div>
							</div>
                            <?php echo  form_close()?>
                            
                            
                            <div class="inventory-setting-csv">
                                <h3 style="padding-top: 10px;">Upload Adwords in CSV Format</h3>
                                <p>This page explains how to upload your Adwords data using a CSV file </p>
                                <h4>What does this mean?</h4>
                                <p>You can upload adwords data using a CSV file with each field delimited by a comma. Create an adword data file in Microsoft Excel according to the instructions and save the file in CSV format before uploading to dashboard. The first row should contain the field headers.  </p>
                                <h4>Manual upload</h4>
                                <p>Once your stock file is formatted in the right format you can upload it to dashboard. You can do this directly from the "Add Plan Process". </p>
                               
                                <p class="note_requird"><b>Required Filed For Mobile CSV :</b><br> Account ID, Campaign Date (Date Format sholud be "14-Mar-01"), Impressions, Clicks, Conversions., Budget and Cost<br>If any field is missing file will not upload to Dashboard</p>
                             
                                <p class="note">NOTE: Depending on the size of your file, Base may take up to a few minutes to process your uploaded file.</p>
                            </div>
                        </div>
                        <div class="modal-footer" hidden="">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
			
				  <div class="x_panel">
					<div class="x_content text-center">
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
                   <button type="button" class="btn btn-info btn-lg csv-standard" data-toggle="modal" data-target="#csv_mobile">Import csv Google Adwords Plan Progress</button>
					</div>
				  </div>
			
                
            </div>

           


        <!-- /page content -->
		


     
      </div>
    </div>
	


			<script type="text/javascript">


document.getElementById('from_date').valueAsDate = new Date();
document.getElementById('to_date').valueAsDate = new Date();

function delete_plan_progress(userid)
{
	var r=confirm("Do you want to delete this?")
    if (r==true)
		{
			$.ajax({
				type: 'post',
				url: '<?=base_url(); ?>admin/Process/delete_plan_progress_selected',
				data: 'ajuserid='+userid,
					success:function(data) {	
							return true;
						}
				});
		}
    else
    {
      return false;
    }      
}


    
</script>