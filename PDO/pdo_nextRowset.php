<?php
header('content-type:text/html;charset=utf-8');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "call test1()";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($rows);
    echo "<hr/>";
    $stmt->nextRowset();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($rows);
} catch (PDOException $e) {
    echo $e->getMessage();
}