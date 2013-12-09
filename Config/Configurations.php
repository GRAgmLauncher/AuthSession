<?php
$config['session_provider']		= 'Framework\Session\MySQLSessionProvider';

$config['database']['dsn']		= 'mysql:host=localhost;dbname=fakesite';
$config['database']['user']		= 'fakesiteadmin';
$config['database']['pass']		= '';

$config['flash_storage']		= 'Framework\Flasher\FlashStorage';
$config['login_handler']		= 'Framework\Account\LoginHandlers\DefaultLoginHandler';
$config['logout_handler']		= 'Framework\Account\LogoutHandlers\DefaultLogoutHandler';

?>