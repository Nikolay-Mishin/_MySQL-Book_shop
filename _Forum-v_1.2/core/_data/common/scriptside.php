<?php
$js_libs = [
    'jquery/jquery-3.3.1',
    'js/bootstrap.bundle.min',
    'bootstrap-4.3.1-dist/js/bootstrap.min',
    'js/offcanvas'
];
$review = mb_strcasecmp ($title, 'Отзыв') == 0 ? 'review' : '';
$js = [
    // 'script', 
    $review
];
?>