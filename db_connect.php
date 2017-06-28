<?php
	header("Content-Type:text/html; charset='utf-8'");
	$db_host="localhost";
	$db_account="visitor";
	$db_passeord="visitor123";
    $db_name = "theaterlib";
	$conn=@mysql_connect($db_host,$db_account,$db_passeord) or die("連線錯誤");
    $db_select = mysql_select_db($db_name) or die("資料庫選擇失敗");
    mysql_query("SET NAMES 'utf8'"); 
    mysql_query("SET CHARACTER_SET=utf8"); 
    mysql_query("SET CHARACTER_SET_CLIENT=utf8"); 
    mysql_query("SET CHARACTER_SET_RESULTS=utf8");
?>
