<?php

namespace Models\Group;

class GroupMapper extends \Framework\MapperObject
{
	protected $table = 'group';
	
	public function __construct(\PDO $db, \Models\Group\Group $Group) {
		parent::__construct($db);
		$this->proxy = $Group;
	}
}


?>