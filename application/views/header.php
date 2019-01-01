<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Product Schedule</title>
        <!-- REQUIRED STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- REQUIRED PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/select2/select2-bootstrap-theme/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-daterangepicker/css/bootstrap-daterangepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-tabdrop/css/tabdrop.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/icheck/css/skins/all.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/datatables/css/dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/flag-css/css/flag-css.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/rippler/css/rippler.min.css" rel="stylesheet" type="text/css">
        <!-- main.min.css - WISEBOARD CORE CSS -->
        <link href="<?php echo base_url(); ?>assets/dist/material/css/main.min.css" rel="stylesheet" type="text/css">
        <!-- plugins.min.css - ALL PLUGINS CUSTOMIZATIONS -->
        <link href="<?php echo base_url(); ?>assets/dist/material/css/plugins.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/main/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- admin.min.css - ADMIN LAYOUT -->
        <link href="<?php echo base_url(); ?>assets/css/admin.min.css" rel="stylesheet" type="text/css">
        <!-- theme-default.min.css - DEFAULT THEME -->
        <link href="<?php echo base_url(); ?>assets/css/theme-default.min.css" rel="stylesheet" type="text/css">
        <!-- Dashboard css -->
        <link href="<?php echo base_url(); ?>assets/css/page-dashboard1.min.css" rel="stylesheet" type="text/css">
        <!--Date Time Picker-->
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-daterangepicker/css/bootstrap-daterangepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/dist/material/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="page-dashboard">

        <!-- TOP NAVIGATION STARTS -->
        <nav class="navbar navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">
                        <!--<img src="<?php echo base_url(); ?>assets/img/schedule_logo.png" alt="logo">-->
                        <strong style="color:#fff">Production Planner</strong>
                    </a>
<!--                    <button type="button" class="sidebar-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>-->
                </div><!-- /.navbar-header -->

                <!--                <form class="navbar-form navbar-left" autocomplete="off">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div> /input-group 
                                </form> /.navbar-form -->

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url(); ?>assets/img/profiledefualt.png" alt="avatar" class="img-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-profile">
                            <li class="dropdown-header">Account Details</li>
                            <li>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?php echo base_url(); ?>assets/img/profiledefualt.png" alt="avatar" class="media-object img-circle">
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading"><?php echo $this->session->userdata('name'); ?></h5>
                                        <p><?php echo $this->session->userdata('email'); ?></p>
                                        <h6 class="media-heading"><strong><?php echo strtoupper($this->session->userdata('role')); ?></strong></h6>
                                    </div>
                                </div><!-- /.media -->
                            </li>

                            <li>
                                <a href="<?php echo site_url('login/logout') ?>">
                                    <i class="fa fa-sign-out"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </li><!-- /.dropdown -->
                </ul><!-- /.navbar-nav -->
            </div>
        </nav>
        <!-- TOP NAVIGATION ENDS -->
        <!-- CONTENT WRAPPER STARTS ( INCLUDES LEFT SIDEBAR AND CONTENT PART OF THE PAGE ) -->
        <div class="content-wrapper">