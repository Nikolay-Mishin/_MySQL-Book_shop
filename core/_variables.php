<?php
define ('UP', '../');

// Основные директории подключаемых файлов
define ('CORE', 'core/');
define ('_C', '_classes/');
define ('D', '_data/');
define ('R', '_redirect/');
define ('__C', 'common/');
define ('_D', CORE.D);
define ('_R', CORE.R);
define ('C', CORE.__C);

// Внутренние директории подключаемых файлов
define ('_DC', _D.__C); // _data/common/
define ('_DR', _D.R); // _data/_redirect/

// Основные директории
define ('RES', 'resources/');
define ('LIBS', RES.'libs/');
define ('CSS', RES.'css/');
define ('FONTS', RES.'fonts/');
define ('JS',  RES.'js/');
define ('IMG', RES.'img/');

// Шрифты
define ('Awesome', FONTS.'fontawesome-5.7.2/');

// Шаблоны
define ('TEMPS', 'templates/');
define ('_RED', TEMPS.'_redirect/');
define ('COMN', TEMPS.'common/');
define ('T_MAIN', TEMPS.'main/');
define ('ABOUT', TEMPS.'about/');
define ('NEWS', TEMPS.'news/');
define ('REVS', TEMPS.'reviews/');
define ('CONT', TEMPS.'contacts/');
define ('GALL', TEMPS.'gallery/');

// Имена основных шаблонов
define ('HEAD', 'head');
define ('HEADER', 'header');
define ('WRAP', 'wrapper');
define ('ASIDE', 'aside');
define ('MAIN', 'main');
define ('FOOT',  'footer');
define ('SCRIPT', 'scriptside');
?>