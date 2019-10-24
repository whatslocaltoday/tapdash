<!-- sidebar menu -->
          <?php 

        
            $user_ap=$this->session->userdata('user_ap');
        

           ?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php 
                  if(!empty($_SESSION['projID']))
                  {
                    ?>
	<li><a href="<?php echo base_url()?>dashboardmain/"><i class="fa fa-home"></i> Dashboard Home</a></li>
                    <?php
                  }
                  else
                  {
                    ?>
	<li><a href="<?php echo base_url()?>dashboard/"><i class="fa fa-home"></i> Dashboard</a></li>
<?php
                  }
                  ?>
			
				<!-- <li><a href="<?php if(!empty($_SESSION['projWebiste_sesn'])) {echo $_SESSION['projWebiste_sesn'];} ?>" target="_blank"><i class="fa fa-flag tip"></i>Site View</a></li> -->




        <li><a href="<?php echo base_url()?>accounts/"><i class="fa fa-home"></i> Accounts</a></li>
				  <!--<li><a href="#"><i class="fa fa-picture-o tip"></i> Slide Manager</a></li>-->
				  <!--<li><a href="#"><i class="fa fa-envelope-o"></i> Mail Manager</a></li>-->
  <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("1",$menu_option, TRUE))
			{
        ?> 
        <li><a><i class="fa fa-user tip"></i> SEO <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <!-- <?php 
                     if(!empty($_SESSION['projID']))
                     {


                      $menu_option=explode(",", $user_ap);
                    if (in_array("1",$menu_option, TRUE) && !empty($_SESSION['projview_id_sesn']))
                    {?>   
                     <li><a href="<?php echo base_url()?>seo/website-traffic/">Website Traffic</a></li> 
                       <?php } 


                    $menu_option=explode(",", $user_ap);
                    if (in_array("1",$menu_option, TRUE))
                    {?>    <li><a href="<?php echo base_url()?>seo/alexa-graph/">Website Alexa Graph</a></li>   <?php } 


                    $menu_option=explode(",", $user_ap);
                    if (in_array("1",$menu_option, TRUE) && !empty($_SESSION['projview_id_sesn']))
                    {?>    <li><a href="<?php echo base_url()?>seo/search-page-title/">Search Page Title</a></li>   <?php } 


                    $menu_option=explode(",", $user_ap);
                    if (in_array("1",$menu_option, TRUE) && !empty($_SESSION['projview_id_sesn']))
                    {?>    <li><a href="<?php echo base_url()?>seo/source-medium/">Source & Medium</a></li>   <?php } 

                    $menu_option=explode(",", $user_ap);
                    if (in_array("1",$menu_option, TRUE) && !empty($_SESSION['projview_id_sesn']))
                    {?>    <li><a href="<?php echo base_url()?>seo/main-graph/">home graph</a></li>   <?php } 

                    $menu_option=explode(",", $user_ap);
                    if (in_array("1",$menu_option, TRUE) && !empty($_SESSION['projview_id_sesn']))
                    {?>    <li><a href="<?php echo base_url()?>seo/searched-keyword/">Searched Keyword</a></li>   <?php } 
      
              }?> -->
                    
      <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("16",$menu_option, TRUE)) { ?><li><a href="<?php echo base_url()?>admin/Process/keyword_idea/">Get Keyword Idea</a></li><?php } ?>


      
                      <!--<li><a href="#">Manage User Group</a></li>-->
                    </ul>
                  </li>
                  <?php
                
                }
                ?>

<!-- setting -->
<?php 	$menu_option=explode(",", $user_ap);
			if (in_array("58",$menu_option, TRUE))
			{?> <li><a><i class="glyphicon glyphicon-cog"></i> Setting <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">

                      <li><a><i class="fa fa-lock"></i> Permission <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("55",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/add-permission/">Add Permission </a>
                              </li> 
                              <?php }?>

                              <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("56",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/edit-permission/">Edit Permission </a>
                              </li>  
                              <?php }?>

                        </ul>
                        
                      </li>

                      <li><a><i class="fa fa-flag"></i> Country  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("61",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/add-country/">Add Country </a>
                              </li> 
                              <?php }?>

                              <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("62",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/edit-country/">Edit Country </a>
                              </li>  
                              <?php }?>

                        </ul>
                      </li>

                      <li><a><i class="fa fa-money"></i> Currency <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <!-- <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("59",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/add-currency/">Add Currency </a>
                              </li> 
                              <?php }?> -->

                              <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("60",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/edit-currency/">Edit Currency </a>
                              </li>  
                              <?php }?>

                        </ul>
                      </li>
               
<!-- 
                      <li><a><i class="fa fa-clock-o"></i> Zone  <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("63",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/add-permission/">Add Zone </a>
                              </li> 
                              <?php }?>

                              <li><?php 	$menu_option=explode(",", $user_ap);
                              if (in_array("64",$menu_option, TRUE))
                              {?><a href="<?php echo base_url()?>setting/edit-permission/">Edit Zone </a>
                              </li>  
                              <?php }?>

                        </ul>
                      </li> -->



                    </ul>
                    
                    

                  </li>
                  <?php }?>

<!-- setting end -->





				 <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("1",$menu_option, TRUE))
			{?> <li><a><i class="fa fa-user tip"></i> User Manager <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("1",$menu_option, TRUE))
			{?>    <li><a href="<?php echo base_url()?>dashboard/add-user/">Add New User</a></li>   <?php }?>
                     <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("2",$menu_option, TRUE))
			{?> <li><a href="<?php echo base_url()?>dashboard/view-user/">Manage User</a></li><?php }?>
                      <!--<li><a href="#">Manage User Group</a></li>-->
                    </ul>
                  </li>
                  <?php }?>



                




                  <?php 	$menu_option=explode(",", $user_ap);
                
			if (in_array("38",$menu_option, TRUE))
			{?> <li><a><i class="fa fa-code tip"></i> Website Manager <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("45",$menu_option, TRUE))
			{?>   <li><a href="<?php echo base_url()?>dashboard/add-webiste/">Add Website</a></li>   <?php }?>
                     <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("46",$menu_option, TRUE))
			{?> <li><a href="<?php echo base_url()?>dashboard/view-webiste/">Manage Website</a></li><?php }?>
                      <!--<li><a href="#">Manage User Group</a></li>-->
                    </ul>
                  </li>
                  <?php }?>




                  <?php 	$menu_option=explode(",", $user_ap);
                
			if (in_array("17",$menu_option, TRUE))
			{?> <li><a><i class="fa fa-code tip"></i>Adwords Plan Process <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php 	$menu_option=explode(",", $user_ap);
			if (in_array("17",$menu_option, TRUE))
			{?>       
<li><a href="<?php echo base_url()?>admin/Process/list_plan_process">View Plan Process</a></li><?php }?>
                     <?php $menu_option=explode(",", $user_ap);
			if (in_array("13",$menu_option, TRUE))
			{?> <li><a href="<?php echo base_url()?>process/add-plan-process/">Add Plan Process</a></li>   <?php }?>
                      <!-- <li><?php 	$menu_option=explode(",", $user_ap);
			if (in_array("14",$menu_option, TRUE))
			{?><a href="<?php echo base_url()?>process/edit-plan-process/">Edit Plan Process</a></li><?php }?> -->
<?php 	$menu_option=explode(",", $user_ap);
			if (in_array("16",$menu_option, TRUE))
			{?>

<li><a href="<?php

echo base_url()?>admin/Process/upload_plan_process/">Upload Plan Process</a></li>

<?php }?>


                      <!--<li><a href="#">Manage User Group</a></li>-->
                    </ul>
                  </li>
                  <?php }?>

                  <li><a href="<?php echo base_url()?>seo_dashboard/"><i class="fa fa-bar-chart"></i>SEO Dashboard</a>
                  </li>
				  <!--<li><a><i class="fa fa-cog tip"></i> Setting <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">General Setting</a></li>
                      <li><a href="#">Change Password</a></li>
                      <li><a href="#">Change Profile</a></li>
                      <li><a href="#">Google Analytic Code</a></li>
                      <li><a href="#">SMTP Settings</a></li>
                      <li><a href="#">Social Media Links</a></li>
                      <li><a href="#">Manage Cache</a></li>
                    </ul>
                  </li>-->
                  
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo  base_url()?>logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

         <!-- top navigation -->
        <div class="top_nav">
        
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-left">
                <li class="">
                <a href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                Select Website               
                <span class=" fa fa-angle-down"></span>
                </a>
                
          
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                 
                  <?php 

    $user_id=$this->session->userdata('user_id');
        $role_id=$this->session->userdata('role_id');
        if($role_id !='1')
        {
            $where="project_users.is_active ='1' and project_users.user_id =".$user_id ." and project_details.id !=''";
        }
        if($role_id =='1')
        {
            $where="project_details.id !=''";
        }
        $this->db->distinct();
        $this->db->select('project_details.*');
        $this->db->from('project_details');
		$this->db->join('project_users', 'project_users.project_id =project_details.id');
       
            $this->db->where($where);
        
        $query = $this->db->get();
        
            if($query->num_rows()>0){
              foreach ($query->result() as $row3) { 
               







										// $uid = $_SESSION['user_id'];
									  //   $sql3 ="SELECT proj_d.* FROM project_users as proj_u LEFT JOIN project_details as proj_d ON proj_u.project_id = proj_d.id where proj_u.user_id='$uid' and proj_d.flag='1'";
									
                    //   $query3 = $this->db->query($sql3);
                    //   if ($query3->num_rows() > 0) {
                    //   foreach ($query3->result() as $row3) { 
                     
                        
                        ?>
												<?php 
													// if($_SESSION['projID']==$row3->id)
													// {
													// 	$Displ_Proj=$row3->website;
													// }
												?>
									
                    <li><a href=" <?php echo base_url()?>dashboard/change-project/<?php echo $row3->id; ?>"><i ></i> <?php echo $row3->pname; ?></a></li>
                    
										<?php }} ?>
                    
                   
                  </ul>
                </li>
             <?php if(!empty($_SESSION['projWebiste_sesn'])) { ?>   
<li class="web-url"><?php if(!empty($_SESSION['projWebiste_sesn'])) {echo $_SESSION['projWebiste_sesn'];} ?></li>		
<?php } ?>		
              </ul>



              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url()?>admin-assets/images/img.jpg" alt="">
                      <span>Welcome</span> <?php
                      
                      //print_r($this->session->userdata('logged_in')); 
                       $admin_name=$this->session->userdata('user_name');
                      echo ucwords($admin_name);
                      ?>
                    
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url()?>dashboard/profile"> Profile</a></li>
                    
                    <li><a href="<?php echo base_url()?>dashboard/change-password"> Change Password</a></li>
                    <li><a href="<?php echo  base_url()?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>  
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->