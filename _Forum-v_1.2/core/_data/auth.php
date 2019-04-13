<?php
$title = 'Авторизация'; 

set_redirect();

if (isset ($_POST['email']) && isset ($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = connect();
    auth ($db, $email, $password);
}
?>