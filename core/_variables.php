<?php
define ('UP', '../');

// Основные директории подключаемых файлов
define ('CORE', 'core/');
define ('_R', '_redirect/');
define ('_COMN', 'common/');
define ('_C', CORE.'_classes/'); // core/_classes/
define ('D', CORE.'_data/'); // core/_data/
define ('R', CORE._R); // core/_redirect/
define ('C', CORE._COMN); // core/common/

// Внутренние директории подключаемых файлов
define ('DC', D._COMN); // core/_data/common/
define ('DR', D._R); // core/_data/_redirect/

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
define ('_RED', TEMPS._R);
define ('COMN', TEMPS._COMN);
define ('REG', TEMPS.'reg/');
define ('AUTH', TEMPS.'auth/');

// Имена основных шаблонов
define ('HEAD', 'head');
define ('HEADER', 'header');
define ('WRAP', 'wrapper');
define ('ASIDE', 'aside');
define ('MAIN', 'main');
define ('FOOT',  'footer');
define ('SCRIPT', 'scriptside');
?>