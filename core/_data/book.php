<?php
if (isset ($_GET['id'])) {
    $id = $_GET['id'];

    $db = connect();
    $book = query_join ($db, 'books',
        [
            'book_id AS id', 'book_name', 'book_price', 'publisher_name', 'book_quantity', 'book_average_mark AS mark', 
            'GROUP_CONCAT(author_name) AS author_names'
        ],
        [
            'publishers' => ['book_publisher_id', 'publisher_id'],
            'books_authors' => ['book_author_book_id', 'book_id'],
            'authors' => ['author_id', 'book_author_author_id']
        ],
        ['book_id' => $id],
        null,
        'book_id'
    );
    close ($db);

    $mark = $book['mark']; 
    $user_id = $_COOKIE['u'] ?? ""; 
    $check_if_defined = checkIfDefined ($user_id, $id);
    $title = $book['book_name'];
}
?>