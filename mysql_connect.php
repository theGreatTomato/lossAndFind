<?php
define('DATABASE_LOCALHOST', '127.0.0.1');
define('DATABASE_USERNAME', 'root');
define('PASSWORD','root');
define('DB_NAME','test');
$link = @mysql_connect(DATABASE_LOCALHOST, DATABASE_USERNAME, PASSWORD) or die('数据库连接失败');
mysql_select_db(DB_NAME);//选择数据库
mysql_query("set names 'utf8'");//数据库的编码
?>