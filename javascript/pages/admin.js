

$(document).ready(function(){

	var login = function(username,password) {
		$.get("../php/takeAction.php", {"username" : username,"password" : password, "action" : "admin"}, function(res) {
		  	var message = $.trim(res);
		  	if( message == "1" ) {
		  	//	alert("登陆成功");
				setTimeout(function() {
					window.location.href = "lotteryactivity.html";			  		
					//window.location.href = "votestest.html";			  		
			  	}, 500);
				
		  	} else {
			//	$('#inputPhonenumber').tooltip('show')
				$('#password').popover('show');
		  	//	alert("手机号错误，请重新输入");
		  	}
		});
	};

	$("#login").bind("click", function() {
		//alert("ok");
		var username = $("#username").val();
		var password = $("#password").val();
		login(username,password);
	});

	$("form").bind("submit", function() {
		return false;
	});
});
