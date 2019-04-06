<?php
$review = mb_strcasecmp ($title, 'Отзыв') == 0 ? 'review' : '';
$js = ['main', $review];
?>