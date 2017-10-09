<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "INSERT user(username, password, email) VALUES(:username, :password, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":email", $email);

    $username = 'test4';
    $password = 'test4';
    $eamil = 'test4@imooc.com';
    $stmt->execute();
    echo $stmt->rowCount();
    echo "<br/>";
    
    $username = 'test5';
    $password = 'test5';
    $eamil = 'test5@imooc.com';
    $stmt->execute();
    echo $stmt->rowCount();
    echo "<br/>";
    
} catch (PDOException $e) {
    echo $e->getMessage();
}