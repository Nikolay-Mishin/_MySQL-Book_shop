<?php
if (isset ($_GET['mark']) && isset ($_GET['book'])) {
    $user = $_COOKIE['u']; 
    $book = $_GET['book']; 
    $mark = $_GET['mark']; 

    $db = connect();
    query_add ($db, 'marks', ['mark_user_id' => $user, 'mark_book_id' => $book, 'mark_value' => $mark]);
    close ($db);
}
?>