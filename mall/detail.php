<?php 
	 header('Content-type:text/html;charset=utf-8');
	 // echo '欢迎来到主页';
     include_once './lib/fun.php';

     //验证用户是否登录
     if($login = checkLogin()){
        $user = $_SESSION['user'];
     }else{
        msg(2, '请登录', 'login.php');
     }

     $goodsId = isset($_GET['id']) ? intval($_GET['id']) : '';
     if(!$goodsId){
     	msg(2, '参数非法', 'index.php');
     }

     //根据商品id查询商品的信息
     //1、链接数据库
     $con = mysqlInit('localhost', 'root', '024', 'mall');
     $sql = "SELECT * FROM goods WHERE id = {$goodsId}";
     $res = mysql_query($sql);
     if(!$goods = mysql_fetch_assoc($res)){
     	msg(2, '画品不存在', 'index.php');
     }

     //商品信息里，记录发布这条商品的用户id
     unset($sql, $res);
     //根据用户id，去查询发布人
     $sql = "select * from users where id = {$goods['user_id']}";
     $res = mysql_query($sql);
     $user = mysql_fetch_assoc($res);
     // var_dump($user);

     //更新浏览次数
     $sql = "update goods set view=view+1 where id = {$goods['id']}";
     mysql_query($sql);

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>M-GALLARY|千锋</title>
    <link rel="stylesheet" type="text/css" href="./static/css/common.css" />
    <link rel="stylesheet" type="text/css" href="./static/css/detail.css" />
</head>
<body class="bgf8">
<div class="header">
    <div class="logo f1">
        <img src="./static/image/logo.png">
    </div>
    <div class="auth fr">
        <ul>
             <?php if($login): ?>
                <li><span>管理员: <?php echo $user['username'] ?></span></li>
                <li><a href="login_out.php">退出</a></li>
            <?php else: ?>
                <li><a href="login.php">登录</a></li>
                <li><a href="register.php">注册</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="content">
    <div class="section" style="margin-top:20px;">
        <div class="width1200">
            <div class="fl"><img src="<?php echo $goods['pic']?>" width="720px" height="432px"/></div>
            <div class="fl sec_intru_bg">
                <dl>
                    <dt><?php echo $goods['name'] ?></dt>
                    <dd>
                        <p>发布人：<span><?php echo $user['username'] ?></span></p>
                        <p>发布时间：<span><?php echo date('Y年m月d日', $goods['create_time']) ?></span></p>
                        <p>修改时间：<span><?php echo date('Y年m月d日', $goods['update_time']) ?></span></p>
                        <p>浏览次数：<span><?php echo $goods['view'] ?></span></p>
                    </dd>
                </dl>
                <ul>
                    <li>售价：<br/><span class="price"><?php echo $goods['price'] ?></span>元</li>
                    <li class="btn"><a href="javascript:;" class="btn btn-bg-red" style="margin-left:38px;">立即购买</a></li>
                    <li class="btn"><a href="javascript:;" class="btn btn-sm-white" style="margin-left:8px;">收藏</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="secion_words">
        <div class="width1200">
            <div class="secion_wordsCon">
               <?php echo $goods['content'] ?>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p><span>M-GALLARY</span>©2017 POWERED BY 千锋</p>
</div>
</div>
</body>
</html>

