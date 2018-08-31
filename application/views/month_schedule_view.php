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
                    <?php if (isset($inventories) && empty($publish) && $this->session->userdata('role') == 'planner') { ?>
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
            if(isset($get_nobatch_responce)){ ?>
                <div class="alert alert-info">
                    <?php echo $get_nobatch_responce->message; ?>
                    <?php echo $get_addnobatch_responce->message; ?>
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
                    <table class="table table-bordered table-condensed" id="btcount">
                        <thead>
                            <tr class="titlerow">
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
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-batch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-nobatch="<?php echo $batch_data_array['Stream 1'][$inventory->product][$date_val]['number_of_batches']; ?>" data-prouuid="<?php echo $batch_data_array['Stream 1'][$inventory->product][$date_val]['uuid']; ?>"><?php echo $batch_data_array['Stream 1'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-addbatch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-stream="Stream 1"></td><?php
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
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-batch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-nobatch="<?php echo $batch_data_array['Stream 2'][$inventory->product][$date_val]['number_of_batches']; ?>" data-prouuid="<?php echo $batch_data_array['Stream 2'][$inventory->product][$date_val]['uuid']; ?>"><?php echo $batch_data_array['Stream 2'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-addbatch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-stream="Stream 2"></td><?php
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
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-batch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-nobatch="<?php echo $batch_data_array['Stream 3'][$inventory->product][$date_val]['number_of_batches']; ?>" data-prouuid="<?php echo $batch_data_array['Stream 3'][$inventory->product][$date_val]['uuid']; ?>"><?php echo $batch_data_array['Stream 3'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-addbatch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-stream="Stream 3"></td><?php
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
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-batch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-nobatch="<?php echo $batch_data_array['Stream 4'][$inventory->product][$date_val]['number_of_batches']; ?>" data-prouuid="<?php echo $batch_data_array['Stream 4'][$inventory->product][$date_val]['uuid']; ?>"><?php echo $batch_data_array['Stream 4'][$inventory->product][$date_val]['number_of_batches']; ?></td><?php
                                                    } else {
                                                        ?><td class="total" data-toggle="modal" data-target="<?php echo ($this->session->userdata('role') == 'planner'? '#modal-addbatch-plan':'none') ?>" data-prodate="<?php echo $date_val; ?>" data-proname="<?php echo $inventory->product; ?>" data-stream="Stream 4"></td><?php
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
                            <tr class="totalColumn">
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td style="visibility: hidden;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.table-scroll -->
            <?php } ?>
        </div>
        <div id="publish-schedule-section" class="panel-footer">
            <?php
            if (isset($publish) && $this->session->userdata('role') == 'planner') {
                if (empty($publish)) {
                    ?>
                    <button type="button" class="btn btn-info rounded" id="publish_seq" onclick="this.disabled=true; $(this).text('Publishing...');">Publish</button>
                    <?php
                } else {
                    ?>
                    <button type="button" class="btn btn-info rounded" id="unpublish_seq" onclick="this.disabled=true; $(this).text('Unpublishing...');">Unpublish</button>
                    <?php
                }
            }
            ?>
        </div>
    </div>

</div>

<div class="modal fade modal-framed" id="modal-batch-plan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Edit Batch Entry</h4>
            </div><!-- .modal-header -->
            <form class="form-m" action="<?php echo site_url('MonthSchedule/updateNoBatch') ?>" method="post">
                <div class="modal-body">

                    <div class="panel-body">

                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputProduct" class="control-label col-sm-3">Product</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pro-name" disabled>
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputDate" class="control-label col-sm-3">Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pro-date" disabled>
                                <input type="hidden" id="pro-uuid" name="prod_uuid">
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputNoBatch" class="control-label col-sm-3">No. Batch(s)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="prod_batch" id="pro-batch" min="1" max="5">
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

<div class="modal fade modal-framed" id="modal-addbatch-plan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Add Batch Entry</h4>
            </div><!-- .modal-header -->
            <form class="form-m" action="<?php echo site_url('MonthSchedule/addNoBatch') ?>" method="post">
                <div class="modal-body">

                    <div class="panel-body">

                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputProduct" class="control-label col-sm-3">Product</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addproname" id="addpro-name" readonly>
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputDate" class="control-label col-sm-3">Date</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addprodate" id="addpro-date" readonly>
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputDate" class="control-label col-sm-3">Stream</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="addstream" id="addstream" readonly>
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->
                        <div class="form-group m-bottom-30 form-group-primary">
                            <label for="inputNoBatch" class="control-label col-sm-3">No. Batch(s)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="prod_batch" id="addpro-batch" min="1" max="5">
                                <span class="line"></span>
                            </div>
                        </div><!-- /.form-group -->

                    </div>
                </div><!-- .modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </div><!-- .modal-footer -->
            </form>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php require_once 'footer.php'; ?>
<script>
    $(document).ready(function () {
        //setTimeout(function () {
        $.ajax({
            url: '<?php echo base_url('MonthSchedule/generate_is_success') ?>',
            method: 'POST',
            dataType: 'json'
        }).done(function (response) {
            console.log(response);
            //if ($('#inventory-table').length == 0 || !response['success']) {
            //location = location.protocol + "//" + location.host + location.pathname;
            //location.reload();
            //}
        });
        //}, 20000);
    });

    $(function () {
<?php if (isset($date_header_array)) { ?>
            var $table = $('.table');
            var $fixedColumn = $table.clone().insertBefore($table).addClass('fixed-column');
            $fixedColumn.find('th:not(:nth-child(1))th:not(:nth-child(2))th:not(:nth-child(3))th:not(:nth-child(4))th:not(:nth-child(5))th:not(:nth-child(6))th:not(:nth-child(7))th:not(:nth-child(8))th:not(:nth-child(9))th:not(:nth-child(10)),td:not(:nth-child(1))td:not(:nth-child(2))td:not(:nth-child(3))td:not(:nth-child(4))td:not(:nth-child(5))td:not(:nth-child(6))td:not(:nth-child(7))td:not(:nth-child(8))td:not(:nth-child(9))td:not(:nth-child(10))').remove();
            $fixedColumn.find('tr:last').remove();

            $(document).ready(function ()
            {
                $('table thead th').each(function (i)
                {
                    calculateColumn(i);
                });
            });

            function calculateColumn(index)
            {
                var total = 0;
                $('#btcount tr').each(function ()
                {
                    var value = parseInt($('td', this).eq(index).text());
                    if (!isNaN(value))
                    {
                        total += value;
                    }
                });

                $('table .totalColumn td').eq(index).text(total);
            }

            $('.total').click(function () {
                var proname = $(this).data("proname");
                var nobatch = $(this).data("nobatch");
                var prodate = $(this).data("prodate");
                var prouuid = $(this).data("prouuid");
                
                var addproname = $(this).data("proname");
                var addprodate = $(this).data("prodate");
                var stream = $(this).data("stream");
                
                $('#pro-name').val(proname);
                $('#pro-batch').val(nobatch);
                $('#pro-date').val(prodate);
                $('#pro-uuid').val(prouuid);
                
                $('#addpro-name').val(addproname);
                $('#addpro-date').val(addprodate);
                $('#addstream').val(stream);
            });


<?php } ?>
        $('.time-picker').datepicker({
            format: 'MM yyyy',
            startView: 'months',
            minViewMode: 'months',
            startDate: new Date(2018, 0),
//            endDate: new Date()
        }).datepicker('update', new Date('<?php echo $month; ?>'));

        $('#publish_seq').click(function () {
            $.ajax({
                url: '<?php echo base_url('MonthSchedule/Publish_batchplan') ?>',
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
//                $('#publish_seq').hide();
                console.log(response['message']);
                window.location = window.location.href;
//                $('#publish-schedule-section').html('<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><p class="pull-left">' + response['message'] + '</p></div>');
            });
        });
        $('#unpublish_seq').click(function () {
            $.ajax({
                url: '<?php echo base_url('MonthSchedule/Unpublish_batchplan') ?>',
                method: 'POST',
                dataType: 'json'
            }).done(function (response) {
//                $('#unpublish_seq').hide();
                console.log(response['success']);
                if(response['success'] === "true"){
                    window.location = window.location.href;
                }else{
                    $('#publish-schedule-section').html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><p class="pull-left">' + response['message'] + '</p></div>');
                }
              
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
