<?php
require_once 'connect.php';
$id = $_POST['id'];
$username = $_POST['username'];
if (isset($username) && empty($username)) {
    echo "<script>alert('名字不能为空');window.location.href='user.edit.php?id=$id';</script>";
} else {
    var_dump((isset($username)));
    var_dump(empty($username));
    $updatesql = "UPDATE  mysqli SET username = '$username' WHERE id ='$id' ";
    $res = $mysqli->query($updatesql);
    if ($res) {
        echo "<script>alert('用户修改成功');window.location.href='user.list.php';</script>";
    } else {
        echo "<script>alert('用户修改失败');window.location.href='user.edit.php?id=$id';</script>";
    }
}
?>