<?php
require_once 'core/main.php';
session_start();
set_redirect();

if (isset ($_POST['email']) && isset ($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //session_start();
    $db = connect();
    auth ($db, $email, $password);
}

$title = 'Авторизация'; 

view (HEAD, compact ('title')); 
view (AUTH);
view (FOOT);
?>