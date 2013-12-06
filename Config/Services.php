<?php

$services = new Pimple();

$services['db'] = $services->share(function($s) {
	return DB::connect();
});

$services['InputCleaner'] = function($s) {
	return new \Framework\Input\InputCleaner(new \Framework\Input\Input);
};

$services['MySQLSessionProvider'] = function($s) {
	return new \Framework\Session\MySQLSessionProvider( 
		new \Framework\Session\SessionMapper (
			new \Framework\Session\Session,
			$s['db']
		)
	);
};

$services['MemorySessionProvider'] = function($s) {
	return new \Framework\Session\MemorySessionProvider;
};

$services['SessionManager'] = $services->share(function($s) {
	return new \Framework\Session\SessionManager( $s['MySQLSessionProvider'], new \Framework\Session\SessionFactory ); // To change how the session is handled without changing the rest of the code, simply pass in a new session provider here
});

$services['UserMapper'] = function($s) {
	return new \Models\User\UserMapper( new \Models\User\User, $s['db'] );
};

$services['AuthMapper'] = function($s) {
	return new \Framework\Auth\AuthMapper(new \Framework\Auth\Auth, $s['db']);
};



/*--------------------------------------------------------
|
| Account Handlers
|
|--------------------------------------------------------*/

// Login Handlers
$services['DefaultLoginHandler'] = function($s) {
	return new \Framework\Account\LoginHandlers\DefaultLoginHandler($s['SessionManager'], $s['AuthMapper'], $s['UserMapper']);
};

// Logout Handlers
$services['DefaultLogoutHandler'] = function($s) {
	return new \Framework\Account\LogoutHandlers\DefaultLogoutHandler($s['SessionManager']);
};

// Registration Handlers
$services['DefaultRegistrationHandler'] = function($s) {
	return new \Framework\Account\RegistrationHandlers\DefaultRegistrationHandler($s['SessionManager'], $s['AuthMapper'], new \Framework\Auth\AuthFactory, $s['UserMapper'], new \Models\User\UserFactory);
};


$services['Request'] = function($s) {
	return new \Framework\Request;
};

$services['Router'] = $services->share(function($s) {
	return new \Framework\Router\Router($s['Request'], $s['RouteFactory']);
});

$services['RouteFactory'] = function($s) {
	return new \Framework\Router\RouteFactory;
};

$services['Dispatcher'] = function($s) {
	return new \Framework\Router\Dispatcher($s['ControllerFactory']);
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

$services['CSRFManager'] = function($s) {
	return new \Framework\Security\CSRFManager($s['Input'], $s['Redirect'], $s['SecurityHelper']);
};

$services['Flash'] = function($s) {
	return new \Framework\Flasher\Flash(new \Framework\Flasher\FlashStorage, new \Framework\Flasher\FlashMessageFactory);
};

$services['Redirect'] = function($s) {
	return new \Framework\Redirect($s['Flash'], $s['Request']);
};

$services['ImageFactory'] = function($s) {
	return new \Framework\Image\ImageFactory;
};

$services['JPEGImageSaver'] = function($s) {
	return new \Framework\Image\JPEGImageSaver;
};

$services['ImageUploader'] = function($s) {
	return new \Framework\Image\ImageUploader(UPLOADS_TEMP, $s['ImageFactory'], $s['SecurityHelper']);
};

$services['SecurityHelper'] = function($s) {
	return new \Framework\Security\SecurityHelper;
};

$services['Product'] = function($s) {
	return new \Models\Product\Product;
};

$services['ProductMapper'] = function($s) {
	return new \Models\Product\ProductMapper($s['Product'], $s['db']);
}

?>