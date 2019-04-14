<?php
Class Router extends Core {
    private $locked_url = [];

    public function test () {
        test ($this);
        test ($SESSION);
        test ($_COOKIE);
        test ('url => ' . $this->get_url());
        test ('url_parse => ' . $this->url_parse());
        test ('url_admin_parse = ' . $this->url_admin_parse());
        test ('user_is_authorized = ' . $this->user_is_authorized());
        test ('user_is_admin = ' . $this->user_is_admin());
        $this->call();
    }

    public function url_is_locked () {
        $locked_url = null;
        foreach (URL_LOCKED as $url => $access) {
            $url = is_dir (DIR.$url) ? $url : "$url.php";
            $locked_url = !preg_match ('/'.url_pattern ($url).'/', $this->url_parse()) ? $locked_url : $access;
        }
        test ('locked_url => ' . $locked_url);
        $locked_url = $locked_url !== null ? $this->url_locked ($locked_url) : null;
        if ($locked_url) {
            $locked_url = $this->locked_url;
            test ('Страница имеет ограничения доступа!');
            if ($locked_url['locked']) {
                test ('Данная страница недоступна!');
                // redirect (3, INDEX);
            }
            else if ($locked_url['auth'] && !$this->user_is_authorized()) {
                test ('Для доступа к данной странице необходимо авторизироваться!');
                // redirect (3, DIR_AUTH);
            }
            else if ($this->url_admin_parse() && !$this->user_is_admin()) {
                test ('Просмотр данной страницы доступен только Администрации!');
                // redirect (3, INDEX);
            }
        }
        return $this;
    }

    private function url_locked ($access) {
        $this->locked_url['url'] = $this->get_url();
        $this->locked_url['locked'] = $access == 0 ?: 0;
        $this->locked_url['auth'] = $access > 0 ?: 0;
        return true;
    }

    private function get_url () { return get_url(); }

    private function url_parse () { return url_parse(); }

    private function url_admin_parse () { return url_admin_parse(); }

    private function user_is_authorized () { return checkUserIsAuthorized(); }

    private function user_is_admin () {
        return $this->user_is_authorized() ? query_join (connect(), 'users', ['user_id', 'role_name'], ['roles' => ['user_role_id', 'role_id']], ['user_id' => $_COOKIE['u']])['role_name'] == 'admin' : false;
    }
}
?> 