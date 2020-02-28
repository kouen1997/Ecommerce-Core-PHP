<!-- para ma slect mo yung table ng category kung nasaan ang parent -->
<?php
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>

	<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	<a href="home.php" class="navbar-brand">EJV Enterprises</a>
	<ul class="nav navbar-nav">
	
	
	<li>
	<a href="#">About Us</a>
	</li>
	<!-- para ma fetch yung parent category -->
	<?php while($parent = mysqli_fetch_assoc($pquery)) : ?> 
	<?php 
	$parent_id = $parent['id']; 
	$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
	$cquery = $db->query($sql2);
	?>
	<!-- looping para ma fetch yung mga laman ng category ng hindi na mag type pa haha-->
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?></a>
	<ul class="dropdown-menu" role="menu">
	<?php while($child = mysqli_fetch_assoc($cquery)) : ?> 
	<li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category']; ?></a></li>
	<?php endwhile; ?>
	
	</ul>
	</li>
	<?php endwhile; ?>
	<li><a href="cart.php"  class="pull-right">My Cart</a></li>
	<!-- dulo ng looping -->
	</ul>
	</div></nav>