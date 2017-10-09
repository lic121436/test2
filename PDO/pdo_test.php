<?php
header("content-type:text/html;charset=utf-8");
// 通过PDO连接数据库
$pdoStartTime = microtime(true);
for($i = 1; $i < 100; $i++){
    $pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
}
$pdoETime = microtime(true);
$res = $pdoETime - $pdoStartTime;

// 通过mysqli连接数据库
$mysqliStartTime = microtime(true);
for($i = 1; $i < 100; $i++){
    $mysqli = new mysqli('localhost', 'root', 'root', 'imooc');
}
$mysqliENDTime = microtime(true);

$res2 = $mysqliENDTime - $mysqliStartTime;

echo $res."<br/>";
echo $res2."<br/>";

if($res > $res2){
    echo "PDO连接数据库的效率是mysqli的".round($res/$res2)."倍";
    echo "<br/>";
}else{
    echo "mysqli连接数据库的效率是PDO的".round($res2/$res)."倍";
    echo "<br/>";
}
