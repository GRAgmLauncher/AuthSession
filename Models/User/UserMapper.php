<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class UserMapper extends \Framework\MapperObject
{
	protected $table = 'user';
	
	public function __construct(\Models\User\User $User, \PDO $db) {
		parent::__construct($User, $db);
	}
}

?>