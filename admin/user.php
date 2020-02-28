<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
if(isset($_GET['status'])){
$status = $_GET['status'];
$sql = $db->query("UPDATE client SET status = 'Inactive' WHERE user_id = '$status'");
header('Location: user.php');

}else{
if(isset($_GET['audit'])){
$user = $_GET['audit'];
$client_sql = "SELECT * FROM audit_trail WHERE user_id = '$user'";
$client_result = $db->query($client_sql);
?>
<h2 class="text-center">Audit Trail</h2><hr>
<table class="table table-bordered table-striped">
<thead>
<th>Record ID</th><th>User ID</th><th>Name</th><th>Form</th><th>Last Login</th><th>Last Logout</th><th>Activity</th>
</thead>
<tbody>
<?php while($client = mysqli_fetch_assoc($client_result)):?>
<tr>
<td><?=$client['record_id'];?></td>
<td><?=$client['user_id'];?></td>
<td><?=$client['full_name'];?></td>
<td><?=$client['form_record'];?></td>
<td><?=$client['date_login'];?></td>
<td><?=$client['last_logout'];?></td>
<td><?=$client['activity'];?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php
}else{
$client_sql = "SELECT * FROM client";
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
<?php if($client['status'] == 'Active'){
echo "<td  class='bg-success'>".$client['status']."</td>";
}else{
echo "<td  class='bg-danger'>".$client['status']."</td>";
}
?>
<td><a href="user.php?status=<?=$client['user_id'];?>" class="btn btn-danger">Inactive</a>&nbsp;&nbsp;&nbsp;&nbsp
<a href="user.php?audit=<?=$client['user_id'];?>" class="btn btn-primary">Audit Trail</a></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
<?php } ?>
<?php } ?>
<?php
include 'includes/footer.php';
?>
