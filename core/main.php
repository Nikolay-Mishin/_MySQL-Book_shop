<?php
require_once '_router.php'; // global Controller for URL pathes
require_once '_autoload.php'; // autoload Classes
require_once '_data_cookies.php'; // global variables
require_once '_variables.php'; // global variables
require_once '_functions.php'; // global functions
start_session();
$router = Router::_();
$test = false;
?>