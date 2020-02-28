<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
if(!is_logged_in_cus()){
	login_error_redirect_cus();
}
include 'includes/head.php';
$hashed = $client_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm= trim($confirm);
$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$user_id = $client_data['id'];
$errors = array();
?>
<div id="login-form">
<div>
<?php
if($_POST){
//login form validation
if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
	$errors[] = 'Fill the required fields';

}

//password validation po
if(strlen($password) < 6){
$errors[] = 'Password atleast 6 characters';
}
if($password != $confirm){
$errors[] = 'The new and confirm password doesnt match';

}
if(!password_verify($old_password, $hashed)){
$errors[] = 'The password is incorrect .try again';
}
if(!empty($errors)){
echo display_errors($errors);
}else{
$db->query("UPDATE client SET password = '$new_hashed' WHERE id = '$user_id'");
$_SESSION['success_flash'] = 'Your password has been updated';
header('Location: cus_index.php');
}
}
?>

</div>
<h2 class="text-center">Change Password</h2>
<hr>
<form action="change_password.php" method="POST">
<div class="form-group">
<label for="old_password">Old Password</label>
<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
</div>
<div class="form-group">
<label for="password">New Password</label>
<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
</div>
<div class="form-group">
<label for="confirm">Confirm Password</label>
<input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
</div>
<div class="form-group">
<a href="index.php" class="btn btn-default">Cancel</a>
<input type="submit" name="submit" value="Login" class="btn btn-primary">
</div>
</form>
</div>


<?php include 'includes/footer.php'?>