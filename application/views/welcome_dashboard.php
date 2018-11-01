<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    <div class="page-title-wrapper">
        <h2 class="page-title">Dashboard</h2>
    </div><!-- /.page-titile-wrapper -->
    
    <div class="panel-body">
        <h4>Download User Manual</h4>
        <div class="row">
            <div class="col-sm-2">
                <a href="<?php echo base_url() ?>sample/ProductionPlannermanual.pdf" class="thumbnail" target="_blank">
                    <img src="<?php echo base_url() ?>sample/pdf.png" alt="150x150" data-holder-rendered="true" style="width: 150px; height: 150px;">
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>