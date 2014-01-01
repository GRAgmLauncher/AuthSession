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
	'/register'						=> 'AccountController->register',
	'/upload'						=> 'ImageController->upload',
	'/manage/paintings/add'			=> 'ManageProductsController->add',
	'/manage/painting/:id'			=> 'ManageProductsController->details',
	'/manage/painting/:id/edit'		=> 'ManageProductsController->edit',
	'/manage/painting/:id/delete'	=> 'ManageProductsController->delete',
	'/manage/paintings'				=> 'ManageProductsController->index',
	'/painting/:id'					=> 'PaintingController->details',
	'/paintings'					=> 'PaintingController->indexAll',
	'/paintings/size/:size'			=> 'PaintingController->indexSize'
);

?>