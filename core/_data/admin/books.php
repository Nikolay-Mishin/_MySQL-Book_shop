<?php
$title = 'Книги';

$count = $_GET['count'] ?? 2; 
$page = $_GET['page'] ?? 1; 
$filter = $_GET['filter'] ?? ''; 
$offset = $count * ($page - 1); 

$db = connect(); 
$books = query_select ($db, 'books', 
    ['book_id AS id', 'book_name', 'book_price', 'publisher_name', 'book_quantity', 'GROUP_CONCAT(author_name) AS author'],
    ['book_is_deleted' => 0],
    ['book_name' => $filter],
    $offset,
    $count, 
    [
        'publishers' => ['book_publisher_id', 'publisher_id'],
        'books_authors' => ['book_author_book_id', 'book_id'],
        'authors' => ['author_id', 'book_author_author_id']
    ],
    'book_id'
);

query_found_rows ($db, 'books', ['book_is_deleted' => 0], ['book_name' => "$filter"], $offset, $count);
$pages_count = query_get_rows ($db, $count);
close ($db); 

$url = "./books.php?count=$count&"; 
?>