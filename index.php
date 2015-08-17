<?php
session_start();
if ( isset( $_SESSION['nick'] ) )
{
	//已登录
	include 'msg.html';
}else{
	//未登录
	header("Location: login.php");
}
?>