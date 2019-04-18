<?php
require_once '../../core/main.php';
$data = [DA.name()];
$pages = [_AUTHORS.name(), PAGINAT];
$args = [['authors', 'count', 'filter', 'url'], ['page', 'pages_count', 'url']];
load ($data, $pages, $args);
?>