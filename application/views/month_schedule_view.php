<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .table-scroll .fixed-column {
        position: absolute;
        display: inline-block;
        width: auto;
        border-right: 1px solid #ddd;
        background-color: #ddd;
        font-size: 10px;
    }
    .table{font-size: 10px;}
    .stream1-color{background-color: #00C851}
    .stream2-color{background-color: #33B5EC}
    .stream3-color{background-color: #ffbb33}
    .stream4-color{background-color: #2BBBAD}
    .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{font-weight: bold !important;padding: 0.5em !important;text-align: center;}

</style>
<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    <div class="page-title-wrapper">
        <h2 class="page-title">Batch Plan</h2>
    </div><!-- /.page-titile-wrapper -->

    <div class="panel panel-default-light border-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-eye m-right-5"></i>Batch Plan: <?php
                if (isset($dispmonth)) {
                    echo $dispmonth;
                }
                ?> 
            </div><!-- /.panel-title -->
            <div class="panel-tools">
                <form class="form-inline">
                    <?php if (isset($inventories) && empty($publish)) { ?>
                        <a href="<?php echo site_url('MonthSchedule/generate_batch_plan'); ?>" class="btn btn-info btn-sm rippler" id="generate_batch_plan_id">
                            <span>
                                Generate Batch Plan
                            </span>
                        </a>
                    <?php } ?>
                    <label>Month: </label>
                    <input type="text" class="form-control time-picker" placeholder="Select Month" readonly>
                </form>
            </div>
        </div><!-- /.panel-heading -->

        <div class="panel-body">
            <?php if (isset($generate_batch_plan)) { ?>
                <div class="alert alert-info">
                    <?php echo $generate_batch_plan; ?>
                </div>
                <?php
            }
            if (isset($error_message)) {
                ?>
                <div class="alert alert-danger">
                    <?php echo $error_message ?>
                </div>
                <?php
            }
            if (isset($batch_plan_message)) {
                ?>
                <div class="alert alert-danger">
                    <?php echo $batch_plan_message ?>
                </div>
                <?php
            }
            if (isset($inventories)) {
                ?>
                <div id="inventory-table" class="table-scroll">
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Demand<br>Quantity<br/>(MT)</th>
                                <th>Inventory<br/>(MT)</th>
                                <th>WIP<br/>(MT)</th>
                                <th>Demand<br/>Inventory<br/>(MT)</th>
                                <th>Batches<br>Required</th>
                                <th>Batches<br>Planed </th>
                                <th>Difference</th>
                                <th>Batch<br>Size<br>(MT)</th>
                                <th>Products</th>
                                <th>Stream</th>
                                <?php
                                if (isset($date_header_array)) {

                                    function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y') {

                                        $dates = array();
                                        $current = strtotime($first);
                                        $last = strtotime($last);

                                        while ($current <= $last) {

                                            $dates[] = date($output_format, $current);
                                            $current = strtotime($step, $current);
                                        }

                                        return $dates;
                                    }

                                    $batch_data_array = array();
                                    if (isset($batch_plans)) {
                                        foreach ($batch_plans as $d => $bp) {
                                            foreach ($bp['daily_plans'] as $x => $d_val) {
                                                $batch_data_array[$bp['stream']][$bp['product']][$d_val['date']] = $d_val;
                                            }
                                        }
                                    }

                                    foreach ($date_header_array as $d => $date_val) {
                                        ?><th><?php echo $date_val; ?></th><?php
                                        }
                                    }
                                    ?>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            foreach ($inventories as $inventory) {
                                if ($inventory->stream == 'Stream 1') {
                                    ?>
                                    <tr class="stream1-color">
                                        <td><?php echo $inventory->demand_quantity; ?></td>
                                        <td><?php echo $inventory->inventory_quantity; ?></td>
                                        <td><?php echo $inventory->wip_quantity; ?></td>
                                        <td><?php echo $inventory->demand_inventory; ?></td>
                                        <td><?php echo $inventory->batches_required; ?></td>
                                        <td><?php echo $inventory->batches_planned; ?></td>
                                        <td><?php echo $inventory->difference; ?></td>
                                        <td><?php echo $inventory->batch_size; ?></td>
                                        <td><?php echo $inventory->product; ?></td>
                                        <td>1</td>

                                        <?php
                                        if (isset($date_header_array)) {
                                            //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                            foreach ($date_header_array as $d => $date_val) {
                                                if (isset($batch_data_array['Stream 1'][$inventory->product][$date_val])) {
                                                    if ($batch_data_array['Stream 1'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                        ?><td><?php echo $batch_data_array['Stream 1'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td></td><?php
                                                    }
                                                } else {
                                                    ?><td>NIL</td><?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($inventory->stream == 'Stream 2') {
                                    ?>
                                    <tr class="stream2-color">
                                        <td><?php echo $inventory->demand_quantity; ?></td>
                                        <td><?php echo $inventory->inventory_quantity; ?></td>
                                        <td><?php echo $inventory->wip_quantity; ?></td>
                                        <td><?php echo $inventory->demand_inventory; ?></td>
                                        <td><?php echo $inventory->batches_required; ?></td>
                                        <td><?php echo $inventory->batches_planned; ?></td>
                                        <td><?php echo $inventory->difference; ?></td>
                                        <td><?php echo $inventory->batch_size; ?></td>
                                        <td><?php echo $inventory->product; ?></td>
                                        <td>2</td>
                                        <?php
                                        if (isset($date_header_array)) {
                                            //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                            foreach ($date_header_array as $d => $date_val) {
                                                if (isset($batch_data_array['Stream 2'][$inventory->product][$date_val])) {
                                                    if ($batch_data_array['Stream 2'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                        ?><td><?php echo $batch_data_array['Stream 2'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td></td><?php
                                                    }
                                                } else {
                                                    ?><td>NIL</td><?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($inventory->stream == 'Stream 3') {
                                    ?>
                                    <tr class="stream3-color">
                                        <td><?php echo $inventory->demand_quantity; ?></td>
                                        <td><?php echo $inventory->inventory_quantity; ?></td>
                                        <td><?php echo $inventory->wip_quantity; ?></td>
                                        <td><?php echo $inventory->demand_inventory; ?></td>
                                        <td><?php echo $inventory->batches_required; ?></td>
                                        <td><?php echo $inventory->batches_planned; ?></td>
                                        <td><?php echo $inventory->difference; ?></td>
                                        <td><?php echo $inventory->batch_size; ?></td>
                                        <td><?php echo $inventory->product; ?></td>
                                        <td>3</td>
                                        <?php
                                        if (isset($date_header_array)) {
                                            //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                            foreach ($date_header_array as $d => $date_val) {
                                                if (isset($batch_data_array['Stream 3'][$inventory->product][$date_val])) {
                                                    if ($batch_data_array['Stream 3'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                        ?><td><?php echo $batch_data_array['Stream 3'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td></td><?php
                                                    }
                                                } else {
                                                    ?><td>NIL</td><?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($inventory->stream == 'Stream 4') {
                                    ?>
                                    <tr class="stream4-color">
                                        <td><?php echo $inventory->demand_quantity; ?></td>
                                        <td><?php echo $inventory->inventory_quantity; ?></td>
                                        <td><?php echo $inventory->wip_quantity; ?></td>
                                        <td><?php echo $inventory->demand_inventory; ?></td>
                                        <td><?php echo $inventory->batches_required; ?></td>
                                        <td><?php echo $inventory->batches_planned; ?></td>
                                        <td><?php echo $inventory->difference; ?></td>
                                        <td><?php echo $inventory->batch_size; ?></td>
                                        <td><?php echo $inventory->product; ?></td>
                                        <td>4</td>
                                        <?php
                                        if (isset($date_header_array)) {
                                            //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                            foreach ($date_header_array as $d => $date_val) {
                                                if (isset($batch_data_array['Stream 4'][$inventory->product][$date_val])) {
                                                    if ($batch_data_array['Stream 4'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                        ?><td><?php echo $batch_data_array['Stream 4'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td></td><?php
                                                    }
                                                } else {
                                                    ?><td>NIL</td><?php
                                                }
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.table-scroll -->
            <?php } ?>
        </div>
        <div id="publish-schedule-section" class="panel-footer">
            <?php
            if (isset($publish)) {
                if (empty($publish)) {
                    ?>
                    <button type="button" class="btn btn-info rounded" id="publish_seq">Publish</button>
                    <?php
                } else {
                    ?>
                    <button type="button" class="btn btn-info rounded" id="unpublish_seq">Unpublish</button>
                    <?php
                }
            }
            ?>
        </div>
    </div>

</div>
<?php require_once 'footer.php'; ?>
<script>
    $(document).ready(function () {
        setTimeout(function () {
            $.ajax({
                url: '<?php echo base_url('MonthSchedule/generate_is_success') ?>',
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
                console.log(response);
                if ($('#inventory-table').length == 0 || !response['success']) {
                    //location = location.protocol + "//" + location.host + location.pathname;
                    location.reload();
                }
            });
        }, 10000);
    });

    $(function () {
<?php if (isset($date_header_array)) { ?>
            var $table = $('.table');
            var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');
            $fixedColumn.find('th:not(:nth-child(1))th:not(:nth-child(2))th:not(:nth-child(3))th:not(:nth-child(4))th:not(:nth-child(5))th:not(:nth-child(6))th:not(:nth-child(7))th:not(:nth-child(8))th:not(:nth-child(9))th:not(:nth-child(10)),td:not(:nth-child(1))td:not(:nth-child(2))td:not(:nth-child(3))td:not(:nth-child(4))td:not(:nth-child(5))td:not(:nth-child(6))td:not(:nth-child(7))td:not(:nth-child(8))td:not(:nth-child(9))td:not(:nth-child(10))').remove();
<?php } ?>
        $('.time-picker').datepicker({
            format: 'MM yyyy',
            startView: 'months',
            minViewMode: 'months',
            startDate: new Date(2018, 0),
            endDate: new Date()
        }).datepicker('update', new Date('<?php echo $month; ?>'));

        $('#publish_seq').click(function () {
            $.ajax({
                url: '<?php echo base_url('MonthSchedule/Publish_batchplan') ?>',
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
//                $('#publish_seq').hide();
                console.log(response['message']);
                $('#publish-schedule-section').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><p class="pull-left">' + response['message'] + '</p></div>');
            });
        });
        $('#unpublish_seq').click(function () {
            $.ajax({
                url: '<?php echo base_url('MonthSchedule/Unpublish_batchplan') ?>',
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
//                $('#unpublish_seq').hide();
                console.log(response['message']);
                $('#publish-schedule-section').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><p class="pull-left">' + response['message'] + '</p></div>');
            });
        });


    });
//    $('#cu1rrentdate').datepicker({format: "MM yyyy"}).datepicker('setDate', 'today');

    $(document).on('changeDate', '.time-picker', function () {
        month = $(this).datepicker('getDate').getTime() / 1000;
        console.log($(this).datepicker('getDate'));

        if ($.isNumeric(month))
            location = location.protocol + "//" + location.host + location.pathname + "?month=" + month;
    });

</script>
