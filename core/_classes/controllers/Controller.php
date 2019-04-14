<?php
class Controller extends Core {
    public function redirect_call ($t = 0, $url = null) { $this->{$this->_method()} ($t, $url); }

    public static function _ref () { return key_exists ('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : INDEX; }

    private function _method () { return $_SERVER['REQUEST_METHOD']; }

    private function GET ($t, $url) { $this->redirect ($t, $url ?? redirect_page()); }

    private function POST ($t, $url) {
        $this->redirect ($t, $url ?? $_COOKIE['r']);
        setcookie ('r', $_COOKIE['r'], time() - 100);
    }

    private function redirect ($t, $url) { header ($this->_head ($t) . $url, true, 303); exit; }

    private function _head ($t) {
        if ($t == 0) { $t = "Location: "; }
        else { $t = "Refresh: $t;"; }
        return $t;
    }
}
?> 