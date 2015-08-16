<?php
if ( isset( $_POST['nick'] ) )
{
	//处理登陆请求
	setcookie("nick", $_POST['nick']);
	header("Location: index.php");
}else{
	//显示登陆页面
	include 'login.html';
}
?>