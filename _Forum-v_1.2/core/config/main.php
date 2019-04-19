<?php
// Router configs
define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/_Forum-v_1.2/');

// Main dirs
define ('SECURED', 'admin/');
define ('PAGES_DIR', 'pages/');
define ('MODULES_DIR', 'modules/');

// Core dirs
define ('_CLASS', '_classes/');
define ('_CONF', 'config/');
define ('_GEN', 'general/');

// Main Classes
_const ('Init', _CLASS);
_const ('_Core', _CLASS.'Core');
_const ('Using', _CLASS.'system/Using');
_const ('Init_class', _CLASS.'initiolize/Init_class');
_const ('List_folder_dirs', _CLASS.'system/List_folder_dirs');

define (strtoupper ('Main_classes'), [
    const_name ('Init'), const_name ('_Core'), const_name ('Using'), const_name ('Init_class'), const_name ('List_folder_dirs')
]);

require_once '_variables.php';
?>