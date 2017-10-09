<?php
header("content-type:text/html;charset=utf-8");
try {
    $dsn = 'mysql:host=localhost;dbname=imooc';
    $username = 'root';
    $passwd = 'root';
    $options = array(PDO::ATTR_AUTOCOMMIT=>0);
    $pdo = new PDO($dsn, $username, $passwd, $options);
    echo $pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);
} catch (PDOException $e) {
    echo $e->getMessage();
}