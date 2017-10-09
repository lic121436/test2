<?php

header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql);
    echo $stmt->fetchColumn(3);
    echo "<br/>";
    echo $stmt->fetchColumn(2);
} catch (PDOException $e) {
    echo $e->getMessage();
}