<?php
  include('../conn.php');
  session_start();
  if(isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
  }else {
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
    <title>课程</title>
    <link rel="stylesheet" href="../style/css/weui.min.css"/>
	<link rel="stylesheet" href="../style/css/style.css"/>
</head>
<body>
  <form id="form" method="post" action="login_action.php">
  	<div class="page__hd">
  		<h1 class="page__title">
              登陆
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
  <script>

  </script>
</body>
</html>
