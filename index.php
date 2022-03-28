<?php

$data = [
	'login' => '  <script>vova</script>  ',
	'password' => 'asdqQYY1238OIEK)))'
];
$data['login'] = strip_tags(trim($data['login']));
$data['password'] = htmlspecialchars(trim($data['password']));

$db = new PDO('mysql:host=127.0.0.1;dbname=clients;', 'root', '');
$query = $db->prepare("INSERT INTO users SET login=:login, password=:password");
$query->execute($data);
$response = $query->fetchAll();


$query = $db->prepare("SELECT * FROM users");
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







