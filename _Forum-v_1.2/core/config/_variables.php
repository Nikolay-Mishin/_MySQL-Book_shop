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
define ('_INIT', CONF.'_init.php'); // core/config/
define ('_TEST', CONF.'_test'); // core/config/
define ('TEST', false);
?>