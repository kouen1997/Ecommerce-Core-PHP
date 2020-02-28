<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
if(isset($_GET['status'])){
$status = $_GET['status'];
$sql = $db->query("UPDATE client SET status = 'Active' WHERE user_id = '$status'");
header('Location: user.php');

}else{
$client_sql = "SELECT * FROM client WHERE status = 'Inactive'";
$client_result = $db->query($client_sql);
?>
<h2 class="text-center">Users Profile</h2><hr>
<table class="table table-bordered table-striped">
<thead>
<th>User ID</th><th>Name</th><th>Address</th><th>Email</th><th>Contact #</th><th>Date Join</th><th>Last Login</th><th>Status</th><th>Action</th>
</thead>
<tbody>
<?php while($client = mysqli_fetch_assoc($client_result)):?>
<tr>
<td><?=$client['user_id'];?></td>
<td><?=$client['full_name'];?></td>
<td><?=$client['address'];?></td>
<td><?=$client['email'];?></td>
<td><?=$client['contact'];?></td>
<td><?=$client['join_date'];?></td>
<td><?=$client['last_login'];?></td>
<td  class='bg-danger'><?=$client['status'];?></td>
<td><a href="user_arc.php?status=<?=$client['user_id'];?>" class="btn btn-info">Restore</a></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<?php } ?>
<?php
include 'includes/footer.php';
?>