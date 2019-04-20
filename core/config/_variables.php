<?php
// Main Classes
_const ('Init', _CLASS);
_const ('_Core', _CLASS.'Core');
_const ('Using', _CLASS.'system/Using');
_const ('Init_class', _CLASS.'initiolize/Init_class');
_const ('List_folder_dirs', _CLASS.'system/List_folder_dirs');

define (strtoupper ('Main_classes'), [
    const_name ('Init'), const_name ('_Core'), const_name ('Using'), const_name ('Init_class'), const_name ('List_folder_dirs')
]);

define ('UP', '../');

// General configs
define ('DIR', url_full_parse());
define ('CUR_DIR', url_cur_dir_parse());

define ('CORE', DIR.'core/'); // core/
define ('_C', CORE._CLASS); // core/_classes/
define ('CONF', CORE._CONF); // core/config/
define ('GEN', CORE._GEN); // core/general/

define ('GEN_CONF', CONF._GEN); // core/config/general/
define ('_INIT', CONF.'_init.php'); // core/config/
define ('_TEST', CONF.'_test.php'); // core/config/
?>