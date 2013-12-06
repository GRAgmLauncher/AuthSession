<?php

require_once "Framework/Autoloader.php";
require_once "Config/Constants.php";
require_once "Config/Services.php";
require_once "Config/Routes.php";

$jpl = new JPL($services, $routes);
$jpl->run();

?>