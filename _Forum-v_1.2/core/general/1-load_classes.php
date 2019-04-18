<?php
require_once _C.'system/List_folder_dirs.php';

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
?>