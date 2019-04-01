<?php
// 这里执行修改操作
header("Content-Type:text/html;charset=utf-8");

// 第一步先获取要修改的数据
$id = $_GET['id'];
echo $id;

// 获取我们需要修改的这条数据的其他信息
$link = mysql_connect('localhost','root','024');
if(!$link) {
	exit('数据库连接失败！');
}
mysql_set_charset('utf8');
mysql_select_db('huanghuang');
$sql = "select * from student where id = {$id}";

$res = mysql_query($sql);
$rows = mysql_fetch_assoc($res);//返回一个关联数组

mysql_close($link);


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	//完成修改的页面
	<form action="doupdate.php">
		<!-- 隐藏表单的方式进行处理 将当前修改的数据的id传过去 -->
		<input type="hidden" name="id" value="<?php echo $rows["id"]?>">
		用户名：&nbsp;&nbsp;<input type="text" name="name" value="<?php echo $rows["name"]?>"><br/>
		语文：&nbsp;&nbsp;<input type="text" name="chinese" value="<?php echo $rows["chinese"]?>"><br/>
		数学：&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="math" value="<?php echo $rows["math"]?>"><br/>
		英语：&nbsp;&nbsp;<input type="text" name="englist" value="<?php echo $rows["englist"]?>"><br/>
		<input type="submit" name="" value="执行修改">
	</form>
</body>
</html>