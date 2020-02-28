<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in_cus()){
	login_error_redirect_cus();
}
include 'includes/head.php';
include 'includes/navigation.php';

if(isset($_GET['view'])){

if(isset($_GET['view'])){
$cart_id = $_GET['view'];
$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$result = mysqli_fetch_assoc($cartQ);
$items = json_decode($result['items'],true);
}
?>
<div class="col-md-9">
<div class="form-group">
<h1></h1>
<h2 class='text-center'>View Ordered Items</h2>
<hr>
<center><table class='table table-striped'>
<thead><th>Name</th><th>Size</th><th>Quantity</th></thead>
<?php foreach($items as $item){
$product_id = $item['id'];
$productq = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
$product = mysqli_fetch_assoc($productq);
$sarray = explode(',',$product['qty']);
foreach ($sarray as $aray){
$s = explode(':',$aray);
if($s[0] == $item['size']){
$available = $s[1];


}

} ?>
<tbody bgcolor='white'>
<tr>

<td><?=$product['title'];?></td>
<td><?=$item['size'];?></td>
<td><?=$item['quantity'];?></td>

</tr>
</tbody>
<?php } ?>
</table></center>
<?php
}else{
$id = $client_data['user_id'];

$sql = $db->query("SELECT * FROM transaction WHERE user_id = '$id'");

?>
<div class='col-md-12'>
<div class='row'>
<div class='form-group'>
<h2 class='text-center'> Transaction Details</h2>
<hr>
<table class='table table-striped'>
<thead><th>Transac #</th><th>User ID</th><th>Description</th><th>Total</th></thead>
<tbody>
<?php while($get = mysqli_fetch_assoc($sql)): ?>
<tr>
<td><?=$get['cart_id'];?></td>
<td><?=$get['user_id'];?></td>
<td><?=$get['description'];?></td>
<td><?=money($get['total']);?></td>
<td><a href='cus_index.php?view=<?=$get['cart_id'];?>' class='btn btn-success'>View Order(s)</a></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
<?php } ?>

<?php
include 'includes/footer.php';
?>
