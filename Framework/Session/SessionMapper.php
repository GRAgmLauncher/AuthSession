<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Session;

class SessionMapper extends \Framework\MapperObject
{
	protected $table = 'session';
	protected $proxy = '\Framework\Session\Session';
	
	public function __construct(\PDO $db, \Models\User\UserMapper $UserMapper) {
		parent::__construct($db);
		
		$this->addChild($UserMapper, 'User', 'user_id');
	
	}
}

?>