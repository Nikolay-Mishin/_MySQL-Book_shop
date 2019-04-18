<?php
require_once '_router.php';
$dir = GEN;
foreach (Using::get_dir_content ($dir) as $file) { 
    if (is_file ($dir.$file)) {
        require_once $dir.$file;
    }
}
require_once INIT;
require_once _TEST;
?>