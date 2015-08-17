<?php
session_start();
include_once 'db.inc.php';

do
{
	if( !isset($_SESSION['lastsay']) )
	{
		$ret ['error'] = 2;
		$ret ['msg'] = 'nmb';
		break;
	}
	if ( !isset($_SESSION['lastsay']) )
	{
		$_SESSION['lastsay'] = 0;
	}
	$nick = $_SESSION['nick'];
	$words = $_POST['msg'];

	if (time() - $_SESSION['lastsay'] < 3 )
	{
		$ret ['error'] = 1;
		$ret ['msg'] = '您发言过快！';
		break;
	}
	$_SESSION['lastsay'] =	time();
	$sql = "INSERT INTO `chat`(`nick`,`words`)
			VALUES ('$nick', '$words')";
	mysql_query($sql);
	
	$ret ['error'] = 0;
}while(0);

echo json_encode($ret);
?>