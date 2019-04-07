<?php
require_once '_variables.php'; // global variables
spl_autoload_register (function ($class) {
    $class = _C."$class.php";
    require_once $class;
});
require_once '_functions.php'; // global functions
?>