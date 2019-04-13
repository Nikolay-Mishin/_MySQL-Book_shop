<?php
require_once '../core/main.php';
$data = [DA.name()];
$pages = [_BOOKS.name(), PAGINAT];
$args = [['books', 'count', 'filter', 'url'], ['page', 'pages_count', 'url']];
load ($data, $pages, $args);
?>