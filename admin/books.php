<?php
require_once '../core/main.php';
// session_start();
Router::_()->test();
$obj = Router::_();
$obj->url_locked (true, true, true);

$data = [DA.name()];
$pages = [_BOOKS.name(), PAGINAT];
$args = [['books', 'count', 'filter', 'url'], ['page', 'pages_count', 'url']];
load ($data, $pages, $args);
?>