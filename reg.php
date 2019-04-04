<?php
	include_once('functions.php');
    //include_once('form-validate.php');

    /* if (in_array (false, $validate)) $validate[] = 'error';
    if (in_array ('error', $validate)) print_r ($validate);
    print_r ($validate); */

    function del ($db, $login) {
        $query = "SELECT `user_id` 
                  FROM `users` 
                  WHERE `user_login` = '$login'; ";
        $result = mysqli_query($db, $query); 
        $user_id = mysqli_fetch_assoc($result)['user_id']; 

        $query = "DELETE FROM `connects` 
                  WHERE `connect_user_id` = '$user_id'; ";
        $result = mysqli_query($db, $query);

        $query = "DELETE FROM `users` 
                  WHERE `user_login` = '$login'; ";
        $result = mysqli_query($db, $query); 
    }

    function validate ($db, $login, $password, $password2, $email, $errors = []) {
        if ($password == '' || $login == '' || $password2 == '') $errors[] = 'Не все данные заполнены'; 
        if ($password <> $password2) $errors[] = 'Пароли не совпадают'; 
        //del ($db, $login);
        $query = "SELECT `user_id` 
                  FROM `users` 
                  WHERE `user_login` = '$login'; ";
        $result = mysqli_query($db, $query); 
        if (mysqli_num_rows($result)) $errors[] = 'Логин уже занят!'; 
        print_r (mysqli_fetch_assoc($result));
        print_r ($errors);
        echo '<br>';
        return $errors;
    }

    function reg ($db, $login, $password, $email) {
        $secured_password = md5($password); 
        $query = "INSERT INTO `users` 
                  SET `user_id` = LAST_INSERT_ID(),
                      `user_login` = '$login', 
                      `user_password` = '$secured_password',
                      `user_email` = '$email'; ";
        $result = mysqli_query($db, $query); 
        return $result;
    }

    function auth ($db, $login) {
        $query = "SELECT `user_id` 
                  FROM `users` 
                  WHERE `user_login` = '$login'; ";
        $result = mysqli_query($db, $query); 
        $user_id = mysqli_fetch_assoc($result)['user_id']; 
        $token = generateToken(); 
        $token_time = time() + 900; 
        $session = $_COOKIE['PHPSESSID']; 
        setcookie('u', $user_id);
        setcookie('t', $token); 
        $query = "INSERT INTO `connects` 
                  SET `connect_user_id` = $user_id, 
                      `connect_token` = '$token', 
                      `connect_token_time` = FROM_UNIXTIME($token_time),
                      `connect_session` = '$session'; ";
        mysqli_query($db, $query); 
        $_SESSION['token'] = $token; 
        return $result;
    }

    session_start(); 
    set_redirect();

    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_dub']) && isset($_POST['email'])) {
        $login = $_POST['login']; 
        $password = $_POST['password']; 
        $password2 = $_POST['password_dub']; 
        $email = $_POST['email']; 

        $db = connect(); 
        $errors = validate ($db, $login, $password, $password2, $email);
        if (empty($errors)) { 
            reg ($db, $login, $password, $email);
            auth ($db, $login);
            //header('Location: authors.php');
            redirect (0, true);
        } 
        else {
            $title = 'Регистрация'; 
            view('templates/common/head.html', compact('title')); 
            view('templates/common/reg.html', array('errors' => $errors)); 
            view('templates/common/footer.html');
        }
    }

    $title = 'Регистрация'; 
	view('templates/common/head.html', compact('title')); 
	view('templates/common/reg.html'); 
	view('templates/common/footer.html');
?>