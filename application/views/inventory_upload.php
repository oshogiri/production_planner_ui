<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    
    <div class="page-title-wrapper">
        <h2 class="page-title">Inventory</h2>
    </div><!-- /.page-titile-wrapper -->

    <!--<div class="row">-->
    <!--<div class="col-sm-12">-->
    <div class="panel panel-default-light border-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-upload m-right-5"></i> Upload
            </div><!-- /.panel-title -->
            <div class="panel-tools">
                <a href="<?php echo base_url() . 'sample/inventory.xlsx' ?>" class="btn btn-info btn-sm" download>
                    <span>
                        <i class="fa fa-download"></i>
                        Download Sample Inventory File
                    </span>
                </a>
            </div>
        </div><!-- /.panel-heading -->

        <div class="panel-body">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <?php if (isset($fail_message)) { ?>
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $fail_message; ?>

                    <?php
                    if (isset($success_errors)) {
                        ?>

                        <ul>
                            <?php
                            foreach ($success_errors as $success_error) {
                                ?>
                                <li>
                                    <?php
                                    echo $success_error;
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>

                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            if (isset($success_message)) {
                ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <?php echo $success_message; ?>
                </div>
            <?php } ?> 
            <?php echo form_open_multipart('Inventory/upload_inventory'); ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <form method="post" action="<?php echo site_url('Inventory/inventory_file_upload') ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new input-group rounded" data-provides="fileinput">
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">Select file</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="file" required>
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <!-- /.form-group -->
                                        </div><!-- /.fileinput -->
                                        <div class="form-group">
                                            <input type="submit" name="btnUpload" class="btn btn-info rounded" value="Submit" />
                                            <input type="reset" class="btn btn-default rounded" value="Reset">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.panel-body -->
    </div><!--/.panel-->
    <!--</div> /.col-sm-12 -->
    <!--</div> /.row -->
</div>

<?php require_once 'footer.php'; ?>