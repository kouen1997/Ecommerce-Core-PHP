<?php
session_start();
include '../core/init.php'; 
if(!isset($_POST['submit'])){
$_SESSION['id']=$_GET['id'];
$query="SELECT * FROM products
		WHERE id=".$_SESSION['id'];
$result=mysql_query($query)or die("Unable to execute query".mysql_error());
$row=mysql_fetch_object($result);
}?>

<form action="view.php" method=POST> 
<div id='container-2a'>
<div id='update'>
		<div id='update1'>
<input type='hidden' name='id'  value="<?php echo $_SESSION['id']; ?>"/><br />
<?php echo $row->image; ?>