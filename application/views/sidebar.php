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
            <li class="title">Demand Sheet</li>
            <li class="dropdown">
                <a href="<?php echo site_url('DemandSheet') ?>">
                    <i class="fa fa-upload"></i>
                    <span>Upload Demand Sheet</span>
                </a>
            </li>
            <li class="title">Inventory</li>
            <li class="dropdown">
                <a href="<?php echo site_url('Inventory') ?>">
                    <i class="fa fa-upload"></i>
                    <span>Upload Inventory</span>
                </a>
            </li>
            <li class="title">Batch Plan</li>
            <li class="dropdown">
                <a href="<?php echo site_url('DCS_Report') ?>">
                    <i class="fa fa-upload"></i>
                    <span>Upload Batch Plan</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="<?php echo site_url('MonthSchedule/month_schedule') ?>">
                    <i class="fa fa-eye"></i>
                    <span>View Batch Plan</span>
                </a>
            </li>
            <li class="title">Schedule</li>
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_planned_batches') ?>">
                    <i class="fa fa-list-ol"></i>
                    <span>Schedule Batches</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_schedule') ?>">
                    <i class="fa fa-eye"></i>
                    <span>View Schedule</span>
                </a>
            </li>

        <?php } elseif ($this->session->userdata('role') == 'production') { ?>
            <li class="title">Batch Plan</li>
            <li class="dropdown">
                <a href="<?php echo site_url('MonthSchedule/month_schedule') ?>">
                    <i class="fa fa-eye"></i>
                    <span>View Batch Plan</span>
                </a>
            </li>
            <li class="title">Schedule</li>
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_schedule') ?>">
                    <i class="fa fa--eye"></i>
                    <span>View Schedule</span>
                </a>
            </li>

        <?php } elseif ($this->session->userdata('role') == 'marketing') { ?>
            <li class="title">Demand Sheet</li>
            <li class="dropdown">
                <a href="<?php echo site_url('DemandSheet') ?>">
                    <i class="fa fa-upload"></i>
                    <span>Upload Demand Sheet</span>
                </a>
            </li>
            <li class="title">Batch Plan</li>
            <li class="dropdown">
                <a href="<?php echo site_url('MonthSchedule/month_schedule') ?>">
                    <i class="fa fa-eye"></i>
                    <span>View Batch Plan</span>
                </a>
            </li>
            <li class="title">Schedule</li>
            <li class="dropdown">
                <a href="<?php echo site_url('schedule/get_schedule') ?>">
                    <i class="fa fa-eye"></i>
                    <span>View Schedule</span>
                </a>
            </li>
        <?php } ?>

    </ul>
</div>
<!-- SIDEBAR ENDS -->