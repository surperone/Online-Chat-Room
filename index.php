<?php
if ( isset( $_COOKIE['nick'] ) )
{
	//已登录
	include 'msg.html';
}else{
	//未登录
	header("Location: login.php");
}
?>