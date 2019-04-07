<?php
require_once '../core/main.php';

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
$text = ""; 
$text .= "<table border='1'><tr><th> ID </th> <th> Название </th> <th> Цена </th> <th> Издатель </th> <th> Количество </th> <th> Авторы </th></tr> "; 
foreach ($books as $book) {
    $text .= "<tr> 
                <td> $book[id] </td> 
                <td> $book[book_name] </td> 
                <td> $book[book_price] </td> 
                <td> $book[publisher_name] </td> 
                <td> $book[book_quantity] </td>
                <td> $book[author_names] </td> 					
            </tr>"; 
}
$text .= "</table>";
close ($db); 

load (_BOOKS.name(), $title, compact ('text'));
?>