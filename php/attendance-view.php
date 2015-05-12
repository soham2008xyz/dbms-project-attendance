<?php require_once('includes/config.php'); ?>
<?php require_once('includes/db-connect.php'); ?>
<?php global $TITLE, $SITE_ROOT, $conn; ?>
<?php
if( !isset($_GET["date"]) || !isset($_GET["schedule"]) ) {
    echo "Invalid data!";
    die();
}
$stmt = $conn->prepare("SELECT ATTENDANCE_RECORDS.STUDENT_ID, STUDENTS.STUDENT_NAME, ATTENDANCE_RECORDS.ATTENDANCE_RECORD_VALUE
FROM ATTENDANCE_RECORDS
INNER JOIN STUDENTS
ON STUDENTS.STUDENT_ID = ATTENDANCE_RECORDS.STUDENT_ID
WHERE ATTENDANCE_RECORD_DATE = :adate
AND SCHEDULE_ID = :schedule");
$stmt->bindValue(":adate", $_GET["date"], PDO::PARAM_STR);
$stmt->bindValue(":schedule", $_GET["schedule"], PDO::PARAM_INT);
if ( $stmt->execute() ) {
    $error = false;
} else {
    $error = true;
}
    $students = $stmt->fetchAll();
?>
<?php $TITLE = "View Attendance Records"; ?>
    <!DOCTYPE html>
    <html>
    <?php require_once('includes/_head.php'); ?>
    <body class="skin-black">
    <div class='wrapper'>
        <?php require_once('includes/_header.php'); ?>
        <?php require_once('includes/attendance_records/_view.php'); ?>
        <?php require_once('includes/_footer.php'); ?>
    </div>
    </body>
    </html>
<?php require_once('includes/db-close.php'); ?>