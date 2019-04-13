<?php
function view($html, $data = []) {
    extract($data); 
    include_once($html); 
}


?>