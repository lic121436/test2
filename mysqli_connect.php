<?php
header("Content-type:text/html; charset=utf-8");
// 连接数据库
$mysqli = @new mysqli("localhost", "root", "root", "test");
if ($mysqli->connect_errno) {
    die("CONNECT ERROR: " . $mysqli->connect_error);
}
// 设置字符编码
$mysqli->set_charset('utf8');
// 写SQL语句往mysqli表插入内容
$insertsql = <<<EOF
    INSERT  mysqli(username) VALUES('Tom'), ('John'), ('Rose'), ('小明'), ('小新'), ('柯南');
EOF;

$res = $mysqli->query($insertsql);

if ($res) {
    echo "数据插入成功，插入记录条数：";
    echo $mysqli->affected_rows;
} else {
    echo "数据插入失败";
}

// 关闭数据库
$mysqli->close();