<?php
include_once ('view.php');


$db = new PDO('mysql:host=localhost;dbname=forum_v1;charset=utf8', 'root', '');
$sql = "SELECT * FROM topic WHERE topic_section_id=1";

$result_topic = $db->query($sql);
$topic = $result_topic->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM section WHERE section_id=1";
$result_section = $db->query($sql2);
$section = $result_section->fetchAll(PDO::FETCH_ASSOC);

$result = array();
foreach ($section as $arr) {
    $themes = array();
    foreach ($topic as $arr2) {
        if ($arr2['topic_section_id'] == $arr['section_id']) $themes[] = $arr2;
    }
    $result[] = array('title' => $arr, 'themes' => $themes);
}
$db = null;


foreach ($result as $results) {
    $msg = 0; 
    $view = 0;
    $themes_len = count($results['themes']);
    $section_name = $results['title']['section_name'];
    foreach ($results['themes'] as $item) {
        $msg += $item['topic_message'];
        $view += $item['topic_view'];
    }
}



load('News', '../templates/news-section/news_section.html', compact('btn_edit','btn_delet','result','msg','view','themes_len','section_name'));

?>