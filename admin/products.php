<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
error_reporting(0);
include 'includes/head.php';
include 'includes/navigation.php';
//delete items

if(isset($_GET['delete'])){
$id = sanitize($_GET['delete']);
$db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
header('Location: products.php');

}
$dbpath = '';
if(isset($_GET['add']) || isset($_GET['edit'])){
$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
//para sa editing
$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
$category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
$sqty = ((isset($_POST['sqty']) && $_POST['sqty'] != '')?sanitize($_POST['sqty']):'');
$sqty = rtrim($sqty,',');
$saved_image = '';
if(isset($_GET['edit'])){
$edit_id = (int)$_GET['edit'];
$productResult = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
$product = mysqli_fetch_assoc($productResult);
if(isset($_GET['delete_image'])){
$img_url = $_SERVER['DOCUMENT_ROOT'].$product['image']; echo $img_url;
unlink($img_url);
$db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
header('Location: products.php?edit='.$edit_id);
}
$category = ((isset($_POST['child']) && $_POST['child'] !='')?sanitize($_POST['child']):$product['categories']);
$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$product['title']);
$parentSql = $db->query("SELECT * FROM categories WHERE id = '$category'");
$parentResult = mysqli_fetch_assoc($parentSql);
$parent = ((isset($_POST['parent']) && $_POST['parent'] !='')?sanitize($_POST['parent']):$parentResult['parent']);
$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$product['price']);
$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):$product['list_price']);
$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$product['description']);
$sqty = ((isset($_POST['sqty']) && $_POST['sqty'] != '')?sanitize($_POST['sqty']):$product['qty']);
$sqty = rtrim($sqty,',');
$saved_image = (($product['image'] != '')?$product['image']:'');
$dbpath = $saved_image;
}
if(!empty($sqty)){
	$sizeString = sanitize($sqty);
	$sizeString = rtrim($sizeString,',');
	$sizesArray = explode(',',$sizeString);
	$sArray = array();
	$qArray = array();
	$tArray = array();
	foreach($sizesArray as $ss){
	 $s = explode(':', $ss);
	 $sArray[] = $s[0];
	 $qArray[] = $s[1];
	}
	//validation
	}else{$sizesArray = array();
	}
//para sa sizes and quantity

if($_POST){

$errors = array();
	
	$required = array('title','parent','price','sqty','description');
	foreach($required as $field){
	if($_POST[$field] ==''){
	$errors[] = 'Fill up the required fields';
	break;
	
	}
	}
	//photo upload validation
	if(!empty($_FILES)){
	$photo = $_FILES['photo'];
	$name = $photo['name'];
	$nameArray = explode('.', $name);
	$fileName = $nameArray[0];
	$fileEx = $nameArray[1];
	$mime = explode('/', $photo['type']);
	$mimeType = $mime[0];
	$mimeEx = $mime[1];
	$tmpLoc = $photo['tmp_name'];
	$fileSize = $photo['size'];
	$allowed = array('png','jpg','jpeg','gif');
	$uploadName = md5(microtime()).'.'.$fileEx;
	$uploadPath = BASEURL.'images/products/'.$uploadName;
	$dbpath = '/ejventerprises/images/products/'.$uploadName;
	if($mimeType != 'image'){
	$errors[] = 'The file must be an image ';
	}
	if(!in_array($fileEx, $allowed)){
	$errors[] = 'Needs to be in JPG, PNG, GIF type.';
	}
	if($fileSize > 1000000){
		$errors[] = 'The image size is to big.';
	
	}
	if($fileEx != $mimeEx &&($mimeEx == 'jpeg' && $fileEx != 'jpg')){
		$errors[] = 'File does not match';
	
	}
	}
	if(!empty($errors)){
	echo display_errors($errors);
	}else{
	
	//insert sa database
	if(!empty($_FILES)){
	move_uploaded_file($tmpLoc, $uploadPath);
	}
	$insertSql = "INSERT INTO products (`title`,`price`,`list_price`,`categories`,`image`,`description`,`qty`) 
	VALUES ('$title','$price','$list_price','$category','$dbpath','$description','$sqty')";
	if(isset($_GET['edit'])){
	$insertSql = "UPDATE products 
	SET title = '$title', price = '$price', list_price = '$list_price', categories = '$category', image = '$dbpath', description = '$description', qty = '$sqty' 
	WHERE id = '$edit_id'";
	}
	$db->query($insertSql);
	header('Location: products.php');
	}
}

?>
	<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit ':'Add New ');?>Product</h2><hr>
	<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
	<div class="form-group col-md-3">
	<label for="title">Title*:</label>
	<input type="text" name="title" class="form-control"id="title" value="<?=$title;?>">
	</div>
	<div class="form-group col-md-3">
	<label for="parent">Category*:</label>
	<select class="form-control" id="parent" name="parent">
			<option value="<?=(($parent == '')?' selected':'');?>"></option>
			<?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
				<option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'');?>><?=$p['category'];?></option>
			<?php endwhile; ?>
	</select>
	</div>
	<div class="form-group col-md-3">
	<label for="child">Sub-Category*:</label>
	<select class="form-control" id="child" name="child">
	</select>
	</div>
	<div class="form-group col-md-3">
	<label for="price">Price*:</label>
	<input type="text" id="price" name="price" class="form-control" value="<?=$price;?>">
	</div>
	<div class="form-group col-md-3">
	<label for="list_price">List Price*:</label>
	<input type="text" id="list_price" name="list_price" class="form-control" value="<?=$list_price;?>">
	</div>
	<div class="form-group col-md-3">
	<label for="size_qty">Size & Qty*:</label>
	<button class="btn btn-default form-control" onclick="jQuery('#sizeqtyModal').modal('toggle');return false;">Sizes & Quantity</button>
	</div>
	<div class="form-group col-md-3">
	<label for="sqty">&nbsp;</label>
	<input type="text" name="sqty" id="sqty" class="form-control" value="<?=$sqty; ?>" readonly>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br>
	<label for=""></label>
	<input type="hidden" name="photo" id="photo" class="form-control">
	</div>
	<div class="form-group col-md-6">
	<label for="photo">Product Photo*:</label>
	<?php if($saved_image != ''):?>
	<div class='saved-image'><img src="<?=$saved_image;?>" alt="saved image" height="5000" width="6000"><br>
	<a href="products.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">Delete Image</a>
</div>
	<?php else:?>
	<input type="file" name="photo" id="photo" class="form-control">
	<?php endif; ?>
	</div>
	<div class="form-group col-md-6">
	<label for="description">Desciption*:</label>
	<textarea name="description" id="description" class="form-control" rows="6"><?=$description;?></textarea>
	</div>
	<div  class="form-group col-md-3">
	<a href="products.php" class="btn btn-default">Cancel</a>
	<input type="submit" name="submit" id="submit" value="<?=((isset($_GET['edit']))?'Update ':'Add ');?>Product" class="btn btn-success">
	</div>
	</form>
	<!-- Modal para sa size and qty -->
	<div class="modal fade" id="sizeqtyModal" tabindex="-1" role="dialog" aria-labelledby="sizeqtyModallabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
	<div class="modal-header">
	<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</button>
	<h4 class="modal-title">Sizes & Quantity</h4>
	</div>
	<div class="modal-body">
	<div class="container-fluid">
	<?php for($i=1; $i <= 12;$i++):?>
	<div class="form-group col-md-2">
	<label for="size<?=$i;?>">Sizes</label>
	<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
	
	</div>
	<div class="form-group col-md-2">
	<label for="qty<?=$i;?>">Quantity</label>
	<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
	
	</div>
	
	<?php endfor; ?>
	</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<div class="btn btn-success" type="submit" onclick="updateSizes();jQuery('#sizeqtyModal').modal('toggle');return false;">Okay</div>
	</div>
	
	</div>
	</div>
	</div>
<?php }else{
$sql = "SELECT * FROM products WHERE deleted = 0";
$presults = $db->query($sql);
if(isset($_GET['featured'])){
	$id= (int)$_GET['id'];
	$featured = (int)$_GET['featured'];
	$featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');

}
?>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<hr>
<table class="table table-bordered table-striped">
<thead><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th><th>Update</th><th>Delete</th></thead>

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
	<td><a href="products.php?featured=<?=(($products['featured'] == 0)?'1':'0');?>&id=<?=$products['id'];?>" class="btn btn-xs btn-default">
	  <span class="glyphicon glyphicon-<?=(($products['featured'] == 1)?'minus':'plus');?>"></span>
	  
	</a>&nbsp; <?=(($products['featured'] == 1)?'Featured Product':'Product');?>
	</td>
	<td>0</td>
	<td><a href="products.php?edit=<?php echo $products['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></td>
	<td><a href="products.php?delete=<?php echo $products['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<?php } include 'includes/footer.php'; ?>

<script>
jQuery('document').ready(function(){
get_child_options('<?=$category; ?>');

});
</script>


<!-- $product_id = sanitize($_POST['product']);
 $size = sanitize($_POST['size']);
 $available = sanitize($_POST['available']);
 $quantity = sanitize($_POST['quantity']);
 $item = array();
 $item[] = array(
 'id' => $product_id,
 'size' => $size,
 'quantity' => $quantity,
 );
 $domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
 $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
 $product = mysqli_fetch_assoc($query);
 $_SESSION['success_flash'] = $product['title']. ' was added to your cart';
 if($cart_id !=''){
 $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
 $cart = mysqli_fetch_assoc($cartQ);
 $previous_items = json_decode($cart['items'],true);
 $item_match = 0;
 $new_items = array();
 foreach($previous_items as $pitem){
	if($item[0]['id'] == $pitem['id'] && $item[0]['size'] == $pitem['size']){
	$pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
	if($pitem['quantity'] > $available){
		$pitem['quantity'] = $available;
		
	}
	$item_match = 1;
	}
	$new_items[] = $pitem;
 }
 if($item_match != 1){
	$new_items = array_merge($item,$previous_items);
 }
 $items_json = json_encode($new_items);
 $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
 $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
 setcookie(CART_COOKIE,'',1,"/",$domain,false);
 setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
 }else{
 $items_json = json_encode($item);
 $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
 $db->query("INSERT INTO cart (items,expire_date) VAlUES ('{$items_json}','{$cart_expire}')");
 $cart_id = $db->insert_id;
 setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
 } -->