<?php
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

function load ($page, $title, $args = []) {
    view (HEAD, compact ('title'));
    if (!is_array ($page)) { view ($page, $args); } // main
    else { foreach ($page as $key => $item) { view ($item, $args[$key]); } }
    if (key_exists ('redirect', $args)) redirect ($redirect);
    view (FOOT);
    return $args;
}

function view ($file, $data = []) {
    extract ($data);
    $file .= '.html';
    if (file_exists ($file)) require_once $file;
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
        if (query_select ($db, 'marks', '*', ['mark_user_id' => $user_id, 'mark_book_id' => $book_id])) { return true; }
        else { return false; }
    }
    else return false;
}

function del ($db, $login) {
    $user_id = query_select ($db, 'users', 'user_id', ['user_login' => $login])['user_id'];
    query_del ($db, 'connects', ['connect_user_id' => $user_id]);
    query_del ($db, 'users', ['user_login' => $login]);
}

function validate ($db, $login, $password, $password2, $email, $errors = []) {
    if ($password == '' || $login == '' || $password2 == '') $errors[] = 'Не все данные заполнены';
    if ($password <> $password2) $errors[] = 'Пароли не совпадают';
    if (query_select ($db, 'users', 'user_id', ['user_login' => $login])) { $errors[] = 'Логин уже занят!'; }
    return $errors;
}

function reg ($db, $login, $password, $email) {
    $secured_password = md5 ($password);
    query_add ($db, 'users', ['user_id' => 'LAST_INSERT_ID()', 'user_login' => $login, 'user_password' => $secured_password, 'user_email' => $email]);
}

function auth ($db, $email, $password) {
    $email = escape ($email, $db);
    $password = escape ($password, $db);
    $secured_password = md5 ($password); 
    
    if ($user_id = query_select ($db, 'users', 'user_id', ['user_email' => $email, 'user_password' => $secured_password])) {
        $user_id = $user_id['user_id'];
        $token = generateToken();
        $token_time = time() + 900;
        $session = $_COOKIE['PHPSESSID'];
        setcookie ('u', $user_id);
        setcookie ('t', $token);
        query_add ($db, 'connects', ['connect_user_id' => $user_id, 'connect_token' => $token, 'connect_token_time' => "FROM_UNIXTIME ($token_time)", 'connect_session' => $session]);
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

function query_select ($db, $table, $cols = [], $condition = []) {
    $condition = !empty ($condition) ? 'WHERE ' . query_from_array ($condition) : '';
    $query = "SELECT `$cols` FROM `$table` $condition;";
    if ($cols === '*') { $query = "SELECT * FROM `$table` $condition"; }
    $result = mysqli_query ($db, $query);
    if (mysqli_num_rows ($result)) {
        return $result->num_rows > 1 ? mysqli_fetch_all ($result, MYSQLI_ASSOC) : mysqli_fetch_assoc ($result);
    }
    else { return false; }
}

function query_add ($db, $table, $cols = []) {
    $cols = query_from_array ($cols, 'SET');
    $query = "INSERT INTO `$table` SET $cols";
    mysqli_query ($db, $query);
}

function query_edit ($db, $table, $cols = [], $condition = []) {
    $cols = query_from_array ($cols, 'SET');
    $condition = !empty ($condition) ? 'WHERE ' . query_from_array ($condition) : '';
    $query = "UPDATE `$table` SET $cols $condition";
    echo $query.'<br>';
    mysqli_query ($db, $query);
}

function query_del ($db, $table, $condition = []) {
    $condition = !empty ($condition) ? 'WHERE ' . query_from_array ($condition) : '';
    $query = "DELETE FROM `$table` $condition";
    mysqli_query ($db, $query);
}

function query_found_rows ($db, $offset, $count, $table, $condition = [], $filter = []) {
    if (!empty ($condition) && !empty ($filter)) {
        $condition = 'WHERE ' . query_from_array ($condition) . ' AND ' . query_from_array ($filter, 'LIKE');
    }
    else if (!empty ($condition)) { $condition = 'WHERE ' . query_from_array ($condition); }
    else if (!empty ($filter)) { $condition = 'WHERE ' . query_from_array ($filter, 'LIKE'); }
    else { $condition = ''; }
    $query = "SELECT SQL_CALC_FOUND_ROWS * FROM `$table` $condition LIMIT $offset, $count";
    echo $query.'<br>';
    $result = mysqli_query ($db, $query);
    return mysqli_fetch_all ($result, MYSQLI_ASSOC);
}

function query_get_rows ($db, $count) {
    $result = mysqli_query ($db, "SELECT FOUND_ROWS()");
    $num_rows = mysqli_fetch_row ($result)[0];
    return ceil ($num_rows / $count);
}

function query_from_array ($arr, $s = '=') {
    $query = '';
    $d = 'AND';
    foreach ($arr as $key => $val) {
        if ($s === 'SET') {
            $s = '=';
            $d = ', ';
        }
        $val = (int) $val ?: $val;
        if ($s === 'LIKE') { $val = "%$val%"; }
        if (gettype ($val) == 'string') { $val = "'$val'"; }
        $query .= "`$key` $s $val";
        if ($key !== array_key_last ($arr)) { $query .= " $d "; }
    }
    return $query;
}

function redirect ($t = 0, $url = null) {
    if (!$url) { $url = redirect_page(); }
    else { $url = $_COOKIE['r']; }
    Controller::_()->redirect_call ($t, $url);
}

function set_redirect () { if (empty ($_POST)) { setcookie ('r', redirect_page()); } }

function redirect_page () { return Controller::_()->_ref(); }

function redirect_out ($redirect, $url) {
    return "Через $redirect сек. Вы будете перенаправлены на страницу: " . info ($url)['basename'];
}

function mb_strcasecmp ($str_1, $str_2, $encoding = null) {
    if (null === $encoding) { $encoding = mb_internal_encoding(); }
    return strcmp (mb_strtolower ($str_1, $encoding), mb_strtolower ($str_2, $encoding));
}

function name () { return info ($_SERVER ['PHP_SELF'])['filename']; };

function info ($path) { return pathinfo ($path); };

function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };
?>