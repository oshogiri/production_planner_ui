<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    <div class="page-title-wrapper">
        <h2 class="page-title">Report</h2>
    </div><!-- /.page-titile-wrapper -->

    <div class="panel panel-default-light border-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-list-ol m-right-5"></i> Search by Batch number
            </div><!-- /.panel-title -->
        </div><!-- /.panel-heading -->

        <div class="panel-body">
            <!--            <div class="col-lg-4">
            <?php // if (isset($inventories)) { ?>
                                <div class="form-group" id="product_select_i">
                                    <select id="productName" name="product_select" data-width="200px">
            <?php // foreach ($inventories as $inventory) { ?>
                                            <option value="<?php // echo $inventory->product;   ?>"><?php // echo $inventory->product;   ?></option>
            <?php // } ?>
                                    </select>
                                </div>
            <?php // } ?>
                        </div>-->
            <!--<div class="col-lg-3"><h4>Search by batch number:</h4></div>-->
            <div class="col-lg-3">
                <?php if (isset($batch_numbers)) { ?>
                    <div class="form-group" id="product_select_i">
                        <select id="productBatchNumber" class="product_select_c" name="product_select" data-width="200px">
                            <?php foreach ($batch_numbers as $batch_number) { ?>
                                <option value='<?php echo $batch_number->batch_number; ?>'><?php echo $batch_number->batch_number; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } ?>
            </div>
            
            <div class="col-lg-2"><button type="button" class="btn btn-default" onclick="window.location.reload()">Search</button></div>

            <div id="search-table" class="table-scroll">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th rowspan="2">Sr. No.</th>
                            <!--<th rowspan="2">Reactor</th>-->
                            <th rowspan="2" >Process</th>
                            <th rowspan="2" >Product</th>
                            <th rowspan="2" >Batch Number</th>
                            <th colspan="2">Plan</th>
                            <th colspan="2">Actual</th>
                            <th rowspan="2" >Delay</th>
                        </tr>
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($get_batch_plan)) { ?>
                            <?php foreach ($get_batch_plan as $get_batch) { ?>
                                <tr>
                                    <td><?php echo $get_batch['0']; ?></td>
                                    <td><?php echo $get_batch['1']; ?></td>
                                    <td><?php echo $get_batch['2']; ?></td>
                                    <td><?php echo $get_batch['3']; ?></td>
                                    <td><?php echo $get_batch['4']; ?></td>
                                    <td><?php echo $get_batch['5']; ?></td>
                                    <td><?php echo $get_batch['6']; ?></td>
                                    <td><?php echo $get_batch['7']; ?></td>
                                    <td><?php echo $get_batch['8']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>

<script type="text/javascript">
    $(function () {

        $("#productBatchNumber").change(function () {
            var str = "";
            $("#productBatchNumber option:selected").each(function () {
                str += $(this).text();
            });
            $.ajax({
                type: "GET",
                cache: false,
                url: '<?php echo base_url('ReportSearch/get_batch_plan_by_product') ?>?batch_number=' + str,
                data: {'batch_number': str},
                datatype: "json"
            }).done(function (response) {
                console.log(response);
                $.cookie('productBatchNumber', str);
//                window.location = window.location.href;
            });
            console.log(str);
//                $('#productBatchNumber').val($.cookie('productBatchNumber'));
//            $('#productBatchNumber option[value=' + $.cookie('productBatchNumber') + ']').attr("selected", "selected");
        }).trigger('change');

//        $('#productBatchNumber option[value='+$.cookie('productBatchNumber')+']').attr("selected", "selected");
        $('#productBatchNumber').val($.cookie('productBatchNumber')).trigger('change');

    });
</script>