<?php
class Cart {
    public static function countProducts() {
        if ($_COOKIE) {
            if ($_COOKIE['cart']) {
                $cart = $_COOKIE['cart']; 
                $cart =  json_decode($cart); 
                $count = 0; 
                foreach ($cart as $productInCart) {
                    $count += $productInCart; 
                }
                return $count; 
            }
        }
    }
}
?>