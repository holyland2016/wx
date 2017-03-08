<?php
require "../conn.php";
session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['identity']==0){
    $username = $_SESSION['username'];
    $telephone = $_SESSION['telephone'];
    $sql = "SELECT * FROM wx_user WHERE username = '".$username."' and telephone = '".$telephone."'";
    $query = $mysqli->query($sql);
    // echo $query; die();
    if($query && $query->num_rows > 0) {
      // // echo "hello";
    	// 	while($row = $query->fetch_assoc()) {
    	// 		$data[] = $row;
      //     // echo $data[];die();
    	// 	}
      $info = $query->fetch_array();
        // echo "hello";

    	} else {
    		$data = array();
    	}
  }
  // echo $info['id'];die();
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
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="微信,WeUI,示例,案例">
    <meta name="description" content="WeUI 为微信 Web 服务量身设计">
    <title>课程</title>
    <link rel="stylesheet" href="../style/css/weui.min.css"/>
	<link rel="stylesheet" href="../style/css/style.css"/>
</head>
<body>
	<div class="page__hd">
        <h2 class="page__title" style="padding-left:2%">个人信息</h2>
	</div>
	<div class="weui-cells">
        <!-- <div class="weui-cell weui-cell_access">
			<div class="weui-cell__bd">
				<span style="margin-left:0;width: 50px;display: block">头像</span>
			</div>
            <div class="weui-cell__ft" style="position: relative;margin-left: 50%;">
                <img src="./style/image/bear.jpg" style="width: 50px;display: block">
            </div>
        </div> -->
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">姓名</span>
            </div>
			<div class="weui-cell__ft"><?php echo $info['username'];?></div>
        </div>
		<div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">手机号码</span>
            </div>
			<div class="weui-cell__ft"><?php echo $info['telephone'];?></div>
        </div>
        <div class="weui-cell weui-cell_access">
			<div class="weui-cell__bd">
                <span style="vertical-align: middle">身份</span>
            </div>
			<div class="weui-cell__ft"><?php if ($info['identity']==0) {
			  echo "学生";
			} elseif($info['identity']==1) {
			  echo "教师";
			}else{
        echo "管理员";
      }
			?></div>
        </div>
    </div>
    <div class="weui-msg__opr-area">
      <form method="post" action="reason.php" class="form-horizontal">
        <input type="hidden" name="ask" value="<?php echo $info['username'];?>">
        <input type="hidden" name="answer" value="管理员">
        <div class="form-group">
          <p style="padding-left:3%;padding-top:5%">申请为管理员或者教师</p>
          <p style="padding-left:3%;padding-top:1%">原因：</p>
          <div class="col-sm-10" style="padding-left:8%">
            <textarea name="content" id="article-des" cols="50%" rows="5"  class="form-control"></textarea>
          </div>
        </div>
        <p class="weui-btn-area">
          <input type="submit" class="weui-btn weui-btn_primary" value="提交申请"/>
        </p>
      </div>
    </form>
    <div class="weui-msg__opr-area">
        <p class="weui-btn-area">
            <a href="logout.php" class="weui-btn weui-btn_primary">退出登录</a>
        </p>
    </div>
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
