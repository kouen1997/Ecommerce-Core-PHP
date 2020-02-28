<?php require_once 'core/init.php'; ?>
<?php include 'include/head.php'; ?>
	<!-- navigation bar -->
<?php include 'include/navigation.php'; ?>
	
	<!-- header -->

	<div class="container-fluid">
	<!-- eto yung left side bar-->
<?php include 'include/leftbar.php'; ?>
<!-- para ma select yung entity na featured  na equal sa 1. Sa table na products pa ma dislay yung mga featured items-->
<?php
if(isset($_GET['cat'])){
	$cat_id = sanitize($_GET['cat']);
	
}else{
	$cat_id = '';

}
$catsql = "SELECT * FROM products WHERE categories = '$cat_id' AND deleted = 0";
$proq = $db->query($catsql);
$category = get_category($cat_id);
?>

	<!-- eto naman main content center-->
	<div class="col-md-8">
	<div class="row">
	<h2 class="text-center"><?=$category['parent'].' '.$category['child'];?></h2>
	<!-- dito ang simula ng while looping -->
	<?php while($product = mysqli_fetch_assoc($proq)) : ?>
	<div class="col-md-3">
	<h4><?php echo $product['title'];	?></h4>
	<img src="<?php echo $product['image'];	?>" height="200" width="400" alt="<?php echo $product['title'];	?>" class="img-thumb"/>
	<p class="list-price text-danger">List Price: &#8369; <s><?php echo $product['list_price'];	?></s></p>
	<p class="price">Price: &#8369; <?php echo $product['price'];	?></p>
	<a href="index.php?view=<?=$product['id'];?>" class="btn btn-primary">View</a>
	</div>
	<?php endwhile; ?>
	<!-- end ng looping -->
	</div>
	</div>



	
	<!-- eto yung right side bar-->
	<?php  include 'include/rightbar.php'; ?>
	
	</div>
	
	
	
	<?php  include 'include/footer.php'; ?>