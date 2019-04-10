<?php
require_once '../core/main.php';

$title = 'Книги';

$count = $_GET['count'] ?? 2; 
$page = $_GET['page'] ?? 1; 
$filter = $_GET['filter'] ?? ''; 
$offset = $count * ($page - 1); 

$db = connect(); 
$query = "SELECT `book_id` AS `id`, 
                    `book_name`, 
                    `book_price`, 
                    `publisher_name`, 
                    `book_quantity`, 
                    GROUP_CONCAT(`author_name`) AS `author`
            FROM `books`
            LEFT JOIN `publishers` ON `book_publisher_id` = `publisher_id`
            LEFT JOIN `books_authors` ON `book_author_book_id` = `book_id`
            LEFT JOIN `authors` ON `author_id` = `book_author_author_id`
            WHERE `book_is_deleted` = 0
                AND `book_name` LIKE '%$filter%'
            GROUP BY `book_id`
            LIMIT $offset, $count
            "; 
$result = mysqli_query ($db, $query);
$books = mysqli_fetch_all ($result, MYSQLI_ASSOC);

query_found_rows ($db, $offset, $count, 'books', ['book_is_deleted' => 0], ['book_name' => "$filter"]);
$pages_count = query_get_rows ($db, $count);
close ($db); 

$url = "./books.php?count=$count&"; 

$pages = [_BOOKS.name(), PAGINAT];
$args = [compact ('books', 'count', 'filter', 'url'), compact ('page', 'pages_count', 'url')];
load ($pages, $title, $args);
?>