<?php
$title = 'Книги';

$db = connect();
$query = "SELECT `book_id` AS `id`, 
                    `book_name`, 
                    `book_price`, 
                    `publisher_name`, 
                    `book_quantity`, 
                    GROUP_CONCAT(`author_name`) AS `author_names`
    FROM `books`
    LEFT JOIN `publishers` ON `book_publisher_id` = `publisher_id`
    LEFT JOIN `books_authors` ON `book_author_book_id` = `book_id`
    LEFT JOIN `authors` ON `author_id` = `book_author_author_id`
    GROUP BY `book_id`;
";
$result = mysqli_query ($db, $query);
$books = mysqli_fetch_all ($result, MYSQLI_ASSOC);
close ($db);
?>