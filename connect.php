<?php
require_once 'config.php';
// 连接数据库
$mysqli = @new mysqli(HOST, USERNAME, PASSOWERD, DB);
if ($mysqli->connect_errno) {
    die("CONNECT ERROR: " . $mysqli->connect_error);
}
// 设置字符编码
$mysqli->set_charset('utf8');
