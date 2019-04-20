<?php
$title = 'Регистрация'; 

set_redirect();

$errors = [];
if (isset ($_POST['login']) && isset ($_POST['password']) && isset ($_POST['password_dub']) && isset ($_POST['email'])) {
    test ($_POST);
    $login = $_POST['login']; 
    $password = $_POST['password']; 
    $password2 = $_POST['password_dub']; 
    $email = $_POST['email']; 

    $db = connect();
    $errors = validate ($db, $login, $password, $password2, $email);
    test ($errors);
    if (empty ($errors)) { 
        reg ($db, $login, $password, $email);
        auth ($db, $email, $password);
    } 
    else {
        test (mysqli_error_list($db));
        //exit;
    }
}
?>