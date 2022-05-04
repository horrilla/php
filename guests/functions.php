<?php


function post_message() {

	try {
		$name = htmlspecialchars($_POST['guest']);
		$message = htmlspecialchars($_POST['text']);
		$query = "INSERT INTO guests (name, text) VALUES (:name, :text)";
		global $pdo;

		$stmt = $pdo->prepare($query);
		$stmt->execute(['name' => $name, 'text' => $message]);
		$pdo = null;
	} catch (PDOException $e) {
		echo 'Ошибка запроса:' . $e->getMessage();
	}
}

function get_message() {

	try {
		global $pdo;
		$query = "SELECT name, text, date FROM guests ORDER BY id DESC";
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	} catch (PDOException $e) {
		echo 'Ошибка запроса:' . $e->getMessage();
	}
}