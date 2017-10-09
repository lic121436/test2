<?php
$username = $_POST['username'];
$password = $_POST['password'];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    // 通过quote()返回带引号的字符串，过滤字符串中的特殊字符
    $username = $pdo->quote($username);
    $sql = "SELECT * FROM user WHERE username = {$username} AND password = '{$password}';";
    $stmt = $pdo->query($sql);
    echo $sql;
    echo "<br/>";
    // rowCount(): PODStatement对像的方法，对于SELECT操作返回的结果集中操作的记录条数
    // 对于 UPDATE INSERT DELETE 返回受影响的条数
    echo $stmt->rowCount();
} catch (PDOException $e) {
    echo $e->getMessage();
}