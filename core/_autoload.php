<?php
require_once '_router.php';
require_once MAIN_CONF;
using (const_name ('Main_classes'), null, false);
foreach (Using::get_dir_content (GEN) as $file) { if (is_file (GEN.$file)) { require_once GEN.$file; } }
using (CONF);
require_once _INIT;
?>