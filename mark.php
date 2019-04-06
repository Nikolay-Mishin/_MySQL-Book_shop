<?php
if (isset ($_GET['mark']) && isset ($_GET['book'])) {
    $user = $_COOKIE['u']; 
    $book = $_GET['book']; 
    $mark = $_GET['mark']; 

    require_once 'core/main.php'; 
    
    $db = connect(); 
    $query = "INSERT INTO `marks` (`mark_user_id`, `mark_book_id`, `mark_value`) 
        VALUE ($user, $book, $mark)
    ";
    mysqli_query ($db, $query);
    mysqli_close ($db);

    header ('Refresh: 0;'.$_SERVER['HTTP_REFERER']);
}
?>