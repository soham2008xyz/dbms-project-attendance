<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "View Attendance Records"; ?>
<?php
$records = $conn->query("SELECT * FROM (SELECT ATTENDANCE_RECORD_DATE, COUNT(ATTENDANCE_RECORD_ID) AS NUM_STUDENTS, ATTENDANCE_RECORDS.SCHEDULE_ID FROM ATTENDANCE_RECORDS
  GROUP BY ATTENDANCE_RECORD_DATE, ATTENDANCE_RECORDS.SCHEDULE_ID) REC
  INNER JOIN SCHEDULES
  ON SCHEDULES.SCHEDULE_ID = REC.SCHEDULE_ID
  INNER JOIN TEACHERS
  ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID
  INNER JOIN SUBJECTS
  ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
  INNER JOIN SECTIONS
  ON SECTIONS.SECTION_ID = SCHEDULES.SECTION_ID
  INNER JOIN BATCHES
  ON BATCHES.BATCH_ID = SECTIONS.BATCH_ID");
if( $records ) {
    $error = false;
}
else {
    $error = true;
}
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
<body class="skin-black">
<!-- DATA TABLES -->
<link href="<?= $SITE_ROOT ?>../bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class='wrapper'>
    <?php require_once('includes/_header.php'); ?>
    <?php require_once('includes/attendance_records/_list.php'); ?>
    <?php require_once('includes/_footer.php'); ?>
</div>
<!-- DATA TABES SCRIPT -->
<script src="<?= $SITE_ROOT ?>../bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= $SITE_ROOT ?>../bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#attendance-records-table").dataTable();
    $('[data-title]').tooltip();
</script>
</body>
</html>
<?php require_once('includes/db-close.php'); ?>
