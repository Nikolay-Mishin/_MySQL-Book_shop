<?php
$meta  = [
    ['charset' => 'utf-8'],
    ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'],
    ['http-equiv' => 'X-UA-Compatible', 'content' => 'ie=edge']
];
$libs = [
    'bootstrap-4.3.1-dist/css/bootstrap.min',
    'fontawesome/css/all',
    'offcanvas',
    // '_snipets'
];
$fonts = [
    Awesome.'css/all',
    'links' => [
        'https://fonts.googleapis.com/css?family=Cuprum:400,400i|Exo+2|PT+Sans+Narrow:400,700|PT+Sans:400,700&amp;subset=cyrillic'
    ]
];
$form = mb_strcasecmp ($title, 'Отзыв') == 0 ? 'form' : '';
$css = [
    // 'style', 
    $form
];
?>