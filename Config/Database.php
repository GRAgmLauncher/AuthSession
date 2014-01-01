<?php
try {
	$db = new \PDO($config['database']['dsn'], $config['database']['user'], $config['database']['pass']);
	$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
} catch (\Exception $e) {
	$e->getMessage();
}

?>