<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class UserMapper extends \Framework\MapperObject
{
	protected $table = 'user';
	private $GroupMapper;

	public function __construct(\PDO $db, \Models\User\User $User, \Models\Group\GroupMapper $GroupMapper) {
		parent::__construct($db);
		$this->proxy = $User;
		$this->GroupMapper = $GroupMapper;
	}
	
	protected function addChildren(\Framework\Interfaces\UserInterface $User) {
		$User->Group = $this->GroupMapper->fetchByID($User->group_id);
	}
}

?>