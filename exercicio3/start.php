<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

/*************/
/* dbconnect */
function dbconnect(){
	$database = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	mysql_select_db(DB_NAME, $database);
}

/*************/
/* dbclose */
function dbclose(){
	mysql_close();
}

$current_dir = dirname(__FILE__);
include($current_dir."/config.php");

dbconnect();

?>