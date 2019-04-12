<?php
require_once '../core/main.php';
// session_start();
// if (checkUserIsAuthorized()) { session_start(); }
/* test ($_SESSION);
test ($_COOKIE); */
Router::_()->url_is_locked();
Router::_()->user_is_authorized();

$data = [DA.name()];
$pages = [_BOOKS.name(), PAGINAT];
$args = [['books', 'count', 'filter', 'url'], ['page', 'pages_count', 'url']];
load ($data, $pages, $args);
?>