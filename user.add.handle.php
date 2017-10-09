<?php
require_once 'connect.php';
$username = $_POST['username'];
if (isset($username) && empty($username)) {
    echo "<script>alert('名字不能为空');window.location.href='user.add.php';</script>";
} else {
    $insertsql = "INSERT mysqli(username) VALUES('$username')";
    $res = $mysqli->query($insertsql);
    if ($res) {
        echo "<script>alert('用户增加成功');window.location.href='user.list.php';</script>";
    } else {
        echo "<script>alert('用户添加失败');window.location.href='user.add.php';</script>";
    }
}
?>