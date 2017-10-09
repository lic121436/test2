<?php
header("Content-type:text/html; charset=utf-8");
// 验证mysqli 扩展是否已经开启
// phpinfo();

// 检测扩展是否已经加载
// var_dump(extension_loaded('mysqli'));
// var_dump(extension_loaded('curl'));

// 检测函数是否已经存在
// var_dump(function_exists('mysqli_connect'));

// 得到当前已经开启的扩展
// var_dump(get_loaded_extensions());

// 建立到MYSQL的数据连接
// $mysqli = new mysqli('localhost', 'root', 'root');
// print_r($mysqli);
// $mysqli->select_db('test');

/*
 * $mysqli = new mysqli();
 * $mysqli->connect("localhost", "root", "root");
 * print_r($mysqli);
 */

// 建立连接的同时打开指定的数据库
$mysqli = @new mysqli("localhost", "root", "root", "test");
// $mysqli->connect_errno: 得到连接产生的错误编号
// $mysqli->connect_error: 得到连接产生的错误信息
if ($mysqli->connect_errno) {
    die('Connect Error:' . $mysqli->connect_error);
}

// 2.设置默认的客户端的编码方式
$mysqli->set_charset('utf8');

// 3.执行SQL查询
$createsql = <<<EOF
    CREATE TABLE IF NOT EXISTS mysqli(
        id TINYINT UNSIGNED AUTO_INCREMENT KEY,
        username VARCHAR(20) NOT NULL
    );
EOF;
$res = $mysqli->query($createsql);
var_dump($res);

/*
 * SELECT/DESC/DESCRIBE/SHOW/EXPLAIN执行成功返回mysqli_result对象，执行失败返回false
 * 对于其它SQL语句的执行，执行成功返回true，否则返回false;
 */

// 关闭连接
$mysqli->close();

    