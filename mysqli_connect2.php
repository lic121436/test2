<?php
header("Content-type:text/html; charset=utf-8");

// 连接数据库
$mysqli = @new mysqli("localhost", "root", "root", "test");
// 设置字符编码
$mysqli->set_charset("utf8");

// 写SQL语句往删除mysqli相同内容只留下id比较小的内容
$updatesql = <<<EOF
    UPDATE mysqli SET username = "修改后的名字" WHERE id = 31;
EOF;
$res = $mysqli->query($updatesql);
if ($res) {
    echo "数据修改成功，修改数据记录：";
    echo $mysqli->affected_rows;
} else {
    echo "数据修改失败";
}
// 关闭数据库
$mysqli->close();
