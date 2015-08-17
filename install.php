<?php
include_once 'db.inc.php';
$file=file_get_contents("chat.sql");
$sqls=explode(";",$file);

foreach($sqls as $sql){ 
mysql_query($sql);
}

?>