<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Auth;

class AuthMapper extends \Framework\MapperObject
{
	protected $table = 'auth';
	
	public function __construct(\Framework\Auth\Auth $Auth, \PDO $db) {
		parent::__construct($Auth, $db);
	}
}

?>