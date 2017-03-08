<?php

  /**
   *
   */
  // class Login
  // {
  //   public $username;
  //   public $telephone;
  //
  //   function __construct()
  //   {
  // 		require '../config.php';
  // 		$this->username = $_POST['username'];
  // 		$this->telephone = $_POST['telephone'];
  //   }
  //   public function checkUser()
  // 	{
  // 		//数据库验证
  // 		$db = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME) or die('数据库连接异常');
  // 		$sql = "SELECT username FROM wx_user WHERE username = '".$this->username."' and telephone = '".$this->telephone."'";
  //     $result = mysqli_fetch_row($db->query($sql))[0];
  //     // echo 1;
  // 		if (!$result) {
  // 			$sql = "INSERT INTO wx_user (username, telephone) VALUES ('".$this->username."','".$this->telephone."')";
  //       // echo $sql;die();
  //       // $query= $db->query($sql);这样写会乱码
  //       // echo $query;die;
  //       $sql = "SELECT username FROM wx_user WHERE username = '".$this->username."' and telephone = '".$this->telephone."'";
  // 			$result = mysqli_fetch_row($db->query($sql))[0];
  //       // echo $result;die();
  //       $db->close();
  // 			$_SESSION['loggedin'] = $result;
  // 			echo "<script>location.href = 'index.php'</script>";
  // 			exit();
  //       // echo $sql;
  // 		}else{
  // 			$db->close();
  // 			$_SESSION['loggedin'] = $result;
  // 			echo "<script>location.href = 'index.php'</script>";
  // 			exit();
  // 		}
  // 	}
  //
  // }
  //
  // $login = new Login();
  // $login->checkUser();

  require "../conn.php";
  $username = $_POST['username'];
  $telephone = $_POST['telephone'];
  $sql = "SELECT * FROM wx_user WHERE username = '".$username."' and telephone = '".$telephone."'";
  // echo $sql;die();
  $query = $mysqli->query($sql);
  // $query = $mysqli->query($sql);
  // echo $result;die();
  $result = $query->fetch_array();
  // echo $result['identity'];die();
  if($result) {
      $_SESSION['username'] = $result['username'];
      $_SESSION['identity'] = $result['identity'];
      $_SESSION['telephone'] = $result['telephone'];
      // $_SESSION['identity'] = ;
      //echo $result;die();
      header("Location: index.php");
  	} else {
      $insertsql = "INSERT INTO wx_user (username, telephone) VALUES ('".$username."','".$telephone."')";
      $query= $mysqli->query($insertsql);
      // echo "<script> location.replace(location.href);</script>";i
      echo "新用户，请在右上角选择刷新一次进入";
      $selectsql = "SELECT * FROM wx_user WHERE username = '".$username."' and telephone = '".$telephone."'";
      $query_sql = $mysqli->query($selectsql);
      // echo $res;die();
      $res = $query->fetch_array();
      $_SESSION['username'] = $res['username'];
      $_SESSION['identity'] = $res['identity'];
      $_SESSION['telephone'] = $result['telephone'];
      // while($row = $que->fetch_assoc()) {
  		// 	$data[] = $row;
      //   // echo $row['id']
  		// }
      header("Location: index.php");

  	}
    mysql_close($mysqli);
//INSERT INTO wx_user (username, telephone) VALUES ('滕盛弟','18607733241')