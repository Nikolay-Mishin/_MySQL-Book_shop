<?php
spl_autoload_register ('autoload');

function _autoload ($class) {
    $class = _C."$class.php";
    require_once $class;
}

function autoload ($class) {
    $base_dir = preg_replace ('/\/$/', '', _C);
    $dirs = List_folder_dirs::_()->get_dirs ($base_dir);
    if (is_file ("$base_dir/$class.php")) { $class = "$base_dir/$class"; }
    else {
        foreach ($dirs as $dir) {
            if (is_dir ("$base_dir/$dir") && is_file ("$base_dir/$dir/$class.php")) {
                $class = "$base_dir/$dir/$class";
                break;
            }
        }
    }
    require_once "$class.php";
}

Class List_folder_dirs {
    public $dirs = [];

    public static function _ () { return new self; }

    public function get_dirs ($dir) {
        $ffs = scandir ($dir);

        unset ($ffs[array_search ('.', $ffs, true)]);
        unset ($ffs[array_search ('..', $ffs, true)]);

        // prevent empty ordered elements
        if (count ($ffs) < 1) {
            return;
        }

        foreach ($ffs as $ff) {
            if (is_dir ("$dir/$ff")) {
                $pattern = str_replace ('/', '\/', _C);
                $this->dirs[] = $dir === 'classes' ? $ff : preg_replace ("/$pattern/", '', "$dir/$ff");
                $this->get_dirs ("$dir/$ff");
            }
        }
        
        return $this->dirs;
    }
}
?>