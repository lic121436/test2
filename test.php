<?php
/*
 * header("Content-type:text/html; charset=utf-8");
 * if($con = mysqli_connect('localhost', 'root', 'root')){
 * echo "连接成功";
 * }else{
 * echo "连接失败";
 * }
 */
header("Content-type:text/html; charset=utf-8");

/*
 * if (function_exists('mysql_connect')) {
 * echo 'Mysql扩展已经安装';
 * }
 */

// PDO扩展

/*
 * $dsn = 'mysql:dbname=test;host=127.0.0.1';
 * $user = 'root';
 * $password = 'root';
 * $dbh = new PDO($dsn, $user, $password);
 */

/*
 * $link = mysqli_connect('localhost','root','root') or die("数据库连接失败");
 * mysqli_select_db($link,'test');
 * $rault = mysqli_query($link, 'select * from test ');
 * $row = mysqli_fetch_array($rault);
 * print_r($row);
 */

$link = mysqli_connect('localhost', 'root', 'root');
mysqli_select_db($link, 'test');
mysqli_query($link, 'set names utf-8');
$rault = mysqli_query($link, 'select * from test ');
// $row = mysqli_fetch_row($rault);
/*
 * while($row = mysqli_fetch_row($rault)){
 * echo "id:".$row[0]." 名字：".$row[1]." 年龄：".$row[2].'<br/>';
 * }
 */

/*
 * $row = mysqli_fetch_array($rault, MYSQLI_NUM);
 * $row = mysqli_fetch_array($rault, MYSQLI_ASSOC);
 * $row = mysqli_fetch_array($rault, MYSQLI_BOTH);
 */

/*
 * $row = mysqli_fetch_assoc($rault);
 * echo $row['name'].$row['id'].$row['age'];
 */

/*
 * $row = mysqli_fetch_object($rault);
 * echo $row->name.' '.$row->id." ".$row->age.'<br/>';
 */

/*
 * $row = mysqli_fetch_all($rault);
 * print_r($row);
 */

/*
 * $num = mysqli_num_rows($rault);
 * if($rault && $num){
 * echo "数据输出操作";
 * }else{
 * echo "暂时没有数据";
 * }
 */

/*
 * $result = mysqli_query($link, "update test set name = 'Tom' where id = 5");
 * if($result){
 * echo "修改成功，修改记录条数：";
 * echo mysqli_affected_rows($link);
 * }else{
 * echo "修改失败";
 * }
 */

/*
 * $result = mysqli_query($link, "insert test(name, age) values('John', 18), ('Rose', '19')");
 * if($result){
 * echo "插入成功，插入记录条数：";
 * echo mysqli_affected_rows($link);
 * }else{
 * echo "插入失败";
 * }
 */

/*
 * $result = mysqli_query($link, "delete from test where id >= 22");
 * if(result){
 * echo "删除成功，删除记录条数：";
 * echo mysqli_affected_rows($link);
 * }else{
 * echo "删除失败";
 * }
 */

// 查询数据到数组中
$result = mysqli_query($link, 'select * from test ');
$results = array();
while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

// 将数组转成json格式
echo json_encode($results);

?>