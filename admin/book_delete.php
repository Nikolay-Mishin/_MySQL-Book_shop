<?php
require_once '../core/main.php';

set_redirect();

$db = connect(); 
if (isset ($_GET['id'])) {
    $book_id = $_GET['id']; 

    $query = "UPDATE `books` 
                SET `book_is_deleted` = 1 
                WHERE `book_id` = $book_id"; 
    mysqli_query ($db, $query); 
    if (!mysqli_error ($db)) {
        redirect();
    } else {
        // дописать если есть ошибки 
    }		
}
close ($db); 
?>
