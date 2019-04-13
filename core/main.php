<?php
require_once '_router.php'; // global Controller for URL pathes
require_once '_autoload.php'; // autoload Classes
require_once '_variables.php'; // global variables
require_once '_functions.php'; // global functions

test ('url => ' . Router::_()->get_url());
test ('url_parse => ' . Router::_()->url_parse());
Router::_()->test();
?>