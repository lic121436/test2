<?php
require_once 'connect.php';

// 查询数据库
$selectsql = "SELECT * FROM mysqli";

$mysqli_result = $mysqli->query($selectsql);

print_r($mysqli_result->fetch_assoc());
echo "<hr/>";

print_r($mysqli_result->fetch_row());
echo "<hr/>";

print_r($mysqli_result->fetch_all());
echo "<hr/>";

$mysqli_result->data_seek(0);
print_r($mysqli_result->fetch_all(MYSQLI_NUM));
echo "<hr/>";

$mysqli_result->data_seek(0);
print_r($mysqli_result->fetch_all(MYSQLI_ASSOC));
echo "<hr/>";

$mysqli_result->data_seek(0);
print_r($mysqli_result->fetch_all(MYSQLI_BOTH));
echo "<hr/>";

$mysqli_result->data_seek(0);
print_r($mysqli_result->fetch_object());

