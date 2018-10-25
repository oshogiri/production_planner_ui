<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>
<style>th {text-align: center;}</style>

<div class="modal fade" id="modal-startcomment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2>Start Time Punch</h2>
                <form action="<?php echo base_url('schedule/set_actual_time') ?>" method="post" id="startdate_form">
                    <div class="form-group">
                        <label>Start Time</label>
                        <!--<div class="input-icon-left m-top-15">-->
                        <input type="text" name="time" id="starttime" class="form-control" readonly>
                    </div>

                    <input type="hidden" name="punch_type" value="start_time_punch">
                    <input type="hidden" name="uuid" id="start_uuid">
                    <input type="hidden" name="employee_id" value="<?php echo $this->session->userdata('employee_id'); ?>">
                    <!--</div>-->
                    <div class="form-group" id="startselectreasonoption">
                        <label>Select Reason for delay</label>
                        <select class="form-control startselectcommenttype" name="comment_type" data-width="200px">
                            <option value="Test1">Test 1</option>
                            <option value="Test2">test 2</option>
                            <option value="Test3">test 3</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group" id="startcomment">
                        <label>Comment</label>
                        <textarea class="form-control" name="comment" rows="5" form="startdate_form"></textarea>
                    </div><!-- /.form-group -->

                    <div class="btn-wrapper">
                        <input type="reset" value="Cancel" class="btn btn-default rounded" data-dismiss="modal">
                        <div class="pull-right">
                            <input type="submit" id="starttime_button" class="btn btn-success rounded" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<div class="modal fade" id="modal-endcomment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h2>End Time Punch</h2>
                <form action="<?php echo base_url('schedule/set_actual_time') ?>" method="post" id="enddate_form">
                    <div class="form-group">
                        <label>End Time</label>
                        <!--<div class="input-icon-left m-top-15">-->
                        <input type="text" name="time" id="endtime" class="form-control" readonly>
                    </div>
                    <input type="hidden" name="punch_type" value="end_time_punch">
                    <input type="hidden" name="uuid" id="end_uuid">
                    <input type="hidden" name="employee_id" value="<?php echo $this->session->userdata('employee_id'); ?>">
                    <!--</div>-->
                    <div class="form-group" id="endselectreasonoption">
                        <select class="endselectcommenttype" name="comment_type" data-width="200px">
                            <option value="Test1">Test 1</option>
                            <option value="Test2">Test 2</option>
                            <option value="Test3">Test 3</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group" id="endcomment">
                        <label>Comment</label>
                        <!--<div class="input-icon-left m-top-15">-->
                        <textarea class="form-control" name="comment" rows="5" form="enddate_form"></textarea>
                        <!--</div>-->
                    </div><!-- /.form-group -->

                    <div class="btn-wrapper">
                        <input type="reset" value="Cancel" class="btn btn-default rounded" data-dismiss="modal">
                        <div class="pull-right">
                            <input type="submit" id="endtime_button" class="btn btn-success rounded" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<div class="content">
    <div class="page-title-wrapper">
        <h2 class="page-title">View Schedule</h2>
    </div><!-- /.page-titile-wrapper -->

    <div class="panel panel-default-light border-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-eye m-right-5"></i>Schedule: <?php
                if (isset($date)) {
                    echo $date;
                }
                ?>
            </div><!-- /.panel-title -->
            <div class="panel-tools">
                <form class="form-inline">
                    <label>Date: </label>
                    <input type="text" class="form-control time-picker" placeholder="Select Date" readonly>
                </form>
            </div>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <?php if (isset($message)) { ?>
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $message; ?>
                </div>
            <?php } ?>
            <?php if (isset($error_schedule)) { ?>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $error_schedule; ?>
                </div>
            <?php } ?>
            <?php if (!empty($publish)) { ?>
                <ul class="nav nav-tabs underline-tabs success-tabs">
                    <li class="active">
                        <a href="#Stream1" data-toggle="tab">Stream #1</a>
                    </li>
                    <li>
                        <a href="#Stream2" data-toggle="tab">Stream #2</a>
                    </li>
                    <li>
                        <a href="#Stream3" data-toggle="tab">Stream #3</a>
                    </li>
                    <li>
                        <a href="#Stream4" data-toggle="tab">Stream #4</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <?php if (isset($batch_schedules)) { ?>
                        <div class="tab-pane fade in active" id="Stream1">
                            <?php if (isset($batch_schedules->stream_1)) { ?>
                                <?php foreach ($batch_schedules->stream_1 as $batch_schedule) { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7">Plan</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th colspan="4">Actual</th>
                                                <?php } ?>
                                                <th rowspan="2">Delay</th>
                                                <!--<th rowspan="2">Comment</th>-->
                                            </tr>
                                            <tr>
                                                <th>BCT</th>
                                                <th>Reactor</th>
                                                <th>Process</th>
                                                <th>Product</th>
                                                <th>Batch Number</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th>Batch Number</th>
                                                    <th>Reactor</th>    
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <!--<td><?php // echo gmdate("H:i", $schedule->bct); ?></td>-->
                                                    <td><?php echo $schedule->bct; ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></p></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td class="actual_batchnumber" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-batchnumber' : 'none') ?>"><?php echo $schedule->actual_batch_number; ?></td>
                                                    <td class="actual_reactor" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-reactor' : 'none') ?>"><?php echo $schedule->actual_reactor; ?></td>
                                                    <?php $startcomment = $schedule->actual_start_time_comment ?>
                                                    <?php $endcomment = $schedule->actual_end_time_comment ?>
                                                    <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_start_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_start_time)) {
                                                                    ?>
                                                                    <p title="
                                                                    <?php
                                                                    if (!empty($startcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>
                                                                       " 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($startcomment)) {
                                                                           if (!empty($startcomment->category))
                                                                               echo $startcomment->category;
                                                                           if (!empty($startcomment->content))
                                                                               echo ': ' . $startcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>">
                                                                           <?php echo date("d/m/Y H:i", $schedule->actual_start_time); ?>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if (!empty($schedule->is_next)) {
                                                                    if ($schedule->is_next_type == 'start' && $this->session->userdata('role') == 'production') {
                                                                        ?>
                                                                        <input type="text" value="" class="form-control start-time-picker" readonly data-type="start" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planstarttime="<?php echo $schedule->start_time ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_end_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_end_time)) {
                                                                    ?><p title="<?php
                                                                    if (!empty($endcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>" 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($endcomment)) {
                                                                           if (!empty($endcomment->category))
                                                                               echo $endcomment->category;
                                                                           if (!empty($endcomment->content))
                                                                               echo ': ' . $endcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>"><?php echo date("d/m/Y H:i", $schedule->actual_end_time); ?></p><?php
                                                                   }
                                                               } else {
                                                                   if (!empty($schedule->is_next)) {
                                                                       if ($schedule->is_next_type == 'end' && $this->session->userdata('role') == 'production') {
                                                                           ?>
                                                                        <input type="text" value="" class="form-control end-time-picker" readonly data-type="end" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planendtime="<?php echo $schedule->end_time; ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                    <!--<td><?php //echo gmdate("H:i", $schedule->hold_up);                                                                    ?></td>-->
                                                    <td><?php echo sprintf('%02d', floor($schedule->hold_up / 3600)) . gmdate(":i", $schedule->hold_up % 3600); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade in" id="Stream2">
                            <?php if (isset($batch_schedules->stream_2)) { ?>
                                <?php foreach ($batch_schedules->stream_2 as $batch_schedule) { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7">Plan</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th colspan="4">Actual</th>
                                                <?php } ?>
                                                <th rowspan="2">Delay</th>
                                                <!--<th rowspan="2">Comment</th>-->
                                            </tr>
                                            <tr>
                                                <th>BCT</th>
                                                <th>Reactor</th>
                                                <th>Process</th>
                                                <th>Product</th>
                                                <th>Batch Number</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th>Batch Number</th>
                                                    <th>Reactor</th>    
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <!--<td><?php // echo gmdate("H:i", $schedule->bct); ?></td>-->
                                                    <td><?php echo $schedule->bct; ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td class="actual_batchnumber" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-batchnumber' : 'none') ?>"><?php echo $schedule->actual_batch_number; ?></td>
                                                    <td class="actual_reactor" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-reactor' : 'none') ?>"><?php echo $schedule->actual_reactor; ?></td>
                                                    <?php $startcomment = $schedule->actual_start_time_comment ?>
                                                    <?php $endcomment = $schedule->actual_end_time_comment ?>
                                                    <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_start_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_start_time)) {
                                                                    ?>
                                                                    <p title="
                                                                    <?php
                                                                    if (!empty($startcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>
                                                                       " 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($startcomment)) {
                                                                           if (!empty($startcomment->category))
                                                                               echo $startcomment->category;
                                                                           if (!empty($startcomment->content))
                                                                               echo ': ' . $startcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>">
                                                                           <?php echo date("d/m/Y H:i", $schedule->actual_start_time); ?>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if (!empty($schedule->is_next)) {
                                                                    if ($schedule->is_next_type == 'start' && $this->session->userdata('role') == 'production') {
                                                                        ?>
                                                                        <input type="text" value="" class="form-control start-time-picker" readonly data-type="start" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planstarttime="<?php echo $schedule->start_time ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_end_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_end_time)) {
                                                                    ?><p title="<?php
                                                                    if (!empty($endcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>" 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($endcomment)) {
                                                                           if (!empty($endcomment->category))
                                                                               echo $endcomment->category;
                                                                           if (!empty($endcomment->content))
                                                                               echo ': ' . $endcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>"><?php echo date("d/m/Y H:i", $schedule->actual_end_time); ?></p><?php
                                                                   }
                                                               } else {
                                                                   if (!empty($schedule->is_next)) {
                                                                       if ($schedule->is_next_type == 'end' && $this->session->userdata('role') == 'production') {
                                                                           ?>
                                                                        <input type="text" value="" class="form-control end-time-picker" readonly data-type="end" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planendtime="<?php echo $schedule->end_time; ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td><?php echo sprintf('%02d', floor($schedule->hold_up / 3600)) . gmdate(":i", $schedule->hold_up % 3600); ?></td>
                                                    <!--<td><input type="textarea" class="form-control"></td>-->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade in" id="Stream3">
                            <?php if (isset($batch_schedules->stream_3)) { ?>
                                <?php foreach ($batch_schedules->stream_3 as $batch_schedule) { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7">Plan</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th colspan="4">Actual</th>
                                                <?php } ?>
                                                <th rowspan="2">Delay</th>
                                                <!--<th rowspan="2">Comment</th>-->
                                            </tr>
                                            <tr>
                                                <th>BCT</th>
                                                <th>Reactor</th>
                                                <th>Process</th>
                                                <th>Product</th>
                                                <th>Batch Number</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th>Batch Number</th>
                                                    <th>Reactor</th>    
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <!--<td><?php // echo gmdate("H:i", $schedule->bct); ?></td>-->
                                                    <td><?php echo $schedule->bct; ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td class="actual_batchnumber" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-batchnumber' : 'none') ?>"><?php echo $schedule->actual_batch_number; ?></td>
                                                    <td class="actual_reactor" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-reactor' : 'none') ?>"><?php echo $schedule->actual_reactor; ?></td>
                                                    <?php $startcomment = $schedule->actual_start_time_comment ?>
                                                    <?php $endcomment = $schedule->actual_end_time_comment ?>
                                                    <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_start_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_start_time)) {
                                                                    ?>
                                                                    <p title="
                                                                    <?php
                                                                    if (!empty($startcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>
                                                                       " 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($startcomment)) {
                                                                           if (!empty($startcomment->category))
                                                                               echo $startcomment->category;
                                                                           if (!empty($startcomment->content))
                                                                               echo ': ' . $startcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>">
                                                                           <?php echo date("d/m/Y H:i", $schedule->actual_start_time); ?>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if (!empty($schedule->is_next)) {
                                                                    if ($schedule->is_next_type == 'start' && $this->session->userdata('role') == 'production') {
                                                                        ?>
                                                                        <input type="text" value="" class="form-control start-time-picker" readonly data-type="start" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planstarttime="<?php echo $schedule->start_time ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_end_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_end_time)) {
                                                                    ?><p title="<?php
                                                                    if (!empty($endcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>" 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($endcomment)) {
                                                                           if (!empty($endcomment->category))
                                                                               echo $endcomment->category;
                                                                           if (!empty($endcomment->content))
                                                                               echo ': ' . $endcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>"><?php echo date("d/m/Y H:i", $schedule->actual_end_time); ?></p><?php
                                                                   }
                                                               } else {
                                                                   if (!empty($schedule->is_next)) {
                                                                       if ($schedule->is_next_type == 'end' && $this->session->userdata('role') == 'production') {
                                                                           ?>
                                                                        <input type="text" value="" class="form-control end-time-picker" readonly data-type="end" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planendtime="<?php echo $schedule->end_time; ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td><?php echo sprintf('%02d', floor($schedule->hold_up / 3600)) . gmdate(":i", $schedule->hold_up % 3600); ?></td>
                                                    <!--<td><input type="textarea" class="form-control"></td>-->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="tab-pane fade in" id="Stream4">
                            <?php if (isset($batch_schedules->stream_4)) { ?>
                                <?php foreach ($batch_schedules->stream_4 as $batch_schedule) { ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7">Plan</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th colspan="4">Actual</th>
                                                <?php } ?>
                                                <th rowspan="2">Delay</th>
                                                <!--<th rowspan="2">Comment</th>-->
                                            </tr>
                                            <tr>
                                                <th>BCT</th>
                                                <th>Reactor</th>
                                                <th>Process</th>
                                                <th>Product</th>
                                                <th>Batch Number</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                    <th>Batch Number</th>
                                                    <th>Reactor</th>    
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <!--<td><?php // echo gmdate("H:i", $schedule->bct); ?></td>-->
                                                    <td><?php echo $schedule->bct; ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td class="actual_batchnumber" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-batchnumber' : 'none') ?>"><?php echo $schedule->actual_batch_number; ?></td>
                                                    <td class="actual_reactor" data-proname="<?php echo $schedule->product; ?>" data-prouuid="<?php echo $schedule->uuid; ?>" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'production' ? '#modal-actual-reactor' : 'none') ?>"><?php echo $schedule->actual_reactor; ?></td>
                                                    <?php $startcomment = $schedule->actual_start_time_comment ?>
                                                    <?php $endcomment = $schedule->actual_end_time_comment ?>
                                                    <?php if ($this->session->userdata('role') == 'production' || $this->session->userdata('role') == 'planner') { ?>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_start_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_start_time)) {
                                                                    ?>
                                                                    <p title="
                                                                    <?php
                                                                    if (!empty($startcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>
                                                                       " 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($startcomment)) {
                                                                           if (!empty($startcomment->category))
                                                                               echo $startcomment->category;
                                                                           if (!empty($startcomment->content))
                                                                               echo ': ' . $startcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>">
                                                                           <?php echo date("d/m/Y H:i", $schedule->actual_start_time); ?>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if (!empty($schedule->is_next)) {
                                                                    if ($schedule->is_next_type == 'start' && $this->session->userdata('role') == 'production') {
                                                                        ?>
                                                                        <input type="text" value="" class="form-control start-time-picker" readonly data-type="start" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planstarttime="<?php echo $schedule->start_time ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($schedule->actual_end_time) || ($this->session->userdata('role') == 'admin')) {
                                                                if (!empty($schedule->actual_end_time)) {
                                                                    ?><p title="<?php
                                                                    if (!empty($endcomment))
                                                                        echo "Comment";
                                                                    else
                                                                        echo "No Comment";
                                                                    ?>" 
                                                                       data-placement="top" 
                                                                       data-toggle="popover" 
                                                                       data-trigger="hover" 
                                                                       data-content="
                                                                       <?php
                                                                       if (!empty($endcomment)) {
                                                                           if (!empty($endcomment->category))
                                                                               echo $endcomment->category;
                                                                           if (!empty($endcomment->content))
                                                                               echo ': ' . $endcomment->content;
                                                                       } else {
                                                                           echo 'No Comment!';
                                                                       }
                                                                       ?>"><?php echo date("d/m/Y H:i", $schedule->actual_end_time); ?></p><?php
                                                                   }
                                                               } else {
                                                                   if (!empty($schedule->is_next)) {
                                                                       if ($schedule->is_next_type == 'end' && $this->session->userdata('role') == 'production') {
                                                                           ?>
                                                                        <input type="text" value="" class="form-control end-time-picker" readonly data-type="end" data-time="<?php echo $schedule->min_time; ?>" data-uuid="<?php echo $schedule->uuid; ?>" data-planendtime="<?php echo $schedule->end_time; ?>">
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td><?php echo sprintf('%02d', floor($schedule->hold_up / 3600)) . gmdate(":i", $schedule->hold_up % 3600); ?></td>
                                                    <!--<td><input type="textarea" class="form-control"></td>-->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } elseif (isset($error_schedule)) { ?>
                        <div class="alert alert-info fade in">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            <?php echo $error_schedule; ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo 'Schedule not published for this date'; ?>
                </div>
            <?php } ?>
        </div><!-- /.panel-body -->
        <?php if (isset($publish) && $this->session->userdata('role') == 'production') {
                ?>
        <div class="panel-footer">
            <form action="<?php echo site_url('Schedule/Unpublish_batchplan_and_schedule')?>" method="post">
                <input type="submit" value="Change Plan" class="btn btn-info rounded">
            </form>
        </div>
        <?php } ?>

    </div><!--/.panel-->

</div>

<div class="modal fade modal-framed" id="modal-actual-reactor" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Enter reactor</h4>
            </div><!-- .modal-header -->
            <form class="form-m" action="<?php echo site_url('Schedule/set_actual_reactor') ?>" method="post">
                <div class="modal-body">

                    <div class="panel-body">

                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputProduct" class="control-label col-sm-3">Product</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pro-name" disabled>
                                <input type="hidden" id="pro-uuid" name="prod_uuid">
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputReactor" class="control-label col-sm-3">Enter Reactor</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="actual_reactor" id="actual_reactor" required>
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->

                    </div>
                </div><!-- .modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes" />
                </div><!-- .modal-footer -->
            </form>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade modal-framed" id="modal-actual-batchnumber" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Enter Batch Number</h4>
            </div><!-- .modal-header -->
            <form class="form-m" action="<?php echo site_url('Schedule/set_actual_batchnumber') ?>" method="post">
                <div class="modal-body">

                    <div class="panel-body">

                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputProduct" class="control-label col-sm-3">Product</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b-pro-name" disabled>
                                <input type="hidden" id="b-pro-uuid" name="prod_uuid">
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputBatchnumber" class="control-label col-sm-3">Enter Batch Number</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="actual_batchnumber" id="actual_batchnumber" required>
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->

                    </div>
                </div><!-- .modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes" />
                </div><!-- .modal-footer -->
            </form>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require_once 'footer.php'; ?>
<script type="text/javascript">
    $(function () {
<?php if ($this->session->userdata('role') == 'production') { ?>
            $('.start-time-picker').datetimepicker({minuteStep: 1});
            $('.end-time-picker').datetimepicker({minuteStep: 1});
<?php } ?>

        function validate_punch(picker) {
            console.log('called');
            var picker_min_time = picker.data('time');
            if (picker_min_time == 0) {
                return true;
                console.log('true');
            } else {
                var picker_time = new Date(picker.val());
                var min_time = new Date(1970, 0, 1);
                min_time.setSeconds(picker_min_time + ((5 * 60) + 30) * 60);

                console.log(picker_time);
                console.log(min_time);

                if (picker_time < min_time) {
                    alert('Minimum allowed time is ' + min_time);
                    console.log('false');
                    return false;
                } else {
                    console.log('true 2');
                    return true;
                }
            }
        }

        $('.start-time-picker').change(function () {
            var picker = $(this);
            //alert(new Date($(this).val()).getTime()/1000 + " --- " + picker.data('planstarttime') + "Diff - "+((new Date($(this).val()).getTime()/1000)-picker.data('planstarttime')) );

            var difftime = (new Date($(this).val()).getTime() / 1000) - picker.data('planstarttime');
            //alert(difftime);
            //$('#delaytime').val(difftime);
            if (difftime === 0) {
                $('#startselectreasonoption').hide();
                $('#startcomment').hide();
            } else {
                $('#startselectreasonoption').show();
            }

            if (validate_punch(picker)) {
                $('#starttime').val($(this).val());
                $('#start_uuid').val($(this).data('uuid'));
                $('#modal-startcomment').modal('show');
                $('#modal-startcomment').on('hidden.bs.modal', function () {
                    picker.val('');
                });
            } else {
                picker.val('');
            }
        });

        $('.end-time-picker').change(function () {
            var picker = $(this);

            var difftime = (new Date($(this).val()).getTime() / 1000) - picker.data('planendtime');
            //alert(difftime);
            //$('#delaytime').val(difftime);
            if (difftime === 0) {
                $('#endselectreasonoption').hide();
                $('#endcomment').hide();
            } else {
                $('#endselectreasonoption').show();
            }

            if (validate_punch(picker)) {
                $('#endtime').val($(this).val());
                $('#end_uuid').val($(this).data('uuid'));
                $('#modal-endcomment').modal('show');
                $('#modal-endcomment').on('hidden.bs.modal', function () {
                    picker.val('');
                });
            } else {
                picker.val('');
            }
        });

        $('#startcomment').hide();
        $('#endcomment').hide();
        $("select.startselectcommenttype").change(function () {
            var selectedselectcommenttype = $(".startselectcommenttype option:selected").val();
            //alert("You have selected the reason - " + selectedselectcommenttype);
            if (selectedselectcommenttype === 'Other') {
                $('textarea').prop('required', true);
                $('#startcomment').show();
            } else {
                $('textarea').prop('required', false);
                $('#startcomment').hide();
            }
        });
        $("select.endselectcommenttype").change(function () {
            var selectedselectcommenttype = $(".endselectcommenttype option:selected").val();
            //alert("You have selected the reason - " + selectedselectcommenttype);
            if (selectedselectcommenttype === 'Other') {
                $('textarea').prop('required', true);
                $('#endcomment').show();
            } else {
                $('textarea').prop('required', false);
                $('#endcomment').hide();
            }
        });

        $('.time-picker').datepicker({
            format: 'dd M yyyy',
            endDate: new Date()
        }).datepicker('update', new Date('<?php echo $date; ?>'));

        $('.actual_reactor').click(function () {
            var proname = $(this).data("proname");
            var prouuid = $(this).data("prouuid");

            $('#pro-name').val(proname);
            $('#pro-uuid').val(prouuid);
        });

        $('.actual_batchnumber').click(function () {
            var proname = $(this).data("proname");
            var prouuid = $(this).data("prouuid");

            $('#b-pro-name').val(proname);
            $('#b-pro-uuid').val(prouuid);
        });
    });

    $(document).on('changeDate', '.time-picker', function () {
        date = new Date($(this).val()).getTime() / 1000;
        if ($.isNumeric(date))
            location = location.protocol + "//" + location.host + location.pathname + "?date=" + date;
    });
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });


</script>