<?php

	class BookProxy implements IBook {
		
		public $book; 
		
		public function __construct() {
			$this->book = new Book();
		}
		
		public function getBooks() {
			return ($this->book)->getBooks();
		}
		
		public function getBook($id) {
			return ($this->book)->getBook($id);
		}
		
		public function getTotalCount() {
			return ($this->book)->getTotalCount();
		}
		
		public function getListOfBooks($count, $page) {
			if (1 == 0) {
				return ($this->book)->getListOfBooks($count, $page);
			} else {
				echo 'У вас недостаточно прав для просмотра!'; 
				return; 
			}

		}
		
		public function editBook($id, $book_info) {
			return ($this->book)-> editBook($id, $book_info);
		}
		
	
	}




?>