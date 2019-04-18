<?php
header('Content-Type:text/html;charset=utf-8');
$type = isset($_GET['type']) && in_array($_GET['type'], array(1,2)) ? intval($_GET['type']) : 1;
$title = $type == 1 ? '操作成功':'操作失败';
$msg = isset($_GET['msg']) ? $_GET['msg'] : '操作成功';
$url = isset($_GET['url']) ? $_GET['url'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="./static/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="./static/css/done.css"/>
</head>
<body>
<div class="header">
    <div class="logo f1">
        <img src="./static/image/logo.png">
    </div>
</div>
<div class="content">
    <div class="center">
        <div class="image_center">
            <?php if($type == 1):?>
            <span class="smile_face">:)</span>  
            <?php else:?>
            <span class="smile_face">:(</span>
            <?php endif;?>
        </div>
        <div class="code">
            <?php echo $msg ?>
        </div>
        <div class="jump">
            页面在 <strong id="time" style="color: #009f95">5</strong> 秒 后跳转
        </div>
    </div>

</div>
<div class="footer">
    <p><span>M-GALLARY</span>©2017 POWERED BY 千锋</p>
</div>
</body>
<script src="./static/js/jquery-1.10.2.min.js"></script>
<script>
    $(function () {
        var url = "<?php echo $url ?>" || null; //js读取php变量
        var time = 5;
        setInterval(function () {
            if (time > 1) {
                time--;
                console.log(time);
                $('#time').html(time);
            }
            else {
                $('#time').html(0);
                   if(url){
                        location.href = url;
                   }else{
                        history.go(-1);
                   }
            }
        }, 1000);

    })
</script>
</html>
