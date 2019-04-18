<?php
function mysqlInit($hostname,$username,$password,$dbname) {
	$link = mysql_connect($hostname,$username,$password);
	if(!$link) {
		return false;
	}
	mysql_select_db($dbname);
	mysql_set_charset('utf8');
	return $link;
}

function createPassword($password) {
	if(!$password) {
		return false;
	}
	return md5(md5($password).'huanghuang');
}

function msg($type,$msg=null,$url=null) {
	$toUrl = "location:msg.php?type={$type}";
	$toUrl .= $msg ? "&msg={$msg}":"";
	$toUrl .= $url ? "&url={$url}":"";
	header($toUrl);
	exit;
}

//图片上传的函数
function imgUpload($file) {
	// 先对上传的图片进行处理 将其存储到服务器的磁盘文件中 然后再将路径返回
	// $file = $_FILES['file'];
	//校验上传图片 
	//检验上传图片是否是合法的
	//is_uploaded_file 如果上传图片合法 返回true 不合法返回false
	if(!is_uploaded_file($file['tmp_name'])) {
	    msg(2,'请上传符合规范的图片');
	}
	//验证上传图片的类型
	$type = $file['type'];
	if(!in_array($type, array('image/jpeg','image/gif','image/png'))) {
	    msg(2,'请上传jpeg,gif,或者png类型的图片');
	}
	//图片校验完成之后 将图片上传到服务器的磁盘路径下
	//1、知道上传到服务器的哪个磁盘路径下
	//这是物理地址
	$uploadPath = './static/file';
	//url访问的地址
	$uploadUrl = '/static/file';
	//要对图片进行分类存储 通过上传日期进行分类 按照日期生成子文件目录
	
	$fileDir = date('Y/md/',$now);
	//检查上传目录是否存在
	if(!is_dir($uploadPath.$fileDir)) {
	    //如果上传路径不存在 则自己创建目录
	    mkdir($uploadPath.$fileDir,0755,true);
	}
	//拿到上传图片的拓展名字 jpg JPG 为了不产生歧义  将拓展名字都改成小写的后缀
	$ext = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
	//生成文件名 必须时唯一的
	//uniqid 针对微秒随机生成一个串
	$img = uniqid().rand(1000,9999).'.'.$ext;
	//上传图片的物理路径和url路径进行拼接 准备开始上传
	$imgPath = $uploadPath.$fileDir.$img;
	$imgUrl = 'http://localhost/mall'.$uploadUrl.$fileDir.$img;
	//进行上传处理
	if(!move_uploaded_file($file['tmp_name'], $imgPath)) {
	    msg(2,'服务器繁忙，请稍后重试');
	}
	return $imgUrl;
}

//检查用户是否登录
function checkLogin() {
	session_start();
	if(!isset($_SESSION['user']) && empty($_SESSION['user'])) {
		return false;
	} 
	return true;
}

/**
 * 获取当前url
 * @return string
 */
function getUrl()
{
    $url = '';
    $url .= $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    return $url;
}


/**
 * 根据page生成url
 * @param $page
 * @param string $url
 * @return string
 */
function pageUrl($page, $url = '')
{
    $url = empty($url) ? getUrl() : $url;
    //查询url中是否存在?
    $pos = strpos($url, '?');
    if($pos === false)
    {
        $url .= '?page=' . $page;
    }
    else
    {
        $queryString = substr($url, $pos + 1);
        //解析querystring为数组
        parse_str($queryString, $queryArr);
        if(isset($queryArr['page']))
        {
            unset($queryArr['page']);
        }
        $queryArr['page'] = $page;

        //将queryArr重新拼接成queryString
        $queryStr = http_build_query($queryArr);

        $url = substr($url, 0, $pos) . '?' . $queryStr;

    }
    return $url;

}
/**
 * 分页显示
 * @param  int $total 数据总数
 * @param  int $currentPage 当前页
 * @param  int $pageSize 每页显示条数
 * @param  int $show 显示按钮数
 * @return string
 */
function pages($total, $currentPage, $pageSize, $show = 6)
{
    $pageStr = '';

    //仅当总数大于每页显示条数 才进行分页处理
    if($total > $pageSize)
    {
        //总页数
        $totalPage = ceil($total / $pageSize);//向上取整 获取总页数

        //对当前页进行处理
        $currentPage = $currentPage > $totalPage ? $totalPage : $currentPage;
        //分页起始页
        $from = max(1, ($currentPage - intval($show / 2)));
        //分页结束页
        $to = $from + $show - 1;


        $pageStr .= '<div class="page-nav">';
        $pageStr .= '<ul>';

        //仅当 当前页大于1的时候 存在 首页和上一页按钮
        if($currentPage > 1)
        {
            $pageStr .= "<li><a href='" . pageUrl(1) . "'>首页</a></li>";
            $pageStr .= "<li><a href='" . pageUrl($currentPage - 1) . "'>上一页</a></li>";
        }
        //当结束页大于总页
        if($to > $totalPage)
        {
            $to = $totalPage;
            $from = max(1, $to - $show + 1);
        }
        if($from > 1)
        {
            $pageStr .= '<li>...</li>';
        }
        for($i = $from; $i <= $to; $i++)
        {
            if($i != $currentPage)
            {
                $pageStr .= "<li><a href='" . pageUrl($i) . "'>{$i}</a></li>";
            }
            else
            {
                $pageStr .= "<li><span class='curr-page'>{$i}</span></li>";
            }
        }


        if($to < $totalPage)
        {
            $pageStr .= '<li>...</li>';

        }

        if($currentPage < $totalPage)
        {
            $pageStr .= "<li><a href='" . pageUrl($currentPage + 1) . "'>下一页</a></li>";
            $pageStr .= "<li><a href='" . pageUrl($totalPage) . "'>尾页</a></li>";
        }

        $pageStr .= '</ul>';
        $pageStr .= '</div>';

    }

    return $pageStr;

}



?>