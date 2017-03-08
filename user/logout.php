<?php
session_start();
unset($_SESSION['username']);
// unset($_COOKIE['user']);
echo "<script>location.href = './login.php'</script>";
exit();
