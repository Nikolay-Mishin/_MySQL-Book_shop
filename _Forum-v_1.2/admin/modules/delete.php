<?php
require_once '../../core/main.php';
$name = $_GET['name'];
require_once DA.data ($name).'.php';
?>