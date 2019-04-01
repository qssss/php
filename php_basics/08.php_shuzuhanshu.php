<?php
	$arr = array('baoma','benchi','naosilaisi');
	//输出数组的长度
	// echo count($arr)
	// 数组遍历
	for($i=0; $i <count($arr); $i++) { 
		echo $arr[$i].'<br/>';
	}

	// 关联数组的遍历
	$person = array('name'=>'amy','job'=>'web enginer','age'=>23);
	
	// foreach 进行快速遍历
	foreach ($person as $key => $value) {
		echo $key.'-----'.$value.'<br/>';
	}








?>