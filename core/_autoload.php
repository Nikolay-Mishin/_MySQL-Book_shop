<?php
require_once '_router.php';

foreach (Using::get_dir_content (GEN) as $file) { 
    if (is_file (GEN.$file)) {
        require_once GEN.$file;
    }
}

using (GEN_CONF);
require_once INIT;
require_once TEST;

function using ($path, $ext = null) {
    if (!is_dir ($path)) $path = $ext ? $path.$ext : "$path.php";
    if (is_file ($path)) { Using::file($path); }
    if (is_dir ($path)) { Using::dir($path); }
}
?>