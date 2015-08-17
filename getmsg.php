<?php
set_time_limit(30);
//session_start();
include_once 'db.inc.php';
$start = time();
if ($_POST['t']==0)
{
	//取出当前消息数
	$sql = "SELECT count(*) FROM `chat`" ;
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	$num = $row[0];
	//判断是否小于15条
	$start = $num<15?0:$num-15;
	$sql = "SELECT `chtime`,`nick`,`words` FROM `chat` ORDER BY id ASC LIMIT $start, 15" ;
}else{
	$timestamp = date("Y-m-d H:i:s",$_POST['t']);
	$sql = "SELECT `chtime`,`nick`,`words` FROM `chat` WHERE `chtime`>'$timestamp'" ;
}

$flag = false;
$ret = array();
do{
	$result = mysql_query($sql);
	$ret['msg'] = array();
	if ($result)
	{
		$ret['num'] = mysql_num_rows($result);
	}
	while ($row = mysql_fetch_array($result) )
	{
		$ret['msg'][] = array(
			'chtime' => $row['chtime'],
			'nick' => $row['nick'],
			'words' => $row['words']
		);
	}
	if (!$result || !$ret['num'] )
	{
		sleep(1);
	}
	$now = time();
}while((!$result || !$ret['num']) && $now-$start<20 );
if(!empty($ret['msg'])){
	$lastrow = end($ret['msg']);
	$ret['lasttime'] = strtotime($lastrow['chtime']);
}

echo json_encode($ret);

?>