<?php
class Book implements IBook {
    public function getBooks() {
        $connect = DB::getInstance(); 
        $query = (new Select('books'))
                    ->build(); 
        $result = $connect->query($query); 
        $bookArray = $result->fetchAll(); 
        return $bookArray; 
    }
    public function getBook($id) {
        $connect = DB::getInstance(); 
        $query = (new Select("books"))
                    ->what(array('name' => 'book_name',
                                    'price' => 'book_price',
                                    'publisher_id' => 'book_publisher_id',
                                    'publisher' => 'publisher_name',
                                    'year' => 'book_year',
                                    'description' => 'book_description',
                                    'quantity' => 'book_quantity',
                                    'binding_id' => 'book_binding_id',
                                    'language_id' => 'book_language_id',
                                    'image' => 'book_image',
                                    'isbn' => 'book_isbn',
                                    'mark' => 'book_average_mark',
                                    'authors_id' => 'GROUP_CONCAT(`author_id`)',
                                    'authors_name' => 'GROUP_CONCAT(`author_name`)'))
                    ->join(array('publishers' => array('LEFT', 'book_publisher_id', 'publisher_id'), 
                                    'books_authors' => array('LEFT', 'book_id', 'book_author_book_id'),
                                    'authors' => array('LEFT', 'book_author_author_id', 'author_id')))
                    ->and(array('book_id' => "=$id"))
                    ->group('book_id')
                    ->build(); 
        $result = $connect->query($query); 
        $bookInfo = $result->fetch();  
        return $bookInfo;
    }
    
    public function getTotalCount() {
        $connect = DB::getInstance(); 
        $query = "
            SELECT COUNT(*) as `count`
            FROM `books`;
        ";
        $result = $connect->query($query);
        $count = $result->fetch()['count'];
        return $count; 
    }
    
    public function getListOfBooks($count, $page) {
        $connect = DB::getInstance();
        $offset = ($page - 1)*$count; 
        $query = (new Select('books'))
                    ->limit($offset, $count)
                    ->build(); 
        $result = $connect->query($query);
        $bookList = $result->fetchAll();
        return $bookList;
    }
    
    public function editBook($id, $book_info) {
        $connect = DB::getInstance();
        
        /*$query = "
            UPDATE `books`
                SET `book_name` = $book_info['name']
                    `book_price` = $book_info['price']
                    `book_publisher_id` = $book_info['publisher']
                WHERE `book_id` = $id; 
        ";
        $connect->query($query);*/
    }
}
?>