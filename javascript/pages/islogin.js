
$(document).ready(function(){
function checkCookie() {
		var phonenumber=getCookie('phonenumber')
		if (phonenumber!=null && phonenumber!=""){
			alert("请先用手机号登陆");
				setTimeout(function() {
					window.location.href = "login.html";			  		
			  	}, 500);
		}
		else {
			alert("请先用手机号登陆");
				setTimeout(function() {
					window.location.href = "login.html";			  		
			  	}, 500);
		}
	}
	

	function getCookie(phonenumber){
		if (document.cookie.length>0)
		{
			var c_start=document.cookie.indexOf(phonenumber + "=")
			if (c_start!=-1)
			{ 
				c_start=c_start + phonenumber.length+1 
				c_end=document.cookie.indexOf(";",c_start)
				if (c_end==-1) c_end=document.cookie.length
				return unescape(document.cookie.substring(c_start,c_end))
			} 
		}
		return ""
	}


});