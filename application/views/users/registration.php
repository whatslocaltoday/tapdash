<?php   if (isset($this->session->userdata['logged_in'])) {          header("location:".base_url()."admin/user_authentication/user_login_process");      }   ?>
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
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </head>

    <body class="login">
        <div class="main-login-page accountbg">
            <div class="wrapper-page">
                <div class="card">
                    <div class="card-body">
                        <?php if( get_cookie('dash_sucsess_cokiee') !=''){ ?>
                            <div class="msg success-msg alert alert-success fade in alert-dismissible">
                                <?php   echo get_cookie('dash_sucsess_cokiee');  ?>
                            </div>
                            <?php } ?>
                                <?php if( get_cookie('dash_unsucsess_cokiee') !=''){ ?>
                                    <div class="msg success-msg alert alert-danger fade in alert-dismissible">
                                        <?php   echo get_cookie('dash_unsucsess_cokiee');  ?>
                                    </div>
                                    <?php } ?>
                                        <div class="logo clearfix">
                                            <a href="https://tapouts.online/" title="tapouts">
                                                <h1>tapouts</h1>
                                            </a>
                                        </div>
                                        <div class="register-txt text-right">
                                            <h4 class="font-18 mt-3 m-b-5">Free Register</h4>
                                            <p class="text-muted">Get your free Tapout account now.</p>
                                        </div>
                                        <form action="<?php echo  base_url()?>admin/User_authentication/registration_user_client/" method="post" class="form-horizontal form-label-left input_mask">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" id="f_name" class="form-control" name="f_name" autocomplete="off" required placeholder="First Name"> <span class="fa fa-user form-control-feedback left" aria-hidden="true">*</span> <span><?=form_error('f_name')?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="l_name" id="l_name" autocomplete="off" required placeholder="Last Name"> <span class="fa fa-user form-control-feedback left" aria-hidden="true">*</span> <span><?=form_error('l_name')?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="proj_name" id="proj_name" autocomplete="off" required placeholder="Website Title"> <span class="fa-address-book form-control-feedback left" aria-hidden="true">*</span> <span><?=form_error('proj_name')?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="proj_website" id="proj_website" autocomplete="off" required placeholder="Website Url"> <span class="fa-address-book form-control-feedback left" aria-hidden="true">*</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="email" class="form-control" name="u_email" id="u_email" autocomplete="off" required placeholder="Email"> <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="password" class="form-control has-feedback-left" name="n_password" autocomplete="off" required id="n_password" placeholder="Password Min length 6"> <span class="fa fa-unlock-alt form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="password" class="form-control has-feedback-left" name="c_password" autocomplete="off" required id="c_password" placeholder="Confirm Password"> <span class="fa fa-unlock-alt form-control-feedback left" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                            <?php     echo form_error('g-recaptcha-response');    ?> <b class="captcha_error1 text-danger"></b>
                                                <div id="html_element"></div>
                                                <!-- <div class="form-group col-md-12 clearfix"><button class="btn btn-primary col-md-6" type="button">Registration<i class="fa fa-sign-in"></i></button>   <button type="submit" class="submit1" id="submit" hidden>Login</button></div> -->
                                                <div class="form-group col-md-12">
                                                    <button class="login-btn" type="button" onclick="validate_captcha()">Sign Up</button>
                                                </div>
                                                <button type="submit" class="submit1" id="submit" hidden>Sign Up</button>
                                                <!-- <div class="form-group col-md-12 clearfix"> <button class="btn btn-primary col-md-6" type="submit">Singup</button></div> -->
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <p class="terms-use">By registering you agree to the Tapout Ltd. <a href="https://tapouts.online/cookie-policy/" class="text-primary">Terms of Use</a></p>
                                                    </div>
                                                </div>
                                        </form>
                    </div>
                </div>
                <div class="go-to">
                    <p>Already a member ? &nbsp; <a href="<?php echo base_url(); ?>login/"> Sign In Here </a>
                        <p>
                            <p>Copyright ©
                                <?php echo date('Y')?> Tapout Ltd. All Rights Reserved.
                            </p>
                </div>
            </div>
        </div>
    </body>

    </html>
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>

    <!-- for  loaclhost -->
    <!-- <script type="text/javascript">
        var CaptchaCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey': '<?php echo "6LdltZIUAAAAALRhKjbvZCFTnuJGGH-7GbHGx576" ?>'
            });
        };

        function validate_captcha() {
            var password = $("#n_password").val();
            var confirmPassword = $("#c_password").val();
            var mnlen = "6";
            if (password.length < mnlen) {
                $('.captcha_error1').html('* Min Password Lenght 6');
            } else if (password != confirmPassword) {
                $('.captcha_error1').html('* Passwords do not match!');
            } else if (grecaptcha.getResponse().length == 0) {
                $('.captcha_error1').html('* Please Validate Captcha First');
            } else {
                $('.captcha_error1').html('');
                $('.submit1').click();
            }
        }
        $(document).ready(function() {
            $("#c_password").keyup(checkPasswordMatch);
        });
    </script> -->

    <!-- for online -->
    <script type="text/javascript">
   var CaptchaCallback = function() {
       grecaptcha.render('html_element', {
           'sitekey': '<?php echo "6LdaXcAUAAAAAA8LQNxCE8tf5Xk-rpoOttfz2tkn" ?>'
       });
   };

   function validate_captcha() {
       var password = $("#n_password").val();
       var confirmPassword = $("#c_password").val();
       var mnlen = "6";
       if (password.length < mnlen) {
           $('.captcha_error1').html('* Min Password Lenght 6');
       } else if (password != confirmPassword) {
           $('.captcha_error1').html('* Passwords do not match!');
       } else if (grecaptcha.getResponse().length == 0) {
           $('.captcha_error1').html('* Please Validate Captcha First');
       } else {
           $('.captcha_error1').html('');
           $('.submit1').click();
       }
   }
   $(document).ready(function() {
       $("#c_password").keyup(checkPasswordMatch);
   });
    </script>

