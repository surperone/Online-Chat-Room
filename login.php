<?php
session_start();
if ( isset( $_POST['nick'] ) )
{
	//处理登陆请求
	$_SESSION['nick'] = $_POST['nick'];
	header("Location: index.php");
}else{
	//显示登陆页面
	include 'login.html';
}
?>