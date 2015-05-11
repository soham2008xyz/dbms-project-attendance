<?php
global $conn;

$db = 'oci:dbname=localhost/orcl;charset=CL8MSWIN1251';
$user = 'attendance';
$pass = 'attendance';
try {
	$conn = new PDO($db, $user, $pass);
	// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	die();
}
?>
