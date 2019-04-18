<?php
// 在这里进行删除操作
header('Content-Type:text/html;charset=utf-8');
include_once './lib/fun.php';
if(!checkLogin()) {
	msg(2,'请登录','login.php');
}
//获取当前要删除的商品的id
$goodsId = isset($_GET['id']) ? intval($_GET['id']) : '';
if(!$goodsId) {
	msg(2,'参数非法','index.php');
}

//根据id查询商品的信息 判断商品是否存在
$con = mysqlInit('localhost','root','024','mall');
$sql = "SELECT id FROM goods WHERE id={$goodsId}";
$res = mysql_query($sql);
if(!$goods = mysql_fetch_assoc($res)) {
	msg(2,'画品不存在','index.php');
}
//删除处理
$sql = "DELETE FROM goods WHERE id ={$goodsId} LIMIT 1";

if($res = mysql_query($sql)) {
	msg(1,'删除成功','index.php');
} else {
	msg(2,'删除失败','index.php');
}
?>