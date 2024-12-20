<?php
require_once 'db.php';
session_start();

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
	echo $_SESSION['score'];
}
if(isset($_POST['login'])){
	$login = tryLogin($_POST['uname'], $_POST['passwd']);
	if($login){
		$_SESSION['uname'] = $_POST['uname'];
		$_SESSION['score'] = $login['score'];
		header('REFRESH:0');
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
			header('REFRESH:0');
		}
	?>
</body>
</html>