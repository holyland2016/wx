<?php
require "../conn.php";
session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['identity']==0){

  }
  if($_SESSION['identity']==1){
    header("Location: ../teacher/index.php");
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
	<title>评论</title>
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
  // require "../conn.php";
  $article_id = $_POST['article_id'];
  $ask = $_POST['ask'];
  $answer = $_POST['answer'];
  $content = $_POST['content'];
  $insertsql = "INSERT INTO wx_comment (article_id, ask,answer,content) VALUES ('".$article_id."','".$ask."','".$answer."','".$content."')";
  $query= $mysqli->query($insertsql);
	if($query) {
		echo '<div class="page msg_success js_show">
          <div class="weui-msg">
              <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
              <div class="weui-msg__text-area">
                  <h2 class="weui-msg__title">评论成功</h2>
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
                  <h2 class="weui-msg__title">评论失败</h2>
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
  <a href="../user/index.php" class="weui-tabbar__item weui-bar__item_on">
    <span style="display: inline-block;position: relative;">
      <img src="../style/image/icon_nav_layout.png" alt="" class="weui-tabbar__icon">
    </span>
    <p class="weui-tabbar__label">课程列表</p>
  </a>
  <a href="../user/pepole.php" class="weui-tabbar__item">
    <img src="../style/image/icon_nav_form.png" alt="" class="weui-tabbar__icon">
    <p class="weui-tabbar__label">个人中心</p>
  </a>
</div>
</body>
</html>
