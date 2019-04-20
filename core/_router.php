<?php
define ('MAIN_CONF', 'config/main.php'); // core/

function _const ($name, $value) {
    $value = is_dir (__DIR__.'/'.$value) ? $value.$name : $value;
    define (strtoupper ($name), $value);
}

function const_name ($name) { return constant (strtoupper ($name)) ?: null; }

function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };

function using ($path, $ext = null, $using = true) {
    if (is_array ($path)) {
        foreach ($path as $item) { include_path ($item, $ext, $using); }
    }
    else { include_path ($path, $ext, $using); }
}

function include_path ($path, $ext = null, $using = true) {
    if (!is_dir ($path)) $path = $ext ? $path.$ext : "$path.php";
    if (!$using) { require_once $path; }
    else {
        if (is_file ($path)) { Using::file($path); }
        if (is_dir ($path)) { Using::dir($path); }
    }
}

function url_full_parse () {
    $url = url_dir_parse (SECURED) ? url_dir_parse (SECURED)[1] : false;
    $dir = !$url ? './' : '../';
    $url = $url ? $url : url_parse();
    $dir .= url_dir_parse (PAGES_DIR, $url) || url_dir_parse (MODULES_DIR, $url) ? '../' : '';
    return $dir;
}

function url_cur_dir_parse () { return url_full_parse() == './' || url_full_parse() == '../' ? './' : '../'; }

function url_admin_parse ($url = null) { return url_dir_parse (SECURED, $url) ? true : false; }

function url_dir_parse ($dir, $url = null) {
    return preg_match ('/^'.url_pattern ($dir).'(.+)/', $url ?? url_parse(), $arr) ? $arr : false;
}

function url_parse ($url = null) { return preg_split ('/'.strtolower (url_pattern (BASE_DIR)).'/', strtolower ($url ?? get_url()))[1]; }

function url_pattern ($dir) { return str_replace ('/', '\/', $dir); }

function get_url ($url = null) { return $url ?? $_SERVER['PHP_SELF']; }

function dir_to_file ($dir) { return Using::dir_to_file ($dir); }

function cur_dir ($dir) { return basename (dirname ($dir)); }
?>