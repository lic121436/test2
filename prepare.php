<?php 
require_once 'connect.php';

// 预处理sql语句
$sql = "INSERT user(username, password, age) VALUES(?,?,?)";

// 准备预处理语句
$mysqli_stmt = $mysqli->prepare($sql);

$username = "king4";
$password = md5("king4");
$age = 15;

// s：字符串,i：整型,d：浮点
// 绑定参数
$mysqli_stmt->bind_param("ssi", $username, $password, $age);

// 执行预处理语句
if($mysqli_stmt->execute()){
    echo $mysqli_stmt->insert_id;
    echo "<br/>";
}else{
    echo $mysqli_stmt->error;
}
