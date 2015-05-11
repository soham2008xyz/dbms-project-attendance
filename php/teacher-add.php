<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Add Teacher"; ?>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    /*$stmt = $conn->prepare("INSERT INTO TEACHERS ( teacher_code, teacher_name, teacher_email, teacher_phone ) values ( ?, ?, ?, ? ); ");
    $stmt->bindParam(1, $_POST["teacher-code"], PDO::PARAM_STR);
    $stmt->bindParam(2, $_POST["teacher-name"], PDO::PARAM_STR);
    $stmt->bindParam(3, $_POST["teacher-email"], PDO::PARAM_STR);
    $stmt->bindParam(4, $_POST["teacher-phone"], PDO::PARAM_INT);
    $stmt->execute();
    echo "<pre>";
    var_dump($stmt);
    echo "</pre><br>";
    echo "<pre>";
    var_dump($conn);
    echo "</pre>";
    die();
    */
    $stmt = $conn->prepare("CALL add_teacher ( :code, :name, :email, :phone )");
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
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
        <div class='wrapper'>
<?php require_once('includes/_header.php'); ?>
<?php require_once('includes/teacher/_add.php'); ?>
<?php require_once('includes/_footer.php'); ?>
        </div>
    </body>
</html>
<?php require_once('includes/db-close.php'); ?>
