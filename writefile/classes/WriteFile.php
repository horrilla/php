<?php


class WriteFile
{
	public $file;
	public $handle;


	public function __construct($filepath) {

		$this->file = $filepath;

		if(!is_writable($this->file)) {
			echo "Файл {$this->file} недоступен для записи";
			exit();
		}

		$this->handle = fopen($this->file, 'a');


	}

	public function writeFile($string) {
		$write = fwrite($this->handle, $string . PHP_EOL);

		if($write != false) {
			echo "Запись в файл {$this->file} произошла успшено" . '<br>';
		} else {
			echo "Запись в файл {$this->file} не выполнена" . '<br>';
		}
	}
	public function __destruct() {
		fclose($this->handle);
	}
}