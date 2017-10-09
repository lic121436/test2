<?php
require_once 'connect.php';

$sql = "SELECT id, username, age FROM user WHERE age >= ? ORDER BY age asc";

$mysqli_stmt = $mysqli->prepare($sql);

$age = 10;
$mysqli_stmt->bind_param('i', $age);

if($mysqli_stmt->execute()){
    // bind_result绑定结果集中的值到变量
    $mysqli_stmt->bind_result($id, $username, $age);
    
    
    // 遍历结果集
    while($mysqli_stmt->fetch()){
        echo '编号：'.$id2.'<br/>';
        echo "用户名：".$username."<br/>";
        echo "年龄：".$age."<br/>";
        echo "<hr/>";
    }
}

$mysqli_stmt->free_result();

$mysqli_stmt->close();

$mysqli->close();