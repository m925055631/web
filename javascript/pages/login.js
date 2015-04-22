

$(document).ready(function(){
	var wait=60;
	function time(o) {
		if (wait == 0) {
			o.removeAttribute("disabled");			
			o.value="获取验证码";
			wait = 60;
		} else {
			o.setAttribute("disabled", true);
			o.value="重新发送(" + wait + ")";
			wait--;
			setTimeout(function() {
				time(o)
			},
			1000)
		}
	}
	var get_mobile_code=function (phonenumber){
		
        $.get("../php/takeAction.php", {"phonenumber" : phonenumber,"action" : "sendSms"}, function(msg) {
            var message = $.trim(msg);
			if(message=="sendsucceed"){
				alert("验证码发送成功，请检查手机！");
				time(document.getElementById("zphone"));
			}
			else if (message=="sendwrong") {
				alert("验证码发送失败！");
			}
			else if (message=="numwrong") {
				alert("手机号错误，请重新输入");
			}
			else if (message=="timein") {
				alert("60s内不能重复获取！");
			}			
			else{
				alert(message);
			}
        });
	};
	var login = function(phonenumber,mobile_code) {
		$.get("../php/takeAction.php", {"phonenumber" : phonenumber,"mobile_code":mobile_code, "action" : "login"}, function(res) {
		  	var message = $.trim(res);
		  	
		  	if( message == "codesucceed" ) {
				self.location=document.referrer;
		  	} else if(message == "numwrong"){
			//	$('#inputPhonenumber').tooltip('show')
			//	$('#inputPhonenumber').popover('show');
		  		alert("手机号错误，请重新输入");
		  	}else if (message == "codewrong") {
				alert("验证码错误，请重新输入");
		  	}else if(message == "getcode") {
		  		alert("请重新获取验证码");
		  	}
		  	else if (message=="timeout") {
				alert("验证码已过期，请重新获取！");
			}else{
				alert(message);
		  	}
		});
	};
	//手机号码验证信息 
	function validatemobile(phone) 
   { 
	   	var _emp=/^\s*|\s*$/g;
	    phone=phone.replace(_emp,"");
	    var _d=/^1[3578][01379]\d{8}$/g; //电信号码
	    var _l=/^1[34578][01256]\d{8}$/g; //联通号码
	    var _y=/^(134[012345678]\d{7}|1[34578][012356789]\d{8})$/g; //移动号码
       if(phone.length==0) 
       { 
          alert('请输入手机号码！'); 
          return false; 
       } 
       if(phone.length!=11) 
       { 
          alert('请输入有效的手机号码！'); 
           return false; 
       } 
       if(!_d.test(phone)) 
      { 
          alert('请输入有效的手机号码！');
           return false; 
       } 
       return true;
   } 
	//验证码验证信息 
	function validatecode(code){
		var _emp=/^\s*|\s*$/g;
	    code=code.replace(_emp,"");
	    var _d=/^\d{6}$/g;
	    if(code.length==0) 
       { 
          alert('请输入验证码！'); 
          return false; 
       } 
	    if(!_d.test(code)) 
      	{ 
          alert('请输入有效的验证码！');
           return false; 
       } 
       else{
       		return true;
       }
       
	}
	$("#zphone").bind("click", function() {
		var phonenumber = $("#inputPhonenumber").val();
		//var send_code = <?php echo $_SESSION['send_code'];?>;
		//var send_code=Math.round(Math.random()*100000);
		if(validatemobile(phonenumber)){
			get_mobile_code(phonenumber);			
		}		
		
	});

	$("#loginButton").bind("click", function() {
		var phonenumber = $("#inputPhonenumber").val();
		var mobile_code = $("#mobile_code").val();
		
		if(validatecode(mobile_code)){
			login(phonenumber,mobile_code);
		}
	});

	
	$("form").bind("submit", function() {
		return false;
	});
});
