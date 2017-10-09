<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "INSERT user(username, password, email) VALUES(?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);
    $username = 'ab1';
    $password = 'ab1';
    $email = 'ab1@imooc.com';
    $stmt->execute();
    echo "<pre>";
    print_r($stmt->debugDumpParams());
    echo "<br/>";
    echo $stmt->rowCount();
    echo "<br/>";

} catch (PDOException $e) {
    echo $e->getMessage();
}