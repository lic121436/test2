<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc','root','root');
    // exec():执行一条sql语句并返回其受影响的记录的条数,如果没有受影响的条数返回值为0
    // exec对于select没有作用
    $sql = <<<EOF
    CREATE TABLE IF NOT EXISTS user(
    id INT UNSIGNED AUTO_INCREMENT KEY,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(32) NOT NULL,
    email VARCHAR(30) NOT NULL
    );
EOF;
    
    $res = $pdo->exec($sql);
    var_dump($res);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}