<?php 
require_once 'connect.php';

// Ԥ����sql���
$sql = "INSERT user(username, password, age) VALUES(?,?,?)";

// ׼��Ԥ�������
$mysqli_stmt = $mysqli->prepare($sql);

$username = "king4";
$password = md5("king4");
$age = 15;

// s���ַ���,i������,d������
// �󶨲���
$mysqli_stmt->bind_param("ssi", $username, $password, $age);

// ִ��Ԥ�������
if($mysqli_stmt->execute()){
    echo $mysqli_stmt->insert_id;
    echo "<br/>";
}else{
    echo $mysqli_stmt->error;
}
