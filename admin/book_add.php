<?php
require_once '../core/main.php';

$title = 'Добавить книгу';

set_redirect();

$db = connect(); 
$query = "SELECT * FROM `publishers`"; 
$result = mysqli_query ($db, $query); 
$publishers = mysqli_fetch_all ($result, MYSQLI_ASSOC);
$query1 = "SELECT * FROM `authors` WHERE `author_is_deleted` = 0"; 
$result1 = mysqli_query ($db, $query1); 
$authors = mysqli_fetch_all ($result1, MYSQLI_ASSOC);

if (isset ($_POST['book_name'])) {
    // не забываем обернуть в функцию htmlentities и mysqli_real_escape_string; 
    $book_name = escape ($_POST['book_name'], $db);
    $books_price = escape ($_POST['book_price'], $db); 

    // загружаем данные в таблицу books; 
    $query = "INSERT INTO `authors` (`author_name`) VALUE ('$author_name')"; 
    // заносим данные в промежуточную таблицу books_authors; 
    mysqli_query ($db, $query); 
    if (!mysqli_error ($db)) {
        redirect();
    } else {
        // дописать если есть ошибки 
    }
}
close ($db); 

load (_BOOKS.name(), $title, compact ('publishers', 'authors'));
?>