<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
    $sql = "SELECT * FROM user";
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute();
//     if($res){
//         while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//             echo "<pre>";
//             print_r($row);
//             echo "<hr/>";
//         }
//     }
//     $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     echo "<pre>";
//     print_r($row);
//     echo "<hr/>";

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $row = $stmt->fetchAll();
    echo "<pre>";
    print_r($row);
    echo "<hr/>";
} catch (PDOException $e) {
    echo $e->getMessage();
}