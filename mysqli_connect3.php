<?php
header("Content-type:text/html; charset=utf-8");
// 连接数据库
$mysqli = @new mysqli("localhost", "root", "root", "test");
// 设置字符编码
$mysqli->set_charset("utf8");

// 写SQL语句往删除mysqli相同内容只留下id比较小的内容
$delsql = <<<EOF
    DELETE t1 FROM mysqli AS t1 INNER JOIN mysqli AS t2 ON t1.username = t2.username WHERE t1.id > t2.id;
EOF;
$res = $mysqli->query($delsql);
if ($res) {
    echo "数据删除成功，删除数据记录";
    echo $mysqli->affected_rows;
} else {
    echo "数据删除失败";
}

// 关闭数据库
$mysqli->close();