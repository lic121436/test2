<?php
header("Content-type:text/html; charset=utf-8");

// 连接数据库
$mysqli = @new mysqli("localhost", "root", "root", "test");
// 设置字符编码
$mysqli->set_charset("utf8");

// 写SQL语句往删除mysqli相同内容只留下id比较小的内容
$selectsql = <<<EOF
    SELECT * FROM mysqli;
EOF;
$results = array();
$res = $mysqli->query($selectsql);
$results = $res->fetch_all();
/*
 * while($row = $res->fetch_assoc()){
 * echo "<pre>";
 * print_r($row);
 * $results[] = $row;
 * }
 */
if ($res && $res->num_rows > 0) {
    $jsondata = json_encode($results);
    echo "<hr>";
    echo $jsondata;
} else {
    echo "没有数据";
}

// 关闭数据库
$mysqli->close();

