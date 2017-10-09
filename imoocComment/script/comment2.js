$(function(){

	
	
	// 此标志防止多次提交
	var flag = false;
	$("#addCommentForm").submit(function(e){
		// 阻止自动提交表单
		e.preventDefault();
		if(flag){
			return false;
		}else{
			flag = true;
		}
		
		$("#submit").val("提交...");
		$("span.errors").remove();
		
		// Ajax提交数据
		$.post("doAction2.php", $(this).serialize(), function(msg){
			flag = false;
			$("#submit").val("发布评论");
			if(msg.status){
				$(msg.html).hide().insertBefore("#addCommentContainer").slideDown();
				$("#content").val("");
				// 判断是否存在id为noData的标签为的话将其隐藏
				if($("#noData")){
					$("#noData").hide();
				}
			}else{
				$.each(msg.errors, function(k, v){
					$('label[for='+k+']').append('<span class="error">'+v+'</span>');
				});
			}
		},"json");
		
	});
});