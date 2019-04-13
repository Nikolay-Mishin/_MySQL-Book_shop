<?php
class Controller {
    public static function _ () { return new self; } // for chaining

    public function redirect_call ($t = 0, $url = null) {
        $c = $this->_method();
        $this->$c ($t, $url);
    }

    public function _ref () { return key_exists ('HTTP_REFERER', $_SERVER) ? $_SERVER['HTTP_REFERER'] : INDEX; }

    private function _method () { return $_SERVER['REQUEST_METHOD']; }

    private function GET ($t, $url) {
        test ($url);
        $url = $url ?? redirect_page();
        $this->redirect ($t, $url);
    }

    private function POST ($t, $url) {
        test ($_COOKIE);
        $url = $url ?? $_COOKIE['r'];
        setcookie ('r', $_COOKIE['r'], time() - 100);
        $this->redirect ($t, $url);
    }

    private function redirect ($t, $url) {
        header ($this->_head ($t) . $url, true, 303);
        exit;
    }

    private function _head ($t) {
        if ($t == 0) { $t = "Location: "; }
        else { $t = "Refresh: $t;"; }
        return $t;
    }
}
?> 