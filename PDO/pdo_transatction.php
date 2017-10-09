<?php
header('content-type:text/html;charset=utf-8');
try {
    $dsn = 'mysql:host=localhost;dbname=imooc';
    $username = 'root';
    $passwd = 'root';
    // 关闭自动提交
    $options = array(PDO::ATTR_AUTOCOMMIT => 0, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn, $username, $passwd, $options);
    var_dump($pdo->inTransaction());
    echo "<br/>";
    // 开启事务
    $pdo->beginTransaction();
    var_dump($pdo->inTransaction());
    $sql = "UPDATE useraccount SET money = money - 200 WHERE username = 'king'";
    $res1 = $pdo->exec($sql);
    if($res1 == 0){
        throw new PDOException('king 转账失败');
    }
    $sql2 = "UPDATE useraccount SET money = money + 200 WHERE username = 'queen2' ";
    $res2 = $pdo->exec($sql2);
    if($res2 == 0){
        throw new PDOException('queen收账失败');
    }
    // 事务提交
    $pdo->commit();
} catch (PDOException $e) {
    // 事务回滚
    $pdo->rollBack();
    echo $e->getMessage();
}