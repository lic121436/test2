<?php
require_once 'connect.php';
$id = $_GET['id'];
if (! isset($id) && ! empty($id)) {
    echo "<script>alert('请选择修改的内容');window.location.href='user.list.php';</script>";
} else {
    $selectsql = "SELECT * FROM mysqli WHERE id ='$id' ";
    $mysqli_result = $mysqli->query($selectsql);
    if ($mysqli_result && $mysqli_result->num_rows > 0) {
        $row = $mysqli_result->fetch_assoc();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>修改内容</title>
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
		列表-<a href="user.list.php">返回列表</a>
	</h2>
	<table border="1" cellpadding="0" cellspacing="0" width="80%">
		<thead>
			<tr>
				<th colspan="2" class="tc">修改列表</th>
			</tr>
		</thead>
		<tbody>
			<form method="post" action="user.do.action.php?act=edit">
				<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
				<tr>
					<td>用户名</td>
					<td><input type="text" name="username" size="80"
						value="<?php echo $row['username'];?>"></td>
				</tr>
				<tr class="tc">
					<td colspan="2"><input type="submit" value="修改"></td>
				</tr>
			</form>
		</tbody>
	</table>
</body>
</html>