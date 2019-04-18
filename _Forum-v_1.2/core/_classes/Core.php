<?php
class Core extends Init {
    public function call () { $this->get_method (get_class ($this), __METHOD__); }

    private function get_method ($class, $method) { test ("$class => Вызван метод $method"); }
}
?> 