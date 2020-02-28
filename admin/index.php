<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
error_reporting(0);
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';

?>

<?php
$txnQuery = "SELECT t.id, t.cart_id, t.full_name, t.description, t.txn_date, t.total, c.items, c.paid, c.shipped
FROM transaction t
LEFT JOIN cart c ON t.cart_id = c.id
WHERE c.paid = 0 AND c.shipped = 0
ORDER BY t.txn_date";
$txn_results = $db->query($txnQuery);
?>
<script>
function delete();
{
confirm("do you want to delete");
}
</script>
<div class="col-md-12">
<h3 class="text-center">Order To Ship</h3>
<table class="table table-striped table-bordered">
<thead>
<th></th><th>Transaction No.</th><th>Name</th><th>Description</th><th>Total</th><th>Date</th>
</thead>

<tbody>
<?php while($order = mysqli_fetch_assoc($txn_results)): ?>
<tr>
<td><a href="index.php?delete=<?=$order['id'];?>" class="btn btn-danger btn-xs" onclick="delete(<?=$order['id'];?>)">Delete Order</a>&nbsp;
<a href="order.php?txn=<?=$order['id'];?>" class="btn btn-info btn-xs">Details Order</a></td>
<td><?=$order['cart_id'];?></td>
<td><?=$order['full_name'];?></td>
<td><?=$order['description'];?></td>
<td><?=money($order['total']);?></td>
<td><?=$order['txn_date'];?></td>
</tr>
<?php endwhile; ?>
</tbody>


</table>
</div>
<div class="row">
<?php 
$thisYr = date("Y");
$lastYr = $thisYr - 1;
$thisYrQ = $db->query("SELECT total, txn_date FROM transaction WHERE YEAR(txn_date) = '{$thisYr}'");
$lastYrQ = $db->query("SELECT total, txn_date FROM transaction WHERE YEAR(txn_date) = '{$lastYr}'");
$current = array();
$last = array();
$currentTotal = 0;
$lastTotal = 0;
$tot = array();
while($x = mysqli_fetch_assoc($thisYrQ)){
$month = date("m",strtotime($x['txn_date']));
if(!array_key_exists($month,$current)){
	$current[(int)$month] += $x['total'];
	}else{
	$current[(int)$month] = $x['total'];
	}
	$currentTotal += $x['total'];
	}
	while($y = mysqli_fetch_assoc($lastYrQ)){
		$month = date("m",strtotime($y['txn_date']));
	if(!array_key_exists($month,$current)){
	$last[(int)$month] += $y['total'];
	}else{
	$last[(int)$month] = $y['total'];
	}
	$lastTotal += $y['total'];
	}


?>
</form>
<div class="col-md-4">
<h3 class="text-center">Sales By Month</h3>
<table class="table table-striped table-bordered">
<thead>
<th></th>
<th><?=$lastYr;?></th>
<th><?=$thisYr;?></th>
</thead>
<tbody>
<?php for($i = 1;$i <= 12;$i++):
$dt = DateTime::createFromFormat('!m',$i);
?>
<tr>
<td><?=$dt->format("F");?></td>
<td><?=(array_key_exists($i,$last))?money($last[$i]):money(0);?></td>
<td><?=(array_key_exists($i,$current))?money($current[$i]):money(0);?></td>
</tr>
<?php endfor; ?>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td>Total</td>
<td><?=money($lastTotal);?></td>
<td><?=money($currentTotal);?></td>
</tr>
</tbody>
</table>

</div>


<?php
$iQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
$lowItems = array();
while($product = mysqli_fetch_assoc($iQuery)){
$item = array();
$quanti = qtyToArray($product['qty']);
foreach($quanti as $qty){
if($qty['qty'] < 2){
$cat = get_category($product['categories']);
$item = array(
'title' => $product['title'],
'size' => $qty['size'],
'quantity' =>$qty['quantity'],
'category' => $cat['parent'].' ~ '.$cat['child']
);
$lowItems[] = $item;
}
}
}
?>
<div class="col-md-8">
<h3 class="text-center">Inventory</h3>
<table class="table table-striped table-bordered">
<thead>
<th>Product</th>
<th>Category</th>
<th>Size</th>
<th>Quantity</th>

</thead>
<tbody>
<?php foreach($lowItems as $item): ?>
<tr <?=($item['quantity'] == 0)?' class="danger"':'';?>>
<td><?=$item['title'];?></td>
<td><?=$item['category'];?></td>
<td><?=$item['size'];?></td>
<td><?=$item['quantity'];?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>



<?php
include 'includes/footer.php';
?>
