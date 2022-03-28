<?php

$db = new PDO('mysql:host=127.0.0.1;dbname=clients;', 'root', '');
$query = $db->prepare("SELECT * FROM cliets");
$query->execute();
$response = $query->fetchAll();

if (!$query->execute()) {
	echo '<pre>';
	print_r($query->errorInfo());
	echo '</pre>';
} else {
	echo '<pre>';
	print_r($response);
	echo '</pre>';
}







