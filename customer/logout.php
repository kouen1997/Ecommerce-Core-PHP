<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
unset($_SESSION['SBClient']);
header('Location: cus_login.php');
$id = '';
$last_id=$db->query("SELECT id FROM `audit_trail` ORDER BY id DESC LIMIT 0 , 1" );
$row=mysqli_fetch_assoc($last_id);

$id = $row['id'];
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE audit_trail SET last_logout = '$date' WHERE id = '$id'");
	
	
?>
