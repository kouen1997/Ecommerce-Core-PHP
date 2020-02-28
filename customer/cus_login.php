<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ejventerprises/core/init.php';
include 'includes/head.php';
$password = 'password';
$hash = password_hash($password, PASSWORD_DEFAULT);
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$hashed = password_hash($password, PASSWORD_DEFAULT);
$errors = array();
?>
<div id="login-form">
<div>
<?php
if($_POST){
//login form validation
if(empty($_POST['email']) || empty($_POST['password'])){
	$errors[] = 'Fill the required fields';

}

//validate email
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
$errors[] = 'You must enter a valid email';
}
//password validation po
if(strlen($password) < 6){
$errors[] = 'Password atleast 8 characters';
}
//check kung nag exist ang email
$query = $db->query("SELECT * FROM client WHERE email = '$email'");
$user = mysqli_fetch_assoc($query);
$userCount = mysqli_num_rows($query);
echo $userCount;

if($userCount < 1){
$errors[] = 'The email doesn/`t exist';

}
if(!password_verify($password, $user['password'])){
$errors[] = 'The password is unidentified.try again';
}
if(!empty($errors)){
echo display_errors($errors);
}else{
$user_id = $user['id'];
login_cus($user_id);
}
}
?>

</div>
<h2 class="text-center">Login</h2>
<hr>
<form action="login.php" method="POST">
<div class="form-group">
<label for="email">Email</label>
<input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
</div>
<div class="form-group">
<input type="submit" name="submit" value="Login" class="btn btn-primary">
</div>
</form>
</div>


<?php include 'includes/footer.php'?>