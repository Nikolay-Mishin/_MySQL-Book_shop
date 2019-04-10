<?php
require_once '../core/main.php';

$title = 'Редактировать автора';

set_redirect();

$db = connect();
if (isset ($_GET['id'])) {
    $author_id = $_GET['id'];
    $author = query_select ($db, 'authors', '*', ['author_id' => $author_id]);
    // обработка если значение id нет в таблице
}

if (isset ($_POST['author_name'])) {
    $author_name = escape ($_POST['author_name'], $db);
    query_edit ($db, 'authors', ['author_name' => $author_name], ['author_id' => $author_id]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }
}
close ($db);

load (_AUTHORS.name(), $title, compact ('author'));
?>