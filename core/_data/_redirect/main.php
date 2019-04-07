<?php
require_once _D.name().'.php'; // Data for Page in development
$redirect_title = 'Страница находится в разработке!';
$redirect = 3;
$url = redirect_page();
$out = redirect_out ($redirect, $url);
?>