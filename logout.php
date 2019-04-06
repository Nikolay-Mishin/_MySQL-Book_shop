<?php
require_once 'core/main.php';

session_unset(); 
setcookie ('u', $_COOKIE['u'], time() - 100);
redirect();
?>