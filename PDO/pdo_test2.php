<?php
header("content-type:text/html;charset=utf-8");
// 通过PDO连接数据库
$pdo = new PDO('mysql:host=localhost;dbname=imooc', 'root', 'root');
$pdoStartTime = microtime(true);
$sql = "INSERT test2(id) VALUES(:id)";
$stmt = $pdo->prepare($sql);
for($i = 1; $i < 500; $i++){
    $id = 1;
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}
$pdoETime = microtime(true);
$res = $pdoETime - $pdoStartTime;
unset($pdo); // $pdo = null;
// 通过mysqli连接数据库
$mysqli = new mysqli('localhost', 'root', 'root', 'imooc');

$mysqliStartTime = microtime(true);
for($i = 1; $i < 500; $i++){
   $mysqli->query("INSERT test2(id) VALUES(2)");
 
}
$mysqliENDTime = microtime(true);

$res2 = $mysqliENDTime - $mysqliStartTime;
$mysqli->close();

echo $res."<br/>";
echo $res2."<br/>";

if($res > $res2){
    echo "PDO插入数据的效率是mysqli的".round($res/$res2)."倍";
    echo "<br/>";
}else{
    echo "mysqli插入数据的效率是PDO的".round($res2/$res)."倍";
    echo "<br/>";
}
