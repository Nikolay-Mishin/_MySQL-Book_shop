<?php
$title = 'Книги';

$db = connect();
$books = query_join ($db, 'books',
    [
        'book_id AS id', 'book_name', 'book_price', 'publisher_name', 'book_quantity', 'book_average_mark AS mark', 
        'GROUP_CONCAT(author_name) AS author_names'
    ],
    [
        'publishers' => ['book_publisher_id', 'publisher_id'],
        'books_authors' => ['book_author_book_id', 'book_id'],
        'authors' => ['author_id', 'book_author_author_id']
    ],
    null,
    null,
    'book_id'
);
close ($db);
?>