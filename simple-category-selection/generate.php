<?php

include_once("start.php");

for($i=0;$i<100;$i++){
	$str = 'abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ ';
	$length = rand(20,40);
	$titulo = substr(str_repeat(str_shuffle($str),10), 0, $length);
	$str = 'abcdefghijklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ ';
	$length = rand(100,200);
	$texto = substr(str_repeat(str_shuffle($str),10), 0, $length);
	$id_categoria = rand(1,7);
	$query = 'insert into item (titulo,texto,id_categoria) values("'.$titulo.'","'.$texto.'",'.$id_categoria.')';
	
	$result = mysql_query($query);
	echo mysql_error();
}


echo "Generated rows at DB";

?>