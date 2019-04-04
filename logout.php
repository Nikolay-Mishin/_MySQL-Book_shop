<?php
    include_once 'functions.php';
	session_unset(); 
	setcookie('u', $_COOKIE['u'], time() - 100);
    //header('Location: authors.php');
    redirect();
?>