<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "INSERT user(username, password, email) VALUES(?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $passowrd);
    $stmt->bindParam(3, $password);
    
    $username = "lv1";
    $pasword = "lv1";
    $email = "lv1@imooc.com";
    $stmt->execute();
    echo $stmt->rowCount();
    echo "<br/>";
    
    $username = "lv2";
    $pasword = "lv2";
    $email = "lv2@imooc.com";
    $stmt->execute();
    echo $stmt->rowCount();
    echo "<br/>";
    
} catch (PDOException $e) {
    echo $e->getMessage();
}