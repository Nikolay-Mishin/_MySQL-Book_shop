<?php
require_once '../core/main.php';

$title = 'Редактировать книгу';

set_redirect();

$db = connect();
if (isset ($_GET['id'])) {
    $book_id = $_GET['id'];
    $book = query_select ($db, 'books', '*', ['book_id' => $book_id]);
    // обработка если значение id нет в таблице
}

if (isset ($_POST['book_name'])) {
    $book_name = escape ($_POST['book_name'], $db);
    query_edit ($db, 'books', ['book_name' => $book_name], ['book_id' => $book_id]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }
}
close ($db);

load (_BOOKS.name(), $title, compact ('book'));
?>
