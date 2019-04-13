<?php
Class Router {
    private $router = BASE_DIR;
    private $locked_url = [];

    public static function _ () { return new self; }

    public function get_this () { return $this; }

    public function test () {
        test ('url => ' . $this->get_url());
        test ('url_parse => ' . $this->url_parse());
        test ('url_admin_parse = ' . $this->url_admin_parse());
        test ('user_is_authorized = ' . $this->user_is_authorized());
        test ('user_is_admin = ' . $this->user_is_admin());
        test ($_COOKIE);
        test ($this->locked_url);
        $this->url_is_locked();
    }

    private function get_url () { return get_url(); }

    private function url_parse () { return url_parse(); }

    private function url_admin_parse () { return url_admin_parse(); }

    private function user_is_authorized () { return checkUserIsAuthorized(); }

    private function user_is_admin () {
        return $this->user_is_authorized() ? query_join (connect(), 'users', ['user_id', 'role_name'], ['roles' => ['user_role_id', 'role_id']], ['user_id' => $_COOKIE['u']])['role_name'] == 'admin' : false;
    }

    public function url_locked ($locked = true, $auth = false, $admin = false) {
        $this->locked_url['url'] = $this->get_url();
        $this->locked_url['locked'] = $locked;
        $this->locked_url['auth'] = $auth;
        $this->locked_url['admin'] = $admin;
        $this->url_is_locked();
        test ($this->get_this());
    }

    private function url_is_locked ($locked_list = null) {
        $locked_url = $this->locked_url;
        if ($locked_url) {
            test ('Страница имеет ограничения доступа!');
            if ($locked_url['locked']) {
                test ('Данная страница недоступна!');
                //redirect (3);
            }
            if ($locked_url['auth'] && !$this->user_is_authorized()) {
                test ('Для доступа к данной странице необходимо авторизироваться!');
                //redirect (3, DIR_AUTH);
            }
            if ($locked_url['admin'] && $this->url_admin_parse() && !$this->user_is_admin()) {
                test ('Просмотр данной страницы доступен только Администрации!');
                //redirect (3, INDEX);
            }
        }
    }
}
?> 