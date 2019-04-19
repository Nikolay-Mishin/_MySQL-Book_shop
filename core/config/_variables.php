<?php
define ('UP', '../');

// General configs
define ('DIR', url_full_parse());
define ('CUR_DIR', url_cur_dir_parse());

define ('CORE', DIR.'core/'); // core/
define ('_C', CORE._CLASS); // core/_classes/
define ('CONF', CORE._CONF); // core/config/
define ('GEN', CORE._GEN); // core/general/

define ('GEN_CONF', CONF._GEN); // core/config/general/
define ('INIT', CONF.'_init.php'); // core/config/
define ('TEST', CONF.'_test.php'); // core/config/
define ('_TEST', false);

require_once _C.'Init.php';
require_once _C.'Core.php';
require_once _C.'system/Using.php';
require_once _C.'initiolize/Init_class.php';
require_once _C.'system/List_folder_dirs.php';
?>