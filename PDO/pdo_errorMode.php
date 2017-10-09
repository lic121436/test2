<?php
header('contnet-type:text/html;charset=utf-8');
try {
    /* 
     PDO::ERRMODE_SILENT :默认模式，静默模式
     PDO::ERRMODE_WARNING :警告模式
     PDO::ERRMODE_EXCEPTION :异常模式  
     */
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM nonetable";
    $stmt = $pdo->query($sql);
    echo "<pre>";
    print_r($pdo->errorInfo());
    echo "<br/>";
} catch (PDOException $e) {
    echo $e->getMessage();
}