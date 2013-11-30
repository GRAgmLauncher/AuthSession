<?php

namespace Models\Group;

class Group extends \Core\DomainObject
{
	public $id;
	public $name;
	public $permissionLevel;
	public $isAdmin = false;
}


?>