<?php

/*设置php的编码方式 接收客户端表单提交的内容 拼接成一个字符串*/
header("Content-Type: text/html;charset=utf-8");
error_reporting();
/*在系统或者应用程序出错的时候弹出的错误报告 编码人员 根据弹出的消息 判断到底是哪一步出错*/

// 接收表单的内容
// 全局数组
// $POST 一个全局数组 会自动接收通过get请求传输过来的数据 并且以关联数组的方式去进行存储
var_dump($_POST);
$username = $_POST['username'];
$age = $_POST['age'];
$password = $_POST['password'];

echo '你的名字叫做：'.$username.',年龄：'.$age.',密码：'.$password;




?>