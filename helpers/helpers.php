<?php
function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach ($errors as $error){
		$display .= '<li class="text-danger">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");

}
function money($number){
 return '&#8369; '.number_format($number,2);

} 
function login($user_id){
	$_SESSION['SBUser'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
	$_SESSION['success_flash'] = 'You are now logged in';
	header('Location: index.php');
	}
function is_logged_in(){
	if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
	return true;
	
	}
return false;
}
function login_error_redirect($url = 'login.php'){
$_SESSION['error_flash'] = 'Log in first to access this page';
header('Location: '.$url);

}
function get_category($child_id){
global $db;
$id = sanitize($child_id);
$sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child'
FROM categories c
INNER JOIN categories p
ON c.parent = p.id
WHERE c.id = '$id'";
$query = $db->query($sql);
$category = mysqli_fetch_assoc($query);
return $category;

}
function login_cus($user_id){
	$_SESSION['SBClient'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE client SET last_login = '$date' WHERE id = '$user_id'");
	$_SESSION['success_flash'] = 'You are now logged in';
	header('Location: cus_index.php');
	}
function login_cus_audit($user_id){
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
	$_SESSION['SBClient'] = $user_id;
	$name = '';
	$user = '';
	global $db;
	$sql = $db->query("SELECT * FROM client WHERE id = '$user_id'");
	$audit = mysqli_fetch_assoc($sql);
	$name = $audit['full_name'];
	$user = $audit['user_id'];
	$date1 = date("Y-m-d H:i:s");
	$log = 'Logged In';
	$act = array();
	$act[] = array(
	'date' => $date1,
	'act' => $log,
 );
 $act_json = json_encode($act);
	
	$date = date("Y-m-d H:i:s");
	$db->query("INSERT INTO audit_trail (`record_id`,`full_name`,`user_id`,`form_record`,`activity`) VALUES ('$user_id','$name','$user','Customer','$act_json')");
	}
function is_logged_in_cus(){
	if(isset($_SESSION['SBClient']) && $_SESSION['SBClient'] > 0){
	return true;
	
	}
return false;
}
function login_error_redirect_cus($url = 'cus_login.php'){
$_SESSION['error_flash'] = 'Log in first to access this page';
header('Location: '.$url);

}
function login_cus_data($user_id){
	$_SESSION['SBClient'] = $user_id;
	$sqlclient = $db->query("SELECET * FROM client WHERE user_id = '$user_id'");
	$clientsql = mysqli_fetch_assoc($sqlclient);
	}
	
function qtyToArray($string){
$qtyArray = explode(',',$string);
$returnArray = array();
foreach($qtyArray as $quanti){
$s = explode(':',$quanti);
$returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
}
return $returnArray;
}

function qtyToString($qty){
$qtyString = '';
foreach($qty as $quanti){
$qtyString .= $quanti['size'].':'.$quanti['quantity'].',';
}
$trimmed = rtrim($qtyString, ',');
return $trimmed;

}
function fetch_user_ids($user_id){
$_SESSION['SBUser'] = $user_id;
foreach($user_id as $name){
$name = mysqli_real_escape_string($name);
}
$email_result = $db->query("SELECT `id`, `email` FROM users WHERE id = '$user_id'");

$names = array();
while (($row = mysqli_fetch_assoc($email_result)) !== false){
$names[$row['email']] = $row['id'];
}
return $names;
}
function create_convo($user_id, $subject, $body){
$subject = mysqli_real_escape_string(sanitize($subject));
$body = mysqli_real_escape_string(sanitize($body));

$db->query("INSERT INTO `convo` (`convo_sub`) VALUES ('{$subject}')");

$convo_id = mysqli_insert_id();

$convo_mes = $db->query("INSERT INTO `convo_messages` (`convo_id`,`user_id`,`message_date`,`message_text`)
VALUES({$convo_id}, {$_SESSION['SBUser']}, UNIX_TIMESTAMP(), '{$body}')");

$values = array();
$user_id[] = $_SESSION['SBUser'];

foreach ($user_id as $user_ids){
$user_ids = (int) $user_ids;

$values[] = "({$convo_id}, {$user_id}, 0, 0)";

}
$convo_mes = $db->query("INSERT INTO `convo_member` (`convo_id`, `user_id`, `convo_last_view`, `convo_deleted`)
VALUES ".implode(",", $values));

}

?>