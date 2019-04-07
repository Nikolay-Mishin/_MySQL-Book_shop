<?php
require_once '../core/main.php';

$title = 'Авторизация';

session_start(); 
set_redirect();

if (isset ($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = connect(); 
    $query = "SELECT `user_id` 
                FROM `users`
                WHERE `user_email` = '$email'
                AND `user_password` = $password"; 
    $result = mysqli_query ($db, $query); 
    if (mysqli_num_rows ($result)) {
        $user_id = mysqli_fetch_assoc ($result)['user_id']; 
        $token = generateToken(); 
        $token_time = time() + 900; 
        $session = $_COOKIE['PHPSESSID']; 
        setcookie ('u', $user_id);
        setcookie ('t', $token); 
        $query = "INSERT INTO `connects`(`connect_user_id`, `connect_token`, `connect_token_time`, `connect_session`)
                    VALUE ($user_id, '$token', FROM_UNIXTIME($token_time), '$session');"; 
        mysqli_query ($db, $query); 
        redirect();
    }
    else echo '<p> Неверная связка логин / пароль </p>';
}
 
load (AUTH, $title);
?>