<?php
define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/');
$pattern = str_replace ('/', '\/', BASE_DIR);
define ('DIR', !preg_match ('/^admin\//', preg_split ("/$pattern/", $_SERVER['REQUEST_URI'])[1]) ? './' : '../');

// Основные директории подключаемых файлов
define ('A', 'admin/');
define ('CORE', DIR.'core/');
define ('_R', '_redirect/');
define ('_COMN', 'common/');
define ('_C', CORE.'_classes/'); // core/_classes/
// define ('D', CORE.'_data/'); // core/_data/
// define ('R', CORE._R); // core/_redirect/
// define ('C', CORE._COMN); // core/common/

// Внутренние директории подключаемых файлов
/* define ('DC', D._COMN); // core/_data/common/
define ('DR', D._R); // core/_data/_redirect/ */

// Основные директории
define ('RES', DIR.'resources/');
define ('LIBS', RES.'libs/'); // resources/
define ('CSS', RES.'css/'); // resources/
define ('FONTS', RES.'fonts/'); // resources/
define ('JS',  RES.'js/'); // resources/
define ('IMG', RES.'img/'); // resources/

// Шрифты
define ('Awesome', FONTS.'fontawesome-5.7.2/');

// Шаблоны
define ('TEMPS', DIR.'templates/');
// define ('_RED', TEMPS._R); // templates/_redirect/
define ('COMN', TEMPS._COMN); // templates/common/
// Основные шаблоны
define ('HEAD', COMN.'head'); // templates/common/
define ('HEADER', COMN.'header'); // templates/common/
define ('FOOT', COMN.'footer'); // templates/common/
define ('AUTH', COMN.'auth'); // templates/common/
define ('REG', COMN.'reg'); // templates/common/
define ('PAGINAT', COMN.'pagination'); // templates/common/
// Шаблоны Админ страниц
define ('_AUTHORS', TEMPS.A.'authors/'); // templates/admin/
define ('_BOOKS', TEMPS.A.'books/'); // templates/admin/
// Шаблоны страниц
define ('BOOKS', TEMPS.'books/'); // templates/
?>