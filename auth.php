<?php
	include_once('functions.php');
	session_start(); 
    set_redirect();
	if (isset($_POST['email'])) {
		$db = connect(); 
		$email = $_POST['email'];
		$password = $_POST['password'];
		$query = "SELECT `user_id` 
				  FROM `users`
				  WHERE `user_email` = '$email'
				  AND `user_password` = $password"; 
		$result = mysqli_query($db, $query); 
		if (mysqli_num_rows($result)) {
			$user_id = mysqli_fetch_assoc($result)['user_id']; 
			$token = generateToken(); 
			$token_time = time() + 900; 
			$session = $_COOKIE['PHPSESSID']; 
			setcookie('u', $user_id);
			setcookie('t', $token); 
			$query = "INSERT INTO `connects`(`connect_user_id`, `connect_token`, `connect_token_time`, `connect_session`)
					  VALUE ($user_id, '$token', FROM_UNIXTIME($token_time), '$session');"; 
			mysqli_query($db, $query); 
			//header('Location: books.php');
            redirect (0, true);
		} 
        else echo '<p> Неверная связка логин / пароль </p>'; 
	}
	$title = 'Авторизация'; 
	view('templates/common/head.html', compact('title')); 
	view('templates/common/auth.html'); 
	view('templates/common/footer.html');
?>