<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .table-scroll .fixed-column {
        position: absolute;
        display: inline-block;
        width: auto;
        border-right: 1px solid #ddd;
        background-color: #ddd;
        font-size: 9px;
    }
    .table{font-size: 9px;}

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
                <i class="fa fa-list-alt m-right-5"></i>Batch Plan: <?php
                if (isset($month)) {
                    echo $month;
                }
                ?> 
            </div><!-- /.panel-title -->
            <div class="panel-tools">
                <input type="text" class="form-control time-picker" placeholder="Select Month" readonly>
            </div>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-scroll">
                <table class="table table-bordered table-striped table-condensed">
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
//                            $date_header_array = date_range(date("Y-m-01"), date("Y-m-t"), '+1 day', 'j M y');
//                            echo "<pre>";print_r($date_header_array);exit;

                            foreach ($date_header_array as $d => $date_val) {
                                ?><th><?php echo $date_val; ?></th><?php
                                }
                                ?>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if (isset($inventories) && isset($batch_plans)) {
                            foreach ($inventories as $inventory) {
                                if ($inventory->stream == 'Stream 1') {
                                    ?>
                                    <tr>
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
                                        //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                        foreach ($date_header_array as $d => $date_val) {
                                            if (isset($batch_data_array['Stream 1'][$inventory->product][$date_val])) {
                                                if ($batch_data_array['Stream 1'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                    ?><td><strong><?php echo $batch_data_array['Stream 1'][$inventory->product][$date_val]['number_of_batches']; ?></strong></td><?php
                                                } else {
                                                    ?><td></td><?php
                                                }
                                            } else {
                                                ?><td>NIL</td><?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($inventory->stream == 'Stream 2') {
                                    ?>
                                    <tr>
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
                                        //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                        foreach ($date_header_array as $d => $date_val) {
                                            if (isset($batch_data_array['Stream 2'][$inventory->product][$date_val])) {
                                                if ($batch_data_array['Stream 2'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                    ?><td><strong><?php echo $batch_data_array['Stream 2'][$inventory->product][$date_val]['number_of_batches']; ?></strong></td><?php
                                                } else {
                                                    ?><td></td><?php
                                                }
                                            } else {
                                                ?><td>NIL</td><?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($inventory->stream == 'Stream 3') {
                                    ?>
                                    <tr>
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
                                        //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                        foreach ($date_header_array as $d => $date_val) {
                                            if (isset($batch_data_array['Stream 3'][$inventory->product][$date_val])) {
                                                if ($batch_data_array['Stream 3'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                    ?><td><strong><?php echo $batch_data_array['Stream 3'][$inventory->product][$date_val]['number_of_batches']; ?></strong></td><?php
                                                } else {
                                                    ?><td></td><?php
                                                }
                                            } else {
                                                ?><td>NIL</td><?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                if ($inventory->stream == 'Stream 4') {
                                    ?>
                                    <tr>
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
                                        //print_r($batch_data_array['Stream 1'][$inventory->product]);exit;
                                        foreach ($date_header_array as $d => $date_val) {
                                            if (isset($batch_data_array['Stream 4'][$inventory->product][$date_val])) {
                                                if ($batch_data_array['Stream 4'][$inventory->product][$date_val]['number_of_batches'] > 0) {
                                                    ?><td><strong><?php echo $batch_data_array['Stream 4'][$inventory->product][$date_val]['number_of_batches']; ?></strong></td><?php
                                                } else {
                                                    ?><td></td><?php
                                                }
                                            } else {
                                                ?><td>NIL</td><?php
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                            }
                        } else {
                            ?>
                        <div class="alert alert-danger">
                            <?Php
                            if (isset($error_message)) {
                                echo $error_message;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div><!-- /.table-scroll -->
        </div>
    </div>

</div>
<?php require_once 'footer.php'; ?>
<script>
    $(function () {
        var $table = $('.table');
        var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');

        //$fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();
        $fixedColumn.find('th:not(:nth-child(1))th:not(:nth-child(2))th:not(:nth-child(3))th:not(:nth-child(4))th:not(:nth-child(5))th:not(:nth-child(6))th:not(:nth-child(7))th:not(:nth-child(8))th:not(:nth-child(9))th:not(:nth-child(10)),td:not(:nth-child(1))td:not(:nth-child(2))td:not(:nth-child(3))td:not(:nth-child(4))td:not(:nth-child(5))td:not(:nth-child(6))td:not(:nth-child(7))td:not(:nth-child(8))td:not(:nth-child(9))td:not(:nth-child(10))').remove();

        $('.time-picker').datepicker({
            format: 'MM yyyy',
            startView: 'months',
            minViewMode: 'months',
            endDate: new Date()
        }).datepicker('update', new Date('<?php echo $month; ?>'));
    });
//    $('#cu1rrentdate').datepicker({format: "MM yyyy"}).datepicker('setDate', 'today');

    $(document).on('changeDate', '.time-picker', function () {
        month = new Date($(this).val()).getTime() / 1000;
        console.log(month);

        if ($.isNumeric(month))
            location = location.protocol + "//" + location.host + location.pathname + "?month=" + month;
    });

</script>
