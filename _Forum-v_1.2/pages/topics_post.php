<?php
require_once '../core/main.php';
$pages = [TOPICS_POST, TOPICS_COMMS, TOPICS_COMS_ADD];
load ([D.name()], $pages, [['posts', 'btn_edit_green', 'btn_delet_green']]);
/* view(TOPICS_COMMS); 
view(TOPICS_COMS_ADD); */
?>