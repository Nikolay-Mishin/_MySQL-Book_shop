<?php
$js_libs = ['jquery/jquery-3.3.1', 'bootstrap/js/bootstrap'];
$review = mb_strcasecmp ($title, 'Отзыв') == 0 ? 'review' : '';
$js = ['script', $review];
?>