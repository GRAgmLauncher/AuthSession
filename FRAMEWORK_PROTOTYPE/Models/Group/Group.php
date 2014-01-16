<?php

namespace Models\Group;

class Group
{
	/** int */
	public $id;
	
	/** string */
	public $name;
	
	/** int */
	public $permission_level;
	
	public function __construct() {
		$this->id = 3;
		$this->name = 'Guest';
		$this->permission_level = 0;
	}
}


?>