<?php
	// if判断
	/*$year = 2002;
	if($year % 400 == 0 || $year % 4 ==0 && $year % 100 !=0) {
		echo "this is runnian";
	}else {
		echo "this is pingnian";
	}*/


	// 多分支语句
	/*$grade = 50;
	if($grade > 90) {
		echo "youxiu";
	} else if ($grade <= 90 && $grade >80) {
		echo "lianghao";
	} else if ($grade <=80 && $grade > 60) {
		echo "yiban";
	} else {
		echo "bujige";
	}*/

	// switch语句

	$grade = 'A';
	// 输入ABCDE 输出对应的百分值区间
	switch($grade) {
		case 'A':
			echo "90%";
			break;
		case 'B':
			echo "80%";
			break;
		case 'C':
			echo "70%";
			break;
		case 'D':
			echo "60%";
			break;
		case 'E':
			echo "50%";
			break;
		default:
			echo "error";
			break;
	}

?>