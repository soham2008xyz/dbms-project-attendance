<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "View All Schedules"; ?>
<?php
  $deleted = false;
  if( isset($_GET["delete"]) ) {
    $sql = "CALL remove_schedule( :id )";
    $stmt = $conn->prepare( $sql );
    $stmt->bindParam(':id', $_GET["delete"], PDO::PARAM_INT );
    if( $stmt->execute() )
      $deleted = true;
  }
  $schedules = $conn->query("SELECT * FROM SCHEDULES
  INNER JOIN SUBJECTS
  ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
  INNER JOIN TEACHERS
  ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID
  INNER JOIN SECTIONS
  ON SCHEDULES.SECTION_ID = SECTIONS.SECTION_ID
  INNER JOIN BATCHES
  ON BATCHES.BATCH_ID = SECTIONS.BATCH_ID");
  if( $schedules ) {
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
<?php require_once('includes/schedule/_list.php'); ?>
<?php require_once('includes/_footer.php'); ?>
        </div>
        <!-- DATA TABES SCRIPT -->
        <script src="<?= $SITE_ROOT ?>../bower_components/AdminLTE/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?= $SITE_ROOT ?>../bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script type="text/javascript">
          $("#schedule-table").dataTable();
          $('[data-title]').tooltip();
        </script>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
