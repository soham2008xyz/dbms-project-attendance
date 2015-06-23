<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Save Attendance Records"; ?>
    <!DOCTYPE html>
    <html>
    <?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
    <div class='wrapper'>
        <?php require_once('includes/_header.php'); ?>
        <?php require_once('includes/attendance_records/_save.php'); ?>
        <?php require_once('includes/_footer.php'); ?>
    </div>
    </body>
    </html>
<?php require_once('includes/db-close.php'); ?>