<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');

    $sql = "INSERT user(username, password, email) VALUES(:username,:password,:email)";
    $stmt = $pdo->prepare($sql);
    
    $username = 'lv7';
    $password = 'lv7';
    $email = 'imooc@imooc.com';
    
    // bindValue如果不重新绑定，它只会绑定第一个绑定的值
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(":password", $password);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    echo $stmt->rowCount(); 
    echo "<br/>";
    
    $username = 'lv8';
    $password = 'lv8';
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(":password", $password);
    $stmt->execute();
    echo $stmt->rowCount();
    echo "<br/>";
    
    $username = 'lv9';
    $password = 'lv9';
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(":password", $password);
    $stmt->execute();
    echo $stmt->rowCount();
    echo "<br/>";
    
} catch (PDOException $e) {
    echo $e->getMessage();
}