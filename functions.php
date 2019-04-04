<?php
    include_once 'redirect.php';
    
	function connect() {
		$db = mysqli_connect('localhost', 'root', '', '_book_shop'); 
		mysqli_set_charset($db, 'utf8');
		return $db; 
	}

	function escape($str, $db) {
		$str = htmlentities($str); 
		$str = mysqli_real_escape_string($db, $str); 
		return $str; 
	}
	
	function view($html, $data = []) {
		extract($data); 
		include_once($html); 
	}
	
	function checkUserIsAuthorized() {
		$authorized = false; 
		if (isset($_COOKIE['u']) && isset($_COOKIE['t']) && isset($_COOKIE['PHPSESSID'])) {
			$user = $_COOKIE['u']; 
			$token = $_COOKIE['t'];
			$session = $_COOKIE['PHPSESSID']; 
			$db = connect(); 
			$query = "SELECT `connect_id`, `connect_user_id`, `connect_token`, `connect_session`, UNIX_TIMESTAMP(`connect_token_time`) AS `time` 
					  FROM `connects`
					  WHERE `connect_user_id` = $user 
					  AND `connect_token` = '$token'
					  AND `connect_session` = '$session'"; 
			$result = mysqli_query($db, $query); 
			if (mysqli_num_rows($result)) {
				$connect_info = mysqli_fetch_assoc($result); 
				$expiration_time = $connect_info['time']; 
				if ($expiration_time < time()) {
					$token = generateToken(); 
					$token_time = time() + 900; 
					$connect_id = $connect_info['connect_id']; 
					$query = "UPDATE `connects`
						SET `connect_token` = '$token',
							`connect_token_time` = FROM_UNIXTIME($token_time)
						WHERE `connect_id` = $connect_id; "; 
					mysqli_query($db, $query); 
					setcookie('t', $token); 
				}
				$authorized = true; 
			} 
		}
		return $authorized; 
	}
	
	function generateToken($size = 32) {
		$symbols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
		$token = ""; 
		$length = count($symbols) - 1; 
		for ($i = 0; $i < $size; $i++) $token .= $symbols[rand(0, $length)];
		return $token; 
	}
	
	function checkIfDefined($user_id, $book_id) {
		if ($user_id && $book_id) { 
			$db = connect(); 
			$query = "SELECT * 
					  FROM `marks`
					  WHERE `mark_user_id` = $user_id
					  AND `mark_book_id` = $book_id; ";
			$result = mysqli_query($db, $query); 
			if (mysqli_num_rows($result)) return true; 
			else return false; 
		} 
        else return false; 
	}
?>