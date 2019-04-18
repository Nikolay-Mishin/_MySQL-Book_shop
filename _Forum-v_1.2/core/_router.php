<?php
function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };

define ('UP', '../');

define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/');
define ('SECURED', 'admin/');
define ('PAGES_DIR', 'pages/');
define ('MODULES_DIR', 'modules/');

define ('DIR', url_full_parse());
define ('CUR_DIR', url_cur_dir_parse());

define ('CORE', DIR.'core/'); // core/

define ('_CLASS', '_classes/');
define ('_CONF', 'config/');
define ('_GEN', 'general/');

define ('_C', CORE._CLASS); // core/_classes/
define ('CONF', CORE._CONF); // core/config/
define ('GEN', CORE._GEN); // core/general/

// General configs
define ('MAIN_CONF', CONF.'main.php'); // core/config/
define ('_TEST', CONF.'_test'); // core/config/
define ('GEN_CONF', CONF._GEN); // core/config/general/
define ('INIT', GEN_CONF.'init.php'); // core/config/general/

require_once MAIN_CONF;

function using ($path, $ext = '.php') {
    $path = !is_dir ($path) ? $path.$ext : $path;
    if (is_file ($path)) { Using::file ($path); }
    if (is_dir ($path)) { Using::dir ($path); }
}

// $locked, $auth
define ('URL_LOCKED', [
    SECURED => 1,
    'admin/books' => 0
]);

function url_full_parse () {
    $url = url_dir_parse (SECURED) ? url_dir_parse (SECURED)[1] : false;
    $dir = !$url ? './' : '../';
    $url = $url ? $url : url_parse();
    $dir .= url_dir_parse (PAGES_DIR, $url) || url_dir_parse (MODULES_DIR, $url) ? '../' : '';
    return $dir;
}

function url_admin_parse ($url = null) { return url_dir_parse (SECURED, $url) ? true : false; }

function url_cur_dir_parse () { return url_full_parse() == './' || url_full_parse() == '../' ? './' : '../'; }

function url_dir_parse ($dir, $url = null) {
    return preg_match ('/^'.url_pattern ($dir).'(.+)/', $url ?? url_parse(), $arr) ? $arr : false;
}

function url_parse ($url = null) { return preg_split ('/'.strtolower (url_pattern (BASE_DIR)).'/', strtolower ($url ?? get_url()))[1]; }

function url_pattern ($dir) { return str_replace ('/', '\/', $dir); }

function dir_to_file ($dir) { return Using::dir_to_file ($dir); }

function get_url ($url = null) { return $url ?? $_SERVER['PHP_SELF']; }
?>