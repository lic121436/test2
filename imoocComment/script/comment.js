$(function(){
	//此标志用于标志是否提交，防止多次提交
	var flag=false;
	//监测是否提交
	$('#addCommentForm').submit(function(e){
		//阻止表单的自动提交
 		e.preventDefault();
 		
		if(flag) {
			return false;
		}else{
			flag = true;
		}
		
		$('#submit').val('发布...');
		$('span.error').remove();
		console.log(flag);
		//通过Ajax发送数据
		$.post('doAction.php',$(this).serialize(),function(msg){
			console.log(flag);
			flag = false;
			$('#submit').val('发布评论');
			console.log(msg);
			if(msg.status){
				console.log(msg.status);
				$(msg.html).hide().insertBefore('#addCommentContainer').slideDown();
				$('#content').val('');
			}
			else {
				$.each(msg.errors,function(k,v){
					console.log(k);
					console.log(v);
					$('label[for='+k+']').append('<span class="error">'+v+'</span>');
				});
			}
		},'json');
	});
});



