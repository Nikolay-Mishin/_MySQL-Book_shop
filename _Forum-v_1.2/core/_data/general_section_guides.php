<?php
$title = 'General guides';

$db = connect();
$subtopics = query_select($db, 'subtopic', '*', ['subtopic_topic_id' => 6]);
$topic = query_select($db, 'topic', '*', ['topic_id' => 6]);
$result = array('title' => $topic, 'themes' => $subtopics);
close($db);

$msg = 0; 
$view = 0;
$themes_len = count($result['themes']);
$section_name = $result['title']['topic_title'];
foreach ($result['themes'] as $theme) {
    $msg += $theme['subtopic_message'];
    $view += $theme['subtopic_view'];
}
?>