<?php
	session_unset(); 
	setcookie('u', $_COOKIE['u'], time() - 100);
    //header('Location: authors.php');
    header ('Refresh: 0;'.$_SERVER['HTTP_REFERER']);
?>