<?php

/**
 * @author Jonathan LeMaitre
 * @copyright 2013
 */

namespace Models\User;

class UserMapper extends \Framework\MapperObject
{
	protected $table = 'user';
	protected $proxy = '\Models\User\User';

	public function __construct(\PDO $db, \Models\Group\GroupMapper $GroupMapper) {
		parent::__construct($db);
		
		$this->addChild($GroupMapper, 'Group', 'group_id');
	}
}

?>