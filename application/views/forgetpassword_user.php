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
        <div class="container">
            <div class="login-wrapper">
                <div class="text-center">
                    <!--<img src="<?php echo base_url(); ?>assets/img/login-logo.png" alt="logo">-->
                    <h1><strong>Production Planner</strong></h1>
                </div><!-- /.logo-wrapper -->

                <div class="panel">
                    <div class="panel-body">
                        <h2>Reset Password</h2>
                        <?php //if (isset($email)) { ?>
                        <!--                            <div class="alert alert-danger fade in">
                                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <?php //echo 'you are not authorized to access this page'; ?>
                                                    </div> -->
                        <form action="<?php echo site_url('login/insertforgotpassword') ?>" method='post' name='forgetpassword' id="identicalForm">
                            <div class="form-group">
                                <div class="input-icon-left">
                                    <i class="fa fa-user input-icon"></i>
                                    <input type="password" name="password" class="form-control rounded" placeholder="Enter Password" required>
                                    <input type="hidden" name="tokan" value="<?php echo $this->uri->segment(3); ?>">
                                </div>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <div class="input-icon-left">
                                    <i class="fa fa-lock input-icon"></i>
                                    <input type="password" name="confirmpassword" class="form-control rounded" placeholder="Enter Confirm Password" required>
                                </div>
                            </div><!-- /.form-group -->

                            <input type="Submit" value="Reset Password" class="btn btn-primary btn-block rounded" />
                        </form>
                        <?php //}  ?>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel -->
            </div>
        </div><!-- /.container -->
        <!-- REQUIRED SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/dist/main/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/main/js/bootstrap.min.js"></script>
        <!-- REQUIRED PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/dist/main/plugins/icheck/js/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/page-login.min.js"></script>
        <script>
            $('#identicalForm').bootstrapValidator({
                framework: 'bootstrap',
                fields: {
                    password: {
                        validators: {
                            identical: {
                                field: 'confirmPassword',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    confirmPassword: {
                        validators: {
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                }
            });
        </script>
    </body>
</html>