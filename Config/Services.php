<?php

$services = new Pimple();

$services['db'] = $services->share(function($s) {
	return DB::connect();
});

$services['InputCleaner'] = function($s) {
	return new \Core\InputCleaner(new \Core\Input);
};

$services['MySQLSessionProvider'] = function($s) {
	return new \Models\Session\MySQLSessionProvider( $s['SessionMapper'] );
};

$services['MemorySessionProvider'] = function($s) {
	return new \Models\Session\MemorySessionProvider;
};

$services['SessionManager'] = $services->share(function($s) {
	return new \Models\Session\SessionManager( $s['MySQLSessionProvider'], new \Models\Session\SessionFactory ); // To change how the session is handled without changing the rest of the code, simply pass in a new session provider here
});

$services['SessionMapper'] = function($s) {
	return new \Models\Session\SessionMapper(new \Models\Session\Session, $s['db']);
};

$services['UserMapper'] = function($s) {
	return new \Models\User\UserMapper( new \Models\User\User, $s['db'] );
};

$services['AuthMapper'] = function($s) {
	return new \Models\Auth\AuthMapper(new \Models\Auth\Auth, $s['db']);
};

$services['AccountManager'] = function($s) {
	return new \Models\Account\AccountManager($s['SessionManager'], $s['AuthMapper'], new \Models\Auth\AuthFactory, $s['UserMapper'], new \Models\User\UserFactory);
};

$services['Request'] = function($s) {
	return new \Core\Request;
};

$services['Router'] = $services->share(function($s) {
	return new \Core\Router\Router($s['Request'], $s['RouteFactory']);
});

$services['RouteFactory'] = function($s) {
	return new \Core\Router\RouteFactory;
};

$services['Dispatcher'] = function($s) {
	return new \Core\Router\Dispatcher($s['ControllerFactory']);
};

$services['ControllerFactory'] = function($s) {
	return new \Controllers\ControllerFactory($s);
};

$services['Template'] = $services->share(function($s) {
	return new \Views\Template;
});

$services['View'] = $services->share(function($s) {
	return new \Views\View;
});

$services['CSRF'] = function($s) {
	return new \Core\CSRF($s['Input'], $s['Redirect']);
};

$services['Flash'] = function($s) {
	return new \Core\Flash;
};

$services['Redirect'] = function($s) {
	return new \Core\Redirect($s['Flash'], $s['Request']);
}

?>