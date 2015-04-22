

$(document).ready(function(){
var checkCookie = function() {
                var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari  
                xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5  
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                     var islogin=$.trim(xmlhttp.responseText);
                     if(islogin=="1")
                     {

                    }
                    else{
                            setTimeout(function() {
                                    window.location.href = "admin.html";
                                    }, 100);
                    }
                }
        }
        xmlhttp.open("GET","../php/takeAction.php?action=isadmin",true);
        xmlhttp.send();
        }

        checkCookie();	
	var _gogo;
	var start_btn = $("#start");
	var stop_btn = $("#stop");
	var restart_btn = $("#restart");
	var clear_btn = $("#clear");
	var hide_btn = $("#hide");
	var cellnum = 1;
		$("#top1").click(function() { 
	    cellnum=39;;
	});
		
	/*$("#first").click(function() { 
	    cellnum=38;
	});
	$("#second").click(function() { 
	    cellnum=36;
	});
	$("#third").click(function() { 
	    cellnum=31;
	});
	$("#superluck").click(function() { 
	    cellnum=21;
	});
	$("#luck").click(function() { 
	    cellnum=1;
	});*/
	start_btn.click(function(){
		 $.getJSON("../php/takeAction.php", { "action" : "lotterystart"}, function(json){
			if (cellnum>=89) 
			{
				alert("抽奖人数已完");
			}
			else
			{
				if(json){
					//var obj = eval(json);//通过eval() 函数可以将JSON字符串转化为对象
					var len = json.length;
					_gogo = setInterval(function(){
						var num = Math.floor(Math.random()*len);
						var id = json[num].user_id;
						var v = json[num].phonenumber;
						var phone = v.substring(0,3)+"****"+v.substring(7,11);
						$("#roll").html(phone);
						$("#mid").val(v);
					},30);
					stop_btn.show();
					start_btn.hide();
				}else{
					$("#roll").html('系统找不到数据源，请先导入数据。');
				}
			}
		});
		//_gogo = setInterval(show_number,100);
	});
	stop_btn.click(function(){
		clearInterval(_gogo);
		var phone = $("#mid").val();
		var phonenumber = phone.substring(0,3)+"****"+phone.substring(7,11);
		$.get("../php/takeAction.php", {"phonenumber":phone,"action" : "lotterystop"}, function(){	
			document.getElementById(cellnum).innerHTML = phonenumber; 
			cellnum++;
			if (cellnum>=40) {cellnum=40;};
			stop_btn.hide();
			start_btn.show();
		});
	});
 	restart_btn.click(function(){
 		if(cellnum>=2)
 		{
 			cellnum--;
	 		document.getElementById(cellnum).innerHTML = " "; 
	 		
 		}
	    $.get("../php/takeAction.php", {"action" : "lotteryrestart"}, function(){	

		});
	});
	clear_btn.click(function(){
	    $.get("../php/takeAction.php", {"action" : "lotteryclear"}, function(){	
	    	alert("清空完毕。");
		});
	});
	var tmp=0;
	hide_btn.click(function(){	    
	    if(tmp==0){
			$("#top1").hide();
			tmp=1;
	    }
	    else{
	    	$("#top1").show(); 
	    	tmp=0;
	    }
	     
	    
	});
	function autoclick(){
		lnk = document.getElementById("makehtml");
		lnk.click();
	}
});
