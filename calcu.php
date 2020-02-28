<form action='calcu.php' method='POST'>
<input type='text' placeholder='first number' name='name'>
<input type='submit' name='submit'>
</form>

<?php

if(isset($_POST['submit'])){
$t = $_POST['name'];
echo "Hello ".$t;

}
?>