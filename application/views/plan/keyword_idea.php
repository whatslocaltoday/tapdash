<?php 
//echo phpinfo();

//die;

?>

     <!-- page content -->
        <div class="right_col clearfix" role="main">
      <div class="page-title">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url(); ?>dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Keyword Idea</a></li>
          </ol>
        </nav>
        <div><?php echo $message_display;?></div>
        <div class="title_left col-md-12">
         
        </div>
      </div>

            <div class="clearfix"></div>
         <div class="col-md-12 col-sm-12 col-xs-12">
     
      <!-- /SEO Information-->
      
      <div class="x_panel">
          <div class="x_content">
            <form id="demo-form" method="post" action="<?php echo base_url();?>admin/Process/get_keyword_idea" onsubmit="return(validate());" >
            <div class="col-md-6 col-sm-12 col-xs-12">
     
            <div class="form-group">
              <label for="fullname">Google Keyword<span style="color:red;">*</span><span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Keyword"><i class="fa fa-question-circle"></i></span></label>
              <input type="text" id="keyword_name" class="form-control" placeholder="type a keyword and press enter" autocomplete="off" name="keyword_name" value="<?=$keyword_name?>" required /><span class="error"> <?=form_error('keyword_name');?></span>
            </div> </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
            <label for="message">Website <span style="" class="tip" data-toggle="tooltip" title="" data-placement="right" data-original-title="Website and Website title"><i class="fa fa-question-circle"></i></span></label>
            <select name="web_id"  class="form-control" >
              <option>Select Website</option>
              <?php 
              $selected="";

              foreach($data_web_sel as $data_web_assign){
              
                ?>
                <option  value="<?php echo $data_web_assign->website;?>"> <?php echo $data_web_assign->pname." :- ".$data_web_assign->website ?></option>
              <?php }
              ?>
           </select>
            
            </div> </div>

            <div class="col-md-12 col-sm-12 col-xs-12"><div class="admin-bar-inner">
    <button type="button" class="btn btn-info" onclick="window.location.href='<?=base_url(); ?>dashboard';"><i class="fa fa-angle-left"></i> Back</button>
    <button class="btn btn-success" type="submit">Submit</button>
   
  </div></div>



<!-- <?php 
//print_r($keywordresult);
foreach($keywordresult as $key_res){
  print_r($key_res[0]);
 //print $key_res->keyword;
}
?> -->

  
   </form>
 </div>
      </div>
      <!-- /SEO Information End -->
     </div>
	 
   
	 
	 
	 <div class="clearfix"></div>
		<!-- /Keyword Suggestions--> 
<?php 
 if (!empty($keywordresult)) 
 {

?>

		<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Keyword Suggestion <small>Google</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li class="dropdown">
						<a class="with-icon common-btn dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><i class="fa fa-download"></i><p>Download</p></a>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                          <a  class="btn" onclick="exportTableToExcel('tblData', 'Keyword Suggestion')">Export Table Data To Excel File</a>

                          </li>
                          
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action" id="tblData">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">Keywords </th>
                            <th class="column-title">Search Volume </th>
                            <th class="column-title">Avarage CPC </th>
                            <th class="column-title">Competition </th>
                           
                            </th>
                            
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                        
                        foreach($keywordresult as $key_res){
                        
                        ?>
                          <tr class="noExl">
                            <td class="a-center ">
                              <input type="checkbox" class="flat" name="table_records">
                            </td>
                            <td class=" "><?php echo $key_res[0]; ?></td>
                            <td class=" "><?php echo $key_res[1]; ?> </td>
                            <td class=" "><?php echo $key_res[2]; ?> </i></td>
                            <td class=" "><?php echo number_format((float)$key_res[3], 3, '.', ''); ?></td>
                        
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
		<!-- /Keyword Suggestions End -->
 <?php } ?>
	 
	 
        </div>
        <!-- /page content -->
       




<script type="text/javascript">
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

</script> 

       


