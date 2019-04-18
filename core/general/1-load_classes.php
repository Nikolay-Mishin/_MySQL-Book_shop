<?php
require_once _C.'Init.php';
require_once _C.'initiolize/Init_class.php';

test (_C.'Init.php');
test (_C.'initiolize/Init_class.php');
$init = Init_class::_();


spl_autoload_register ('autoload');

function autoload ($class) {
    $class_name = $class;
    $base_dir = _C;
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
    global $init;
    $init->$class_name = $class_name::_();
}

Class List_folder_dirs extends Init {
    public $dirs = [];

    public function get_dirs ($dir) {
        $ffs = get_dir_content ($dir);
        
        if (count ($ffs) < 1) { return; } // prevent empty ordered elements

        foreach ($ffs as $ff) {
            if (is_dir ("$dir/$ff")) {
                $this->dirs[] = $dir === 'classes' ? $ff : preg_replace ('/'.url_pattern (_C).'/', '', "$dir/$ff");
                $this->get_dirs ("$dir/$ff");
            }
        }
        
        return $this->dirs;
    }
}
?>