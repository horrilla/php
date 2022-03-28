<?php

$str_num = '';
for ($i = 1; $i <= 10000; $i++) {
	$str_num .= (string) $i;
}

$arr = [];
while (strlen($str_num) > 2) {
	$sub = substr($str_num, 0, 3);
		if (!($sub[2] - $sub[1] == 1 && $sub[1] - $sub[0] == 1))
			array_push($arr, $sub);
		$str_num = str_replace($sub, "", $str_num);
		echo $str_num . '<br>';
}

echo "Сумма оставшихся чисел = " . array_sum($arr);











