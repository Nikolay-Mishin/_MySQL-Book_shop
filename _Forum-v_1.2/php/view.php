<?php
include_once ('function.php');
include_once ('interface.php');
include_once ('data/data_head.php');
include_once ('data/data_footer.php');

function load ($title, $main, $args) {
    global $css;
    global $js;
    view('../templates/common/head.html', compact('title','css')); 
    view('../templates/common/menu_post.html');
    view($main, $args); 
    view('../templates/common/footer.html',compact('js'));
}

function loadPost ($title, $main, $args) {
    global $css;
    global $js;
    view('../templates/common/head.html', compact('title','css')); 
    view($main, $args); 
    view('../templates/post/topics_comments.html'); 
    view('../templates/post/topics_add_comments.html');
    view('../templates/common/footer.html',compact('js'));
}

?>