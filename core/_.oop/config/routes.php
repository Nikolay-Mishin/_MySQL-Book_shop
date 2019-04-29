<?php
	$specific_routes = array(
		'book/([0-9]+)' => 'book/view/$1',
		'books/page=([0-9]+)' => 'book/index/$1',
		'book/edit/([0-9]+)' => 'book/edit/$1',
		'books' => 'book/index', 
		'user/register' => 'user/register', // actionRegister â UserController
		'' => 'main/index'
	)
?>