
	<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	<a href="cus_index.php" class="navbar-brand">EJV Enterprises</a>
	<ul class="nav navbar-nav pull-right">
	
	
	
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$client_data['full_name']; ?>!
	<span class="caret"></span>
	<ul class="dropdown-menu" role="menu">
	<li><a href="change_password.php"><span class="lock"></span>Change Password</a></li>
	<li><a href="logout.php"><span class="lock"></span>Log Out</a></li>
	</ul>
	</a>
	</li>
	
	
	<!-- looping para ma fetch yung mga laman ng category ng hindi na mag type pa haha-->
	<!-- <li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?></a>
	<ul class="dropdown-menu" role="menu">
	
	<li><a href="#"><?php echo $child['category']; ?></a></li>
	
	-->
	</ul>
	</li>
	
	<!-- dulo ng looping -->
	</ul>
	</div></nav>