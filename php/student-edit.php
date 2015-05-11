<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Edit Student"; ?>
<?php
if(!isset($_GET["id"])) {
    echo "No Student ID defined!";
    die();
}
else {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $conn->prepare("CALL edit_student ( :id, :section, :name, :email, :phone, :semester )");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT );
        $stmt->bindParam(':section', $_POST['section-id'], PDO::PARAM_STR );
        $stmt->bindParam(':name', $_POST['student-name'], PDO::PARAM_STR );
        $stmt->bindParam(':email', $_POST['student-email'], PDO::PARAM_INT );
        $stmt->bindParam(':phone', $_POST['student-phone'], PDO::PARAM_STR );
        $stmt->bindParam(':semester', $_POST['semester'], PDO::PARAM_STR );
        if( $stmt->execute() ) {
            $updated = true;
            $error = false;
        }
        else {
            $updated = false;
            $error = true;
        }
    }

    $stmt2 = $conn->prepare("SELECT * FROM STUDENTS WHERE STUDENT_ID = :id");
    $stmt2->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
    if( !$stmt2->execute() )
        $error = true;
    else
        $student = $stmt2->fetch();
}
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
<body class="skin-black">
<div class='wrapper'>
    <?php require_once('includes/_header.php'); ?>
    <?php require_once('includes/student/_edit.php'); ?>
    <?php require_once('includes/_footer.php'); ?>
</div>
</body>
</html>
<?php require_once('includes/db-close.php'); ?>
