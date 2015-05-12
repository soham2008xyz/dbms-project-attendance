<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Add Attendance Records"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT * FROM STUDENTS
    WHERE SECTION_ID IN (
    SELECT SECTION_ID FROM SCHEDULES
    WHERE SCHEDULE_ID = :id
    )");
    $stmt->bindParam(':id', $_POST['schedule-id'], PDO::PARAM_STR );
    if( $stmt->execute() ) {
      $updated = true;
      $error = false;
    }
    else {
      $updated = false;
      $error = true;
    }
      $students = $stmt->fetchAll();
  }
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
        <div class='wrapper'>
<?php require_once('includes/_header.php'); ?>
<?php require_once('includes/attendance_records/_add.php'); ?>
<?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
