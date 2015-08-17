function add(className, innerHTML){
	dom = document.createElement("span");
	dom.className = className;
	dom.innerHTML = innerHTML;
	$("#msg").append(dom);
	$("#msg *:last")[0].scrollIntoView();
	return dom;
}

function addMsg(time, nick, words){
	add( "msgItem", time + " "+ nick + ": "+ words );
}

function addTip(words){
	add( "msgItem system", "系统提示: "+ words );
}

function sendMsg(m){
	if (m === ""){
		addTip("消息不能为空！");
		return ;
	}
	$.ajax( {
		type: "POST",
		url: "say.php",
		data: {
			msg: m
		},
		dataType: "json", //服务器返回类型JSON，不是上面data的类型
		success : function(data) {
			if (data.error !== 0)
			{
				addTip(data.msg);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
			addTip("网络异常，发言失败");
		},
	});
}

$("#say").click( function(){
	sendMsg( $("#words").val() );
	$("#words").val('');
	$("#words").focus();
} );
	
$("#words").keydown( function(event){
	if (event.which == 13)
	{
		$("#say").click();
	}
} );


$(function () {
		var timestamp = 0;
		var getting = false;
		function updateMsg(){
			$.ajax({
				type: "POST",
				url: "getmsg.php",
				timeout: 30000,
				dataType: "json",
				data: {
					t: timestamp
				},
				success: function(data) {
					//console.log(data);
					for(var i = 0; i<data.msg.length;i++) 
					{
						addMsg(data.msg[i].chtime, data.msg[i].nick, data.msg[i].words);
						
					}
					if (data.num > 0)
					{
						timestamp = data.lasttime;
					}
					updateMsg();
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
						addTip("网络异常，获取消息失败");
						if (timestamp !== 0) //防首次加载就失败导致死循环
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

