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
	<title>发布文章</title>
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
	// require '../conn.php';
  // print_r($_POST);
	// //把传递过来的信息入库，在入库之前对所有的信息进行校验。
	// //print_r($_POST);
  //
	if(!isset($_POST['title']) || empty($_POST['title'])) {
		echo '<div class="page">
          <div class="weui-msg">
              <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
              <div class="weui-msg__text-area">
                  <h2 class="weui-msg__title">文章标题不能为空</h2>
              </div>
              <div class="weui-msg__opr-area">
                  <p class="weui-btn-area">
                      <a href="javascript:history.back();" class="weui-btn weui-btn_default">返回</a>
                  </p>
              </div>
          </div>
      </div>';
	}
  //
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description = $_POST['description'];
	$content = $_POST['content'];
	$dateline = time();

	//取得上传文件信息
	$fileName=$_FILES['file']['name'];
	$fileType=$_FILES['file']['type'];
	$fileError=$_FILES['file']['error'];
	$fileSize=$_FILES['file']['size'];
	$tempName=$_FILES['file']['tmp_name'];//临时文件名

	//定义上传文件类型
	$typeList = array("image/jpeg","image/jpg","image/png","image/gif"); //定义允许的类型

	if($fileError>0){
					//上传文件错误编号判断
					switch ($fileError) {
							case 1:
									$message="上传的文件超过了php.ini 中 upload_max_filesize 选项限制的值。";
									break;
							case 2:
									$message="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。";
									break;
							case 3:
									$message="文件只有部分被上传。";
									break;
							case 4:
									$message="没有文件被上传。";
									break;
							case 6:
									$message="找不到临时文件夹。";
									break;
							case 7:
									$message="文件写入失败";
									break;
							case 8:
									$message="由于PHP的扩展程序中断了文件上传";
									break;
					}

					exit("文件上传失败：".$message);

			}
	if(!is_uploaded_file($tempName)){
			//判断是否是POST上传过来的文件
			exit("不是通过HTTP POST方式上传上来的");
	}else{
			if(!in_array($fileType, $typeList)){
					exit("上传的文件不是指定类型");
			}else{
					if(!getimagesize($tempName)){
							//避免用户上传恶意文件,如把病毒文件扩展名改为图片格式
							exit("上传的文件不是图片");
					}
			}
					if($fileSize>300000){
							//对特定表单的上传文件限制大小
							exit("上传文件超出限制大小");
					}else{
							//避免上传文件的中文名乱码
							$fileName=iconv("UTF-8", "GBK", $fileName);//把iconv抓取到的字符编码从utf-8转为gbk输出
							$fileName=str_replace(".", time().".", $fileName);//在图片名称后加入时间戳，避免重名文件覆盖
							if(move_uploaded_file($tempName, "../style/upload/".$fileName)){
									$picture = "../style/upload/".$fileName;
							}else{
									echo "上传图片失败";
							}
					}

			}


	$insertsql = "insert into wx_article(title,author,picture,description,content,dateline) values('$title','$author','$picture','$description','$content',$dateline)";
	// echo $insertsql;die();
  $query= $mysqli->query($insertsql);
  // echo $query;die();
	if($query) {
		echo '<div class="page msg_success js_show">
          <div class="weui-msg">
              <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
              <div class="weui-msg__text-area">
                  <h2 class="weui-msg__title">发布文章成功</h2>
              </div>
              <div class="weui-msg__opr-area">
                  <p class="weui-btn-area">
                      <a href="manage.php" class="weui-btn weui-btn_primary">查看</a>
                      <a href="javascript:history.back();" class="weui-btn weui-btn_default">返回</a>
                  </p>
              </div>
          </div>
      </div>';
	} else {
		echo '<div class="page">
          <div class="weui-msg">
              <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
              <div class="weui-msg__text-area">
                  <h2 class="weui-msg__title">发布文章失败</h2>
              </div>
              <div class="weui-msg__opr-area">
                  <p class="weui-btn-area">
                      <a href="javascript:history.back();" class="weui-btn weui-btn_default">返回</a>
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
