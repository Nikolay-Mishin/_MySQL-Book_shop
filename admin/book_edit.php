<?php
require_once '../core/main.php';

$title = 'Редактировать книгу'; 

set_redirect();

$db = connect(); 
if (isset ($_GET['id'])) {
    $book_id = $_GET['id']; 

    $query = "SELECT * FROM `books` WHERE `book_id` = $book_id"; 
    $result = mysqli_query ($db, $query); 
    $book = mysqli_fetch_assoc ($result);		
    // обработка если значение id нет в таблице 
}

if (isset ($_POST['book_name'])) {
    $book_name = escape ($_POST['book_name'], $db); 

    $query = "UPDATE `books` 
                SET `book_name`  = '$book_name' 
                WHERE `book_id` = $book_id;"; 
    mysqli_query ($db, $query); 
    if (!mysqli_error ($db)) {
        redirect();
    } else {
        // дописать если есть ошибки 
    }

}
close ($db);

load (_BOOKS.name(), $title, compact ('book'));
?>
