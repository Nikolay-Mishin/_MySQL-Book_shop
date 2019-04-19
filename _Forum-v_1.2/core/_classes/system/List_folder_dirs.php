<?php
Class List_folder_dirs extends Core {
    public $dirs = [];

    public function get_dirs ($dir, $pattern = _C) {
        $ffs = Using::get_dir_content ($dir);
        
        if (count ($ffs) < 1) { return; } // prevent empty ordered elements

        foreach ($ffs as $ff) {
            if (is_dir ("$dir/$ff")) {
                $this->dirs[] = $dir === 'classes' ? $ff : preg_replace ('/'.url_pattern ($pattern).'/', '', "$dir/$ff");
                $this->get_dirs ("$dir/$ff");
            }
        }
        
        return $this->dirs;
    }
}
?>