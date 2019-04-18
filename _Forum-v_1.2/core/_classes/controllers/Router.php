<?php
Class Router extends Core {
    public $user_access = false;
    public $user_is_authorized = false;
    public $user_is_admin = false;
    private $locked_url = [];

    public function test () {
        test ('session_started => ' . session_started());
        test ('=> SESSION');
        test ($_SESSION);
        test ('=> COOKIE');
        test ($_COOKIE);
        test ('user_access => ' . $this->user_access);
        test ('user_is_authorized => ' . $this->user_is_authorized);
        test ('user_is_admin => ' . $this->user_is_admin);
        $this->get_method();
        test ('url => ' . $this->get_url());
        test ('url_parse => ' . $this->url_parse());
        test ('url_admin_parse = ' . $this->url_admin_parse());
        test ('=> test');
        test ($this);
    }

    public function user_access () {
        $this->user_is_authorized();
        $this->user_is_admin();
        $this->url_is_locked();
        global $test;
        if ($test) { $this->test(); }
        return $this->user_access;
    }

    public function user_is_authorized () { return $this->user_is_authorized = user_is_authorized(); }

    public function user_is_admin () {
        return $this->user_is_admin = $this->user_is_authorized
            ? query_join (connect(), 'users', ['user_id', 'role_name'], ['roles' => ['user_role_id', 'role_id']],
                    ['user_id' => $_COOKIE['u']]
                )['role_name'] == 'admin'
            : false
        ;
    }

    public function get_url () { return get_url(); }

    public function url_is_locked () {
        $locked_url = null;
        foreach (URL_LOCKED as $url => $access) {
            $url = is_dir (DIR.$url) ? $url : "$url.php";
            $locked_url = preg_match ('/'.url_pattern ($url).'/', $this->url_parse()) ? $access : $locked_url;
        }
        $locked_url = $locked_url !== null ? $this->url_locked ($locked_url) : null;
        if ($locked_url) {
            $locked_url = $this->locked_url;
            if ($locked_url['locked']) {
                test ('Данная страница недоступна!');
                //redirect (3, INDEX);
            }
            else if ($locked_url['auth'] && !$this->user_is_authorized) {
                test ('Для доступа к данной странице необходимо авторизироваться!');
                //redirect (3, AUTH_DIR);
            }
            else if ($this->url_admin_parse() && !$this->user_is_admin) {
                test ('Просмотр данной страницы доступен только Администрации!');
                //redirect (3, INDEX);
            }
            test ('AUTH_DIR => ' . AUTH_DIR);
            test ('INDEX => ' . INDEX);
            return $locked_url['locked'];
        }
    }

    private function url_locked ($access) {
        $this->locked_url['url'] = $this->get_url();
        $locked = $this->locked_url['locked'] = $access == 0 ?: false;
        $auth = $this->locked_url['auth'] = $access == 1 ?: false;
        $admin = $this->locked_url['admin'] = $this->url_admin_parse();
        $this->user_access = $locked
            ? false : $auth && !$this->user_is_authorized
            ? false : ($admin && !$this->user_is_admin ? false : true)
        ;
        return true;
    }

    private function url_parse () { return url_parse(); }

    private function url_admin_parse () { return url_admin_parse(); }
}
?> 