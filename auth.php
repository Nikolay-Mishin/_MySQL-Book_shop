<?php
require_once 'core/main.php';

session_start(); 
set_redirect();

if (isset ($_POST['email']) && isset ($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db = connect();
    auth ($db, $email, $password);
    close ($db);
}

$title = 'Авторизация'; 

view ('templates/common/head', compact ('title')); 
view ('templates/common/auth'); 
view ('templates/common/footer');
?>