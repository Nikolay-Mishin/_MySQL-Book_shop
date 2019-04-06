<?php
require_once 'core/main.php';

session_start(); 
set_redirect();

if (isset ($_POST['email'])) { auth(); }

$title = 'Авторизация'; 

view ('templates/common/head', compact ('title')); 
view ('templates/common/auth'); 
view ('templates/common/footer');
?>