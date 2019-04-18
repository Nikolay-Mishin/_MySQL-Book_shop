<?php
$title = 'Добавить книгу';

set_redirect();

$db = connect();
$publishers = query_select ($db, 'publishers', '*');
$authors = query_select ($db, 'authors', '*', ['author_is_deleted' => 0]);

if (isset ($_POST['book_name'])) {
    $book_name = escape ($_POST['book_name'], $db);
    $book_price = escape ($_POST['book_price'], $db);
    $book_publisher = escape ($_POST['book_publisher'], $db);
    $book_quantity = escape ($_POST['book_quantity'], $db);
    $book_author = escape ($_POST['book_author'], $db);
    query_add ($db, 'books', ['book_name' => $book_name, 'book_price' => $book_price, 'book_publisher_id' => $book_publisher, 'book_quantity' => $book_quantity]);
    $book_id = query_get_rows ($db, 'books')[0];
    query_add ($db, 'books_authors', ['book_author_book_id' => $book_id, 'book_author_author_id' => $book_author]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }
}
close ($db);
?>