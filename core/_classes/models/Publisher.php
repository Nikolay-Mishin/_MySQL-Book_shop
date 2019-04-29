<?php
class Publisher {
    public function getPublishers() {
        $connect = DB::getInstance(); 
        $query = (new Select("publishers"))
                    ->what(array('id' => 'publisher_id',
                                    'name' => 'publisher_name'
                                    ))
                    ->build(); 
        $result = $connect->query($query); 
        $publisherList = $result->fetchAll(); 
        return $publisherList;
    
    }
}
?>