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

/* $db = new PDO('mysql:host=localhost;dbname=forum_v1;charset=utf8', 'root', '');

$sql = "SELECT * FROM topic WHERE topic_show_id=1";

// $db->query($sql); метод объекта класса PDO
$result_topic = $db->query($sql);
$topic = $result_topic->fetchAll(PDO::FETCH_ASSOC); // преобразовываем данные,создаем ассоциативный массив,
// print_r($topic);

$sql2 = "SELECT * FROM section";
$result_section = $db->query($sql2);
$section = $result_section->fetchAll(PDO::FETCH_ASSOC);
// print_r($section);

// topic_show_id
$result = array();
foreach ($section as $arr) {
    $themes = array();
    foreach ($topic as $arr2) {
        if ($arr2['topic_section_id'] == $arr['section_id']) $themes[] = $arr2;
    }
    $result[] = array('title' => $arr, 'themes' => $themes);
}
// print_r($result);

$db = null; */
?>