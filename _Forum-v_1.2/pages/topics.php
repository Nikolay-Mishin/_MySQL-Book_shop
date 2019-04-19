<?php
include_once ('view.php');
include_once ('data/data_topics.php');

loadPost('Topics', '../templates/post/topics_post.html', compact('Post','btn_edit_green','btn_delet_green'));

?>