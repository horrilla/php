<?php

require_once 'functions.php';
require_once 'connect.php';

if (!empty($_POST)) {
	post_message();
	header("Location: {$_SERVER['PHP_SELF']}");
	exit;
}

$messages = get_message();

?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Гости</title>

	<style>
		.messages {
			margin: 15px auto;
			width: auto;
			border: 1px solid black;
		}

		.author {
			margin: 5px 0 0 10px;
			font-size: 18px;
			font-weight: bold;
		}

		.message {
			margin: 5px 0 10px 10px;
			font-size: 17px;
		}
	</style>

</head>
<body>
	<form action="index.php" method="post">
		<p>
			<label for="name">Имя</label><br>
			<input type="text" name="guest" id="name">
		</p>
		<p>
			<label for="text">Сообщение</label><br>
			<textarea name="text" id="text" cols="30" rows="10"></textarea>
		</p>
		<p>
			<button name="btn" type="submit">Отправить</button>
		</p>
		<hr>
		<?php if (!empty($messages)): ?>
			<?php foreach ($messages as $message): ?>
					<div class="messages">
						<p class="author">Автор: <?= $message['name']; ?>, Дата: <?= $message['date']; ?></p>
						<div class="message">
							<?= nl2br($message['text']); ?>
						</div>
					</div>
			<?php endforeach; ?>
		<?php endif; ?>




	</form>


</body>
</html>

