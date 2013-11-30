<?php

require_once "core/Autoloader.php";
require_once "config/Constants.php";
require_once "config/Services.php";
require_once "config/Controllers.php";
require_once "config/Routes.php";

$jpl = new JPL($services, $controllers, $routes);
$jpl->run();

?>