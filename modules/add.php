<?php
require_once '../core/main.php';
require_once DM.name().'.php';
$name = $_GET['name'];
load (DA.data ($name), template ($name), $data[$name]);
?>