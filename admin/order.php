<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
if(isset($_GET['complete']) && $_GET['complete'] == 1){
$cart_id = sanitize((int)$_GET['cart_id']);
$db->query("UPDATE cart SET shipped = '1', paid = '1' WHERE id = '{$cart_id}'");
$_SESSION['success_flash'] = "The Order has been Complete";
header('Location: index.php');

}

$txn_id = sanitize((int)$_GET['txn']);
$txnQuery = $db->query("SELECT * FROM transaction WHERE id = '{$txn_id}'");
$txn = mysqli_fetch_assoc($txnQuery);
$cart_id = $txn['cart_id'];
$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$cart = mysqli_fetch_assoc($cartQ);
$items = json_decode($cart['items'],true);
$idArray = array();
$products = array();
foreach($items as $item){
$idArray[] = $item['id'];
}
$ids = implode(',',$idArray);
$productQ = $db->query(
"SELECT i.id as 'id', i.title as 'title', c.id as 'cid', c.category as 'child', p.category as 'parent'
FROM products i
LEFT JOIN categories c ON i.categories = c.id
LEFT JOIN categories p ON c.parent = p.id
WHERE i.id IN ({$ids})
");
while($p = mysqli_fetch_assoc($productQ)){
foreach($items as $item){
if($item['id'] == $p['id']){
$x = $item;
continue;
}
}
$products[] = array_merge($x,$p);
}



?>
<h2 class="text-center">Order Details</h2>
<table class="table table-striped table-bordered">
<thead>
<th>Quantity</th>
<th>Title</th>
<th>Category</th>
<th>Size</th>
</thead>
<tbody>
<?php foreach($products as $product): ?>
<tr>
<td><?=$product['quantity'];?></td>
<td><?=$product['title'];?></td>
<td><?=$product['parent'].'~'.$product['child'];?></td>
<td><?=$product['size'];?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="row">
<div class="col-md-6">
<label for="&nbsp;">&nbsp;</label>
<table class="table table-striped table-bordered">
<tbody>
<tr>
<td>Sub Total</td>
<td><?=money($txn['sub_total']);?></td>
</tr>
<tr>
<td>tax</td>
<td><?=money($txn['tax']);?></td>
<tr>
<td>Total</td>
<td><?=money($txn['total']);?></td>
<tr>
<td>Date Oredered</td>
<td><?=$txn['txn_date'];?></td>
</tr>
</tr>
</tr>
</tbody>
</table>
</div>
<div class="col-md-6">
<div class="text-center">
<label for="detailst" >Shipping Address</label>
</div>
<address>
<?=$txn['full_name'];?><br><br>
<?=$txn['address'];?><br><br>
<?=$txn['contact'];?><br><br>
<?=$txn['email'];?><br>
</address>

<div class="pull-right">
<a href="index.php" class="btn btn-default">Cancel</a>
<a href="order.php?complete=1&cart_id=<?=$cart_id;?>" class="btn btn-primary">Complete</a>
</div></div>

<?php
include 'includes/footer.php';
?>