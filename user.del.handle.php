<?php
require_once 'connect.php';
$id = $_GET['id'];
if (isset($id) && empty($id)) {
    echo "<script>alert('请选择要删除的内容');window.location.href='user.list.php';</script>";
} else {
    $delsql = "DELETE FROM mysqli WHERE id = '$id' ";
    $res = $mysqli->query($delsql);
    if ($res) {
        echo "<script>alert('用户删除成功');window.location.href='user.list.php';</script>";
    } else {
        echo "<script>alert('用户删除失败');window.location.href='user.list.php';</script>";
    }
}
?>