<?php
header('Content-Type:text/html;charset=utf-8');
?>

<!DOCTYPE html>
<html>
<head>
	<title>这里执行添加操作</title>
</head>
<body>
	<form action="doinsert.php">
		id:<input type="text" name="id" value="" placeholder="请输入id"><br/><br/>
		用户名：<input type="text" name="name" placeholder="请填写用户名"><br/><br/>
		语文：<input type="text" name="chinese" placeholder="请填写语文成绩"><br/><br/>
		英语：<input type="text" name="englist" placeholder="请填写英语成绩"><br/><br/>
		数学：<input type="text" name="math" placeholder="请填写数学成绩"> <br/><br/>
		<input type="submit" name="" value="添加">
	</form>
</body>
</html>