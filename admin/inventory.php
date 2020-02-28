<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
error_reporting(0);
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
if(isset($_GET['search'])){
?>
<br>
<br>
<form action='inventory.php?search=1' method='post' class='pull-right'> 
<input type='text' name='search' placeholder='Search by Category' id='input-text'>&nbsp;&nbsp;
<input type='submit' name='submit' id='input-text-1' class='btn btn-success'>
</form>
<?php
if(isset($_POST['submit'])){
$search = $_POST['search'];

$sql = $db->query("SELECT * FROM products WHERE title LIKE '%$search%'");
$lowItems = array();
while($product = mysqli_fetch_assoc($sql)){
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
}
?>
<div class="col-md-12">
<h3 class="text-center">Inventory</h3>
<br>

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
}else{
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
<div class="col-md-12">
<h3 class="text-center">Inventory</h3>
<a href="inventory.php?search=1" class="btn btn-success pull-right">Search Product</a><div class="clearfix"></div>
<br>

<table class="table table-striped table-bordered">
<thead>
<th>Product</th>
<th>Category</th>
<th>Size</th>
<th>Quantity</th>

</thead>
<tbody>
<?php foreach($lowItems as $item): ?>
<tr <?=($item['quantity'] <= 2)?' class="danger"':'';?>>
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
<?php } ?>


<?php
include 'includes/footer.php';
?>
