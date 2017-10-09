<?php
require_once 'connect.php';
$selectsql = "SELECT * FROM mysqli";
$mysqli_result = $mysqli->query($selectsql);
if ($mysqli_result && $mysqli_result->num_rows > 0) {
    while ($row = $mysqli_result->fetch_assoc()) {
        $rows[] = $row;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>列表</title>
<style>
.tc {
	text-align: center;
}

table tr th {
	padding: 10px 0;
}

table tr td {
	padding: 3px;
}
</style>
</head>
<body>
	<h2>
		列表-<a href="user.add.php">新增</a>
	</h2>
	<table border="1" cellpadding="0" cellspacing="0" width="80%">
		<thead>
			<tr>
				<th>编号</th>
				<th>名字</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
            <?php
            if (! empty($rwos)) {
                echo "<tr><td colspan='3' style='text-align: center;'>暂无数据</td></tr>";
            } else {
                $i = 1;
                foreach ($rows as $data) {
                    ?>
            <tr>
				<td><?php echo $i;?></td>
				<td><?php echo $data['username']?></td>
				<td class="tc"><a href="user.edit.php?id=<?php echo $data['id'];?>">编辑</a>
					<a href="user.do.action.php?act=del&id=<?php echo $data['id'];?>">删除</a></td>
			</tr>
            <?php
                    $i ++;
                }
            }
            ?>
        </tbody>
	</table>
</body>
</html>