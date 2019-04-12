<?php
Class Router {
    public $router = BASE_DIR;
    public $url = '';

    public static function _ () { return new self; }

    public function url_locked ($url) {
        $this->$url = true;
        echo $this->get_url().'<br>';
    }

    public function url_is_locked () {
        echo $this->get_url().'<br>';
        /* if (locked_url(get_url()))  */
        //redirect(3);
    }

    public function user_is_authorized () {
        echo 'checkUserIsAuthorized = ' . checkUserIsAuthorized().'<br>';
        return checkUserIsAuthorized();
    }

    public function user_is_admin () {
        $this->user_is_authorized();
    }

    public function get_url () {
        $pattern = strtolower (str_replace ('/', '\/', BASE_DIR));
        return preg_split ("/$pattern/", strtolower ($_SERVER['REQUEST_URI']))[1];
    }
}
?> 