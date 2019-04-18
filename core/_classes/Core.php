<?php
class Core extends Init {
    public function get_method () { test (get_class ($this) . " => Вызван метод " . __METHOD__); }
}
?>