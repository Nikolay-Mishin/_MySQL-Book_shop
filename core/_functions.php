<?php
//require_once 'redirect.php';

function connect () {
    $db = mysqli_connect ('localhost', 'root', '', '_book_shop'); 
    mysqli_set_charset ($db, 'utf8');
    return $db; 
}

function close ($db) { mysqli_close ($db); }

function escape ($str, $db) {
    $str = htmlentities ($str); 
    $str = mysqli_real_escape_string ($db, $str); 
    return $str; 
}

function load ($page, $args = []) {
    extract ($args);
    view (HEAD, compact ('title')); 
    //view (BOOKS.name(), compact ('books'));
    view ($page, $args); // main
    if (key_exists ('redirect', $args)) redirect ($redirect);
    view (FOOT);
    return $args;
}

function view ($page, $data = []) {
    extract ($data);
    $page .= '.html';
    if (file_exists ($page)) require_once $page; 
}

function checkUserIsAuthorized () {
    $authorized = false;

    if (isset ($_COOKIE['u']) && isset ($_COOKIE['t']) && isset ($_COOKIE['PHPSESSID'])) {
        $user = $_COOKIE['u']; 
        $token = $_COOKIE['t'];
        $session = $_COOKIE['PHPSESSID'];

        $db = connect(); 
        $query = "SELECT
                `connect_id`, `connect_user_id`, `connect_token`, `connect_session`,
                UNIX_TIMESTAMP (`connect_token_time`) AS `time` 
            FROM `connects`
            WHERE `connect_user_id` = $user 
            AND `connect_token` = '$token'
            AND `connect_session` = '$session'
        ";
        $result = mysqli_query ($db, $query);

        if (mysqli_num_rows ($result)) {
            $connect_info = mysqli_fetch_assoc ($result); 
            $expiration_time = $connect_info['time']; 

            if ($expiration_time < time()) {
                $token = generateToken(); 
                $token_time = time() + 900; 
                $connect_id = $connect_info['connect_id']; 
                $query = "UPDATE `connects`
                    SET `connect_token` = '$token',
                        `connect_token_time` = FROM_UNIXTIME ($token_time)
                    WHERE `connect_id` = $connect_id;
                ";

                mysqli_query ($db, $query); 
                setcookie ('t', $token); 
            }
            $authorized = true; 
        } 
    }
    return $authorized; 
}

function generateToken ($size = 32) {
    $symbols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    $token = ""; 
    $length = count ($symbols) - 1; 
    for ($i = 0; $i < $size; $i++) $token .= $symbols[rand (0, $length)];
    return $token; 
}

function checkIfDefined ($user_id, $book_id) {
    if ($user_id && $book_id) { 
        $db = connect(); 
        $query = "SELECT * 
            FROM `marks`
            WHERE `mark_user_id` = $user_id
            AND `mark_book_id` = $book_id;
        ";
        $result = mysqli_query($db, $query); 
        if (mysqli_num_rows ($result)) return true; 
        else return false; 
    } 
    else return false; 
}

function del ($db, $login) {
    $query = "SELECT `user_id` 
        FROM `users` 
        WHERE `user_login` = '$login';
    ";
    $result = mysqli_query ($db, $query); 
    $user_id = mysqli_fetch_assoc ($result)['user_id']; 

    $query = "DELETE FROM `connects` 
        WHERE `connect_user_id` = '$user_id';
    ";
    $result = mysqli_query ($db, $query);

    $query = "DELETE FROM `users` 
        WHERE `user_login` = '$login';
    ";
    $result = mysqli_query ($db, $query); 
}

function validate ($db, $login, $password, $password2, $email, $errors = []) {
    if ($password == '' || $login == '' || $password2 == '') $errors[] = 'Не все данные заполнены'; 
    if ($password <> $password2) $errors[] = 'Пароли не совпадают'; 
    // del ($db, $login);
    $query = "SELECT `user_id` 
        FROM `users` 
        WHERE `user_login` = '$login';
    ";
    $result = mysqli_query ($db, $query); 
    if (mysqli_num_rows ($result)) $errors[] = 'Логин уже занят!'; 
    return $errors;
}

function reg ($db, $login, $password, $email) {
    $secured_password = md5 ($password); 

    $query = "INSERT INTO `users` 
        SET `user_id` = LAST_INSERT_ID(),
            `user_login` = '$login', 
            `user_password` = '$secured_password',
            `user_email` = '$email';
    ";
    $result = mysqli_query ($db, $query);
}

function auth ($db, $email, $password) {
    $secured_password = md5 ($password);
     
    $query = "SELECT `user_id` 
        FROM `users`
        WHERE `user_email` = '$email'
        AND `user_password` = $secured_password
    ";
    $query = "SELECT `user_id` 
        FROM `users`
        WHERE `user_email` = '$email'
    ";
    $result = mysqli_query ($db, $query); 
    if (mysqli_num_rows ($result)) {
        $user_id = mysqli_fetch_assoc ($result)['user_id']; 
        $token = generateToken(); 
        $token_time = time() + 900; 
        $session = $_COOKIE['PHPSESSID']; 
        setcookie ('u', $user_id);
        setcookie ('t', $token); 
        $query = "INSERT INTO `connects` 
            SET `connect_user_id` = $user_id, 
                `connect_token` = '$token', 
                `connect_token_time` = FROM_UNIXTIME ($token_time),
                `connect_session` = '$session';
        ";
        $query = "INSERT INTO `connects` 
                    (`connect_user_id`, `connect_token`, `connect_token_time`,        `connect_session`)
            VALUE   ($user_id,          '$token',        FROM_UNIXTIME ($token_time), '$session');
        "; 
        mysqli_query ($db, $query);
        $_SESSION['token'] = $token; 
        close ($db);
        redirect();
    } 
    else echo '<p> Неверная связка логин / пароль </p>'; 
}

function logout () {
    session_unset(); 
    setcookie ('u', $_COOKIE['u'], time() - 100);
    redirect();
}

function redirect ($t = 0, $url = null) {
    if (!$url) { $url = redirect_page(); }
    else { $url = $_COOKIE['r']; }
    Controller::_()->redirect_call ($t, $url);
}

function set_redirect () { if (empty ($_POST)) { setcookie ('r', redirect_page()); } }

function redirect_page () { return Controller::_()->_ref(); }

function redirect_out ($redirect, $url) {
    return "Через $redirect сек. Вы будете перенаправлены на страницу: " . pathinfo ($url)['basename'];
}

function mb_strcasecmp ($str_1, $str_2, $encoding = null) {
    if (null === $encoding) { $encoding = mb_internal_encoding(); }
    return strcmp (mb_strtolower ($str_1, $encoding), mb_strtolower ($str_2, $encoding));
}

function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };
function info ($path) { return pathinfo ($path); };
function name () { return info ($_SERVER ['PHP_SELF'])['filename']; };
function data_file () { return name().'.txt'; };

function _load ($data, $page, $args = [], $aside = 0) {
    if (info ($data)['filename'] == '_redirect') $data .= 'main';
    require_once "$data.php"; // Data
    $data = compact ($args);
    require_once C.'head.php'; // head
    require_once C.'header.php'; // header
    require_once C.'wrapper.php'; // wrapper
    if ($aside == 1) require_once C.'aside.php'; // aside
    view ($page, $data); // main
    if ($file_write) file_write ($data['filename'], $_POST);
    if (key_exists ('redirect', $data)) redirect ($redirect);
    require_once C.'footer.php'; // footer
    require_once C.'scriptside.php'; // scriptside
    return $data;
}
?>