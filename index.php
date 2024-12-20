<?php
require_once 'db.php';
session_start();

if(isset($_POST['logout'])){
	updateScore($_SESSION['uname'], $_POST['newScore']);
	$_SESSION['uname'] = null;
	header('REFRESH:0');
}

if(isset($_POST['login'])){
	$login = tryLogin($_POST['uname'], $_POST['passwd']);
	if($login){
		$_SESSION['uname'] = $_POST['uname'];
		$_SESSION['score'] = $login['score'];
		//header('REFRESH:0');
	} else {
		echo 'invalid user';
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
	<?php
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
				<input type='hidden' name='gaming'>
				<input type='submit' name='login' value='Login'>
				or
				<input type='submit' name='register' value='Create Account'>
			</form>
		<?php
	} else {
		$score = getScore($_SESSION['uname']);
		?>
		<div id='logout'>
			<form method='post'>
				<?php echo "<input id='saveScore' type='hidden' name='newScore' value='$score'>"?>
				<input type='submit' name='logout' value='Logout'>
			</form>
		</div>
		<div id='game' onclick='upScore()'>
			<img src='./images/cookie.png' alt='cookie'>
			<?php
		echo '<span id="counter"><mark>'.$score.'</mark></span>';
			?>
		</div>
		<?php
	}
	?>
	<script>
		var counter = document.getElementById('counter');
		var save = document.getElementById('saveScore');
		var score = parseInt(counter.innerText);

		function upScore(){
			score++;
			counter.innerHTML = "<mark>"+score+"</mark>";
			save.value = score;
		}
	</script>
	<!--script src="script.js"></script-->
</body>
</html>