<?php
Class Using extends Core {
    public function __ () { $args = func_get_args(); require_once $args[0]; }

    public function file ($file) { if (is_file ($file)) { require_once $file; } }

    public function dir ($dir) {
        foreach (Using::get_dir_content ($dir) as $file) { 
            if (is_file ($dir.$file)) {
                require_once $dir.$file;
            }
        }
    }

    public static function get_dir_content ($dir) {
        $files = scandir (self::dir_to_file ($dir));
        unset ($files[array_search ('.', $files, true)]);
        unset ($files[array_search ('..', $files, true)]);
        return $files;
    }

    public static function dir_to_file ($dir) { return preg_replace ('/\/$/', '', $dir); }
}
?>