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
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="微信,WeUI,示例,案例">
    <meta name="description" content="WeUI 为微信 Web 服务量身设计">
    <title>新建用户</title>
    <link rel="stylesheet" href="../style/css/weui.min.css"/>
	<link rel="stylesheet" href="../style/css/style.css"/>
</head>
<body>
  <form id="form" method="post" action="member_action.php">
  	<div class="page__hd">
  		<h1 class="page__title">
              添加新用户
          </h1>
          <p class="page__desc"></p>
      </div>
  	<div class="weui-cells weui-cells_form">
  		<div class="weui-cell">
  		    <div class="weui-cell__hd">
                  <label class="weui-label">姓名</label>
              </div>
              <div class="weui-cell__bd">
                  <input class="weui-input" name="username" required=""  type="text" placeholder="姓名">
              </div>
          </div>
  		<div class="weui-cell">
              <div class="weui-cell__hd">
                  <label class="weui-label">手机号</label>
              </div>
              <div class="weui-cell__bd">
                  <input class="weui-input" type="tel" name="telephone" required="" pattern="[\d]{8,11}"  placeholder="请输入手机号">
              </div>
          </div>
      </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <input type="submit" class="weui-btn weui-btn_primary" value="确认"/>
        </p>
    </div>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回</a>
        </p>
    </div>
  </form>
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
