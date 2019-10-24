<?php


if (isset($this->session->userdata['logged_in'])) {
	

 header("location:".base_url()."admin/user_authentication/user_login_process");

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
    <title>.::Tapouts Dashboard::.</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>admin-assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>admin-assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>admin-assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url()?>admin-assets/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>admin-assets/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>admin-assets/build/css/custom-style.css" rel="stylesheet">
  </head>

  <body class="login">
    <div class="main-login-page bg-img">
		<div class="clearfix bg-holder">
			
		</div>
		<div class="container">
			<div class="center-section">
			<div class="row login-container column-seperation">
				<div class="col-md-6 col-sm-12 login-image">
				<img src="<?php echo base_url()?>admin-assets/images/login-bg.png" alt="login" class="mx-auto">
				</div>
				<div class="col-md-6 col-sm-12 login-box">
				<div class="login_title"><h4 class="mb-4">Login</h4><p>Welcome back, please login to your account.</p></div>
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
						<h2 class="heading">Login</h2>

						<form action="<?php echo  base_url()?>webmaster/login_process/" method="post" class="form-horizontal form-label-left input_mask">
						
							<div class="form-group">
								<input type="text" class="form-control" name="u_email" id="u_email" required placeholder="Email">
								<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
							</div>
						  <div class="form-group">
							<input type="password" class="form-control" name="u_password" id="u_password" required placeholder="Password">
							<span class="fa fa-unlock-alt form-control-feedback left" aria-hidden="true"></span>
						  </div>
						  <div class="form-group col-md-12 clearfix">
						  <button class="login-btn" type="submit">Login</button>
						  <button id="ajax-loader-button" class="btn btn-link " type="button" style="margin-bottom: -20px; margin-top: -5px;display:none;"><i id="animate-icon" class="fa fa-spinner fa fa-2x fa-spin"></i></button></div>
					  </form>
					  <div class="go-to"><a href="<?php echo base_url(); ?>registration/" class="pull-left" >Create Account</a> <a href="<?php echo base_url(); ?>reset-password" class="pull-right">Reset your password</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
