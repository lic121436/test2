<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    // $sql = "UPDATE user SET username = '名字昵称'  WHERE id = 1";
    $sql = "DELETE FROM user WHERE id = 1";
    $res = $pdo->exec($sql);
    echo $res."条记录被更改";
    if($res === false){
        // $pdo->errorCode():SQLSTATE的值
        echo $pdo->errorCode();
        echo "<br/>";
        // $pdo->errorInfo():返回错误信息的数组，数组中包含3个单元
        // 0=>SQLSTALE，1=>CDOE，2=>INFO
        $pdo_errorInfo = $pdo->errorInfo();
        print_r($pdo_errorInfo);
    }
    
} catch (PDOException $e) {
    echo $e->getMessage();
}