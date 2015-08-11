<?php
$_fp = fopen("php://stdin", "r");

$array_params = split(" ", preg_replace( "/\r|\n/", "", fgets($_fp)));
$rows = $array_params[0];
$columns = $array_params[1];
$rotations = $array_params[2];
$matrix = array();
for ($i = 0; $i < $rows; $i++) {
    $matrix[$i] = split(" ", preg_replace( "/\r|\n/", "", fgets($_fp)));
}
fclose($_fp);
$first_row = 0;
$first_column = 0;
$last_row = $rows -1;
$last_column = $columns -1;   
do {
    //pushing elements to row
    $index_quadrant = $first_row;
    // first row
    $i = $first_row;
    for($j = $first_column; $j < $last_column; $j++) {
        $quadrant[$index_quadrant][] = $matrix[$i][$j];
    }
    // last column
    $j = $last_column;
    for($i = $first_row; $i < $last_row; $i++) {
        $quadrant[$index_quadrant][] = $matrix[$i][$j];
    }
    // last row
    $i = $last_row;
    for($j = $last_column; $j > $first_column; $j--) {
        $quadrant[$index_quadrant][] = $matrix[$i][$j];
    }
    // first column
    $j = $first_column;
    for($i = $last_row; $i > $first_row; $i--) {
        $quadrant[$index_quadrant][] = $matrix[$i][$j];
    }
    $index_quadrant++;
    $first_row++;
    $first_column++;
    $last_row--;
    $last_column--;    
} while ($first_row < $last_row && $first_column < $last_column);

//print_r($quadrant); exit;
foreach($quadrant as $index => $row) {
    //size of array
    $array_size = count($row);
    $rotations_left = $rotations >= $array_size ? $rotations % $array_size : $rotations;   
    //rotate
    for($iterations = 0; $iterations < $rotations_left; $iterations++) {
        array_push($row, $row[0]);
        array_shift($row);
    }
    $quadrant[$index] = $row;
}
//print_r($quadrant); exit;
$first_row = 0;
$first_column = 0;
$last_row = $rows -1;
$last_column = $columns -1;
$length_quadrant = count($quadrant);
do {
    //pushing elements to row
    $index_quadrant = $first_row;
    $array_index = 0;
    // first row
    $i = $first_row;
    for($j = $first_column; $j < $last_column; $j++) {
       $matrix[$i][$j] =  $quadrant[$index_quadrant][$array_index];
       $array_index++;
    }
    // last column
    $j = $last_column;
    for($i = $first_row; $i < $last_row; $i++) {
        $matrix[$i][$j] =  $quadrant[$index_quadrant][$array_index];
        $array_index++;
    }
    // last row
    $i = $last_row;
    for($j = $last_column; $j > $first_column; $j--) {
        $matrix[$i][$j] =  $quadrant[$index_quadrant][$array_index];
        $array_index++;
    }
    // first column
    $j = $first_column;
    for($i = $last_row; $i > $first_row; $i--) {
        $matrix[$i][$j] =  $quadrant[$index_quadrant][$array_index];
        $array_index++;
    }
    $index_quadrant++;
    $first_row++;
    $first_column++;
    $last_row--;
    $last_column--;
    
} while ($index_quadrant < $length_quadrant);

foreach($matrix as $row) {
    print(implode(" ", $row)) . "\n";
}
?>