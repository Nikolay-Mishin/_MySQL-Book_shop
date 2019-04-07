<?php
require_once 'core/main.php';

// require_once ('form-validate.php');

/* if (in_array (false, $validate)) $validate[] = 'error';
if (in_array ('error', $validate)) print_r ($validate);
print_r ($validate); */

session_start(); 
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
        $title = 'Регистрация'; 

        view (HEAD, compact ('title')); 
        view (REG, array ('errors' => $errors)); 
        view (FOOT);
    }
}

$title = 'Регистрация'; 

view (HEAD, compact ('title')); 
view (REG); 
view (FOOT);
?>