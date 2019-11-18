
        <?php 
                      
        $admin_name=$this->session->userdata('user_name');
        $session_role_name=$this->session->userdata('session_role_name');
        $admin_name=ucwords($admin_name);
        $session_role_name=ucwords($session_role_name);

         $projIDpop=$this->session->userdata('projID');

        $_SERVER['REQUEST_URI'];
        if(!empty($projIDpop))
        {}
        else
        {
          include('popupprojet.php');
        }
       
        ?>
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url()?>admin-assets/images/favicon.png" type="image/png">
    <title>Tapouts Dashboard</title>
    <script src="<?php echo base_url()?>admin-assets/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url()?>admin-assets/ckeditor/samples/js/sample.js"></script>
		<link rel="stylesheet" href="<?php echo base_url()?>admin-assets/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>admin-assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>admin-assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>admin-assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url()?>admin-assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<link href="<?php echo base_url()?>admin-assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>admin-assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>admin-assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>admin-assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>admin-assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url()?>admin-assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url()?>admin-assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url()?>admin-assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>admin-assets/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>admin-assets/build/css/custom-style.css" rel="stylesheet">
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url()?>dashboard" class="site_title"><i class="fa fa-bolt"></i> <span class="tapout">tapouts!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url()?>admin-assets/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <h2><?php echo $admin_name; 
                ?></h2>
                 <span><?php echo $session_role_name; 
                ?></span>
              </div>
            </div>



            <!-- /menu profile quick info -->