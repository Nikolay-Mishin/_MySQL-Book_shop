<?php
function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };

require_once '_router.php';
$dir = GEN;
if ($dir) { foreach (get_dir_content ($dir) as $file) { if (is_file ($dir.$file)) { require_once $dir.$file; } } }

function using ($dir) { foreach (get_dir_content ($dir) as $file) { if (is_file ($dir.$file))  { require_once $dir.$file; } } }

function get_dir_content ($dir) {
    $files = scandir (dir_to_file ($dir));
    unset ($files[array_search ('.', $files, true)]);
    unset ($files[array_search ('..', $files, true)]);
    return $files;
}
?>