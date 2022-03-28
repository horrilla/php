<?php

include 'simple_html_dom.php';

$html = file_get_html('https://horrilla.github.io/');

function detectZ ($data) {
	$re = "/[зЗ]/u";
	$count = 0;
	foreach ($data->find('a') as $element) {
		$str = (string) $element->plaintext;
		preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
		foreach ($matches as $arr => $index) {
			foreach ($index as $value) {
				$count += mb_strlen($value);
			}
		}
	}
	return $count;
}

echo detectZ($html);




