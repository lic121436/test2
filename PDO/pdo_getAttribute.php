<?php
header('connent-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    echo "PDO自动提交模式：".$pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);
    echo "<br/>";
    echo "PDO错误模式：".$pdo->getAttribute(PDO::ATTR_ERRMODE);
    echo "<br/>";
    $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
    echo "PDO自动提交模式：".$pdo->getAttribute(PDO::ATTR_AUTOCOMMIT);
    echo "<br/>";
    $attArr = array(
      'AUTOCOMMIT', 'ERRMODE', 'CASE', 'PERSISTENT', 'TIMEOUT', 'ORACLE_NULLS', 'SERVER_INFO', 'SERVER_VERSION', 'CLIENT_VERSION', 'CONNELTION_STATUS'  
    );
    
    foreach($attArr as $attr){
        echo "PDO_ATTR_$attr ：";
        echo $pdo->getAttribute(constant("PDO::ATTR_$attr"))."<br/>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
