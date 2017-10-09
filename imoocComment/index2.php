<?php
	require_once "connect.php";
	require_once "comment.class2.php";
	$sql = "SELECT username, email, url, face, content, pubTime FROM comments";
	$mysqli_result = $mysqli->query($sql);
	if($mysqli_result && $mysqli_result->num_rows > 0){
		
		while($row = $mysqli_result->fetch_assoc()){
			$comments[] = new Comment($row);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
</head>
<body>
	<h1>慕课网评论系统-<span  id="qianping" >全屏</span></h1>
	<div id="show">显示内容</div>
	<div id='main'>
		<?php
			if(!isset($comments)){
				echo "<div class='comment' id='noData'>暂无数据</div>";
			}else{
				foreach($comments as $val){
					echo $val->output();
				}
			}
		?>
		<div id='addCommentContainer'>
			<form id="addCommentForm" method="post" action="">
    	<div>
        	<label for="username">昵称</label>
        	<input type="text" name="username" id="username" required='required' placeholder='请输入您的昵称'/>
            
            <label for="face">头像</label>
            <div id='face'>
					<input type="radio" name="face" checked='checked' value="1" /><img src="img/1.jpg" alt="" width='50' height='50' />&nbsp;&nbsp;&nbsp;
					<input type="radio" name="face"  value="2" /><img src="img/2.jpg" alt="" width='50' height='50' />&nbsp;&nbsp;&nbsp;
					<input type="radio" name="face"  value="3" /><img src="img/3.jpg" alt="" width='50' height='50' />&nbsp;&nbsp;&nbsp;
					<input type="radio" name="face"  value="4" /><img src="img/4.jpg" alt="" width='50' height='50' />&nbsp;&nbsp;&nbsp;
					<input type="radio" name="face"  value="5" /><img src="img/5.jpg" alt="" width='50' height='50' />&nbsp;&nbsp;&nbsp;
            </div>
            <label for="email">邮箱</label>
            <input type="email" name="email" id="email" required='required' placeholder='请输入合法邮箱'/>
            
            <label for="url">个人博客</label>
            <input type="url" name="url" id="url" />
            
            <label for="content">评论内容</label>
            <textarea name="content" id="content" cols="20" rows="5" required='required' placeholder='请输入您的评论...'></textarea>
            <input type="submit" id="submit" value="发布评论" />
        </div>
    </form>
		</div>
	</div>
<script type="text/javascript" src="script/jquery.min.js"></script>
<script>
	$(function(){
		$('#qianping').on('click', function() {
			var docElm = document.documentElement;
			//W3C  
			if(docElm.requestFullscreen) {
				docElm.requestFullscreen();
			}
			//FireFox  
			else if(docElm.mozRequestFullScreen) {
				docElm.mozRequestFullScreen();
			}
			//Chrome等  
			else if(docElm.webkitRequestFullScreen) {
				docElm.webkitRequestFullScreen();
			}
			//IE11
			else if(elem.msRequestFullscreen) {
				elem.msRequestFullscreen();
			}
			//layer.msg('按Esc即可退出全屏');
		});
		

		$("#show").on('click', function(){
			$(this).text("我思故我在");
		});
		
		$("#show").trigger("click");
		
			$(document).keydown(function(e) {
				console.log(e.keyCode);
			});
		
		
		function chunkArrayInGroups (arr, size) {
			for (var i = 0, result=[]; i < arr.length; i += size){
				result.push(arr.slice(i, i + size));
			}
			return result;
		}
		
		chunkArrayInGroups()
		
	});
</script>
<script type="text/javascript" src="script/comment2.js"></script>

</body>
</html>