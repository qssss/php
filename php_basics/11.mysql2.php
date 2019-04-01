<?php
	// php链接数据库的所有操作 总结成八部 天龙八部

	// 设置头，编码当时是utf-8
	header("Content-Type:text/html;charset=utf-8");

	/*	1.链接数据库
	第一个参数：链接数据库的主机名
	第二个参数：链接数据库的跟用户 root
	第三个参数：root用户的密码*/

	$link = mysql_connect("localhost","root","024");
	// var_dump($link);

	// 2.判断是否链接成功
	if(!$link){
		exit('数据库连接失败');
	}

	// 3.设置字符集 要操作的数据库的编码方式

	mysql_set_charset("utf8");

	// 4.选择数据库
	mysql_select_db("huanghuang");

	// 5.准备sql语句

	$sql = "select * from student";

	// 6.发送sql语句
	$res = mysql_query($sql);
	

	// 7.处理结果集
	$result1 = mysql_fetch_row($res); //返回一个索引数组
	// var_dump($result1);

	// 如何返回多条数据 通过循环来返回
	while ( $row = mysql_fetch_row($res)) {
		var_dump($row);
	}

	$result2 = mysql_fetch_array($res); //返回一个既带索引又带关联的数组

	$result3 = mysql_num_rows($res);//返回数据库中数据的长度

	$result4 = mysql_affected_rows();//返回修改 删除 添加的时候受影响的数据的条数

	// 8.关闭数据库 释放资源
	mysql_close($link);
?>