<?php
class Controller {
    public static function _ () { return new self; } // for chaining

    public function redirect_call ($t = 0, $url = null) {
        $url = $url ? $url : $this->_ref();
        $c = $this->_method();
        $this->$c ($t, $url);
    }

    public function _ref () { return $_SERVER['HTTP_REFERER']; }

    private function _method () { return $_SERVER['REQUEST_METHOD']; }

    private function GET ($t, $url) {
        $url = redirect_page();
        $this->redirect ($t, $url);
    }

    private function POST ($t, $url) {
        $url = $_COOKIE['r'];
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