<?php
Class Using extends Core {
    public static function get_dir_content ($dir) {
        $files = scandir (self::dir_to_file ($dir));
        unset ($files[array_search ('.', $files, true)]);
        unset ($files[array_search ('..', $files, true)]);
        return $files;
    }

    public static function dir_to_file ($dir) { return preg_replace ('/\/$/', '', $dir); }
}
?>