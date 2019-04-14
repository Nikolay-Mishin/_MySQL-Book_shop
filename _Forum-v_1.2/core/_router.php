<?php
define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/');
define ('DIR', !url_admin_parse() ? './' : '../');

define ('CORE', DIR.'core/');
define ('_CLASS', '_classes/');
define ('_C', CORE._CLASS); // core/_classes/

define ('INDEX', DIR.'books.php');
define ('DIR_AUTH', './auth.php');

function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };

function url_admin_parse () { return preg_match ('/admin\//', url_parse()); }

function url_parse ($url = null) {
    $pattern = strtolower (str_replace ('/', '\/', BASE_DIR));
    return preg_split ("/$pattern/", strtolower (get_url()))[1];
}

function get_url ($url = null) { return $url ?? $_SERVER['PHP_SELF']; }
?>