

<!-- para ma call yung mga data sa database -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
$id = $_POST['id'];
$id = (int)$_POST['id'];
$sql = "SELECT * FROM products WHERE id =".$id;
$result = $db->query($sql);
$product = mysqli_fetch_assoc($result);
$sizeString = $product['qty'];
$sizeString = rtrim($sizeString, ',');
$sizeArray = explode(',', $sizeString);

?>


<!-- eto yung lalabas na details sa pop up -->

<?php ob_start(); ?>
	<div class="modal fade" id="buy-modal" tabindex="-1" role="dialog" aria-labelledby="buy-1" aria-hidden="true">
	<div class="modal-dialog modal-xs">
	<div class="modal-content">
	<div class="modal-header">
	<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</button>
	<h4 class="modal-title text-center">Warning</h4>
	
	</div>
	<div class="modal-body">
	<div class="container-fluid">
	<div class="row">
	<p class="text-center">You must login first to buy!!</p>
	</div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	
	</div>
	</div>
	</div>
	</div>
<?php echo ob_get_clean(); ?>