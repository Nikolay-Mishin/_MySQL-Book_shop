<?php
require_once '../core/main.php';

$obj = Router::_();
$obj->url_locked (false, true, true);

$data = [DA.name()];
$pages = [_AUTHORS.name(), PAGINAT];
$args = [['authors', 'count', 'filter', 'url'], ['page', 'pages_count', 'url']];
load ($data, $pages, $args);
?>