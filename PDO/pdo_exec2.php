<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "INSERT user(username, password, email) VALUES('test2', '".md5('test2')."', 'test2@qq.com')";
    $res = $pdo->exec($sql);
    echo "有".$res."条记录被插入<br/>";
    echo "可显示的插入ID：".$pdo->lastInsertId();
} catch (PDOException $e) {
    $e->getMessage();
}