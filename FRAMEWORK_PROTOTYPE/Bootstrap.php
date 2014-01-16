<?php

require_once('Autoloader.php');
require_once('\Framework\AutoInjector.php');

$config['database']['dsn']		= 'mysql:host=localhost;dbname=mapper';
$config['database']['user']		= 'root';
$config['database']['pass']		= '';

try {
	$db = new \PDO($config['database']['dsn'], $config['database']['user'], $config['database']['pass']);
	$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
	$e->getMessage();
}

$I = new \Framework\AutoInjector;
$I->bind('PDO', $db);
$I->bind('\Framework\AutoInjector', $I);

?>