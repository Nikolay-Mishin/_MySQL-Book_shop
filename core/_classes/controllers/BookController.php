<?php
class BookController {
    public function actionIndex($parameters) {
        $title = "Книги"; 
        $book = new BookProxy(); 
        $count = $book->getTotalCount();
        $currentPage = $parameters[0] ?? 1; 
        $limit = 2; 
        $index = "page="; 
        $bookList = $book->getListOfBooks($limit, $currentPage); 
        $pagination = new Pagination($count, $currentPage, $limit, $index); 
        include_once('./views/books/index.php'); 
        return true;
    }
    
    public function actionView($parameters) {
        $title = "Информация по книге"; 
        $book = new Book();
        $bookInfo = $book->getBook($parameters[0]);
        return true;
    }
    
    public function actionEdit($parameters) {
        $title = "Редактировать книгу";
        $book = new Book(); 
        $book_id = $parameters[0];
        $bookInfo = $book->getBook($book_id); 
        $publisher = new Publisher();
        $publisherList = $publisher->getPublishers(); 
        $author = new Author();
        $authorList = $author->getAuthors(); 
        $authors = explode(',', $bookInfo['authors_id']); 
        if (isset($_POST['book_name'])) {
            $name = $_POST['book_name'];
            $price = $_POST['book_price'];
            $authors_new = $_POST['authors'];
            $publishers = $_POST['publishers']; 
            $book->editBook($book_id, compact('name', 'price', 'publishers')); 
            if ($authors != $authors_new) {
                
            }
            print_r($_POST); 
        }
        include_once('./views/books/edit.php'); 
        return true; 
    }
}
?>