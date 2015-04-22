


$(document).ready(function(){
	$.get("../php/takeAction.php", {"action" : "isLogin"}, function(res) {
		var username = $.trim(res);

		if( username === "" ) 
		{
			$(".pull-right").html(	"<li>" +
										"<a id='nav_login' class='nav-text' href='login.html'>" +
											"<span>管理员登录</span>" +
										"</a>" +
									"</li>");
		} 
		else 
		{
			$(".pull-right").eq(0).html(	
											"<li>" +
                								"<p class='welcome'>" + "<a href='admin.html'>Hi, "+ username + "</a></p>" +
              								"</li>" +
											"<li>" +
												"<a id='nav_logout' class='nav-text' href='javascript:void(0)'>" +
													"<span>退出</span>" +
												"</a>" +
											"</li>");			
		}
	});

	$("#nav_logout").live("click", function() {
		var result = confirm("确认退出？");

		if( result === true ) {
			$.post("../php/takeAction.php", {"action" : "logout"}, function(res) {
				alert("退出成功");
				setTimeout(function() {
			  		window.location.href = "../index.php";
			  	}, 500);
			});
		}
	});

	$("form").live("submit", function() {
		return false;
	});

	
});

