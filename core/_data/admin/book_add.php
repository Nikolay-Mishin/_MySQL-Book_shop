<?php
$title = 'Добавить книгу';

set_redirect();

$db = connect();
$publishers = query_select ($db, 'publishers', '*');
$authors = query_select ($db, 'authors', '*', ['author_is_deleted' => 0]);

if (isset ($_POST['book_name'])) {
    $book_name = escape ($_POST['book_name'], $db);
    $books_price = escape ($_POST['book_price'], $db);
    $book_author = escape ($_POST['book_author'], $db);
    query_add ($db, 'books', ['book_name' => $book_name, 'book_price' => $books_price]);
    // query_add ($db, 'books_authors', ['book_author_book_id' => $book_id, 'book_author_author_id' => $book_author]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }
}
close ($db);
?>