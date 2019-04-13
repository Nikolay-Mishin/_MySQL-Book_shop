<?php
define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/');

function url_parse ($url) {
    $pattern = strtolower (str_replace ('/', '\/', BASE_DIR));
    return preg_split ("/$pattern/", strtolower ($url))[1];
}

function url_admin_parse ($url) {
    return preg_match ('/admin\//', url_parse ($url));
}

define ('DIR', !url_admin_parse ($_SERVER['REQUEST_URI']) ? './' : '../');
define ('INDEX', DIR.'books.php');
define ('DIR_AUTH', DIR.'auth.php');

// Основные имена директорий подключаемых файлов
define ('_CLASS', '_classes/');
define ('_A', 'admin/');
define ('_D', '_data/');
define ('_R', '_redirect/');
define ('_COMN', 'common/');
// Основные имена подключаемых файлов
define ('_PAGINAT', 'pagination');
define ('_MARK', 'mark'); // templates/common/

// Основные директории подключаемых файлов
define ('CORE', DIR.'core/');
define ('_C', CORE._CLASS); // core/_classes/
define ('D', CORE._D); // core/_data/
define ('A', CORE._A); // core/admin/
define ('C', CORE._COMN); // core/common/

// Внутренние директории подключаемых файлов
define ('DA', D._A); // core/_data/admin/
define ('DC', D._COMN); // core/_data/common/

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
define ('MARK', COMN._MARK); // templates/common/mark
define ('PAGINAT', COMN._PAGINAT); // templates/common/pagination
// Шаблоны Админ страниц
define ('_AUTHORS', TEMPS._A.'authors/'); // templates/admin/
define ('_BOOKS', TEMPS._A.'books/'); // templates/admin/
// Шаблоны страниц
define ('BOOKS', TEMPS.'books/'); // templates/
?>