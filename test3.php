<?php
require_once 'connect.php';

$mysqli->autocommit(FALSE);
$sql = "UPDATE account SET money = money - 200 WHERE username = 'king'";
$res = $mysqli->query($sql);
$res_affect = $mysqli->affected_rows;

$sql1 = "UPDATE account SET money = money + 200 WHERE username = 'queen'";
$res1 = $mysqli->query($sql1);
$res1_affect = $mysqli->affected_rows;

if($res && $res1_affect && $res1 && $res1_affect){
    $mysqli->commit();
    echo "转账成功";
    $mysqli->autocommit(TRUE);
}else{
    $mysqli->rollback();
    echo "转账失败";
}

$mysqli->close();