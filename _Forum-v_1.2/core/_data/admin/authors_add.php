<?php
$title = 'Добавить автора';

set_redirect();

if (isset ($_POST['author_name'])) {
    $db = connect(); 
    $author_name = escape ($_POST['author_name'], $db);
    query_add ($db, 'authors', ['author_name' => $author_name]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }
    close ($db);
}
?>