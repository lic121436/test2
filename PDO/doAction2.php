<?php
header('content-type:text/html;charset=utf-8');
$username = $_POST['username'];
$password = $_POST['password'];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    // 方法1:
    $sql = "SELECT * FROM user WHERE username = ? AND password = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $password);
    // 方法2：
    // $stmt->execute(array($username, $password));
    
    // 方法3：
//     $sql = "SELECT username, password FROM user WHERE username = :username AND password = :password ";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(":username", $username);
//     $stmt->bindParam(":password", $password);
    
    $stmt->execute();
    echo $stmt->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}