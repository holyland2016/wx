<?php
require "../conn.php";
session_start();
if(isset($_SESSION['username'])){
  if($_SESSION['identity']==0){
    header("Location: ../user/index.php");
  }
  if($_SESSION['identity']==1){
    $id = intval($_GET['id']);
    $sql = "select * from wx_article where id=$id";
    $query = $mysqli->query($sql);
    $data = $query->fetch_assoc();
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
	<title>更新文章-<?php echo $data['title'];?></title>
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
									<a href="add.php" class="list-group-item active">发布文章</a>
									<a href="manage.php" class="list-group-item">管理文章</a>
								</div>
						</div>
					</div>

					<div class="col-md-10">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>修改文章</h4>
							</div>

							<div class="panel-body">
								<form method="post" action="modify_action.php" class="form-horizontal" enctype="multipart/form-data">
									<input type="hidden" name="id" value="<?php echo $data['id'];?>">

									<div class="form-group">
										<label for="article-title" class="col-sm-2 control-label">标题</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="article-title" placeholder="Title" name="title" value="<?php echo $data['title'];?>">
										</div>
									</div>

									<div class="form-group">
										<label for="article-author" class="col-sm-2 control-label">作者</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="article-author" placeholder="Author" name="author" value="<?php echo $data['author'];?>">
										</div>
									</div>

									<div class="form-group">
										<label for="exampleInputFile" class="col-sm-2 control-label">特色图片</label>
										<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
										<input type="file" name="file" id="exampleInputFile" value="<?php echo $data['picture'];?>" style="padding-left:6px;">
									</div>

									<div class="form-group">
										<label for="article-des" class="col-sm-2 control-label">描述</label>
										<div class="col-sm-10">
											<textarea name="description" id="article-des" cols="30" rows="5" class="form-control"><?php echo $data['description'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="article-content" class="col-sm-2 control-label">内容</label>
										<div class="col-sm-10">
											<textarea name="content" id="article-content" cols="30" rows="15" class="form-control"><?php echo $data['content'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default">提交</button>
										</div>
									</div>
								</form>
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
