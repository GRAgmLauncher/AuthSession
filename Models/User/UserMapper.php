<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class UserMapper extends \Core\MapperObject
{
	protected $table = 'user';
	protected $fields = array
	(
		'id'				=> 'int',
		'group_id' 			=> 'int',
		'display_name'		=> 'string',
		'login_name'		=> 'string',
		'email'				=> 'string'
	);
}

?>