<?php
header("Content-Type:text/html;charset=utf-8");
echo '这里执行删除操作<br/>';


// 获取当前要删除的数据的id
$id =  $_GET['id'];

$link = mysql_connect('localhost','root','024');
if(!$link) {
	exit('数据库连接失败');
}

mysql_set_charset('utf8');
mysql_select_db('huanghuang');

$sql = "delete from student where id = {$id}";

$res = mysql_query($sql);

// mysql_affected_rows($links);//删除受影响的数据不为0
if($res && mysql_affected_rows($link)) {
	echo "删除成功<a href='12.userlist.php'>返回首页</a>";
} else {
	echo "删除失败";
}

mysql_close($link);

?>