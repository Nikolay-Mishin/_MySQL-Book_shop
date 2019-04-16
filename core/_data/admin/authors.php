<?php
$title = 'Авторы';

$count = $_GET['count'] ?? 2;
$page = $_GET['page'] ?? 1;
$filter = $_GET['filter'] ?? '';
$offset = $count * ($page - 1);

$db = connect();
$get_rows = query_get_rows ($db, 'authors', ['author_is_deleted' => 0], ['author_name' => "$filter"], $offset, $count);
$authors = $get_rows[1];
$pages_count = $get_rows[0];
close ($db);

$url = "./".name().".php?count=$count&";


?>