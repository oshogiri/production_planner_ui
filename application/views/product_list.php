<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php require_once 'header.php'; ?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    <?php if (!empty($upload_data)) { ?>
        <ul>
            <?php foreach ($upload_data as $item => $value): ?>
                <li><?php echo $item; ?>: <?php echo $value; ?></li>
            <?php endforeach; ?>
        </ul>

        <a href="<?php echo site_url(); ?>/uploads/<?php $upload_data['file_name'] ?>" download>Download file</a>

        <p><?php echo anchor('DCS_Report', 'Upload Another File!'); ?></p>
    <?php } ?>
</div>

<?php require_once 'footer.php'; ?>