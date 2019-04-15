<?php
set_redirect();

$db = connect();
if (isset ($_GET['id'])) {
    $book_id = $_GET['id'];
    query_edit ($db, 'books', ['book_is_deleted' => 1], ['book_id' => $book_id]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }
}
close ($db);
?>