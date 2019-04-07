<?php
if (isset ($_GET['id'])) {
    $id = $_GET['id'];

    require_once 'core/main.php';

    $db = connect(); 
    $query = "SELECT `book_id` AS `id`, 
                    `book_name`, 
                    `book_price`, 
                    `publisher_name`, 
                    `book_quantity`, 
                    `book_average_mark` AS `mark`,
                    GROUP_CONCAT(`author_name`) AS `author_names`
        FROM `books`
        LEFT JOIN `publishers` ON `book_publisher_id` = `publisher_id`
        LEFT JOIN `books_authors` ON `book_author_book_id` = `book_id`
        LEFT JOIN `authors` ON `author_id` = `book_author_author_id`
        WHERE `book_id` = $id
        GROUP BY `book_id`;
    "; 
    $result = mysqli_query ($db, $query);
    $book = mysqli_fetch_assoc ($result);
    close ($db);

    $mark = $book['mark']; 
    $user_id = $_COOKIE['u'] ?? ""; 
    $check_if_defined = checkIfDefined ($user_id, $id);
    $title = $book['book_name'];

    view ('templates/common/head', compact ('title')); 
    view ('templates/books/book', compact ('book')); 
    view ('templates/common/mark', compact ('mark', 'check_if_defined')); 
    view ('templates/common/footer'); 
}
?>