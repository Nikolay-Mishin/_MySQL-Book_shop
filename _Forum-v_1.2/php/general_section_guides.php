<?php
include_once ('view.php');


$db = new PDO('mysql:host=localhost;dbname=forum_v1;charset=utf8', 'root', '');

$sql = "SELECT * FROM subtopic WHERE subtopic_topic_id=6";
$result_subtopic = $db->query($sql);
$subtopic = $result_subtopic->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM topic WHERE topic_id=6";
$result_topic = $db->query($sql2);
$topic = $result_topic->fetchAll(PDO::FETCH_ASSOC);

$result = array();
foreach ($topic as $arr) {
    $themes = array();
    foreach ($subtopic as $arr2) {
        if ($arr2['subtopic_topic_id'] == $arr['topic_id']) $themes[] = $arr2;
    }
    $result[] = array('title' => $arr, 'themes' => $themes);
}
$db = null;


foreach ($result as $results) {
    $msg = 0; 
    $view = 0;
    $themes_len = count($results['themes']);
    $section_name = $results['title']['topic_title'];
    foreach ($results['themes'] as $item) {
        $msg += $item['subtopic_message'];
        $view += $item['subtopic_view'];
    }
}

load('General guides', '../templates/general/general_section_guides.html', compact('result','msg','view','themes_len','section_name','btn_edit','btn_delet'));

?>