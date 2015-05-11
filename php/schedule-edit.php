<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Edit Schdeule"; ?>
<?php
if(!isset($_GET["id"])) {
    echo "No Schedule ID defined!";
    die();
}
else {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $conn->prepare("CALL edit_schedule ( :id, :subject, :teacher, :section, :weekday, :period )");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT );
        $stmt->bindParam(':subject', $_POST['subject-id'], PDO::PARAM_STR );
        $stmt->bindParam(':teacher', $_POST['teacher-id'], PDO::PARAM_STR );
        $stmt->bindParam(':section', $_POST['section-id'], PDO::PARAM_INT );
        $stmt->bindParam(':weekday', $_POST['weekday'], PDO::PARAM_STR );
        $stmt->bindParam(':period', $_POST['period'], PDO::PARAM_STR );
        if( $stmt->execute() ) {
            $updated = true;
            $error = false;
        }
        else {
            $updated = false;
            $error = true;
        }
    }

    $stmt2 = $conn->prepare("SELECT * FROM SCHEDULES WHERE SCHEDULE_ID = :id");
    $stmt2->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
    if( !$stmt2->execute() )
        $error = true;
    else
        $schedule = $stmt2->fetch();
}
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
<body class="skin-black">
<div class='wrapper'>
    <?php require_once('includes/_header.php'); ?>
    <?php require_once('includes/schedule/_edit.php'); ?>
    <?php require_once('includes/_footer.php'); ?>
</div>
</body>
</html>
<?php require_once('includes/db-close.php'); ?>
