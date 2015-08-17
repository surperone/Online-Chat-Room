<?php

//初始化常量
define('DEBUG', true);
define('PCONNECT', function_exists('mysql_pconnect'));
define('MYSQL_HOST', '127.0.0.1:3306');
define('MYSQL_USER', 'root');
define('MYSQL_PWD', '123456');
//define('MYSQL_USER', 'admin');
//define('MYSQL_PWD', 'b91c750b');

//调试处理
if(DEBUG){
	error_reporting(E_ALL);
}

//初始化数据库
if(PCONNECT){
	//使用持久连接
	$link = @mysql_pconnect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD) or die('Database connect failed');
}else{
	$link = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD) or die('Database connect failed'); 
}
mysql_select_db("chat");
mysql_query('set names utf8');

?>