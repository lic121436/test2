<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');

    $sql = "INSERT user(username, password, email) VALUES(?,?,?)";
    $stmt = $pdo->prepare($sql);
    
    $username = 'lv6';
    $password = 'lv6';
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $password);
    $stmt->bindValue(3, 'imooc@imooc.com');
    $stmt->execute();
    echo $stmt->rowCount(); 
    echo "<br/>";
    
} catch (PDOException $e) {
    echo $e->getMessage();
}