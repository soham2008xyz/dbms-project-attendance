<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Add Subject"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("CALL add_subject ( :code, :name )");
    $stmt->bindParam(':code', $_POST['subject-code'], PDO::PARAM_STR );
    $stmt->bindParam(':name', $_POST['subject-name'], PDO::PARAM_STR );
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
            <?php require_once('includes/subject/_add.php'); ?>
            <?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
