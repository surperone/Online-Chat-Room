<?php
include_once 'db.inc.php';
$nick = $_COOKIE['nick'];
$words = $_POST['msg'];
$sql = "INSERT INTO `chat`(`nick`,`words`)
		VALUES ('$nick', '$words')";
mysql_query($sql);
?>