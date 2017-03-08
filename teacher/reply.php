<?php
require "../conn.php";
session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['identity']==0){
    header("Location: ../user/index.php");
  }
  if($_SESSION['identity']==1){
    $username = $_SESSION['username'];
  }
  if($_SESSION['identity']==2){
    header("Location: ../admin/index.php");
  }
}else {
// user not signed in
  // echo "<script>window.location.href='../user/login.php'</script>";
  header("location: ../user/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>回复</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="文章发布系统——后台管理系统">
    <meta name="author" content="DreamBoy">
    <link rel="stylesheet" href="../style/css/weui.min.css"/>
    <link rel="stylesheet" href="../style/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../style/css/style.css"/>
	  <link rel="stylesheet" href="../style/css/admin/style.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../style/js/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../style/js/bootstrap.min.js"></script>

</head>
<body>
	<?php
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//获取完整的url
		$url = urldecode($url);//解析获取到的url
		$url = parse_url($url);//解析 URL，返回其组成部分
	 	$str_url = $url['query'];//在问号 ? 之后的传参就是我们需要的
		$str = parse_str($str_url);//将字符串解析成多个变量，"first=value&arr[]=foo+bar&arr[]=baz";
		// echo $id;die();
		$article_id = $id;//直接写$id即可，后面几个也是一样的
		$answer = $answer;
		$ask = $ask;
	?>
<div class="container">
	<form method="post" action="reply_action.php" class="form-horizontal" >
	<div class="form-group">
		<p style="padding-left:10px;padding-top:10px"><?php echo $ask." 回复：".$answer; ?></p>
		<input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
		<input type="hidden" name="answer" value="<?php echo $answer; ?>">
		<input type="hidden" name="ask" value="<?php echo $ask; ?>">
		<div class="col-sm-12">
			<textarea name="content" id="article-des" cols="30" rows="5" class="form-control"></textarea>
		</div>
	</div>
	<input type="submit" class="weui-btn weui-btn_primary" />
	<a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回</a>
</form>
</div>
<div style="width:100%;height:100px;">
</div>
<div class="weui-tabbar">
	<a href="../admin/index.php" class="weui-tabbar__item weui-bar__item_on">
		<span style="display: inline-block;position: relative;">
			<img src="../style/image/icon_nav_layout.png" alt="" class="weui-tabbar__icon">
		</span>
		<p class="weui-tabbar__label">课程列表</p>
	</a>
	<a href="../admin/manage.php" class="weui-tabbar__item">
		<img src="../style/image/icon_nav_form.png" alt="" class="weui-tabbar__icon">
		<p class="weui-tabbar__label">后台管理</p>
	</a>
</div>
</body>
</html>
