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

view (COMN.HEAD, compact ('title')); 
view (COMN.AUTH); 
view (COMN.FOOT);
?>