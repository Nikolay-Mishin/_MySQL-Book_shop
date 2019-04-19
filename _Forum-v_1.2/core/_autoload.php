<?php
require_once '_router.php';
require_once 'config/main.php'; // core/config/

foreach (Using::get_dir_content (GEN) as $file) { 
    if (is_file (GEN.$file)) { require_once GEN.$file; }
}

using (CONF);
require_once INIT;
using (TEST);
?>