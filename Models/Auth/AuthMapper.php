<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\Auth;

class AuthMapper extends \Core\MapperObject
{
	protected $table = 'auth';
	protected $fields = array
	(
		'id'				=> 'int',
		'user_id' 			=> 'int',
		'registered'		=> 'int',
		'email'				=> 'string',
		'hash'				=> 'string'
	);
}

?>