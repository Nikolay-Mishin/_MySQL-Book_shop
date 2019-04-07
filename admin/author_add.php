<?php
require_once '../core/main.php';

$title = 'Добавить автора';

set_redirect();

if (isset ($_POST['author_name'])) {
    // не забываем обернуть в функцию htmlentities и mysqli_real_escape_string; 
    $author_name = $_POST['author_name']; 

    $db = connect(); 
    $author_name = escape ($_POST['author_name'], $db); 
    $query = "INSERT INTO `authors` (`author_name`) VALUE ('$author_name')"; 
    mysqli_query ($db, $query); 
    if (!mysqli_error ($db)) {
        redirect();
    } else {
        // дописать если есть ошибки 
        echo mysqli_error; 
    }
    close ($db);
}

load (_AUTHORS.name(), $title);
?>