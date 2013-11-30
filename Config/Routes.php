<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

$routes = array
(
	'/'						=> 'DefaultController->welcome',
	'/404'					=> 'DefaultController->error404',
	'/login'				=> 'LoginController->login',
	'/logout'				=> 'LoginController->logout'
);

?>