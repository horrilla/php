<?php

require_once 'classes/WriteFile.php';

$file = new WriteFile(__DIR__ . '/files/file.txt');
$file->writeFile('Это пятая запись');