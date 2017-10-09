<?php
// 通过配置文件连接
try {
    $dsn = 'test';
    $username = 'root';
    $passwd = 'root';
    $pdo = new PDO($dsn, $username, $passwd);
    var_dump($pdo);
} catch (PDOEXception $e) {
    echo $e->getMessage();
}