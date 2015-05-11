<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Add Batch"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("CALL add_batch ( :year, :stream )");
    $stmt->bindParam(':year', $_POST['batch-year-passout'], PDO::PARAM_STR );
    $stmt->bindParam(':stream', $_POST['batch-stream'], PDO::PARAM_STR );
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
            <?php require_once('includes/batch/_add.php'); ?>
            <?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
