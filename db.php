<?php
function connectDB(){
	$host = 'localhost';
	$db = 'main';
	$user = 'server';
	$pass = 'P@ssw0rd';
	$charset = 'utf8mb4';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false
	];

	return new PDO($dsn, $user, $pass, $options);
}

function tryLogin($uname, $passwd) { 
	try { 
		$dbh = connectDB(); 
		$statement = $dbh->prepare("SELECT user, score FROM users WHERE user = :uname AND pass = sha2(:passwd,256)"); 
		$statement->bindParam(":uname", $uname); 
		$statement->bindParam(":passwd", $passwd); 
		$statement->execute();
		$result = $statement->fetch();

		return $result;
	} catch (PDOException $e) { 
		print "Error!" . $e->getMessage() . "<br/>"; 
		die(); 
	} 
}

function newUser($uname, $passwd){
	try{
		$dbh = connectDB();
		$statement = $dbh->prepare("INSERT INTO users (user, pass, score) VALUES (:uname, sha2(:passwd,256), 0)"); 
		$statement->bindParam(":uname", $uname);
		$statement->bindParam(":passwd", $passwd);
		try { $statement->execute(); }
		catch (Exception $e) {
			echo '<script>alert("username in use");</script>';
			die();
		}
		echo "<script>alert('account \"$uname\" registered! Now log in.');</script>";
	} catch (PDOException $e) {
		echo "Error: '". $e->getMessage() ."'";
	}
}

function getScore($uname){
	try { 
		$dbh = connectDB();

		$statement = $dbh->prepare("SELECT score FROM users WHERE user = :uname");
		$statement->bindParam(":uname", $uname);
		$statement->execute();
		
		return $statement->fetch()['score'];
	} catch (PDOException $e) { 
		print "Error!" . $e->getMessage() . "<br/>"; 
		die(); 
	}
}

function updateScore($uname,$score): void{
	try { 
		$dbh = connectDB();
		$statement = $dbh->prepare("UPDATE users SET score = $score WHERE user = :uname");
		$statement->bindParam(":uname", $uname);
		$statement->execute();
	} catch (PDOException $e) { 
		print "Error!" . $e->getMessage() . "<br/>"; 
		die(); 
	}
}
?>