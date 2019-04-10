<?php
require_once '../core/main.php';

$title = 'Авторы';

$count = $_GET['count'] ?? 2;
$page = $_GET['page'] ?? 1;
$filter = $_GET['filter'] ?? '';
$offset = $count * ($page - 1);

$db = connect();
$authors = query_found_rows ($db, $offset, $count, 'authors', ['author_is_deleted' => 0], ['author_name' => "$filter"]);
$pages_count = query_get_rows ($db, $count);
close ($db);

$url = "./authors.php?count=$count&";

$pages = [_AUTHORS.name(), PAGINAT];
$args = [compact ('authors', 'count', 'filter', 'url'), compact ('page', 'pages_count', 'url')];
load ($pages, $title, $args);
?>