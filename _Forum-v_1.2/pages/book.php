<?php
require_once '../core/main.php';
$data = [D.name()];
$pages = [BOOKS.name(), MARK];
$args = [['book'], ['mark', 'check_if_defined']];
load ($data, $pages, $args);
?>