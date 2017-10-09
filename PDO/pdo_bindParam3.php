<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
//     $sql = "UPDATE user SET username = :username WHERE id = :id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':username', $username, PDO::PARAM_STR);
//     $stmt->bindParam(':id', $id);  
//     $username = 'this is a test';
//     $id = 7;

    $sql = "DELETE FROM user WHERE id < :id ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $id = 10;
    $stmt->execute();
    echo $stmt->rowCount(); 
    echo "<br/>";
    
} catch (PDOException $e) {
    echo $e->getMessage();
}