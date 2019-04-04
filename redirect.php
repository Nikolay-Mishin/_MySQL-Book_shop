<?php 
function redirect ($time = 0, $url = false) {
    if (!$url) $url = $_SERVER['HTTP_REFERER'];
    else {
        $url = $_COOKIE['r'];
        setcookie ('r', $_COOKIE['r'], time() - 100);
    }
    header ("Refresh: $time;".$url);
}
function set_redirect () { if (empty ($_POST) && !array_key_exists ('r', $_COOKIE)) setcookie ('r', $_SERVER['HTTP_REFERER']); }

class Controller {
    public static function _ () { return new self; } // for chaining
    public function call ($t = 0, $url = false) { $url = $url ? $url : self::_ref(); $c = self::_method(); self::$c ($t, $url); }

    public function _ref () { return $_SERVER ['HTTP_REFERER']; }
    private function _method () { return $_SERVER ['REQUEST_METHOD']; }

    private function GET ($t, $url) { self::POST ($t, $url); } // dispay form
    private function POST ($t, $url) { self::redirect ($t, $url); }
    private function _POST ($t, $url) { $this->redirect ($t, $url); } // process form
    private function redirect ($t, $loc) { header (self::_head ($t) . $loc, true, 303); exit; }

    private function _head ($t) { if ($t == 0) $t = "Location: "; else $t = "Refresh: $t;"; return $t; }
}
//controller::_()::_ref();
//controller::_()::call ($time, $url);

function redirect_page () { return Controller::_()::_ref(); }
?> 