<?php
	require_once 'core/init.php'; 
	
	$prodid = $_GET['id'];

	if(!empty($prodid)){
		$sqlSelectSpecProd = mysql_query("SELECT * FROM products WHERE id = '$prodid'") or die(mysql_error());
		$getProdInfo = mysql_fetch_array($sqlSelectSpecProd);
		$prodname= $getProdInfo["title"];
		$prodimage = $getProdInfo["image"];
				}
?>

							<div class="product-information"><!--/product-information-->
							<h2 class="product"><?php echo $prodimage; ?></h2>
							<h2 class="product"><?php echo $prodname; ?></h2>
								

                                <br>
                                
                                <a class="btn btn-default add-to-cart" id="add-to-cart"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                                <p class="info hidethis" style="color:red;"><strong>Product Added to Cart!</strong></p>
