<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>动态网页</title>
</head>
<style type="text/css">
	* {padding: 0;}
	.menulist {list-style: none;width: 80px;border: 1px solid blank;border-bottom: none;}
	.menilist li {border-bottom: 1px dashed gray;padding: 5px;}
</style>
<body>
	<!-- 假设所有的数据都是从数据库中取出的 所以我们将所有的数据放在一个数组里  -->
	<?php
		$arr = array("数码产品","生活家居","母婴用品","厨房用具")
	?>
	<ul class="menulist">
		<?php for($i=0;$i<count($arr);$i++){ ?>
			<li>
				<?php print $arr[$i];?>
			</li>
		<?php } ?>
	</ul>
</body>
</html>