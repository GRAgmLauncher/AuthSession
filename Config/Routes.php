<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

$routes = array
(
	'/'								=> 'DefaultController->welcome',
	'/404'							=> 'DefaultController->error404',
	'/login'						=> 'AccountController->login',
	'/logout'						=> 'AccountController->logout',
	'/upload'						=> 'ImageController->upload',
	'/product/add'					=> 'ProductController->add',
	'/product/:id'					=> 'ProductController->details',
	'/product/:id/edit'				=> 'ProductController->edit',
	'/product/:id/delete'			=> 'ProductController->delete',
	'/products'						=> 'ProductController->list'
);

?>