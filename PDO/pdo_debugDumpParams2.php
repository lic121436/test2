<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "SELECT * FROM user username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":password", $password, PDO::PARAM_STR);
    $username = 'test4';
    $password = 'test4';
    $stmt->execute();
    echo "<pre>";
    print_r($stmt->debugDumpParams());
    echo "<br/>";
    echo "列数：".$stmt->columnCount();
    echo "<br/>";
    echo "列的元数据:<br/>";
    print_r($stmt->getColumnMeta(0));
    echo "<br/>";
} catch (PDOException $e) {
    echo $e->getMessage();
}