<?php
require_once '../core/main.php';

$title = 'Авторы';

$count = $_GET['count'] ?? 2; 
$page = $_GET['page'] ?? 1; 
$filter = $_GET['filter'] ?? ''; 
$offset = $count * ($page - 1); 

$db = connect(); 
$query = 	"SELECT SQL_CALC_FOUND_ROWS * 
            FROM `authors` 
            WHERE `author_is_deleted` = 0
                AND `author_name` LIKE '%$filter%'
            LIMIT $offset, $count"; 
$result = mysqli_query ($db, $query); 
$authors = mysqli_fetch_all ($result, MYSQLI_ASSOC);
$result1 = mysqli_query ($db, "SELECT FOUND_ROWS()");
$num_rows = mysqli_fetch_row ($result1)[0];
$pages_count = ceil ($num_rows / $count);
close ($db); 

$url = "./authors.php?count=$count&"; 

$pages = [_AUTHORS.name(), PAGINAT];
$args = [compact ('authors', 'count', 'filter'), compact ('page', 'pages_count', 'url')];
load ($pages, $title, $args);
?>