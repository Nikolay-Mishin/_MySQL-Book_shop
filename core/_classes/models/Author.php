<?php
class Author {
    public function getAuthors() {
        $connect = DB::getInstance(); 
        $query = (new Select('authors'))
                    ->what(array('id' => 'author_id',
                                    'name' => 'author_name'
                                    ))
                    ->build(); 
        $result = $connect->query($query); 
        $authorsArray = $result->fetchAll(); 
        return $authorsArray; 
    }
}
?>