<?php
require_once '../core/main.php'; 
if (isset ($_GET['mark']) && isset ($_GET['book'])) {
    load (DM.name(), MARK, 'mark');
    redirect();
}
?>