<?php
Class Router {
    private $router = BASE_DIR;
    private $locked_url = [];

    public static function _ () { return new self; }

    private function user_is_authorized () { return checkUserIsAuthorized(); }

    private function user_is_admin () {
        return $this->user_is_authorized() && (int) $_COOKIE['u'] === 1 ? true : false;
    }

    public function url_locked ($locked = true, $auth = false, $admin = false) {
        $this->locked_url['url'] = $this->get_url();
        $this->locked_url['locked'] = $locked;
        $this->locked_url['auth'] = $auth;
        $this->locked_url['admin'] = $admin;
        $this->url_is_locked();
    }

    private function url_is_locked () {
        $locked_url = $this->locked_url;
        if (!empty ($locked_url)) {
            test ('Страница имеет ограничения доступа!');
            if ($locked_url['locked']) {
                test ('Данная страница недоступна!');
                //redirect (3);
            }
            if ($locked_url['admin'] && !$this->user_is_admin()) {
                test ('Просмотр данной страницы доступен только Администрации!');
                redirect (3, DIR_AUTH);
            }
            if ($locked_url['auth'] && !$this->user_is_authorized()) {
                test ('Для доступа к данной странице необходимо авторизироваться!');
                redirect (3, DIR_AUTH);
            }
        }
    }

    private function get_url () {
        $pattern = strtolower (str_replace ('/', '\/', BASE_DIR));
        return preg_split ("/$pattern/", strtolower ($_SERVER['PHP_SELF']))[1];
    }

    private function get_this () { test ($this); }

    public function test () {
        echo 'user_is_authorized = ' . $this->user_is_authorized().'<br>';
        echo 'user_is_admin = ' . $this->user_is_admin().'<br>';
        test ($_COOKIE);
        test ($this->get_url());
    }
}
?> 