<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Add Student"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("CALL add_schedule ( :subject, :teacher, :section, :weekday, :period )");
    $stmt->bindParam(':subject', $_POST['subject-id'], PDO::PARAM_STR );
    $stmt->bindParam(':teacher', $_POST['teacher-id'], PDO::PARAM_STR );
    $stmt->bindParam(':section', $_POST['section-id'], PDO::PARAM_STR );
    $stmt->bindParam(':weekday', $_POST['weekday'], PDO::PARAM_STR );
    $stmt->bindParam(':period', $_POST['period'], PDO::PARAM_INT );
    if( $stmt->execute() ) {
      $updated = true;
      $error = false;
    }
    else {
      $updated = false;
      $error = true;
    }
  }
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
        <div class='wrapper'>
<?php require_once('includes/_header.php'); ?>
<?php require_once('includes/schedule/_add.php'); ?>
<?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
