<?php
$title = 'Контакты';

$subject = 'Вопрос с сайта';
$body = 'Привет, я зашел на твой сайт, и у меня есть вопрос';

$contacts_title = 'Контакты';
$contacts = [
    'E-mail' => ['mailto', 'mishin.nikolay.d3@gmail.com'],
    'E-mail с шаблоном темы и тела письма' => ['mailto', "mishin.nikolay.d3@gmail.com?subject=$subject&body=$body", 'mishin.nikolay.d3@gmail.com'],
    'Телефон' => ['tel', '+79632811890', '+7 (963) 281-18-90'],
    'Skype - чат' => ['skype', 'ion-memfeskiy?chat', 'ion-memfeskiy@skype.com'],
    'Skype - звонок' => ['skype', 'ion-memfeskiy?call', 'ion-memfeskiy@skype.com']
];
?>