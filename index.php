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
//echo '<pre>';
//print_r($query->errorInfo());
//echo '</pre>';

/*$age = 23;

function sayYes() {
	echo "<br>";
	echo 'Yes';
}
sayYes();

Определние констант
const STATE = 3.14;
define("STATE", 3.14);
echo STATE;

Итерполяция
$quantity = 10;
$some_string = "I have " . STATE . " cars";

echo $some_string;

var_dump(STATE);


$string = <<<HERE
I'm $age years old
Are u?
HERE;

echo $string;*/






