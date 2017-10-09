<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
  /*   $sql = "SELECT username, password, email  FROM user";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $stmt->bindColumn(1, $username);
    $stmt->bindColumn(2, $password);
    $stmt->bindColumn(3, $email);
    echo "结果集中的列数为：".$stmt->columnCount();
    echo "<hr/>";
    echo "结果集第1列的元数据:<br/>";
    print_r($stmt->getColumnMeta(0));
    echo "<hr/>";
    while($stmt->fetch(PDO::FETCH_BOUND)){
        echo "用户名：".$username."<br/>";
        echo "密码：".$password."<br/>";
        echo "邮箱：".$email."<br/>";
        echo "<hr/>";
    } */
    
    $sql = "SELECT id, username, password, email FROM user ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo "结果集的列数为：".$stmt->columnCount();
    echo "<hr/>";
    echo "查看第1列元数据: <br>";
    print_r($stmt->getColumnMeta(0));
    echo "<hr/>";
    $stmt->bindColumn(1, $id);
    $stmt->bindColumn(2, $username);
    $stmt->bindColumn(3, $password);
    $stmt->bindColumn(4, $email);
    while($stmt->fetch(PDO::FETCH_BOUND)){
        echo "编号：".$id."<br/>";
        echo "用户名：".$id."<br/>";
        echo "密码：".$password."<br/>";
        echo "邮箱：".$email."<br/>";
        echo "<hr/>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}