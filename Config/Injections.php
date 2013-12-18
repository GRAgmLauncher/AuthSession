<?php

$Injector = new \Framework\AutoInjector;

// Register explicit subsitutions (TODO, callback or something)
// Explicit substitutions are by default shared instances, since they are registered once
$Injector->register('PDO', new \PDO($config['database']['dsn'], $config['database']['user'], $config['database']['pass']));

// Substitute all abstractions/interfaces with desired concrete implementation. These definitions should come from configurations in Configurations.php.
$Injector->substitute('Framework\Session\AbstractSessionProvider', $config['session_provider']);
$Injector->substitute('Framework\Interfaces\FlashStorageInterface', $config['flash_storage']);
$Injector->substitute('Framework\Account\LoginHandlers\AbstractLoginHandler', $config['login_handler']);
$Injector->substitute('Framework\Account\LogoutHandlers\AbstractLogoutHandler', $config['logout_handler']);
$Injector->substitute('Framework\Account\RegistrationHandlers\AbstractRegistrationHandler', $config['registration_handler']);

// Define shared services
$Injector->share($config['session_provider']);
?>