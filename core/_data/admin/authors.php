<?php
$title = 'Авторы';

$count = $_GET['count'] ?? 2;
$page = $_GET['page'] ?? 1;
$filter = $_GET['filter'] ?? '';
$offset = $count * ($page - 1);

$db = connect();
$authors = query_found_rows ($db, 'authors', ['author_is_deleted' => 0], ['author_name' => "$filter"], $offset, $count);
$pages_count = query_get_rows ($db, $count);
close ($db);

$url = "./".name().".php?count=$count&";
?>