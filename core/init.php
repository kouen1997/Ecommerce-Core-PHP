<?php
$db = mysqli_connect('127.0.0.1','root','','ejv_db');
if(mysqli_connect_errno()){
echo 'Database connection failed' .mysqli_connect_error();
die();

}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/config.php';
require_once BASEURL.'helpers/helpers.php';

$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
$cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

if(isset($_SESSION['SBUser'])){
$user_id = $_SESSION['SBUser'];
$query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
$user_data = mysqli_fetch_assoc($query);
$name = $user_data['full_name'];

}
if(isset($_SESSION['success_flash'])){
echo '<div class="bg-success"><p class="text-center text-success">'.$_SESSION['success_flash'].'</p></div>';
unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
echo '<div class="bg-danger"><p class="text-center text-danger">'.$_SESSION['error_flash'].'</p></div>';
unset($_SESSION['error_flash']);
}

if(isset($_SESSION['SBClient'])){
$user_id = $_SESSION['SBClient'];
$query = $db->query("SELECT * FROM client WHERE id = '$user_id'");
$client_data = mysqli_fetch_assoc($query);
$name = $client_data['full_name'];

}
?>