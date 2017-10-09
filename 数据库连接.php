<?php
/*
 * header("Content-type:text/html; charset=utf-8");
 * if($con = mysqli_connect('localhost', 'root', 'root')){
 * echo "连接成功";
 * }else{
 * echo "连接失败";
 * }
 */
header("Content-type:text/html; charset=utf-8");
/*
 * if (function_exists('mysql_connect')) {
 * echo 'Mysql扩展已经安装';
 * }
 */

// PDO扩展

/*
 * $dsn = 'mysql:dbname=test;host=127.0.0.1';
 * $user = 'root';
 * $password = 'root';
 * $dbh = new PDO($dsn, $user, $password);
 */

$link = mysqli_connect('localhost', 'root', 'root') or die("数据库连接失败");
mysqli_select_db($link, 'test');
$rault = mysqli_query($link, 'select * from test ');
$row = mysqli_fetch_array($rault);
print_r($row);

?>