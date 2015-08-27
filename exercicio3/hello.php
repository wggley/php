<?php

include_once("start.php");

$result = mysql_query("select now()");
list($cur_date) = mysql_fetch_array($result);
mysql_free_result($result);

echo "Hello World at DB time: ".$cur_date."<br />";

?>