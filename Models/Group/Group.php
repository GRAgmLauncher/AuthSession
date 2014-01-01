<?php

namespace Models\Group;

class Group
{
	/** int */
	public $id;
	
	/** string */
	public $group_name;
	
	/** int */
	public $permission_level;
	
	public function __construct() {
		$this->id = 3;
		$this->group_name = 'Guest';
		$this->permission_level = 0;
	}
}


?>