<!DOCTYPE html>
<head> 
	<link rel="stylesheet" href="<?= STYLES . "styles.css"?>"/>
	<title> <?= $title;  ?></title>
	<script src="<?= LIBS . 'jquery/jquery-3.3.1.js'?>"> </script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="<?= JS . 'script.js' ?>"> </script>
</head> 
<body> 
	<div class="header">
       		<div class="logo"><a href="index.html"><img src="<?= IMAGES . 'logo.gif'?>" alt="" title="" border="0" /></a></div>            
        <div id="menu">
            <ul>                                                                       
            <li class="<?= ($title == 'Главная')? 'selected': '' ?>"><a href="<?= ROOT ?>">Главная</a></li>
            <li class="<?= ($title == 'О нас')? 'selected': '' ?>"><a href="about.html">О нас</a></li>
            <li class="<?= ($title == 'Книги')? 'selected': '' ?>"><a href="<?= ROOT . 'books' ?>">Книги</a></li>
            <li class="<?= ($title == 'Личный кабинет')? 'selected': '' ?>"><a href="myaccount.html">Личный кабинет</a></li>
            <li class="<?= ($title == 'Зарегистрироваться')? 'selected': '' ?>"><a href="<?= ROOT . 'user/register' ?>">Регистрация</a></li>
            <li class="<?= ($title == 'Контакты')? 'selected': '' ?>"><a href="contact.html">Контакты</a></li>
			<li class="<?= ($title == 'Корзина')? 'selected': '' ?>"><a href="#">Корзина</a><span><?= Cart::countProducts(); ?> </span></li>
            </ul>
        </div>     
            
            
       </div>