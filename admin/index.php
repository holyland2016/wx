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
    $sql = "select * from wx_article order by dateline desc";
    $query = $mysqli->query($sql);
    if($query && $query->num_rows > 0) {
      // echo "hello";
    		while($row = $query->fetch_assoc()) {
    			$data[] = $row;
          // echo $row['id']
    		}
        // echo "hello";
    	} else {
    		$data = array();
    	}
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
        <title>课程</title>
        <!-- 引入 WeUI -->
        <link rel="stylesheet" href="../style/css/weui.min.css"/>
		<link rel="stylesheet" href="../style/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="../style/css/style.css"/>

		<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
		<script src="../style/js/jquery.min.js"></script>

		<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
		<script src="../style/js/bootstrap.min.js"></script>
    </head>
    <body>
		<div class="page__hd">
			<h3 class="page__title" style="padding-left: 5%">
				课程列表
			</h3>
		</div>
		<br />
		<div class="weui-panel weui-panel_access">
            <div class="weui-panel__bd">
              <?php
                if(!empty($data)) {
                  foreach ($data as $value) {
              ?>
                <a href="article.php?id=<?php echo $value['id'];?>" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__hd">
                        <img class="weui-media-box__thumb" src="<?php echo $value['picture'];?>" alt="">
                    </div>
                    <div class="weui-media-box__bd">
                        <h4 class="weui-media-box__title"><?php echo $value['title'];?></h4>
                        <p class="weui-media-box__desc"><?php echo $value['description'];?></p>
                    </div>
                </a>
                <?php
                    }
                  }
                ?>
            </div>
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
