<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
include 'include/head.php';
include 'include/navigation.php';
if($cart_id != ''){
$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$result = mysqli_fetch_assoc($cartQ);
$items = json_decode($result['items'],true);

$i = 1;
$sub_total = 0;
$item_count = 0;

}
?>
<div class="col-md-12">
<div class="row">
<h2 class="text-center">My Shopping Cart</h2></hr>
<?php if($cart_id == ''): ?>
<div class="bg-danger">
<p class="text-danger text-center">
Your shopping cart is empty
</p>
</div>
<?php else: ?>
<table class="table table-bordered table-striped">
<thead><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th></thead>
<tbody>
<?php foreach($items as $item){
$product_id = $item['id'];
$productq = $db->query("SELECT * FROM products WHERE Id = '{$product_id}'");
$product = mysqli_fetch_assoc($productq);
$sarray = explode(',',$product['qty']);
foreach ($sarray as $aray){
$s = explode(':',$aray);
if($s[0] == $item['size']){
$available = $s[1];


}

} ?>
<tr>
<td><?=$product['title'];?></td>
<td><?=money($product['price']);?></td>
<td>
<button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$item['size'];?>');">-</button>
&nbsp;<?=$item['quantity'];?>&nbsp;
<?php if($item['quantity'] < $available): ?>
<button class="btn btn-xs btn-default" onclick="update_cart('addone','<?=$product['id'];?>','<?=$item['size'];?>');">+</button>
<?php else: ?>
<span class="text-danger">MAX</span>
<?php endif; ?>
</td>
<td><?=$item['size'];?></td>
<td><?=money($item['quantity'] * $product['price']);?></td>
</tr>
<?php 
$i++;
$item_count += $item['quantity'];
$sub_total += ($product['price'] * $item['quantity']);

} 
$tax = TAXRATE * $sub_total;
$tax = number_format($tax,2);
$total = $tax + $sub_total;
?>

</tbody>

</table>
<table class="table table-bordered table-striped">
<thead><th>Total Items</th><th>Sub Total</th><th>Tax</th><th>Total Price</th></thead>
<tbody>
<tr>
<td><?=$item_count;?></td>
<td>&#8369; <?=$sub_total;?></td>
<td>&#8369; <?=$tax;?></td>
<td class="bg-success">&#8369; <?=$total;?></td>
</tr>
</tbody>

</table>
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#checkoutModal">Checkout

</button>

	<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
	<div class="modal-dialog modal-xs">
	<div class="modal-content">
	<div class="modal-header">
	<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</button>
	<h4 class="modal-title text-center" id="checkoutModalLabel">Shipping Address</h4>
	</div>
	<div class="modal-body">
	<form action="thankyou.php" method="post" id="payment">
	<?php if(!is_logged_in_cus()){
	echo "<div class='bg-danger text-center text-danger'>You Must Login in firs To Continue</div>";
	echo "<div>&nbsp;</div>";
	echo '<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
	} else{?>
	<input type="hidden" name="tax" value="<?=$tax;?>">
	<input type="hidden" name="sub_total" value="<?=$sub_total;?>">
	<input type="hidden" name="total" value="<?=$total;?>">
	<input type="hidden" name="cart_id" value="<?=$cart_id;?>">
	<input type="hidden" name="description" value="<?=$item_count.' item(s) from EJV Enterprises';?>">
	<input type="hidden" name="user_id" value="<?=$client_data['user_id'];?>">
	<div><b>Name:</b><input type="text" name="full_name" class="form-control" value="<?=$client_data['full_name'];?>" readonly></div>
	<div><b>Email:</b><input type="text" name="email" class="form-control" value="<?=$client_data['email'];?>" readonly> </div>
	<div><b>Address:</b>		<input type="text" name="address" class="form-control" value="<?=$client_data['address'];?>" readonly></div>
	<div><b>Contact No:</b>		<input type="text" name="contact" class="form-control" value="<?=$client_data['contact'];?>" readonly></div>
	<div>&nbsp;</div>
	
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-primary" id="check_out">Proceed</button>
	</form>
	</div>
	
	<?php }?>
	</div>
	</div>
	</div>
	</div>
<?php endif; ?>
</div>
</div>
<?php include 'include/footer.php'; ?>
