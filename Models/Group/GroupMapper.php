<?php

namespace Models\Group;

class GroupMapper extends \Core\MapperObject
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