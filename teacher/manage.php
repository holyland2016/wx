<?php
require "../conn.php";

session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['identity']==0){
    header("Location: ../user/index.php");
  }
  if($_SESSION['identity']==1){
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM wx_article WHERE author = '".$username."'";

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
  if($_SESSION['identity']==2){
    header("Location: ../admin/index.php");
			// echo $row['id'];die();
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
	<title>管理文章</title>
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
  <div class="container">
  <div class="page-header ex-page-header">
    <h1 class="title">文章发布系统<small>  ——后台管理系统</small></h1>
  </div>

  <div class="body-container">
    <div class="row">
        <div class="col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
            </div>

              <div class="list-group">
                <a href="add.php" class="list-group-item">发布文章</a>
                <a href="manage.php" class="list-group-item active">管理文章</a>
                <a href="logout.php" class="list-group-item">退出登录</a>
              </div>
          </div>
        </div>

        <div class="col-md-10">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>文章管理列表</h4>
            </div>

            <div class="panel-body">
              <p><a href="modify.php" class="btn btn-primary" role="button">添加</a></p>
              <table class="table table-hover">
                <tr>
                  <th>编号</th>
                  <th>标题</th>
                  <th>作者</th>
                  <th>操作</th>
                </tr>

                <tbody>
                  <?php
                    if(!empty($data)) {
                      foreach ($data as $value) {
                  ?>
                        <tr>
                          <td><?php echo $value['id'];?></td>
                          <td><?php echo $value['title'];?></td>
                          <td><?php echo $value['author'];?></td>
                          <td><a href="delete.php?id=<?php echo $value['id'];?>">删除</a>
                             <a href="modify.php?id=<?php echo $value['id'];?>">修改</a>
                          </td>
                        </tr>
                  <?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div style="width:100%;height:100px;">
</div>
<div class="weui-tabbar">
	<a href="../teacher/index.php" class="weui-tabbar__item weui-bar__item_on">
		<span style="display: inline-block;position: relative;">
			<img src="../style/image/icon_nav_layout.png" alt="" class="weui-tabbar__icon">
		</span>
		<p class="weui-tabbar__label">课程列表</p>
	</a>
	<a href="../teacher/manage.php" class="weui-tabbar__item">
		<img src="../style/image/icon_nav_form.png" alt="" class="weui-tabbar__icon">
		<p class="weui-tabbar__label">后台管理</p>
	</a>
</div>
</body>
</html>
