<?php
// 通过参数形式连接数据库
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    var_dump($pdo);
} catch (PDOException $e) {
    echo $e->getMessage();
}