<?php
include_once("start.php");
define('PAGINATION', 10);
//session_destroy ();
$categories = getCategories();

$items = getItems();

$pages = getItemsPages();

function getCategories () {
	$query = 
	"SELECT * 
	FROM categoria";

	$result = mysql_query($query);
	//print_r($result);
	$categories = array();
	while ($row = mysql_fetch_array($result)) {
		$categories[] = $row;
	}
	//print_r($result);
	//var_dump($categories);
	mysql_free_result($result);
	
	return $categories;
}

function getItemsQueryString() {
	$id_category = '';
	$category = '';
	if(isset($_GET['id_category'])) {
		$category = 'AND id_categoria =  '. $_GET['id_category'];
		$id_category = $_GET['id_category'];
	}

	if(empty($id_category)) {
		return '';
	}

	$order_by = '';
	if (isset($_GET['titulo'])) {
		$order_by = ' order by titulo ' . $_GET['titulo'];
	}
	if (isset($_GET['createdon'])) {
		$order_by = ' order by createdon ' . $_GET['createdon'];
	}
	if (isset($_GET['random'])) {
		$order_by = ' order by RAND()';
	}
	$search = '';
	if (isset($_GET['search'])) {
		$search = ' and ( titulo like "%' . $_GET['search'] . '%" or texto like "%' . $_GET['search'] . '%" ) ' ;
	}

	return $category .  $search . $order_by;
}
	
function getItems () {	
	$page = ' LIMIT 0,' . PAGINATION;
	if (isset($_GET['page'])) {
		$page = ' LIMIT ' . (($_GET['page'] - 1) * PAGINATION )  . ', '. PAGINATION;
	}

	$query = 
	"SELECT * 
	FROM item 
	WHERE 1=1 " . getItemsQueryString() . $page ;

	//exit($query);
	
	$result = mysql_query($query);
	$items = array();
	while ($row = mysql_fetch_array($result)) {
		$items[] = $row;
	}
	//var_dump($items);
	mysql_free_result($result);
	
	return $items;
}

function getItemsPages () {	
	
	$query = 
	"SELECT count(1) 
	FROM item 
	WHERE 1=1 " . getItemsQueryString();

	//exit($query);
	
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);	
	mysql_free_result($result);

	$pages = ceil($row[0] / PAGINATION);
	//echo($pages); exit;
	
	return $pages;
}

function highlightStr($haystack, $needle, $highlightClass) {
	// return $haystack if there is no highlight color or strings given, nothing to do.
    if (strlen($highlightClass) < 1 || strlen($haystack) < 1 || strlen($needle) < 1) {
        return $haystack;
    }
    return preg_replace("/($needle+)/i", '<span class='.$highlightClass.'>${1}</span>', $haystack);
}

function queryStringAdd($param, $value) {
	parse_str($_SERVER['QUERY_STRING'], $query_string);	
	$query_string[$param] = $value;
	$query_string = http_build_query($query_string);
	//print_r($query_string); exit;
	return $query_string;
}
include_once("browse_template.php");
?>

