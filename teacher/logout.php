<?php
session_start();
unset($_SESSION['username']);
// unset($_COOKIE['user']);
echo "<script>location.href = '../user/login.php'</script>";
exit();
