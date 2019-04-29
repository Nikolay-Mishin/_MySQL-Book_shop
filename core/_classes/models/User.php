<?php
class User {
    public function checkIfEmailExists($email) {
        $connect = DB::getInstance(); 
        $query = "
            SELECT *
            FROM `users`
            WHERE `user_email` = '$email'; 
        ";
        $result = $connect->query($query); 
        $num_rows = $result->rowCount();
        if ($num_rows > 0) {
            return true; 
        } else {
            return false; 
        }
    }
    
    public function registerUser($email, $password) {
        $connect = DB::getInstance(); 
        $query = "
            INSERT INTO `users`(`user_email`, `user_password`)
            VALUES ('$email', '$password'); 
        ";
        $result = $connect->query($query); 
        //header('Location: ' . ROOT . 'books'); 
        return true; 
    }
}
?>