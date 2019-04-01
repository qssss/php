<?php
header('Content-Type:text/html;charset=utf-8');

$id = $_GET['id'];
$name = $_GET['name'];
$chinese = $_GET['chinese'];
$englist = $_GET['englist'];
$math = $_GET['math'];
echo $id;

echo "这里执行添加操作哟<br/><br/>";
$link = mysql_connect('localhost','root','024');
if(!$link) {
	exit('连接数据库失败！');
}
mysql_set_charset('utf8');
mysql_select_db('huanghuang');
$sql = "insert into student(id,name,chinese,englist,math) values($id,'$name','$chinese','$englist','$math')";
$res = mysql_query($sql);
var_dump($res);

if($res && mysql_affected_rows($link)) {
	echo "添加成功<a href='12.userlist.php'>返回首页</a>";
} else {
	echo "添加失败";
}

mysql_close($link);


?>