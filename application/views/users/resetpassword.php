<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartRepair! | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>admin-assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <link href="css/custom-style.css" rel="stylesheet">
  </head>

  <body class="login">
		<div class="container">
			<div class="row login-container column-seperation">
			<div class="login-logo"><a href="/"><img src="http://test.repairmyphone.today/assets/images/logo.png" width="160px" alt=""></a></div>
			<div class="center-section">
			<form>
			<div class="form-group col-md-12">
				<h3>Reset Password</h3>
				<p>Enter the email address associated with your account, and we'll email you a link to reset your password.</p>
				<div class="controls"><div class="input-with-icon no-icon-block"><input type="email" name="email" class="form-control" placeholder="Email"></div></div>
			</div>			
			<div class="form-group col-md-12"><button class="btn btn-primary col-md-6" type="submit">Send Reset Link</button><button id="ajax-loader-button" class="btn btn-link " type="button" style="margin-bottom: -20px; margin-top: -5px;display:none;"><i id="animate-icon" class="fa fa-spinner fa fa-2x fa-spin"></i></button></div>
			</form>
			</div>
			
			<div class="go-to"><a href="http://test.repairmyphone.today/" class="" target="_blank">Go to Main Site</a> | <a href="/seo-panel-1" class="">Login</a></div>
			</div>
		</div>
  </body>
</html>
