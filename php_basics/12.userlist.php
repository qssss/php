<?php
// 展示用户信息
// header("Content-Type:text/html;charset=utf-8");

header('Content-Type:text/html;charset=utf-8');

// 1.链接数据库
$link = mysql_connect('localhost','root','024');

// 2.判断是否链接成功
if(!$link) {
	exit('链接数据库失败');
}

// 3.设置字符集
mysql_set_charset('utf8');


// 4.选择数据库
mysql_select_db('huanghuang');

// 开始分页显示

// step1:求出总条数
$sql = "select count(*) as count from student";
$result = mysql_query($sql);
$pageRes = mysql_fetch_assoc($result);
$count = $pageRes['count'];
// echo $count;

// step2:每页显示的条数5条
$num = 3;
// 根据每页显示数量 求出总页数
$pagecount = ceil($count / $num);
$page = empty($_GET["page"]) ? 1: $_GET["page"];

// 求出偏移量
$offset = ($page - 1) * $num;

// 结束分页显示


// 5.准备sql语句
$sql = "select * from student limit ".$offset.",".$num;

// 6.发送sql语句
$res = mysql_query($sql);

// 7.处理结果集
// $result = mysql_fetch_assoc($res);
// var_dump($result) ;

// 在页面上以表格形式 显示我们的数据
echo '<a href="insert.php">添加</a>';
echo '<table width="600" border="1">';
	echo '<th>编码</th><th>姓名</th><th>语文</th><th>英语</th><th>数学</th><th>操作</th>';
	while ($rows = mysql_fetch_assoc($res)) {
		echo '<tr>';
			echo "<td>{$rows['id']}</td>";
			echo "<td>{$rows['name']}</td>";
			echo "<td>{$rows['chinese']}</td>";
			echo "<td>{$rows['englist']}</td>";
			echo "<td>{$rows['math']}</td>";
			echo "<td><a href='delete.php?id={$rows['id']}'>删除</a><a href='update.php?id={$rows['id']}'>编辑</a></td>";
		echo '<tr>';
	}
echo '<table>';


// 计算上一页和下一页的页码
$prev = $page - 1;
$next = $page + 1;
if($prev < 1) {
	$prev = 1;
}
if($next > $pagecount) {
	$next = $pagecount;
}

echo "<a href='12.userlist.php?page=1'>首页</a><a href='12.userlist.php?page={$prev}'>上一页</a><a href='12.userlist.php?page={$next}'>下一页</a><a href='12.userlist.php?page={$pagecount}'>尾页</a>";
?>
<style type="text/css">
	td {text-align: center;}
	a {display: inline-block;margin: 0 8px;}

</style>