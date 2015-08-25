<?php
$_fp = fopen("php://stdin", "r");

$params = explode(" ", preg_replace( "/\r|\n/", "", fgets($_fp)));
$vertices = $params[0];
$edges = $params[1];
$tree = array_fill(0,$vertices,0);
$count = array_fill(0,$vertices,1);
for ($i=0; $i < $edges; $i++) { 
    $row = explode(" ", preg_replace( "/\r|\n/", "", fgets($_fp)));
    $u1 = $row[0];
    $v1 = $row[1];
    $tree[$u1-1] = $v1;
    $count[$v1-1] += $count[$u1-1];
    $root = $tree[$v1-1];    
    while($root != 0){
        $count[$root-1] += $count[$u1-1];
        $root = $tree[$root-1];
    }
}
fclose($_fp);
$counter = -1;
for($i=0;$i < count($count);$i++)
{
    if($count[$i]%2==0){
        $counter++;
    }
}
print($counter);
?>