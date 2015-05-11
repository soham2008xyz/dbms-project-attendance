<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php $TITLE = "Edit Subject"; ?>
<?php
if(!isset($_GET["id"])) {
    echo "No Section ID defined!";
    die();
}
else {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $stmt = $conn->prepare("CALL edit_section ( :id, :batch, :name )");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT );
        $stmt->bindParam(':batch', $_POST['batch-id'], PDO::PARAM_STR );
        $stmt->bindParam(':name', $_POST['section-name'], PDO::PARAM_STR );
        if( $stmt->execute() ) {
            $updated = true;
            $error = false;
        }
        else {
            $updated = false;
            $error = true;
        }
    }

    $stmt2 = $conn->prepare("SELECT * FROM SECTIONS WHERE SECTION_ID = :id");
    $stmt2->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
    if( !$stmt2->execute() )
        $error = true;
    else
        $section = $stmt2->fetch();
}
?>
<!DOCTYPE html>
<html>
<?php require_once('includes/_head.php'); ?>
<body class="skin-black">
<div class='wrapper'>
    <?php require_once('includes/_header.php'); ?>
    <?php require_once('includes/section/_edit.php'); ?>
    <?php require_once('includes/_footer.php'); ?>
</div>
</body>
</html>
<?php require_once('includes/db-close.php'); ?>
