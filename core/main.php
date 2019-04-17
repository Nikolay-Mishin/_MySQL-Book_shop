<?php
function test ($data) { echo '<pre>'; print_r ($data); echo '</pre>'; };

require_once '_router.php';

function get_dir_content ($dir) {
    $files = scandir (dir_to_file ($dir));
    unset ($files[array_search ('.', $files, true)]);
    unset ($files[array_search ('..', $files, true)]);
    return $files;
}
foreach (get_dir_content (CONF) as $file) { require_once CONF.$file; }

start_session();
?>