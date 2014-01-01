<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Framework\Session;

class SessionMapper extends \Framework\MapperObject
{
	protected $table = 'session';
	private $UserMapper;
	
	public function __construct(\PDO $db, \Framework\Session\Session $Session, \Models\User\UserMapper $UserMapper) {
		parent::__construct($db);
		$this->proxy = $Session;
		$this->UserMapper = $UserMapper;
	}
	
	protected function addChildren(\Framework\Interfaces\SessionInterface $Session) {
		if ($User = $this->UserMapper->fetchByID($Session->user_id)) {
			$Session->User = $User;	
		}
	}
}

?>