<?php
set_redirect();

$db = connect();
if (isset ($_GET['id'])) {
    $author_id = $_GET['id'];
    query_edit ($db, 'authors', ['author_is_deleted' => 1], ['author_id' => $author_id]);
    if (!mysqli_error ($db)) { redirect(); }
    else { test (mysqli_error ($db)); }	
}
close ($db); 
?>