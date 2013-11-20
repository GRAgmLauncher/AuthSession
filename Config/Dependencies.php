<?php

$container = new Pimple();

$container['db'] = $container->share(function($c) {
	return DB::connect();
});

$container['MySQLSessionProvider'] = function($c) {
	return new \Models\Session\MySQLSessionProvider( $c['SessionMapper'] );
};

$container['MemorySessionProvider'] = function($c) {
	return new \Models\Session\MemorySessionProvider;
};

$container['SessionManager'] = $container->share(function($c) {
	return new \Models\Session\SessionManager( $c['MySQLSessionProvider'], new \Models\Session\SessionFactory ); // To change how the session is handled without changing the rest of the code, simply pass in a new session provider here
});

$container['SessionMapper'] = function($c) {
	return new \Models\Session\SessionMapper(new \Models\Session\Session, $c['db']);
};

$container['UserMapper'] = function($c) {
	return new \Models\User\UserMapper( new \Models\User\User, $c['db'] );
};

$container['AuthMapper'] = function($c) {
	return new \Models\Auth\AuthMapper(new \Models\Auth\Auth, $c['db']);
};

$container['AccountManager'] = function($c) {
	return new \Models\Account\AccountManager($c['SessionManager'], $c['AuthMapper'], new \Models\Auth\AuthFactory, $c['UserMapper'], new \Models\User\UserFactory);
};

$container['CurrentSession'] = $container['SessionManager']->initializeSession();
$container['CurrentUser'] = $container['UserMapper']->fetchByID($container['CurrentSession']->user_id);


?>