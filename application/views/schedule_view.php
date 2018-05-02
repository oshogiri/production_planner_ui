<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    <div class="page-title-wrapper">
        <h2 class="page-title">Schedule Batches</h2>
    </div><!-- /.page-titile-wrapper -->

    <div class="panel panel-default-light border-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-table m-right-5"></i> Resequence Batches
            </div><!-- /.panel-title -->
        </div><!-- /.panel-heading -->
        <?php if (isset($message_error)) { ?>
            <div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo $message_error; ?>
            </div>
        <?php } ?>
        <?php if (isset($message_success)) { ?>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php echo $message_success; ?>
            </div>
        <?php } ?>
        <div class="panel-body">
            <ul class="nav nav-tabs underline-tabs success-tabs">
                <li class="active">
                    <a href="#Stream12" data-toggle="tab">Stream 1 & 2</a>
                </li>
                <li>
                    <a href="#Stream34" data-toggle="tab">Stream 3 & 4</a>
                </li>
            </ul>
            <div class="tab-content">
                <?php //echo '<pre>';print_r($get_planned_batches->stream_1_2);die(); ?>
                <?php if (isset($get_planned_batches)) { ?>
                    <div class="tab-pane fade in active" id="Stream12">
                        <?php if (isset($get_planned_batches->stream_1_2)) { ?>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Stream</th>
                                        <th>Product</th>
                                        <th>Batch Number</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable12">
                                    <?php foreach ($get_planned_batches->stream_1_2 as $get_planned_batche) { ?>

                                        <tr id="<?php echo $get_planned_batche->uuid ?>">
                                            <td><?php echo $get_planned_batche->stream ?></td>
                                            <td><?php echo $get_planned_batche->product ?></td>
                                            <td>
                                                <input type="number" class="batch_number_input form-control" value="<?php echo $get_planned_batche->batch_number ?>" data-uuid="<?php echo $get_planned_batche->uuid ?>"/>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade in" id="Stream34">
                        <?php if (isset($get_planned_batches->stream_3_4)) { ?>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th>Stream</th>
                                        <th>Product</th>
                                        <th>Batch Number</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable34">
                                    <?php foreach ($get_planned_batches->stream_3_4 as $get_planned_batche) { ?>
                                        <tr id="<?php echo $get_planned_batche->uuid ?>">
                                            <td><?php echo $get_planned_batche->stream ?></td>
                                            <td><?php echo $get_planned_batche->product ?></td>
                                            <td>
                                                <input type="number" class="batch_number_input form-control" value="<?php echo $get_planned_batche->batch_number ?>" data-uuid="<?php echo $get_planned_batche->uuid ?>"/>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                <?php } elseif (isset($error_batch)) { ?>
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $error_batch; ?>
                    </div>
                <?php } ?>
            </div>
        </div><!-- /.panel-body -->
        <div class="panel-footer">
            <form method="post" id="generate_schedule_form" action="<?php echo site_url('schedule/generate_schedule') ?>">
                <input type="hidden" name="batch_sequence" id="batch_sequence"/>
                <button type="submit" class="btn btn-info rounded" id="submit_seq">Submit</button>
            </form>
        </div>
    </div><!--/.panel-->

    <div class="panel panel-default-light border-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-check-square-o m-right-5"></i> Today's Schedules
            </div><!-- /.panel-title -->
            <!--                    <div class="panel-tools panel-action">
                                    <button class="btn btn-close"></button>
                                    <button class="btn btn-min"></button>
                                    <button class="btn btn-expand"></button>
                                </div> /.panel-tools -->
        </div><!-- /.panel-heading -->

        <div class="panel-body">
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
                            <?php
                            foreach ($batch_schedules->stream_1 as $batch_schedule) {
                                if (!empty($batch_schedule->schedules)) {
                                    ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">BCT</th>
                                                <th rowspan="2">Reactor</th>
                                                <th rowspan="2">Process</th>
                                                <th rowspan="2">Product</th>
                                                <th rowspan="2">Batch Number</th>
                                                <th colspan="2">Plan</th>
                                                <th rowspan="2">Hold Up</th>
                                            </tr>
                                            <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <td><?php echo gmdate("H:i", $schedule->bct); ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td><?php echo gmdate("H:i", $schedule->hold_up); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                    <?php
                                }
                            }
                            ?>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade in" id="Stream2">
                        <?php if (isset($batch_schedules->stream_2)) { ?>
                            <?php
                            foreach ($batch_schedules->stream_2 as $batch_schedule) {
                                if (!empty($batch_schedule->schedules)) {
                                    ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">BCT</th>
                                                <th rowspan="2">Reactor</th>
                                                <th rowspan="2">Process</th>
                                                <th rowspan="2">Product</th>
                                                <th rowspan="2">Batch Number</th>
                                                <th colspan="2">Plan</th>
                                                <th rowspan="2">Hold Up</th>
                                            </tr>
                                            <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <td><?php echo gmdate("H:i", $schedule->bct); ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td><?php echo gmdate("H:i", $schedule->hold_up); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade in" id="Stream3">
                        <?php if (isset($batch_schedules->stream_3)) { ?>
                            <?php
                            foreach ($batch_schedules->stream_3 as $batch_schedule) {
                                if (!empty($batch_schedule->schedules)) {
                                    ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">BCT</th>
                                                <th rowspan="2">Reactor</th>
                                                <th rowspan="2">Process</th>
                                                <th rowspan="2">Product</th>
                                                <th rowspan="2">Batch Number</th>
                                                <th colspan="2">Plan</th>
                                                <th rowspan="2">Hold Up</th>
                                            </tr>
                                            <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <td><?php echo gmdate("H:i", $schedule->bct); ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td><?php echo gmdate("H:i", $schedule->hold_up); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="tab-pane fade in" id="Stream4">
                        <?php if (isset($batch_schedules->stream_4)) { ?>
                            <?php
                            foreach ($batch_schedules->stream_4 as $batch_schedule) {
                                if (!empty($batch_schedule->schedules)) {
                                    ?>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">BCT</th>
                                                <th rowspan="2">Reactor</th>
                                                <th rowspan="2">Process</th>
                                                <th rowspan="2">Product</th>
                                                <th rowspan="2">Batch Number</th>
                                                <th colspan="2">Plan</th>
                                                <th rowspan="2">Hold Up</th>
                                            </tr>
                                            <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $schedules = $batch_schedule->schedules;
                                            foreach ($schedules as $schedule):
                                                ?>
                                                <tr>
                                                    <td><?php echo gmdate("H:i", $schedule->bct); ?></td>
                                                    <td><?php echo $schedule->reactor; ?></td>
                                                    <td><?php echo $schedule->stage; ?></td>
                                                    <td><?php echo $schedule->product; ?></td>
                                                    <td><?php echo $schedule->batch_number; ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->start_time); ?></td>
                                                    <td><?php echo date("d/m/Y H:i", $schedule->end_time); ?></td>
                                                    <td><?php echo gmdate("H:i", $schedule->hold_up); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                <?php } ?>
                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php } elseif (isset($error_schedule)) { ?>
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $error_schedule; ?>
                    </div>
                <?php } ?>
            </div>
        </div><!-- /.panel-body -->
        <?php
        if (isset($publish)) {
            if (empty($publish)) {
                ?>
                <div class="panel-footer">
                    <button type="button" class="btn btn-info rounded" id="publish_seq">Publish</button>
                </div>
                <?php
            }
        }
        ?>
    </div><!--/.panel-->
</div>

<?php require_once 'footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sortable12').sortable({
            axis: 'y'
        });
        $('#sortable34').sortable({
            axis: 'y'
        });

        $('#submit_seq').click(function () {
            var data12 = $('#sortable12').sortable('toArray');
            var data34 = $('#sortable34').sortable('toArray');
            $('#batch_sequence').val(data12.toString() + ',' + data34.toString());
        });

        $('.batch_number_input').change(function () {
            var uuid = $(this).data('uuid');
            var batch_number = $(this).val();
            console.log(batch_number);
            $.ajax({
                url: '<?php echo base_url('schedule/batch_number') ?>',
                data: {
                    uuid: uuid,
                    batch_number: batch_number
                },
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
                console.log(response['message']);
            });
        });

        $('#publish_seq').click(function () {
            $.ajax({
                url: '<?php echo base_url('schedule/publish_schedule') ?>',
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
                $('#publish_seq').hide();
                console.log(response['message']);
            });
        });
    });
</script>