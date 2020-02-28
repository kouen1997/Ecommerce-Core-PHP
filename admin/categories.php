<?php
require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
$sql = "SELECT * FROM categories ORDER BY id";
$result = $db->query($sql);
$errors = array();

//edit cat
if(isset($_GET['edit']) && !empty($_GET['edit'])){
$edit_id = (int)$_GET['edit'];
$edit_id = sanitize($edit_id);
$sql2 = "SELECT * FROM categories WHERE id = '$edit_id'";
$edit_result = $db->query($sql2);
$ecat = mysqli_fetch_assoc($edit_result);
}


//delete cat
if(isset($_GET['delete']) && !empty($_GET['delete'])){
$delete_id = (int)$_GET['delete'];
$delete_id = sanitize($delete_id);
$sql = "DELETE FROM categories WHERE id = '$delete_id'";
$db->query($sql);
header('Location: categories.php');


}
//kapag click ng add form
if(isset($_POST['add_submit'])){
$categories = sanitize($_POST['categories']);
$parent = sanitize($_POST['parent']);
//Kapag blanhgko ang kemerut
if($_POST['categories'] == ''){
	$errors[] .='Must enter a category';
}
// validation
$sql = "SELECT * FROM categories WHERE category = '$categories'";
if(isset($_GET['edit'])){
$sql = "SELECT * FROM categories WHERE category = '$categories' AND id != '$edit_id'";
}
$result = $db->query($sql);
$count = mysqli_num_rows($result);
if ($count > 0){
	$errors[] .= $categories.' is already existing. Enter new data!';
}

// kapag naman existing na ang data
if(!empty($errors)){
	echo display_errors($errors);
}else{
//add ng data
$sql = "INSERT INTO categories (category, parent ) VALUES ('$categories','$parent')";
if(isset($_GET['edit'])){
$sql = "UPDATE categories SET category = '$categories' WHERE id = '$edit_id'";
}
$db->query($sql);
header('Location: categories.php');
}
}
?>

<h2 class="text-center">Categories</h2><hr>
<!-- Adding of categories -->
<div>
<form class="form-inline" action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
<?php
$value = '';
$value1 = '';
if(isset($_GET['edit'])){
	$value = $ecat['category'];
	$value1 = $ecat['parent'];
}else{
	if(isset($_POST['categories'])){
	$value = sanitize($_POST['categories']);
	}
	}
	?>

	<div class="form-group">
		<label for="categories"><?=((isset($_GET['edit']))?'Edit ':'Add a ');?>Category</label>
		<input type="text" name="categories" id="categories" class="form-control" value="<?=$value;?>"><br>
		<label for="parent"><?=((isset($_GET['edit']))?'Edit ':'Add a ');?>Parent:&nbsp;&nbsp;&nbsp;</label>
		<input type="text" name="parent" id="parent" class="form-control" value="<?=$value1;?>">
		<?php if(isset($_GET['edit'])): ?>
		<a href="categories.php" class="btn btn-default">Cancel</a>
		<?php endif; ?>
		<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit ':'Add ');?>" class="btn btn-success">
	</div>
</form>
</div><hr>
<table id="tab" class="table table-bordered table-striped">
<thead>
	<th>Categories</th><th>Parent</th><th>Update</th><th>Delete</th>
</thead>
<tbody>
<?php while($category = mysqli_fetch_assoc($result)): ?>
	<tr>
	<td><?php echo $category['category']; ?></td>
	<td><?php echo $category['parent']; ?></td>
<td><a href="categories.php?edit=<?php echo $category['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
	<td><a href="categories.php?delete=<?php echo $category['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-minus"></span></a></td>
	</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php
include 'includes/footer.php';
?>
