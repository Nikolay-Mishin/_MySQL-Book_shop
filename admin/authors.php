<?php
	include_once('functions.php'); 
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
	echo $query; 
	$result = mysqli_query($db, $query); 
	$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$result1 = mysqli_query($db, "SELECT FOUND_ROWS()");
	$num_rows = mysqli_fetch_row($result1)[0];
	$pages_count = ceil($num_rows / $count);
	//var_dump($num_rows); 
	//print_r($authors); 
	$url = "./authors.php?count=$count&"; 
	$title = 'Авторы'; 
	mysqli_close($db); 
	view('../templates/common/head.html', compact('title')); 
	view('../templates/authors/authors.html', compact('authors', 'count', 'filter')); 
	view('../templates/common/pagination.html', compact('page', 'pages_count', 'url'));
	view('../templates/common/footer.html'); 
?>