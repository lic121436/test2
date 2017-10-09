<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "SELECT id, username, email FROM user";
    $stmt = $pdo->query($sql);
    if($stmt === false){
        print_r($pdo->errorInfo());
    }
    foreach ($stmt as $row){
        echo "编号：".$row['id']."<br/>";
        echo "用户名：".$row['username']."<br/>";
        echo "邮箱：".$row['email']."<br/>";
        echo "<hr>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}