<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>新增内容</title>
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
				<th colspan="2" class="tc">新增列表</th>
			</tr>
		</thead>
		<tbody>
			<form method="post" action="user.do.action.php?act=add">


				<tr>
					<td>用户名</td>
					<td><input type="text" name="username" size="80"></td>
				</tr>
				<tr class="tc">
					<td colspan="2"><input type="submit" value="新增"></td>
				</tr>
			</form>
		</tbody>
	</table>
</body>
</html>