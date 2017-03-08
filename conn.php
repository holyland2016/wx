<?php
//
header('content-type:text/html;charset=utf-8');
//
// /**
//  *
//  */
// class Conn
// {
//   //构造函数
//   function __construct()
//   {
//     require 'config.php';
//     $this->connect();
//
//   }
//
//   // 数据库连接
//   public function connect(){
//     // 创建对象并打开连接，最后一个参数是选择的数据库名称
//     $mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME) or die('数据库连接异常');
//     // 编码转化为 utf8
//     if (!$mysqli->set_charset("utf8")) {
//         printf("Error loading character set utf8: %s\n", $mysqli->error);
//     } else {
//         $mysqli->character_set_name();
//     }
//     if (mysqli_connect_errno()) {
//         // 诊断连接错误
//         die("could not connect to the database.\n" . mysqli_connect_error());
//     }
//
//     $selectedDb = $mysqli->select_db(DB_NAME);//选择数据库
//     if (!$selectedDb) {
//         die("could not to the database\n" . mysql_error());
//     }
//     // echo '连接成功';
//   }
//
//
// }
//
// $db = new Conn();
//


  require 'config.php';

  // 创建对象并打开连接，最后一个参数是选择的数据库名称
  $mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME) or die('数据库连接异常');

  // 编码转化为 utf8
  if (!$mysqli->set_charset("utf8")) {
      printf("Error loading character set utf8: %s\n", $mysqli->error);
  } else {
      $mysqli->character_set_name();
  }

  if (mysqli_connect_errno()) {
      // 诊断连接错误
      die("could not connect to the database.\n" . mysqli_connect_error());
  }

  $selectedDb = $mysqli->select_db("wx");//选择数据库
  if (!$selectedDb) {
      die("could not to the database\n" . mysql_error());
  }
  // echo '连接成功';
// echo "hello";die();
