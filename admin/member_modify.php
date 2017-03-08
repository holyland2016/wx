<?php
require "../conn.php";
session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['identity']==0){
    header("Location: ../user/index.php");
  }
  if($_SESSION['identity']==1){
    header("Location: ../teacher/index.php");
  }
  if($_SESSION['identity']==2){

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
	<title>修改用户身份</title>
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
	// require_once('../conn.php');
	$id = intval($_GET['id']);
	$identity = $_POST['identity'];
	// echo $identity;die();
	// $deletesql = "delete from wx_article where id=$id";
	$sql = "update wx_user set identity='$identity' where id='$id'";
	// echo $sql;die();
  $query= $mysqli->query($sql);
  // echo $query;die();
	if($query) {
		echo '<div class="page msg_success js_show">
          <div class="weui-msg">
              <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
              <div class="weui-msg__text-area">
                  <h2 class="weui-msg__title">修改用户身份成功</h2>
              </div>
              <div class="weui-msg__opr-area">
                  <p class="weui-btn-area">
                      <a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回</a>
                  </p>
              </div>
          </div>
      </div>';
	} else {
		echo '<div class="page">
          <div class="weui-msg">
              <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
              <div class="weui-msg__text-area">
                  <h2 class="weui-msg__title">修改用户身份失败</h2>
              </div>
              <div class="weui-msg__opr-area">
                  <p class="weui-btn-area">
                      <a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回</a>
                  </p>
              </div>
          </div>
      </div>';
	}

	mysql_close($mysqli);
?>
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
