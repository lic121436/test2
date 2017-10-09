<?php
// 通过URI的形式连接数据库
try {
    $dsn = 'uri:file://F:\web\test\PDO\dsn.txt';
    $username = 'root';
    $passwd = 'root';
    $pdo = new PDO($dsn, $username, $passwd);
    var_dump($pdo);
} catch (PDOException $e) {
    echo $e->getMessage();
}