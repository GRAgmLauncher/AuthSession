<?php
require_once "Framework/Autoloader.php";
require_once "Config/Constants.php";
require_once "Config/Configurations.php";
require_once "Config/Injections.php";
require_once "Config/Routes.php";

$jpl = new JPL($routes, $Injector);
$jpl->run();
?>