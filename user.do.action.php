<?php
require_once 'connect.php';
// 获取传入的值
$username = $_POST['username'];
$username = $mysqli->escape_string($username);
$id = $_POST['id'];
$act = $_GET['act'];
$getid = $_GET['id'];

// 将相同的内容做成自定义函数
function doAction($mysqli, $val, $msg, $sql, $msg2, $msg3, $link, $link2)
{
    print_r($link2);
    if (isset($val) && empty($val)) {
        echo "<script>alert('{$msg}');window.location.href='{$link}';</script>";
    } else {
        $res = $mysqli->query($sql);
        if ($res) {
            echo "<script>alert('{$msg2}');window.location.href='{$link2}';</script>";
        } else {
            echo "<script>alert('{$msg3}');window.location.href='{$link}';</script>";
        }
        exit();
    }
}

// 根据传值不同判断不同的操作
switch ($act) {
    case 'add':
        $msg = "名字不能为空";
        $msg2 = "用户增加成功";
        $msg3 = "用户添加失败";
        $insertsql = "INSERT mysqli(username) VALUES('{$username}')";
        $link = "user.add.php";
        $link2 = "user.list.php";
        doAction($mysqli, $username, $msg, $insertsql, $msg2, $msg3, $link, $link2);
        break;
    case 'edit':
        $msg = "名字不能为空";
        $msg2 = "用户修改成功";
        $msg3 = "用户修改失败";
        $updatesql = "UPDATE  mysqli SET username = '$username' WHERE id ='{$id}' ";
        $link2 = "user.list.php";
        $link = "user.edit.php?id={$id}";
        doAction($mysqli, $username, $msg, $updatesql, $msg2, $msg3, $link, $link2);
        break;
    case 'del':
        $msg = "请选择要删除的内容";
        $msg2 = "用户删除成功";
        $msg3 = "用户删除失败";
        $delsql = "DELETE FROM mysqli WHERE id = '{$getid}' ";
        $link = "user.list.php";
        $link2 = "user.list.php";
        doAction($mysqli, $getid, $msg, $delsql, $msg2, $msg3, $link, $link2);
        break;
}

?>