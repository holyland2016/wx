<?php
	require_once('../conn.php');
	// require "../conn.php";
	session_start();
	if(isset($_SESSION['username'])){
	  if($_SESSION['identity']==0){
	    header("Location: ../user/index.php");
	  }
	  if($_SESSION['identity']==1){
			//读取旧信息
			$username = $_SESSION['username'];
			$id = intval($_GET['id']);
			$sql = "select * from wx_article where id=$id";
		  $query = $mysqli->query($sql);
			// echo $query;die();
			$data = $query->fetch_assoc();

			$article_id = $id;
			$comment_sql = "select * from wx_comment where article_id=$article_id";
			// echo $comment_sql;die();
			$comment_query = $mysqli->query($comment_sql);
			// echo $comment_query;die();
			if($comment_query && $comment_query->num_rows > 0) {
			  // echo "hello";
					while($row = $comment_query->fetch_assoc()) {
						$comment_data[] = $row;
			      // echo $row['id'];die();
					}
			    // echo "hello";
				} else {
					$comment_data = array();
				}

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
    	<div class="page article js_show">
        <div class="page__hd">
            <h2 class="page__title" style="text-align: center"><?php echo $data['title'];?></h2>
            <p class="page__desc" style="text-align: center">作者：<?php echo $data['author'];?></p>
            <p class="page__desc" style="text-align: center">发布时间：<?php echo(date("Y-m-d",$data["dateline"])); ?></p>
        </div>
        <div class="page__bd">
            <article class="weui-article">
								<p>
                	<img src="<?php echo $data['picture'];?>" alt="">
                </p>
                <p><strong>描述：</strong><?php echo $data['description'];?></p>
                <section>
                    <h2 class="title">正文</h2>
                    <section>
                        <p>
                          <?php echo $data['content'];?>
                        </p>
                    </section>
                </section>
            </article>
        </div>
        <div class="page__hd">
              <h4 class="page__title" style="padding-left:15px">评论</h4>
        </div>
        <div class="page__bd">
            <article class="weui-article">
							<?php
								if(!empty($comment_data)) {
									foreach ($comment_data as $value) {
							?>
                <section>
                    <p><?php echo $value['ask'];?>&nbsp;回复：&nbsp;<?php echo $value['answer'];?></p>
                    <section>
                        <p style="padding-left:8%">
                          <?php echo $value['content'];?>
													<a href="reply.php?id=<?php echo $value['article_id'];?>&ask=<?php echo $username;?>&answer=<?php echo $value['ask'];?>">回复</a>
												</p>
                    </section>
                </section>
								<?php
										}
									}
								?>
            </article>
        </div>
			<form method="post" action="reply_article.php" class="form-horizontal" >
        <div class="weui-cell">
          <div class="weui-cell__bd">
						<label for="article-des" class="control-label"><?php echo $username; ?>&nbsp;的评论：</label>
						<input type="hidden" name="article_id" value="<?php echo $data['id']; ?>">
						<input type="hidden" name="ask" value="<?php echo $username; ?>">
						<input type="hidden" name="answer" value="<?php echo $data['author'];?>">
            <textarea class="weui-textarea" name="content" placeholder="请输入你的评论" rows="1"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
          </div>
        </div>
        <div class="page__hd" style="padding-top:2px;padding-left:80%">
          <input type="submit" class="weui-btn weui-btn_mini weui-btn_primary" />
        </div>
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
