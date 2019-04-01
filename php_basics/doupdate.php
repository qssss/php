<?php
header("Content-Type:text/html;charset=utf-8");
// 这里执行提交修改的操作
echo '这里执行提交修改操作<br/>';
$id = $_GET['id'];
$name = $_GET['name'];
$chinese = $_GET['chinese'];
$math = $_GET['math'];
$englist = $_GET['englist'];

$link = mysql_connect('localhost','root','024');
if(!$link) {
	exit('数据库连接失败！');
}
mysql_set_charset('utf8');
mysql_select_db('huanghuang');
$sql = "update student set name='$name',math='$math',chinese='$chinese',englist='$englist' where id = $id";
$res = mysql_query($sql);
echo mysql_affected_rows($link);
if($res && mysql_affected_rows($link)) {
	echo '修改成功<a href="12.userlist.php">返回首页</a>';
}else {
	echo '修改失败';
}
?>