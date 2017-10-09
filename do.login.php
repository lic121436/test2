<?php
require_once 'connect.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

// $sql = "SELECT username, password FROM user WHERE username = '{$username}' AND password = '{$password}' ";

// $mysqli_result =  $mysqli->query($sql);

// if($mysqli_result && $mysqli_result->num_rows > 0){
//     echo "登陆成功;
// }else{
//     echo "登陆失败";
// }

// 使用预处理语句可以防止sql注入
$sql = "SELECT username, password FROM user WHERE username = ? AND password =? ";
$mysqli_stmt = $mysqli->prepare($sql);
$mysqli_stmt->bind_param('ss', $username, $password);

if($mysqli_stmt->execute()){
    $mysqli_stmt->store_result();
    if($mysqli_stmt->num_rows > 0){
        echo "登陆成功";
    }else{
        echo "登陆失败 <a href='login.php'>返回登陆</a>";
    }
}

// 释放结果集
$mysqli_stmt->free_result();
// 关闭预处理语句
$mysqli_stmt->close();
// 关闭连接
$mysqli->close();
