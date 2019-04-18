<?php 
	  header('Content-type:text/html;charset=utf-8');
    include_once './lib/fun.php';
    //验证用户是否登录
    if($login = checkLogin()){
       $user = $_SESSION['user'];
    }else{
       msg(2, '请登录', 'login.php');
    }
    //表单是否进行了提交处理
    if(!empty($_POST['name'])){
    	//链接数据库
    	$con = mysqlInit('localhost', 'root', '024', 'mall');

    	//拿到商品的id
    	if(!$goodId = intval($_POST['id'])){
    		msg(2, '参数非法');
    	}

    	//根据商品的id更改商品的信息
    	//查询商品是否存在
    	$sql = "SELECT * FROM goods WHERE id = {$goodId}";
    	// echo $sql;
    	$res = mysql_query($sql);
    	if(!$goods = mysql_fetch_assoc($res)){
    		msg(2, '画品不存在', 'index.php');
    	}

    	//获取表单信息
    	$name = $_POST['name'];
    	$price = intval($_POST['price']);
    	$des = $_POST['des'];
    	$content = $_POST['content'];

    	/*
			php验证，表单提交过来的数据，是否符合提交条件
    	*/
		//在这里对提交上来的数据再进行一次验证
       $nameLength = mb_strlen($name, 'utf-8');
       if($nameLength <= 0 || $nameLength > 30){
            msg(2, '画品名称应该是1-30之内');
       }

       $desLength = mb_strlen($des, 'utf-8');
       if($nameLength <= 0 || $nameLength > 100){
            msg(2, '画品简介应该是1-100之内');
       }

       if($price <= 0 || $price > 999999999){
            msg(2, '画品价格应该小于999999999');
       }
       if(empty($content)){
            msg(2, '画品详情不能为空');
       }

       //那些数据做了修改，那些数据泪又做修改

      	$update = array(
      		'name' => $name,
      		'price' => $price,
      		'des' => $des,
      		'content' => $content
      		);
      	//校验一下商品的图片
      	if($_FILES['file']['size'] > 0){
      		$pic = imgUpload($_FILES['file']);
      		$update['pic'] = $pic;
      	}

      	//对比数据库的数据，只更新要被更改的数据，
      	foreach ($update as $key => $value) {
      		if($goods[$key] == $value){
      			//如果发现有没有更改的数据，那么删除
      			unset($update[$key]);
      		}
      	}

      	if(empty($update)){
      		msg(2, '操作成功', 'edit.php?id='.$goodsId);
      	}

      	//更新sql处理
      	$updateSql = '';
      	foreach ($update as $key => $value) {
      		$updateSql .= "{$key}='{$value}',";
      	}
      	
      	//上述这样拼接字符串，会多出一个逗号，我们可以通过字符串函数去除逗号
      	$updateSql = rtrim($updateSql, ',');
      	// echo $updateSql;

      	$sql = "update goods set {$updateSql} where id = {$goodId}";
      	// echo $sql;
      	//更新
      	if($res = mysql_query($sql)){
      		msg(1, '操作成功', 'edit.php?id='.$goodId);
      	}else{
      		msg(2, '操作失败', 'edit.php?id='.$goodId);
      	}
    }
 ?>