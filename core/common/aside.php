<?php
require_once 'core/main.php'; // global functions
require_once _DC.ASIDE.'.php'; // Data
view (NEWS.ASIDE, compact ('news', 'category', 'parts'));
?>