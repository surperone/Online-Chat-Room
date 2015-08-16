<?php
error_reporting(E_ALL ^ E_NOTICE);
define('MYSQL_HOST', '127.0.0.1:3306');
define('MYSQL_USER', 'root');
define('MYSQL_PWD', '123456');
//define('MYSQL_USER', 'admin');
//define('MYSQL_PWD', 'b91c750b');
$link = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD) or die('Database connect failed'); 
mysql_select_db("chat");
mysql_query('set names utf8');

?>