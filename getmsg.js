function add(dom){
	$("#msg").append(dom);
	$("#msg *:last")[0].scrollIntoView();
}

function addMsg(time, nick, words){
	add( "<p class=\"msg\" id=\"msg" + Math.round( 40*Math.random()) + "\">"+ time + " "+ nick + ": "+ words +"</p>" );
}
function addTip(words){
	add( "<p class=\"system\">系统提示: "+ words +"</p>" );
}

function sendMsg(m){
	if (m == ""){
		addTip("消息不能为空！");
		return ;
	}
	$.ajax( {
		type: "POST",
		url: "say.php",
		data: {
			msg: m
		},
		success : function(data) { 
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
		},
	});
}
		
$("#say").click( function(){
	sendMsg( $("#words").val() );
} );

$(function () {
		var timestamp = 0;
		var getting = false;
		function updateMsg(){
			$.ajax({
				type: "GET",
				url: "getmsg.php",
				dataType: "json",
				timeout: 30000,
				data: {
					t: timestamp
				},
				success: function(data) {
					console.log(data);
					for(var i = 0; i<data.msg.length;i++) 
					{
						addMsg(data.msg[i].chtime, data.msg[i].nick, data.msg[i].words);
						
					}
					if (data.num > 0)
					{
						timestamp = data.lasttime;
					}
					$("#msg")[0].scrollIntoView();
					updateMsg();
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
						addTip("网络异常");
						if (timestamp != 0) //防首次加载就失败导致死循环
						{
							updateMsg();
						}else
						{
							addTip("请刷新");
						}
				},
			});
		}
		updateMsg();
		addTip("欢迎来到聊天室");
});

