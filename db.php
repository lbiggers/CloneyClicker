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
		$statement = $dbh->prepare("SELECT score FROM users WHERE user = :uname AND pass = sha2(:passwd,256) "); 
		$statement->bindParam(":uname", $uname); 
		$statement->bindParam(":passwd", $passwd); 
		$statement->execute();
		$result = $statement->fetch();

		return $result['score'];
	} catch (PDOException $e) { 
		print "Error!" . $e->getMessage() . "<br/>"; 
		die(); 
	} 
}

function newUser(){
	try{
		$dbh = connectDB();
		echo $dbh->query("select * from users;");
	} catch (PDOException $e) {
		echo "Error: '". $e->getMessage() ."'";
	}
}
?>