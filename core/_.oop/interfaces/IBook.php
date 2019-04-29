<?php

	interface IBook {
		public function getBooks();
		
		public function getBook($id);
		
		public function getTotalCount();
		
		public function getListOfBooks($count, $page);
		
		public function editBook($id, $book_info);
	
	}

?>