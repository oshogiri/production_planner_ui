<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Schedule - Register</title>
    <!-- REQUIRED STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/dist/main/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- REQUIRED PLUGINS -->
    <link href="<?php echo base_url(); ?>assets/dist/main/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/dist/main/plugins/icheck/css/skins/all.css" rel="stylesheet" type="text/css">
    <!-- main.min.css - WISEBOARD CORE CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/main/css/main.min.css" rel="stylesheet" type="text/css">
    <!-- Register css -->
    <link href="<?php echo base_url(); ?>assets/css/page-register2.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">
      <div class="register-wrapper">
        <div class="text-center">
          <img src="<?php echo base_url(); ?>assets/img/login-logo.png" alt="logo">
        </div><!-- /.logo-wrapper -->

        <div class="panel">
          <div class="panel-body">
            <h2>Sign Up</h2>
            <form>
              <div class="form-title">
                <span>Personal details</span>
              </div>
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-user input-icon"></i>
                  <input type="text" class="form-control rounded" placeholder="Full Name">
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-envelope input-icon"></i>
                  <input type="text" class="form-control rounded" placeholder="Email">
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-map-marker input-icon"></i>
                  <input type="text" class="form-control rounded" placeholder="Address">
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-map-marker input-icon"></i>
                  <input type="text" class="form-control rounded" placeholder="City">
                </div>
              </div><!-- /.form-group -->

              <div class="form-title">
                <span>Account details</span>
              </div>
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-user input-icon"></i>
                  <input type="text" class="form-control rounded" placeholder="Username">
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-lock input-icon"></i>
                  <input type="password" class="form-control rounded" placeholder="Password">
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <div class="input-icon-left">
                  <i class="fa fa-lock input-icon"></i>
                  <input type="password" class="form-control rounded" placeholder="Re-type your password">
                </div>
              </div><!-- /.form-group -->
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" class="icheck-minimal-grey">
                    Accept the <a href="javascript:;">Terms of Service</a> &amp; <a href="javascript:;">Privacy Policy</a>
                  </label>
                </div>
              </div><!-- /.form-group -->
              <button type="submit" class="btn btn-primary btn-block rounded">SIGN UP</button>
            </form>
          </div><!-- /.panel-body -->

          <div class="panel-footer">
            <a href="<?php echo site_url('login') ?>">HAVE AN ACCOUNT ?</a>
          </div><!-- /.panel-footer -->
        </div><!-- /.panel -->
      </div>
    </div><!--container-->

    <!-- REQUIRED SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/dist/main/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/main/js/bootstrap.min.js"></script>
    <!-- REQUIRED PLUGINS -->
    <script src="<?php echo base_url(); ?>assets/dist/main/plugins/icheck/js/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/page-login.min.js"></script>
  </body>
</html>