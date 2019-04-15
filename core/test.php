<?php
test ($_SESSION);
test ($_COOKIE);
test ('user_access => ' . user_access());
test ('user_is_authorized => ' . $router->user_is_authorized);
test ('user_is_admin => ' . $router->user_is_admin);
$router->test();
?>