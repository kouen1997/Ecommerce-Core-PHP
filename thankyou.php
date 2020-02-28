<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
 include 'include/head.php';
 include 'include/navigation.php';
 
 $full_name = sanitize($_POST['full_name']);
 $email = sanitize($_POST['email']);
 $address= sanitize($_POST['address']);
 $contact = sanitize($_POST['contact']);
 $user_id = sanitize($_POST['user_id']);
 $tax = sanitize($_POST['tax']);
 $sub_total = sanitize($_POST['sub_total']);
 $total = sanitize($_POST['total']);
 $cart_id = sanitize($_POST['cart_id']);
 $description = sanitize($_POST['description']);
 $charge_amout = number_format($total,2) * 100;
 $metadata = array(
 "cart_id" => $cart_id,
 "tax"     => $tax,
 "sub_total" => $sub_total,
 );
?>
<?php

//inventory adjusting
$itemQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$iresults = mysqli_fetch_assoc($itemQ);
$items = json_decode($iresults['items'],true);
foreach ($items as $item){
$newSizes = array();
$item_id = $item['id'];
$productQ = $db->query("SELECT qty FROM products WHERE id = '{$item_id}'");
$product = mysqli_fetch_assoc($productQ);
$qty = qtyToArray($product['qty']);
foreach($qty as $quanti){
if($quanti['size'] == $item['size']){
	$q = $quanti['quantity'] - $item['quantity'];
	$newSizes[] = array('size' => $quanti['size'],'quantity' => $q);
}else{
$newSizes[] = array('size' => $quanti['size'],'quantity' => $quanti['quantity']);
}
}
$qtyString = qtyToString($newSizes);
$db->query("UPDATE products SET qty = '{$qtyString}' WHERE id = '{$item_id}'");
}
$db->query("INSERT INTO transaction
(cart_id,user_id,full_name,email,address,contact,sub_total,tax,total,description,txn_type)
VALUES
('$cart_id','$user_id','$full_name','$email','$address','$contact','$sub_total','$tax','$total','$description','Cash On Delivery')
");


$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
setcookie(CART_COOKIE,'',1,"/",$domain,false);
?>
<?php
$id = '';
$last_id=$db->query("SELECT id FROM `audit_trail` ORDER BY id DESC LIMIT 0 , 1" );
$row=mysqli_fetch_assoc($last_id);

$id = $row['id'];
$cartQ = $db->query("SELECT activity FROM audit_trail WHERE id = '$id'");
$cart = mysqli_fetch_assoc($cartQ);
echo $cart['activity'];
$new_act = array();
$prev = array();
$prev[] = $cart['activity'];
$date1 = date("Y-m-d H:i:s");
	$log = 'Yey';
	$act = array();
	$act[] = array(
	'date' => $date1,
	'act' => $log,
 );
 
 $new_act = array_merge($prev,$act);
 
 $act_json = json_encode($new_act);
	
	$date = date("Y-m-d H:i:s");
	$result = $db->query("UPDATE audit_trail SET activity = '$act_json' WHERE id = '$id'");
	var_dump($result);
	
?>
<h1 class='text-center text-success'>Thank You for shopping with us!</h1>
<p> Your transaction number is <strong><?=$cart_id;?></strong> </p>

<p>Your order(s) will be ship to the address below!</p>
<address>
	<?=$full_name;?><br>
	<?=$address;?><br>
	<?=$contact;?><br>
	<?=$email;?>

</address>
<?php
include 'include/footer.php';

?>