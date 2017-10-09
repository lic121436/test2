<?php
require_once 'connect.php';

$sql = "SELECT id, name FROM test;";
$sql .= "SELECT id, username FROM mysqli;";

// use_result()/store_result()
// more_results():检测是否有更多的结果集
// next_resutl():将结果信指针向下移动一位

if ($mysqli->multi_query($sql)) {
    do {
        if ($mysqli_result = $mysqli->store_result()) {
            $rows[] = $mysqli_result->fetch_all(MYSQLI_ASSOC);
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
} else {
    echo $mysqli->error;
}
print_r($rows);
$mysqli->close();