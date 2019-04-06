<?php
$title = 'Отзыв';

$review_title = 'Форма отзыва';
$filename = _D.'reviews.txt';
$set_redirect = true;

require_once _DR.'main.php'; // Data: Redirect
$redirect_title = 'Отзыв успешно отправлен!';
$url = $_COOKIE['r'];
$out = redirect_out ($redirect, $url);
?>