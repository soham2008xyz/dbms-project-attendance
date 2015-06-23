<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Edit Teacher"; ?>
<?php
  if(!isset($_GET["id"])) {
    echo "No Teacher ID defined!";
    die();
  }
  else {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $stmt = $conn->prepare("CALL edit_teacher ( :id, :code, :name, :email, :phone )");
      $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT );
      $stmt->bindParam(':code', $_POST['teacher-code'], PDO::PARAM_STR );
      $stmt->bindParam(':name', $_POST['teacher-name'], PDO::PARAM_STR );
      $stmt->bindParam(':email', $_POST['teacher-email'], PDO::PARAM_STR );
      $stmt->bindParam(':phone', $_POST['teacher-phone'], PDO::PARAM_STR );
      if( $stmt->execute() ) {
        $updated = true;
        $error = false;
      }
      else {
        $updated = false;
        $error = true;
      }
    }

    $stmt2 = $conn->prepare("SELECT * FROM TEACHERS WHERE TEACHER_ID = :id");
    $stmt2->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
    if( !$stmt2->execute() )
      $error = true;
    else
      $teacher = $stmt2->fetch();
  }
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
        <div class='wrapper'>
<?php require_once('includes/_header.php'); ?>
<?php require_once('includes/teacher/_edit.php'); ?>
<?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
