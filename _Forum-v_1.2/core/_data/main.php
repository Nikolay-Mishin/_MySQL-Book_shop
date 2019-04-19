<?php
$title = 'Главная';

$db = connect();
$topic = query_select($db, 'topic', '*', ['topic_show_id' => 1]);
$section = query_select($db, 'section', '*');
$result = array();
foreach ($section as $arr) {
    $themes = array();
    foreach ($topic as $arr2) {
        if ($arr2['topic_section_id'] == $arr['section_id']) $themes[] = $arr2;
    }
    $result[] = array('title' => $arr, 'themes' => $themes);
}
close($db);
?>