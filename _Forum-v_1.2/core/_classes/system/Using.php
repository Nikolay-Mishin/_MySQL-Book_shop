<?php
Class Using extends Core {
    public function file ($file) { if (is_file ($file)) { require_once $file; } }

    public function dir ($dir) {
        foreach (Using::get_dir_content ($dir, true) as $file) {
            $file = $dir.$file;
            if (is_dir ($file)) { self::dir ("$file/"); }
            if (is_file ($file)) { self::file ($file); }
        }
    }

    public static function get_dir_content ($dir, $root = false) {
        $files = scandir (self::dir_to_file ($dir));
        unset ($files[array_search ('.', $files, true)]);
        unset ($files[array_search ('..', $files, true)]);
        if ($root) {
            $files = preg_grep ("/^[^main]/", $files);
            $files = preg_grep ("/^[^_]/", $files);
        }
        return $files;
    }

    public static function dir_to_file ($dir) { return preg_replace ('/\/$/', '', $dir); }
}
?>