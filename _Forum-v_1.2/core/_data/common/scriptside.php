<?php
$review = mb_strcasecmp ($title, 'Отзыв') == 0 ? 'review' : '';
$js_libs = ['jquery_3.3.1/jquery.min'];
$js = ['main', $review];
?>