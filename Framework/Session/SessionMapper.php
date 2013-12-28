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
	private $UserMapper;
	
	public function __construct(\PDO $db, \Framework\ORM\RelationTree $RelationTree, \Models\User\UserMapper $UserMapper) {
		parent::__construct($db, $RelationTree);
		$this->UserMapper = $UserMapper;
	}
	
	protected function addChildren(\Framework\Interfaces\SessionInterface $Session) {
		$Session->User = $this->UserMapper->fetchByID($Session->user_id);
	}
}

?>