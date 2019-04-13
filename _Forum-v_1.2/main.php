<?php
// require_once 'core/main.php';
// load (D.name(), BOOKS.name(), ['books']);

include_once ('php/function.php');
include_once ('php/interface.php');
include_once ('php/data/data_head.php');
include_once ('php/data/data_footer.php');

$title = 'Main';

$db = new PDO('mysql:host=localhost;dbname=forum_v1;charset=utf8', 'root', '');
$sql = "SELECT * FROM topic WHERE topic_show_id=1";
// $db->query($sql); метод объекта класса PDO
$result_topic = $db->query($sql);
$topic = $result_topic->fetchAll(PDO::FETCH_ASSOC);//преобразовываем данные,создаем ассоциативный массив, 
//print_r($topic);
$sql2 = "SELECT * FROM section";
$result_section = $db->query($sql2);
$section = $result_section->fetchAll(PDO::FETCH_ASSOC);
//print_r($section);

//topic_show_id


$result = array();
foreach ($section as $arr) {
    $themes = array();
    foreach ($topic as $arr2) {
        if ($arr2['topic_section_id'] == $arr['section_id']) $themes[] = $arr2;
    }
    $result[] = array('title' => $arr, 'themes' => $themes);
}
//print_r($result);

$db = null;


view('templates/common/head.html', compact('title','css')); 
view('templates/common/main.html', compact('btn_add','btn_edit','btn_delet','result')); 
view('templates/common/footer.html', compact('js'));



?>