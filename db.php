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

function newUser(){
	try{
		$dbh = connectDB();
		echo $dbh->query("select * from users;");
	} catch (PDOException $e) {
		echo "Error: '". $e->getMessage() ."'";
	}
}
?>