<?php
header('Content-Type:text/html;charset=utf-8');
include_once './lib/fun.php';
if($login = checkLogin()) {
    $user = $_SESSION['user'];
} else {
    msg(2,'请登录','login.php');
}
//显示所有需要添加的画品
$con = mysqlInit('localhost','root','024','mall');
//查找数据库中一共有多少条数据
$sql = "SELECT count(*) as total FROM goods";
$res = mysql_query($sql);
$pageRes = mysql_fetch_assoc($res); //查询出来的总数
$total = isset($pageRes['total']) ? $pageRes['total'] : 0;
//获取请求中page这个参数
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//把page和1比较 取得最大值
$page = max($page,1);
//每条显示的条数
$pageSize = 3;
$offset = ($page - 1) * $pageSize;
$sql = "SELECT * FROM goods ORDER BY id asc,view desc LIMIT {$offset},{$pageSize}";
$res = mysql_query($sql);
$goods = array();
while ($result = mysql_fetch_assoc($res)) {
    $goods[] = $result;
}

$pages = pages($total,$page,$pageSize,5);
?> 

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>M-GALLARY|首页</title>
    <link rel="stylesheet" type="text/css" href="./static/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="./static/css/index.css"/>
</head>
<body>
<div class="header">
    <div class="logo f1">
        <img src="./static/image/logo.png">
    </div>
    <div class="auth fr">
        <ul>
            <?php if($login): ?>
            <li><span>管理员:<?php echo $user['username']?></span></li>
            <li><a href="login_out.php">退出</a></li>
             <?php else: ?>
                <li><a href="login.php">登录</a></li>
                <li><a href="register.php">注册</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="content">
    <div class="banner">
        <img class="banner-img" src="./static/image/welcome.png" width="732px" height="372" alt="图片描述">
    </div>
    <div class="img-content">
        <ul>
            <?php foreach($goods as $v):?>
            <li>
                <img class="img-li-fix" src="<?php echo $v['pic']?>" alt="">
                <div class="info">
                    <a href="detail.php?id=<?php echo $v['id']?>"><h3 class="img_title"><?php echo $v['name']?></h3></a>
                    <p>
                       <?php echo $v['des']?>
                    </p>
                    <div class="btn">
                        <a href="edit.php?id=<?php echo $v['id']?>" class="edit">编辑</a>
                        <a href="delete.php?id=<?php echo $v['id']?>" class="del">删除</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php echo $pages?>
</div>

<div class="footer">
    <p><span>M-GALLARY</span>©2017 POWERED BY 千锋</p>
</div>
</body>
<script src="./static/js/jquery-1.10.2.min.js"></script>
<script>
    $(function () {
        $('.del').on('click',function () {
            if(confirm('确认删除该画品吗?'))
            {
               window.location = $(this).attr('href');
            }
            return false;
        })
    })
</script>


</html>
