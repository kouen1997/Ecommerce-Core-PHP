<?php require_once 'core/init.php'; ?>
<?php include 'include/head.php'; ?>
	<!-- navigation bar -->
<?php include 'include/navigation.php'; ?>
	<label for="&nbsp;">&nbsp;</label>
	<label for="&nbsp;">&nbsp;</label>
	
	<!-- header -->
	<div class="container-fluid">
	<!-- eto yung left side bar-->
<?php include 'include/leftbar.php'; ?>
<!-- para ma select yung entity na featured  na equal sa 1. Sa table na products pa ma dislay yung mga featured items-->
<?php 
if(isset($_GET['view'])){
$id = sanitize($_GET['view']);
$vsql = "SELECT * FROM products WHERE id = '$id'";
$res = $db->query($vsql);
$vproduct = mysqli_fetch_assoc($res);
$sizeString = $vproduct['qty'];
$sizeString = rtrim($sizeString, ',');
$sizeArray = explode(',', $sizeString);
?>
<div class="col-md-8">
<div class="row">

	<h2 class="text-center"><?php echo $vproduct['title'];	?></h2>
	<br><span id="modal_errors" class="bg-danger"></span>
	<div class="col-sm-6">
	<div class="center-block">
	<img src="<?php echo $vproduct['image']; ?>" alt="<?php echo $vproduct['title']; ?>" class="buy img-responsive">
	</div>
	</div>
	<div class="col-sm-6">
	<h4>Details</h4>
	<p><?php echo $vproduct['description']; ?></p>
	<hr>
	<p>Price: &#8369; <?php echo $vproduct['price']; ?></p>
	<p>Formulated by: EJV Enterprises</p>
	<hr>
	<form action="add_cart.php" method="post" id="add_product_form">
	<input type="hidden" name="id" value="<?=$vproduct['id']; ?>">
	<input type="hidden" name="available" id="available" value="">
	
	<div class="form-group">
	<div class="col-xs-3">
	<label for="quantity">Quantity: </label>
	<input type="number" class="form-control" id="quantity" name="quantity">

	</div>
	<div>

	<br><br><br>
	<div class="form-group col-md-12">
	<label for="sizes">Sizes</label>
	<select class="form-control" name='size' id='size'>
	<option value=""></option>
	<?php foreach($sizeArray as $string){
		$sizeArray = explode(':', $string);
		$size = $sizeArray[0];
		$available = $sizeArray[1];
		if($available > 0){
		echo '<option value="'.$size.'" data-available="'.$available.'">'.$size.' ('.$available.' Available)</option>';
		}
	}?>
	</select>
	
	</div>
	
	</div>
	<div class="form-group col-md-2">
	<a href='index.php' class="btn btn-primary">Back</a>
	</div>
	<div class="form-group col-md-2">
	
	<button onclick="add_to_cart();return false;" class="btn btn-warning">Add to cart</a>

	</div>
	</form>
	
	</div>
	</div>
	</div>
	
	</div>
	
	<script>
	jQuery('#size').change(function(){
	var available = jQuery('#size option:selected').data("available");
	jQuery('#available').val(available);
	});
	
	</script>
<?php
}else{
$sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0";
$featured = $db->query($sql);


	?>
	
	<!-- eto naman main content center-->
	<div class="col-md-8">
	<div class="row">
	<h2 class="text-center">Featured Products</h2>
	<!-- dito ang simula ng while looping -->
	<?php while($product = mysqli_fetch_assoc($featured)) : ?>
	<div class="col-md-3">
	<h4><?php echo $product['title'];	?></h4>
	<img src="<?php echo $product['image'];	?>" height="200" width="400" alt="<?php echo $product['title'];	?>" class="img-thumb"/>
	<p class="list-price text-danger">List Price: &#8369; <s><?php echo $product['list_price'];	?></s></p>
	<p class="price">Price: &#8369; <?php echo $product['price'];	?></p>
	<a href="index.php?view=<?=$product['id'];?>" class="btn btn-info btn-xs col-md-12">Details</a>
	
	</div>
	<?php endwhile; ?>
	<!-- end ng looping -->
	</div>
	</div>
	
	<!-- eto yung right side bar-->
	<?php } include 'include/rightbar.php'; ?>
	
	</div>
	
	
	
	<?php  include 'include/footer.php'; ?>