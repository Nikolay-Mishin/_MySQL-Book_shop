<?php
define ('TEST', false);
define ('REDIR', true);

// Router configs
define ('BASE_DIR', '/_git/_MySQL/_MySQL-Book_shop/');

// Main dirs
define ('SECURED', 'admin/');
define ('PAGES_DIR', 'pages/');
define ('MODULES_DIR', 'modules/');

// Core dirs
define ('_CLASS', '_classes/');
define ('_CONF', 'config/');
define ('_GEN', 'general/');

require_once '_variables.php';

// Основные имена директорий подключаемых файлов
// _CLASSES
define ('_A', 'admin/');
define ('_D', '_data/');
define ('_R', '_redirect/');
define ('_COMN', 'common/');

// Основные имена подключаемых модулей
define ('PAGES', CUR_DIR.PAGES_DIR);
define ('MODULES', CUR_DIR.MODULES_DIR);
define ('ADD', 'add');
define ('EDIT', 'edit');
define ('DEL', 'delete');

// Основные имена подключаемых файлов
define ('_PAGINAT', 'pagination');
define ('_MARK', 'mark'); // templates/common/

// Основные директории подключаемых файлов
// CORE
// // core/_classes/
define ('D', CORE._D); // core/_data/
define ('A', CORE._A); // core/admin/
define ('C', CORE._COMN); // core/common/

// Внутренние директории подключаемых файлов
define ('DA', D._A); // core/_data/admin/
define ('DC', D._COMN); // core/_data/common/
define ('DM', D.MODULES_DIR); // core/_data/modules/

// 
define ('_INTERFACE', 'interface');
define ('_HEAD', 'head');
define ('_HEADER', 'header');
define ('_FOOT', 'footer');
define ('_SCRIPT', 'scriptside');

// Основные страницы
define ('INDEX', DIR.'main.php');
define ('AUTH_DIR', CUR_DIR.'auth.php');
define ('REG_DIR', CUR_DIR.'reg.php');
define ('OUT_DIR', CUR_DIR.'logout.php');
define ('_AUTHORS_DIR', CUR_DIR.(url_admin_parse() ? '' : _A).PAGES_DIR.'authors.php');
define ('BOOKS_DIR', PAGES.'books.php');
define ('BOOK_DIR', PAGES.'book.php');

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
define ('MAIN', TEMPS.'main');
// define ('_RED', TEMPS._R); // templates/_redirect/
define ('COMN', TEMPS._COMN); // templates/common/
// Основные шаблоны
define ('HEAD', COMN.'head'); // templates/common/
define ('HEADER', COMN.'header'); // templates/common/
define ('FOOT', COMN.'footer'); // templates/common/
define ('SCRIPT', COMN.'scriptside'); // templates/common/
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