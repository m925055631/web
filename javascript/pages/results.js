

$(document).ready(function(){	
	
	$.getJSON("../php/takeAction.php", {"action" : "getVoteResult"}, function(res) {
		var programList = $("#programList");
		var  program = new Array();
		var  programname = new Array();
		var votednum = new Array();	
		var length = res.length;
		for( var i = 0; i < length; i ++ ) {
			var result = res[i];
			var num = Math.ceil(result["votednum"]);
			program.push(result["programid"]);
			programname.push(result["programname"]);
			votednum.push(result["votednum"]);
			if(i==0){
					var li = "<p>"  + programname[0] +"("+votednum[0]+"票)"+"</p>"+"</li>";
			}else{
				var li ="<li>"+"<p>"  + programname[i]+"("+votednum[i]+"票)"+"</p>"+"</li>";
			}
			programList.append(li);
		}
		var barChartData = {
			labels : program,
			datasets : [
				{
					fillColor : "#555555",
					//fillColor:"#FF6600",
					strokeColor : "#999999",
					highlightFill : "#FF6600",
					highlightStroke : "#999999",
					data : votednum
				}
			]
		};
	
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true,
				scaleShowLabels : true
		});
	});
	
});
