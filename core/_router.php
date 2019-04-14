<?php
define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/');
define ('SECURED_DIR', 'admin/');
define ('DIR', !url_admin_parse() ? './' : '../');

define ('CORE', DIR.'core/');
define ('_CLASS', '_classes/');
define ('_C', CORE._CLASS); // core/_classes/

define ('INDEX', DIR.'books.php');
define ('DIR_AUTH', './auth.php');

// $locked, $auth
define ('URL_LOCKED', [
    SECURED_DIR => 1,
    'admin/books' => 0
]);

function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };

function url_admin_parse () { return preg_match ('/^'.url_pattern (SECURED_DIR).'/', url_parse()); }

function url_parse ($url = null) { return preg_split ('/'.strtolower (url_pattern (BASE_DIR)).'/', strtolower (get_url()))[1]; }

function url_pattern ($dir) { return str_replace ('/', '\/', $dir); }

function get_url ($url = null) { return $url ?? $_SERVER['PHP_SELF']; }
?>