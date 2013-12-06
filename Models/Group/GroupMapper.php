<?php

namespace Models\Group;

class GroupMapper extends \Framework\MapperObject
{
	protected $table = 'group';
	protected $fields = array
	(
		'id'				=> 'int',
		'name' 				=> 'string',
		'permissionLevel'	=> 'int',
		'isAdmin'			=> 'int'
	);
}


?>