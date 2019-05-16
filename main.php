<?php
// FRONT CONTROLLER

// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

// session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));

require_once 'core/main.php';
load (D.name(), MAIN, ['books']);
?>