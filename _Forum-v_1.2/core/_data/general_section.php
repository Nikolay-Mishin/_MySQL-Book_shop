<?php
$title = 'General';

$db = connect();
$topics = query_select($db, 'topic', '*', ['topic_section_id' => 2]);
$section = query_select($db, 'section', '*', ['section_id' => 2]);
$result = array('title' => $section, 'themes' => $topics);
close($db);

$msg = 0; 
$view = 0;
$themes_len = count($result['themes']);
$section_name = $result['title']['section_name'];
foreach ($result['themes'] as $theme) {
    $msg += $theme['topic_message'];
    $view += $theme['topic_view'];
}
?>