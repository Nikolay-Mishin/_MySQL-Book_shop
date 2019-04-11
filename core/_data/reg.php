<?php
$title = 'Регистрация'; 

set_redirect();

if (isset ($_POST['login']) && isset ($_POST['password']) && isset ($_POST['password_dub']) && isset ($_POST['email'])) {
    $login = $_POST['login']; 
    $password = $_POST['password']; 
    $password2 = $_POST['password_dub']; 
    $email = $_POST['email']; 

    $db = connect();
    $errors = validate ($db, $login, $password, $password2, $email);
    if (empty ($errors)) { 
        reg ($db, $login, $password, $email);
        auth ($db, $email, $password);
    } 
    else {
        load (REG, $title, compact ('errors'));
        exit;
    }
}
?>