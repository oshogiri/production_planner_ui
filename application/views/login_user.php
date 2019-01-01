<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product Schedule - Login</title>
        <!-- REQUIRED STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/main/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- REQUIRED PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/dist/main/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/main/plugins/icheck/css/skins/all.css" rel="stylesheet" type="text/css">
        <!-- main.min.css - WISEBOARD CORE CSS -->
        <link href="<?php echo base_url(); ?>assets/dist/main/css/main.min.css" rel="stylesheet" type="text/css">
        <!-- Login css -->
        <link href="<?php echo base_url(); ?>assets/css/page-login2.min.css" rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="modal fade" id="modal-forgotPass" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>Forgot Password?</h2>
                        <form action="<?php echo site_url('login/forgotpassword_sendemail') ?>" method="post" name='forgotpassword'>
                            <div class="form-group">
                                <p>Enter your e-mail address below to reset your password.</p>
                                <div class="input-icon-left m-top-15">
                                    <i class="fa fa-envelope input-icon"></i>
                                    <input type="email" name="forgotemail" class="form-control" placeholder="Enter Email" required>
                                </div>
                            </div><!-- /.form-group -->

                            <div class="btn-wrapper">
                                <span>
                                    <input type="cancel" value="Cancel" class="btn btn-default-outline btn-block rounded" data-dismiss="modal">
                                </span>
                                <span>
                                    <input type="Submit" value="Submit" class="btn btn-primary btn-block rounded" />
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal -->

        <div class="container">
            <div class="login-wrapper">
                <div class="text-center">
                    <!--<img src="<?php // echo base_url();       ?>assets/img/login-logo.png" alt="logo">-->
                    <h1><strong>Production Scheduler</strong></h1>
                </div><!-- /.logo-wrapper -->

                <div class="panel">
                    <div class="panel-body">
                        <h2>Sign in</h2>
                        <?php if (isset($error_message)) { ?>
                            <div class="alert alert-danger fade in">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $error_message; ?>
                            </div> 
                        <?php } elseif (isset($success_message)) { ?>
                            <div class="alert alert-success fade in">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $success_message; ?>
                            </div> 
                        <?php } ?>
                        <form action="<?php echo site_url('login/process') ?>" method='post' name='process'>
                            <div class="form-group">
                                <div class="input-icon-left">
                                    <i class="fa fa-user input-icon"></i>
                                    <input type="email" name="email" class="form-control rounded" placeholder="Enter Email" required>
                                </div>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <div class="input-icon-left">
                                    <i class="fa fa-lock input-icon"></i>
                                    <input type="password" name="password" class="form-control rounded" placeholder="Enter Password" required>
                                </div>
                            </div><!-- /.form-group -->
                            <!--                            <div class="form-group">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" class="icheck-minimal-grey">
                                                                    Remember me
                                                                </label>
                                                            </div>
                                                        </div> /.form-group -->

                            <input type="Submit" value="SIGN IN" class="btn btn-primary btn-block rounded" />
                            <a href="#" class="m-top-5" data-toggle="modal" data-target="#modal-forgotPass">Forgot Password?</a>
                        </form>
                    </div><!-- /.panel-body -->

                    <!--                    <div class="panel-footer">
                                            <a href="<?php //echo site_url('login/register_view')        ?>">CREATE AN ACCOUNT</a>
                                        </div> /.panel-footer -->
                </div><!-- /.panel -->
            </div>
        </div><!-- /.container -->

        <!-- REQUIRED SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/dist/main/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/main/js/bootstrap.min.js"></script>
        <!-- REQUIRED PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/dist/material/plugins/jquery.slimscroll/js/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/material/plugins/jquery.succinct/js/jquery.succinct.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
        <!-- main.min.js - WISEBOARD CORE SCRIPT -->
        <script src="<?php echo base_url(); ?>assets/dist/material/js/main.min.js"></script>
        <!-- admin.min.js - GENERAL CONFIGURATION SCRIPT FOR THE PAGES -->
        <script src="<?php echo base_url(); ?>assets/js/admin.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/dist/main/plugins/icheck/js/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/page-login.min.js"></script>
    </body>
</html>