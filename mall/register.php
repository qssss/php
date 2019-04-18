<?php
header('Content-Type:text/html;charset=utf-8');
if(!empty($_POST['username'])) {
	//引入func文件
	include_once './lib/fun.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	if(!$username) {
		// echo "用户名不能为空";
		// exit;
		msg(2,'用户名不能为空');
	}
	if(!$password) {
		// echo "密码不能为空";
		// exit;
		msg(2,'密码不能为空');
	}
	if(!$repassword) {
		// echo "确认密码不能为空";
		// exit;
		msg('确认密码不能为空');
	}
	if($password!=$repassword) {
		// echo "两次密码输入不一致";
		msg('两次密码输入不一致');
	}
	//连接数据库 发送sql语句 查询该用户是否注册过 如果没有注册 直接往数据库插入数据 反之跳转到登录页面

	

	$link = mysqlInit('localhost','root','024','mall'); 

	if(!$link) {
		mysql_error('数据库连接失败');
		exit;
	}
	$sql = "SELECT count('id') as total FROM users WHERE username='{$username}'";
	$result = mysql_query($sql);
	//返回代表都去行的关联数组 如果结果集中没有更多的行 则返回null
	$res = mysql_fetch_assoc($result);
	// isset判断某个变量是否有值 有则返回true 没有则返回false
	if (isset($res['total']) && $result['total']>0) {
		// echo "用户名已经存在";
		// exit;
		msg(2,'用户名已经存在');
	}
	$password = createPassword($password);
	$now = $_SERVER['REQUEST_TIME'];
	$sql = "insert into users(username,password,create_time) values('$username','$password','$now')";
	$res = mysql_query($sql);
	if($res) {
		$userId = mysql_insert_id();//获取到插入成功的id
		// echo '恭喜你注册成功';
		// header('location:./msg.php');
		msg(1,'恭喜你注册成功','login.php');
	}else {
		mysql_error();
		exit;
	}
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>M-GALLARY|用户注册</title>
    <link type="text/css" rel="stylesheet" href="./static/css/common.css">
    <link type="text/css" rel="stylesheet" href="./static/css/add.css">
    <link rel="stylesheet" type="text/css" href="./static/css/login.css">
</head>
<body>
<div class="header">
    <div class="logo f1">
        <img src="./static/image/logo.png">
    </div>
    <div class="auth fr">
        <ul>
            <li><a href="login.php">登录</a></li>
            <li><a href="register.php">注册</a></li>
        </ul>
    </div>
</div>
<div class="content">
    <div class="center">
        <div class="center-login">
            <div class="login-banner">
                <a href="#"><img src="./static/image/login_banner.png" alt=""></a>
            </div>
            <div class="user-login">
                <div class="user-box">
                    <div class="user-title">
                        <p>用户注册</p>
                    </div>
                    <form class="login-table" name="register" id="register-form" action="register.php" method="post">
                        <div class="login-left">
                            <label class="username">用户名</label>
                            <input type="text" class="yhmiput" name="username" placeholder="Username" id="username">
                        </div>
                        <div class="login-right">
                            <label class="passwd">密码</label>
                            <input type="password" class="yhmiput" name="password" placeholder="Password" id="password">
                        </div>
                        <div class="login-right">
                            <label class="passwd">确认</label>
                            <input type="password" class="yhmiput" name="repassword" placeholder="Repassword"
                                   id="repassword">
                        </div>
                        <div class="login-btn">
                            <button type="submit">注册</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p><span>M-GALLARY</span> ©2017 POWERED BY 千锋</p>
</div>

</body>
<script src="./static/js/jquery-1.10.2.min.js"></script>
<script src="./static/js/layer/layer.js"></script>
<script>
    $(function () {
        $('#register-form').submit(function () {
            var username = $('#username').val(),
                password = $('#password').val(),
                repassword = $('#repassword').val();
            if (username == '' || username.length <= 0) {
                layer.tips('用户名不能为空', '#username', {time: 2000, tips: 2});
                $('#username').focus();
                return false;
            }

            if (password == '' || password.length <= 0) {
                layer.tips('密码不能为空', '#password', {time: 2000, tips: 2});
                $('#password').focus();
                return false;
            }

            if (repassword == '' || repassword.length <= 0 || (password != repassword)) {
                layer.tips('两次密码输入不一致', '#repassword', {time: 2000, tips: 2});
                $('#repassword').focus();
                return false;
            }
            return true;
        })
    })
</script>
</html>


