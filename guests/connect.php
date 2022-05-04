<?php

$host = 'localhost';
$db = 'guestbook';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$opt = [
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];


try {
	$pdo = new PDO($dsn, $user, $pass, $opt);
	return $pdo;
} catch (PDOException $e) {
	echo 'Connection failed:' . $e->getMessage() . '<br>';
}

