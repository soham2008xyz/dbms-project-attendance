<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Student Routine"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT * FROM SCHEDULES
    INNER JOIN TEACHERS
    ON TEACHERS.TEACHER_ID = SCHEDULES.TEACHER_ID
    INNER JOIN SUBJECTS
    ON SUBJECTS.SUBJECT_ID = SCHEDULES.SUBJECT_ID
    WHERE SECTION_ID = :section
    ORDER BY SCHEDULE_WEEKDAY ASC, SCHEDULE_PERIOD ASC");
    $stmt->bindParam(':section', $_POST['section-id'], PDO::PARAM_STR );
    if( $stmt->execute() ) {
      $updated = true;
      $error = false;
    }
    else {
      $updated = false;
      $error = true;
    }
    $routines = $stmt->fetchAll();
  }
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
        <div class='wrapper'>
<?php require_once('includes/_header.php'); ?>
<?php require_once('includes/student/_routine.php'); ?>
<?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
