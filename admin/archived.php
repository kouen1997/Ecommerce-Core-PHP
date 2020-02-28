<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';?>
<?php
$sql = "SELECT * FROM products WHERE deleted = 1";
$presults = $db->query($sql);
if(isset($_GET['archive'])){
	$id = (int)$_GET['archive'];
	$db->query("UPDATE products SET deleted = '0' WHERE id = '$id'");
	header('Location: archived.php');
}
?>
<h2 class="text-center">Archived Products</h2>
<hr>
<table class="table table-bordered table-striped">
<thead><th>Product</th><th>Price</th><th>Category</th><th>Sold</th><th>Archived</th></thead>

<tbody>
<?php while($products = mysqli_fetch_assoc($presults)): 
	$childID = $products['categories'];
	$catsql = "SELECT * FROM categories WHERE id = '$childID'";
	$result = $db->query($catsql);
	$child = mysqli_fetch_assoc($result);
	$parentID = $child['parent'];
	$psql = "SELECT * FROM categories WHERE id = '$parentID'";
	$presult = $db->query($psql);
	$parent = mysqli_fetch_assoc($presult);
	$category = $parent['category'].' ~ '.$child['category'];
	
	

?>
<tr>
	<td><?=$products['title'];?></td>
	<td><?=money($products['price']);?></td>
	<td><?=$category;?></td>
	<td>0</td>
	<td><a href="archived.php?archive=<?php echo $products['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></td>
	
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php include 'includes/footer.php'; ?>