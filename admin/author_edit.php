<?php
require_once '../core/main.php';

$title = 'Редактировать автора'; 

set_redirect();

$db = connect(); 
if (isset ($_GET['id'])) {
    $author_id = $_GET['id']; 

    $query = "SELECT * FROM `authors` WHERE `author_id` = $author_id"; 
    $result = mysqli_query ($db, $query); 
    $author = mysqli_fetch_assoc ($result);		
    // обработка если значение id нет в таблице 
}
if (isset ($_POST['author_name'])) {
    $author_name = escape ($_POST['author_name'], $db); 

    $query = "UPDATE `authors` 
                SET `author_name`  = '$author_name' 
                WHERE `author_id` = $author_id;"; 
    mysqli_query ($db, $query); 
    if (!mysqli_error ($db)) {
        redirect();
    } else {
        // дописать если есть ошибки 
    }

}
close ($db);

load (_AUTHORS.name(), $title, compact ('author'));
?>
