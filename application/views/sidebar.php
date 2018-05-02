<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- SIDEBAR STARTS -->
<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="dropdown">
            <a href="<?php echo site_url('dashboard') ?>">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <?php if ($this->session->userdata('role') == 'planner') { ?>
            <li class="title">Planner</li>
            <!--<li class="title">Core Package</li>-->
			<li class="dropdown">
                <a href="<?php echo site_url('DCS_Report') ?>">
                    <i class="fa fa-area-chart"></i>
                    <span>Upload Batch Plan</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_planned_batches') ?>">
                    <i class="fa fa-area-chart"></i>
                    <span>Schedule Batches</span>
                </a>
            </li>
			<li class="dropdown">
                <a href="<?php echo site_url('schedule/get_schedule') ?>">
                    <i class="fa fa-area-chart"></i>
                    <span>View Schedule</span>
                </a>
            </li>
			 
        <?php } else if ($this->session->userdata('role') == 'production') { ?>
            <li class="title">Production</li>
            <!--<li class="title">Core Package</li>-->
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_schedule') ?>">
                    <i class="fa fa-area-chart"></i>
                    <span>View Schedule</span>
                </a>
            </li>
        <?php } else { ?>

            <li class="title">Planner</li>
            <!--<li class="title">Core Package</li>-->
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_planned_batches') ?>">
                    <i class="fa fa-area-chart"></i>
                    <span>Schedule Batches</span>
                </a>
            </li>
			

            <li class="title">Production</li>
            <!--<li class="title">Core Package</li>-->
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_schedule') ?>">
                    <i class="fa fa-area-chart"></i>
                    <span>View Schedule</span>
                </a>
            </li>
        <?php } ?>
        <!--<li class="title">DCS Report</li>-->
        <!--        <li class="dropdown">
                    <a href="#" data-click="prevent">
                        <i class="fa fa-area-chart"></i>
                        <span>DCS Report</span>
                    </a>
                    <ul class="inner-nav">
                        <li>
                            <a href="<?php //echo site_url('dcs_report')       ?>">
                                Upload DCS Report
                            </a>
                        </li>
                    </ul>
                </li>-->
    </ul>
</div>
<!-- SIDEBAR ENDS -->