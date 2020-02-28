<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in_cus()){
	login_error_redirect_cus();
}
include 'includes/head.php';
include 'includes/navigation.php';

?>
<?php
$id = '';
$last_id=$db->query("SELECT id FROM `audit_trail` ORDER BY id DESC LIMIT 0 , 1" );
$row=mysqli_fetch_assoc($last_id);

$id = $row['id'];
$cartQ = $db->query("SELECT activity FROM audit_trail WHERE id = '$id'");
$result = mysqli_fetch_assoc($cartQ);
$act = $result['activity'];
echo $act;

?>







