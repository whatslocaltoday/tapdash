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
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  </head>

  <body class="login">
    <div class="main-login-page accountbg">
		<div class="wrapper-page">
			<div class="card">
					<div class="card-body">							
<?php if( get_cookie('dash_sucsess_cokiee') !=''){ ?>	<div  class="msg success-msg alert alert-success fade in alert-dismissible"><?php   echo get_cookie('dash_sucsess_cokiee');  ?></div><?php } ?>
<?php if( get_cookie('dash_unsucsess_cokiee') !=''){ ?>	<div  class="msg success-msg alert alert-danger fade in alert-dismissible"><?php   echo get_cookie('dash_unsucsess_cokiee');  ?></div><?php } ?>						<div class="logo clearfix"><a href="https://tapouts.online/" title="tapouts"><h1>tapouts</h1></a></div>						<div class="register-txt text-right"><h4 class="font-18 mt-3 m-b-5">Reset Password</h4></div>
						<form action="<?php echo  base_url()?>admin/User_authentication/reset_send_password/" method="post" class="form-horizontal form-label-left input_mask">
							<div class="form-group">								<div class="alert alert-success" role="alert">Enter your Email and instructions will be sent to you!</div>
                            </div>
                            <div class="form-group">
								<div class="col-md-12">
								<input type="email" class="form-control" name="u_email" id="u_email" autocomplete="off" required placeholder="Email">
								<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
							  </div>
							</div>
                        <button class="login-btn" type="submit" class="submit1" id="submit" >Submit</button>
					  </form>
					</div>
				</div><div class="go-to">			<p>Already a member ? &nbsp;  <a href="<?php echo base_url(); ?>login/"> Sign In Here </a><p>			<p>Copyright © <?php echo date('Y')?> Tapout Ltd. All Rights Reserved.</p>			</div>
			
		</div>
	</div>
  </body>
</html>

