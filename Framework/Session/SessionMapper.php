<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Session;

class SessionMapper extends \Framework\MapperObject
{
	protected $table = 'session';
	
	public function __construct(\Framework\Session\Session $Session, \PDO $db) {
		parent::__construct($Session, $db);
	}
}

?>