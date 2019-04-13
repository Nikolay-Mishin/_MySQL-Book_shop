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

function _load ($page, $title, $args = []) {
    view (HEAD, compact ('title'));
    if (!is_array ($page)) { view ($page, $args); } // main
    else { foreach ($page as $key => $item) { view ($item, $args[$key]); } }
    if (key_exists ('redirect', $args)) redirect ($redirect);
    view (FOOT);
    return $args;
}

function load ($data, $page, $args = []) {
    if (!is_array ($page)) {
        $data = load_data ($data, $args);
        $title = $data['title'] ?? '';
        require_once C.'head.php'; // head
        $data = load_content ($data, $page, $args);
    }
    else {
        $datas = [];
        foreach ($page as $key => $item) {
            $datas[$key] = isset ($data[$key]) ? load_data ($data[$key], $args[$key]) : load_data ($data[array_key_last ($data)], $args[$key]);
        }
        // test ($datas);
        $title = $datas[0]['title'] ?? '';
        require_once C.'head.php'; // head
        foreach ($datas as $key => $item) { load_content ($item, $page[$key], $args[$key]); }
    }
    require_once C.'footer.php'; // footer
    return $data;
}

function load_data ($data, $args) {
    // if (info ($data)['filename'] == '_redirect') $data .= 'main';
    require "$data.php"; // Data
    if (isset ($title)) { $args[] = 'title'; }
    // test ($args);
    $data = compact ($args);
    return $data;
}

function load_content ($data, $page, $args) {
    view ($page, $data); // main
    // if (key_exists ('redirect', $data)) redirect ($data['redirect']);
    return $data;
}

function view ($file, $data = []) {
    if (!empty ($data)) extract ($data);
    // if (is_dir ($file) && (info ($file)['dirname'] == 'templates' || info ($file)['dirname'] == '.')) $file .= 'main';
    $file .= '.html';
    if (file_exists ($file)) require_once $file;
    return $data;
}

function checkIfDefined ($user_id, $book_id) {
    if ($user_id && $book_id) {
        $db = connect();
        if (query_select ($db, 'marks', '*', ['mark_user_id' => $user_id, 'mark_book_id' => $book_id])) { return true; }
        else { return false; }
    }
    else return false;
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
        close ($db);
        $_SESSION['token'] = $token;
        redirect(3);
    } 
    else echo '<p> Неверная связка логин / пароль </p>';
}

function generateToken ($size = 32) {
    $symbols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    $token = "";
    $length = count ($symbols) - 1;
    for ($i = 0; $i < $size; $i++) $token .= $symbols[rand (0, $length)];
    return $token;
}

function logout ($db) {
    session_unset();
    // Удаляем все переменные сессии.
    $_SESSION = array();
    // Если требуется уничтожить сессию, также необходимо удалить сессионные cookie.
    // Замечание: Это уничтожит сессию, а не только данные сессии!
    if (ini_get ("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie (session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Наконец, уничтожаем сессию.
    // session_destroy();

    query_del ($db, 'connects', ['connect_user_id' => $_COOKIE['u']]);
    setcookie ('u', $_COOKIE['u'], time() - 42000);
    setcookie ('t', $_COOKIE['t'], time() - 42000);
    setcookie ('PHPSESSID', $_COOKIE['PHPSESSID'], time() - 42000);
    redirect();
}

function checkUserIsAuthorized () {
    $authorized = false;

    if (isset ($_COOKIE['u']) && isset ($_COOKIE['t']) && isset ($_COOKIE['PHPSESSID'])) {
        $user = $_COOKIE['u'];
        $token = $_COOKIE['t'];
        $session = $_COOKIE['PHPSESSID'];

        $db = connect();
        $result = query_select ($db, 'connects',
            ['connect_id', 'connect_user_id', 'connect_token', 'connect_session', 'UNIX_TIMESTAMP(connect_token_time) AS time'], 
            ['connect_user_id' => $user, 'connect_token' => $token, 'connect_session' => $session]
        );

        if ($connect_info = $result) {
            $expiration_time = $connect_info['time'];

            if ($expiration_time < time()) {
                $token = generateToken();
                $token_time = time() + 900;
                $connect_id = $connect_info['connect_id'];
                query_edit ($db, 'connects',
                    ['connect_token' => $token, 'connect_token_time' => "FROM_UNIXTIME($token_time)"],
                    ['connect_id' => $connect_id]
                );
                mysqli_query ($db, $query);
                setcookie ('t', $token);
            }
            $authorized = true;
        }
    }
    return $authorized;
}

function query_build ($db, $table, $cols = '*', $join = null, $condition = null, $filter = null, $group_by = null, $offset = null, $count = null) {
    $cols = !is_array ($cols) ? preg_match ('/\*/', $cols) ? $cols : "`$cols`" : query_from_array ($cols, 'cols');
    
    if ($condition && $filter) {
        $condition = 'WHERE ' . query_from_array ($condition) . ' AND ' . query_from_array ($filter, 'LIKE');
    }
    else if ($condition) { $condition = 'WHERE ' . query_from_array ($condition); }
    else if ($filter) { $condition = 'WHERE ' . query_from_array ($filter, 'LIKE'); }
    else { $condition = ''; }

    $limit = $offset !== null && $count ? "LIMIT $offset, $count" : '';

    $join = $join ?? '';
    $join = !is_array ($join) ? $join : query_from_array ($join, 'JOIN');

    $group_by = $group_by ? "GROUP BY `$group_by`" : '';

    $query = "SELECT $cols FROM `$table` $join $condition $group_by $limit;";
    if ($cols === '*') { $query = "SELECT * FROM `$table` $join $condition $group_by $limit;"; }
    // echo $query.'<br>';

    $result = mysqli_query ($db, $query);
    if (mysqli_num_rows ($result)) {
        if ($offset !== null) return mysqli_fetch_all ($result, MYSQLI_ASSOC);
        return $result->num_rows > 1 ? mysqli_fetch_all ($result, MYSQLI_ASSOC) : mysqli_fetch_assoc ($result);
    }
    else { return false; }
}

function query_join ($db, $table, $cols = '*', $join = null, $condition = null, $filter = null, $group_by = null, $offset = null, $count = null) {
    return query_build ($db, $table, $cols, $join, $condition, $filter, $group_by, $offset, $count);
}

function query_select ($db, $table, $cols = '*', $condition = null) {
    return query_build ($db, $table, $cols, null, $condition);
}

function query_found_rows ($db, $table, $condition = null, $filter = null, $offset, $count = 1) {
    return query_build ($db, $table, 'SQL_CALC_FOUND_ROWS *', null, $condition, $filter, null, $offset, $count);
}

function query_get_rows ($db, $count) {
    $result = mysqli_query ($db, "SELECT FOUND_ROWS()");
    $num_rows = mysqli_fetch_row ($result)[0];
    return ceil ($num_rows / $count);
}

function query_add ($db, $table, $cols) {
    $cols = !is_array ($cols) ? "`$cols`" : query_from_array ($cols, 'SET');
    $query = "INSERT INTO `$table` SET $cols";
    // echo $query.'<br>';
    mysqli_query ($db, $query);
}

function query_edit ($db, $table, $cols, $condition = null) {
    $cols = !is_array ($cols) ? "`$cols`" : query_from_array ($cols, 'SET');
    $condition =  $condition ? 'WHERE ' . query_from_array ($condition) : '';
    $query = "UPDATE `$table` SET $cols $condition";
    // echo $query.'<br>';
    mysqli_query ($db, $query);
}

function query_del ($db, $table, $condition = null) {
    $condition = $condition ? 'WHERE ' . query_from_array ($condition) : '';
    $query = "DELETE FROM `$table` $condition";
    // echo $auery.'<br>';
    mysqli_query ($db, $query);
}

function query_from_array ($arr, $s = '=') {
    $query = '';
    $d = ' AND ';
    foreach ($arr as $key => $val) {
        if ($s === 'SET') { $s = '='; $d = ', '; }
        if (!is_array ($val)) { $val = (int) $val ?: $val; }
        if ($s === 'LIKE') { $val = "%$val%"; }

        if ($s === 'cols') { $query .= query_parse ($val, $s); $d = ', '; }
        else if ($s === 'JOIN') {
            $val1 = $val[0];
            $val2 = $val[1];
            $query .= "LEFT JOIN `$key` ON `$val1` = `$val2`";
            $d = ' ';
        }
        else {
            $val = query_parse ($val, $s);
            if (gettype ($val) == 'string' && !preg_match ('/(.*)\((.+)\)/', $val)) { $val = "'$val'"; }
            $query .= "`$key` $s $val";
        }

        if ($key !== array_key_last ($arr)) { $query .= "$d"; }
    }
    // echo $query . '<br>';
    return $query;
}

function query_parse ($val, $s = null) {
    if (preg_match ('/AS/', $val)) {
        $val = preg_split ('/\sAS\s/', $val);
        $val1 = query_preg ($val[0]);
        $val2 = $val[1];
        $val = $val1 . ' AS ' . "`$val2`";
    }
    else if (preg_match ('/(.*)\((.+)\)/', $val, $preg)) { $val = query_preg ($val); }
    else { $val = $s === '=' || $s === 'LIKE' || $s !== 'cols' ? $val : "`$val`"; }
    return $val;
}

function query_preg ($val) {
    preg_match ('/(.*)\((.+)\)/', $val, $preg);
    $val0 = !$preg ?: $preg[1];
    $val = !$preg ? $val : $preg[2];
    $val = (int) $val ? $val : "`$val`";
    $val = !$preg ? $val : "$val0($val)";
    return $val;
}

function redirect ($t = 0, $url = null) { Controller::_()->redirect_call ($t, $url); }

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