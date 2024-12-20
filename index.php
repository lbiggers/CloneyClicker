<?php
require_once 'db.php';
session_start();

$tmp = tryLogin('temp','temp');
if($tmp){
	echo $tmp;
} else { echo'fail'; }

if(!isset($_SESSION['uname'])){
	//header('LOCATION:login.php');
	?>	
		<form method='post'>
			<label>Username:</label>
			<input type='text' name='uname'>
			<br>
			<label>Password:</label>
			<input type='password' name='passwd'>
			<br>
			<input type='submit' name='login' value='Login'>
		</form>
	<?php
} else {
	?>
		<h1>success</h1>
	<?php
}
if(isset($_POST['login'])){
	if(tryLogin($_POST['uname'], $_POST['passwd']) == 1){
		$_SESSION['uname'] = $_POST['uname'];
		header('LOCATION:index.php');
	} else {
		echo 'wrong info';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cloney Clicker</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<script src="script.js"></script>
	<form method='post'>
		<input type='submit' name='logout' value='Logout'>
	</form>
	<?php
		if(isset($_POST['logout'])){
			$_SESSION['uname'] = null;
		}
	?>
</body>
</html>