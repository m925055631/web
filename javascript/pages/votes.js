
	

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
							window.location.href = "login.html";			  		
							}, 100);
					}
                }  
        }
        xmlhttp.open("GET","../php/takeAction.php?action=isLogin",true);
        xmlhttp.send();
	} 
	
	checkCookie();
	// 使用从后台得到的数据渲染页面
	
	var renderMemberList = function(res) {
		var member_list = $("#memberList");
		var length = res.length;
		member_list.html("");
		for( var i = 0; i < length; i ++ ) {
			var user = res[i];
		   if(user['enable'] == '1'){
			if(i==0){
				
				var li = $("<label class='checkbox'>" +
                                                "<div class='controls'>" +
                                                "<input type='checkbox' value=" + user['programid'] + ">"
                                                                        +user['programname']+
                                                "</div>" +
                                                                "</label>"+
                                "</li>");
			}
			else if(i==length-1){
				 var li = $("<li>" +
                                        "<label class='checkbox'>" +
                                                "<div class='controls'>" +
                                                "<input type='checkbox' value=" + user['programid'] + ">"
                                                                        +user['programname']+
                                                "</div>" +
                                                                "</label>"
					);
			}
			else{
				var li = $("<li>" +
	                		"<label class='checkbox'>" +
	                  			"<div class='controls'>" +
	                    			"<input type='checkbox' value=" + user['programid'] + ">" 
									+user['programname']+
	                  			"</div>" +
								"</label>"+
	              		"</li>");
			}
			member_list.append(li);
		}else{
			 if(i==0){
                                
                                var li = $("<label class='checkbox'>" +
                                                "<div class='controls'>" +
                                                "<input type='checkbox'disabled='true' value=" + user['programid'] + ">"
                                                                        +user['programname']+
                                                "</div>" +
                                                                "</label>"+
                                "</li>");
                        }
                        else if(i==length-1){
                                 var li = $("<li>" +
                                        "<label class='checkbox'>" +
                                                "<div class='controls'>" +
                                                "<input type='checkbox' disabled='true' value=" + user['programid'] + ">"
                                                                        +user['programname']+
                                                "</div>" +
                                                                "</label>"
                                        );
                        }
                        else{
                                var li = $("<li>" +
                                        "<label class='checkbox'>" +
                                                "<div class='controls'>" +
                                                "<input type='checkbox' disabled='true' value=" + user['programid'] + ">"
                                                                        +user['programname']+
                                                "</div>" +
                                                                "</label>"+
                                "</li>");
                        }
                        member_list.append(li);
		}
		}
		
	};
	
	$.getJSON("../php/takeAction.php", {"action" : "getProgram"}, function(res) {
		renderMemberList(res);
	});

	function SelectLeastOne(){
				var select=0;
				var myvotes = new Array();
				objName= document.getElementById("myform")   
					for (i=0; i<objName.length; i++){
						if (objName[i].type=="checkbox" && objName[i].checked){    
							select++;
							j=i+1;
							myvotes.push("v"+j+"v");
						}
					}
					if(select==0){
						alert('请投票！'); 
					}
					else if(select >5 )
					{
						alert('请选择不超过5票！'); 
					}					
					else{
						$.get("../php/takeAction.php", {"myvotes":myvotes.toString(),"action" : "addvotes"}, function(res) {
							var message = $.trim(res);
							console.log(message);
							if( message == "1" ) {
								setTimeout(function() {
									window.location.href = "succeed.html";			  		
									}, 500);
				
							}else {
								//$('#submitButton').popover('show');
								//alert(message);
								alert("一个手机号只能投票一次");							
							}
						});
					}
			}
	$("#submitButton").bind("click", function() {		  
	  //alert(pages);
	  SelectLeastOne();
	});

	$("form").bind("submit", function() {
		return false;
	});
});
